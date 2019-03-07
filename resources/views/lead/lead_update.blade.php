{{--{!! Form::model(null,array('url' => array('root/admin/Lead_form/update'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}--}}
@if(Auth::user()->role !=2)
    {!! Form::model($_lead,array('url' => array('customer/Lead_form/update'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
@else
    {!! Form::model($_lead,array('url' => array('customer/sales/Lead_form/update'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
@endif
<div class="form-group">
    <input type="hidden" name="lead_id" value="{!!$_lead->id!!}">
        <label class="col-sm-2 control-label">ชื่อ</label>
        <div class="col-sm-4">
            <input class="form-control" name="firstname" id="firstname" type="text" required value="{!!$_lead->firstname!!}">
        </div>

        <label class="col-sm-2 control-label">นามสกุล</label>
        <div class="col-sm-4">
            <input class="form-control" name="lastname" type="text" required value="{!!$_lead->lastname!!}">
        </div>
    </div>

<div class="form-group">
    <label class="col-sm-2 control-label">เบอร์โทร</label>
    <div class="col-sm-4">
        <input class="form-control" name="phone" type="text" required value="{!!$_lead->phone!!}">
    </div>

    <label class="col-sm-2 control-label">E-Mail</label>
    <div class="col-sm-4">
        <input class="form-control" name="email" type="text" required value="{!!$_lead->email!!}">
    </div>
</div>

    <div class="form-group">

        <label class="col-sm-2 control-label">แหล่งที่มา</label>
        <div class="col-sm-4">
            {!! Form::select('channel',unserialize(constant('LEADS_SOURCE')),null,array('class'=>'form-control','required')) !!}
        </div>
        <label class="col-sm-2 control-label">ประเภท</label>
        <div class="col-sm-4">
            {!! Form::select('type',unserialize(constant('LEADS_TYPE')),null,array('class'=>'form-control','required')) !!}
        </div>
    </div>

<div class="form-group">
    <label class="col-sm-2 control-label">พนักงานขาย</label>
    <div class="col-sm-4">
        @if(Auth::user()->role !=2)
            <select name="sale_id" id="" class="form-control" required>
                <option value="">กรุณาเลือกพนักงานขาย</option>
                @foreach($sale as $srow)
                    <?php
                    $_select=$srow->id==$_lead->sale_id?"selected":"";
                    ?>
                    <option value="{!!$srow->id!!}" {!! $_select !!}>{!!$srow->name!!}</option>
                @endforeach
            </select>
        @else
            <select name="sale_id" id="" class="form-control"  disabled="true">
                <option value="">กรุณาเลือกพนักงานขาย</option>
                @foreach($sale as $_srow)
                    <?php
                    $select=$_srow->id==Auth::user()->id?"selected":"";
                    ?>
                    <option value="{!!$_srow->id!!}" {!! $select !!}>{!!$_srow->name!!}</option>
                @endforeach
            </select>
        @endif
    </div>

    <label class="col-sm-2 control-label">ชื่อบริษัท</label>
    <div class="col-sm-4">
        <input class="form-control" name="company_name" type="text" required value="{!! $_lead->company_name !!}">
    </div>
</div>

    <div class="form-group">
        <label class="col-sm-2 control-label">ที่อยู่</label>
        <div class="col-sm-4">
            <input class="form-control" name="address" type="text" required value="{!!$_lead->address !!}">
        </div>

        <label class="col-sm-2 control-label">จังหวัด</label>
        <div class="col-sm-4">
            <select name="province" id="" class="form-control">
                <option value="">กรุณาเลือกจังหวัด</option>
                @foreach($provinces as $row)
                    <?php
                    $province=$_lead->province==$row->code?"selected":"";
                    ?>
                    <option value="{!!$row->code !!}" {!!$province !!}>{!!$row->name_th !!}</option>
                @endforeach
            </select>
        </div>
    </div>

<div class="form-group">
    <label class="col-sm-2 control-label">รหัสไปรษณีย์</label>
    <div class="col-sm-4">
        <input class="form-control" name="postcode" type="text" required value="{!!$_lead->postcode !!}">
    </div>
    <label class="col-sm-2 control-label">สถานะ</label>
    <div class="col-sm-4">
        {!! Form::select('status_leads',unserialize(constant('status_leads')),$_lead->status_leads,array('class'=>'form-control','required')) !!}
    </div>
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">{!!trans('messages.cancel')!!}</button>
    <button type="submit" class="btn btn-primary change-active-status-btn">{!!trans('messages.confirm')!!}</button>
</div>
{!!Form::close(); !!}