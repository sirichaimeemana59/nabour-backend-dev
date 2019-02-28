<?php

namespace App\Http\Controllers\RootAdmin;

use Request;
use App\Http\Controllers\Controller;
use File;
use App\InvoiceFile;
use App\Invoice;
use App\PropertyUnit;
use App\Bank;
use App\BankTransaction;
use App\Transaction;

use Storage;
use DB;

class EditreceiptController extends Controller
{

    public function index()
    {
        return view('Editreceipt.Editreceipt');
    }


    public function create()
    {
        $invoicefile = InvoiceFile::find(Request::get('id-invoice'));

        if($invoicefile){
            foreach (Request::get('attachment') as $key => $file) {
                $path = $this->createLoadBalanceDir($file['name']);
                $invoicefile = InvoiceFile::find(Request::get('id-invoice'));
                $invoicefile->name = $file['name'];
                $invoicefile->url = $path;
                $invoicefile->is_image = $file['isImage'];
                $invoicefile->original_name = $file['originalName'];
                $invoicefile->save();

            }

        }else{
            foreach (Request::get('attachment') as $key => $file) {
                $path = $this->createLoadBalanceDir($file['name']);
                $invoicefile = new InvoiceFile;
                $invoicefile->invoice_id  = Request::get('id-invoice');
                $invoicefile->name = $file['name'];
                $invoicefile->url = $path;
                $invoicefile->is_image = $file['isImage'];
                $invoicefile->original_name = $file['originalName'];
                $invoicefile->save();
                //dd($invoicefile);

            }
        }


        return redirect('root/admin/upload_file/receipt');
    }


    public function upload () {

        $targetFolder = public_path().DIRECTORY_SEPARATOR.'upload_tmp'.DIRECTORY_SEPARATOR;
        if(!file_exists($targetFolder))
        {
            $dir = File::makeDirectory($targetFolder, 0777, true, true);
        }
        //dd($targetFolder);
        if (!empty(Request::hasFile('file'))) //originalName
        {
            $name =  md5(Request::file('file')->getFilename());//getClientOriginalName();
            $extension = Request::file('file')->getClientOriginalExtension();
            $targetName = $name.".".$extension;


            if(Request::file('file')->move($targetFolder,$targetName)) {
                //if image
                $isImage = 0;
                if(in_array($extension, ['jpeg','jpg','gif','png'])) {
                    $isImage = 1;
                    $this->reduceImgQuality($name,$extension,$targetFolder);
                }
                return response()->json([
                        'name'      => $targetName,
                        'mime'      => Request::file('file')->getClientMimeType(),
                        'oldname'   => Request::file('file')->getClientOriginalName(),
                        'isImage'   => $isImage
                    ]
                );
            }else return '';
        }
    }

    public function searchreceipt()
    {

        if (Request::get('id')) {
            $invoice = Invoice::find(Request::get('id'));
            //dd($invoice);
            if ($invoice) {
                $data = '1';
            } else {
                $data = '2';
            }
        } else {
            $data = '2';
        }


        return response()->json($data);
    }

    public function createLoadBalanceDir ($name) {
        $targetFolder = public_path().DIRECTORY_SEPARATOR.'upload_tmp'.DIRECTORY_SEPARATOR;
        $folder = substr($name, 0,2);
        $pic_folder = 'bills/'.$folder;
        $directories = Storage::disk('s3')->directories('bills'); // Directory in Amazon
        if(!in_array($pic_folder, $directories))
        {
            Storage::disk('s3')->makeDirectory($pic_folder);
        }
        $full_path_upload = $pic_folder."/".$name;
        $upload = Storage::disk('s3')->put($full_path_upload, file_get_contents($targetFolder.$name), 'public');
        File::delete($targetFolder.$name);
        return $folder."/";
    }

    public function getReceiptForAdjust() {
        if(Request::isMethod('post')) {

            $bill = Invoice::where('type',1)->where('payment_status',2)->where('id',Request::get('id'))->first();
            if( $bill ) {
                $unit_list = [];
                $unit_list += PropertyUnit::where('property_id',$bill->property_id)->where('active',true)->orderBy(DB::raw('natsortInt(unit_number)'))->pluck('unit_number','id')->toArray();
                $bank = new Bank;
                $bank_list = $bank->getBankList(false,$bill->property_id);
            }
            return view('fees-bills.adjust-receipt-form')->with(compact('bill','unit_list','bank_list'));

        } else {
            return view('fees-bills.adjust-receipt');
        }
    }

