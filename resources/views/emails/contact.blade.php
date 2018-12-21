@extends('email-contact')
@section('content')
{!! trans('messages.Landing.message_from').$name !!} <br/>
{!! trans('messages.email').": ".$email !!}<br/>
{!! trans('messages.tel').": ".$phone !!}<br/>
{!! trans('messages.property_name').": ".$property !!}<br/><br/>
{!! nl2br(e($content)) !!}
@endsection