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
                                {!! Form::text('property_name_th',null,array('class'=>'form-control','maxlength' => 200, 'placeholder'=> trans('messages.mandatory') )) !!}
                                <?php echo $errors->first('property_name_th','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                            </div>
                            <label class="col-sm-2 control-label" for="field-1">{!! trans('messages.AboutProp.property_name') !!} (en)</label>
                            <div class="col-sm-4">
                                {!! Form::text('property_name_en',null,array('class'=>'form-control','maxlength' => 200, 'placeholder'=> trans('messages.mandatory') )) !!}
                                <?php echo $errors->first('property_name_en','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                            </div>
                        </div>

                        <div class="form-group @if($errors->has('juristic_person_name_th') || $errors->has('juristic_person_name_en')) validate-has-error @endif">
                            <label class="col-sm-2 control-label" for="field-1">{!! trans('messages.AboutProp.juristic_person_name') !!} (th)</label>
                            <div class="col-sm-4">
                                {!! Form::text('juristic_person_name_th',null,array('class'=>'form-control','maxlength' => 200, 'placeholder'=> trans('messages.mandatory'))) !!}
                                <?php echo $errors->first('juristic_person_name_th','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                            </div>
                            <label class="col-sm-2 control-label" for="field-1">{!! trans('messages.AboutProp.juristic_person_name') !!} (en)</label>
                            <div class="col-sm-4">
                                {!! Form::text('juristic_person_name_en',null,array('class'=>'form-control','maxlength' => 200, 'placeholder'=> trans('messages.mandatory'))) !!}
                                <?php echo $errors->first('juristic_person_name_en','<span id="name-error" class="validate-has-error">:message</span>'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.area') !!}</label>
                            <div class="col-sm-4">
                                {!! Form::text('area_size',null,array('class'=>'form-control')) !!}
                            </div>
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.unit_amount') !!}</label>
                            <div class="col-sm-4">
                                {!! Form::text('unit_size',null,array('class'=>'form-control price','maxlength' => 10, 'placeholder'=> trans('messages.mandatory'))) !!}
                            </div>
                        </div>

                        <?php /*<div class="form-group">
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.min_price') !!}</label>
                            <div class="col-sm-4">
                                {!! Form::text('min_price',0,array('class'=>'price form-control', 'placeholder'=> trans('messages.mandatory'))) !!}
                            </div>
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.max_price') !!}</label>
                            <div class="col-sm-4">
                                {!! Form::text('max_price',0,array('class'=>'price form-control', 'placeholder'=> trans('messages.mandatory'))) !!}
                            </div>
                        </div> */ ?>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.min_price') !!}</label>
                            <div class="col-sm-4">
                                {!! Form::select('min_price',[
                                    1 => '1,000,000 - 3,000,000 '.trans('messages.Report.baht'),
                                    2 => '3,000,001 - 5,000,000 '.trans('messages.Report.baht'),
                                    3 => '5,000,001 - 10,000,000 '.trans('messages.Report.baht'),
                                    4 => '10,000,001+',
                                ],0,array('class'=>'price form-control')) !!}
                            </div>
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.max_price') !!}</label>
                            <div class="col-sm-4">
                                {!! Form::select('max_price',[
                                    1 => '1,000,000 - 3,000,000 '.trans('messages.Report.baht'),
                                    2 => '3,000,001 - 5,000,000 '.trans('messages.Report.baht'),
                                    3 => '5,000,001 - 10,000,000 '.trans('messages.Report.baht'),
                                    4 => '10,000,001+',
                                ],0,array('class'=>'price form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.cat_property') !!}</label>
                            <div class="col-sm-4">
                                @if(!empty($property1))
                                    <select name="developer_group_id" id="" class="form-control">
                                        <option value="">กลุ่มผู้บริหารนิติบุคคล</option>
                                        @foreach($pmg as $row)
                                            <?php
                                            $select=$property1->developer_group_id==$row->id?"selected":"";
                                            ?>
                                            <option value="{!!$row->id!!}" {!!$select!!}>{!!$row->name!!}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <select name="developer_group_id" id="" class="form-control">
                                        <option value="">กลุ่มผู้บริหารนิติบุคคล</option>
                                        @foreach($pmg as $row)
                                            <option value="{!!$row->id!!}">{!!$row->name!!}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.property_type') !!}</label>
                            <div class="col-sm-4">
                                {!! Form::select('property_type',$property_type,null,array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.name_company') !!}</label>
                            <div class="col-sm-4">
                                {!! Form::text('company_name',null,array('class'=>'form-control')) !!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.tax_id') !!}</label>
                            <div class="col-sm-10">
                                {!! Form::text('tax_id',null,array('class'=>'form-control','maxlength' => 13)) !!}
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
                                {!! Form::text('address_no',null,array('class'=>'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.road') !!} (th)</label>
                            <div class="col-sm-4">
                                {!! Form::text('street_th',null,array('class'=>'form-control', 'placeholder'=> trans('messages.mandatory'))) !!}
                            </div>
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.road') !!} (en)</label>
                            <div class="col-sm-4">
                                {!! Form::text('street_en',null,array('class'=>'form-control', 'placeholder'=> trans('messages.mandatory'))) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.address') !!} (th)</label>
                            <div class="col-sm-4">
                                {!! Form::text('address_th',null,array('class'=>'form-control','maxlength' => 200, 'placeholder'=> trans('messages.mandatory'))) !!}
                            </div>
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.address') !!} (en)</label>
                            <div class="col-sm-4">
                                {!! Form::text('address_en',null,array('class'=>'form-control','maxlength' => 200, 'placeholder'=> trans('messages.mandatory'))) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.province') !!}</label>
                            <div class="col-sm-4">
                                {!! Form::select('province',$provinces,null,array('class'=>'form-control')) !!}
                            </div>

                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.postcode') !!}</label>
                            <div class="col-sm-4">
                                {!! Form::text('postcode',null,array('class'=>'form-control','maxlength' => 10, 'placeholder'=> trans('messages.mandatory'))) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">{!! trans('messages.tel') !!}</label>
                            <div class="col-sm-4">
                                {!! Form::text('tel',null,array('class'=>'form-control')) !!}
                            </div>
                            <label class="col-sm-2 control-label">{!! trans('messages.fax') !!}</label>
                            <div class="col-sm-4">
                                {!! Form::text('fax',null,array('class'=>'form-control')) !!}
                            </div>
                        </div>

                        <div class="form-group" style="position: relative;">
                            <label class="col-sm-2 control-label">{!! trans('messages.AboutProp.location') !!}</label>
                             <div id="search-geo-block">
                                <input id="address" class="controls" type="text" placeholder="Search Box" style="float: left;height: 35px;">
                                <input type="button" class="btn btn-primary" id="search-geo-btn" value="SEARCH" />
                            </div>
                            <div class="col-sm-10"><div id="map" style="height:300px;"></div></div>
                            {!! Form::hidden('lat',null,array('id'=>'latbox')) !!}
                            {!! Form::hidden('lng',null,array('id'=>'lngbox')) !!}
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
								<i class="fa-at"></i>
							</span>
							{!! Form::text('user[email]',null,array('class' => 'form-control', "data-validate" => "email")) !!}
						</div>
						<?php echo $errors->first('email','<span id="name-error" class="validate-has-error email-error">:message</span>'); ?>
					</div>
				</div>
				<div class="form-group-separator"></div>
				<div class="form-group @if($errors->has('password')) validate-has-error @endif">
					<label class="col-sm-2 control-label" for="field-2">Password</label>
					<div class="col-sm-10">
						{!! Form::password('user[password]',array('class' => 'form-control')) !!}
						<?php echo $errors->first('password','<span id="name-error" class="validate-has-error">:message</span>'); ?>
					</div>
				</div>
				<div class="form-group @if($errors->has('password_confirm')) validate-has-error @endif">
					<label class="col-sm-2 control-label" for="field-2">Confirm Password</label>
					<div class="col-sm-10">
						{!! Form::password('user[password_confirm]',array('class' => 'form-control')) !!}
						<?php echo $errors->first('password_confirm','<span id="name-error" class="validate-has-error">:message</span>'); ?>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<input type="hidden" id="land-label" value="{!! trans('messages.Prop_unit.land') !!}"/>
<input type="hidden" id="property-label" value="{!! trans('messages.Prop_unit.property') !!}"/>
<input type="hidden" id="property-none-label" value="{!! trans('messages.Prop_unit.none') !!}"/>
<script src='https://maps.googleapis.com/maps/api/js?key={!! env('MAP_API_KEY') !!}' type='text/javascript'></script>
<script type="text/javascript" src="{!!url('/')!!}/js/number.js"></script>
<script type="text/javascript" src="{!!url('/')!!}/js/jquery.floatThead.min.js"></script>
<script type="text/javascript" src="{!!url('/')!!}/js/jquery-validate/jquery.validate.min.js"></script>
<script type="text/javascript" src="{!!url('/')!!}/js/nabour-property-form.js"></script>
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

	$(function () {
	    //$(".price").number(true);
	    $('#search-geo-btn').on('click',function () {
            codeAddress();
        });

        $('#add-unit-later').on('change', function () {
            if($(this).is(':checked')) {
                $(this).parents('.panel-default').addClass('collapsed');
            } else {
                $(this).parents('.panel-default').removeClass('collapsed');
            }
            
        })

        $('body').on('click','#submit-form', function (e) {
            validateForm ();
            if($('#add-unit-later').length && !$('#add-unit-later').is(':checked')) {
                if($('#unit-csv-data').val() != '') {
                    allGood = true;
                } else allGood = checkField ();
            } else {
                allGood = true;
            }
            

            if($('#p_form').valid() && allGood ) {
                $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                $('#p_form').submit();
            } else {
                var top_;
                if(!$('#p_form').valid()) top_ = $('.error').first().offset().top;
                else top_ = $('#prop_list').offset().top;
                 $('html,body').animate({scrollTop: top_-100}, 1000);
            }
        })
	})
</script>
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
.form-control::-webkit-input-placeholder { /* Chrome/Opera/Safari */
  color: #e2e2e2;
}
.form-control::-moz-placeholder { /* Firefox 19+ */
  color: #e2e2e2;
}
.form-control:-ms-input-placeholder { /* IE 10+ */
  color: #e2e2e2;
}
.form-control:-moz-placeholder { /* Firefox 18- */
  color: #e2e2e2;
}
</style>
