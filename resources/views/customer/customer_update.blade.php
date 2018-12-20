@if(Auth::user()->role !=2)
    {!! Form::model($customer,array('url' => array('customer/Customer_form/update'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
@else
    {!! Form::model($customer,array('url' => array('customer/sales/Customer_form/update'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
@endif
<div class="form-group">
    <input type="hidden" name="customer_id" value="{!!$customer->id!!}">
    <label class="col-sm-1 control-label">ชื่อ</label>
    <div class="col-sm-2">
        <input class="form-control" name="firstname" id="firstname" type="text" required value="{!!$customer->firstname!!}">
    </div>

    <label class="col-sm-1 control-label">นามสกุล</label>
    <div class="col-sm-2">
        <input class="form-control" name="lastname" type="text" required value="{!!$customer->lastname!!}">
    </div>

    <label class="col-sm-1 control-label">เบอร์โทร</label>
    <div class="col-sm-2">
        <input class="form-control" name="phone" type="text" required value="{!!$customer->phone!!}">
    </div>

    <label class="col-sm-1 control-label">E-Mail</label>
    <div class="col-sm-2">
        <input class="form-control" name="email" type="text" required value="{!!$customer->email!!}">
    </div>
</div>

<div class="form-group">

    <label class="col-sm-1 control-label">แหล่งที่มา</label>
    <div class="col-sm-2">
        {!! Form::select('channel',unserialize(constant('LEADS_SOURCE')),null,array('class'=>'form-control','required')) !!}
    </div>

    <label class="col-sm-1 control-label">ประเภท</label>
    <div class="col-sm-2">
        {!! Form::select('type',unserialize(constant('LEADS_TYPE')),null,array('class'=>'form-control','required')) !!}
    </div>

    <label class="col-sm-1 control-label">พนักงานขาย</label>
    <div class="col-sm-2">
        @if(Auth::user()->role !=2)
            <select name="sale_id" id="" class="form-control" required>
                <option value="">กรุณาเลือกพนักงานขาย</option>
                @foreach($sale as $srow)
                    <option value="{!!$srow->id!!}">{!!$srow->name!!}</option>
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

    <label class="col-sm-1 control-label">ชื่อบริษัท</label>
    <div class="col-sm-2">
        <input class="form-control" name="company_name" type="text" required value="{!! $customer->company_name !!}">
    </div>
</div>

<div class="form-group">
    <label class="col-sm-1 control-label">ที่อยู่</label>
    <div class="col-sm-2">
        <input class="form-control" name="address" type="text" required value="{!!$customer->address !!}">
    </div>

    <label class="col-sm-1 control-label">จังหวัด</label>
    <div class="col-sm-2">
        <select name="province" id="" class="form-control">
            <option value="">กรุณาเลือกจังหวัด</option>
            @foreach($provinces as $row)
                <?php
                $province=$customer->province==$row->code?"selected":"";
                ?>
                <option value="{!!$row->code !!}" {!!$province !!}>{!!$row->name_th !!}</option>
            @endforeach
        </select>
    </div>

    <label class="col-sm-1 control-label">รหัสไปรษณีย์</label>
    <div class="col-sm-2">
        <input class="form-control" name="postcode" type="text" required value="{!!$customer->postcode !!}">
    </div>
    <input type="hidden" name="company_id" value="{!! $customer->company_id !!}">
    <input type="hidden" name="role" value="{!! $customer->role !!}">
</div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">{!!trans('messages.cancel')!!}</button>
    <button type="submit" class="btn btn-primary change-active-status-btn">{!!trans('messages.confirm')!!}</button>
</div>
{!!Form::close(); !!}