@extends('base-admin')
@section('content')
	<?php
    	$lang = App::getLocale();
    	$property_type = unserialize(constant('PROPERTY_TYPE_'.strtoupper($lang)));
	?>
	<div class="page-title">
		<div class="title-env">
			<h1 class="title">นิติบุคคล</h1>
		</div>
		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="{!! url('/property') !!}"><i class="fa-home"></i>Home</a>
				</li>
				<li><a href="#">นิติบุคคล</a></li>
				<li class="active">
					<strong>รายชื่อนิติบุคคล</strong>
				</li>
			</ol>
		</div>
	</div>
	{{-- //search --}}
	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">{!! trans('messages.search') !!}</h3>
				</div>
				<div class="panel-body search-form">
					<form method="POST" id="search-form" action="#" accept-charset="UTF-8" class="form-horizontal">
						<div class="row">
							<div class="col-sm-3 block-input">
								<input class="form-control" size="25" placeholder="{!! trans('messages.name') !!}" name="name">
							</div>
							<div class="col-sm-9 text-right ">
								<button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>
								<button type="button" class="btn btn-secondary @if(isset($demo)) d-search-property @else p-search-property @endif">{!! trans('messages.search') !!}</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<a class="btn btn-info btn-primary action-float-right" href="{!! url('customer/property/add') !!}"><i class="fa fa-plus"> </i> เพิ่มโครงการ</a>

	<div class="row">
		<div class="col-sm-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<div class="panel-options">
						<a href="#" data-toggle="panel">
							<span class="collapse-icon">&ndash;</span>
							<span class="expand-icon">+</span>
						</a>
					</div>
				</div>
				<div class="panel-body" id="landing-property-list">
					@if(isset($demo))
						@include('property.demo-list-element')
					@else
						@include('property.list-element')
					@endif
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="modal-active" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">{!! trans('messages.Member.confirm_ban_head') !!}</h4>
				</div>
				<div class="modal-body">
					{!! trans('messages.Member.confirm_ban_msg') !!}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
					<button type="submit" class="btn btn-primary change-active-status-btn">{!! trans('messages.confirm') !!}</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-inactive" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">{!! trans('messages.Member.confirm_active_head') !!}</h4>
				</div>
				<div class="modal-body">
					{!! trans('messages.Member.confirm_active_msg') !!}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
					<button type="submit" class="btn btn-primary change-active-status-btn">{!! trans('messages.confirm') !!}</button>
				</div>
			</div>
		</div>
	</div>

	{{-- Setting function property --}}
	<div class="modal fade" id="edit-feature-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">ตั้งค่าฟังก์ชั่นของนิติบุคคล</h4>
				</div>
				<div id="form-edit-feature">
					<div class="form">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
						<button type="button" class="btn btn-primary save-officer">{!! trans('messages.save') !!}</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- End setting function property --}}

	{{-- Setting function user_property --}}
	<div class="modal fade" id="edit-feature-modal-user">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">ตั้งค่าฟังก์ชั่นของลูกบ้าน</h4>
				</div>
				<div id="form-edit-feature-user">
					<div class="form1">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
						<button type="button" class="btn btn-primary save-user">{!! trans('messages.save') !!}</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	{{-- End setting function user_property --}}

	<div class="modal fade" id="initial-meter-data-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">ตั้งค่าเริ่มต้นมิเตอร์ของนิติบุคคล</h4>
				</div>

				<div id="form-initial-meter-data">
					<div class="form">
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
						<button type="button" class="btn btn-primary save-initial-data">{!! trans('messages.save') !!}</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="property-contact-modal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">ข้อมูลสัญญา</h4>
				</div>
				<div class="row" style="margin:5px 0;">
					<div class="col-sm-12" style="padding:0 20px;">ชื่อโครงการ : <span class="p-name"></span>
					</div>
				</div>
				<hr style="margin:0;"/>
				<div class="modal-body" id="contract-list">
				</div>

				<div class="modal-footer">
					{{--<button type="button" class="btn btn-primary" id="add-sign-btn">เพิ่มข้อมูลสัญญา</button>--}}
					<button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.close') !!}</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="add-unit-csv-modal">
		<div class="modal-dialog" style="min-width: 90%; min-height: 100%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มข้อมูลที่พักอาศัย</h4>
				</div>
				{!! Form::open(array('url' => '#','class'=>'form-horizontal','id'=>'unit_form')) !!}
				<div class="row" style="margin:5px 0;">
					<input id="p_addunit_id" name="property_id" type="hidden"/>
					<div class="col-sm-12" style="padding:0 20px;">ชื่อโครงการ : <span id="p-name"></span>
					</div>
				</div>
				<hr style="margin:0;"/>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">การเพิ่มที่พักอาศัยจะลบข้อมูลที่พักอาศัยเดิมที่มีอยู่ทิ้งทั้งหมด กรอกข้อมูล csv ของที่พักอาศัยให้ตรงกับรูปแบบด้านล่าง <br/><br/></div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							{!! Form::textarea('units',null,array('class'=>'form-control','id'=>'unit-csv-data','placeholder' => 'บ้าน/ห้องเลขที่, ชื่อเจ้าบ้าน/ผู้ถือกรรมสิทธิ์์, ขนาดพื้นที่, วันที่โอน(ปีค.ศ.-เดือน-วัน), วันที่หมดประกัน(ปีค.ศ.-เดือน-วัน), เบอร์โทรศัพท์ติดต่อ, ที่อยู่สำหรับจัดส่งเอกสาร, ตึก, ชั้น, อีเมล, จัดเก็บค่าน้ำหรือไม่("true"/"false"), อัตราจัดเก็บค่าน้ำ, จัดเก็บค่าไฟหรือไม่("true"/"false"), อัตราจัดเก็บค่าไฟ, อัตราจัดเก็บค่าสาธารณูปโภค, อัตราส่วนกรรมสิทธิ์, ประเภทของที่พักอาศัย')) !!}
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
					<button type="button" class="btn btn-primary" id="add-unit-btn">{!! trans('messages.save') !!}</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

	<div class="modal fade" id="update-unit-csv-modal">
		<div class="modal-dialog" style="min-width: 90%; min-height: 100%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มข้อมูลที่พักอาศัยเพิ่มเติม</h4>
				</div>
				{!! Form::open(array('url' => '#','class'=>'form-horizontal','id'=>'unit_form_update')) !!}
				<div class="row" style="margin:5px 0;">
					<input id="p_updateunit_id" name="property_id_update" type="hidden"/>
					<div class="col-sm-12" style="padding:0 20px;">ชื่อโครงการ : <span id="p-name"></span>
					</div>
				</div>
				<hr style="margin:0;"/>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">การเพิ่มที่พักอาศัยจะไม่ลบข้อมูลที่พักอาศัยเดิมที่มีอยู่ทิ้งทั้งหมด กรอกข้อมูล csv ของที่พักอาศัยให้ตรงกับรูปแบบด้านล่าง <br/><br/></div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							{!! Form::textarea('update_units',null,array('class'=>'form-control','id'=>'unit-csv-data-update','placeholder' => 'บ้าน/ห้องเลขที่, ชื่อเจ้าบ้าน/ผู้ถือกรรมสิทธิ์์, ขนาดพื้นที่, วันที่โอน(ปีค.ศ.-เดือน-วัน), วันที่หมดประกัน(ปีค.ศ.-เดือน-วัน), เบอร์โทรศัพท์ติดต่อ, ที่อยู่สำหรับจัดส่งเอกสาร, ตึก, ชั้น, อีเมล, จัดเก็บค่าน้ำหรือไม่("true"/"false"), อัตราจัดเก็บค่าน้ำ, จัดเก็บค่าไฟหรือไม่("true"/"false"), อัตราจัดเก็บค่าไฟ, อัตราจัดเก็บค่าสาธารณูปโภค, อัตราส่วนกรรมสิทธิ์, ประเภทของที่พักอาศัย')) !!}
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
					<button type="button" class="btn btn-primary" id="update-unit-btn">{!! trans('messages.save') !!}</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

	<div class="modal fade" id="edit-unit-csv-modal">
		<div class="modal-dialog" style="min-width: 90%; min-height: 100%;">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">เพิ่มข้อมูลที่พักอาศัยเพิ่มเติม</h4>
				</div>
				{!! Form::open(array('url' => '#','class'=>'form-horizontal','id'=>'unit_form_edit')) !!}
				<div class="row" style="margin:5px 0;">
					<input id="p_editunit_id" name="property_id_edit" type="hidden"/>
					<div class="col-sm-12" style="padding:0 20px;">ชื่อโครงการ : <span id="p-name"></span>
					</div>
				</div>
				<hr style="margin:0;"/>
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">การเพิ่มที่พักอาศัยจะไม่ลบข้อมูลที่พักอาศัยเดิมที่มีอยู่ทิ้งทั้งหมด กรอกข้อมูล csv ของที่พักอาศัยให้ตรงกับรูปแบบด้านล่าง <br/><br/></div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							{!! Form::textarea('edit_units',null,array('class'=>'form-control','id'=>'unit-csv-data-update','placeholder' => 'id, บ้าน/ห้องเลขที่, ชื่อเจ้าบ้าน/ผู้ถือกรรมสิทธิ์์, ขนาดพื้นที่, วันที่โอน(ปีค.ศ.-เดือน-วัน), วันที่หมดประกัน(ปีค.ศ.-เดือน-วัน), เบอร์โทรศัพท์ติดต่อ, ที่อยู่สำหรับจัดส่งเอกสาร, ตึก, ชั้น, อีเมล, จัดเก็บค่าน้ำหรือไม่("true"/"false"), อัตราจัดเก็บค่าน้ำ, จัดเก็บค่าไฟหรือไม่("true"/"false"), อัตราจัดเก็บค่าไฟ, อัตราจัดเก็บค่าสาธารณูปโภค, อัตราส่วนกรรมสิทธิ์, ประเภทของที่พักอาศัย, ค่าบำบัดน้ำเสีย')) !!}
						</div>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
					<button type="button" class="btn btn-primary" id="edit-unit-btn">{!! trans('messages.save') !!}</button>
				</div>
				{!! Form::close() !!}
			</div>
		</div>
	</div>

	<div class="modal fade" id="modal-assign-property-demo">
		{!! Form::open(['url'=>'admin/property/assign','class'=>'form-horizontal','id'=>'assign-demo-form']) !!}
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
	<script type="text/javascript" src="{!! url('/') !!}/js/datatables/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="{!! url('/') !!}/js/datatables/dataTables.bootstrap.js"></script>
	<script type="text/javascript" src="{!! url('/') !!}/js/jquery-validate/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{!! url('/') !!}/js/datepicker/bootstrap-datepicker.js"></script>
	<script type="text/javascript" src="{!! url('/') !!}/js/datepicker/bootstrap-datepicker.th.js"></script>
	<script type="text/javascript" src="{!! url('/') !!}/js/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="{!! url('/') !!}/js/selectboxit/jquery.selectBoxIt.min.js"></script>
	<script type="text/javascript" src="{!! url('/') !!}/js/nabour-search-form.js"></script>
	<script type="text/javascript" src="{!! url('/') !!}/js/toastr/toastr.min.js"></script>
	<script type="text/javascript" src="{!!url('/')!!}/js/jquery-validate/jquery.validate.min.js"></script>
	<script type="text/javascript" src="{!!url('/')!!}/sweetalert/dist/sweetalert.min.js"></script>
	<link rel="stylesheet" type="text/css" href="{{ url('/') }}/sweetalert/dist/sweetalert.css">
	<script>
        var target_prop;
        $(function () {
            $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
                var data_id = '';
                if (typeof $(this).data('id') !== 'undefined') {

                    data_id = $(this).data('id');
                }
                $('#property_assign_id').val(data_id);
            });

            $('.panel-body').on('click','.p-paginate-link', function (e){
                e.preventDefault();
                propertyDemoPage($(this).attr('data-page'));
            })

            $('.panel-body').on('change','.p-paginate-select', function (e){
                e.preventDefault();
                propertyDemoPage($(this).val());
            })

            $('.p-search-property').on('click',function () {
                propertyDemoPage (1);
            });

            $('.panel-body').on('click','.d-paginate-link', function (e){
                e.preventDefault();
                propertyDemoPage($(this).attr('data-page'));
            })

            $('.panel-body').on('change','.d-paginate-select', function (e){
                e.preventDefault();
                propertyDemoPage($(this).val());
            })

            $('.d-search-property').on('click',function () {
                propertyDemoPage (1);
            });

            $('#landing-property-list').on('click','.active-status', function (e){
                e.preventDefault();
                tmp = $(this);

                var name = tmp.parents('tr').find('td.name').html();
                if(tmp.attr('data-status') == 1) {
                    $('#modal-inactive .modal-body span').html(name);
                    $('#modal-inactive').modal('show');
                } else {
                    $('#modal-active .modal-body span').html(name);
                    $('#modal-active').modal('show');
                }
            });
            $("#assign-demo-form").validate({
                ignore:'',
                rules: {
                    name : 'required',
                    property_name: 'required',
                    email : 'required',
                    tel : 'required'
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


            $('.change-active-status-btn').on('click', function () {
                $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                changeActiveStatus (tmp.attr('data-pid'),parseInt(tmp.attr('data-status')));
            });

            $('#landing-property-list').on('click', '.edit-property-feature', function (e){
                e.preventDefault();
                var _this = $(this);
                var pid = _this.attr('data-pid');
                $.ajax({
                    url     : $('#root-url').val()+"/customer/property-feature/edit/get",
                    method	: "POST",
                    data 	: ({pid:pid}),
                    dataType: "html",
                    success: function (t) {
                        $('#form-edit-feature .form').html(t);
                        $('#edit-feature-modal').modal('show');
                    }
                });
            });

            $('#submit-assign-demo').on('click', function () {
                if( $("#assign-demo-form").valid() ) {
                    $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                    $('#assign-demo-form').submit();
                } else {
                    $(window).resize();
                }
            });
			{{-- setting function user --}}
            $('#landing-property-list').on('click', '.edit-property-feature-user', function (e){
                e.preventDefault();
                var _this = $(this);
                var pid = _this.attr('data-pid');
                $.ajax({
                    url     : $('#root-url').val()+"/customer/property-feature/user",
                    method	: "POST",
                    data 	: ({pid:pid}),
                    dataType: "html",
                    success: function (t) {
                        $('#form-edit-feature-user .form1').html(t);
                        $('#edit-feature-modal-user').modal('show');
                    }
                });
            });

            $('#form-edit-feature .save-officer').on('click',function () {
                var btn = $(this);
                btn.attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                $.ajax({
                    url     : $('#root-url').val()+"/customer/property-feature/edit/save",
                    method	: "POST",
                    data 	: $('#form-edit-feature form').serialize(),
                    dataType: "html",
                    success: function (t) {
                        if(t == 'saved') {
                            $('#edit-feature-modal').modal('hide');
                        } else {
                            $('#form-edit-feature .form').html(t);
                        }
                        btn.removeAttr('disabled').find('i').remove();
                    }
                });
            });

            //save user
            $('#form-edit-feature-user .save-user').on('click',function () {
                var btn = $(this);
                btn.attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                $.ajax({
                    url     : $('#root-url').val()+"/customer/property-feature/user/save",
                    method	: "POST",
                    data 	: $('#form-edit-feature-user form').serialize(),
                    dataType: "html",
                    success: function (t) {
                        if(t == 'saved') {
                            $('#edit-feature-modal-user').modal('hide');
                        } else {
                            $('#form-edit-feature-user .form1').html(t);
                        }
                        btn.removeAttr('disabled').find('i').remove();
                    }
                });
            });
            //end save user

            $('#landing-property-list').on('click', '.property-initial-meter-data', function (e){
                e.preventDefault();
                var _this = $(this);
                var pid = _this.attr('data-pid');
                $.ajax({
                    url     : $('#root-url').val()+"/customer/property/initial-meter/get",
                    method	: "POST",
                    data 	: ({pid:pid}),
                    dataType: "html",
                    success: function (t) {
                        $('#form-initial-meter-data .form').html(t);
                        $('#initial-meter-data-modal').modal('show');
                    }
                });
            });

            $('#form-initial-meter-data .save-initial-data').on('click',function () {
                var btn = $(this);
                btn.attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                $.ajax({
                    url     : $('#root-url').val()+"/customer/property/initial-meter/save",
                    method	: "POST",
                    data 	: $('#form-initial-meter-data form').serialize(),
                    dataType: "html",
                    success: function (t) {
                        if(t == 'saved') {
                            $('#initial-meter-data-modal').modal('hide');
                            location.reload();
                        } else {
                            $('#form-initial-meter-data .form').html(t);
                        }
                        btn.removeAttr('disabled').find('i').remove();
                    }
                });
            });

            $('#landing-property-list').on('click', '.view-sign', function (e){
                e.preventDefault();
                var p_name = $(this).parents('tr').find('.name').html();
                $('.p-name').html(p_name);
                var _this = $(this);
                var pid = target_prop = _this.attr('data-pid');
                $.ajax({
                    url     : $('#root-url').val()+"/customer/property-sign",
                    method	: "POST",
                    data 	: ({pid:pid}),
                    dataType: "html",
                    success: function (t) {
                        $('#contract-list').html(t);
                        $('#property-contact-modal').modal('show');
                    }
                });
            });

            $('#contract-list').on('click', '.edit-contract', function (e){
                e.preventDefault();
                var _this = $(this);
                var tid = _this.attr('data-contact-id');
                $.ajax({
                    url     : $('#root-url').val()+"/customer/property-sign/edit",
                    method	: "GET",
                    data 	: ({tid:tid}),
                    dataType: "html",
                    success: function (t) {
                        $('#edit-sign').html(t);
                        $('#edit-sign .datepicker').datepicker({
                            format: 'yyyy/mm/dd',
                            language : 'th'
                        });

                        $("#contract_edit_form").validate({
                            rules: {
                                contract_sign_no  	: 'required',
                                contract_date 		: 'required',
                                contract_end_date 	: 'required',
                                info_delivery_date 	: 'required'
                            },
                            errorPlacement: function(error, element) { element.addClass('error'); }
                        });

                        $('#property-contact-modal').modal('hide');
                        setTimeout(function () {
                            $('#property-edit-contact-modal').modal('show');
                        }, 500);
                    }
                });
            });

            $('#add-sign-btn').on('click', function () {
                $('#property-contact-modal').modal('hide');
                setTimeout(function () {
                    $('#property-add-contact-modal').modal('show');
                    $('#contract-pid').val(target_prop)
                }, 500);
            });

            $('#add-unit-btn').on('click', function () {
                var _this = $(this);
                //$(this).prepend('<i class=""')
                if($('#unit-csv-data').val() == "") {
                    $('#unit-csv-data').addClass('error');
                } else {
                    _this.prepend('<span><i class="fa-spin fa-spinner"></i> </span>').attr('disabled','disabled');
                    $('#unit-csv-data').removeClass('error');
                    var data = $('#unit_form').serialize();
                    $.ajax({
                        url     : $('#root-url').val()+"/customer/property/addunit",
                        method	: "POST",
                        data 	: data,
                        dataType: "json",
                        success: function (t) {
                            _this.find('span').remove();
                            _this.removeAttr('disabled');
                            var opts = {
                                "positionClass": "toast-top-right",
                                "showDuration": "300",
                                "hideDuration": "1000"
                            };
                            if(t.result) {
                                $('#add-unit-csv-modal').modal('hide');
                                $('#unit-csv-data').val('');
                                toastr.success(t.message, null, opts);
                            } else toastr.error(t.message, null, opts);
                        }
                    });
                }

            });

            $('#update-unit-btn').on('click', function () {
                var _this = $(this);
                //$(this).prepend('<i class=""')
                if($('#unit-csv-data-update').val() == "") {
                    $('#unit-csv-data-update').addClass('error');
                } else {
                    _this.prepend('<span><i class="fa-spin fa-spinner"></i> </span>').attr('disabled','disabled');
                    $('#unit-csv-data-update').removeClass('error');
                    var data = $('#unit_form_update').serialize();
                    $.ajax({
                        url     : $('#root-url').val()+"/customer/property/update-unit",
                        method	: "POST",
                        data 	: data,
                        dataType: "json",
                        success: function (t) {
                            _this.find('span').remove();
                            _this.removeAttr('disabled');
                            var opts = {
                                "positionClass": "toast-top-right",
                                "showDuration": "300",
                                "hideDuration": "1000"
                            };
                            if(t.result) {
                                $('#update-unit-csv-modal').modal('hide');
                                $('#unit-csv-data-update').val('');
                                toastr.success(t.message, null, opts);
                            } else toastr.error(t.message, null, opts);
                        }
                    });
                }

            });

            $('#edit-unit-btn').on('click', function () {
                var _this = $(this);
                //$(this).prepend('<i class=""')
                if($('#unit-csv-data-edit').val() == "") {
                    $('#unit-csv-data-edit').addClass('error');
                } else {
                    _this.prepend('<span><i class="fa-spin fa-spinner"></i> </span>').attr('disabled','disabled');
                    $('#unit-csv-data-edit').removeClass('error');
                    var data = $('#unit_form_edit').serialize();
                    $.ajax({
                        url     : $('#root-url').val()+"/customer/property/edit-data",
                        method	: "POST",
                        data 	: data,
                        dataType: "json",
                        success: function (t) {
                            _this.find('span').remove();
                            _this.removeAttr('disabled');
                            var opts = {
                                "positionClass": "toast-top-right",
                                "showDuration": "300",
                                "hideDuration": "1000"
                            };
                            if(t.result) {
                                $('#edit-unit-csv-modal').modal('hide');
                                $('#unit-csv-data-edit').val('');
                                toastr.success(t.message, null, opts);
                            } else toastr.error(t.message, null, opts);
                        }
                    });
                }

            });

            $('#landing-property-list').on('click','.add-unit-link', function () {
                var p_name = $(this).parents('tr').find('.name').html();
                $('#unit-csv-data').val('');
                $('#p-name').html(p_name);
                $('#p_addunit_id').val($(this).data('pid'));
                $('#p_updateunit_id').val($(this).data('pid'));
                $('#p_editunit_id').val($(this).data('pid'));
            })
        });


        function propertyDemoPage (page) {
            var data = $('#search-form').serialize()+'&page='+page;
            //console.log(data);
            $('#landing-property-list').css('opacity','0.6');
            $.ajax({
                url     : $('#root-url').val()+"/customer/property/demo/list",
                data    : data,
                dataType: "html",
                method: 'post',
                success: function (h) {
                    $('#landing-property-list').css('opacity','1').html(h);
                }
            })
        }

        function changeActiveStatus (pid,flag) {
            //console.log(pid);
            $.ajax({
                url     : $('#root-url').val()+"/customer/property/status",
                method	: "POST",
                data 	: ({pid:pid,status:flag}),
                dataType: "json",
                success: function (r) {
                    if(r.result) {
                        location.reload();
                    }
                }
            });
        }

        $("body").on('click','.reset-data-button', function(e){
            e.preventDefault();
            var demoId = $(this).attr("data-demo-id");
            //console.log(demoId);
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
                    url : '{!! url('admin/property/reset') !!}',
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
                                window.location.href = "{!! url('customer/property/demo/list') !!}";
                            });
                            /*swal("Success", "ทำการ Reset ข้อมูลเรียบร้อยแล้ว");
                            window.location.href = "{!! url('customer/property/demo/list') !!}";*/
                        } else {
                            swal("Fail", "ไม่สร้างลบข้อมูลได้ กรุณาติดต่อทีมงานเนเบอร์่");
                            window.location.href = "{!! url('customer/property/demo/list') !!}";
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

	</script>
	<link rel="stylesheet" href="{!!url('/')!!}/js/select2/select2.css">
	<link rel="stylesheet" href="{!!url('/')!!}/js/select2/select2-bootstrap.css">
@endsection
