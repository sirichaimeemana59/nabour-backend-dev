@extends('detail-base')
@section('content')
<?php
    $lang = App::getLocale();
    $property_type = unserialize(constant('PROPERTY_TYPE_'.strtoupper($lang)));
?>
<div class="top-bar-area">
   <div class="container">
       <div class="row">
           <div class="col-md-12 col-sm-12">
               <div id="info-bar">
               </div>
               <!-- /#top-bar -->
           </div>
       </div>
   </div>
</div>
<div id="main">
	<div class="container">
		<div class="row">
            <div class="col-sm-12 col-md-12">
                <div id="title" class="container">
                    <h1>{!! trans('messages.PropertyForm.page_head') !!}</h1>
                    <h2>{!! trans('messages.PropertyForm.page_sub_head') !!}</h2>
                </div>
            </div>

        	<div class="col-md-10 col-md-offset-1">
        		<div class="panel panel-default home-panel">
        			<div class="panel-body">
        				<div class="row">


                            {!! Form::model($_form,['url'=>['home/form'],'class'=>'form-horizontal oop','id'=>'p_form']) !!}
                            {!! Form::hidden('id') !!}
                                <h2>{!! trans('messages.AboutProp.property_detail') !!}</h2>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        {!! trans('messages.PropertyForm.form_description') !!}
                                    </div>
                                </div>
                                <div class="form-group @if($errors->has('property_name_th')) validate-has-error @endif">
                                    <label class="col-sm-4 control-label" for="field-1">{!! trans('messages.AboutProp.property_name') !!} (ภาษาไทย)</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('property_name_th',null,array('class'=>'form-control','maxlength' => 200)) !!}
                                        <?php echo $errors->first('property_name_th','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                                    </div>
                                </div>
                                <div class="form-group @if($errors->has('property_name_en')) validate-has-error @endif">
                                    <label class="col-sm-4 control-label" for="field-1">{!! trans('messages.AboutProp.property_name') !!} (English)</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('property_name_en',null,array('class'=>'form-control','maxlength' => 200)) !!}
                                        <?php echo $errors->first('property_name_en','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                                    </div>
                                </div>

                                <div class="form-group @if($errors->has('juristic_person_name_th')) validate-has-error @endif">
                                    <label class="col-sm-4 control-label" for="field-1">{!! trans('messages.AboutProp.juristic_person_name') !!} (ภาษาไทย)</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('juristic_person_name_th',null,array('class'=>'form-control','maxlength' => 200)) !!}
                                        <?php echo $errors->first('juristic_person_name_th','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                                    </div>
                                </div>

                                <div class="form-group @if($errors->has('juristic_person_name_en')) validate-has-error @endif">
                                    <label class="col-sm-4 control-label" for="field-1">{!! trans('messages.AboutProp.juristic_person_name') !!} (English)</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('juristic_person_name_en',null,array('class'=>'form-control','maxlength' => 200)) !!}
                                        <?php echo $errors->first('juristic_person_name_en','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{!! trans('messages.AboutProp.tax_id') !!}</label>
                                    <div class="col-sm-8">
                                        {!! Form::text('tax_id',null,array('class'=>'form-control','maxlength' => 13)) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-4 control-label">{!! trans('messages.AboutProp.constructor') !!}</label>
                                    <div class="col-sm-8">
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
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.address') !!} (ภาษาไทย)</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('address_th',null,array('class'=>'form-control','maxlength' => 200)) !!}
                                    </div>
                                    <label class="col-sm-2 control-label more-margin">{!! trans('messages.AboutProp.address') !!} (English)</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('address_en',null,array('class'=>'form-control','maxlength' => 200)) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.road') !!} (ภาษาไทย)</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('street_th',null,array('class'=>'form-control','maxlength' => 50)) !!}
                                    </div>
                                     <label class="col-sm-2 control-label more-margin">{!! trans('messages.AboutProp.road') !!} (English)</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('street_en',null,array('class'=>'form-control','maxlength' => 50)) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.province') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('province',$provinces,null,array('class'=>'form-control')) !!}
                                    </div>

                                    <label class="col-sm-2 control-label more-margin">{!! trans('messages.AboutProp.postcode') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('postcode',null,array('class'=>'form-control','maxlength' => 10)) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.tel') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('tel',null,array('class'=>'form-control','maxlength' => 30)) !!}
                                    </div>
                                    <label class="col-sm-2 control-label more-margin">{!! trans('messages.fax') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('fax',null,array('class'=>'form-control','maxlength' => 30)) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.property_type') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('property_type',$property_type,null,array('class'=>'form-control')) !!}
                                    </div>
                                    <label class="col-sm-2 control-label more-margin">{!! trans('messages.AboutProp.area') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('area_size',null,array('class'=>'form-control','maxlength' => 10)) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.min_price') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('min_price',[
                                            1 => '1,000,000 - 3,000,000 '.trans('messages.Report.baht'),
                                            2 => '3,000,001 - 5,000,000 '.trans('messages.Report.baht'),
                                            3 => '5,000,001 - 10,000,000 '.trans('messages.Report.baht'),
                                            4 => '10,000,001+',
                                        ],0,array('class'=>'form-control')) !!}
                                    </div>
                                    <label class="col-sm-2 control-label more-margin">{!! trans('messages.AboutProp.max_price') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('max_price',[
                                            1 => '1,000,000 - 3,000,000 '.trans('messages.Report.baht'),
                                            2 => '3,000,001 - 5,000,000 '.trans('messages.Report.baht'),
                                            3 => '5,000,001 - 10,000,000 '.trans('messages.Report.baht'),
                                            4 => '10,000,001+',
                                        ],0,array('class'=>'form-control')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.location') !!}</label>
                                     <div id="search-geo-block">
                                        <input id="address" class="controls" type="text" placeholder="Search Box">
                                        <input type="button" class="btn btn-primary" id="search-geo-btn" value="SEARCH" />
                                    </div>
                                    <div class="col-sm-12"><div id="map" style="height:300px;"></div></div>
                                    {!! Form::hidden('lat',null,array('id'=>'latbox')) !!}
                                    {!! Form::hidden('lng',null,array('id'=>'lngbox')) !!}
                                </div>
                                <div class="form-group">
                                    <b class="col-sm-12" id="prop_list">{!! trans('messages.PropertyForm.property_unit_head') !!}</b>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12" style="max-height: 600px;overflow-y: auto;">
                                        <table id="unit-table" class="table unit-table">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th width="140px">{!! trans('messages.unit_no') !!}</th>
                                                    <th>{!! trans('messages.Prop_unit.type') !!}</th>
                                                    <th width="70px">{!! trans('messages.Prop_unit.unit_area') !!}</th>
                                                    <th>{!! trans('messages.Prop_unit.owner_name_th') !!}</th>
                                                    <th>{!! trans('messages.Prop_unit.owner_name_en') !!}</th>
                                                    <th>{!! trans('messages.delete') !!}</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                <?php $count = 1; ?>
                                                @if(isset($_form['unit']))
                                                @foreach($_form['unit'] as $key => $value)
                                                <tr>
                                                    <td>{!!  $count !!}.</td>
                                                    <td>{!! Form::text('unit['.$key.'][no]',$value['no'],array('class'=>'form-control input-unit-no','maxlength' => 10)) !!}</td>
                                                    <td>{!! Form::select('unit['.$key.'][is_land]', [0 => trans('messages.Prop_unit.property'),1 => trans('messages.Prop_unit.land')], $value['is_land'],array('class'=>'form-control')) !!}</td>
                                                    <td>{!! Form::text('unit['.$key.'][area]',$value['area'],array('class'=>'form-control unit-area','maxlength' => 10)) !!}</td>
                                                    <td>{!! Form::text('unit['.$key.'][owner_name_th]',$value['owner_name_th'],array('class'=>'form-control','maxlength' => 100)) !!}</td>
                                                    <td>{!! Form::text('unit['.$key.'][owner_name_en]',$value['owner_name_en'],array('class'=>'form-control','maxlength' => 100)) !!}</td>
                                                    <td>@if($count > 1)<button class="remove-row"><i class="fa fa-trash"></i></button>@endif</td>
                                                </tr>
                                                <?php $count++; ?>
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td> {!! $count !!}.</td>
                                                    <td>{!! Form::text('unit[0][no]',null,array('class'=>'form-control input-unit-no','maxlength' => 10)) !!}</td>
                                                    <td>{!! Form::select('unit[0][is_land]', [0 => trans('messages.Prop_unit.property'),1 => trans('messages.Prop_unit.land')], 0,array('class'=>'form-control')) !!}</td>
                                                    <td>{!! Form::text('unit[0][area]',null,array('class'=>'form-control unit-area','maxlength' => 10)) !!}</td>
                                                    <td>{!! Form::text('unit[0][owner_name_th]',null,array('class'=>'form-control','maxlength' => 100)) !!}</td>
                                                    <td>{!! Form::text('unit[0][owner_name_en]',null,array('class'=>'form-control','maxlength' => 100)) !!}</td>
                                                    <td></td>
                                                </tr>
                                                @endif
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
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <hr/>
                                        {!! trans('messages.PropertyForm.save_draft_descp') !!}<br/>
                                        {!! trans('messages.PropertyForm.submit_descp') !!}
                                    </div>
                                </div>
                    	       <div class="form-group">
                                   <div class="col-sm-12 property-form-action text-right">
                            			<a class="btn btn-gray" href="{!!url('root/admin/property/list')!!}">{!! trans('messages.cancel') !!}</a>
                                        <input type="button" id="save-draft" class="btn btn-primary" value="{!! trans('messages.PropertyForm.save_draft_btn') !!}" />
                                        <input type="button"  class="btn btn-color" data-target="#confirmSubmit" data-toggle="modal" value="{!! trans('messages.PropertyForm.submit_btn') !!}" />
                                    </div>
                               </div>
                               <input type="hidden" name="save-type" id="save-type"/>
                           {!! Form::close() !!}
                        </div>
                    </div>
            	</div>
            </div>
        </div>
    </div>
</div>

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

<div class="modal login fade" id="submitFail" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="form-signin-heading modal-title" id="myModalLabel">{!! trans('messages.PropertyForm.submit_fail') !!}</h2>
            </div>
            <div class="modal-body">
               {!! trans('messages.PropertyForm.check_form') !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-color" data-dismiss="modal">{!! trans('messages.ok') !!}</button>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="land-label" value="{!! trans('messages.Prop_unit.land') !!}"/>
<input type="hidden" id="property-label" value="{!! trans('messages.Prop_unit.property') !!}"/>
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

	 function codeAddress() {
      var address = document.getElementById('address').value;
      geocoder.geocode( { 'address': address}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var l = results[0].geometry.location;
            map.setCenter(l);
            marker.setPosition(l);
            $('#latbox').val(l.lat());
            $('#lngbox').val(l.lng());
        } else {
          alert('Geocode was not successful for the following reason: ' + status);
        }
      });
    }

	$(function() {
        $('body').on('click','#submit-form', function (e) {
            validateForm ();
            allGood = checkField ();
            if($('#p_form').valid() && allGood ) {
                $('#save-type').val('submit');
                $('#p_form').submit();
            } else {
                var top_;
                if(!$('#p_form').valid()) top_ = $('.error').first().offset().top;
                else top_ = $('#prop_list').offset().top;
                $('#confirmSubmit').modal('hide');
                 $('html,body').animate({scrollTop: top_-100}, 1000);
                 $('#submitFail').modal('show');
            }
        })
        $('body').on('click','#save-draft', function (e) {
            $('#save-type').val('draft');
            $('#p_form').validate().settings.ignore = "*";
            $('#p_form').submit();
        })
	})

</script>
<script type="text/javascript" src="{!!url('/')!!}/js/nabour-property-form.js"></script>
<link rel="stylesheet" type="text/css" href="{!! url('/') !!}/home-theme/css/base.css">
@endsection
