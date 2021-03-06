<?php

namespace App\Http\Controllers\Sales;

use Request;
use Auth;
use Redirect;

use App\Http\Controllers\Controller;
use App\Province;
use App\PropertyContract;
use App\BackendModel\service_quotation;
use App\BackendModel\Quotation;
use App\BackendModel\Quotation_transaction;
use App\BackendModel\Products;
use App\success;
use App\BackendModel\Customer;
use App\BackendModel\contract;
use App\BackendModel\monthly_counter;
use Carbon\Carbon;

class QuotationController extends Controller
{
    public function __construct () {
        $this->middleware('sales');
    }

    public function index($id = null,$ip = null)
    {
        $search = new Quotation;
        $search = $search->where('lead_id',$id);
        $search = $search->first();

        $lead = new Customer;
        $lead = $lead->where('id',$id);
        $lead = $lead->first();

        if($search == null or $ip == 1) {
            $service = new Products;
            $service = $service->where('status', '2')->where('is_delete','=','f');
            $service = $service->get();

            $package = new Products;
            $package = $package->where('status', '1')->where('is_delete','=','f');
            $package = $package->get();

            $lead = new Customer;
            $lead = $lead->where('id', $id);
            $lead = $lead->first();

            $quotation = new Quotation_transaction;
            $max_cus = $quotation->max('quotation_code');

            $max_coun = new monthly_counter;
            $max_quotation_counter	 = $max_coun->max('quotation_counter');

            //dd($max_quotation_counter);
            $month = Carbon::now()->month;
            $year = Carbon::now()->year;
            $date_period = $year.$month;

            $date_period_arr = str_split($date_period,4);
            $date_period_format = $date_period_arr[0].str_pad($date_period_arr[1], 2, '0', STR_PAD_LEFT);

            if($max_quotation_counter != null){
                $max_counter = $max_quotation_counter+1;
            }else{
                $max_counter = 1;
            }
            //$max_counter = 105;
            if(!empty($max_cus)){
                $new_id="000".$max_counter;
                $count=strlen($new_id);
                if($count>4){
                    $count_c=$count-4;
                    $cut_new_id=substr($new_id,$count_c);
                    $cus="QU".$date_period_format.$cut_new_id;
                }else{
                    $cus="QU".$date_period_format.$new_id;
                }
            }else{
                $new_id="000".$max_counter;
                $cus="QU".$date_period_format.$new_id;
            }

            return view('quotation.quotation_form')->with(compact('service', 'lead', 'id', 'max_cus','package','cus','date_period_format','max_counter'));
        }else{

            $quotation1 = new Quotation;
            $quotation1 = $quotation1->where('lead_id', $id);
            $quotation1 = $quotation1->orderBy('quotation_code','DESC')->get();


            $remark = new Quotation;
            $remark = $remark->where('lead_id', $id);
            $remark = $remark->where('remark', 1);
            $remark = $remark->count();

            $status = new Quotation;
            $status = $status->where('lead_id', $id);
            $status = $status->first();

            $lead = new Customer;
            $lead = $lead->where('id', $id);
            $lead = $lead->first();
            //dd($status);

            $count_ = new contract;
            $count_ = $count_->where('customer_id', $id)->where('status','=',1);
            $count_ = $count_->count();

            //dump($quotation1->toArray());
            return view('quotation.list_quotation')->with(compact('lead','quotation1','id','remark','status','lead','count_'));
        }
        //return ($id);
    }

    public function create()
    {

        $quotation = new Quotation;
        $id_package = Request::get('id_package');
        $cut_id = explode("|",$id_package);

        $grand_total   =str_replace(',','',Request::get('grand_total'));
        $vat            =str_replace(',','',Request::get('vat'));
        $discount       =str_replace(',','',Request::get('discount'));

        $total =  ($grand_total+$discount)-$vat;

        //dd($total);

        $quotation->quotation_code         = Request::get('quotation_code');
        $quotation->product_price_with_vat = str_replace(',', '',Request::get('grand_total'));
        $quotation->product_vat            = str_replace(',', '',Request::get('vat'));
        $quotation->grand_total_price      = str_replace(',', '',Request::get('total'));
        $quotation->discount               = str_replace(',', '',Request::get('discount'));
        $quotation->invalid_date           = Request::get('invalid_date');
        $quotation->remark                 = 0;
        $quotation->sales_id               = Request::get('sales_id');
        $quotation->lead_id                = Request::get('lead_id');
        $quotation->send_email_status      = 0;
        $quotation->property_name          = Request::get('property_name');
        $quotation->save();
        //dump($quotation->toArray());

        $search = new Quotation;
        $search = $search->where('quotation_code',Request::get('quotation_code'));
        $search = $search->first();
        //dd($search);

        foreach (Request::get('transaction') as $t) {
            $trans = new Quotation_transaction;
            $service_id = explode("|",$t['service']);
            $trans->package_id 			= $service_id[0];
            $trans->project_package		= empty($t['project'])?'0':str_replace(',', '',$t['project']);
            $trans->month_package   	= empty($t['price'])?'0':$t['price'];
            $trans->unit_package 		= empty($t['unit_price'])?'0':str_replace(',', '',$t['unit_price']);
            $trans->total_package 		= empty($t['total'])?'0':str_replace(',', '',$t['total']);
            $trans->lead_id 		    = Request::get('lead_id');
            $trans->quotation_code 		= Request::get('quotation_code');
            $trans->quotation_id 		= $search->id;
            $trans->save();

            //dd($trans);
            //dump($trans->toArray());
        }

        $new_monthly_counter = new monthly_counter;
        $new_monthly_counter->quotation_id = $search->id;
        $new_monthly_counter->date_period = Request::get('date_period_format');
        $new_monthly_counter->quotation_counter = Request::get('max_counter');
        $new_monthly_counter->save();

        if(Auth::user()->role !=2){
            return redirect('customer/service/quotation/add/'.Request::get('lead_id'));
        }else{
            return redirect('customer/service/sales/quotation/add/'.Request::get('lead_id'));
        }



        //dump($quotation->toArray());
    }

