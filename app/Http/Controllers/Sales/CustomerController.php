<?php

namespace App\Http\Controllers\Sales;

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
        $this->middleware('sales');
    }

    public function index()
    {
        $customer = new Customer;

        if(Request::get('name')) {
            $customer = $customer->where('firstname','like',"%".Request::get('name')."%");
        }

        if(Request::get('company_name')) {
            $customer = $customer->where('company_name','=',Request::get('company_name'));
        }

        if(Request::get('sale_id')) {
            $customer = $customer->where('sale_id','=',Request::get('sale_id'));
        }

        if(Request::get('province')) {
            $customer = $customer->where('province','=',Request::get('province'));
        }

        $customer = $customer->where('role','=',0)->where('sale_id','=',Auth::user()->id);
        $customer = $customer->orderBy('created_at','desc')->get();

        //dd($customer);

        $p = new Province;
        $provinces = $p->getProvince();

        $sale = new User;
        $sale = $sale->where('role','=',2);
        $sale = $sale->get();


        $p_rows = new Customer;
        $p_rows = $p_rows->where('role','=',0)->where('sale_id','=',Auth::user()->id);
        $p_rows = $p_rows->orderBy('created_at','desc')->paginate(50);



       // dd($p_rows);
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
            $customer->sale_id          = Auth::user()->id;
            $customer->role             =0;
            $customer->save();
            //dump($customer->toArray());
        }
        if(Auth::user()->role !=2) {
            return redirect('customer/customer/list');
        }else{
            return redirect('customer/sales/customer/list');
        }

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
            $customer->sale_id          = Auth::user()->id;
            $customer->save();
            //dump($customer->toArray());
        }
        if(Auth::user()->role !=2) {
            return redirect('customer/customer/list');
        }else{
            return redirect('customer/sales/customer/list');
        }
    }

    public function destroy()
    {
        if(Request::isMethod('post')) {
            $customer = Customer::find(Request::get('id2'));
            $customer->status       = 't';
            $customer->save();
            //dump($customer->toArray());
        }
        if(Auth::user()->role !=2) {
            return redirect('customer/customer/list');
        }else{
            return redirect('customer/sales/customer/list');
        }
    }

    public function check()
    {
        if(Request::isMethod('post')) {
            $customer = Customer::find(Request::get('id3'));
            $customer->status       = 'f';
            $customer->save();
            //dump($customer->toArray());
        }
        if(Auth::user()->role !=2) {
            return redirect('customer/customer/list');
        }else{
            return redirect('customer/sales/customer/list');
        }
    }
}
