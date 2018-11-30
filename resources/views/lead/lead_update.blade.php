{{--{!! Form::model(null,array('url' => array('root/admin/Lead_form/update'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}--}}
{!! Form::model($_lead,array('url' => array('customer/Lead_form/update'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
<div class="form-group">
    <input type="hidden" name="lead_id" value="{!!$_lead->id!!}">
        <label class="col-sm-1 control-label">ชื่อ</label>
        <div class="col-sm-2">
            <input class="form-control" name="firstname" id="firstname" type="text" required value="{!!$_lead->firstname!!}">
        </div>

        <label class="col-sm-1 control-label">นามสกุล</label>
        <div class="col-sm-2">
            <input class="form-control" name="lastname" type="text" required value="{!!$_lead->lastname!!}">
        </div>

        <label class="col-sm-1 control-label">เบอร์โทร</label>
        <div class="col-sm-2">
            <input class="form-control" name="phone" type="text" required value="{!!$_lead->phone!!}">
        </div>

        <label class="col-sm-1 control-label">E-Mail</label>
        <div class="col-sm-2">
            <input class="form-control" name="email" type="text" required value="{!!$_lead->email!!}">
        </div>
    </div>

    <div class="form-group">

        <label class="col-sm-1 control-label">แหล่งที่มา</label>
        <div class="col-sm-2">
            <input class="form-control" name="channel" type="text" required value="{!!$_lead->channel!!}">
        </div>
        <label class="col-sm-1 control-label">ประเภท</label>
        <div class="col-sm-2">
            <input class="form-control" name="type" type="text" required value="{!!$_lead->type!!}">
        </div>

        <label class="col-sm-1 control-label">พนักงานขาย</label>
        <div class="col-sm-2">
            <select name="sale_id" id="" class="form-control">
                <option value="">กรุณาเลือกพนักงานขาย</option>
                @foreach($sale as $srow)
                    <?php
                            $sale=$_lead->sale_id==$srow->id?"selected":"";
                    ?>
                    <option value="{!!$srow->id!!}" {!!$sale!!}>{!!$srow->name!!}</option>
                @endforeach
            </select>
        </div>

        <label class="col-sm-1 control-label">ที่อยู่</label>
        <div class="col-sm-2">
            <input class="form-control" name="address" type="text" required value="{!!$_lead->address !!}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-1 control-label">จังหวัด</label>
        <div class="col-sm-2">
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

        <label class="col-sm-1 control-label">รหัสไปรษณีย์</label>
        <div class="col-sm-2">
            <input class="form-control" name="postcode" type="text" required value="{!!$_lead->postcode !!}">
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-white" data-dismiss="modal">{!!trans('messages.cancel')!!}</button>
    <button type="submit" class="btn btn-primary change-active-status-btn">{!!trans('messages.confirm')!!}</button>
</div>
{!!Form::close(); !!}