    public function store(Request $request)
    {
        //
    }

    public function show()
    {
        return view('quotation.list_quotation');
    }

    public function edit($id)
    {
        $quotation = new Quotation;
        $quotation = $quotation->where('id', $id);
        $quotation = $quotation->first();

//        $quotation_service = new Quotation_transaction;
//        $quotation_service = $quotation_service->where('quotation_id', $id);
//        $quotation_service = $quotation_service->get();

        $quotation_service = Quotation_transaction::join('product', 'product.id', '=', 'quotation_transaction.package_id')
            ->orderBy('product.status', 'asc')
            ->select('quotation_transaction.*')
            ->where('quotation_id', $id)->get();


        $service = new Products;
        $service = $service->where('status', '2')->where('is_delete','=','f');
        $service = $service->get();

        $package = new Products;
        $package = $package->where('status', '1')->where('is_delete','=','f');
        $package = $package->get();

       /* $lead = new LeadTable;
        $lead = $lead->where('id', $id);
        $lead = $lead->first();*/

        return view('quotation.quotation_update_form')->with(compact('quotation','package','quotation_service','service','package'));
    }

    public function update()
    {
        if( !empty(Request::get('_data'))) {
            foreach ( Request::get('_data') as $q) {
                $service_id = explode("|",$q['service']);
                $quotation_service = Quotation_transaction::find($q['id_']);
                //dd($quotation_service);
                $quotation_service->lead_id             = $q['lead_id'];
                $quotation_service->package_id          = $service_id[0];
                $quotation_service->project_package     = empty($q['project'])?'0':str_replace(',', '',$q['project']);
                $quotation_service->month_package       = empty($q['price'])?'0':str_replace(',', '',$q['price']);
                $quotation_service->unit_package        = empty($q['unit_price'])?'0':str_replace(',', '',$q['unit_price']);
                $quotation_service->total_package       = empty($q['total1'])?'0':str_replace(',', '',$q['total1']);
                $quotation_service->save();
                //dump($quotation_service->toArray());

            }

            $search = new Quotation;
            $search = $search->where('quotation_code',Request::get('quotation_code1'));
            $search = $search->first();

            if( !empty(Request::get('transaction'))) {
                foreach (Request::get('transaction') as $t) {
                    $trans = new Quotation_transaction;
                    $service_id = explode("|", $t['service']);
                    $trans->package_id = $service_id[0];
                    $trans->project_package = empty($t['project']) ? '0' : str_replace(',', '', $t['project']);
                    $trans->month_package = empty($t['price']) ? '0' : $t['price'];
                    $trans->unit_package = empty($t['unit_price']) ? '0' : str_replace(',', '', $t['unit_price']);
                    $trans->total_package = empty($t['total']) ? '0' : str_replace(',', '', $t['total']);
                    $trans->lead_id = Request::get('lead_id');
                    $trans->quotation_code = Request::get('quotation_code1');
                    $trans->quotation_id = $search->id;
                    $trans->save();

                    //dd($trans);
                    //dump($trans->toArray());
                }
            }

            $grand_total_   =str_replace(',','',Request::get('grand_total_'));
            $vat            =str_replace(',','',Request::get('vat'));
            $discount       =str_replace(',','',Request::get('discount'));

            $_total =  ($grand_total_- $vat)+$discount;

            $quotation = new Quotation;
            $quotation = $quotation->find(Request::get('quotation_code'));

            $quotation->quotation_code         = Request::get('quotation_code1');
            $quotation->product_price_with_vat = str_replace(',', '',Request::get('grand_total_'));
            $quotation->product_vat            = str_replace(',', '',Request::get('vat'));
            $quotation->grand_total_price      = str_replace(',', '',$_total);
            $quotation->discount               = str_replace(',', '',Request::get('discount'));
            $quotation->invalid_date           = Request::get('invalid_date');
            $quotation->remark                 = 0;
            $quotation->sales_id               = Request::get('sales_id');
            $quotation->lead_id                = Request::get('lead_id');
            $quotation->send_email_status      = 0;
            $quotation->property_name          = Request::get('property_name');
            $quotation->save();
            //dd($quotation);
            //dump($quotation->toArray());
        }


        //dump($quotation->toArray());
        if(Auth::user()->role !=2){
            return redirect('customer/service/quotation/add/'.Request::get('lead_id'));
        }else{
            return redirect('customer/service/sales/quotation/add/'.Request::get('lead_id'));
        }
    }

