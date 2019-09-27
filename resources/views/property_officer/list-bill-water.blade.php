@extends('base-admin')
@section('content')
<div class="page-title">
	<div class="title-env">
		<h1 class="title">ค่าน้ำ</h1>
	</div>
	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li>
				<a href="{{ url('/') }}"><i class="fa-home"></i>Home</a>
			</li>
			<li class="active">
				<strong>{{trans('messages.Meter.water')}}</strong>
			</li>
		</ol>
	</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ trans('messages.search') }}{{trans('messages.Meter.period')}}</h3>
            </div>
            <div class="panel-body">
            	 <form method="POST" id="search-property-form" action="#" accept-charset="UTF-8" class="form-inline">
                        <div class="form-group">
                        	{!! Form::select('period_select', $list_month,null,['id'=>'period_month','class'=>'form-control period_month_dropdown']) !!}
                            <input type="hidden" name="id" value="{!! $id !!}" class="id_property">
                        </div>
                  </form>
            </div>
        </div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
				<h3>{{trans('messages.Meter.water')}}{{trans('messages.Meter.period')}} <span class="month_label">{{$month_label}}</span></h3>
				<div class="panel-body" id="landing-property-list">
					@include('property_officer.list-element-water')
				</div>
			</div>
	</div>
</div>
<div class="modal fade" id="modal-active" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{{ trans('messages.Member.confirm_ban_head') }}</h4>
			</div>
			<div class="modal-body">
				{!! trans('messages.Member.confirm_ban_msg') !!}
			</div>
			 <div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">{{ trans('messages.cancel') }}</button>
				<button type="submit" class="btn btn-primary change-active-status-btn">{{ trans('messages.confirm') }}</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="modal-inactive" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{{ trans('messages.Member.confirm_active_head') }}</h4>
			</div>
			<div class="modal-body">
				{!! trans('messages.Member.confirm_active_msg') !!}
			</div>
			 <div class="modal-footer">
				<button type="button" class="btn btn-white" data-dismiss="modal">{{ trans('messages.cancel') }}</button>
				<button type="submit" class="btn btn-primary change-active-status-btn">{{ trans('messages.confirm') }}</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="edit-officer-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">ตั้งค่าฟังก์ชั่นของนิติบุคคล</h4>
			</div>
			<div id="form-edit-officer">
				<div class="form">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-white" data-dismiss="modal">{{ trans('messages.cancel') }}</button>
					<button type="button" class="btn btn-primary save-officer">{{ trans('messages.save') }}</button>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="edit-unit-modal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">{{trans('messages.Meter.water')}}</h4>
			</div>

			<div class="modal-body">
				<div id="unit-edit-content">

				</div>
				<span class="ue-loading">{{ trans('messages.loading') }}...</span>
			</div>

		</div>
	</div>
</div>

