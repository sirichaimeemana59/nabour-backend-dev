<?php $cate 	= unserialize(constant('KEY_CARD_STATUS_'.strtoupper(App::getLocale()))); ?>
{!! Form::open(array('url'=>'water/save','method'=>'post','id'=>'form-edit-unit','class'=>'form-horizontal')) !!}
<div class="col-sm-12">
    <div class="form-group">
        <label class="col-sm-4 control-label" for="number">{{trans('messages.Meter.period')}} : {{ $bill_data['date_period_text'] }}</label>
    </div>
    <hr>
    <div class="form-group">
        <label class="col-sm-4 control-label" for="number">{{ trans('messages.unit_no') }}</label>
        <div class="col-sm-8">
            {!! Form::hidden('property_id',$id) !!}
            {!! Form::hidden('property_unit_id',$bill_data['property_unit_id']) !!}
            {!! Form::hidden('id',$bill_data['id']) !!}
            {!! Form::hidden('bill_date_period',$bill_data['date_period']) !!}
            {!! Form::text('unit_number',$bill_data['property_unit_number'],array('class'=>'form-control', 'maxlength' => 100, 'readonly', 'disable' )) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label" for="number">{{ trans('messages.Prop_unit.unit_floor') }}</label>
        <div class="col-sm-8">
            {!! Form::text('unit_floor',($bill_data['property_unit_floor'] != null)?$bill_data['property_unit_floor']:"-",array('class'=>'form-control', 'maxlength' => 100, 'readonly', 'disable' )) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label" for="number">{{trans('messages.Meter.old_meter')}}</label>
        <div class="col-sm-8">
            {!! Form::text('old_unit',floatval($bill_data['old_unit']),array('class'=>'form-control', 'maxlength' => 100, 'readonly', 'disable' )) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label" for="number">{{trans('messages.Meter.last_meter')}}</label>
        <div class="col-sm-8">
            {!! Form::input('number','unit',floatval($bill_data['unit']),array('class'=>'form-control unit-input-form', 'id'=>'unit-input-form', 'maxlength' => 100, 'onclick'=>"focusMobilForm();")) !!}
            {{--{!! Form::text('unit',floatval($bill_data['unit']),array('class'=>'form-control unit-input-form', 'maxlength' => 100, 'autofocus', 'onfocus'=>'this.select();' )) !!}--}}
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="modal-footer">
    {{--<button type="button" class="btn btn-white" data-dismiss="modal">{{ trans('messages.cancel') }}</button>--}}
    @if($bill_data['prev_prop_unit_id'] == "")
        <button type="button" class="btn btn-primary other-edit-unit" disabled="disabled" id="prev-edit-unit" data-unit="{{$bill_data['prev_prop_unit_id']}}">ยูนิตก่อนหน้า</button>
    @else
        <button type="button" class="btn btn-primary other-edit-unit" id="prev-edit-unit" data-unit="{{$bill_data['prev_prop_unit_id']}}">ยูนิตก่อนหน้า</button>
    @endif

    @if($bill_data['next_prop_unit_id'] == "")
        <button type="button" class="btn btn-primary other-edit-unit" disabled="disabled" id="next-edit-unit" data-unit="{{$bill_data['next_prop_unit_id']}}">ยูนิตถัดไป</button>
    @else
        <button type="button" class="btn btn-primary other-edit-unit" id="next-edit-unit" data-unit="{{$bill_data['next_prop_unit_id']}}">ยูนิตถัดไป</button>
    @endif
    <button type="button" class="btn btn-primary save-edit-unit" id="save-edit-unit">{{ trans('messages.ok') }}</button>
</div>
{!! Form::close() !!}
