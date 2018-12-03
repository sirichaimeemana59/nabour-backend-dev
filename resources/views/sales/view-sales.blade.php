<div class="user-data-block">
	@if($member->profile_pic_name)
	<img src="{!! env('URL_S3')."/profile-img/".$member->profile_pic_path.$member->profile_pic_name !!}" class="img-circle" alt="user-pic" />
	@else
	<img src="{!!url('/')!!}/images/user-1.png" alt="user-pic" class="img-circle" />
	@endif
    <div class="user-detail">
		<div class="row">
    		<div class="col-md-4"><div class="form-group"><b>{!! trans('messages.name') !!} :</b></div></div>
    		<div class="col-md-8"><div class="form-group">{!! $member->name !!}</div></div>
		</div>
		<div class="row">
    		<div class="col-md-4"><div class="form-group"><b>{!! trans('messages.email') !!} :</b></div></div>
    		<div class="col-md-8"><div class="form-group">{!! $member->email !!}</div></div>
		</div>
		<div class="row">
    		<div class="col-md-4"><div class="form-group"><b>{!! trans('messages.dob') !!} :</b></div></div>
    		<div class="col-md-8"><div class="form-group"><?php echo ($member->dob == null)?"-":date("j F Y",strtotime($member->dob)); ?></div></div>
		</div>
		<div class="row">
    		<div class="col-md-4"><div class="form-group"><b>{!! trans('messages.tel') !!} :</b></div></div>
    		<div class="col-md-8"><div class="form-group"><?php echo ($member->phone == null)?"-":$member->phone; ?></div></div>
		</div>
		<div class="row">
    		<div class="col-md-4"><div class="form-group"><b>{!! trans('messages.regis_date') !!} :</b></div></div>
    		<div class="col-md-8"><div class="form-group"><?php echo date("j F Y",strtotime($member->created_at)); ?></div></div>
		</div>
	</div>
	<div style="clear:both"></div>
</div>
