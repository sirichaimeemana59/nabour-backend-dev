<?php
$status_leads=unserialize(constant('status_leads'));
$type_property=unserialize(constant('LEADS_TYPE'));
$channel =unserialize(constant('LEADS_SOURCE'));

//dd($channel);
?>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                   <h3 class="panel-title">รายละเอียด Lead</h3>
            </div>
            <div class="panel-body member-list-content">
                <div class="tab-pane active" id="member-list">
                    <div id="member-list-content">
                        {{--content--}}
                        <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">ชื่อ - นามสกุล : {!!$_lead->firstname ."   ". $_lead->lastname!!} </label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="field-1">โทร : @if(!empty($_lead->phone)){!!$_lead->phone!!} @else ไม่พบข้อมูล  @endif</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="field-1">E - mail  :  @if(!empty($_lead->email)){!!$_lead->email!!} @else ไม่พบข้อมูล @endif</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="field-1">พนักงานขาย  :  @if(!empty($_lead->latest_sale->name)){!!$_lead->latest_sale->name!!} @else ไม่พบข้อมูล @endif</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="field-1">แหล่งที่มา  :  @if(!empty($_lead->channel)){!!$channel[$_lead->channel]!!} @else ไม่พบข้อมูล @endif</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="field-1">ประเภท  :  @if(!empty($_lead->type)){!!$type_property[$_lead->type]!!} @else ไม่พบข้อมูล @endif</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="field-1">พนักงานขาย  :  @if(!empty($_lead->sale_id)){!!$_lead->latest_sale->name!!} @else ไม่พบข้อมูล @endif</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="field-1">ชื่อบริษัท  :  @if(!empty($_lead->company_name)){!!$_lead->company_name!!} @else ไม่พบข้อมูล @endif</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="field-1">ที่อยู่  :  @if(!empty($_lead->address)){!!$_lead->address!!} @else ไม่พบข้อมูล @endif</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="field-1">จังหวัด  :  @if(!empty($_lead->province)){!!$provinces[$_lead->province]!!} @else ไม่พบข้อมูล @endif</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="field-1">รหัสไปรษณีย์  :   @if(!empty($_lead->postcode)){!!$_lead->postcode!!} @else ไม่พบข้อมูล @endif</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="field-1">สถานะ  :  @if(!empty($_lead->company_name)){!!$status_leads[$_lead->status_leads]!!} @else ไม่พบข้อมูล @endif</label>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-6 control-label" for="field-1">หมายเหตุ  :  @if(!empty($_lead->note)){!!$_lead->note!!} @else ไม่พบข้อมูล @endif</label>
                        </div>
                        {{--endcontent--}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
