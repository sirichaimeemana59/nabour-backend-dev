<?php

namespace App\Http\Controllers\RootAdmin;

use Request;
use Auth;
use Redirect;
use App\package;
use App\quotation;
use App\Http\Controllers\Controller;
use App\PropertyUnit;
use App\User;
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

class PackageController extends Controller
{

    public function index()
    {
        $package = new package;
        $package = $package->where('status','1');
        $package = $package->get();

        //dd($package);
        return view('property.package',['package'=>$package]);
    }

    public function index_list()
    {

        $property = new quotation;


        if (Request::get('name')) {
            $property = $property->whereHas('lastest_quotation_property', function($q) {
                $q->where('property_name_th', 'like', "%" .Request::get('name'). "%");
            });
            //dd($property->get('lastest_quotation_property'));
        }
        if(Request::get('package')){
            $property = $property->whereHas('lastest_package', function ($q) {
                $q ->where('project_package','=',Request::get('package'));
            });
        }
        if(Request::get('sale')){
            $property = $property->whereHas('lastest_sale', function ($q) {
                $q ->where('sale_id','=',Request::get('sale'));
            });
        }

        if(Request::get('quotation_number')) {
            $property = $property->where('quotation_number','=',Request::get('quotation_number'));
        }

        $property = $property->get();

        $package = new package;
        $package = $package->where('status','1');
        $package = $package->get();

        $service = new package;
        $service = $service->where('status','2');
        $service = $service->get();

        $sale = User::where('id','!=',Auth::user()->id)
            ->where('role','=',4)
            ->orderBy('created_at','DESC')
            ->paginate(30);

        if(Request::isMethod('post')) {
            return view('property.report_quotation_list')->with(compact('property','package','service','sale'));
        } else {
            return view('property.list_quotation')->with(compact('property','package','service','sale'));
        }

    }

    public function index_service()
    {
        $package = new package;
        $package = $package->where('status','2');
        $package = $package->get();


        //dd($package);
        return view('property.service',['package'=>$package]);
    }

    public function add()
    {
        $package = new package;
        //$package->fill(Request::all());
        $package->name      = Request::get('name');
        $package->detail    = Request::get('detail');
        $package->price     = Request::get('price');
        $package->status    = Request::get('status');
        $package->vat       = Request::get('vat1');
        $package->save();
        //dd(Request::all());
        //dump($package->toArray());
        return redirect('root/admin/package/add');
    }

    public function update()
    {
        $id = Request::input('id');
        $package = package::find($id);
        $package->name      = Request::get('name');
        $package->detail    = Request::get('detail');
        $package->price     = Request::get('price');
        $package->status    = Request::get('status');
        $package->vat       = empty(Request::get('vat'))?'0':Request::get('vat');
        $package->save();
        //dd(Request::all());
        //dump($package->toArray());
        return redirect('root/admin/package/add');
    }

    public function delete()
    {
        $package = package::find(Request::get('id2'));
        $package->delete();
        return redirect('root/admin/package/add');
    }

    public function add_service()
    {
        $package = new package;
        $package->fill(Request::all());
        $package->save();
        //dd(Request::all());
        return redirect('root/admin/package/service/add');
    }

    public function update_service()
    {
        $id = Request::input('id');
        $package = package::find($id);
        $package->fill(Request::all());
        $package->save();
        //dd(Request::all());
        return redirect('root/admin/package/service/add');
    }

    public function delete_service()
    {
        $package = package::find(Request::get('id2'));
        $package->delete();
        return redirect('root/admin/package/service/add');
    }

    public function insert_quotaion_detail(){
        if(Request::isMethod('post')) {
           // dd(Request::get('transaction'));

            if(empty(Request::get('sale_id'))){
                return redirect('root/admin/property/list');
            }else{
                foreach (Request::get('transaction') as $t) {
                    $trans = new service_quotation;
                    if(empty($t['service'])){
                        return redirect('root/admin/property/list');
                    }else{
                        $trans->service_id 			= $t['service'];
                        $trans->project 			= empty($t['project'])?'0':$t['project'];
                        $trans->month 				= empty($t['price'])?'0':$t['price'];
                        $trans->unit_price 			= empty($t['unit_price'])?'0':$t['unit_price'];
                        $trans->total 				= empty($t['total'])?'0':$t['total'];
                        $trans->property_id 		= Request::get('property_id');
                        $trans->save();
                    }

                    //dd($trans);
                    // dump($trans->toArray());
                }

                $quotation = new quotation;
                $quotation->project_package 	= Request::get('package_id');
                $quotation->month_package 		= Request::get('month_package');
                $quotation->unit_package 		= Request::get('unit_package');
                $quotation->total_package 		= Request::get('total_package');
                $quotation->discount 		    = Request::get('discount');
                $quotation->property_id 		= Request::get('property_id');
                $quotation->sale_id 			= Request::get('sale_id');
                $quotation->package_unit 		= Request::get('project_package');
                $quotation->quotation_number 	= Request::get('quotation_number');
                $quotation->save();

                return redirect('root/admin/list_quotation');
            }

        }

        //dd(Request::get('transaction'));

        $id = Request::input('property_id');

        $search = new quotation;
        $search = $search->where('property_id',$id);
        $search = $search->get();

        //$search =quotation::find($id);
        $num = count($search);
       // dd($num);

        $p = new Province;
        $provinces = $p->getProvince();
        //$property = PropertyContract::find($id);
        $property = Property::find($id);

        $property1 = PropertyContract::find($id);

        //dd($property1);

        $service = new package;
        $service = $service->where('status','2');
        $service = $service->get();

        $package = new package;
        $package = $package->where('status','1');
        $package = $package->get();

        $sale = User::where('id','!=',Auth::user()->id)
            ->where('role','=',4)
            ->orderBy('created_at','DESC')
            ->paginate(30);
        //dd($sale);

            return view('property.quotation_detail')->with(compact('provinces','property','property1','service','package','sale'));

    }

    public function package_detail()
    {

        if(Request::isMethod('post')) {
            $package = package::find(Request::get('id'));
            //$package = $package->where('status','1');
            //$package = $package->get();

            return view('property.package_update')->with(compact('package'));
        }

       //return ('5555');service_detail

    }

    public function service_detail()
    {

        if(Request::isMethod('post')) {
            $service = package::find(Request::get('id'));
            //$package = $package->where('status','1');
            //$package = $package->get();

            return view('property.service_update')->with(compact('service'));
        }

        //return ('5555');service_detail

    }

}