    public function destroy()
    {
        $quotation = Quotation::find(Request::get('id2'))->delete();

        if(Request::get('page') == 1){
            return redirect('customer/service/sales/quotation/add/'.Request::get('lead_id'));
        }else{
            return redirect('sales/quotation/list');
        }
        //return redirect('sales/quotation/list');
        //return Request::get('id2');
    }

    public function check($id = null , $lead_id = null)
    {
        $quotation = Quotation::find($id);
        $quotation->remark =1;
        $quotation->save();
        return redirect('/service/quotation/add/'.$lead_id);
    }

    public function check_out($id = null , $lead_id = null)
    {
        $quotation = Quotation::find($id);
        $quotation->remark = 0;
        $quotation->save();
        return redirect('/service/quotation/add/'.$lead_id);
    }


    public function detail()
    {
        if(Request::isMethod('post')) {

            $quotation = new Quotation;
            $quotation = $quotation->where('quotation_code', Request::get('id'));
            $quotation = $quotation->first();

            $quotation_service = new Quotation_transaction;
            $quotation_service = $quotation_service->where('quotation_code', Request::get('id'));
            $quotation_service = $quotation_service->get();

            return view('quotation.quotation_detail')->with(compact('quotation','quotation_service'));
        }
    }

    public function print($id){

        $quotation = new Quotation;
        $quotation = $quotation->where('id', $id);
        $quotation = $quotation->first();

        $p = new Province;
        $provinces = $p->getProvince();

        $quotation1 = new Quotation;
        $quotation1 = $quotation1->where('id', $id);
        $quotation1 = $quotation1->first();

        //dump($quotation1->toArray());
        $quotation_service = new Quotation_transaction;
        $quotation_service = $quotation_service->where('quotation_id', $id);
        $quotation_service = $quotation_service->get();

        return view('report.report_quotation')->with(compact('quotation','provinces','quotation1','quotation_service'));
    }

    public function success($id)
    {
        $quotation = success::find($id);
        $quotation->status = 1;
        $quotation->save();

        $lead = Customer::find($id);
         //dd($lead->id);
        $customer = new Customer;
        $customer->firstname        = $lead->firstname;
        $customer->lastname         = $lead->lastname;
        $customer->phone            = $lead->phone;
        $customer->email            = $lead->email;
        $customer->address          = $lead->address;
        $customer->province         = $lead->province;
        $customer->company_name     = $lead->company_name;
        $customer->channel          = $lead->channel;
        $customer->type             = $lead->type;
        $customer->active_status    = 'f';
        //$customer->save();
        //dump($customer->toArray());
            //dd($quotation);
       return redirect('customer/service/quotation/add/'.$id);

    }

    public function cancel($id)
    {
        $quotation = success::find($id);
        $quotation->status = 0;
        $quotation->save();

        //dd($quotation);
        return redirect('service/quotation/add/'.$id);

    }

    public function quotationList ()
    {
        $quotations = Quotation::where('sales_id', Auth::user()->id);

        if( Request::get('q_no') ) {
            $quotations = $quotations->where('quotation_code','like','%'.Request::get('q_no').'%');
        }

        if( Request::get('leads_id') ) {
            $quotations = $quotations->where('lead_id',Request::get('leads_id'));
        }

        $quotations = $quotations->orderBy('quotation_code','desc')->paginate(500);
        if( Request::ajax() ) {
            return view('quotation.list-element-sales')->with(compact('quotations'));

        } else {
            $customers = Customer::where('role',1)->where('sale_id', Auth::user()->id)->select('firstname','lastname','id')->get();
            if( $customers ) $customers = $customers->toArray();
            return view('quotation.list-sales')->with(compact('quotations','customers'));
        }
    }

    public function delete_quotation(){
        $quotaion = Quotation_transaction::find(Request::get('id_quotation'));
        $quotaion->delete();

        return redirect('customer/service/sales/quotation/update/form/'.Request::get('id'));
    }
}
