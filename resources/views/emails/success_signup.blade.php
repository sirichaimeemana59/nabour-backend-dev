@extends('email')
@section('content')
{!! trans('messages.Email.for',['name'=>$name]) !!}<br/><br/>
{!! trans('messages.Email.success_register_msg') !!}<br/>
<br/>
{!! trans('messages.Email.nabour_team') !!}
@endsection