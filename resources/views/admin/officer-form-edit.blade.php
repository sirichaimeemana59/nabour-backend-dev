{!! Form::model($officer,array('url'=>'#','method'=>'post','class'=>'form-horizontal')) !!}
<div class="modal-body">
    <div class="form-group @if($errors->has('name')) validate-has-error @endif">
        <label class="col-sm-4 control-label">{!!  __('messages.name') !!}</label>
        <div class="col-sm-8">
            {!! Form::text('name',null,array('class' => 'form-control')) !!}
            <?php echo $errors->first('name','<span class="validate-has-error">:message</span>'); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">{!!  __('messages.Prop_unit.emergency_cal') !!}</label>
        <div class="col-sm-8">
            {!! Form::text('phone',null,array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label">{!!  __('messages.AdminUser.username') !!}</label>
        <div class="col-sm-8" style="padding-top:7px;">
            {!! $officer->email !!}
        </div>
    </div>
    <div class="form-group @if($errors->has('password')) validate-has-error @endif">
        <label class="col-sm-4 control-label">Password</label>
        <div class="col-sm-8">
            {!! Form::password('password',array('class' => 'form-control')) !!}
            <?php echo $errors->first('password','<span class="validate-has-error">:message</span>'); ?>
        </div>
    </div>
    <div class="form-group @if($errors->has('password_confirm')) validate-has-error @endif">
        <label class="col-sm-4 control-label">Confirm Password</label>
        <div class="col-sm-8">
            {!! Form::password('password_confirm',array('class' => 'form-control')) !!}
            <?php echo $errors->first('password_confirm','<span class="validate-has-error">:message</span>'); ?>
        </div>
    </div>
</div>
{!! Form::hidden('id') !!}
{!! Form::close() !!}
