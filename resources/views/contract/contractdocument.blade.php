@extends('print')
        <?php
        $type_service= unserialize(constant('type_service'));

        $property_type = unserialize(constant('PROPERTY_TYPE_TH'));
        ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <style type="text/css">
        *{
            margin: 0%;
            padding: 0%;
        }
        .font{
            color: black;
        }
        .title{
            margin-top:35px;

        }
        body{
            counter-reset: page 1;
        }
        .con{
            margin:45px 35px  35px  35px;
            color:black;
            line-height: 18pt;
            font-family: 'thonburi';
            counter-increment: page;
            display: block;
            page-break-after:always;
        }
        .numberh{
            margin:0 0 0 40px;
            font-size:16px;
            color:black;

        }
        .numberdetail{margin:0 0 0 50px;font-size:16px;color:black;}
        .subdetail{margin:0 0 0 55px;font-size:16px;color:black;}
        .subnode{margin:0 0 0 70px;font-size:16px;color:black;}
        .boxleft{float: left;color:black;}
        .boxright{float: right;color:black;}

        #header {left: 0px;margin-right: 0; margin-top:-10px;font-size: 14px;}
        #footer {position:fixed;bottom: 3px;text-align: center;}


        #pageFooter::after {
            /* counter-reset: page 2; */
            content: counter(page) " / 6" ;
            text-align: right;
            font-size:16px;
        }

        span.a {
            display: inline;
            width: 50px;
            height: 50px;
            padding: 5px;
            border-top: 2px solid black;
        }
    </style>

