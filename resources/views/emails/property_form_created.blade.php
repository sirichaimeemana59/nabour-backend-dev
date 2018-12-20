@extends('email')
@section('content')
{!! trans('messages.Email.for',['name'=>$name]) !!} <br/>
ตามที่คุณได้แสดงความประสงค์ที่จะสร้างบัญชีผู้ใช้งานให้กับนิติบุคคล <b>{!!$property_name!!}</b> นั้น ทางเรา(เนเบอร์) ได้สร้างแบบฟอร์มสำหรับกรอกข้อมูลนิติบุคคลให้คุณเรียบร้อยแล้ว โดยมีรายละเอียดดังนี้ <br/><br/>
<b>รหัสสำหรับข้อมูลนิติบุคคล</b> : {!!$code!!} <br/><br/>
คุณสามารถเข้ากรอกข้อมูลนิติบุคคลของคุณได้จากปุ่มด้านล่าง<br/><br/>
<div style="text-align: center;">
<a style="background:#2dbca6;padding:10px 50px;text-align:center;display:inline-block;color:#fff;text-decoration:none;" href="{!! url('/home/code') !!}">ใช้รหัสกรอกข้อมูลบน Nabour.me</a>
</div>
@endsection
