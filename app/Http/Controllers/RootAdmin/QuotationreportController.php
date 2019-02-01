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
use Excel;
use View;
use App;
use PHPExcel_Style_Border;

class QuotationreportController extends Controller
{

    public function index()
    {
        $p_rows = new Customer;

        if (Request::ajax()) {
            if (Request::get('name')) {
                $p_rows = $p_rows->where('firstname', 'like', "%" . Request::get('name') . "%")
                    ->orWhere('lastname', 'like', "%" . Request::get('name') . "%");
            }

            if (Request::get('sale_id')) {
                $p_rows = $p_rows->where('sale_id', Request::get('sale_id'));
            }

        }

        $p_rows = $p_rows->where('role', '=', 0);
        //$p_rows = $p_rows->with('quotation')->groupBy('id')->count('*','as','count');
        $p_rows = $p_rows->orderBy('created_at', 'desc')->paginate(50);

        $sale = new User;
        $sale = $sale->where('role', '=', 2);
        $sale = $sale->get();


        //dd($count);

        if (Request::ajax()) {
            return view('report_quotation.report_list_element')->with(compact('p_rows', 'sale'));

        } else {
            return view('report_quotation.report_list')->with(compact('p_rows', 'sale'));
        }
    }

    public function view($id = null)
    {
        $quotation = new quotation;
        $quotation = $quotation->where('lead_id', '=', $id)->get();

        return view('report_quotation.detail_quotation')->with(compact('quotation'));
    }

    public function detail()
    {
        if (Request::isMethod('post')) {

            $quotation = new Quotation;
            $quotation = $quotation->where('quotation_code', Request::get('id'));
            $quotation = $quotation->first();

            $quotation_service = new Quotation_transaction;
            $quotation_service = $quotation_service->where('quotation_code', Request::get('id'));
            $quotation_service = $quotation_service->get();

            return view('report_quotation.quotation_detail')->with(compact('quotation', 'quotation_service'));
        }
    }

    public function report()
    {

        $p_rows = Quotation::selectRaw('lead_id,SUM(product_price_with_vat) as sum,SUM(grand_total_price) as sum_total,SUM(product_vat) as sum_vat,count(quotation_code) as count')->where('status', '=', 1)
            ->groupBy('lead_id')->paginate(50);

        //return($quotation);
        //dd($customer);
        return view('report_quotation.report_quotation_detail')->with(compact('p_rows'));

    }

    public function excel()
    {

        $quotation = Quotation::selectRaw('lead_id,SUM(product_price_with_vat) as sum,SUM(grand_total_price) as sum_total,SUM(product_vat) as sum_vat,count(quotation_code) as count')->where('status', '=', 1)
            ->groupBy('lead_id')->get();

        $filename = "รายงานใบเสนอราคาที่ออกจากระบบ";

        Excel::create($filename, function ($excel) use ($filename, $quotation) {
            $excel->sheet("Quotation_Output", function ($sheet) use ($quotation) {
                $sheet->setWidth(array(
                    'A' => 50,
                    'B' => 20,
                    'C' => 30,
                    'D' => 30,
                    'E' => 30,
                ));
                //$sheet->setBorder('A1', 'thin');
                // $sheet->setBorder('A1:F10', 'thin');
                //$sheet->setBorder('A1:E17', 'thin');
                $sheet->loadView('report_quotation.report_quotation_excel')->with(compact('quotation', 'filename'));
            });
        })->download('xls');

        //return($quotation);
        //dd($customer);
        //return view('report_quotation.report_quotation_excel')->with(compact('quotation','filename'));

    }