@endsection
@section('script')
	<script src="{{ url('/') }}/js/datatables/js/jquery.dataTables.min.js"></script>
	<script src="{{ url('/') }}/js/datatables/dataTables.bootstrap.js"></script>
	<script src="{{ url('/') }}/js/datatables/yadcf/jquery.dataTables.yadcf.js"></script>
	<script src="{{ url('/') }}/js/datatables/tabletools/dataTables.tableTools.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/js/jquery-ui/jquery-ui.min.js"></script>
	<script type="text/javascript" src="{{url('/')}}/js/jquery-validate/jquery.validate.min.js"></script>
	<script>
	$(function () {
        $('#edit-unit-modal').on('hidden.bs.modal', function () {
            //location.reload();
        })

		$('.panel-body').on('click','.paginate-link', function (e){
			e.preventDefault();
			propertyPage($(this).attr('data-page'));
		})

		$('.panel-body').on('change','.paginate-select', function (e){
			e.preventDefault();
			propertyPage($(this).val());
		})

        $( ".period_month_dropdown" ).change(function() {
            //alert( $(this).val() );
            propertyPage (1);
        });

        $('body').on('click','.unit-edit-row',function (e){
            e.preventDefault();
            $('#edit-unit-modal').modal('show');
            getUnitForm($(this).attr('data-unit'),$("#period_month option:selected").val());
        });

        $('body').on('click','.save-edit-unit',function (e){
            e.preventDefault();
            var diff_var = $('[name=unit]').val() - $('[name=old_unit]').val();
            //if(diff_var < 0){
				//alert('{{ trans('messages.Meter.validate_less_than_old_meter') }}');
				//$('[name=unit]').addClass('error');
			//}else{
				saveUnit();
			//}
        });

        /*$('body').on('click','.other-edit-unit',function (e){
            //alert('aa');
            e.preventDefault();
            $('#edit-unit-modal').modal('show');
            saveUnitAndNext($(this).attr('data-unit'),$("#period_month option:selected").val());
        });*/

        $('body').on('click','.other-edit-unit',function (e){
            e.preventDefault();
            var diff_var = $('[name=unit]').val() - $('[name=old_unit]').val();
			//if(diff_var < 0){
				//alert('{{ trans('messages.Meter.validate_less_than_old_meter') }}');
				//$('[name=unit]').addClass('error');
			//}else{
				$('#edit-unit-modal').modal('show');
				saveUnitAndNext($(this).attr('data-unit'),$("#period_month option:selected").val());
			//}
        });

        $('body').on('keydown','#form-edit-unit', function(e) {
			$('[name=unit]').removeClass('error');
            if(e.keyCode == 13) {
                var diff_var = $('[name=unit]').val() - $('[name=old_unit]').val();
                //if(diff_var < 0){
                    //e.preventDefault();
                    //alert('{{ trans('messages.Meter.validate_less_than_old_meter') }}');
					//$('[name=unit]').addClass('error');
				//}else{
                    $('#next-edit-unit').click();
				//}
                return false;
            }
        });

	});

	function propertyPage (page) {
		var data = $('form').serialize()+'&page='+page;
        $('.month_label').html($('select option:selected').text());
		$('#landing-property-list').css('opacity','0.6');
		$.ajax({
			url     : $('#root-url').val()+"/root/admin/edit/bill_water_form",
			data    : data,
			dataType: "html",
			method: 'post',
			success: function (h) {
				$('#landing-property-list').css('opacity','1').html(h);
			}
		})
	}

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

	$('.change-active-status-btn').on('click', function () {
		$(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
		changeActiveStatus (tmp.attr('data-pid'),parseInt(tmp.attr('data-status')));
	});

	$('#landing-property-list').on('click', '.edit-property-feature', function (e){
		e.preventDefault();
		var _this = $(this);
		_this.html('<i class="fa-spin fa-spinner"></i>').attr('disabled','disabled');
		var pid = _this.attr('data-pid');
		$.ajax({
			url     : $('#root-url').val()+"/root/admin/property-feature/edit/get",
			method	: "POST",
			data 	: ({pid:pid}),
			dataType: "html",
			success: function (t) {
				_this.html('<i class="fa-cogs"></i>').removeAttr('disabled','disabled');;
				$('#form-edit-officer .form').html(t);
				$('#edit-officer-modal').modal('show');
			}
		});
	});

	$('#form-edit-officer .save-officer').on('click',function () {
		var btn = $(this);
		btn.attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
		$.ajax({
			url     : $('#root-url').val()+"/root/admin/property-feature/edit/save",
			method	: "POST",
			data 	: $('#form-edit-officer form').serialize(),
			dataType: "html",
			success: function (t) {
				if(t == 'saved') {
					$('#edit-officer-modal').modal('hide');
				} else {
					$('#form-edit-officer .form').html(t);
				}
				btn.removeAttr('disabled').find('i').remove();
			}
		});
	});

	function changeActiveStatus (pid,flag) {
		$.ajax({
			url     : $('#root-url').val()+"/root/admin/property/status",
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

	function saveUnitAndNext(id,period){
            $.ajax({
                type: "POST",
                url: $('#root-url').val()+"/meter/water/save",
                data: $( "#form-edit-unit" ).serialize(),
                success: function(e) {
                    if(e.message == "true"){
						$("#val_of_"+e.id).html(e.value);
						$("#net_val_of_"+e.id).html(e.net_value);
                        getUnitForm(id,period);
					}
                }
            });
	}

	function saveUnit(){
            $.ajax({
                type: "POST",
                url: $('#root-url').val()+"/meter/water/save",
                data: $( "#form-edit-unit" ).serialize(),
                success: function(e) {
                    if(e.message == "true"){
                        location.reload();
					}
                }
            });
	}

    function getUnitForm (id,period) {
        $('#unit-edit-content').hide();
        $(this).removeData('modal');
        $('.ue-loading').show();
        var id_property = $('.id_property').val();
        $.ajax({
            url     : $('#root-url').val()+"/meter/water/form",
            method	: "POST",
            data 	: ({unit_id:id,period_month:period,id:id_property}),
            dataType: "html",
            success: function (t) {
                $('#unit-edit-content').html(t).fadeIn(300);
                $('.ue-loading').hide();
                $('.unit-input-form').focus().select();
            }
        });
    }

    function focusMobilForm() {
        var input = document.getElementById('unit-input-form');
        input.focus();
        input.setSelectionRange(0,99999);
    }
	</script>
@endsection
