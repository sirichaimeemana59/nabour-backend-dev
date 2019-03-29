@extends('print')
<style>
    .title_left{
        text-align:right;
        margin:0;
    }
    .content{
        font-size: 12px;
        color: #0c0c0c;
        /*font-family: 'thonburi';*/
        margin: 25px;
    }
    table ,tr,td,th{
        padding: 5px;
        /*font-family: 'thonburi';*/
        font-size: 12px;
        /*border: 1px solid black;*/
    }
    .headcontent{
        text-align: center;
        font-weight: bold;
    }
</style>

@section('content')
    <div class="content">
        <div class="title_left">
            <table width="100%">
                <tr>
                    <td style="padding: 5px;" width="80%"></td>
                    <td width="20%" style="text-align: right;"><img src="{{asset('images/logo1.png')}}" alt="" width="90px"></td>
                </tr>
            </table>
        </div>

<p style="text-align: right; margin-right: 25px;"><b>อ้างอิง Contract No. </b>  {!! $rows->contract_id !!}</p>
<div class="headcontent">
    <p>เอกสารแนบท้ายใช้ระบบ "เนเบอร์ แพลตฟอร์ม"</p>
    <p>สรุปรายงานการใช้งานประจำเดือน {!! localDate(Date('Y-m-d')) !!}</p>
    <p>ลูกค้า : {!! $rows->latest_contract->customer->firstname !!}  {!! $rows->latest_contract->customer->lastname !!}</p>
</div>

        <table width="100%">
            <tr>
                <th style="text-align: center;">ลำดับที่</th><th style="text-align: center;">ชื่อโครงการนิติบุคคลอาคารชุด</th><th style="text-align: center;">ลักษณะการใช้งาน</th><th style="text-align: center;">วันที่ขึ้นระบบ</th><th style="text-align: center;">วันที่เริ่มรอบบิล</th><th style="text-align: center;">ค่าบริการ (รายเดือน)</th>
            </tr>
            <?php
            $i=1;
            ?>
            @foreach($p_rows as $row)
                <tr>
                    <td style="text-align: center;">{!! $i; !!}</td>
                    @if(!empty($row->latest_property))
                        <td>{!!$row->latest_property->property_name_th!!}</td>
                    @else
                        <td>ไม่พบข้อมูล</td>
                    @endif
                    <td></td>
                    <td>@if(empty($row->start_date)) - @else {!! localDate($row->start_date) !!} @endif</td>
                    <td></td>
                    {{--<td>@if(empty($row->end_date)) - @else {!! localDate($row->end_date) !!} @endif</td>--}}
                    {{--<td>{!! localDate(Date('y-m-d')) !!}</td>--}}
                    <td style="text-align: right;">@if(empty($row->latest_contract)) - @else <?php $sum = $row->latest_contract->latest_quotation->product_price_with_vat+ $row->latest_contract->latest_quotation->product_vat+ $row->latest_contract->latest_quotation->grand_total_price;?>{!! number_format($sum,2) !!} @endif</td>
                </tr>
                <?php
                $i++;
//                $total_product_price_with_vat += $row->latest_contract->latest_quotation->product_price_with_vat;
//                $total_product_price_with_vat += $row->latest_contract->latest_quotation->product_price_with_vat;
//                $total_product_price_with_vat += $row->latest_contract->latest_quotation->product_price_with_vat;
                ?>
            @endforeach
            <tr>
                <td rowspan="3" colspan="5" style="text-align: right;"><p><b>รวม</b></p><p><b>ภาษีมูลค่าเพิ่ม VAT 7%</b></p><p><b>ยอดรวมสุทธิ</b></p></td>
                <td></td>
            </tr>
            <tr><td></td></tr>
            <tr><td></td></tr>
        </table>
<div class="headcontent">
    <p>สรุปสถานะการใช้งานระบบเนเบอร์ แพลตฟอร์มทั้งหมดจำนวน {!! count($p_rows) !!} โครงการ</p>
    <p>เป็นไปตามปกติตามที่ได้รับมอบหมายและอยู่ในสถานะเรียบร้อยทุกประการ</p>
</div>

<table>
    <tr>
        <td align="center" style="vertical-align: top; font-weight: bold; padding:5px;"><br><br>
            <p>ลงชื่อ ................................... ผู้ใช้บริการ</p>
            ( ....................  )<br>
            .........................</td>
        <td align="center" style="vertical-align: top; font-weight: bold; padding:5px;">
           <p>ลงชื่อ <img src="{!! asset('images/signaturepq.png') !!}" alt="" width="200px"> ผู้ให้บริการ</p>
            ( คุณ วีรยุทธ  งานดี  )<br>
            บริษัท โอกาสพลัส จำกัด</td>
        <td align="center" style="vertical-align: top; font-weight: bold; padding:5px;"><br><br>
            <p>ลงชื่อ ................................... ผู้จัดการฝ่ายบัญชี</p>
            ( คุณ ปณิทัต วรรัตนสุภา  )<br>
            บริษัท โอกาสพลัส จำกัด</td>
    </tr>
</table>
    </div>
@stop