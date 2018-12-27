<?php

namespace App\Http\Controllers\RootAdmin;

use Request;
use Auth;
use Redirect;

use App\Http\Controllers\Controller;
use App\Province;
use App\PropertyContract;
use App\BackendModel\service_quotation;
use App\BackendModel\Quotation;
use App\BackendModel\Customer;
use App\BackendModel\contract;
use App\BackendModel\User as BackendUser;
use App\BackendModel\Quotation_transaction;
use App\BackendModel\Products;
//use App\Property;
use App\BackendModel\Property;

class ContractsignController extends Controller
{
    public function __construct () {
        $this->middleware('admin');
    }

    public function index($quotation_code = null,$code = null)
    {
        $quotation = new contract;
        //$quotation = $quotation->where('lead_id',$lead_id);
        $quotation = $quotation->where('id',$quotation_code);
        $quotation = $quotation->first();

        $package = new Products;
        $package = $package->where('status', '1');
        $package = $package->get();

        $quotation_service = new Quotation_transaction;
        $quotation_service = $quotation_service->where('quotation_id', $code);
        $quotation_service = $quotation_service->get();

        $p = new Province;
        $provinces = $p->getProvince();

        return view('contract.contractdocument')->with(compact('quotation','provinces','quotation_service','package'));
    }


    public function create($id = null, $customer_id = null)
    {
        $search = new contract;
        $search = $search->where('quotation_id', $id);
        $search = $search->first();

        //dd($search);

        if(!empty($search)){
            $quotation1 = new Quotation;
            $quotation1 = $quotation1->where('id', $id);
            $quotation1 = $quotation1->first();

            $contract = new contract;
            $contract = $contract->where('quotation_id', $id);
            $contract = $contract->first();

            $count = new contract;
            $count = $count->where('quotation_id', $id)->where('status','=',1);
            $count = $count->count();

            $count_ = new contract;
            $count_ = $count_->where('customer_id', $customer_id)->where('status','=',1);
            $count_ = $count_->count();

            $quotation = new Quotation;
            $quotation = $quotation->where('id', $id);
            $quotation = $quotation->first();

            $quotation_service = new Quotation_transaction;
            $quotation_service = $quotation_service->where('quotation_id', $id);
            $quotation_service = $quotation_service->get();

            $property = new Property;
            $property = $property->get();

            //dd($count_);

            return view('contract.contract_update')->with(compact('quotation1','quo_id','contract','search','count','count_','quotation','quotation_service','property'));

        }else{
            $quotation1 = new Quotation;
            $quotation1 = $quotation1->where('id', $id);
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

            $property = new Property;
            $property = $property->get();

    //dd($quotation1);
            return view('contract.contract_form')->with(compact('quotation1','sing','quo_id','contract','property'));
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
        $contract->quotation_id         = Request::get('quotation_id1');
        $contract->person_name          = Request::get('person_name');
        $contract->property_id          = Request::get('property_id');
        $contract->save();

        //dump($contract->toArray());
        return redirect('customer/service/quotation/add/'.Request::get('customer_id'));
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
        $contract->quotation_id         = Request::get('quotation_id1');
        $contract->person_name          = Request::get('person_name');
        $contract->property_id          = Request::get('property_id');
        $contract->save();
        //dump($contract->toArray());
        return redirect('customer/service/quotation/add/'.Request::get('customer_id'));
    }


    public function approved()
    {
        $contract = contract::find(Request::get('id2'));
        $contract->status = 1;
        $contract->save();

        $quotation = Quotation::find(Request::get('quo_id'));
        $quotation->status = 1;
        $quotation->save();

        $customer = Customer::find(Request::get('customer_id'));
        $customer->role = 0;
        $customer->save();

        //dd($quotation);
        return redirect('contract/list');
        //return (Request::get('id2'));
        //return (Request::get('customer_id'));
    }

    public function contractList () {
        $contracts = new contract;

        if( Request::get('c_no') ) {
            $contracts = $contracts->where('contract_code','like','%'.Request::get('c_no').'%');
        }

        if( Request::get('c_id') ) {
            $contracts = $contracts->where('customer_id',Request::get('c_id'));
        }

        if( Request::get('sale_id') ) {
            $contracts = $contracts->where('sales_id',Request::get('sale_id'));
        }

        $contracts = $contracts->orderBy('contract_code','desc')->paginate(500);

        //dd($contracts);
        if( Request::ajax() ) {
            return view('contract.list-element')->with(compact('contracts'));

        } else {
            $sales      = BackendUser::whereIn('role',[1,2])->pluck('name','id');
            $customers = Customer::where('role',0)->pluck('company_name','id');
            return view('contract.list')->with(compact('contracts','customers','sales'));
        }
    }
}
