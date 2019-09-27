@foreach($property_unit_array as $row)
	<div class="story-row invoice-row unit-edit-row" data-unit="{{$row['id']}}" data-id="{{$id}}" style="cursor:pointer;">
		<img src="{{url('/')}}/images/meter-water.png" alt="user-img" class="img-circle s-profile-img">
		<div class="row">
			<div class="col-sm-12">
				<div class="t-name">
					<b class="name">{{ trans('messages.unit_no') }} : {{$row['property_unit_name']}} , {{ trans('messages.Prop_unit.unit_floor') }} : {{ $row['property_unit_floor'] }}</b>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			{{trans('messages.Meter.old_unit')}} :
			{{floatval($row['old_unit'])}}
		</div>
		<div class="col-sm-4">
			{{trans('messages.Meter.last_unit')}} :
			<span id="val_of_{{$row['id']}}">{{floatval($row['unit'])}}</span>
		</div>
		<div class="col-sm-4">
			{{trans('messages.Meter.net_unit')}} :
			<span id="net_val_of_{{$row['id']}}">{{floatval($row['net_unit'])}}</span>
		</div>
	</div>
@endforeach