    public function ratio()
    {

        $p_rows = new Customer;

        if (Request::ajax()) {
            $from = str_replace('/', '-', Request::get('from-date'));
            $to = str_replace('/', '-', Request::get('to-date'));
            $channel = Request::get('channel_id');
            $type = Request::get('type_id');

            if (Request::get('from-date')) {

                $month = array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
                foreach ($month as $key => $value){
                    $date = array($from . " 00:00:00", $to . " 00:00:00");

                    $data = $p_rows
                        ->select(DB::raw('COUNT(*) as count'))
                        ->whereBetween('created_at', $date)
                        ->whereMonth('created_at','=',$key)
                        ->get();
                    $information[]  = $data->count->toArray();
                }
                //dump($information);
            }

//            if (Request::get('from-date')) {
//                $date = array($from . " 00:00:00", $to . " 00:00:00");
//                    $p_rows = $p_rows->whereBetween('created_at', $date);
//            }

            if (Request::get('channel_id') != null) {
                $p_rows = $p_rows->where('channel', '=', Request::get('channel_id'));
            }

            if (Request::get('type_id') != null) {
                $p_rows = $p_rows->where('type', '=', Request::get('type_id'));
            }
        }

        $p_rows = $p_rows->where('active_status', '=', 't')->paginate(50);


        if (!Request::ajax()) {
            $from = null;
            $to = null;
            $channel = null;
            $type = null;
            return view('report_quotation.report_quotation_ratio_list')->with(compact('p_rows', 'from', 'to', 'channel', 'type'));
        } else {
            //dump($p_rows->toArray());
            return view('report_quotation.report_quotation_ratio_list_element')->with(compact('p_rows', 'from', 'to', 'channel', 'type'));
        }
    }

    public function excel_ratio()
    {
        $p_rows = new Customer;

        if (Request::isMethod('post')) {

            $from = Request::get('from');
            $to = Request::get('to');
            $channel = Request::get('channel_id');
            $type = Request::get('type_id');

            if (Request::get('from')) {
                $date = array($from . " 00:00:00", $to . " 00:00:00");
                //dd($date);
                $p_rows = $p_rows->whereBetween('created_at', $date);
            }

            if (Request::get('channel_id') != null) {
                $p_rows = $p_rows->where('channel', '=', Request::get('channel_id'));
            }

            if (Request::get('type_id') != null) {
                $p_rows = $p_rows->where('type', '=', Request::get('type_id'));
            }
        }
        $p_rows = $p_rows->where('active_status', '=', 't')->paginate(50);

        $filename = "สถิติการเปลี่ยนจาก Leads เป็นลูกค้า";

        Excel::create($filename, function ($excel) use ($filename, $p_rows, $from, $to, $channel, $type) {
            $excel->sheet("Quotation_ration", function ($sheet) use ($p_rows, $from, $to, $channel, $type) {
                $sheet->setWidth(array(
                    'B' => 20,
                    'C' => 50,
                    'D' => 20,
                    'E' => 30,
                ));

//                    $styleArray = array(
//                        'borders' => array(
//                            'allborders' => array(
//                                'style' => PHPExcel_Style_Border::BORDER_THIN
//                            )
//                        )
//                    );
//
//                    $sheet->getStyle()->applyFromArray($styleArray);


                //$sheet->setBorder('A1', 'thin');
                // $sheet->setBorder('A1:F10', 'thin');
                //$sheet->setBorder('A1:E17', 'thin');
                $sheet->loadView('report_quotation.report_quotation_ratio_excel')->with(compact('p_rows', 'filename', 'from', 'to', 'channel', 'type'));
            });
        })->download('xls');

        //return($quotation);
        //dd($customer);
        //return view('report_quotation.report_quotation_ratio_excel')->with(compact('p_rows','filename','from','to','channel','type'));

    }


    public function chart_form()
    {
        $c_year = date('Y');
        $year = array('' => trans_choice('messages.year',1) );
        $plus = (App::getLocale() == 'th')?543:0;
        for ($i = $c_year+1; $i >= 1900; $i--) {
            $year += array($i=>$i+$plus);
        }

        $p_rows = new Customer;
        $p_rows = $p_rows->get();

        $sale = new User;
        $sale = $sale->where('role','=',2);
        $sale = $sale->get();

        return view('report_chart.report_chart_form')->with(compact('year','p_rows','sale'));
    }

    public function destroy($id)
    {
        //
    }

