<?php
    $lang = App::getLocale();
    $property_type = unserialize(constant('PROPERTY_TYPE_'.strtoupper($lang)));
?>
<section class="mailbox-env">
<div class="row">
    <div class="col-sm-12 mailbox-right">
        <div class="mail-single">
            <div class="mail-single-header">
                <h2>
                    ข้อมูลผู้ทดลองใช้
                    <a href="{!! url('sales/property/list') !!}" class="go-back">
                        <i class="fa-angle-left"></i> ย้อนกลับ
                    </a>
                </h2>
            </div>

            <div class="panel-body">
                <div class="form-group @if($errors->has('name')) validate-has-error @endif">
                    <label class="col-sm-3 control-label" for="field-1">{!! trans('messages.name') !!}</label>
                    <div class="col-sm-9">
                        {!! Form::text('demo_data[contact_name]',null,array('class' => 'form-control', 'readonly' => 'true')) !!}
                        <?php echo $errors->first('name','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                    </div>
                </div>
                <div class="form-group @if($errors->has('email')) validate-has-error @endif">
                    <label class="col-sm-3 control-label" for="field-1">อีเมลผู้ติดต่อ</label>
                    <div class="col-sm-9">
                        <div class="input-group">
							<span class="input-group-addon">
								<i class="linecons-mail"></i>
							</span>
                            {!! Form::text('demo_data[email]',null,array('class' => 'form-control', "data-validate" => "email", 'readonly' => 'true')) !!}
                        </div>
                        <?php echo $errors->first('email','<span id="name-error" class="validate-has-error email-error">:message</span>'); ?>
                    </div>
                </div>
                <div class="form-group @if($errors->has('email')) validate-has-error @endif">
                    <label class="col-sm-3 control-label" for="field-1">เบอร์โทรผู้ติดต่อ</label>
                    <div class="col-sm-9">
                        <div class="input-group">
							<span class="input-group-addon">
								<i class="linecons-mobile"></i>
							</span>
                            {!! Form::text('demo_data[tel_contact]',null,array('class' => 'form-control')) !!}
                        </div>
                        <?php echo $errors->first('email','<span id="name-error" class="validate-has-error email-error">:message</span>'); ?>
                    </div>
                </div>
                <div class="form-group @if($errors->has('email')) validate-has-error @endif">
                    <label class="col-sm-3 control-label" for="field-1">นิติบุคคลที่กำลังทดลองใช้</label>
                    <div class="col-sm-9">
                        {!! Form::text('demo_data[property_test_name]',null,array('class' => 'form-control', 'readonly' => 'true')) !!}
                        <?php echo $errors->first('name','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                    </div>
                </div>
                <div class="form-group @if($errors->has('email')) validate-has-error @endif">
                    <label class="col-sm-3 control-label" for="field-1">หมดเวลาการทดลองใช้</label>
                    <div class="col-sm-9">
                        {!! Form::text('demo_data[trial_expire]',null,array('class' => 'form-control', 'readonly' => 'true')) !!}
                        <?php echo $errors->first('name','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                    </div>
                </div>
                <div class="form-group @if($errors->has('email')) validate-has-error @endif">
                    <label class="col-sm-3 control-label" for="field-1" style="padding-top:0;">สถานะ</label>
                    <div class="col-sm-9">
                        @if($property['demo_data']['status'] == 0)
                            <div class="label label-success">ว่าง</div>
                        @elseif($property['demo_data']['status'] == 1)
                            <div class="label label-info">ไม่ว่าง</div>
                        @elseif($property['demo_data']['status'] == 2)
                            <div class="label label-warning">หมดเวลาทดลอง</div>
                        @else
                            <div class="label label-danger">ระงับการใช้งาน</div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
</section>

<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">ข้อมูลนิติบุคคลที่กำลังทดลองใช้งาน</h3>
				<div class="panel-options">
					<a href="#" data-toggle="panel">
						<span class="collapse-icon">&ndash;</span>
						<span class="expand-icon">+</span>
					</a>
				</div>
			</div>
			<div class="panel-body">
				<div class="row">
                            <div class="col-sm-12">
                                <div class="form-group @if($errors->has('property_name_th') || $errors->has('property_name_en')) validate-has-error @endif">
                                    <label class="col-sm-2 control-label" for="field-1">{!! trans('messages.AboutProp.property_name') !!} (th)</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('property_name_th',null,array('class'=>'form-control','maxlength' => 200, 'readonly' => 'true')) !!}
                                        <?php echo $errors->first('property_name_th','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                                    </div>
                                    <label class="col-sm-2 control-label" for="field-1">{!! trans('messages.AboutProp.property_name') !!} (en)</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('property_name_en',null,array('class'=>'form-control','maxlength' => 200, 'readonly' => 'true')) !!}
                                        <?php echo $errors->first('property_name_en','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.area') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('area_size',null,array('class'=>'form-control','maxlength' => 10, 'readonly' => 'true')) !!}
                                    </div>
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.unit_amount') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('unit_size',null,array('class'=>'form-control','maxlength' => 10, 'readonly' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.min_price') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('min_price',null,array('class'=>'form-control price','maxlength' => 10, 'readonly' => 'true')) !!}
                                    </div>
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.max_price') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('max_price',null,array('class'=>'form-control price','maxlength' => 10, 'readonly' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.tax_id') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('tax_id',null,array('class'=>'form-control','maxlength' => 13, 'readonly' => 'true')) !!}
                                    </div>
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.property_type') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('property_type',$property_type,null,array('class'=>'form-control', 'readonly' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.constructor') !!}</label>
                                    <div class="col-sm-10">
                                        {!! Form::text('construction_by',null,array('class'=>'form-control','maxlength' => 100, 'readonly' => 'true')) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.address') !!} (th)</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('address_th',null,array('class'=>'form-control','maxlength' => 200, 'readonly' => 'true')) !!}
                                    </div>
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.address') !!} (en)</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('address_en',null,array('class'=>'form-control','maxlength' => 200, 'readonly' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.road') !!} (th)</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('street_th',null,array('class'=>'form-control','maxlength' => 50, 'readonly' => 'true')) !!}
                                    </div>
                                     <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.road') !!} (en)</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('street_en',null,array('class'=>'form-control','maxlength' => 50, 'readonly' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.province') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::select('province',$provinces,null,array('class'=>'form-control', 'readonly' => 'true')) !!}
                                    </div>

                                    <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.postcode') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('postcode',null,array('class'=>'form-control','maxlength' => 10, 'readonly' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">{!! trans('messages.tel') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('tel',null,array('class'=>'form-control','maxlength' => 30, 'readonly' => 'true')) !!}
                                    </div>
                                    <label class="col-sm-2 control-label">{!! trans('messages.fax') !!}</label>
                                    <div class="col-sm-4">
                                        {!! Form::text('fax',null,array('class'=>'form-control','maxlength' => 30, 'readonly' => 'true')) !!}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-10 col-sm-offset-2"><div id="map" style="height:300px;"></div></div>
                                    {!! Form::hidden('lat',null,array('id'=>'latbox')) !!}
                                    {!! Form::hidden('lng',null,array('id'=>'lngbox')) !!}
                                </div>
                            </div>
                        </div>
				@if(isset($flag_create))
				<div class="form-group">
					<label class="col-sm-2 control-label">Units (separated with ",")</label>
					<div class="col-sm-10">
						{!! Form::textarea('units',null,array('class'=>'form-control')) !!}
					</div>
				</div>
				@endif
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-sm-12">
		<div class="panel panel-default text-right">
			<a class="btn btn-gray" href="{!!url('sales/property/list')!!}">Back</a>
		</div>
	</div>
</div>
<script src='https://maps.googleapis.com/maps/api/js?key={!! env('MAP_API_KEY') !!}' type='text/javascript'></script>
<script type="text/javascript" src="{!!url('/')!!}/js/number.js"></script>
<script type="text/javascript">

	var map,marker,geocoder;
	function initialize() {

		@if(!empty($property['lat']) && !empty($property['lng']))
		var latlng = new google.maps.LatLng({!!$property['lat']!!}, {!!$property['lng']!!});
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
		    //draggable: true
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
          map.setCenter(results[0].geometry.location);
          marker.setPosition(results[0].geometry.location);
        } else {
          alert('Geocode was not successful for the following reason: ' + status);
        }
      });
    }

	$(function () {
	    $(".price").number(true);
	    $('#search-geo-btn').on('click',function () {
            codeAddress();
        })
	})
</script>
