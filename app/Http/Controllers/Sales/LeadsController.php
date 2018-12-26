<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use Request;
use Auth;
use Redirect;

//Model
use App\BackendModel\User;
use App\Province;
use App\BackendModel\Customer;

class LeadsController extends Controller
{
    public function __construct () {
        $this->middleware('sales');
    }

    public function index()
    {
        $_lead = new Customer;

        if(Request::get('name')) {
            $_lead = $_lead->where('firstname','=',Request::get('name'));
        }

        if(Request::get('sale_id')) {
            $_lead = $_lead->where('sale_id','=',Request::get('sale_id'));
        }

        $p = new Province;
        $provinces = $p->get();

        $sale = new User;
        $sale = $sale->where('role','=',2);
        $sale = $sale->get();



        $_lead = $_lead->where('role','=',1)->where('sale_id','=',Auth::user()->id);
        $_lead = $_lead->get();

        //dump($sale->toArray());

        $p_rows = new Customer;
        $p_rows = $p_rows->where('role','=',1)->where('sale_id','=',Auth::user()->id);
        $p_rows = $p_rows->orderBy('created_at','desc')->paginate(50);

        if(!Request::ajax()) {
            return view('lead.list_lead')->with(compact('provinces', 'sale', '_lead','p_rows'));
        }else{
            return view('lead.list_lead_element')->with(compact('provinces', 'sale', '_lead','p_rows'));
        }
    }

    public function create()
    {
        if(Request::isMethod('post')) {
            $lead = new Customer;
            $lead->firstname        =Request::get('firstname');
            $lead->lastname         =Request::get('lastname');
            $lead->phone            =Request::get('phone');
            $lead->email            =Request::get('email');
            $lead->address          =Request::get('address');
            $lead->province         =Request::get('province');
            $lead->postcode         =Request::get('postcode');
            $lead->channel          =Request::get('channel');
            $lead->type             =Request::get('type');
            $lead->sales_status     =Request::get('sales_status');
            $lead->sale_id          =Auth::user()->id;
            $lead->company_name     =Request::get('company_name');
            $lead->role             =1;
            $lead->save();
            //dump($lead->toArray());
        }
        $_lead = new Customer;
        $_lead = $_lead->where('role','=',1);
        $_lead->get();

        if(Auth::user()->role !=2){
            return redirect('customer/Lead_form/add/list')->with(compact('_lead'));
        }else{
            return redirect('customer/sales/Lead_form/add/list')->with(compact('_lead'));
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
            $_lead = Customer::find(Request::get('id'));

            //dump($_lead->toArray());

            $p = new Province;
            $provinces = $p->get();

            $sale = new User;
            $sale = $sale->where('role','=',2);
            $sale = $sale->get();

            return view('lead.lead_update')->with(compact('_lead','provinces','sale'));
        }
    }

    public function update()
    {
        if(Request::isMethod('post')) {

            $id = Request::input('lead_id');
            $lead = Customer::find($id);
            $lead->fill(Request::all());
            $lead->save();
            //dump($lead->toArray());
        }

        if(Auth::user()->role !=2) {
            return redirect('customer/Lead_form/add/list');
        }else{
            return redirect('customer/sales/Lead_form/add/list');
        }
    }

    public function destroy()
    {
        $id = Request::input('id2');
        $lead = Customer::find($id);
        $lead->delete();
        //dd($id);

        if(Auth::user()->role !=2) {
            return redirect('customer/Lead_form/add/list');
        }else{
            return redirect('customer/sales/Lead_form/add/list');
        }

    }
}