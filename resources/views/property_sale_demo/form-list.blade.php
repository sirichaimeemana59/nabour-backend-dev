@extends('base-admin')
@section('content')
<div class="page-title">
	<div class="title-env">
		<h1 class="title">ข้อมูลนิติบุคคลตัวอย่าง</h1>
		<p class="description">นิติบุคคลสำหรับทดลองใช้งาน </p>
	</div>
	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li>
				<a href="{!! url('/') !!}"><i class="fa-home"></i>{!! trans('messages.page_home') !!}</a>
			</li>
			<li class="active"><a href="#"> ข้อมูลนิติบุคคลตัวอย่าง</a></li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
				<div class="panel-body" id="form-list-content">
					@include('property_sale_demo.form-list-page')
				</div>
			</div>
	</div>
</div>

<div class="modal fade" id="modal-assign-property-demo">
	{!! Form::open(['url'=>'sales/property/assign','class'=>'form-horizontal','id'=>'assign-demo-form']) !!}
	{!! Form::hidden('property_assign_id', null, array('id' => 'property_assign_id')) !!}
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><i class="fa fa-paper-plane"></i> ส่งข้อมูลให้นิติบุคคลทดลองใช้งาน </h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row form-group">
							<label class="control-label col-md-4">ชื่อผู้ติดต่อ</label>
							<div class="col-md-8">{!! Form::text('name',null,['class'=>'form-control']) !!} </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="row form-group">
							<label class="control-label col-md-4">หมู่บ้านที่สนใจทดลองใช้</label>
							<div class="col-md-8">{!! Form::text('property_name',null,['class'=>'form-control']) !!} </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="row form-group">
							<label class="control-label col-md-4">อีเมลผู้ติดต่อ</label>
							<div class="col-md-8">{!! Form::text('email',null,['class'=>'form-control']) !!} </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="row form-group">
							<label class="control-label col-md-4">เบอร์โทรผู้ติดต่อ</label>
							<div class="col-md-8">{!! Form::text('tel',null,['class'=>'form-control']) !!} </div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="botton" class="btn btn-default" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
				<button type="botton" class="btn btn-primary click-load" id="submit-assign-demo">{!! trans('messages.save') !!}</button>
			</div>
		</div>
	</div>
	{!! Form::close() !!}
</div>

