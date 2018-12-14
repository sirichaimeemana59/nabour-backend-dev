<?php

namespace App\Http\Controllers\Quotation;

use Request;
use Auth;
use Redirect;

use App\Http\Controllers\Controller;
use App\PropertyUnit;
use App\Province;
use App\PropertyFeature;
use App\BillWater;
use App\BillElectric;
use App\PropertyContract;
use App\UserPropertyFeature;
use App\ManagementGroup;
use App\SalePropertyDemo;
use App\Property;
use App\Transaction;
use App\service_quotation;
use App\LeadTable;
use App\BackendModel\User;
use App\BackendModel\Quotation;
use App\BackendModel\Quotation_transaction;
use App\Products;
use App\success;

class QuotationController extends Controller
{

    public function index($id = null,$ip = null)
    {
        $search = new Quotation_transaction;
        $search = $search->where('lead_id',$id);
        $search = $search->first();

        $lead = new LeadTable;
        $lead = $lead->where('id',$id);
        $lead = $lead->first();

        if($search == null or $ip == 1) {
            $service = new Products;
            $service = $service->where('status', '2');
            $service = $service->get();

            $package = new Products;
            $package = $package->where('status', '1');
            $package = $package->get();

            $lead = new LeadTable;
            $lead = $lead->where('id', $id);
            $lead = $lead->first();

            $quotation = new Quotation;
            $max_cus = $quotation->max('quotation_code');

            return view('quotation.quotation_form')->with(compact('service', 'package', 'lead', 'id', 'max_cus'));
        }else{

            $quotation1 = new Quotation_transaction;
            $quotation1 = $quotation1->where('lead_id', $id);
            $quotation1 = $quotation1->get();

            $remark = new Quotation_transaction;
            $remark = $remark->where('remark', 1);
            $remark = $remark->count();

            $status = new Quotation_transaction;
            $status = $status->where('status', 1);
            $status = $status->count();

            //dd($remark);

            //dump($quotation1->toArray());
            return view('quotation.list_quotation')->with(compact('lead','quotation1','id','remark','status'));
        }
        //return ($id);
    }

    public function create()
    {

        foreach (Request::get('transaction') as $t) {
            $trans = new Quotation;
                $trans->package_id 			= $t['service'];
                $trans->project_package		= empty($t['project'])?'0':$t['project'];
                $trans->month_package   	= empty($t['price'])?'0':$t['price'];
                $trans->unit_package 			= empty($t['unit_price'])?'0':$t['unit_price'];
                $trans->total_package 		= empty($t['total'])?'0':$t['total'];
                $trans->lead_id 		    = Request::get('lead_id');
                $trans->quotation_code 		= Request::get('quotation_code');
                $trans->save();
            //dd($trans);
            //dump($trans->toArray());
        }

        $quotation = new Quotation_transaction;
        $id_package = Request::get('id_package');
        $cut_id = explode("|",$id_package);

        $quotation->product_id             = $cut_id[0];
        $quotation->quotation_code         = Request::get('quotation_code');
        $quotation->product_amount         = Request::get('project_package');
        $quotation->month_package          = Request::get('month_package');
        $quotation->unit_price             = Request::get('unit_package');
        $quotation->total                  = Request::get('total_package');
        $quotation->product_price_with_vat = Request::get('grand_total');
        $quotation->product_vat            = Request::get('vat');
        $quotation->grand_total_price      = Request::get('sub_total');
        $quotation->discount               = Request::get('discount');
        $quotation->invalid_date           = Request::get('invalid_date');
        $quotation->remark                 = 0;
        $quotation->sales_id               = Request::get('sales_id');
        $quotation->lead_id                = Request::get('lead_id');
        $quotation->send_email_status      = 0;
        $quotation->save();

        return redirect('customer/leads/list');


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
        $quotation = new Quotation_transaction;
        $quotation = $quotation->where('quotation_code', $id);
        $quotation = $quotation->first();

        $quotation_service = new Quotation;
        $quotation_service = $quotation_service->where('quotation_code', $id);
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

                $quotation_service = Quotation::find($q['id']);
                $quotation_service->lead_id             = $q['lead_id'];
                $quotation_service->package_id          = $q['service'];
                $quotation_service->project_package     = empty($q['project'])?'0':$q['project'];
                $quotation_service->month_package       = empty($q['price'])?'0':$q['price'];
                $quotation_service->unit_package        = empty($q['unit_price'])?'0':$q['unit_price'];
                $quotation_service->total_package       = empty($q['total1'])?'0':$q['total1'];
                $quotation_service->save();
                //dump($quotation_service->toArray());
            }
            $quotation = new Quotation_transaction;
            $quotation = $quotation->find(Request::get('quotation_code'));

            $quotation->product_id             = Request::get('package_id');
            $quotation->quotation_code         = Request::get('quotation_code');
            $quotation->product_amount         = Request::get('project_package');
            $quotation->month_package          = Request::get('month_package');
            $quotation->unit_price             = Request::get('unit_package');
            $quotation->total                  = Request::get('total_package');
            $quotation->product_price_with_vat = Request::get('grand_total');
            $quotation->product_vat            = Request::get('vat');
            $quotation->grand_total_price      = Request::get('sub_total');
            $quotation->discount               = Request::get('discount');
            $quotation->invalid_date           = Request::get('invalid_date');
            $quotation->remark                 = 0;
            $quotation->sales_id               = Request::get('sales_id');
            $quotation->lead_id                = Request::get('lead_id');
            $quotation->send_email_status      = 0;
            $quotation->save();
            //dd($quotation);
        }


        //dump($quotation->toArray());
        return redirect('/customer/leads/list');
    }

    public function destroy($id)
    {
        //
    }
    public function check($id = null , $lead_id = null)
    {
        $quotation = Quotation_transaction::find($id);
        $quotation->remark =1;
        $quotation->save();
        return redirect('/service/quotation/add/'.$lead_id);
    }

    public function check_out($id = null , $lead_id = null)
    {
        $quotation = Quotation_transaction::find($id);
        $quotation->remark = 0;
        $quotation->save();
        return redirect('/service/quotation/add/'.$lead_id);
    }


    public function detail()
    {
        if(Request::isMethod('post')) {

            $quotation = new Quotation_transaction;
            $quotation = $quotation->where('quotation_code', Request::get('id'));
            $quotation = $quotation->get();

            $quotation_service = new Quotation;
            $quotation_service = $quotation_service->where('quotation_code', Request::get('id'));
            $quotation_service = $quotation_service->get();

            return view('quotation.quotation_detail')->with(compact('quotation','quotation_service'));
        }
    }

    public function print($id){

        $quotation = new Quotation_transaction;
        $quotation = $quotation->where('quotation_code', $id);
        $quotation = $quotation->first();

        $p = new Province;
        $provinces = $p->getProvince();

        $quotation1 = new Quotation_transaction;
        $quotation1 = $quotation1->where('quotation_code', $id);
        $quotation1 = $quotation1->first();

        //dump($quotation1->toArray());
        $quotation_service = new Quotation;
        $quotation_service = $quotation_service->where('quotation_code', $id);
        $quotation_service = $quotation_service->get();

        return view('report.report_quotation')->with(compact('quotation','provinces','quotation1','quotation_service'));
    }

    public function success($id)
    {
        $quotation = success::find($id);
        $quotation->status = 1;
        $quotation->save();

            //dd($quotation);
        return redirect('service/quotation/add/'.$id);

    }

}
