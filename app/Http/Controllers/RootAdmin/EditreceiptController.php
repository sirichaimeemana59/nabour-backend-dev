<?php

namespace App\Http\Controllers\RootAdmin;

use Request;
use App\Http\Controllers\Controller;
use File;
use App\InvoiceFile;
use App\Invoice;
use League\Flysystem\AwsS3v2\AwsS3Adapter;

use Storage;

class EditreceiptController extends Controller
{
    public function __construct () {
        $this->middleware('admin');
    }


    public function index()
    {
        return view('Editreceipt.Editreceipt');
    }


    public function create()
    {

           $count =count(Request::get('attachment'));

        $invoice = new Invoice;
        $invoicefile = InvoiceFile::where('invoice_id','=',(Request::get('id-invoice')))
            ->where('status_delete','=','0');
        $invoicefile = $invoicefile->get();
        $id = Request::get('id-invoice');

        $count_invoice_file = count($invoicefile);

        $screen = $count + $count_invoice_file;

        if($screen <= 3){
           foreach (Request::get('attachment') as $key => $file) {
                $path = $this->createLoadBalanceDir($file['name']);

                $invoicefile = new InvoiceFile;
                $invoicefile->invoice_id  = $id;
                $invoicefile->name = $file['name'];
                $invoicefile->url = $path;
                $invoicefile->file_type = $file['mime'];
                $invoicefile->is_image	= $file['isImage'];
                $invoicefile->original_name	= $file['originalName'];
                $invoicefile->save();

            }
        }else{
            $count_test = 1;
            return view('Editreceipt.Editreceipt')->with(compact('count_test'));
        }
        //$invoice1 = Invoice::find(Request::get('id-invoice'));

        //dump($invoicefile);

        //dd($id);
//        if($invoicefile){
//            $invoicefile = [];
//            foreach (Request::get('attachment') as $key => $file) {
//                $path = $this->createLoadBalanceDir($file['name']);
//
//                $invoicefile[] = InvoiceFile::find($invoicefile->id)([
//                    'name' => $file['name'],
//                    'url' => $path,
//                    'file_type' => $file['mime'],
//                    'is_image'	=> $file['isImage'],
//                    'original_name'	=> $file['originalName']
//                ]);
//            }$invoice->invoiceFile()->saveMany($invoicefile);
//            //$invoice->invoiceFile()->saveMany($invoicefile);
//            //dd($invoicefile);
//            } else{
            //$invoicefile = [];

            //}

        return redirect('root/admin/upload_file/receipt');
    }

    public function searchreceipt()
    {

        if (Request::get('id')) {
            $invoice = Invoice::find(Request::get('id'));
            //dd($invoice);
            if ($invoice) {
                $receipt = Invoice::with('property','invoiceFile')
                    ->where('type', 1)
                    ->where('payment_status', 2)
                    //->whereHas('invoiceFile', function ($q) {
                            //$q ->where('status_delete',0);
                        //})
//                    ->where('status_delete',0)
                    ->where('id', Request::get('id'))->first();

                //dd($receipt);
                if ($receipt) {
                    if ($receipt->property_unit)
                        $receipt->load('property_unit');
                    if ($receipt->payment_type == 1) $receipt->payment_label = trans('messages.feesBills.cash');
                    elseif ($receipt->payment_type == 2) $receipt->payment_label = trans('messages.feesBills.transfer');
                    else $receipt->payment_label = trans('messages.feesBills.substract');

                    if ($receipt->is_retroactive_record)
                        $receipt->receipt_type = "บันทึกรายรับ";
                    else if ($receipt->is_revenue_record)
                        $receipt->receipt_type = "บันทึกรายรับยกมา";
                    else $receipt->receipt_type = "ใบเสร็จทั่วไป";

                    if ($receipt->property_unit) {
                        $receipt->to = $receipt->property_unit->unit_number;
                    } else {
                        $receipt->to = $receipt->payer_name;
                    }

                    if ($receipt->receipt_no_label)
                        $receipt->receipt_no = $receipt->receipt_no_label;
                $data = $receipt;
            }
            }else {
                $data= '2';
            }
        } else {
            $data = '2';
        }
//        $data = $data->toArray();
//        $data_["status"] = $data;


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

    public function delete(){
        //dd(Request::get('file-id'));
//        if(!empty(Request::get('delete_img'))) {
//            $remove = Request::get('delete_img');
//            // Remove old files
//            if(!empty($remove['event-file']))
//                foreach ($remove['event-file'] as $file) {
                    $file = InvoiceFile::find(Request::get('file-id'));
                    $file->status_delete = 1;
                    $file->save();
       // dd($file);
                    //$this->removeFile($file->name);$file->delete();
                //}
        //}
        return redirect('root/admin/upload_file/receipt');
    }

    public function removeFile ($name) {
        $folder = substr($name, 0,2);
        $file_path = 'event-file/'.$folder."/".$name;
        if(Storage::disk('s3')->has($file_path)) {
            Storage::disk('s3')->delete($file_path);
        }
    }


}
