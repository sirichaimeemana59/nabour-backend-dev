@extends('base-admin')
@section('content')
    <?php
    /* $lang = App::getLocale();
     $property_type = unserialize(constant('PROPERTY_TYPE_'.strtoupper($lang)));*/
    //dd($quotation);
    ?>
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">เอกสารสัญญา</h1>
        </div>
        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>{{ trans('messages.page_home') }}</a>
                </li>
                <li>Service</li>
                <li class="active">
                    <strong>เอกสารสัญญา</strong>
                </li>
            </ol>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    @if($quotation1->latest_sale->role==1)
                        <h3 class="panel-title">รายละเอียด Lead</h3>
                    @else
                        <h3 class="panel-title">รายละเอียด Customer</h3>
                    @endif
                </div>
                <div class="panel-body member-list-content">
                    <div class="tab-pane active" id="member-list">
                        <div id="member-list-content">
                            {{--content--}}
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">ชื่อ - นามสกุล : {!!$quotation1->latest_lead->firstname ."   ". $quotation1->latest_lead->lastname!!} </label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">โทร :  {!!$quotation1->latest_lead->phone!!}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">E - mail  :  {!!$quotation1->latest_lead->email!!}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">พนักงานขาย  :  {!!$quotation1->latest_sale->name!!}</label>
                            </div>
                            <div class="form-group">
                                <?php
                                $price=$quotation1->grand_total_price==0?$quotation1->grand_total_price:$quotation1->product_price_with_vat;
                                ?>
                                <label class="col-sm-6 control-label" for="field-1">ราคาสุทธิ :  {!!number_format($price,2)!!}</label>
                            </div>
                            {{--endcontent--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <h3 class="panel-title">รายละเอียดบริการ</h3>
                </div>
                <div class="panel-body member-list-content">
                    <div class="tab-pane active" id="member-list">
                        <div id="member-list-content">
                            {{--content--}}
                            <div class="form-group">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <th style="text-align: center;">บริการ</th>
                                        <th style="text-align: center;">โครงการ</th>
                                        <th style="text-align: center;">จำนวนหน่วย</th>
                                        <th style="text-align: center;">ราคา</th>
                                        <th style="text-align: center;">รวม</th>
                                    </tr>
                                    <?php
                                    $_total=0;
                                    ?>
                                    @foreach($quotation_service as $row)
                                        <tr>
                                            <td>{!! $row->lastest_package->name !!}</td>
                                            <td style="text-align: right;">{!! number_format($row->project_package,0)!!}</td>
                                            <td style="text-align: right;">{!! number_format($row->month_package,0)!!}</td>
                                            <td style="text-align: right;">{!! number_format($row->unit_package,2)!!}</td>
                                            <td style="text-align: right;">{!! number_format($row->total_package,2)!!}</td>
                                        </tr>
                                        <?php
                                        $_total += $row->total_package;
                                        ?>
                                    @endforeach
                                    <tr>
                                        <td colspan="4" style="font-weight: bold;">รวม</td>
                                        <td style="text-align: right;">{!! number_format($_total,2) !!}  บาท</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="font-weight: bold;">ส่วนลด</td>
                                        <td class="border;" style="text-align: right;">{!! number_format($quotation->discount,2) !!}  บาท</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="font-weight: bold;">Vat</td>
                                        <td style="text-align: right;">{!! number_format($quotation->product_vat,2)!!}  บาท</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" style="font-weight: bold;">รวมสุทธิ</td>
                                        <td style="text-align: right;">{!! number_format($quotation->product_price_with_vat,2)!!}  บาท</td>
                                    </tr>
                                </table>
                            </div>
                            {{--endcontent--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if($contract->status != 1 AND $count <1)
        <a href="#" ><button type="button" class="btn btn-success action-float-right" data-toggle="modal" data-target="#approved" onclick="mate_approved('{!!$contract->id!!}','{!!$contract->latest_quotation->id !!}','{!! $contract->customer_id  !!}')"><i class="fa fa-check"> </i>  อนุมัติสัญญา</button></a>
    @endif

    @if(Auth::user()->role ==2)
        <a class="btn btn-info btn-primary action-float-right" href="{!! url('service/sales/contract/sign/quotation/'.$contract->id.'/'.$contract->latest_quotation->id) !!}" target="_blank"><i class="fa fa-print"> </i> พิมพ์เอกสารสัญญา</a>
    @else
        <a class="btn btn-info btn-primary action-float-right" href="{!! url('service/contract/sign/quotation/'.$contract->id.'/'.$contract->latest_quotation->id) !!}" target="_blank"><i class="fa fa-print"> </i> พิมพ์เอกสารสัญญา</a>
    @endif

        <?php
                if($contract->status == 1){
                    $read='readonly';
                    $disabled='disabled';
                }else{
                    $read='';
                    $disabled='';
                }

        ?>

    {{--content--}}
    @if(Auth::user()->role !=2)
            {!! Form::model($contract,array('url' => array('service/contract/sign/update'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
        @else
            {!! Form::model($contract,array('url' => array('service/sales/contract/sign/update'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">แก้ไขข้อมูลสัญญา</h3>
                    <div class="panel-options">
                        <a href="#" data-toggle="panel">
                            <span class="collapse-icon">&ndash;</span>
                            <span class="expand-icon">+</span>
                        </a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="col-sm-2 control-label">เลขที่สัญญา</label>
                        <div class="col-sm-10">
                            @foreach($contract_property as $id_row)
                                <input type="hidden" name="id[]" value="{!! $id_row->id !!}">
                            @endforeach
                            <input class="form-control" name="contract_code" type="text" readonly value="{!! $contract->contract_code !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">เลขที่ใบเสนอราคา</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="quotation_id" type="text" readonly value="{!! $contract->latest_quotation->quotation_code !!}">
                            <input class="form-control" name="quotation_id1" type="hidden" readonly value="{!! $contract->quotation_id !!}">
                            <input class="form-control" name="contract_id" type="hidden" readonly value="{!! $contract->id !!}">
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label">นิติบุคคล</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<select name="property_id" id="property_id" class="form-control" {!! $disabled !!} required>--}}
                                {{--<option value="">กรุณาเลือกนิติบุคคล</option>--}}
                                {{--@foreach($property as $prow)--}}
                                    <?php
                                        //$selected=$contract->property_id==$prow->id?"selected":"";
                                    ?>
                                    {{--<option value="{!! $prow['id'] !!}" {!! $selected !!}>{!! $prow['property_name_th']." ".$prow['property_name_en'] !!}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label">ประเภทสัญญา</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--{!! Form::select('contract_type',unserialize(constant('CONTRACT_TYPE')),null,array('class'=>'form-control','required','value'=>'1',$disabled)) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">รูปแบบการชำระเงิน</label>
                        <div class="col-sm-10">
                            {!! Form::select('payment_term_type',unserialize(constant('PAYMENT_TERM_TYPE')),null,array('class'=>'form-control','required',$disabled)) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">รูปแบบการคิดค่าบริการ</label>
                        <div class="col-sm-10">
                            {!! Form::select('type_service',unserialize(constant('type_service')),null,array('class'=>'form-control','required',$disabled)) !!}
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label">วันที่ทำสัญญา</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input class="form-control datepicker" data-language="th" data-format="yyyy-mm-dd" name="start_date" type="text" required value="{!! $contract->start_date !!}" {!! $disabled !!} autocomplete="off"  >--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label">วันที่สิ้นสุดสัญญา</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input class="form-control datepicker" data-language="th" {!! $disabled !!} required data-format="yyyy-mm-dd" name="end_date" type="text" value="{!! $contract->end_date !!}"  autocomplete="off"  >--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">ผู้ทำสัญญา</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="person_name" {!! $read !!} type="text"  value="{!! $contract->person_name !!}" >
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label">ชื่อนิติบุคคล</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input class="form-control" name="property_name"  type="text"  value="@if($contract->property_name){!! $contract->property_name !!}@else - @endif" >--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group ">
                        <label class="col-sm-2 control-label">นิติบุคคล</label>
                        <div class="col-sm-9">
                            <table class="table table-striped table-condensed" id="itemsTable">
                                <tr>
                                    <th>นิติบุคคล</th>
                                    <th></th>
                                    <th>ชื่อบริษัท</th>
                                    <th>วันที่ทำสัญญา</th>
                                    <th>วันที่สิ้นสุดสัญญา</th>
                                    <th>ลบ</th>
                                </tr>

                                    @foreach($contract_property as $row)
                                        <tr class="item-row">
                                            <td style="text-align: left; width:500px;">
                                                <select name="property_id[]" id="property_id" class="form-control" {!! $disabled !!} required style="text-align: left;width: 500px;" OnChange="result_Name(this);">
                                                    <option value="">กรุณาเลือกนิติบุคคล</option>
                                                        @foreach($property as $prow)
                                                            <?php
                                                                $selected=$row->property_id==$prow->id?"selected":"";
                                                            ?>
                                                            <option value="{!! $prow['id'] !!}|{!! $prow['property_name_th'] !!}" {!! $selected !!} >{!! $prow['property_name_th']." ".$prow['property_name_en'] !!}</option>
                                                        @endforeach
                                                </select>
                                            <td>
                                            <td><input type="text" name="property_name[]" value="{!! $row->property_name !!}" class="toValidate form-control input-sm tName" required/></td>
                                            <td><input class="form-control datepicker" data-language="th" data-format="yyyy-mm-dd" name="start_date[]" type="text" required value="{!! $row->start_date !!}" {!! $disabled !!} autocomplete="off"></td>
                                            <td><input class="form-control datepicker" data-language="th" {!! $disabled !!} required data-format="yyyy-mm-dd" name="end_date[]" type="text" value="{!! $row->end_date !!}"  autocomplete="off"></td>
                                            <td>
                                                <a class="btn btn-danger delete-property-button" data-id="{!! $row->id !!}" data-quotation="{!! $id !!}" data-customer="{!! $customer_id !!}">
                                                    <i class="fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                            </table>
                        </div>

                    </div>

                    <div class="form-group">
                        <div class="col-sm-4" style="margin-left: 15%">
                            <button type="button" class="btn btn-info btn-primary add_directer"><i class="fa fa-plus"> </i> เพิ่มนิติบุคคล</button>
                        </div>
                        <label class="col-sm-2 control-label"></label>
                        <div class="col-sm-4">
                        </div>
                    </div>


                    <input type="hidden" name="sales_id" value="{!! $quotation1->sales_id !!}">
                    <input type="hidden" name="customer_id" value="{!! $quotation1->lead_id !!}">
                    <input type="hidden" name="price" value="{!! $price !!}">

                    <?php
                    if(!empty($max_cus)){
                        $cut_c=substr($max_cus,2);
                        $sum_c=$cut_c+1;
                        $new_id="0000".$sum_c;
                        $count=strlen($new_id);
                        if($count>5){
                            $count_c=$count-5;
                            $cut_new_id=substr($new_id,$count_c);
                            $cus="NB".$cut_new_id;
                        }else{
                            $cus="NB".$new_id;
                        }
                    }else{
                        $cus="NB00001";
                    }
                    ?>

                    <div style="text-align: right">
                        @if($contract->status != 1)
                        <button type="button" class="btn btn-white" data-dismiss="modal">{{ trans('messages.cancel') }}</button>
                        <button type="submit" class="btn btn-primary change-active-status-btn">{{ trans('messages.confirm') }}</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {!! Form::close(); !!}
    {{--endcontent--}}

    {{--Approved--}}
    <div class="modal fade" id="approved">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">อนุมัติสัญญา</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form">
                                @if(Auth::user()->role ==2)
                                    {!! Form::model(null,array('url' => array('customer/sales/contract/approved'),'class'=>'form-horizontal','id'=>'p_form')) !!}
                                @else
                                    {!! Form::model(null,array('url' => array('customer/contract/approved'),'class'=>'form-horizontal','id'=>'p_form')) !!}

                                @endif
                                <br>
                                    <input type="hidden" name="id2" id="id2">
                                    <input type="hidden" name="quo_id" id="quo_id">
                                    <input type="hidden" name="customer_id" id="customer_id">
                                <div style="text-align: center;">
                                    <img src="https://cdn4.iconfinder.com/data/icons/social-messaging-productivity/64/x-14-512.png" alt="" width="50%">
                                    <br><br> <br>
                                    <button type="button" class="btn btn-white btn-lg" data-dismiss="modal">{{ trans('messages.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary btn-lg"  name="submit">ยืนยัน</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {!! Form::close(); !!}
            </div>
        </div>
    </div>
    {{--end Approved--}}

    {{--delete--}}
    <div class="modal fade" id="delete">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">ลบนิติบุคคล</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form">
                                @if(Auth::user()->role !=2)
                                    {!! Form::model(null,array('url' => array('customer/Customer_form/delete_property'),'class'=>'form-horizontal','id'=>'p_form')) !!}
                                @else
                                    {!! Form::model(null,array('url' => array('customer/sales/Customer_form/delete_property'),'class'=>'form-horizontal','id'=>'p_form')) !!}
                                @endif
                                <br>
                                    <input type="hidden" name="id_property" class="id_property">
                                    <input type="hidden" name="id_quotation" class="id_quotation">
                                    <input type="hidden" name="id_customer" class="id_customer">
                                <div style="text-align: center;">
                                    <img src="https://cdn3.iconfinder.com/data/icons/tango-icon-library/48/edit-delete-512.png" alt="" width="50%">
                                    <br>
                                    <button type="button" class="btn btn-white btn-lg" data-dismiss="modal">{{ trans('messages.cancel') }}</button>
                                    <button type="submit" class="btn btn-primary btn-lg" name="submit" >ลบ</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {!! Form::close(); !!}
            </div>
        </div>
    </div>
    {{--end delete--}}
    <div id="property_select" style="display:none;">
        <select name="property_id_update[]" id="property_id" class="form-control" required OnChange="result_Name(this);" style="width: 500px;">
            <option value="">กรุณาเลือกนิติบุคคล</option>
            @foreach($property as $prow)
                <option value="{!! $prow['id'] !!}|{!! $prow['property_name_th'] !!}">{!! $prow['property_name_th']." ".$prow['property_name_en'] !!}</option>
            @endforeach
        </select>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{!!url('/js/jquery-validate/jquery.validate.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.th.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/number.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/nabour-vehicle.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/jquery-ui/jquery-ui.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/selectboxit/jquery.selectBoxIt.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/select2/select2.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/nabour-search-form.js')!!}"></script>
    <script type="text/javascript">
        // Override
        $(function () {
            $("#property_id").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });

        $("#p_form").validate({
            rules: {
                contract_code  	: 'required',
                quotation_id 	: 'required',
                property_id 	    : 'required',
                payment_term_type   : 'required',
                type_service    : 'required',
                start_date  : 'required',
                end_date    : 'required',
                property_name    : 'required'
            },
            errorPlacement: function(error, element) { element.addClass('error'); }
        });


        $('#change-active-status-btn').on('click', function () {
            if($("#p_form").valid()) {
                $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                $("#p_form").submit();
            }
        });

        function mate_approved(id,quo_id,customer_id) {
            document.getElementById("id2").value = id;
            document.getElementById("quo_id").value = quo_id;
            document.getElementById("customer_id").value = customer_id;
        }

        $(function () {
            $('.add_directer').on('click', function (e){
                e.preventDefault();
                var property = '<select name="property_id_update[]" class="price_service" OnChange="result_Name(this);" style="width: 500px;">'+ $('#property_select select').html() + '</select>';

                var tRowTmp = [
                    '<tr class="item-row">',
                    '<input type="hidden" name="" value="" />',
                    '<td style="text-align: left;width:500px;">'+property+'</td>',
                    '<td><input type="hidden" class="toValidate form-control input-sm"/></td>',
                    '<td><input type="text" name="property_name_update[]" value="" class="toValidate form-control input-sm tName" required/></td>',
                    '<td> <input class="input-medium" name="start_date_update[]" data-date-format="yyyy-mm-dd" type="text" data-provide="datepicker" data-date-language="th-th" autocomplete="off"></td>',
                    '<td> <input class="input-medium" name="end_date_update[]" data-date-format="yyyy-mm-dd" type="text" data-provide="datepicker" data-date-language="th-th" autocomplete="off"></td>',
                    '<td><a class="btn btn-danger unit-card-delete-button action-item"><i class="fa-trash"></i></a></td>',
                    '</tr>'].join('');

                $('#itemsTable').append(tRowTmp);
            });

            $('body').on("click", '.unit-card-delete-button', function() {
                //alert('aaa');
                $(this).closest('tr.item-row').remove();
                return false;
            });

        });

        function result_Name(strName)
        {
            //alert('ssss');
            var name = strName.value;
            name = name.split("|")[1];
            $(strName).parents('tr').find('.tName').val(name);
        }

        $('.delete-property-button').on('click',function (e) {
            e.preventDefault();
            var id = $(this).data("id");
            var id_quotation = $(this).data("quotation");
            var id_customer = $(this).data("customer");

            $('.id_property').val(id);
            $('.id_quotation').val(id_quotation);
            $('.id_customer').val(id_customer);
            $('#delete').modal('show');
            //console.log(id);
        })
    </script>
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2.css">
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2-bootstrap.css">
@endsection