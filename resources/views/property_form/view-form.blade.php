@extends('base-admin')
@section('content')
<?php
    $lang = App::getLocale();
    $property_type = unserialize(constant('PROPERTY_TYPE_'.strtoupper($lang)));
?>
<div class="page-title">
	<div class="title-env">
		<h1 class="title">{!! trans('messages.PropertyForm.page_head') !!}</h1>
		<p class="description">{!! trans('messages.PropertyForm.page_sub_head_admin') !!} </p>
	</div>
	<div class="breadcrumb-env">
		<ol class="breadcrumb bc-1" >
			<li>
				<a href="{!! url('/') !!}"><i class="fa-home"></i>{!! trans('messages.page_home') !!}</a>
			</li>
			<li class="active"><a href="#"> {!! trans('messages.PropertyForm.page_head') !!}</a></li>
		</ol>
	</div>
</div>
{!! Form::model($_form,['url'=>['officer/property-form/save'],'class'=>'form-horizontal oop','id'=>'p_form']) !!}
{!! Form::hidden('id') !!}
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{!! trans('messages.AboutProp.property_detail') !!}</h3>
                </div>
                <div class="panel-body">
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group @if($errors->has('property_name_th') || $errors->has('property_name_en')) validate-has-error @endif">
                                <label class="col-sm-2 control-label" for="field-1">{!! trans('messages.AboutProp.property_name') !!} (th)</label>
                                <div class="col-sm-4">
                                    {!! Form::text('property_name_th',null,array('class'=>'form-control','maxlength' => 200)) !!}
                                    <?php echo $errors->first('property_name_th','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                                </div>
                                <label class="col-sm-2 control-label" for="field-1">{!! trans('messages.AboutProp.property_name') !!} (en)</label>
                                <div class="col-sm-4">
                                    {!! Form::text('property_name_en',null,array('class'=>'form-control','maxlength' => 200)) !!}
                                    <?php echo $errors->first('property_name_en','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                                </div>
                            </div>

                            <div class="form-group @if($errors->has('juristic_person_name_th') || $errors->has('juristic_person_name_en')) validate-has-error @endif">
                                <label class="col-sm-2 control-label" for="field-1">{!! trans('messages.AboutProp.juristic_person_name') !!} (th)</label>
                                <div class="col-sm-4">
                                    {!! Form::text('juristic_person_name_th',null,array('class'=>'form-control','maxlength' => 200)) !!}
                                    <?php echo $errors->first('juristic_person_name_th','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                                </div>
                                <label class="col-sm-2 control-label" for="field-1">{!! trans('messages.AboutProp.juristic_person_name') !!} (en)</label>
                                <div class="col-sm-4">
                                    {!! Form::text('juristic_person_name_en',null,array('class'=>'form-control','maxlength' => 200)) !!}
                                    <?php echo $errors->first('juristic_person_name_en','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.area') !!}</label>
                                <div class="col-sm-4">
                                    {!! Form::text('area_size',null,array('class'=>'form-control','maxlength' => 10)) !!}
                                </div>
                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.unit_amount') !!}</label>
                                <div class="col-sm-4">
                                    {!! Form::text('unit_size',null,array('class'=>'form-control','maxlength' => 10)) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.min_price') !!}</label>
                                <div class="col-sm-4">
                                    {!! Form::text('min_price',null,array('class'=>'form-control price','maxlength' => 10)) !!}
                                </div>
                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.max_price') !!}</label>
                                <div class="col-sm-4">
                                    {!! Form::text('max_price',null,array('class'=>'form-control price','maxlength' => 10)) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.tax_id') !!}</label>
                                <div class="col-sm-4">
                                    {!! Form::text('tax_id',null,array('class'=>'form-control','maxlength' => 13)) !!}
                                </div>
                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.property_type') !!}</label>
                                <div class="col-sm-4">
                                    {!! Form::select('property_type',$property_type,null,array('class'=>'form-control')) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.constructor') !!}</label>
                                <div class="col-sm-10">
                                    {!! Form::text('construction_by',null,array('class'=>'form-control','maxlength' => 100)) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.address_no') !!}</label>
                                <div class="col-sm-10">
                                    {!! Form::text('address_no',null,array('class'=>'form-control','maxlength' => 10)) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.address') !!} (th)</label>
                                <div class="col-sm-4">
                                    {!! Form::text('address_th',null,array('class'=>'form-control','maxlength' => 200)) !!}
                                </div>
                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.address') !!} (en)</label>
                                <div class="col-sm-4">
                                    {!! Form::text('address_en',null,array('class'=>'form-control','maxlength' => 200)) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.road') !!} (th)</label>
                                <div class="col-sm-4">
                                    {!! Form::text('street_th',null,array('class'=>'form-control','maxlength' => 50)) !!}
                                </div>
                                 <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.road') !!} (en)</label>
                                <div class="col-sm-4">
                                    {!! Form::text('street_en',null,array('class'=>'form-control','maxlength' => 50)) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.province') !!}</label>
                                <div class="col-sm-4">
                                    {!! Form::select('province',$provinces,null,array('class'=>'form-control')) !!}
                                </div>

                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.postcode') !!}</label>
                                <div class="col-sm-4">
                                    {!! Form::text('postcode',null,array('class'=>'form-control','maxlength' => 10)) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! trans('messages.tel') !!}</label>
                                <div class="col-sm-4">
                                    {!! Form::text('tel',null,array('class'=>'form-control','maxlength' => 30)) !!}
                                </div>
                                <label class="col-sm-2 control-label">{!! trans('messages.fax') !!}</label>
                                <div class="col-sm-4">
                                    {!! Form::text('fax',null,array('class'=>'form-control','maxlength' => 30)) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.location') !!}</label>
                                 <div id="search-geo-block">
                                    {{--<input id="address" class="controls" type="text" placeholder="Search Box">--}}
                                    {{--<input type="button" class="btn btn-primary" id="search-geo-btn" value="SEARCH" />--}}
                                </div>
                                <div class="col-sm-10"><div id="map" style="height:300px;"></div></div>
                                {!! Form::hidden('lat',null,array('id'=>'latbox')) !!}
                                {!! Form::hidden('lng',null,array('id'=>'lngbox')) !!}
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <b class="col-sm-12" id="prop_list">{!! trans('messages.PropertyForm.property_unit_head') !!}</b>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" style="max-height: 400px;overflow-y: auto;">
                                        <table id="unit-table" class="table unit-table">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>{!! trans('messages.unit_no') !!}</th>
                                                    <th>{!! trans('messages.Prop_unit.type') !!}</th>
                                                    <th>{!! trans('messages.Prop_unit.unit_area') !!}</th>
                                                    <th>{!! trans('messages.Prop_unit.owner_name_th') !!}</th>
                                                    <th>{!! trans('messages.Prop_unit.owner_name_en') !!}</th>
                                                    <th>{!! trans('messages.delete') !!}</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                <?php $count = 1; ?>
                                                @foreach($_form['unit'] as $key => $value)
                                                <tr>
                                                    <td>{!!  $count !!}.</td>
                                                    <td>{!! Form::text('unit['.$key.'][no]',$value['no'],array('class'=>'form-control input-unit-no','maxlength' => 10)) !!}</td>
                                                    <td>{!! Form::select('unit['.$key.'][is_land]', [0 => trans('messages.Prop_unit.property'),1 => trans('messages.Prop_unit.land')], $value['is_land'],array('class'=>'form-control')) !!}</td>
                                                    <td>{!! Form::text('unit['.$key.'][area]',$value['area'],array('class'=>'form-control unit-area','maxlength' => 10)) !!}</td>
                                                    <td>{!! Form::text('unit['.$key.'][owner_name_th]',$value['owner_name_th'],array('class'=>'form-control','maxlength' => 100)) !!}</td>
                                                    <td>{!! Form::text('unit['.$key.'][owner_name_en]',$value['owner_name_en'],array('class'=>'form-control','maxlength' => 100)) !!}</td>
                                                    <td width="50px">@if($count > 1)<button class="remove-row"><i class="fa fa-trash"></i></button>@endif</td>
                                                </tr>
                                                <?php $count++; ?>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-sm-12">
                                        {!! trans('messages.PropertyForm.add_property_by') !!}
                                        <select id="loop-add-row">
                                            <option value="1">1</option>
                                            <option value="5">5</option>
                                            <option value="10">10</option>
                                            <option value="20">20</option>
                                            <option value="40">40</option>
                                            <option value="100">100</option>
                                        </select>
                                        <input type="button" value="+" id="add-unit-row"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{!! trans('messages.AdminUser.prop_admin_detail') !!}</h3>
                    <div class="panel-options">
                        <a href="#" data-toggle="panel">
                            <span class="collapse-icon">&ndash;</span>
                            <span class="expand-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group @if($errors->has('name')) validate-has-error @endif">
                        <label class="col-sm-2 control-label" for="field-1">{!! trans('messages.name') !!}</label>
                        <div class="col-sm-10">
                            {!! Form::text('user[name]',null,array('class' => 'form-control')) !!}
                            <?php echo $errors->first('name','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('email')) validate-has-error @endif">
                        <label class="col-sm-2 control-label" for="field-1">{!! trans('messages.AdminUser.username') !!}</label>
                        <div class="col-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="linecons-mail"></i>
                                </span>
                                {!! Form::text('user[email]',null,array('class' => 'form-control', "data-validate" => "email")) !!}
                            </div>
                            <?php echo $errors->first('email','<span id="name-error" class="validate-has-error email-error">:message</span>'); ?>
                        </div>
                    </div>
                    <div class="form-group @if($errors->has('password')) validate-has-error @endif">
                        <label class="col-sm-2 control-label" for="field-2">{!! trans('messages.Verify.password')!!}</label>
                        <div class="col-sm-10" style="padding-top:7px;">
                            *รหัสผ่านจะถูกระบบสุ่มขึ้นมาอัตโนมัติหลังจากข้อมูลมีความถูกต้องและถูกบันทึก
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
    	<div class="col-sm-12">
    		<div class="panel panel-default text-right">
    			<a class="btn btn-gray" href="{!!url('officer/property-form')!!}">{!! trans('messages.cancel') !!}</a>
    			<input type="button" value="{!! trans('messages.save') !!}" class="btn btn-primary" id="submit-form" />
    		</div>
    	</div>
    </div>
{!! Form::close() !!}

<div class="modal login fade" id="confirmSubmit" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="form-signin-heading modal-title" id="myModalLabel">{!! trans('messages.PropertyForm.confirm_submit_head') !!}</h2>
            </div>
            <div class="modal-body">
               {!! trans('messages.PropertyForm.confirm_submit_descp') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-border" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
                <button type="button" class="btn btn-color" id="submit-form">{!! trans('messages.ok') !!}</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="land-label" value="{!! trans('messages.Prop_unit.land') !!}"/>
<input type="hidden" id="property-label" value="{!! trans('messages.Prop_unit.property') !!}"/>
{!! Form::close() !!}
@endsection
@section('script')
<script src='https://maps.googleapis.com/maps/api/js?key={!! env('MAP_API_KEY') !!}' type='text/javascript'></script>
<script type="text/javascript" src="{!!url('/')!!}/js/number.js"></script>
<script type="text/javascript" src="{!!url('/')!!}/js/jquery.floatThead.min.js"></script>
<script type="text/javascript" src="{!!url('/')!!}/js/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript">

	var map,marker,geocoder;
	function initialize() {

		@if(!empty($_form['lat']) && !empty($_form['lng']))
		var latlng = new google.maps.LatLng({!!$_form['lat']!!}, {!!$_form['lng']!!});
		@else
		var latlng = new google.maps.LatLng(16.492660635148514, 100.86205961249993);
		@endif
		geocoder = new google.maps.Geocoder();
		map = new google.maps.Map(document.getElementById('map'), {
		    center: latlng,
		    zoom: 11,
		    mapTypeId: google.maps.MapTypeId.ROADMAP
		});
		marker = new google.maps.Marker({
		    position: latlng,
		    map: map,
		    draggable: true
		});

        google.maps.event.addListener(marker, 'dragend', function (event) {
		    $("#latbox").val(this.getPosition().lat());
		   	$("#lngbox").val(this.getPosition().lng());
		});
	}
	google.maps.event.addDomListener(window, 'load', initialize);

	$(function() {

        $('body').on('click','#submit-form', function (e) {
            validateForm ();
            allGood = checkField ();
            if($('#p_form').valid() && allGood ) {
                $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                $('#save-type').val('submit');
                $('#p_form').submit();
            } else {
                var top_;
                if(!$('#p_form').valid()) top_ = $('.error').first().offset().top;
                else top_ = $('#prop_list').offset().top;
                $('#confirmSubmit').modal('hide');
                 $('html,body').animate({scrollTop: top_-100}, 1000);
            }
        })
	})
</script>
<script type="text/javascript" src="{!!url('/')!!}/js/nabour-property-form.js"></script>
<style>
.unit-table th {
    background: #fff;
}
.remove-row {
    border: 1px solid red;
    background: #f99;
    color: #fff;
    font-size: 11px;
    margin-top: 5px;
}
#add-unit-row {
    background-color: #2dbca6;
    color: #fff;
    padding: 5px 10px;
    border: none;
    line-height: 20px;
}
#p_form .error,#p_form .error__ {
    border: 1px solid #a94442;
}
</style>
@endsection
