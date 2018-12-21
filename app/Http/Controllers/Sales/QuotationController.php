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
use App\BackendModel\User as BackendUser;

class QuotationController extends Controller
{

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
            $service = $service->where('status', '2');
            $service = $service->get();

            $package = new Products;
            $package = $package->where('status', '1');
            $package = $package->get();

            $lead = new Customer;
            $lead = $lead->where('id', $id);
            $lead = $lead->first();

            $quotation = new Quotation_transaction;
            $max_cus = $quotation->max('quotation_code');

            return view('quotation.quotation_form')->with(compact('service', 'package', 'lead', 'id', 'max_cus'));
        }else{

            $quotation1 = new Quotation;
            $quotation1 = $quotation1->where('lead_id', $id);
            $quotation1 = $quotation1->get();

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


            //dump($quotation1->toArray());
            return view('quotation.list_quotation')->with(compact('lead','quotation1','id','remark','status','lead'));
        }
        //return ($id);
    }

    public function create()
    {

        $quotation = new Quotation;
        $id_package = Request::get('id_package');
        $cut_id = explode("|",$id_package);

        $quotation->product_id             = $cut_id[0];
        $quotation->quotation_code         = Request::get('quotation_code');
        $quotation->product_amount         = Request::get('project_package');
        $quotation->month_package          = Request::get('month_package');
        $quotation->unit_price             = str_replace(',', '',Request::get('unit_package'));
        $quotation->total                  = str_replace(',', '',Request::get('total_package'));
        $quotation->product_price_with_vat = str_replace(',', '',Request::get('grand_total'));
        $quotation->product_vat            = str_replace(',', '',Request::get('vat'));
        $quotation->grand_total_price      = str_replace(',', '',Request::get('sub_total'));
        $quotation->discount               = str_replace(',', '',Request::get('discount'));
        $quotation->invalid_date           = Request::get('invalid_date');
        $quotation->remark                 = 0;
        $quotation->sales_id               = Request::get('sales_id');
        $quotation->lead_id                = Request::get('lead_id');
        $quotation->send_email_status      = 0;
        $quotation->save();

        //dump($quotation->toArray());

        //dd(Request::get('quotation_code'));
        $search = new Quotation;
        $search = $search->where('quotation_code',Request::get('quotation_code'));
        $search = $search->first();



        foreach (Request::get('transaction') as $t) {
            $trans = new Quotation_transaction;
            $trans->package_id 			= $t['service'];
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

        if(Auth::user()->role !=2){
            return redirect('service/quotation/add/'.Request::get('lead_id'));
        }else{
            return redirect('service/sales/quotation/add/'.Request::get('lead_id'));
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

        $quotation_service = new Quotation_transaction;
        $quotation_service = $quotation_service->where('quotation_id', $id);
        $quotation_service = $quotation_service->get();

        $service = new Products;
        $service = $service->where('status', '2');
        $service = $service->get();

        $package = new Products;
        $package = $package->where('status', '1');
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

                $quotation_service = Quotation_transaction::find($q['id']);
                $quotation_service->lead_id             = $q['lead_id'];
                $quotation_service->package_id          = $q['service'];
                $quotation_service->project_package     = empty($q['project'])?'0':str_replace(',', '',$q['project']);
                $quotation_service->month_package       = empty($q['price'])?'0':$q['price'];
                $quotation_service->unit_package        = empty($q['unit_price'])?'0':str_replace(',', '',$q['unit_price']);
                $quotation_service->total_package       = empty($q['total1'])?'0':str_replace(',', '',$q['total1']);
                $quotation_service->save();
                //dump($quotation_service->toArray());
            }
            $quotation = new Quotation;
            $quotation = $quotation->find(Request::get('quotation_code'));

            $quotation->product_id             = Request::get('package_id');
            $quotation->quotation_code         = Request::get('quotation_code1');
            $quotation->product_amount         = Request::get('project_package');
            $quotation->month_package          = Request::get('month_package');
            $quotation->unit_price             = str_replace(',', '',Request::get('unit_package'));
            $quotation->total                  = str_replace(',', '',Request::get('total_package'));
            $quotation->product_price_with_vat = str_replace(',', '',Request::get('grand_total'));
            $quotation->product_vat            = str_replace(',', '',Request::get('vat'));
            $quotation->grand_total_price      = str_replace(',', '',Request::get('sub_total'));
            $quotation->discount               = str_replace(',', '',Request::get('discount'));
            $quotation->invalid_date           = Request::get('invalid_date');
            $quotation->remark                 = 0;
            $quotation->sales_id               = Request::get('sales_id');
            $quotation->lead_id                = Request::get('lead_id');
            $quotation->send_email_status      = 0;
            $quotation->save();
            //dd($quotation);
        }


        //dump($quotation->toArray());
        if(Auth::user()->role !=2){
            return redirect('service/quotation/add/'.Request::get('lead_id'));
        }else{
            return redirect('service/sales/quotation/add/'.Request::get('lead_id'));
        }
    }

    public function destroy($id)
    {
        //
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
            $quotation = $quotation->get();

            $quotation_service = new Quotation_transaction;
            $quotation_service = $quotation_service->where('quotation_code', Request::get('id'));
            $quotation_service = $quotation_service->get();

            return view('quotation.quotation_detail')->with(compact('quotation','quotation_service'));
        }
    }

    public function print($id){

        $quotation = new Quotation;
        $quotation = $quotation->where('quotation_code', $id);
        $quotation = $quotation->first();

        $p = new Province;
        $provinces = $p->getProvince();

        $quotation1 = new Quotation;
        $quotation1 = $quotation1->where('quotation_code', $id);
        $quotation1 = $quotation1->first();

        //dump($quotation1->toArray());
        $quotation_service = new Quotation_transaction;
        $quotation_service = $quotation_service->where('quotation_code', $id);
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
       return redirect('service/quotation/add/'.$id);

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

        $quotations = $quotations->orderBy('quotation_code','desc')->paginate(25);
        if( Request::ajax() ) {
            return view('quotation.list-element')->with(compact('quotations'));

        } else {
            $customers = Customer::where('role',1)->select('firstname','lastname','id')->get();
            if( $customers ) $customers = $customers->toArray();
            return view('quotation.list-sales')->with(compact('quotations','customers'));
        }
    }
}
