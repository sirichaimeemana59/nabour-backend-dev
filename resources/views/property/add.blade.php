@extends('base-admin')
@section('content')
<?php
    $lang = App::getLocale();
    $property_type = unserialize(constant('PROPERTY_TYPE_'.strtoupper($lang)));
?>
<div class="page-title">
	<div class="title-env">
		<h1 class="title">{!! trans('messages.AdminProp.page_head_add') !!}</h1>
	</div>
	<div class="breadcrumb-env">

		<ol class="breadcrumb bc-1" >
			<li>
				<a href="{!! url('/') !!}"><i class="fa-home"></i>{!! trans('messages.page_home') !!}</a>
			</li>
			<li><a href="{!! url('customer/property/list') !!}">{!! trans('messages.AdminProp.page_head') !!}</a></li>
			<li class="active">
				<strong>{!! trans('messages.AdminProp.page_head_add') !!}</strong>
			</li>
		</ol>
	</div>
</div>
{!! Form::model($property,array('url' => array('customer/property/add'),'class'=>'form-horizontal','id'=>'p_form')) !!}
	@include('property.admin-property-form',['flag_create'=>true])
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default text-right">
				<a class="btn btn-gray" href="{!!url('customer/property/list')!!}">Cancel</a>
				{!! Form::button('Create Property',['class'=>'btn btn-primary','id'=>'submit-form']) !!}
			</div>
		</div>
	</div>
{!! Form::close(); !!}
@endsection

@section('script')
<script type="text/javascript" src="{!!url('/')!!}/js/datepicker/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="{!!url('/')!!}/js/datepicker/bootstrap-datepicker.th.js"></script>
<script type="text/javascript">
	// Override
	function validateForm () {
		$("#p_form").validate({
			rules: {
				property_name_th    : 'required',
				property_name_en    : 'required',
				juristic_person_name_th    : 'required',
				juristic_person_name_en    : 'required',
				min_price           : {required:true,number:true},
				max_price           : {required:true,number:true},
				unit_size           : 'required',
				province            : 'required',
				property_type       : {required:true,notEqual:0},
                name_company		: 'required',
				'cat_property'  : 'required',
			},
			errorPlacement: function(error, element) { element.addClass('error'); }
		});
	}
</script>
@endsection