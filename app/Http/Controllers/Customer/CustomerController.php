<?php

namespace App\Http\Controllers\Customer;

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
use App\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        $customer = new Customer;
        $customer = $customer->where('role','=',0);
        $customer = $customer->get();

        $p = new Province;
        $provinces = $p->getProvince();

        $sale = new User;
        $sale = $sale->where('role','=',2);
        $sale = $sale->get();

        //dump($customer->toArray());

        return view('customer.list_customer')->with(compact('customer','provinces','sale'));
    }

    public function create()
    {
        if(Request::isMethod('post')) {
            $customer = new Customer;
            $customer->firstname        = Request::get('firstname');
            $customer->lastname         = Request::get('lastname');
            $customer->phone            = Request::get('phone');
            $customer->email            = Request::get('email');
            $customer->address          = Request::get('address');
            $customer->province         = Request::get('province');
            $customer->postcode         = Request::get('postcode');
            $customer->company_name     = Request::get('company_name');
            $customer->channel          = Request::get('channel');
            $customer->type             = Request::get('type');
            $customer->active_status    = 'f';
            $customer->status           = 0;
            $customer->sale_id          = Request::get('sale_id');
            $customer->save();
            //dump($customer->toArray());
        }
        return redirect('customer/customer/list');
    }

    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit()
    {
        if(Request::isMethod('post')) {
            $customer = Customer::find(Request::get('id'));

            //dump($customer->toArray());

            $p = new Province;
            $provinces = $p->get();

            $sale = new User;
            $sale = $sale->where('role','=',2);
            $sale = $sale->get();

            return view('customer.customer_update')->with(compact('customer','provinces','sale'));
        }
    }


    public function update()
    {
        if(Request::isMethod('post')) {
            $customer = Customer::find(Request::get('customer_id'));
            $customer->firstname        = Request::get('firstname');
            $customer->lastname         = Request::get('lastname');
            $customer->phone            = Request::get('phone');
            $customer->email            = Request::get('email');
            $customer->address          = Request::get('address');
            $customer->province         = Request::get('province');
            $customer->postcode         = Request::get('postcode');
            $customer->company_name     = Request::get('company_name');
            $customer->channel          = Request::get('channel');
            $customer->type             = Request::get('type');
            $customer->active_status    = 'f';
            $customer->status           = Request::get('status');
            $customer->sale_id          = Request::get('sale_id');
            $customer->save();
            //dump($customer->toArray());
        }
        return redirect('customer/customer/list');
    }

    public function destroy()
    {
        if(Request::isMethod('post')) {
            $customer = Customer::find(Request::get('id2'));
            $customer->status       = 't';
            $customer->save();
            //dump($customer->toArray());
        }
        return redirect('customer/customer/list');
    }

    public function check()
    {
        if(Request::isMethod('post')) {
            $customer = Customer::find(Request::get('id3'));
            $customer->status       = 'f';
            $customer->save();
            //dump($customer->toArray());
        }
        return redirect('customer/customer/list');
    }
}
