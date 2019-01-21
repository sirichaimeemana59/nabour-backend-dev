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
use PHPExcel_Style_Border;

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

        $quotation = Quotation::selectRaw('lead_id,SUM(product_price_with_vat) as sum,SUM(grand_total_price) as sum_total,SUM(product_vat) as sum_vat,count(quotation_code) as count')->where('status','=',1)
            ->groupBy('lead_id')->get();

        //return($quotation);
        //dd($customer);
        return view('report_quotation.report_quotation_detail')->with(compact('quotation'));

    }

    public function excel()
    {

        $quotation = Quotation::selectRaw('lead_id,SUM(product_price_with_vat) as sum,SUM(grand_total_price) as sum_total,SUM(product_vat) as sum_vat,count(quotation_code) as count')->where('status','=',1)
            ->groupBy('lead_id')->get();

        $filename = "รายงานใบเสนอราคาที่ออกจากระบบ";

        Excel::create($filename, function ($excel) use ($filename,$quotation) {
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

            //dd($channel);

        if(Request::ajax()) {

            $from       = str_replace('/', '-', Request::get('from-date'));
            $to         = str_replace('/', '-', Request::get('to-date'));
            $channel    = Request::get('channel_id');
            $type       = Request::get('type_id');

            if (Request::get('from-date')) {
                $date = array($from . " 00:00:00", $to . " 00:00:00");
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


        if(!Request::ajax()) {
            $from = null;
            $to = null;
            $channel = null;
            $type = null;
            return view('report_quotation.report_quotation_ratio_list')->with(compact('p_rows','from','to','channel','type'));
        }else{
            return view('report_quotation.report_quotation_ratio_list_element')->with(compact('p_rows','from','to','channel','type'));
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


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
