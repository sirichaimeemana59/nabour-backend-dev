<div class="panel-heading">
    <h3 class="panel-title">แก้ไขข้อมูลขอเปิดหน้าบัญชี</h3>
</div>
<div class="panel-body">
    <div class="form-group">

        <label class="col-sm-2 control-label">ชื่อบริษัท</label>
        <div class="col-sm-4">
            <input class="form-control" name="company_name" type="text" required value="{!! $customer->company_name !!}">
            <input class="form-control" name="sale_id" type="hidden" required value="{!! $customer->sale_id !!}">
        </div>

        <label class="col-sm-2 control-label">Company Name</label>
        <div class="col-sm-4">
            <input class="form-control" name="company_name_en" type="text" required value="{!! $customer->user_company['company_name_en'] !!}">
            <input type="hidden" name="customer_id" value="{!! $customer->id !!}">
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">เลขประจำตัวผู้เสียภาษีอากร</label>
        <div class="col-sm-4">
            <input class="form-control" name="tax_id" type="text" required value="{!! $customer->user_company['tax_id'] !!}">
        </div>

        <label class="col-sm-2 control-label">วันที่จดทะเบียน</label>
        <div class="col-sm-4">
            <input class="form-control datepicker" data-language="th" required data-format="yyyy-mm-dd" name="date_register" type="text" value="{!! $customer->user_company['date_register'] !!}"  autocomplete="off"  >
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">ทุนจดทะเบียน</label>
        <div class="col-sm-4">
            <input class="form-control" name="registered_capital" type="text" required value="{!! $customer->user_company['registered_capital'] !!}">
        </div>

        <label class="col-sm-2 control-label">ลักษณะธุรกิจ</label>
        <div class="col-sm-4">
            <input class="form-control" name="type_company" type="text" required value="{!! $customer->user_company['type_company'] !!}">
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">เลขที่/อาคาร</label>
        <div class="col-sm-4">
            <input class="form-control" name="address_no" type="text" required value="{!! $customer->user_company['address_no'] !!}">
        </div>

        <label class="col-sm-2 control-label">ถนน</label>
        <div class="col-sm-4">
            <input class="form-control" name="street_th" type="text" required value="{!! $customer->user_company['street_th'] !!}">
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">ตำบล/เขต/อำเภอ </label>
        <div class="col-sm-4">
            <input class="form-control" name="address_th" type="text" required value="{!! $customer->user_company['address_th'] !!}">
        </div>

        <label class="col-sm-2 control-label">จังหวัด</label>
        <div class="col-sm-4">
            {!! Form::select('province_company', $_provinces,$customer->user_company['province_company'],['id'=>'province_cm','class'=>'form-control']) !!}
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">รหัสไปรษณีย์</label>
        <div class="col-sm-4">
            <input class="form-control" name="postcode_company" type="text" required value="{!! $customer->user_company['postcode_company'] !!}">
        </div>

        <label class="col-sm-2 control-label">โทรศัพท์ บริษัท</label>
        <div class="col-sm-4">
            <input class="form-control" name="tel_company" type="text" required value="{!! $customer->user_company['tel_company'] !!}">
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">โทรสาร</label>
        <div class="col-sm-4">
            <input class="form-control" name="fax_company" type="text" required value="{!! $customer->user_company['fax_company'] !!}">
        </div>

        <label class="col-sm-2 control-label">มือถือ</label>
        <div class="col-sm-4">
            <input class="form-control" name="phone_company" type="text" required value="{!! $customer->user_company['phone_company'] !!}">
        </div>
    </div>


    <div class="form-group">
        <label class="col-sm-2 control-label">E-mail บริษัท</label>
        <div class="col-sm-4">
            <input class="form-control" name="mail_company" type="text" required value="{!! $customer->user_company['mail_company'] !!}">
        </div>
    </div>

    <div class="form-group ">
        <label class="col-sm-2 control-label">กรรมการของบริษัท</label>
        <div class="col-sm-6">
            <?php
            $cut_directer = explode(',',$customer->user_company['directer_company']);
            $count = count($cut_directer);
            //dd($customer->user_company->directer_company);
            ?>
                <table class="table table-striped table-condensed" id="itemsTable">
            @for($i=0;$i<$count;$i++)

                    <tr class="item-row">
                        <td>
                        {!! Form::text('directer_company[]', $cut_directer[$i],['class' => 'toValidate form-control input-sm tDesc']) !!}
                        <td>
                        <td>
                            <a class="btn btn-danger unit-card-delete-button">
                                <i class="fa-trash"></i>
                            </a>
                        </td>
                    </tr>
            @endfor
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

