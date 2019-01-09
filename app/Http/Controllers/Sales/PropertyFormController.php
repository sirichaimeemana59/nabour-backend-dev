<?php

namespace App\Http\Controllers\Sales;
use App\Http\Controllers\Controller;

use Request;
use Auth;
use Redirect;
use Mail;

//Model
use App\SalePropertyDemo;
use App\Province;
use App\PropertyContract;
use App\Property;

class PropertyFormController extends Controller
{
    public function __construct () {
        $this->middleware('sales');
    }

    public function index()
    {
        $property_demo = new SalePropertyDemo;

        if(Request::get('name')) {
            $property_demo = $property_demo->where('name','like',"%".Request::get('name')."%");
        }

        if(Request::get('status')) {
            $property_demo = $property_demo->where('status','=',Request::get('status'));
        }

        if(Request::get('province')) {
            $property_demo = $property_demo->where('province','=',Request::get('province'));
        }

        $property_demo = $property_demo->get();


        $_form = new SalePropertyDemo;
        $_form = $_form->orderBy('created_at','desc')->paginate(50);

        $p = new Province;
        $provinces = $p->getProvince();


        if(!Request::ajax()) {
            return view('property_sale_demo.list_property_demo')->with(compact('property_demo','_form','provinces'));
        }else{
            //dd($property_demo);
            return view('property_sale_demo.list_property_demo_element')->with(compact('property_demo','_form','provinces'));
        }

    }

    public function create()
    {
        $code 	= $this->generateCode();

        $property_demo = new SalePropertyDemo;
        $property_demo->default_password   = $code;
        $property_demo->status             = 0;
        $property_demo->contact_name       = Request::get('name');
        $property_demo->property_test_name = Request::get('property_test_name');
        $property_demo->province           = Request::get('province');
        $property_demo->email_contact      = Request::get('email');
        $property_demo->property_id        = Request::get('property');
        $property_demo->lead_id            = Request::get('lead_id');
        $property_demo->sale_id            = Request::get('sales_id');
        $property_demo->tel_contact        = Request::get('tel_contact');
        $property_demo->save();

        $property = new Property;
        $property = $property->where('id', Request::get('property'));
        $property = $property->first();

        //dd($property_demo);
        $this->mail_form_created(Request::get('name'), Request::get('email'),$property->property_name_th,$code);

        //dump($property_demo->toArray());
        return redirect('sales/demo-property/list-property');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
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

    function generateCode() {
        $chars = "abcdefghijkmnpqrstuvwxyz123456789";
        $i = 0;
        $pass = '' ;
        while ($i < 5) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
        return $pass;
    }

    function mail_form_created ($name,$email,$property_name,$code) {
        Mail::send('emails.property_form_created', [
            'name'			=> $name,
            'property_name' => $property_name,
            'code'		=> $code

        ], function ($message) use($email) {
            $message->subject('รหัสแบบฟอร์มสำหรับข้อมูลนิติบุคคล');
            $message->from('noreply@nabour.me', 'Nabour');
            $message->to($email);
        });
    }

    public function code () {
        $fail = false;
        $p = new Province;
        $provinces = $p->getProvince();
        if(Request::ajax()) {
            $_form = SalePropertyDemo::where('form_code',trim(Request::get('code')))->first();
            if($_form) {
                if($_form->status == 0) {
                    Request::session()->put('form_code', Request::get('code'));
                    return response()->json(array('status' => '1'));
                } else {
                    return response()->json(array('status' => '2'));
                }
            } else {
                return response()->json(array('status' => '0'));
            }
        }
        return view('property_sale_demo.form-code')->with(compact('provinces','fail'));
    }

    public function form () {
        $p = new Province;
        $provinces = $p->getProvince();
        if(Request::isMethod('post')) {
            $data = Request::except('id','_token');
            $_form = SalePropertyDemo::find(Request::get('id'));
            $data['unit_size'] = count($data['unit']);
            $_form->detail = json_encode($data);
            $_form->status = ($data['save-type'] == "draft") ? 0 : 1;
            //dd($_form);
            $_form->save();
            if(!$_form->status)
                return redirect()->back()->withInput();
            else return redirect('home/code');
        } else {
            if(Request::session()->get('form_code')) {
                $_form = SalePropertyDemo::where('form_code',Request::session()->get('form_code'))->first();
                if($_form || $_form->status == 0) {
                    $id = $_form->id;
                    $p  = $_form->province;
                    $property_name  = $_form->property_name;
                    if($_form->detail){
                        $_form = $_form->toArray();
                        $_form = json_decode($_form['detail'],true);
                        $_form['id'] = $id;
                    }
                    else {
                        $_form = array();
                        $_form['id'] = $id;
                        $_form['province'] = $p;
                        $_form['property_name_th'] = $property_name;
                    }
                    return view('property_sale_demo.property-form')->with(compact('_form','provinces'));
                } else {
                    return redirect('home/code');
                }
            } else {
                return redirect('home/code');
            }
        }

    }
}
