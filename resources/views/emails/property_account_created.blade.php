@extends('email')
@section('content')
{!! trans('messages.Email.for',['name'=>$name]) !!} <br/>
ตามที่คุณได้แสดงความประสงค์ที่จะสร้างบัญชีผู้ใช้งานให้กับนิติบุคคล <b>{!!$property_name!!}</b> นั้น บัดนี้ทางเรา(เนเบอร์) ได้สร้างบัญชีผู้ใช้งานสำหรับนิติบุคคลให้คุณเรียบร้อยแล้ว โดยมีรายละเอียดดังนี้ <br/><br/>
<b>ชื่อบัญชีผู้ใช้งาน</b> : {!!$username!!} <br/>
<b>รหัสผ่าน</b> : {!!$password!!} <br/><br/>
คุณสามารถเข้าใช้งานเนบอร์ได้ทันทีผ่านทาง <a href="{!! url('/') !!}">Nabour.me</a> จึงเรียนมาเพื่อทราบ
@endsection
