@extends('email')
@section('content')
{!! trans('messages.Email.for',['name'=>$name]) !!} <br/>
{!! nl2br($messages) !!}
@endsection
