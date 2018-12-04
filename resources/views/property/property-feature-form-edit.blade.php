{!! Form::model($feature,array('url'=>'#','method'=>'post','id'=>'form-officer','class'=>'form-horizontal')) !!}
<div class="row" style="margin:5px 0;">
    <div class="col-sm-12" style="padding:0 20px;">ชื่อโครงการ : {!! $property->juristic_person_name_th !!}
    </div>
</div>
<hr style="margin:0;"/>
<div class="modal-body" style="padding-top:0px;">
    <input name="property_id" type="hidden" value="{!! $property->id !!}">
    @if(isset($feature))
    <div class="row">
        <div class="col-sm-12">
            <h2>เมนูการเงิน</h2>
            <hr/>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">ระบบค่าน้ำประปา -  ค่าไฟฟ้า</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_utility" value="1" @if($feature->menu_utility) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">การเก็บเงินค่าส่วนกลาง</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_common_fee" value="1" @if($feature->menu_common_fee) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">เงินสดในมือ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_cash_on_hand" value="1" @if($feature->menu_cash_on_hand) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">บันทึกเงินสดย่อย</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_pettycash" value="1" @if($feature->menu_pettycash) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
        
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">บันทึกรายรับ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_retroactive_receipt" value="1" @if($feature->menu_retroactive_receipt) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">บันทึกรับเงินล่วงหน้า</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_prepaid" value="1" @if($feature->menu_prepaid) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">บันทึกราบรับยกมา</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_revenue_record" value="1" @if($feature->menu_revenue_record) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">เงินกองทุน</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_fund" value="1" @if($feature->menu_fund) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-4 control-label">เอกสารงบกระแสเงินสด</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_statement_of_cash" value="1" @if($feature->menu_statement_of_cash) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>

        <label class="col-sm-4 control-label">รวบใบแจ้งหนี้เพื่ออกใบเสร็จ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="aggregate_invoice" value="1" @if($feature->aggregate_invoice) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>

        <div class="row">
            <label class="col-sm-4 control-label">ใช้ pre-print ใบแจ้งหนี้</label>
            <div class="col-sm-2" style="padding-top:7px;">
                <label class="switch round">
                    <input type="checkbox" name="preprint_invoice" value="1" @if($feature->preprint_invoice) checked @endif/>
                    <div class="slider_ round"></div>
                </label>
            </div>

            <label class="col-sm-2 control-label">ไฟล์ CSS</label>
            <div class="col-sm-4">
                <input type="text" name="preprint_invoice_view_prefix" value="{!! $feature->preprint_invoice_view_prefix !!}" class="form-control invoice-css"/>
            </div>
        </div>

        <div class="row">
            <label class="col-sm-4 control-label">ใช้ pre-print ใบเสร็จ</label>
            <div class="col-sm-2" style="padding-top:7px;">
                <label class="switch round">
                    <input type="checkbox" name="preprint_receipt" value="1" @if($feature->preprint_receipt) checked @endif/>
                    <div class="slider_ round"></div>
                </label>
            </div>

            <label class="col-sm-2 control-label">ไฟล์ CSS</label>
            <div class="col-sm-4">
                <input type="text" name="preprint_receipt_view_prefix" value="{!! $feature->preprint_receipt_view_prefix !!}"  class="form-control receipt-css"/>
            </div>
        </div>

    <div class="row">
        <div class="col-sm-12">
            <h2>เมนูทั่วไป</h2>
            <hr/>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">ระบบแจ้งซ่อม/แจ้งปัญหา</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_complain" value="1" @if($feature->menu_complain) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">กิจกรรม</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_event" value="1" @if($feature->menu_event) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">แบบสำรวจ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_vote" value="1" @if($feature->menu_vote) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">ผู้เช่า</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_tenant" value="1" @if($feature->menu_tenant) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">ยานพาหนะ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_vehicle" value="1" @if($feature->menu_vehicle) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">จดหมายและพัสดุ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_parcel" value="1" @if($feature->menu_parcel) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">กล่องข้อความ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_message" value="1" @if($feature->menu_message) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">ห้องประชุมคณะกรรมการ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_committee_room" value="1" @if($feature->menu_committee_room) checked @endif/>
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2>Market Place</h2>
            <hr/>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">Singha Online Shop</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="market_place_singha" value="1" @if($feature->market_place_singha) checked @endif />
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-sm-12">
            <h2>เมนูการเงิน</h2>
            <hr/>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">ระบบค่าน้ำประปา -  ค่าไฟฟ้า</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_utility" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">การเก็บเงินค่าส่วนกลาง</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_common_fee" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">เงินสดในมือ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_cash_on_hand" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">บันทึกเงินสดย่อย</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_pettycash" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">บันทึกรายรับ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_retroactive_receipt" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">บันทึกรับเงินล่วงหน้า</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_prepaid" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">บันทึกราบรับยกมา</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_revenue_record" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">เงินกองทุน</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_fund" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-4 control-label">เอกสารงบกระแสเงินสด</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_statement_of_cash" value="1" />
                <div class="slider_ round"></div>
            </label>
        </div>

        <label class="col-sm-4 control-label">รวบใบแจ้งหนี้เพื่ออกใบเสร็จ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="aggregate_invoice" value="1"/>
                <div class="slider_ round"></div>
            </label>
            </div>
    </div>

    <div class="row">
        <label class="col-sm-4 control-label">ใช้ pre-print ใบแจ้งหนี้</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="preprint_invoice" value="1" />
                <div class="slider_ round"></div>
            </label>
        </div>

        <label class="col-sm-2 control-label">ไฟล์ CSS</label>
        <div class="col-sm-4" style="padding-top:7px;">
            <input type="text" name="preprint_invoice_view_prefix" class="form-control invoice-css"/>
        </div>
    </div>

    <div class="row">
        <label class="col-sm-4 control-label">ใช้ pre-print ใบเสร็จ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="preprint_receipt" value="1"/>
                <div class="slider_ round"></div>
            </label>
        </div>

        <label class="col-sm-2 control-label">ไฟล์ CSS</label>
        <div class="col-sm-4" style="padding-top:7px;">
            <input type="text" name="preprint_receipt_view_prefix" class="form-control receipt-css"/>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <h2>เมนูทั่วไป</h2>
            <hr/>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">ระบบแจ้งซ่อม/แจ้งปัญหา</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_complain" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">กิจกรรม</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_event" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">แบบสำรวจ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_vote" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">ผู้เช่า</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_tenant" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">ยานพาหนะ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_vehicle" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">จดหมายและพัสดุ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_parcel" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">กล่องข้อความ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_message" value="1"  checked />
                <div class="slider_ round"></div>
            </label>
        </div>
        <label class="col-sm-4 control-label">ห้องประชุมคณะกรรมการ</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="menu_committee_room" value="1" checked />
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <h2>Market Place</h2>
            <hr/>
        </div>
    </div>
    <div class="row">
        <label class="col-sm-4 control-label">Singha Online Shop</label>
        <div class="col-sm-2" style="padding-top:7px;">
            <label class="switch round">
                <input type="checkbox" name="market_place_singha" value="1" />
                <div class="slider_ round"></div>
            </label>
        </div>
    </div>
    @endif
</div>
{!! Form::hidden('id') !!}
{!! Form::close() !!}
