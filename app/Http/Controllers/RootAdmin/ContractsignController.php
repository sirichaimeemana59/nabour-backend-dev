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
use App\Property as property_db;
use App\BackendModel\Property;
use App\BackendModel\contract_transaction;
use App\BackendModel\contract_detail;

class ContractsignController extends Controller
{
    public function __construct () {
        $this->middleware('admin');
    }

    public function index($id = null)
    {
        $quotation = new contract;
        //$quotation = $quotation->where('lead_id',$lead_id);
        $quotation = $quotation->where('id',$id);
        $quotation = $quotation->first();



        //dd($quotation_code);
        $package = new Products;
        $package = $package->where('status', '1');
        $package = $package->get();

        $quotation_service = new Quotation_transaction;
        $quotation_service = $quotation_service->where('quotation_id', $quotation->id);
        $quotation_service = $quotation_service->get();

        $contract_property = new contract_transaction;
        $contract_property = $contract_property->where('contract_id', $quotation->contract_code);
        $contract_property = $contract_property->get();

//        $contract_detail = new contract_detail();
//        $contract_detail = $contract_detail->where('contract_code', $quotation->contract_code);
//        $contract_detail = $contract_detail->get();

        $type_array = array();
        foreach ($contract_property as $row){
            //dump($row->property_id)  ;
            $type = property_db::find($row->property_id);
            $type = $type->toArray();

            $type_array[] = $type;

        }
        //dump($type_array);
        $p = new Province;
        $provinces = $p->getProvince();

        return view('contract.contractdocument')->with(compact('quotation','provinces','quotation_service','package','type_array','contract_property'));
    }


    public function create($quotation_id = null,$id = null)
    {
        $search = new contract;
        $search = $search->where('quotation_id', $quotation_id);
        $search = $search->where('id', $id);
        $search = $search->first();



        if(!empty($search)){
            $quotation1 = new Quotation;
            $quotation1 = $quotation1->where('id', $quotation_id);
            $quotation1 = $quotation1->first();

            $contract = new contract;
            $contract = $contract->where('quotation_id', $quotation_id);
            $contract = $contract->where('id', $id);
            $contract = $contract->first();

            $contract_property = new contract_transaction;
            $contract_property = $contract_property->where('contract_id', $contract->contract_code);
            $contract_property = $contract_property->get();

            $contract_detail = new contract_detail();
            $contract_detail = $contract_detail->where('contract_code', $contract->contract_code);
            $contract_detail = $contract_detail->get();

            $count = new contract;
            $count = $count->where('quotation_id', $quotation_id)->where('status','=',1);
            $count = $count->where('id', $id);
            $count = $count->count();

            $count_ = new contract;
            $count_ = $count_->where('customer_id', $quotation1->customer_id)->where('status','=',1);
            $count_ = $count_->where('id', $id);
            $count_ = $count_->count();

            $quotation = new Quotation;
            $quotation = $quotation->where('id', $quotation_id);
            $quotation = $quotation->first();

            $quotation_service = new Quotation_transaction;
            $quotation_service = $quotation_service->where('quotation_id', $quotation_id);
            $quotation_service = $quotation_service->get();

            $property = new Property;
            $property = $property->get();

            //dd($contract);

            return view('contract.contract_update')->with(compact('quotation1','contract','search','count','count_','quotation','quotation_service','property','contract_property','id','contract_detail'));

        }else{
            $quotation1 = new Quotation;
            $quotation1 = $quotation1->where('id', $quotation_id);
            $quotation1 = $quotation1->first();

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
            return view('contract.contract_form')->with(compact('quotation1','sing','contract','property'));
        }


    }


    public function save()
    {

        //dd(Request::get('detail_name'));
                $contract = new contract;
                $contract->contract_code        = Request::get('contract_code');
                $contract->grand_total_price    = Request::get('price');
                $contract->sales_id             = Request::get('sales_id');
                $contract->customer_id          = Request::get('customer_id');
                $contract->payment_term_type    = Request::get('payment_term_type');
                $contract->contract_status      = 0;
                $contract->quotation_id         = Request::get('quotation_id1');
                $contract->person_name          = empty(Request::get('person_name'))?null:Request::get('person_name');
                $contract->type_service         = Request::get('type_service');
//                $contract->detail_service       = Request::get('detail_service');
                $contract->save();
                //dump($contract);

        if(!empty(Request::get('property_id'))){
            $count = count(Request::get('property_id'));
            for ($i=0;$i<$count;$i++){
                //contract_id','property_name','property_id
                $property_id = explode("|",Request::get('property_id')[$i]);

                $contract_transaction = new contract_transaction;
                $contract_transaction->contract_id          = Request::get('contract_code');
                $contract_transaction->property_name        = Request::get('property_name')[$i];
                $contract_transaction->property_id          = $property_id[0];
                $contract_transaction->start_date           = Request::get('start_date')[$i];
                $contract_transaction->end_date             = Request::get('end_date')[$i];
                $contract_transaction->product              = Request::get('product')[$i];
                $contract_transaction->product_detail       = Request::get('product_detail')[$i];
                $contract_transaction->save();
                //dump($contract_transaction);
            }
        }

//        if(!empty(Request::get('detail_name'))){
//            $count = count(Request::get('detail_name'));
//            for ($i=0;$i<$count;$i++){
//                //contract_id','property_name','property_id
//
//                $contract_detail = new contract_detail;
//                $contract_detail->contract_code             = Request::get('contract_code');
//                $contract_detail->detail_name               = Request::get('detail_name')[$i];
//                $contract_detail->detail                    = Request::get('detail')[$i];
//                $contract_detail->save();
//                //dump($contract_detail);
//            }
//        }

        return redirect('customer/service/quotation/add/'.Request::get('customer_id'));
    }