</head>
<body>
@section('content')
    <span id="pageFooter"></span><header align="right" id="header"><img src="{{asset('images/logo1.png')}}" alt="" width="10%"></header>
    <div class="con">
        <div class="title">
            <div style="font-size=18px; font-weight: bold;" align="center">สัญญาใช้บริการและอนุญาตให้ใช้สิทธิ์ใน</div>
            <div style="font-size=18px; font-weight: bold;" align="center">ระบบบริหารจัดการงานนิติบุคคลหมู่บ้านจัดสรรและอาคารชุดออนไลน์ และโมบายแอปพลิเคชัน</div>
            <div style="font-size=18px; font-weight: bold;" align="center">“เนเบอร์”</div>
        </div>
        <br>
        <div align="right" style="font-size:16px;">สัญญาเลขที่  {!! $quotation->contract_code !!}</div>
        <br>


        <div style="font-size:16px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; สัญญาฉบับ นี้ทำขึ้น ณ บริษัท โอกาสพลัส จำกัด เมื่อวันที่ {!!localDate(date("Y-m-d"))!!} ระหว่าง {!! $quotation->latest_lead->company_name !!} ที่อยู่ {!! $quotation->latest_lead->address !!}  จังหวัด {!! $provinces[$quotation->customer->province] !!}   {!! $quotation->latest_lead->postcode !!}  <u>“ผู้ใช้บริการ”</u>
            ฝ่ายหนึ่งกับ บริษัท โอกาสพลัส จำกัด เลขที่ 428 ชั้น 6 ซอยสุขุมวิท 63 แขวงคลองตันเหนือ เขตวัฒนา
            กรุงเทพฯ 10110 <u>“ผู้ให้บริการ”</u> อีกฝ่ายหนึ่งคู่สัญญาได้ตกลงทำสัญญากันและมีข้อความดังต่อไปนี้</div><br>
        <div class="numberh">
            1.  &nbsp;&nbsp;&nbsp;<u>การอนุญาตใช้โปรแกรมคอมพิวเตอร์</u>


            <div class="numberdetail">
                <div> 1.1  &nbsp;&nbsp;&nbsp;ผู้ให้บริการเป็นเจ้าของลิขสิทธิ์และมีสิทธิ์อนุญาตให้ใช้ระบบเว็บแอปพลิเคชันบริหารจัดการนิติบุคคลหมู่บ้านจัดสรร และอาคารชุดออนไลน์ ชื่อ "เนเบอร์"(NABOUR) และเอกสารที่ระบุในสัญญานี้ (ซึ่งในสัญญานี้เรียกว่าโปรแกรมคอมพิวเตอร์) สำหรับผู้บริหารนิติบุคคลบ้านจัดสรรและนิติบุคคลอาคารชุด<br>
                    1.2 &nbsp;&nbsp;&nbsp;ผู้ให้บริการเป็นเจ้าของลิขสิทธิ์และมีสิทธิ์อนุญาตให้ใช้โมบายแอปพลิเคชันและเว็บแอปพลิเคชันชื่อ "เนเบอร์"(NABOUR) และเอกสารที่ระบุในสัญญานี้ (ซึ่งในสัญญานี้เรียกว่าโปรแกรมคอมพิวเตอร์) สำหรับที่อยู่อาศัยหรือลูกค้า หรือลูกค้าของผู้ใช้บริการ โดยไม่จำกัดจำนวนผู้ใช้งาน ภายในนิติบุคคล<br>
                    1.3 &nbsp;&nbsp;&nbsp;ผู้ให้บริการมีสิทธิ์ที่จะนำเสนอข้อมูลข่าวสารและประชาสัมพันธ์ที่คิดว่าเป็นประโยชน์ต่อผู้อยู่อาศัยหรือลูกบ้านหรือลูกค้าของผู้ใช้บริการผ่านโมบายแอปพลิเคชันและเว็บแอปพลิเคชันที่ระบุในสัญญาฉบับนี้ได้<br>
                    1.4 &nbsp;&nbsp;&nbsp;ผู้ให้บริการตกลงให้ผู้ใช้บริการใช้โปรแกรมคอมพิวเตอร์ตามที่ระบุในสัญญานี้ใน ลักษณะดังต่อไปนี้</div><br>
            </div>
        </div>
        <div class="numberh">
            <div> 2.  &nbsp;&nbsp;&nbsp;<u>สิทธิ์ของคู่สัญญา</u><br>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ผู้ใช้บริการมีสิทธิ์ในการครอบครองบัญชีผู้จัดการนิติบุคคลเป็นจำนวน 1 บัญชี แต่ไม่จำกัดจำนวนบัญชี สำหรับเจ้าหน้าที่นิติบุคคล<br></div>
            <div class="numberdetail">
                <div> 2.1 &nbsp;&nbsp;&nbsp; ผู้ใช้บริการมีสิทธิ์ในการนำโปรแกรมคอมพิวเตอร์ไปใช้ดำเนินงานภายในของ "{!! $quotation->latest_lead->company_name !!}" เท่านั้น <br>
                </div>

            </div>
        </div>
    </div>
    <span id="pageFooter"></span><header align="right" id="header">สัญญาเลขที่ {!! $quotation->contract_code !!} &nbsp;&nbsp;&nbsp;<img src="{{asset('images/logo1.png')}}" alt="" width="10%"></header>
    <div class="con">
        <div class="numberh">
            <div class="numberdetail">
                <div>
                    2.2 &nbsp;&nbsp;&nbsp; ผู้ใช้บริการมีสิทธิ์ในการใช้งานโมบายแอปพลิเคชัน สำหรับที่อยู่อาศัยหรือลูกบ้าน ที่อาศัยอยู่ภายใน "{!! $quotation->latest_lead->company_name !!}" ได้ไม่จำกัดจำนวนผู้ใช้งาน<br>
                    2.3 &nbsp;&nbsp;&nbsp; ผู้ใช้บริการมีสิทธิ์ที่จะใช้โปรแกรมคอมพิวเตอร์และเอกสารต่างๆ ตามที่ระบุใน สัญญานี้<br>
                    2.4 &nbsp;&nbsp;&nbsp; ผู้ใช้บริการไม่มีสิทธิ์ที่จะให้เช่าโปรแกรมคอมพิวเตอร์หรือเอกสารหรือสิทธิ์ใด ๆ ที่ให้ไว้ ตามสัญญานี้แก่บุคคลอื่น เว้นแต่จะได้รับความยินยอมจากฝ่ายผู้ให้บริการ เป็นลายลักษณ์อักษร<br>
                    2.5 &nbsp;&nbsp;&nbsp; ผู้ใช้บริการไม่มีสิทธิ์ทำซ้ำ, ดัดแปลง, นำออกโฆษณา, แปล, แก้ไขชื่อ, ซึ่งโปรแกรมคอมพิวเตอร์เว้นแต่จะได้รับความยินยอมจากผู้ให้บริการเป็นลายลักษณ์อักษรหรือกรณีที่กฎหมายอนุญาตให้ทำได้<br>
                    2.6 &nbsp;&nbsp;&nbsp; ผู้ใช้บริการขอรับรองว่า จะไม่ลบ, ทำลาย ทำให้เสียหายหรือทำให้ไม่ชัดเจน ซึ่งเครื่องหมายหรือสัญลักษณ์แสดงความเป็นเจ้าของลิขสิทธิ์หรือเครื่องหมายการค้าของผู้ให้บริการโดยจงใจหรือประมาทเลินเล่ออย่างร้ายแรง<br></div>
            </div>
        </div> <br>
        <div class="numberh">
            <div> 3.  &nbsp;&nbsp;&nbsp;<u>อัตราค่าบริการ, ระยะเวลาการใช้บริการ และการชำระเงิน</u></div><br>
            <div class="numberdetail">
                <div> 3.1 &nbsp;&nbsp;&nbsp; อัตราค่าบริการ แบ่งออกเป็น 2 รูปแบบ<br></div>
                <div class="subdetail">
                    <div>3.1.1 &nbsp;&nbsp;&nbsp; ค่าติดตั้งระบบจ่ายครั้งแรก ครั้งเดียว โครงการละ 5,000 บาท @if($quotation->type_service == 1){!! $type_service[$quotation->type_service] !!}@endif<br>
                        3.1.2 &nbsp;&nbsp;&nbsp; ค่าบริการรายเดือน ตามสัญญาเป็นเวลา 1 ปี คิดค่าใช้จ่ายตามการใช้งานจริง 2 รูปแบบการใช้งานของแต่ละโครงการดังนี้<br></div>
                </div>
                <div class="subnode">
                    @foreach($contract_detail as $key => $row)
                        <div> 3.1.2.{!! $key+1 !!}&nbsp;&nbsp
                            {!! $row->detail_name !!}  : {!! $row->detail !!}
                            <br>
                        </div>
                    @endforeach
                    {{--<div> 3.1.2.1 &nbsp;&nbsp;&nbsp--}}
                        {{--{!! $quotation->detail_service !!}--}}
                        {{--@foreach($quotation->latest_quotation_tran as $row)--}}
                           {{--{!! $row->lastest_package['name'] !!}<br>{!! $row->lastest_package['detail'] !!}--}}
                        {{--@endforeach--}}
                        {{--<br>--}}
                    {{--</div>--}}
                </div>

            </div>

        </div>
    </div>
    {{--<footer align="center" style="font-size:12px;text-align:center;" id="footer"><span style="margin:0 0 50px 0;" class="a"> คุณ {!! $quotation->latest_lead->firstname ." ". $quotation->latest_lead->lastname!!}</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="font-size:10px;"> บริษัท โอกาส พลัส จำกัด เลขที่ 428 ชั้น 6 ซอยสุขุมวิท63 แขวงคลองตันเหนือ เขตวัฒนา กรุงเทพ 10110</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="align:right;" class="a"> คุณจินตนา เลิศล้ำยิ่ง </span></footer>--}}
    <span id="pageFooter"></span><header align="right" id="header">สัญญาเลขที่ {!! $quotation->contract_code !!} &nbsp;&nbsp;&nbsp;<img src="{{asset('images/logo1.png')}}" alt="" width="10%"></header>
    <div class="con">
        <div class="subnode">
            <div>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ให้บริการสงวนสิทธิ์ในทุก ๆ 2 ปีสำหรับการปรับขึ้นราคาโดยการปรับราคาจะต้องไม่เกินร้อยละ 10 จากค่าบริการที่ได้ระบุในสัญญา หากมีการปรับขึ้นราคาทางผู้ให้บริการ จะต้องแจ้งให้ผู้ใช้บริการทราบล่วงหน้า เป็นเวลา 60 วัน ก่อนหมดสัญญา<br><br>
            </div>
        </div>
        <div class="numberdetail">
            <div class="numberdetail">
                <div> 3.2 &nbsp;&nbsp;&nbsp; วิธีการชำระเงิน<br>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วิธีการชำระผ่านการโอนเข้าบัญชีธนาคาร ของ บริษัท โอกาสพลัส จำกัด มีรายละเอียด ดังต่อไปนี้<br></div>
                <div class="subdetail">
                    <div> 3.2.1 &nbsp;&nbsp;&nbsp; ข้อมูลบัญชีธนาคาร<br>
                        ธนาคารยูโอบี สาขาทองหล่อ<br>
                        เลขที่บัญชี 8011669506<br>
                        บัญชีประเภทออมทรัพย์<br><br></div>
                </div>
            </div>
        </div>
        <div class="subnode">
            <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ใช้บริการจะทำการส่งหลักฐานการชำระเงินหรือ Pay-in-Slip เพื่อยืนยันการชำระเงินกับทางผู้ให้บริการ ทาง Fax หรือ Email เมื่อผู้ให้บริการได้รับเงินแล้วจะดำเนินการออกใบเสร็จรับเงินให้กับผู้รับบริการ</div><br>
        </div>
        <div class="numberh">
            <div class="numberdetail">
                <div> 3.3 &nbsp;&nbsp;&nbsp; ระยะเวลาการใช้บริการ<br></div>
                <div class="subdetail">
                    <div> 3.3.1 &nbsp;&nbsp;&nbsp; ระยะเวลาใช้บริการโปรแกรมคอมพิวเตอร์ตามสัญญานี้มีกำหนด 1 ปี ตามกำหนดการเริ่มใช้งานของแต่ละโครงการ โดยมีรายละเอียดตามเอกสารแนบ<br>
                        3.3.2 &nbsp;&nbsp;&nbsp; ในกรณีที่ {!! $quotation->latest_lead->company_name !!} ผู้ว่าจ้างยกเลิกสัญญาในช่วงระยะเวลาสัญญา 1 ปีที่กำหนดไว้ผู้ให้บริการจะระงับการใช้งานระบบในนามของบริษัท โอกาสพลัส จำกัด กับโครงการนั้น ๆ และทางผู้ให้บริการจะมีการคิดค่าใชจ่ายในเดือนที่ถูกบอกเลิกสัญญาเท่านั้น แต่จะไม่มีการคิดค่าใช้จ่ายรายเดือนในเดือนถัดไปหลังจากถูกยกเลิกสัญญาของโครงการดังกล่าว<br></div>
                </div>
            </div>
            <div class="numberdetail">
                <div> 3.4 &nbsp;&nbsp;&nbsp; เงื่อนไขการชำระเงิน<br></div>
                <div class="subdetail">
                    <div> 3.4.1 &nbsp;&nbsp;&nbsp; การชำระเงินค่าติดตั้งระบบ : กรณีมีการจัดเก็บค่าติดตั้ง จะจัดเก็บในเดือนแรกที่มีการเซ็นต์สัญญา จะชำระเมื่อดำเนินการติดตั้งระบบและส่งมอบงานเรียบร้อย<br>
                        3.4.2 &nbsp;&nbsp;&nbsp; การชำระค่าบริการระบบรายเดือน : จะเรียกเก็บเป็นรายโครงการ ตามจำนวนโครงการจริงที่ใช้ระบบ ทั้งนี้จะเรียกเก็บค่าบริการรายเดือน ในเดือนแรกที่เริ่มใช้ระบบ โดยชำระภายในวันที่ 20 ของทุกเดือน<br>
                    </div>
                </div>
            </div>
        </div> <br>

    </div>
    <span id="pageFooter"></span><header align="right" id="header">สัญญาเลขที่ {!! $quotation->contract_code !!} &nbsp;&nbsp;&nbsp;<img src="{{asset('images/logo1.png')}}" alt="" width="10%"><br></header>
    <div class="con">
        <div class="numberh">
            <div> 4.  &nbsp;&nbsp;&nbsp;<u>ข้อจำกัดความรับผิดชอบและการรับประกัน</u><br></div>
            <div class="numberdetail">
                <div> 4.1 &nbsp;&nbsp;&nbsp; ผู้ให้บริการขอรับประกันว่าโปรแกรมคอมพิวเตอร์จะทำงานได้ตามที่กำหนดไว้ทุกประการเป็นระยะเวลาติดต่อกัน 90 วัน นับแต่วันที่ผู้ใช้บริการได้ร้บมอบบัญชีผู้ใช้บริการของโปรแกรมคอมพิวเตอร์และหากโปรแกรมคอมพิวเตอร์ไม่เป็นไปตามที่กำหนดไว้ผู้ให้บริการจะดำเนินการอย่างใดอย่างหนึ่งต่อไปนี้<br></div>
                <div class="subdetail">
                    <div> 4.1.1 &nbsp;&nbsp;&nbsp; ผู้ให้บริการจะทำการแก้ไขปรับปรุงโปรแกรมคอมพิวเตอร์ให้อยู่ในสภาพที่สามารถใช้งานได้ดีดังเดิมโดยไม่ล่าช้า ท้้งนี้ต้องไม่เกิน 30 วันนับตั้งแต่วันที่ผู้ใช้บริการได้แจ้งปัญหากับผู้ให้บริการทราบปัญหา<br></div>
                </div>
            </div>
            <div class="numberdetail">
                <div> 4.2 &nbsp;&nbsp;&nbsp; ผู้ใช้บริการสามารถแจ้งปัญหาเกี่ยวกับการใช้บริการโปรแกรมคอมพิวเตอร์ผ่านทาง Call Center และ Line@ ของผู้ให้บริการได้ตลอดเวลาทำการตั้งแต่ วันจันทร์ - วันศุกร์ เวลา 9.00 น. - 18.00 น. <br>
                    4.3 &nbsp;&nbsp;&nbsp; ผู้ให้บริการมีเจ้าหน้าที่ทางเทคนิคโดยการ Remote ผ่านระบบอินเตอร์เน็ต เพื่อเข้าไปแก้ไขปัญหาที่เกิดขึ้นจากโปรแกรมคอมพิวเตอร์โดยใช้โปรแกรมคอมพิวเตอร์ TeamViewer เป็นเครื่องมือในการ Remote แก้ไขระบบ<br>
                    4.4 &nbsp;&nbsp;&nbsp; ผู้ให้บริการขอรับประกันการคงอยู่ของข้อมูลโดยผู้ให้บริการจะทำการสำรองและเก็บรักษาข้อมูลที่เกิดขึ้น จากโปรแกรมคอมพิวเตอร์ภายใต้บัญชีผู้ใช้ของผู้ใช้บริการอย่างสม่ำเสมอ<br>
                    4.5 &nbsp;&nbsp;&nbsp; ผู้ให้บริการขอรับประกันความปลอดภัยในการเก็บรักษาข้อมูลที่เป็นความลับของผู้ใช้บริการโดยไม่เปิดเผยข้อมูลให้กับบุคคลที่สาม<br>

                </div>

            </div>
        </div>
        <br>
        <div class="numberh">
            <div> 5.  &nbsp;&nbsp;&nbsp;<u>การรักษาความลับทางการค้า</u><br></div>
            <div class="numberdetail">
                <div> 5.1 &nbsp;&nbsp;&nbsp; ผู้ใช้บริการจะไม่เปิดเผยข้อมูลหรือเทคนิคเกี่ยวกับโปรแกรมคอมพิวเตอร์ที่ผู้ใช้บริการรู้หรือควรรู้เป็นความลับทางการค้าของผู้ให้บริการในลักษณะที่จะก่อให้เกิด ความเสียหายแก่ผู้ให้บริการให้ผู้อื่นทราบ <br></div>
            </div>
        </div><br>
        <div class="numberh">
            <div> 6.  &nbsp;&nbsp;&nbsp;<u>คำรับรอง</u><br></div>
            <div class="numberdetail">
                <div> 6.1 &nbsp;&nbsp;&nbsp; ผู้ให้บริการขอรับรองและยืนยันว่าผู้ใช้บริการมีสิทธิ์โดยสมบูรณ์และปราศจากภาระผูกพันใด ๆ อันจะทำให้เสื่อมสิทธิ์ในโปรแกรมคอมพิวเตอร์เอกสารเกี่ยวกับคู่มือการใช้งาน หรือสิ่งอื่นที่เกี่ยวข้องกับโปรแกรมคอมพิวเตอร์ตามสัญญาผู้ใช้บริการได้รับอนุญาตให้ใช้โปรแกรมคอมพิวเตอร์ได้โดยชอบตามกฎหมาย <br></div>
            </div>
        </div><br>


    </div>
    <span id="pageFooter"></span><header align="right" id="header">สัญญาเลขที่ {!! $quotation->contract_code !!} &nbsp;&nbsp;&nbsp;<img src="{{asset('images/logo1.png')}}" alt="" width="10%"></header>
    <div class="con">
        <div class="numberh">
            <div> 7.  &nbsp;&nbsp;&nbsp;<u>การส่งมอบ</u><br></div>
            <div class="numberdetail">
                <div> 7.1 &nbsp;&nbsp;&nbsp; การส่งมอบ<br></div>
                <div class="subdetail">
                    <div> 7.1.1 &nbsp;&nbsp;&nbsp; ผู้ใช้บริการจะต้องจัดส่งข้อมูลที่จำเป็นต่อการตั้งค่าเริ่มต้นของโปรแกรมคอมพิวเตอร์ให้กับผู้ให้บริการ ภายใน 7 วันนับแต่วันที่ทำสัญญาฉบับนี้<br>
                        7.1.2 &nbsp;&nbsp;&nbsp; ผู้ให้บริการจะส่งมอบโปรแกรมคอมพิวเตอร์ตามที่ระบุในข้อ 1. ซึ่งมีคุณสมบัติถูกต้องและครบถ้วน ตามที่กำหนด ไว้ในสัญญานี้ซึ่งพร้อมที่จะใช้งานได้ตามกำหนดในเอกสารที่ระบุในสัญญานี้ให้แก่ผู้ใช้บริการผ่านทางอีเมล์ หรือไปรษณีย์ภายในกำหนดเวลา 7 วัน หลังจากวันที่ได้รับข้อมูลจากผู้ใช้บริการที่ระบุในข้อ 7.1.1<br>
                        7.1.3 &nbsp;&nbsp;&nbsp; ในกรณีที่ผู้ให้บริการไม่สามารถส่งมอบหรือติดตั้งโปรแกรมคอมพิวเตอร์ตามสัญญาฉบับนี้ภายในเวลาที่กำหนด ผู้ให้บริการจะต้องแจ้งให้ผู้ใช้บริการทราบล่วงหน้าเป็นลายลักษณ์อักษรด้วย<br></div>
                </div>
            </div>
            <div class="numberdetail">
                <div> 7.2 &nbsp;&nbsp;&nbsp; การตรวจรับ<br></div>
                <div class="subdetail">
                    <div> 7.2.1 &nbsp;&nbsp;&nbsp; ผู้ให้บริการจะต้องจัดหาเจ้าหน้าที่เพื่อให้คำแนะนำและตรวจสอบประสิทธิ์ภาพการใช้งาน โปรแกรมคอมพิวเตอร์แก่ผู้ใช้บริการโดยไม่คิดค่าใช้จ่ายเพิ่มเติม จากผู้ใช้บริการ<br>
                        7.2.2 &nbsp;&nbsp;&nbsp; ในกรณีที่โปรแกรมคอมพิวเตอร์ที่ส่งมอบไม่มีคุณสมบัติหรือประสิทธิภาพตามที่กำหนดในสัญญานี้ผู้ใช้บริการมีสิทธิ์จะไม่ตรวจรับโปรแกรมคอมพิวเตอร์ได้และผู้ใช้บริการจะต้องแจ้งให้ผู้ให้บริการดำเนินการอย่างใดอย่างหนึ่งตาม ที่ระบุในข้อ 4.<br></div>
                </div>
            </div>
        </div>
        <br>
        <div class="numberh">
            <div> 8.  &nbsp;&nbsp;&nbsp;<u>การบริการและข้อมูลแนะนำการใช้งานระบบ</u><br></div>
            <div class="numberdetail">
                <div> 8.1 &nbsp;&nbsp;&nbsp; การบริการ<br></div>
                <div class="subdetail">
                    <div> 8.1.1 &nbsp;&nbsp;&nbsp; ผู้ให้บริการมีหน้าที่ให้บริการหรือแก้ไขข้อบกพร่องใด ๆ เกี่ยวกับโปรแกรมคอมพิวเตอร์ที่ผู้ให้บริการส่งมอบหรือติดตั้งตามสัญญานี้เมื่อผู้ให้บริการ ได้รับแจ้งจากผู้อนุญาตโดยไม่ล่าช้าและไม่คิดค่าใช้จ่ายใด ๆ ตลอดระยะเวลาการรับประกัน<br>
                        8.1.2 &nbsp;&nbsp;&nbsp; ผู้ให้บริการมีหน้าที่ในการจัดเก็บและสำรองข้อมูลของผู้ใช้บริการอย่างสม่ำเสมอตามที่ได้ระบุในข้อ 4.4<br>
                        8.1.3 &nbsp;&nbsp;&nbsp; ผู้ใช้บริการมีหน้าที่ช่วยประชาสัมพันธ์กับลูกค้าของผู้ใช้บริการ โดยทำสื่อสิ่งพิมพ์ประชาสัมพันธ์ให้กับลูกค้าของผู้ใช้บริการ<br></div>
                </div>
            </div>
            <div class="numberdetail">
                <div> 8.2 &nbsp;&nbsp;&nbsp; ข้อมูลแนะนำการใช้งานระบบ<br></div>
                <div class="subdetail">
                    <div> 8.2.1 &nbsp;&nbsp;&nbsp; ผู้ให้บริการมีหน้าที่ในการจัดเตรียมเอกสารคู่มือการใช้งานให้กับผู้ใช้บริการดังนี้<br></div>
                    <div class="subnode">
                        <div> 8.2.1.1 คู่มือการใช้งานออนไลน์ ผ่านทางเว็บไซต์<br>
                            "https://nabour.me/helps-property"<br>
                        </div>

                    </div>
                </div>
            </div>
        </div><br>

    </div>
    <span id="pageFooter"></span><header align="right" id="header">สัญญาเลขที่ {!! $quotation->contract_code !!} &nbsp;&nbsp;&nbsp;<img src="{{asset('images/logo1.png')}}" alt="" width="10%"></header>
    <div class="con">
        <div class="numberh">
            <div> 9.  &nbsp;&nbsp;&nbsp;<u>การบอกเลิก</u><br></div>
            <div class="numberdetail">
                <div> 9.1 &nbsp;&nbsp;&nbsp; หากคู่สัญญาฝ่ายหนึ่งฝ่ายใดจงใจฝ่าฝืนข้อสัญญาอันเป็นสาระสำคัญคู่สัญญาอีกฝ่ายหนึ่ง มีสิทธิ์ฟ้องร้องบังคับให้ปฏิบัติตามสัญญา หรือมีสิทธิ์บอกเลิกสัญญาได้โดยทันทีโดยไม่ต้องบอกกล่าวล่วงหน้าเป็นเวลา 30 วัน<br><br></div>
            </div>
        </div>
        <div class="numberh">
            <div class="numberdetail">
                <div> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; สัญญานี้ทำขึ้นเป็นสองฉบับมีข้อความถูกต้องตรงกันคู่สัญญาได้อ่านและเข้าใจข้อความในสัญญาโดยตลอดดีแล้ว จึงลงลายมือชื่อพร้อมทั้งตราประทับ (ถ้ามี) ไว้เป็นสำคัญ ต่อหน้าพยานและเก็บ ไว้ฝ่ายละหนึ่งฉบับ<br><br><br></div>
            </div>
        </div>
        <table style="width: 100%;">
            <tr>
                <?php
                $name= "(.................................................)";
                ?>
                <td style="width: 150px;">
                    <p style="text-align: center;">ลงชื่อ..........................................ผู้ใช้บริการ</p>
                    <p></p>
                    <p style="text-align: center;">@if(!empty($quotation->person_name))( {!! $quotation->person_name !!} ) @else {!! $name !!} @endif</p>
                    <p style="text-align: center;">กรรมการ</p>
                    <p style="text-align: center;">{!! $quotation->customer->company_name !!}</p>
                </td>
                <td style="width: 150px; margin-left: 45px;">
                    <p style="text-align: center;">ลงชื่อ..........................................</p>
                    <p style="text-align: center;">(คุณ จินตนา เลิศล้ำยิ่ง)</p>
                    <p style="text-align: center;">กรรมการผู้จัดการ</p>
                    <p style="text-align: center;">บริษัท โอกาสพลัส จำกัด</p>
                </td>
            </tr>

            <tr>
                <td style="width: 150px;">
                    <p style="text-align: center;">ลงชื่อ..........................................พยาน</p>
                    <p style="text-align: center;">@if(!empty($quotation->person_name))( {!! $quotation->person_name !!} ) @else {!! $name !!} @endif</p>
                </td>
                <td style="width: 150px;">
                    <br><br><br><br>
                    <p style="text-align: center;"><img src="{!! asset('images/signaturepq.png') !!}" alt="" width="200px"><br>
                    </p>
                    <p style="text-align: center;">( วีรยุทธ  งานดี  )</p>
                    <p style="text-align: center;">Technology Director</p>
                    <p style="text-align: center;">บริษัท โอกาสพลัส จำกัด</p>
                    <br><br>
                    <p style="text-align: center;">วันที่ทำสัญญา {{localDate(date("Y-m-d"))}}</p>
                </td>
            </tr>
        </table>
    </div>

    @foreach($contract_property as $row)
    <header align="right" id="header">สัญญาเลขที่ {!! $quotation->contract_code !!} &nbsp;&nbsp;&nbsp;<img src="{{asset('images/logo1.png')}}" alt="" width="10%"></header>
    <div class="con">
        <div align="center" style="font-weight: bold;font-size:16px;">เอกสารแนบท้ายสัญญา</div>
        <br><br>
        <table>
            <tr>
                <td width="35%" style="font-size:16px;"><div>ชื่อบริษัท</div></td>
                <td align="left" style="font-size:16px;"><div>: {!! $row->property_name !!}</div></td>
            </tr>

            <tr>
                <td width="35%" style="font-size:16px;"><div>ประเภทโครงการ</div></td>
                <td align="left" style="font-size:16px;"><div>:
                        @foreach($type_array as $trow)
                            @if($row->property_id == $trow['id'])
                                {!! $property_type[$trow['property_type']]!!}
                            @endif
                        @endforeach
                    </div></td>
            </tr>

            <tr>
                <td width="35%" style="font-size:16px;"><div>จำนวนยูนิต</div></td>
                <td align="left" style="font-size:16px;"><div>:
                        @foreach($type_array as $trow)
                            @if($row->property_id == $trow['id'])
                                {!! $trow['unit_size'] !!} ยูนิต
                            @endif
                        @endforeach

                    </div></td>
            </tr>


            <tr>
                <td width="35%" style="font-size:16px;"><div>วันที่ทำสัญญา</div></td>
                <td align="left" style="font-size:16px;"><div>: {!!localDate($row->start_date)!!}</div></td>
            </tr>
            <tr>
                <td width="35%" style="font-size:16px;"><div>วันที่หมดสัญญา</div></td>
                <td align="left" style="font-size:16px;"><div>: {!!localDate($row->end_date)!!}</div></td>
            </tr>
            <tr>
    <tr>
        <td width="35%" style="font-size:16px;vertical-align: top;"><div>ค่าบริการรายเดือน</div></td>
        <td align="left" style="font-size:16px;"><div>:
            @foreach($quotation_service as $row)
                @foreach($package as $_row)
                    @if($row->package_id == $_row->id AND $_row->status == 1)
                            {!! $_row->name !!}<br>{!! $_row->description !!}
                    @endif
                @endforeach
            @endforeach

            </div> </td>
    </tr>
</table>
        <table style="width: 100%;">
            <tr>
                <?php
                $name= "(.................................................)";
                ?>
                <td style="width: 150px;">
                    <p style="text-align: center;">ลงชื่อ..........................................ผู้ใช้บริการ</p>
                    <p></p>
                    <p style="text-align: center;">@if(!empty($quotation->person_name)){!! $quotation->person_name !!} @else {!! $name !!} @endif</p>
                    <p style="text-align: center;">กรรมการผู้จัดการ</p>
                    <p style="text-align: center;">{!! $quotation->customer->company_name !!}</p>
                </td>
                <td style="width: 150px; margin-left: 45px;">
                    <p style="text-align: center;"><img src="{!! asset('images/signaturepq.png') !!}" alt="" width="200px">
                    </p>
                    <p style="text-align: center;">( วีรยุทธ  งานดี  )</p>
                    <p style="text-align: center;">Technology Director</p>
                    <p style="text-align: center;">บริษัท โอกาสพลัส จำกัด</p>
                    <br><br></td>
            </tr>
        </table>
        <br>
<br><br><br>
<div align="center" style="font-size:16px;">วันที่ทำสัญญา {{localDate(date("Y-m-d"))}}</div>
    </div>
        @endforeach
@stop
</body>
</html>

