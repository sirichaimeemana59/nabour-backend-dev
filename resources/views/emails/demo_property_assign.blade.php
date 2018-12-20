@extends('email')
@section('content')
{!! trans('messages.Email.for',['name'=>$property_demo->contact_name]) !!} <br/>
ตามที่คุณได้แสดงความประสงค์ที่จะทดลองใช้งานระบบเนเบอร์ เราได้ส่งบัญชีสำหรับทดลองใช้งานให้คุณเรียบร้อยแล้ว โดยมีรายละเอียดดังนี้ <br/><br/>
<b>ผู้จัดการนิติบุคคล</b>(ใช้งานได้เฉพาะบน Web Browser)<br/>
<span>ชื่อบัญชีผู้ใช้งาน</span> : {!!$admin_demo->email!!}<br/>
<span>รหัสผ่าน</span> : {!!$password!!}<br/><br/>

<b>คณะกรรมการนิติบุคคล</b>(ใช้งานได้ทั้ง Web Browser และ Mobile Application)<br/>
<span>ชื่อบัญชีผู้ใช้งาน</span> : {!!$committee_demo->email!!}<br/>
<span>รหัสผ่าน</span> : {!!$password!!}<br/><br/>

@foreach($user_demo as $key=>$item)
    <b>ลูกบ้านคนที่ {!! $key+1 !!}</b>(ใช้งานได้ทั้ง Web Browser และ Mobile Application)<br/>
    <span>ชื่อบัญชีผู้ใช้งาน</span> : {!!$item['email']!!}<br/>
    <span>รหัสผ่าน</span> : {!!$password!!}<br/><br/>
@endforeach
คุณสามารถเข้าทดลองใช้งานเนบอร์ได้ทันทีผ่านทาง <a href="{!! url('/') !!}">https://nabour.me/</a>
<br/><br/>
ขอบคุณที่ให้ความสนใจทดลองใช้งานระบบเนเบอร์
@endsection
