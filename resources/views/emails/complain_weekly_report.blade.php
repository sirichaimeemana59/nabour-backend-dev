@extends('email')
@section('content')

รายงานการแจ้งซ่อม/แจ้งปัญหาประจำสัปดาห์ <br>
ตั้งแต่ {!! $date_bw[0] !!} ถึง {!! $date_bw[1] !!} <br/><br/>

<b>จำนวนการแจ้งทั้งหมด : </b> {!! $reports_group_new + $reports_group_processing + $reports_group_checking + $reports_group_confirm + $reports_group_complete !!}<br/>
<br>
<b>การแจ้งแบ่งตามสถานะ</b><br/>
<span>การแจ้งงานใหม่</span> : {!!$reports_group_new!!}<br/>
<span>กำลังดำเนินงาน</span> : {!!$reports_group_processing!!}<br/>
<span>ตรวจสอบความเรียบร้อย</span> : {!!$reports_group_checking!!}<br/>
<span>ยืนยันความเรียบร้อย</span> : {!!$reports_group_confirm!!}<br/>
<span>เสร็จสิ้น</span> : {!!$reports_group_complete!!}<br/><br/>


@foreach($result_data['graph_data'] as $key=>$complain)
    @if(isset($complain['0']))
        @if($key == 0)
            <b>การแจ้งใหม่แบ่งตามประเภท</b><br/>
        @endif

        <span>{!! $complain['cate'] !!} : </span>{!! $complain['0'] !!}<br/>
    @endif
@endforeach

<br/>

@if(count($reports) > 0)
    <b>การแจ้งงานใหม่ที่เกิดขึ้นในสัปดาห์นี้</b>

    <table width="100%" style="background:#fff; border-bottom: thin;">
        <tr>
            <th style="background:#ececec;text-align: left">ลำดับ</th>
            <th style="background:#ececec;text-align: left">วันที่แจ้ง</th>
            <th style="background:#ececec;text-align: left">ที่พักอาศัย</th>
            <th style="background:#ececec;text-align: left">ประเภทการแจ้ง</th>
            <th style="background:#ececec;text-align: left">ชื่อเรื่อง</th>
        </tr>
        @foreach($reports as $key=>$item)
            <tr>
                <td>{!! $key+1 !!}</td>
                <td>{!! $item['created_at'] !!}</td>
                <td>{!! $item['property_unit']['unit_number'] !!}</td>
                <td>{!! $cate[$item['complain_category_id']] !!}</td>
                <td>{!! $item['title'] !!}</td>
            </tr>
        @endforeach
        <tr>
            <th colspan="5" style="background:#ececec;">&nbsp;</th>
        </tr>
    </table>
@endif

@endsection
