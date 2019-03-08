@extends('print')
<style>
    .title_left{
        text-align:left;
        margin:0;
    }
    .line_table{
        border: 1px solid black;
    }
    .styletable {
        border-collapse: collapse;
        width: 100%;
    }
    .content{
        margin: 25px 30px 25px 90px;
    }
    table ,tr,td,th{
        padding: 5px;
        /*font-family: 'thonburi';*/
        font-size: 14px;
        /*border: 1px solid black;*/
    }
</style>

@section('content')
    <?php
    $count_contract = count($contract);
    //dd($customer->user_company->directer_company);
    ?>
    @foreach($contract as $row)
        <div class="content">
            <table>
                <tr>
                    <td style="width: 90%;"><h3 style="text-align: center;bottom: 0;">แบบฟอร์มเปิดหน้าบัญชี</h3></td>
                    <td style="text-align: right; width: 30%;"><img src="{{asset('images/logo1.png')}}" alt="" width="90px"></td>
                </tr>
            </table>
            <br>
            <div style="text-align: right;"><p>รหัสสัญญา :  {!! $row->contract_code !!}</p><p>วันที่ {!! localDate(Date('Y-d-m')) !!}</p></div>

            <div>
                <p>ชื่อสถานประการ(ภาษาไทย) : {!! $customer->company_name !!}</p>
                <p>Company Name(English) : {!! $customer->company_name !!}</p>
                <p>เลขประจำตัวผู้เสียภาษีอากร @if(!empty($customer->user_company->tax_id)){!! $customer->user_company->tax_id !!}@else ...........................@endif วันที่จดทะเบียน..............................ทุนจดทะเบียน..........................
                </p>
                <p>ลักษณะธุรกิจ.....................................................................................................................................................</p>
                <p>ที่อยู่:  เลขที่&nbsp;&nbsp;{!! $customer->user_company->address_no !!}  {!! $customer->user_company->address_th !!}&nbsp;&nbsp;หมูที่…………ซอย………………..ถนน&nbsp;&nbsp;{!! $customer->user_company->street_th !!}&nbsp;&nbsp;</p>
                <p>จังหวัด {!! $provinces[$customer->user_company->province_company] !!}รหัสไปรษณีย์ {!! $customer->user_company->postcode_company !!}
                    โทร {!! $customer->user_company->tel_company !!} แฟ็กซ์ {!! $customer->user_company->fax_company !!} มือถือ {!! $customer->user_company->phone_company !!}</p>
                <p>E-mail Address  {!! $customer->user_company->mail_company !!}  ผู้ติดต่อ {!! $customer->firstname !!}  {!! $customer->lastname !!}</p>
                <p>กรรมการของบริษัท
                @if(!empty($customer->user_company->directer_company))
                    <?php
                    $cut_directer = explode(',',$customer->user_company['directer_company']);
                    $count = count($cut_directer);
                    //dd($customer->user_company->directer_company);
                    ?>
                    @for($i=0;$i<$count;$i++)
                        <p style="margin-left: 35px;"> {!! $i+1 !!} . {!! $cut_directer[$i] !!}</p>
                    @endfor
                @else
                    ไม่พบข้อมูล
                    @endif
                    </p>
                    <hr>
                    <p><b>ออกใบแจ้งหนี้/ใบกับกับภาษี/ใบเสร็จรับเงินในนาม </b> บริษัท……………………………</p>
                    <p>ที่อยู่:  เลขที่………………..หมูที่………………….ซอย………………..ถนน………</p>
                    <p>ตำบล/แขวง…………….อำเภอ/เขต……………..จังหวัด…………………….รหัสไปรษณีย์……….</p>
                    <p>โทร………………………..แฟ็กซ์…………………………….มือถือ…………</p>
                    <p>วันวาง/วันจ่าย……………………………………...เวลา…………………</p>
                    <p>ชื่อ-นามสกุล(ผู้ติดต่อ).............................ตำแหน่ง…………………...โทร……………...Email………</p>
                    <p>วิธีการวางบิล : ____________________________________</p>
                    <hr>
                    <p><b>เอกสารแนบท้าย</b></p>

                    <tr>
                        <td style="width: 200px;"><input type="checkbox">  นิติบุคคลอาคารชุด</td>
                        <td style="width: 200px;">&nbsp;&nbsp;<input type="checkbox">  นิติบุคคลหมู่บ้านจัดสรร</td>
                    </tr>
                    <table>
                        <tr>
                            <td style="width: 200px;">1.<input type="checkbox">  ภ.พ.09</td>
                            <td style="width: 200px;">&nbsp;&nbsp;5.<input type="checkbox">  สำเนาบัตรประาชน</td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">2.<input type="checkbox">  หนังสือรับรองบริษัท</td>
                            <td style="width: 200px;">&nbsp;&nbsp;6.<input type="checkbox">  ระเบียบวางบิลและรับเช็ค</td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">3.<input type="checkbox">  ภ.พ.20</td>
                            <td style="width: 200px;">&nbsp;&nbsp;7.<input type="checkbox">  ...........................</td>
                        </tr>
                        <tr>
                            <td style="width: 200px;">4.<input type="checkbox">  ...........................</td>
                            {{--<td style="width: 200px;">&nbsp;&nbsp;<input type="checkbox">  ...........................</td>--}}
                        </tr>
                    </table>
                    <br>

                    <div class="sign">
                        <table width="100%" >
                            <tr>
                                <td align="center" style="vertical-align: top; font-weight: bold; padding:5px;"><br><br>
                                    _____________________________<br>
                                    ( วีรยุทธ  งานดี  )<br>
                                    Sales person</td>
                                <td align="center" style="font-weight: bold; color: black; padding:5px;"><br>
                                    ____________________________<br>
                                    ผู้จัดทำ</td>
                            </tr>
                        </table>
                    </div>
            </div>
        </div>
        @endforeach
@stop