@extends('email')
@section('content')
{!! trans('messages.Email.for',['name'=>$name]) !!} <br/>
ตามที่คุณได้แสดงความประสงค์ที่จะเปลี่ยนรหัสผ่านบัญชีผู้ใช้งาน​ ตอนนี้ทางเรา(เนเบอร์) ได้ทำการเปลี่ยนรหัสผ่านบัญชีผู้ใช้งานให้คุณเรียบร้อยแล้ว โดยมีรายละเอียดดังนี้ <br/><br/>
<b>ชื่อบัญชีผู้ใช้งาน</b> : {!!$email!!} <br/>
<b>รหัสผ่านใหม่</b> : {!!$password!!} <br/><br/>
คุณสามารถเข้าใช้งานเนบอร์ได้ทันทีผ่านทาง <a href="{!! url('/') !!}">Nabour.me</a> จึงเรียนมาเพื่อทราบ
@endsection