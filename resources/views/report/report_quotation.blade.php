@extends('print')
<style>
    .title_left{
        text-align:left;
        margin:25px 0 0 25px;
    }
    .line_table{
        border: 1px solid black;
    }
    .styletable {
        border-collapse: collapse;
        width: 100%;
    }
    .content{
        font-size: 14px;
        color: #0c0c0c;
        font-family: 'thonburi';
    }
    table ,tr,td,th{
        padding: 5px;
        font-family: 'thonburi';
        font-size: 12px;
    }
</style>

@section('content')
    <div class="content">
        <div class="title_left">
            <table>
                <tr>
                    <td width="20%"><img src="{{asset('images/logo1.png')}}" alt="" width="100%"></td>
                    <td ><span style="color: black;">บริษัท โอกาสพลัส จำกัด</span> <br> <span style="color: black;">428 ชั้น6 ซอยเอกมัย 26 ถ.สุขุมวิท63</span>	 <br> <span style="color: black;">แขวงคลองตันเหนือ เขตวัฒนา กทม 10110</span> <br> <span style="color: black;">สาขา สำนักงานใหญ่</span> <br> <span style="color: black;">โทร 02-1183440 อีเมล : admin@o-kaatdivlus.com</span>	<br> <span style="color: black;">เลขที่ประจำตัวผู้เสียภาษี 0105561013024</span><br></td>
                </tr>
            </table>
        </div>
        <h1 align="center"><span>ใบเสนอราคา/ใบสั่งซื้อ</span></h1>
        <div align="center"><span>Quaotation/Purchase Order</span></div>
        <br>
        <div class="title_herder">
            <table style="border: 1px solid black; color: black;" width="100%">
                <tr>
                    <td colspan="2"><span style="color: black;">Attention</span></td>
                    <td><span style="color: black;">: {!! $quotation->latest_lead->firstname !!}</span></td>
                    <td colspan="5" style="border-right: 1px solid black; color: black;"><span style="color: black;"></span></td>
                    <td><span style="color: black;">No : {!! $quotation->quotation_code !!}</span></td>
                    <td><span style="color: black;"></span></td>
                </tr>
                <tr>
                    <td colspan="8" style="border-right: 1px solid black; color: black;"></td>
                    <td><span style="color: black;">Date : </span></td>
                    <?php
                    $date=date("Y-m-d");
                    ?>
                    <td><span style="color: black;">{{localDate($date)}}</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span style="color: black;">Address</span></td>
                    <td><span style="color: black;">: {!! $quotation->latest_lead->address ." ". $provinces[$quotation['province']] ." ". $quotation->latest_lead->postcode!!}</span></td>
                    <td colspan="5" style="border-right: 1px solid black;"><span style="color: black;"></span></td>
                    <td><span style="color: black;">Salesperson : {!! $quotation->latest_sale->name !!}</span></td>
                    <td><span style="color: black;"></span></td>
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
                    <td colspan="2"><span style="color: black;">Taxes ID</span></td>
                    <td><span style="color: black;">: -</span></td>
                    <td colspan="5" style="border-right: 1px solid black;"><span style="color: black;"></span></td>
                    <td colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="2"><span style="color: black;">Tel</span></td>
                    <td><span style="color: black;">: {!! $quotation->latest_lead->phone !!}</span></td>
                    <td colspan="2"><span style="color: black;"></span></td>
                    <td><span style="color: black;">Fax : </span></td>
                    <td colspan="2" style="border-right: 1px solid black;"><span style="color: black;"></span></td>
                    <td><span style="color: black;">Mobile : {!! $quotation->latest_sale->phone !!}</span></td>
                    <td><span style="color: black;"></span></td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom: 1px solid black;"><span style="color: black;">contact</span></td>
                    <td style="border-bottom: 1px solid black;"><span style="color: black;">:</span></td>
                    <td style="border-bottom: 1px solid black;"><span style="color: black;">คุณทรงสิทธิ์</span></td>
                    <td style="border-bottom: 1px solid black;"><span style="color: black;">Email : </span></td>
                    <td colspan="3" style="border-right: 1px solid black; border-bottom: 1px solid black;"><span style="color: black;">afmanager@stms.co.th</span></td>
                    <td><span style="color: black;">Email : {!! $quotation->latest_sale->email !!}</span></td>
                    <td><span style="color: black;"></span></td>
                </tr>
                <tr>
                    <td colspan="2"><span style="color: black;">payment(การชำระเงิน)</span></td>
                    <td><span style="color: black;">: </span></td>
                    <td colspan="7"><span style="color: black;">7 วัน</span></td>
                </tr>
                <tr>
                    <td colspan="2"><span style="color: black;">Delivery(กำหนดส่งสินค้า)</span></td>
                    <td><span style="color: black;">: </span></td>
                    <td colspan="7"><span style="color: black;">10 วันหลังลงลายมื่อชื่อในใบสั่งซื้อนี้</span></td>
                </tr>
            </table>
        </div>

        <br>
        <span>หมายเหตุ : พิเศษ ส่วนลดค่าติดตั้งระบบโครงการที่ 2 มูลค่า 2,500 บาท</span>
        <br><br>

        <div class="table_content">
            <table style="border: 1px solid black;" width="100%" class="line_table styletable">
                <tr style="background-color: #d4d4d6">
                    <th align="left" class="line_table"><span style="color: black;">No.</span></th>
                    <th colspan="5" align="left" class="line_table"><span style="color: black;">Description</span></th>
                    <th align="center" class="line_table"><span style="color: black;">Project</span></th>
                    <th align="center" class="line_table"><span style="color: black;">Month</span></th>
                    <th align="center" class="line_table"><span style="color: black;">Unit Price</span></th>
                    <th align="center" class="line_table"><span style="color: black;">Total</span></th>
                </tr>
                <?php $i=1;
                $sum_service=0;?>
                @foreach($quotation_service as $row)
                    <tr>
                        <td class="line_table" style="vertical-align: top;"><span style="color: black;">{!! $i !!}</span></td>
                        <td colspan="5" class="line_table" width="65%">
                            <span style="color: black;"><div>{!! $row->lastest_package->name !!}<br>{!! $row->lastest_package->description !!}</div></span></td>
                        </td>
                        <td style="vertical-align: top; text-align: right;"  class="line_table"><span style="color: black;">{!! number_format($row->project_package,0) !!}</span></td>
                        <td style="vertical-align: top; text-align: right;"  class="line_table"><span style="color: black;">{!! $row->month_package !!}</span></td>
                        <td style="vertical-align: top; text-align: right;"  class="line_table"><span style="color: black;">{!! $row->unit_package !!}</span></td>
                        <td align="right" style="vertical-align: top;"  class="line_table"><div><span style="color: black;">{!! number_format($row->total_package,2) !!}</span></div></td>
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
                    <td  class="line_table" style="vertical-align: top;"><span style="color: black;">{!! $num !!}</span></td>
                    <td colspan="5" class="line_table">
                        <span style="color: black;"><div>{!! $quotation1->lastest_package->name !!}<br>{!! $quotation1->lastest_package->description !!}</div></span></td>
        </td>
        <td style="vertical-align: top; text-align: right;"  class="line_table"><span style="color: black;">{!! number_format($quotation1->product_amount,0) !!}</span></td>
        <td style="vertical-align: top; text-align: right;"  class="line_table"><span style="color: black;">{!! number_format($quotation1->month_package,0) !!}</span></td>
        <td style="vertical-align: top; text-align: right;"  class="line_table"><span style="color: black;">{!! number_format($quotation1->unit_price,2) !!}</span></td>
                    <?php
                        $price=$quotation1->lastest_package->price*$quotation1->product_amount*$quotation1->month_package;
                        $sum_total=$sum_service+$price;
                        $vat=($sum_total*7)/100;
                        $grand=$vat+$sum_total;
                        ?>
        <td align="right" style="vertical-align: top;"  class="line_table"><div><span style="color: black;">{!! number_format($price,2) !!}</span></div></td>
        </tr>
        <tr>
            <td colspan="7" rowspan="4" align="center" style="vertical-align: center; border-bottom:0px solid black; border-left:0px solid black;"><span style="color: black;">{!! convertIntToTextThai($grand) !!}</span></td>
            <td align="left" colspan="2" style="border-left: 1px solid black; border-right: 1px solid black;"><div><span style="color: black;">Sub Total</span></div></td>
            <td align="right"><span style="color: black;">{!! number_format($sum_total,2) !!}</span></td>
        </tr>
        <tr>
            <td align="left" colspan="2" style="border-left: 1px solid black;border-right: 1px solid black;" ><div><span style="color: black;">Discount</span></div></td>
            <td align="right"><span style="color: black;">{!! number_format($quotation1->discount,2) !!}</span></td>
        </tr>
        <tr>
            <td align="left" colspan="2" style="border-left: 1px solid black;border-right: 1px solid black;" ><div><span style="color: black;">Vat 7%</span></div></td>
            <td align="right"><span style="color: black;">{!! number_format($vat,2) !!}</span></td>
        </tr>
        <tr>
            <td align="left" colspan="2" style="border-left: 1px solid black;border-right: 1px solid black;" ><div><span style="color: black;">Grand Total</span></div></td>
            <td align="right"><div><span style="color: black;">{!! number_format($grand,2) !!}</span></div></td>
        </tr>
        </table>
        <br>
        <span style="color: black;">หมายเหตุ<br>
                                1. ใบเสนอราคานี้มีผล 15 วัน นับจากวันที่ยื่นในใบเสนอราคา	<br>
                                2. ขอสงวนสิทธิ์ในการเปิดเผยใบเสนอราคานี้ต่อบุคคลที่สาม หากฝ่าฝืนใบเสนอราคานี้ถือว่าเป็นอันสิ้นสุด<br></span>
    </div><br>
    <div class="sign">
        <table width="100%" >
            <tr>
                <td align="center" style="vertical-align: top;"><div><span style="font-weight: bold; color: black;">บริษัท โอกาสพลัส จำกัด</span>	</div><br><br>
                    <div><span style="color: black;">_____________________________</span></div><br>
                    <div><span style="color: black;">( {!! $quotation->latest_sale->name !!}  )</span></div>
                    <div><span style="color: black;">Sales & Marketing Director</span></div></td>
                <td align="center"><div><span style="font-weight: bold; color: black;">Aprroval to Payment</span></div><br><br>
                    <div><span style="color: black;">Signature  _____________________________</span></div><br><br>
                    <div><span style="color: black;">Name (_____________________________)</span></div><br><br>
                    <div><span style="color: black;">position (_____________________________)</span></div></td>
            </tr>
        </table>
    </div>
    </div>
@stop