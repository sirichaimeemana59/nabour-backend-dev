<?php

namespace App\Http\Controllers\RootAdmin;

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
use App\BackendModel\service_quotation;
use App\BackendModel\LeadTable;
use App\BackendModel\User;
use App\BackendModel\Quotation;
use App\BackendModel\Quotation_transaction;
use App\BackendModel\Products;
use App\success;
use App\BackendModel\Customer;
use App\BackendModel\contract;

class ContractsignController extends Controller
{

    public function index($quotation_code = null , $lead_id = null)
    {
        $quotation = new Quotation;
        $quotation = $quotation->where('lead_id',$lead_id);
        $quotation = $quotation->first();

        $p = new Province;
        $provinces = $p->getProvince();

        return view('contract.contractdocument')->with(compact('quotation','provinces'));
    }


    public function create($id = null, $quo_id = null)
    {
        $search = new contract;
        $search = $search->where('quotation_id', $quo_id);
        $search = $search->first();

        //dd($search);

        if(!empty($search)){
            $quotation1 = new Quotation;
            $quotation1 = $quotation1->where('lead_id', $id);
            $quotation1 = $quotation1->first();

            $lead = new Customer;
            $lead = $lead->where('id', $id);
            $lead = $lead->first();

            $contract = new contract;
            $contract = $contract->where('quotation_id', $quo_id);
            $contract = $contract->first();


//            $date=date("Y-m-d");
//            $cut_date_now=explode("-",$date);
//
//            $singg = contract::whereYear('created_at', '=', $cut_date_now[0])
//                ->whereMonth('created_at', '=', $cut_date_now[1])
//                ->get();
//            $sing=$singg->max('contract_code');


            return view('contract.contract_update')->with(compact('quotation1','lead','quo_id','contract','search'));

        }else{
            $quotation1 = new Quotation;
            $quotation1 = $quotation1->where('lead_id', $id);
            $quotation1 = $quotation1->first();

            $lead = new Customer;
            $lead = $lead->where('id', $id);
            $lead = $lead->first();

            $contract = new contract;


            $date=date("Y-m-d");
            $cut_date_now=explode("-",$date);

            $singg = contract::whereYear('created_at', '=', $cut_date_now[0])
                ->whereMonth('created_at', '=', $cut_date_now[1])
                ->get();
            $sing=$singg->max('contract_code');


            return view('contract.contract_form')->with(compact('quotation1','lead','sing','quo_id','contract'));
        }


    }


    public function save()
    {
        $contract = new contract;
        $contract->contract_code        = Request::get('contract_code');
        $contract->start_date           = Request::get('start_date');
        $contract->end_date             = Request::get('end_date');
        $contract->contract_type        = Request::get('contract_type');
        $contract->grand_total_price    = Request::get('price');
        $contract->sales_id             = Request::get('sales_id');
        $contract->customer_id          = Request::get('customer_id');
        $contract->payment_term_type    = Request::get('payment_term_type');
        $contract->contract_status      = 0;
        $contract->quotation_id         = Request::get('quotation_id');
        $contract->person_name          = Request::get('person_name');
        $contract->save();

        //dump($contract->toArray());
        return redirect('service/quotation/add/'.Request::get('customer_id'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update()
    {
        $contract = contract::find(Request::get('id'));
        $contract->contract_code        = Request::get('contract_code');
        $contract->start_date           = Request::get('start_date');
        $contract->end_date             = Request::get('end_date');
        $contract->contract_type        = Request::get('contract_type');
        $contract->grand_total_price    = Request::get('price');
        $contract->sales_id             = Request::get('sales_id');
        $contract->customer_id          = Request::get('customer_id');
        $contract->payment_term_type    = Request::get('payment_term_type');
        $contract->contract_status      = 0;
        $contract->quotation_id         = Request::get('quotation_id');
        $contract->person_name          = Request::get('person_name');
        $contract->save();
        //dump($contract->toArray());
        return redirect('service/quotation/add/'.Request::get('customer_id'));
    }


    public function destroy($id)
    {
        //
    }
}
