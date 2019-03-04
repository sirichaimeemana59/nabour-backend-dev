@extends('email')
@section('content')
{!! trans('messages.Email.for',['name'=>$property_demo->contact_name]) !!} <br/>
ทางเนเบอร์ ได้จัดส่ง Account สำหรับ Demo ซึ่งเป็นโครงการจำลองในการใช้งาน ทั้งในฝั่งเจ้าหน้าที่ผู้จัดการนิติบุคคล และ ฝั่งลูกบ้านให้ดังนี้ <br/><br/>

<b>ส่วนแรก ทดลองใช้งานของทีมบริหารนิติบุคคล ใช้ผ่าน Web browser ดังนี้</b><br>
1. เข้าไปที่  http://nabour.me <br>
2. เข้าสู่ระบบด้วย email และ password  ที่กำหนดให้ดังนี้<br><br>

<b>ผู้จัดการนิติบุคคล</b>(ใช้งานได้เฉพาะบน Web Browser)<br/>
<span>ชื่อบัญชีผู้ใช้งาน</span> : {!!$admin_demo->email!!}<br/>
<span>รหัสผ่าน</span> : {!!$password!!}<br/><br/>

<b>คณะกรรมการนิติบุคคล</b>(ใช้งานได้ทั้ง Web Browser และ Mobile Application)<br/>
<span>ชื่อบัญชีผู้ใช้งาน</span> : {!!$committee_demo->email!!}<br/>
<span>รหัสผ่าน</span> : {!!$password!!}<br/><br/>

<b>ส่วนสอง ทดลองใช้งานของทางฝั่งลูกบ้าน ใช้ผ่าน Mobile application ดังนี้</b><br>
1. เข้าที่ Play Store หรือ App Store  แล้วค้นหา  NABOUR   ได้ทั้งระบบ IOS และ Android <br>
2. เข้าสู่ระบบด้วย  email และ password  ที่กำหนดให้ ดังนี้<br><br>

@foreach($user_demo as $key=>$item)
    <b>ลูกบ้านคนที่ {!! $key+1 !!}</b>(ใช้งานได้ทั้ง Web Browser และ Mobile Application)<br/>
    <span>ชื่อบัญชีผู้ใช้งาน</span> : {!!$item['email']!!}<br/>
    <span>รหัสผ่าน</span> : {!!$password!!}<br/><br/>
@endforeach
หากต้องการศึกษา รายละเอียดการใช้งานเพิ่มเติม สามารถกดลิงค์เพื่อดูคู่มือออนไลน์  ได้ดังนี้ https://www.nabour.me/helps/helps-property
หรือ ต้องการข้อมูลหรือมีคำถามเพิ่มเติมสามารถติดต่อได้ที่เบอร์ 02-118-3440  / LINE  : @nabour
<br/><br/>
@endsection
