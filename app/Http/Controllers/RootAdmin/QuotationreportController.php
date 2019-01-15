<?php

namespace App\Http\Controllers\RootAdmin;

use App\Http\Controllers\Controller;

use Request;
use Auth;
use Redirect;

use App\Province;
use App\PropertyContract;
use App\BackendModel\service_quotation;
use App\BackendModel\Quotation;
use App\BackendModel\Customer;
use App\BackendModel\contract;
use App\BackendModel\User as BackendUser;
use App\BackendModel\Quotation_transaction;
use App\BackendModel\Products;
use App\BackendModel\User;
use App\BackendModel\Property;
use DB;

class QuotationreportController extends Controller
{

    public function index()
    {
        $p_rows = new Customer;

        if(Request::ajax()) {
            if(Request::get('name')) {
                $p_rows = $p_rows->where('firstname','like',"%".Request::get('name')."%")
                    ->orWhere('lastname','like',"%".Request::get('name')."%");
            }

            if(Request::get('sale_id')) {
                $p_rows = $p_rows->where('sale_id',Request::get('sale_id'));
            }

        }

        $p_rows = $p_rows->where('role','=',0);
        //$p_rows = $p_rows->with('quotation')->groupBy('id')->count('*','as','count');
        $p_rows = $p_rows->orderBy('created_at','desc')->paginate(50);

        $sale = new User;
        $sale = $sale->where('role','=',2);
        $sale = $sale->get();


        //dd($count);

        if(Request::ajax()) {
            return view('report_quotation.report_list_element')->with(compact('p_rows','sale'));

        } else {
            return view('report_quotation.report_list')->with(compact('p_rows','sale'));
        }
    }

    public function view($id = null)
    {
        $quotation = new quotation;
        $quotation = $quotation->where('lead_id','=',$id)->get();

        return view('report_quotation.detail_quotation')->with(compact('quotation'));
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

            return view('report_quotation.quotation_detail')->with(compact('quotation','quotation_service'));
        }
    }

    public function report()
    {

        $quotation = Quotation::selectRaw('lead_id,SUM(product_price_with_vat) as sum,SUM(grand_total_price) as sum_total,SUM(product_vat) as sum_vat')->where('status','=',1)
            ->groupBy('lead_id')->get();

        //return($quotation);
        //dd($customer);
        return view('report_quotation.report_quotation_detail')->with(compact('quotation'));

    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
