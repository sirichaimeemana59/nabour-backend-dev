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
use DB;

class ReportsummaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index(){

        if( Request::ajax() ) {
            $contracts = new contract;
            if( Request::get('c_no') ) {
                $contracts = $contracts->where('contract_code','like','%'.Request::get('c_no').'%');
            }


            if(Request::get('c_id')) {
                $contracts = $contracts->whereHas('customer', function ($q) {
                    $q ->where('company_name','like',"%".Request::get('c_id')."%");
                });
            }

            if( Request::get('customer_id') ) {
                $contracts = $contracts->where('customer_id',Request::get('customer_id'));
            }

            $c_no = Request::get('c_no');
            $customer_id = Request::get('customer_id');
            $contracts = $contracts->where('status','=','1')->orderBy('contract_code','desc')->first();

            $p_rows = contract_transaction::where('contract_id','=',$contracts->contract_code)->orderBy('start_date','ASC')->paginate(50);

            return view('report_summary.list_contract_property_element')->with(compact('contracts','p_rows','c_no','customer_id'));

        } else {
            $c_no ='';
            $customer_id = '';
            $p_rows = new contract_transaction;
            $p_rows = $p_rows->orderBy('start_date','ASC')->paginate(50);

            $sales      = BackendUser::whereIn('role',[1,2])->pluck('name','id');
            $customer = new Customer;
            $customer = $customer->where('role','=',0);
            $customer = $customer->orderBy('created_at','desc')->get();

            $customers = Customer::where('role',0)->pluck('company_name','id');
            return view('report_summary.list_contract_property')->with(compact('contracts','customers','sales','customer','p_rows','c_no','customer_id'));
        }
        //return view('report.report_summary');
    }

    public function report(){

        $contracts = new contract;
        if( Request::get('c_no') ) {
            $contracts = $contracts->where('contract_code','like','%'.Request::get('c_no').'%');
        }


        if(Request::get('c_id')) {
            $contracts = $contracts->whereHas('customer', function ($q) {
                $q ->where('company_name','like',"%".Request::get('c_id')."%");
            });
        }

        if( Request::get('customer_id') ) {
            $contracts = $contracts->where('customer_id',Request::get('customer_id'));
        }

        $contracts = $contracts->where('status','=','1')->orderBy('contract_code','desc')->first();

        $p_rows = contract_transaction::where('contract_id','=',$contracts->contract_code)->orderBy('start_date','ASC')->paginate(50);
        $rows = contract_transaction::where('contract_id','=',$contracts->contract_code)->orderBy('start_date','ASC')->first();

        return view('report.report_summary')->with(compact('contracts','p_rows','rows'));

    }

}
