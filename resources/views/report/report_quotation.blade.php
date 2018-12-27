@extends('print')
<style>
    .title_left{
        text-align:left;
        margin:0 0 0 25px;
    }
    .line_table{
        border: 1px solid black;
    }
    .styletable {
        border-collapse: collapse;
        width: 100%;
    }
    .content{
        font-size: 12px;
        color: #0c0c0c;
        font-family: 'thonburi';
    }
    table ,tr,td,th{
        padding: 5px;
        font-family: 'thonburi';
        font-size: 12px;
        /*border: 1px solid black;*/
    }
</style>

@section('content')
    <div class="content">
        <div class="title_left">
            <table>
                <tr>
                    <td width="20%"><img src="{{asset('images/logo1.png')}}" alt="" width="100%"></td>
                    <td style="padding: 5px;">บริษัท โอกาสพลัส จำกัด<br>428 ชั้น6 ซอยเอกมัย 26 ถ.สุขุมวิท63<br>แขวงคลองตันเหนือ เขตวัฒนา กทม 10110<br>สาขา สำนักงานใหญ่<br>โทร 02-1183440 อีเมล : admin@o-kaatdivlus.com<br>เลขที่ประจำตัวผู้เสียภาษี 0105561013024<br></td>
                </tr>
            </table>
        </div>
        <br>

       <div style="text-align: center;">ใบเสนอราคา/ใบสั่งซื้อ
        <br>Quaotation/Purchase Order</div>

        <div class="title_herder">
            <table style="border: 1px solid black; color: black;" width="100%">
                <tr>
                    <td style="padding:5px 0 0 5px;">Attention</td>
                    <td style="padding:5px 0 0 5px;">:</td>
                    <td style="padding:5px 0 0 5px; border-right: 1px solid black;" colspan="6">{!! $quotation->latest_lead->firstname !!}</td>
                    <td style="padding:5px 0 0 5px;">No : </td>
                    <td style="padding:5px 0 0 5px;"> {!! $quotation->quotation_code !!}</td>
                </tr>
                <tr>
                    <?php
                    $date=date("Y-m-d");
                    ?>
                    <td style="color: black; padding:0 0 0 5px; width: 10%">Address</td>
                    <td style="color: black; padding:0 0 0 5px;">:</td>
                    <td colspan="6" style="color: black; padding:0 0 0 5px; border-right: 1px solid black;">{!! $quotation->latest_lead->address ." ". $provinces[$quotation['province']] ." ". $quotation->latest_lead->postcode!!}</td>
                    <td style="color: black; padding:0 0 0 5px;">Date : </td>
                    <td style="color: black; padding:0 0 0 5px;">{{localDate($date)}}</td>
                </tr>
                <tr>
                    <td style="color: black; padding:0 0 0 5px; width: 10%">Taxes ID</td>
                    <td style="color: black; padding:0 0 0 5px;">:</td>
                    <td colspan="6" style="color: black; padding:0 0 0 5px; border-right: 1px solid black;"> -</td>
                    <td style="color: black; padding:0 0 0 5px;">Salesperson : </td>
                    <td style="color: black; padding:0 0 0 5px;border-right: 1px solid black;">{!! $quotation->latest_sale->name !!}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="5" style="border-right: 1px solid black;"><span style="color: black;"></span></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td colspan="5" style="border-right: 1px solid black;"><span style="color: black;"></span></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td style="color: black; padding:0 0 0 5px; width: 10%">Tel</td>
                    <td style="color: black; padding:0 0 0 5px;">:</td>
                    <td style="color: black; padding:0 0 0 5px;">{!! $quotation->latest_lead->phone !!}</td>
                    <td colspan="4" style="color: black; padding:0 0 0 5px;">Fax :</td>
                    <td style="border-right: 1px solid black; padding:0 0 0 5px;"> -</td>
                    <td style="color: black; padding:0 0 0 5px;">Mobile : </td>
                    <td style="color: black; padding:0 0 0 5px;">{!! $quotation->latest_sale->phone !!}</td>
                </tr>
                <tr>
                    <td style="border-bottom: 1px solid black; width: 10%; padding:0 0 5px 5px;">contact</td>
                    <td style="border-bottom: 1px solid black; padding:0 0 5px 5px;">:</td>
                    <td style="border-bottom: 1px solid black; width: 10%; padding:0 0 5px 5px;">คุณทรงสิทธิ์</td>
                    {{--<td style="border-bottom: 1px solid black;"><span style="color: black;"></span></td>--}}
                    <td colspan="3" style="border-bottom: 1px solid black; padding:0 0 5px 5px;">Email : </td>
                    <td colspan="2" style="border-right: 1px solid black; border-bottom: 1px solid black; padding:0 0 5px 5px;"> afmanager@stms.co.th</td>
                    <td style="color: black; padding:0 0 5px 5px;">Email : </td>
                    <td style="color: black; padding:0 0 5px 5px;">{!! $quotation->latest_sale->email !!}</td>
                </tr>
                <tr>
                    <td colspan="4" style="color: black; padding:0 0 0 5px;">payment(การชำระเงิน)</td>
                    <td style="color: black; padding:5px;">:</td>
                    <td colspan="5" style="color: black; padding:0 0 0 5px;">7 วัน</td>
                </tr>
                <tr>
                    <td colspan="4" style="color: black; padding:0 0 0 5px;">Delivery(กำหนดส่งสินค้า)</td>
                    <td style="color: black; padding:5px;">:</td>
                    <td colspan="5" style="color: black; padding:0 0 0 5px;">10 วันหลังลงลายมื่อชื่อในใบสั่งซื้อนี้</td>
                </tr>
            </table>
        </div>

        <br><br>

        <div class="table_content">
            <table style="border: 1px solid black;" width="100%" class="line_table styletable">
                <tr style="background-color: #d4d4d6">
                    <th align="left" class="line_table" style="padding:0 0 0 5px;">No.</th>
                    <th align="left" class="line_table" style="padding:0 0 0 5px; width: 100px;">Description</th>
                    <th class="line_table" style="text-align: center; width: 50px;">Project</th>
                    <th class="line_table" style="text-align: center; width: 50px;">Month</th>
                    <th class="line_table" style="text-align: center; width: 60px;">Unit Price</th>
                    <th class="line_table" style="text-align: center; width: 60px;">Total</th>
                </tr>
                <?php $i=1;
                $sum_service=0;?>
                @foreach($quotation_service as $row)
                    <tr>
                        <td class="line_table" style="vertical-align: top; padding:0 0 0 5px;">{!! $i !!}</td>
                        <td class="line_table" width="65%" style="padding:0 0 0 5px;">
                            {!! $row->lastest_package->name !!}<br>{!! $row->lastest_package->description !!}</td>
                        </td>
                        <td style="vertical-align: top; text-align: right; padding:0 5px 0 0;"  class="line_table">{!! number_format($row->project_package,0) !!}</td>
                        <td style="vertical-align: top; text-align: right; padding:0 5px 0 0;"  class="line_table">{!! $row->month_package !!}</td>
                        <td style="vertical-align: top; text-align: right; padding:0 5px 0 0;"  class="line_table">{!! $row->unit_package !!}</td>
                        <td align="right" style="vertical-align: top; padding:0 5px 0 0;"  class="line_table">{!! number_format($row->total_package,2) !!}</td>
                    </tr>
                    <?php $i++;
                    $num = $i;
                    $sum_service += $row->total_package;
                    ?>
                @endforeach
                <?php
                /*$sum_package =($quotation->package_unit*$quotation->month_package)*$quotation->unit_package;
                $total_vat=($sum_package+$sum_service)*(7/100);
                $total_after_vat=$sum_package+$sum_service;
                $grand_total=$total_after_vat+$total_vat;

                if($quotation->lastest_package->vat ==1){
                    //$vat=($quotation->lastest_package->price*7)/100;
                    $total_vat1="( ราคาหลังคิด Vat ".number_format((($quotation->lastest_package->price*7)/100)+$quotation->lastest_package->price,2)." )";
                }else{
                    $total_vat1="( ราคาสุทธิ์ ".number_format($quotation->lastest_package->price,2)." )";
                }*/
                ?>
        <tr>
            <td colspan="3" rowspan="4" align="center" style="vertical-align: center; border-bottom:0px solid black; border-left:0px solid black;"><span style="color: black;">{!! convertIntToTextThai($quotation->product_price_with_vat) !!}</span></td>
            <td align="left" colspan="2" style="border-left: 1px solid black; border-right: 1px solid black; padding:0 0 0 5px;">Sub Total</td>
            <td align="right" style="padding:0 5px 0 0;">{!! number_format($sum_service,2) !!}</td>
        </tr>
        <tr>
            <td align="left" colspan="2" style="border-left: 1px solid black; border-right: 1px solid black; padding:0 0 0 5px;">Discount</td>
            <td align="right" style="padding:0 5px 0 0;">{!! number_format($quotation->discount,2) !!}</td>
        </tr>
        <tr>
            <td align="left" colspan="2" style="border-left: 1px solid black;border-right: 1px solid black; padding:0 0 0 5px;">Vat 7%</td>
            <td align="right" style="padding:0 5px 0 0;">{!! number_format($quotation->product_vat,2) !!}</td>
        </tr>
        <tr>
            <td align="left" colspan="2" style="border-left: 1px solid black;border-right: 1px solid black; padding:0 0 0 5px;" >Grand Total</td>
            <td align="right" style="padding:0 5px 0 0;">{!! number_format($quotation->product_price_with_vat,2) !!}</td>
        </tr>
        </table>
        <br>
        <span style="color: black;">หมายเหตุ<br>
                                1. ใบเสนอราคานี้มีผล 15 วัน นับจากวันที่ยื่นในใบเสนอราคา	<br>
                                2. ขอสงวนสิทธิ์ในการเปิดเผยใบเสนอราคานี้ต่อบุคคลที่สาม หากฝ่าฝืนใบเสนอราคานี้ถือว่าเป็นอันสิ้นสุด<br>
                                3. พิเศษ ส่วนลดค่าติดตั้งระบบโครงการที่ 2 มูลค่า 2,500 บาท <br></span>
    </div><br>
    <div class="sign">
        <table width="100%" >
            <tr>
                <td align="center" style="vertical-align: top; font-weight: bold; padding:5px;">บริษัท โอกาสพลัส จำกัด<br><br>
                    _____________________________<br>
                    ( {!! $quotation->latest_sale->name !!}  )<br>
                    Sales & Marketing Director</td>
                <td align="center" style="font-weight: bold; color: black; padding:5px;">Aprroval to Payment<br><br>
                    Signature  ____________________________<br><br>
                    Name (_____________________________)<br><br>
                    position (_____________________________)</td>
            </tr>
        </table>
    </div>
    </div>
@stop