@extends('email-contact')
@section('content')
หมู่บ้านDemo : {!! $name !!} <br> มีการเข้าใช้งานเวลา {!! $datetime !!} <br>
User ที่เข้าใช้งาน : {!!$email!!}<br>
Default Password : {!! $password !!}<br>

<hr>
<b>ข้อมูลผู้ทดสอบ</b> <br> 
ชื่อโครงการที่ทดสอบ : {!! $test_by_prop_name!!} <br>
ชื่อผู้ติดต่อ : {!! $test_by_contact_name!!} <br>
อีเมลผู้ติดต่อ : {!! $test_by_prop_email!!} <br>
<hr>
<br>
<l>
*แต่ละหมู่บ้านจะมี account ในหมู่บ้าน {!!$demo_prop_code!!} จะมี accout เป็น <br>
admin_{!!$demo_prop_code!!}@nabour.me => สำหรับนิติบุคคล <br>
com_{!!$demo_prop_code!!}@nabour.me => สำหรับคณะกรรมการหมู่บ้าน <br>
user2_{!!$demo_prop_code!!}@nabour.me => สำหรับลูกบ้านหลังที่ 1 <br>
user3_{!!$demo_prop_code!!}@nabour.me => สำหรับลูกบ้านหลังที่ 2 <br>
user4_{!!$demo_prop_code!!}@nabour.me => สำหรับลูกบ้านหลังที่ 3 <br>
</l>
@endsection