@endsection
@section('script')
	<script type="text/javascript" src="{!!url('/')!!}/js/jquery-validate/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{!!url('/')!!}/sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/sweetalert/dist/sweetalert.css">
	<script type="text/javascript">
	$(function (){
		$('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
			var data_id = '';
			if (typeof $(this).data('id') !== 'undefined') {

				data_id = $(this).data('id');
			}
			$('#property_assign_id').val(data_id);
		});

		$("#assign-demo-form").validate({
			ignore:'',
			rules: {
				name : 'required',
				property_name: 'required',
				email : 'required'
			},
			messages: {
				title: {
					required: '{!! trans('messages.Complain.invalid_title_msg') !!}'
				},
				detail: {
					required: '{!! trans('messages.Complain.invalid_detail_msg') !!}'
				},
				complain_category_id: {
					required: '{!! trans('messages.Complain.invalid_type_msg') !!}'
				}
			}
		});

		$('#submit-assign-demo').on('click', function () {
			if( $("#assign-demo-form").valid() ) {
				$(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
				$('#assign-demo-form').submit();
			} else {
				$(window).resize();
			}
		});

		$(".reset-data-button").click(function(){
			var demoId = $(this).attr("data-demo-id");
			swal({
				title: "คุณต้องการ Reset ข้อมูลสำหรับหมู่บ้านทดลองใช้นี้ ใช่หรือไม่?",
				text: "การ Reset ข้อมูลอาจใช้เวลาในการประมวลผล กรุณารอซักครู่",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes",
				closeOnConfirm: false,
				showLoaderOnConfirm: true
			}, function(){
				$.ajax({
					url : '{!! url('sales/property/reset') !!}',
					type: 'post',
					cache: false,
					dataType: 'json',
					data    : {
						id: demoId
					},
					success: function(data) {
						//alert(JSON.stringify(data));
						if(data.msg == "success") {
							swal({
								title: "Success",
								text: "ทำการ Reset ข้อมูลเรียบร้อยแล้ว",
								type: "success",
								showCancelButton: false,
								confirmButtonText: "OK",
								closeOnConfirm: false
							}, function(){
								window.location.href = "{!! url('sales/property/list') !!}";
							});
							/*swal("Success", "ทำการ Reset ข้อมูลเรียบร้อยแล้ว");
							window.location.href = "{!! url('sales/property/list') !!}";*/
						} else {
							swal("Fail", "ไม่สร้างลบข้อมูลได้ กรุณาติดต่อทีมงานเนเบอร์่");
							window.location.href = "{!! url('sales/property/list') !!}";
						}
					},
					error: function(xhr, textStatus, thrownError) {
						//alert('3Something went to wrong.Please Try again later...');
						$(".errors-container").html('<div class="alert alert-danger">\
												<button type="button" class="close" data-dismiss="alert">\
													<span aria-hidden="true">&times;</span>\
													<span class="sr-only">Close</span>\
												</button>\
												' + data.msg + '\
											</div>');


						$(".errors-container .alert").hide().slideDown();
						$(form).find('#passwd').select();
					}
				});
			});
		});

		$(".disable-data-button").click(function(){
			var demoId = $(this).attr("data-demo-id");
			swal({
				title: "คุณต้องการ Disable ข้อมูลสำหรับหมู่บ้านทดลองใช้นี้ ใช่หรือไม่?",
				text: "ข้อมูลอาจใช้เวลาในการประมวลผล กรุณารอซักครู่",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes",
				closeOnConfirm: false,
				showLoaderOnConfirm: true
			}, function(){
				$.ajax({
					url : 'property/disable',
					type: 'post',
					cache: false,
					dataType: 'json',
					data    : {
						id: demoId
					},
					success: function(data) {
						//alert(JSON.stringify(data));
						if(data.msg == "success") {
							swal({
								title: "Success",
								type: "success",
								showCancelButton: false,
								confirmButtonText: "OK",
								closeOnConfirm: false
							}, function(){
								window.location.href = "{!! url('sales/property/list') !!}";
							});
							/*swal("Success", "ทำการ Reset ข้อมูลเรียบร้อยแล้ว");
							 window.location.href = "{!! url('sales/property/list') !!}";*/
						} else {
							swal("Fail", "เกิดความขัดข้อง กรุณาติดต่อทีมงานเนเบอร์");
							window.location.href = "{!! url('sales/property/list') !!}";
						}
					},
					error: function(xhr, textStatus, thrownError) {
						//alert('3Something went to wrong.Please Try again later...');
						$(".errors-container").html('<div class="alert alert-danger">\
												<button type="button" class="close" data-dismiss="alert">\
													<span aria-hidden="true">&times;</span>\
													<span class="sr-only">Close</span>\
												</button>\
												' + data.msg + '\
											</div>');


						$(".errors-container .alert").hide().slideDown();
						$(form).find('#passwd').select();
					}
				});
			});
		});

		$(".enable-data-button").click(function(){
			var demoId = $(this).attr("data-demo-id");
			swal({
				title: "คุณต้องการ Enable ข้อมูลสำหรับหมู่บ้านทดลองใช้นี้ ใช่หรือไม่?",
				text: "ข้อมูลอาจใช้เวลาในการประมวลผล กรุณารอซักครู่",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Yes",
				closeOnConfirm: false,
				showLoaderOnConfirm: true
			}, function(){
				$.ajax({
					url : 'property/enable',
					type: 'post',
					cache: false,
					dataType: 'json',
					data    : {
						id: demoId
					},
					success: function(data) {
						//alert(JSON.stringify(data));
						if(data.msg == "success") {
							swal({
								title: "Success",
								type: "success",
								showCancelButton: false,
								confirmButtonText: "OK",
								closeOnConfirm: false
							}, function(){
								window.location.href = "{!! url('sales/property/list') !!}";
							});
							/*swal("Success", "ทำการ Reset ข้อมูลเรียบร้อยแล้ว");
							 window.location.href = "{!! url('sales/property/list') !!}";*/
						} else {
							swal("Fail", "เกิดความขัดข้อง กรุณาติดต่อทีมงานเนเบอร์");
							window.location.href = "{!! url('sales/property/list') !!}";
						}
					},
					error: function(xhr, textStatus, thrownError) {
						//alert('3Something went to wrong.Please Try again later...');
						$(".errors-container").html('<div class="alert alert-danger">\
												<button type="button" class="close" data-dismiss="alert">\
													<span aria-hidden="true">&times;</span>\
													<span class="sr-only">Close</span>\
												</button>\
												' + data.msg + '\
											</div>');


						$(".errors-container .alert").hide().slideDown();
						$(form).find('#passwd').select();
					}
				});
			});
		});
	});
	</script>
@endsection
