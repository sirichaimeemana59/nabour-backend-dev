@extends('base-admin')
@section('content')
	<div class="page-title">
		<div class="title-env">
			<h1 class="title">{!! trans('messages.Officer_Nabour.page_head') !!}</h1>
		</div>
		<div class="breadcrumb-env">
			<ol class="breadcrumb bc-1" >
				<li>
					<a href="{!! url('/') !!}"><i class="fa-home"></i>{!! trans('messages.page_home') !!}</a>
				</li>
				<li class="active">
					<strong>{!! trans('messages.Officer.page_head') !!}</strong>
				</li>
			</ol>
		</div>
	</div>

	<a href="#" data-toggle="modal" data-target="#add-officer-modal" class="action-float-right create-invoice-btn btn btn-primary">{!! trans('messages.Officer.add_officer') !!} </a>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
                    <h3 class="panel-title">{!! trans('messages.Officer_Nabour.page_sub_head') !!}</h3>
                </div>
				<div class="panel-body member-list-content">
					<div class="tab-pane active" id="member-list">
						<div id="member-list-content">
							@include('sales.sales-list')
						</div>
					</div>
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

	<div class="modal fade" id="modal-delete-member" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">ยืนยันการลบบัญชีใช้งาน</h4>
				</div>
				<div class="modal-body">
					คุณต้องการลบบัญชีนี้ออกจากระบบหรือไม่
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
					<button type="submit" class="btn btn-primary delete-member-btn">{!! trans('messages.confirm') !!}</button>
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="modal-member">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{!! trans('messages.Officer.officer_detail') !!}</h4>
                </div>
                <div class="modal-body">

                </div>
                 <div class="modal-footer">
                    <button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.close') !!}</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="add-officer-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{!! trans('messages.Officer.add_officer_head') !!}</h4>
                </div>
				<div id="form-add-officer">
					<div class="form">
						@include('sales.sales-form')
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
						<button type="button" class="btn btn-primary save-officer">{!! trans('messages.save') !!}</button>
					</div>
				</div>
            </div>
        </div>
    </div>

	<div class="modal fade" id="edit-officer-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">{!! trans('messages.Officer.add_officer_head') !!}</h4>
                </div>
				<div id="form-edit-officer">
					<div class="form">
		                @include('sales.sales-form')
					</div>
					<div class="modal-footer">
					    <button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
					    <button type="button" class="btn btn-primary save-officer">{!! trans('messages.save') !!}</button>
					</div>
				</div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<script type="text/javascript" src="{!!url('/')!!}/js/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript">
	$(function (){

        $('#form-add-officer .save-officer').on('click',function () {
			var btn = $(this);
            btn.attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
			$.ajax({
				url     : $('#root-url').val()+"/admin/sales/add",
                method	: "POST",
                data 	: $('#form-add-officer form').serialize(),
                dataType: "html",
                success: function (t) {
                	if(t == 'saved') {
						location.reload(true);
					} else {
						 $('#form-add-officer .form').html(t);
						 btn.removeAttr('disabled').find('i').remove();
					}
                }
			});
        });

		$('#form-edit-officer .save-officer').on('click',function () {
			var btn = $(this);
            btn.attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
			$.ajax({
				url     : $('#root-url').val()+"/admin/sales/edit",
                method	: "POST",
                data 	: $('#form-edit-officer form').serialize(),
                dataType: "html",
                success: function (t) {
                	if(t == 'saved') {
						 location.reload(true);
					} else {
						 $('#form-edit-officer .form').html(t);
					}
					 btn.removeAttr('disabled').find('i').remove();
                }
			});
        });

		var tmp;

		$('.member-list-content').on('click','.active-status', function (e){
			e.preventDefault();
			tmp = $(this);

			var name = tmp.parents('tr').find('td.user-image .name').html();
			if(tmp.attr('data-status') == 1) {
				$('#modal-inactive .modal-body span').html(name);
				$('#modal-inactive').modal('show');
			} else {
				$('#modal-active .modal-body span').html(name);
				$('#modal-active').modal('show');
			}
		});

		$('.member-list-content').on('click','.delete-member', function (e){
			e.preventDefault();
			tmp = $(this);

			var name = tmp.parents('tr').find('td.user-image .name').html();
			$('#modal-delete-member .modal-body span').html(name);
			$('#modal-delete-member').modal('show');
		});

		$('.change-active-status-btn').on('click', function () {
			$(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
			changeActiveStatus (tmp.attr('data-uid'),parseInt(tmp.attr('data-status')));
		});

		$('.delete-member-btn').on('click', function () {
			$(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
			deleteMemberAccout (tmp.attr('data-uid'));
		});

		$('.member-list-content').on('click','.view-member', function (e){
			e.preventDefault();
			var _this = $(this);
			_this.html('<i class="fa-spin fa-spinner"></i>');
			var uid = _this.attr('data-uid');
			$.ajax({
				url     : $('#root-url').val()+"/admin/sales/view",
                method	: "POST",
                data 	: ({uid:uid}),
                dataType: "html",
                success: function (t) {
                	$('#modal-member .modal-body').html(t);
                	$('#modal-member').modal('show');
                	_this.html('<i class="fa-eye"></i>');
                }
			});
		})

		$('.member-list-content').on('click','.edit-member', function (e){
			e.preventDefault();
			var _this = $(this);
			_this.html('<i class="fa-spin fa-spinner"></i>').attr('disabled','disabled');
			var uid = _this.attr('data-uid');
			$.ajax({
				url     : $('#root-url').val()+"/admin/sales/edit/get",
                method	: "POST",
                data 	: ({uid:uid}),
                dataType: "html",
                success: function (t) {
					_this.html('<i class="fa-edit"></i>').removeAttr('disabled','disabled');;
                	$('#form-edit-officer .form').html(t);
					$('#edit-officer-modal').modal('show');
                }
			});
		});

		function changeActiveStatus (uid,flag) {
			$.ajax({
				url     : $('#root-url').val()+"/admin/sales/active",
                method	: "POST",
                data 	: ({uid:uid,status:flag}),
                dataType: "json",
                success: function (r) {
                	if(r.result) {
                		location.reload();
                	}
                }
			});
		}

		function deleteMemberAccout(uid) {
			$.ajax({
				url     : $('#root-url').val()+"/admin/sales/delete",
				method	: "POST",
				data 	: ({uid:uid}),
				dataType: "json",
				success: function (r) {
					if(r.result) {
						location.reload();
					}
				}
			});
		}
	});
</script>
@endsection
