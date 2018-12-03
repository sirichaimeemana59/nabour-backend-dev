<?php

namespace App\Http\Controllers\RootAdmin;


use App\Http\Controllers\Controller;
use Request;
use Auth;
use Redirect;
use App\package;
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
use App\quotation;
use DB;

class QuotationController extends Controller
{
    public function edit($id)
    {
        $quotation = new quotation;
        $quotation = $quotation->where('property_id',$id);
        $quotation = $quotation->first();

        //dd($quotation);

        $service_quo = new service_quotation;
        $service_quo = $service_quo->where('property_id',$id);
        $service_quo = $service_quo->get();

        //dd($service_quo);

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

        //dd($quotation);
        return view('property.quotation_update_form')->with(compact('quotation','provinces','property','property1','service','service_quo'));
    }

    public function delete()
    {
        $service_quo = new service_quotation;
        $service_quo = $service_quo->where('property_id',Request::get('id2'));
        $service_quo->delete();

        $quotation = new quotation;
        $quotation = $quotation->where('property_id',Request::get('id2'));
        $quotation->delete();
        //return ($id);
        return redirect('/root/admin/list_quotation');
    }

    public function update()
    {
        if( !empty(Request::get('_data'))) {
            foreach ( Request::get('_data') as $q) {
                $service_quotation = service_quotation::find($q['id']);
                $service_quotation->id          = $q['id'];
                $service_quotation->property_id = $q['property_id'];
                $service_quotation->service_id  = empty($q['service'])?'0':$q['service'];
                $service_quotation->project     = empty($q['project'])?'0':$q['project'];
                $service_quotation->month       = empty($q['price'])?'0':$q['price'];
                $service_quotation->unit_price  = empty($q['unit_price'])?'0':$q['unit_price'];
                $service_quotation->total       = empty($q['total1'])?'0':$q['total1'];
                $service_quotation->save();
                //dump($quotation->toArray());
            }
            $quotation = quotation::find(Request::get('quotation_id'));
            $quotation->project_package 	= Request::get('package_id');
            $quotation->month_package 		= Request::get('month_package');
            $quotation->unit_package 		= Request::get('unit_package');
            $quotation->total_package 		= Request::get('total_package');
            $quotation->discount 		    = Request::get('discount');
            $quotation->property_id 		= Request::get('quotation_id');
            $quotation->sale_id 			= Request::get('sale_id');
            $quotation->package_unit 		= Request::get('project_package');
            $quotation->quotation_number 	= Request::get('quotation_number');
            $quotation->save();
        }


        //dump($quotation->toArray());
        return redirect('/root/admin/list_quotation');

    }

    public function detail($id = null){

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

        $service_quo = new service_quotation;
        $service_quo = $service_quo->where('property_id',$id);
        $service_quo = $service_quo->get();

        //dd($service_quo);

        $quotation = new quotation;
        $quotation = $quotation->where('property_id',$id);
        $quotation = $quotation->first();

        //dd($quotation);
        //dump($service_quo->toArray());
            return view('property.quotation_detail')->with(compact('provinces','property','property1','service','package','sale','service_quo','quotation'));
        }

}