    public function adjustReceipt() {
        if(Request::isMethod('post')) {
            
			$change_payment_type = $change_payment_date = false;
		
            $receipt = Invoice::find(Request::get('id'));

            $validDate = true;
            $msg = [];
            if( !$this->validateDate(Request::get('due_date')) ) {
                $validDate = false;
                $msg[] = "วันที่กำหนดชำระไม่ถูกต้อง";
            }

            if( !$this->validateDate(Request::get('receipt_date')) ) {
                $validDate = false;
                $msg[] = "วันที่ออกใบเสร็จไม่ถูกต้อง";
            }

            if( !$this->validateDate(Request::get('payment_date')) ) {
                $validDate = false;
                $msg[] = "วันที่ชำระเงินไม่ถูกต้อง";
            }

            if( !$validDate ) {
                $msg = implode('<br/>',$msg);
                Request::session()->flash('class', 'warning');
                Request::session()->flash('message', $msg);
                return redirect()->back()->withInput();

            } else {
                
                $old_payment_type           = $receipt->payment_type;
                $receipt->timestamps        = false;
                $receipt->ref_no            = Request::get('ref_no');
                $receipt->due_date          = Request::get('due_date');
                $receipt->updated_at        = Request::get('receipt_date');
                $receipt->remark            = Request::get('remark');
                
                if($receipt->payment_type != Request::get('payment_type')) {
                    $change_payment_type = true;
                }

                if($receipt->payment_date != Request::get('payment_date')) {
                    $change_payment_date = true;
                }

                $receipt->payment_type      = Request::get('payment_type');
                $receipt->payment_date      = Request::get('payment_date');

                // if payment method was changed
                if( $old_payment_type == 1 && $receipt->payment_type == 2 ) {
                    // if cash to bank transfer
                    
                    //check if cash on hand was transfered to bank account
                    if( $receipt->cash_on_hand_transfered ) {
                        Request::session()->flash('class', 'warning');
                        Request::session()->flash('message', 'ไม่สามารถแก้ไขประเภทการชำระเงินได้เนื่องจากใบเสร็จรับเงินนี้ถูกนำฝากจากรายการเงินสดในมือแล้ว');
                        return redirect()->back()->withInput();
                    }
                    // update bank transfer date in receipt
                    $receipt->bank_transfer_date = $receipt->payment_date;
                    $receipt->transfered_to_bank = true;

                    // Save Bank transfer transaction
                    $bt     = new BankTransaction;
                    $bt->saveBankRevenueTransaction($receipt,Request::get('bank_id'));
                    $bank   = new Bank;
                    $bank->updateBalance (Request::get('bank_id'),$receipt->final_grand_total);

                    //Save transaction
                    foreach (Request::get('transaction') as $t) {
                        $transaction = Transaction::find($t['id']);
                        $transaction->timestamps            = false;
                        $transaction->detail                =  $t['detail'];
                        $transaction->bank_transfer_date    =  $receipt->bank_transfer_date;
                        $transaction->save();
                    }

                } else if ( $old_payment_type == 2 && $receipt->payment_type == 1 ) {
                    // if bank transfer to cash

                    // update bank transfer date in receipt
                    $receipt->bank_transfer_date = null;
                    $receipt->transfered_to_bank = false;
                    
                    $bt     = $receipt->bankTransaction;
                    $bank   = new Bank;
                    $bank->updateBalance ( $bt->bank_id, $receipt->final_grand_total * -1 );
                    $bt->delete();

                    foreach (Request::get('transaction') as $t) {
                        $transaction = Transaction::find($t['id']);
                        $transaction->timestamps            = false;
                        $transaction->detail                =  $t['detail'];
                        $transaction->bank_transfer_date    =  null;
                        $transaction->save();
                    }
                } else {
                    foreach (Request::get('transaction') as $t) {
                        $transaction = Transaction::find($t['id']);
                        $transaction->timestamps            = false;
                        $transaction->detail                =  $t['detail'];
                        $transaction->save();
                    }
                }

                if( $change_payment_date ) {
                    //if payment date was change
                    if( $old_payment_type == 2 && $receipt->payment_type == 2 ) {
                        // then update bank transfer date in bank log
                        $receipt->bank_transfer_date = $receipt->payment_date;

                        $bt = $receipt->bankTransaction;
                        $bt->timestamps    = false;
                        $bt->transfer_date = $receipt->payment_date;
                        $bt->save();
                    }

                    foreach (Request::get('transaction') as $t) {
                        $transaction = Transaction::find($t['id']);
                        $transaction->timestamps       = false;
                        $transaction->payment_date     =  $receipt->payment_date;
                        $transaction->save();
                    }
                }

                if( $receipt->save() ) {
                    Request::session()->flash('class', 'success');
                    Request::session()->flash('message', "บันทึกข้อมูลใบเสร็จเลขที่ ".$receipt->receipt_no_label." เรียบร้อยแล้ว");
                    return redirect('root/admin/edit/receipt');
                } else {
                    Request::session()->flash('class', 'warning');
                    Request::session()->flash('message', "เกิดความผิดพลาด ไม่สามารถบันทึกข้อมูลใบเสร็จรับเงินได้");
                    return redirect()->back()->withInput();
                } 
            }
		}
    }

    public function validateDate ($dt) {
        if( $dt == date('Y-m-d H:i:s',strtotime($dt)) ) {
            // date is in fact in one of the above formats
            return true;
        } else {
            return false;
        }
    }
}