    public function date()
    {
        $p_rows = new Customer;

        if (Request::ajax()) {

            $from = str_replace('/', '-', Request::get('from-date'));
            $to = str_replace('/', '-', Request::get('to-date'));

            $channel = Request::get('channel_id');
            $type = Request::get('type_id');

            if (Request::get('from-date')) {

                $month = array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
                foreach ($month as $key => $value){
                    $date = array($from . " 00:00:00", $to . " 00:00:00");

                    $data = $p_rows
                        ->select(DB::raw('COUNT(*) as count'))
                        ->whereBetween('created_at', $date)
                        ->whereMonth('created_at','=',$key)
                        ->where('role','=','0')
                        ->get();
                    $data = $data->toArray();

                    $_data = $p_rows
                        ->select(DB::raw('COUNT(*) as count'))
                        ->whereBetween('created_at', $date)
                        ->whereMonth('created_at','=',$key)
                        ->where('role','=','1')
                        ->get();

                    $_data = $_data->toArray();

                    $information["leads"][] = $_data[0]['count'];
                    $information["customer"][] = $data[0]['count'];
                }
           }

            if (Request::get('channel_id') != null) {
                $month = array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
                foreach ($month as $key => $value){

                    $data = $p_rows
                        ->select(DB::raw('COUNT(*) as count'))
                        ->where('channel','=',Request::get('channel_id'))
                        ->whereMonth('created_at','=',$key)
                        ->where('role','=','0')
                        ->get();
                    $data = $data->toArray();

                    $_data = $p_rows
                        ->select(DB::raw('COUNT(*) as count'))
                        ->where('channel','=',Request::get('channel_id'))
                        ->whereMonth('created_at','=',$key)
                        ->where('role','=','1')
                        ->get();

                    $_data = $_data->toArray();

                    $information["leads"][] = $_data[0]['count'];
                    $information["customer"][] = $data[0]['count'];
                }
            }

            if (Request::get('type_id') != null) {
                $month = array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
                foreach ($month as $key => $value){

                    $data = $p_rows
                        ->select(DB::raw('COUNT(*) as count'))
                        ->where('type','=',Request::get('type_id'))
                        ->whereMonth('created_at','=',$key)
                        ->where('role','=','0')
                        ->get();
                    $data = $data->toArray();

                    $_data = $p_rows
                        ->select(DB::raw('COUNT(*) as count'))
                        ->where('type','=',Request::get('type_id'))
                        ->whereMonth('created_at','=',$key)
                        ->where('role','=','1')
                        ->get();

                    $_data = $_data->toArray();

                    $information["leads"][] = $_data[0]['count'];
                    $information["customer"][] = $data[0]['count'];
                }
            }

            if (Request::get('year') != null) {
                $month = array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
                foreach ($month as $key => $value){

                    $data = $p_rows
                        ->select(DB::raw('COUNT(*) as count'))
                        ->whereMonth('created_at','=',$key)
                        ->whereYear('created_at','=',Request::get('year')-543)
                        ->where('role','=','0')
                        ->get();
                    $data = $data->toArray();

                    $_data = $p_rows
                        ->select(DB::raw('COUNT(*) as count'))
                        ->whereMonth('created_at','=',$key)
                        ->whereYear('created_at','=',Request::get('year')-543)
                        ->where('role','=','1')
                        ->get();

                    $_data = $_data->toArray();

                    $information["leads"][] = $_data[0]['count'];
                    $information["customer"][] = $data[0]['count'];
                }
            }

            $p_rows = $p_rows->where('active_status', '=', 't')->get();
            return response()->json( $information );
           // dd($p_rows);
        }
    }

    public function quotation(){
        $p_rows = new Quotation;

        if (Request::ajax()) {
            if (Request::get('name')) {

                $month = array('1'=>'Jan','2'=>'Feb','3'=>'Mar','4'=>'Apr','5'=>'May','6'=>'Jun','7'=>'Jul','8'=>'Aug','9'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dec');
                foreach ($month as $key => $value){

                    $data = $p_rows
                        ->select(DB::raw('SUM(product_price_with_vat) as count'))
                        ->where('lead_id','=', Request::get('name'))
                        ->whereMonth('created_at','=',$key)
                        ->where('status','=','1')
                        ->get();
                    $data = $data->toArray();// quotation approved

                    $_data = $p_rows
                        ->select(DB::raw('SUM(product_price_with_vat) as count'))
                        ->where('lead_id','=', Request::get('name'))
                        ->whereMonth('created_at','=',$key)
                        ->where('status','=','0')
                        ->get();

                    $_data = $_data->toArray();// quotation none approved

                    $information["approved"][] = $_data[0]['count'];
                    $information["_approved"][] = $data[0]['count'];
                }
            }
            }
                //dd($information);
            return response()->json( $information );

    }
}
