@extends('base-admin')
@section('content')
<div class="page-title">
	<div class="title-env">
		<h1 class="title">{!! trans('messages.AdminProp.page_head') !!}</h1>
	</div>
	<div class="breadcrumb-env">

		<ol class="breadcrumb bc-1" >
			<li>
				<a href="{!! url('/') !!}"><i class="fa-home"></i>{!! trans('messages.page_home') !!}</a>
			</li>
			<li><a href="{!! url('customer/property/list') !!}">{!! trans('messages.AdminProp.page_head') !!}</a></li>
			<li class="active">
				<strong>{!! trans('messages.AboutProp.property_detail') !!}</strong>
			</li>
		</ol>
	</div>
</div>
{!! Form::model($property,array('url' => array(''),'class'=>'form-horizontal')) !!}
{!! Form::hidden('id') !!}
{!! Form::hidden('user[id]') !!}
	@include('property.property-view')
{!! Form::close() !!}
@endsection
@section('script')
<script src="{!! url('/') !!}/js/jquery-validate/jquery.validate.min.js"></script>
@endsection