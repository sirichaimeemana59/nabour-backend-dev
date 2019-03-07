<div class="panel-heading">
    <h3 class="panel-title">ข้อมูลขอเปิดหน้าบัญชี</h3>
</div>
<div class="panel-body">
    <div class="form-group">

        <label class="col-sm-2 control-label">ชื่อบริษัท</label>
        <div class="col-sm-4">
            <input class="form-control" name="company_name" type="text" required value="{!! $customer->company_name !!}">
        </div>

        <label class="col-sm-2 control-label">Company Name</label>
        <div class="col-sm-4">
            <input class="form-control" name="company_name_en" type="text" required>
            <input type="hidden" name="customer_id" value="{!! $customer->id !!}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">เลขประจำตัวผู้เสียภาษีอากร</label>
        <div class="col-sm-4">
            <input class="form-control" name="tax_id" type="text" required>
        </div>

        <label class="col-sm-2 control-label">วันที่จดทะเบียน</label>
        <div class="col-sm-4">
            <input class="form-control datepicker" data-language="th" required data-format="yyyy-mm-dd" name="date_register" type="text" value=""  autocomplete="off"  >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">ทุนจดทะเบียน</label>
        <div class="col-sm-4">
            <input class="form-control" name="registered_capital" type="text" required>
        </div>

        <label class="col-sm-2 control-label">ลักษณะธุรกิจ</label>
        <div class="col-sm-4">
            <input class="form-control" name="type_company" type="text" required>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">เลขที่/อาคาร</label>
        <div class="col-sm-4">
            <input class="form-control" name="address_no" type="text" required>
        </div>

        <label class="col-sm-2 control-label">ถนน</label>
        <div class="col-sm-4">
            <input class="form-control" name="street_th" type="text" required>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">ตำบล/เขต/อำเภอ </label>
        <div class="col-sm-4">
            <input class="form-control" name="address_th" type="text" required>
        </div>

        <label class="col-sm-2 control-label">จังหวัด</label>
        <div class="col-sm-4">
            {!! Form::select('province_company', $_provinces,null,['id'=>'province_cm','class'=>'form-control']) !!}
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">รหัสไปรษณีย์</label>
        <div class="col-sm-4">
            <input class="form-control" name="postcode_company" type="text" required>
        </div>

        <label class="col-sm-2 control-label">โทรศัพท์ บริษัท</label>
        <div class="col-sm-4">
            <input class="form-control" name="tel_company" type="text" required>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">โทรสาร</label>
        <div class="col-sm-4">
            <input class="form-control" name="fax_company" type="text" required>
        </div>

        <label class="col-sm-2 control-label">มือถือ</label>
        <div class="col-sm-4">
            <input class="form-control" name="phone_company" type="text" required>
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">E-mail บริษัท</label>
        <div class="col-sm-4">
            <input class="form-control" name="mail_company" type="text" required>
        </div>
    </div>

    <div class="form-group ">
        <label class="col-sm-2 control-label">กรรมการของบริษัท</label>
        <div class="col-sm-6">
            <table class="table table-striped table-condensed" id="itemsTable">

            </table>
        </div>

    </div>

    <div class="form-group">
        <div class="col-sm-4" style="margin-left: 15%">
            <button type="button" class="btn btn-info btn-primary add_directer"><i class="fa fa-plus"> </i> เพิ่มกรรมการบริษัท</button>
        </div>
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-4">
        </div>
    </div>