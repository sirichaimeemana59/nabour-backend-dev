<?php

namespace App\Http\Controllers\RootAdmin;

use Request;
use Auth;
use Redirect;

use App\Http\Controllers\Controller;
use App\Province;
use App\PropertyContract;
use App\BackendModel\service_quotation;
use App\BackendModel\User;
use App\BackendModel\Customer;

use Validator;
use DB;

class CustomerController extends Controller
{
    public function __construct () {
        $this->middleware('admin');
    }

    public function index()
    {
        $p_rows = new Customer;

        if(Request::ajax()) {
            if (Request::get('name')) {
                $p_rows = $p_rows->where('firstname', 'like', "%" . Request::get('name') . "%")
                ->orWhere('lastname', 'like', "%" . Request::get('name') . "%");
            }

            if (Request::get('company_name')) {
                $p_rows = $p_rows->where('company_name', '=', Request::get('company_name'));
            }

            if (Request::get('sale_id')) {
                $p_rows = $p_rows->where('sale_id', '=', Request::get('sale_id'));
            }

            if (Request::get('province')) {
                $p_rows = $p_rows->where('province', '=', Request::get('province'));
            }

            if (Request::get('channel_id')) {
                $p_rows = $p_rows->where('channel', '=', Request::get('channel_id'));
            }

            if (Request::get('type_id')) {
                $p_rows = $p_rows->where('type', '=', Request::get('type_id'));
            }
        }

        $p = new Province;
        $provinces = $p->getProvince();

        $sale = new User;
        $sale = $sale->where('role','=',2);
        $sale = $sale->get();


       // $p_rows = new Customer;
        $p_rows = $p_rows->where('role','=',0);
        $p_rows = $p_rows->orderBy('created_at','desc')->paginate(50);

        //dd($p_rows);

        //dump($customer->toArray());

        if(!Request::ajax()) {
            return view('customer.list_customer')->with(compact('customer','provinces','sale','p_rows'));
        }else{
            return view('customer.list_customer_element')->with(compact('customer','provinces','sale','p_rows'));
        }

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
            $customer->role             =0;
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
        }
        return redirect('customer/customer/list');
    }
}