    public function update()
    {
        $contract = contract::find(Request::get('contract_id'));
        $contract->contract_code        = Request::get('contract_code');
        $contract->grand_total_price    = Request::get('price');
        $contract->sales_id             = Request::get('sales_id');
        $contract->customer_id          = Request::get('customer_id');
        $contract->payment_term_type    = Request::get('payment_term_type');
        $contract->contract_status      = 0;
        $contract->quotation_id         = Request::get('quotation_id1');
        $contract->person_name          = empty(Request::get('person_name'))?null:Request::get('person_name');
        $contract->type_service         = Request::get('type_service');
//        $contract->detail_service       = Request::get('detail_service');
        $contract->save();

        if(!empty(Request::get('property_id'))){
            $count = count(Request::get('property_id'));
            for ($i=0;$i<$count;$i++){
                $property_id = explode("|",Request::get('property_id')[$i]);
                $contract_transaction = contract_transaction::find(Request::get('id')[$i]);
                $contract_transaction->contract_id          = Request::get('contract_code');
                $contract_transaction->property_name        = Request::get('property_name')[$i];
                $contract_transaction->start_date           = Request::get('start_date')[$i];
                $contract_transaction->end_date        = Request::get('end_date')[$i];
                $contract_transaction->property_id          = $property_id[0];
                $contract_transaction->product              = Request::get('product')[$i];
                $contract_transaction->product_detail       = Request::get('product_detail')[$i];
                $contract_transaction->save();
                //dump($contract_transaction);
            }
        }

        if(!empty(Request::get('property_id_update'))){
            $count = count(Request::get('property_id_update'));
            for ($i=0;$i<$count;$i++){
                //contract_id','property_name','property_id
                $property_id = explode("|",Request::get('property_id_update')[$i]);

                $contract_transaction = new contract_transaction;
                $contract_transaction->contract_id          = Request::get('contract_code');
                $contract_transaction->property_name        = Request::get('property_name_update')[$i];
                $contract_transaction->start_date           = Request::get('start_date_update')[$i];
                $contract_transaction->end_date             = Request::get('end_date_update')[$i];
                $contract_transaction->property_id          = $property_id[0];
                $contract_transaction->product              = Request::get('product_update')[$i];
                $contract_transaction->product_detail       = Request::get('product_detail_update')[$i];
                $contract_transaction->save();
                //dump($contract_transaction);
            }
        }

//        if(!empty(Request::get('detail_name1'))){
//            $count = count(Request::get('detail_name1'));
//            for ($i=0;$i<$count;$i++){
//                //contract_id','property_name','property_id
//
//                $contract_detail = contract_detail::find(Request::get('detail_id')[$i]);
//                $contract_detail->contract_code             = Request::get('contract_code');
//                $contract_detail->detail_name               = Request::get('detail_name1')[$i];
//                $contract_detail->detail                    = Request::get('detail1')[$i];
//                $contract_detail->save();
//                //dump($contract_detail);
//            }
//        }
//
//
//        if(!empty(Request::get('detail_name'))){
//            $count = count(Request::get('detail_name'));
//            for ($i=0;$i<$count;$i++){
//                //contract_id','property_name','property_id
//
//                $contract_detail = new contract_detail;
//                $contract_detail->contract_code             = Request::get('contract_code');
//                $contract_detail->detail_name               = Request::get('detail_name')[$i];
//                $contract_detail->detail                    = Request::get('detail')[$i];
//                $contract_detail->save();
//                //dump($contract_detail);
//            }
//        }


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

        $date =date('Y-m-d');
        $customer = Customer::find(Request::get('customer_id'));
        $customer->role = 0;
        $customer->convert_date = $date;
        $customer->save();

        //dd($customer);
        return redirect('contract/list');
    }

    public function contractList () {
        $contracts = new contract;

        if( Request::get('c_no') ) {
            $contracts = $contracts->where('contract_code','like','%'.Request::get('c_no').'%');
        }


        if(Request::get('c_id')) {
            $contracts = $contracts->whereHas('customer', function ($q) {
                $q ->where('company_name','like',"%".Request::get('c_id')."%");
            });
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

    public function delete_property(){
        $delete_property = contract_transaction::find(Request::get('id_property'));
        $delete_property->delete();

        return redirect('customer/service/contract/sign/form/'.Request::get('id_quotation').'/'.Request::get('id_customer'));
    }

    public function per($id = null){
        $quotation1 = new Quotation;
        $quotation1 = $quotation1->where('id', $id);
        $quotation1 = $quotation1->first();

//        $lead = new Customer;
//        $lead = $lead->where('id', $id);
//        $lead = $lead->first();

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
        //dd($id);
    }

    public function delete_contract(){
        $contract = contract::find(Request::get('id2'));
        $contract->delete();

        $contract_transaction=contract_transaction::where('contract_id',Request::get('id_contract'));
        $contract_transaction->delete();

        return redirect('/contract/list');

    }

    public function delete_detail_contract(){
        $detail = contract_detail::find(Request::get('id'));
        $detail->delete();

        return redirect('customer/service/contract/sign/form/'.Request::get('id_quotation').'/'.Request::get('id_customer'));
    }
}
