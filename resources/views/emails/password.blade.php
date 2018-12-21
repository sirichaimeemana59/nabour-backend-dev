@extends('email')
@section('content')
{!! trans('messages.Email.reset_password_msg') !!}
<br/><br/>
<center><a style="background:#2dbca6;padding:10px 50px;text-align:center;display:inline-block;color:#fff;text-decoration:none;" href="{!! url('password/reset/'.$token) !!}"> {!! trans('messages.Email.reset_password_link') !!} </a></center>
<br/>
{!! trans('messages.Email.regards') !!}
<br/>
{!! trans('messages.Email.nabour_team') !!}
@endsection
