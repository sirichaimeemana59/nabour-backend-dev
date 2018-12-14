<?php

namespace App\Http\Controllers\leads;

use App\Http\Controllers\Controller;
use Request;
use Auth;
use Redirect;

//Model
use App\BackendModel\User;
use App\Province;
use App\LeadTable;

class LeadsController extends Controller
{
    public function index()
    {
        $p = new Province;
        $provinces = $p->get();

        $sale = new User;
        $sale = $sale->where('role','=',2);
        $sale = $sale->get();


        $_lead = new LeadTable;
        $_lead = $_lead->get();

        //dump($sale->toArray());

        return view('lead.list_lead')->with(compact('provinces','sale','_lead'));
    }

    public function create()
    {
        if(Request::isMethod('post')) {
            $lead = new LeadTable;
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
            $lead->sale_id          =Request::get('sale_id');
            $lead->company_name     =Request::get('company_name');
            $lead->save();
            //dump($lead->toArray());
        }
        $_lead = new LeadTable;
        $_lead->get();

        return redirect('customer/Lead_form/add/list')->with(compact('_lead'));

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
            $_lead = LeadTable::find(Request::get('id'));

            //dump($_lead->toArray());

            $p = new Province;
            $provinces = $p->getProvince();

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
            $lead = LeadTable::find($id);
            $lead->fill(Request::all());
            $lead->save();
            //dump($lead->toArray());
        }

        return redirect('customer/Lead_form/add/list');
    }

    public function destroy()
    {
        $id = Request::input('id2');
        $lead = LeadTable::find($id);
        $lead->delete();
        //dd($id);
        return redirect('customer/Lead_form/add/list');
    }
}
