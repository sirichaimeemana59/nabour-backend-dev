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
                    @if(!empty($quotation1->latest_sale))
                        @if($quotation1->latest_sale->role==1)
                            <h3 class="panel-title">รายละเอียด Lead</h3>
                            @else
                            <h3 class="panel-title">รายละเอียด Customer</h3>
                            @endif
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
                                @if(!empty($quotation1->latest_lead->firstname) and !empty($quotation1->latest_lead->lastname))
                                     <label class="col-sm-6 control-label" for="field-1">ชื่อ - นามสกุล : {!!$quotation1->latest_lead->firstname ."   ". $quotation1->latest_lead->lastname!!} </label>
                                @else
                                    <label class="col-sm-6 control-label" for="field-1">ชื่อ - นามสกุล : ไม่พบข้อมูล </label>

                                @endif
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">โทร : @if(!empty($quotation1->latest_lead->phone)){!!$quotation1->latest_lead->phone!!} @else ไม่พบข้อมูล  @endif</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">E - mail  :  @if(!empty($quotation1->latest_lead->email)){!!$quotation1->latest_lead->email!!} @else ไม่พบข้อมูล @endif</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">พนักงานขาย  :  @if(!empty($quotation1->latest_sale->name)){!!$quotation1->latest_sale->name!!} @else ไม่พบข้อมูล @endif</label>
                            </div>
                            <div class="form-group">
                                <?php
                                    //dd($quotation1);
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

    {{--content--}}
    @if(Auth::user()->role !=2)
            {!! Form::model($contract,array('url' => array('service/contract/sign/add'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
        @else
            {!! Form::model($contract,array('url' => array('service/sales/contract/sign/add'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form_add')) !!}
    @endif
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">ข้อมูลสัญญา</h3>
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
                            <?php
                            $cut_id=substr($sing,9);
                            $cut_y=substr($sing,3,4);
                            $cut_m=substr($sing,7,2);
                            ?>
                            <?php
                            $date1=date("Y-m-d");
                            $cut_ym=explode("-",$date1);

                            if($cut_y!=$cut_ym[0] ||  $cut_m!=$cut_ym[1]){
                                $sing_id="OKC".$cut_ym[0]."".$cut_ym[1]."0001";
                                }else{
                                $sum=$cut_id+1;
                                $new_sign="000".$sum;
                                $sum_sing=strlen($new_sign);
                                if($sum_sing>4){
                                    $cal=$sum_sing-4;
                                    $cut_sing=substr($new_sign,$cal);
                                }else{
                                    $cut_sing=$new_sign;
                                    }
                                    $date=date("Y-m-d");
                                $cut=explode("-",$date);
                                $newdate=$cut[0]."".$cut[1];
                                $sing_id="OKC".$newdate."".$cut_sing;
                                }
                            ?>
                            <input class="form-control" name="contract_code" type="text" readonly value="{!! $sing_id !!}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">เลขที่ใบเสนอราคา</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="quotation_id" type="text" readonly value="{!! $quotation1->quotation_code !!}">
                            <input class="form-control" name="quotation_id1" type="hidden" readonly value="{!! $quotation1->id !!}">
                            {{--<input class="form-control" name="contract_id" type="text" readonly value="{!! $quotation1->latest_contract->id !!}">--}}
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label">นิติบุคคล</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<select name="property_id" id="property_id" class="form-control" required>--}}
                                {{--<option value="">กรุณาเลือกนิติบุคคล</option>--}}
                                {{--@foreach($property as $prow)--}}
                                    {{--<option value="{!! $prow['id'] !!}">{!! $prow['property_name_th']." ".$prow['property_name_en'] !!}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label">ประเภทสัญญา</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--{!! Form::select('contract_type',unserialize(constant('CONTRACT_TYPE')),null,array('class'=>'form-control','required')) !!}--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <div class="form-group">
                        <label class="col-sm-2 control-label">รูปแบบการชำระเงิน</label>
                        <div class="col-sm-10">
                            {!! Form::select('payment_term_type',unserialize(constant('PAYMENT_TERM_TYPE')),null,array('class'=>'form-control','required')) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">รูปแบบการคิดค่าบริการ</label>
                        <div class="col-sm-10">
                            {!! Form::select('type_service',unserialize(constant('type_service')),null,array('class'=>'form-control','required')) !!}
                        </div>
                    </div>

                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label">วันที่ทำสัญญา</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input class="form-control datepicker" data-language="th" data-format="yyyy-mm-dd" name="start_date" type="text" autocomplete="off"   required>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label">วันที่สิ้นสุดสัญญา</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input class="form-control datepicker" data-language="th" required data-format="yyyy-mm-dd" name="end_date" type="text" required autocomplete="off"  >--}}
                        {{--</div>--}}
                    {{--</div>--}}
                    <div class="form-group">
                        <label class="col-sm-2 control-label">ผู้ทำสัญญา</label>
                        <div class="col-sm-10">
                            <input class="form-control" name="person_name" type="text">
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="col-sm-2 control-label">นิติบุคคล</label>
                        <div class="col-sm-10">
                            <table class="table table-striped table-condensed" id="itemsTable">
                                <tr>
                                    <th>นิติบุคคล</th>
                                    <th>ชื่อบริษัท</th>
                                    <th>วันที่ทำสัญญา</th>
                                    <th>วันที่สิ้นสุดสัญญา</th>
                                    <th>ลบ</th>
                                </tr>
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
                    {{--<div class="form-group">--}}
                        {{--<label class="col-sm-2 control-label">ชื่อนิติบุคคล</label>--}}
                        {{--<div class="col-sm-10">--}}
                            {{--<input class="form-control" name="property_name"  type="text" >--}}
                        {{--</div>--}}
                    {{--</div>--}}

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
                            <button type="reset" class="btn btn-white" data-dismiss="modal">{{ trans('messages.cancel') }}</button>
                            <button type="submit" class="btn btn-primary change-active-status-btn" id="change-active-status-btn">{{ trans('messages.confirm') }}</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close(); !!}
    {{--endcontent--}}
    <div id="property_select" style="display:none;">
        <select name="property_id[]" id="property_id" class="form-control" required OnChange="result_Name(this);" style="width:500px;">
            <option value="">กรุณาเลือกนิติบุคคล</option>
            @foreach($property as $prow)
                <option value="{!! $prow['id'] !!}|{!! $prow['property_name_th'] !!}">{!! $prow['property_name_th']." ".$prow['property_name_en'] !!}</option>
            @endforeach
        </select>
    </div>

@endsection
@section('script')
    <script type="text/javascript" src="{!!url('/js/jquery-validate/jquery.validate.min.js')!!}"></script>

    <script type="text/javascript" src="{!!url('/js/number.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/nabour-vehicle.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/jquery-ui/jquery-ui.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/selectboxit/jquery.selectBoxIt.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/select2/select2.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/nabour-search-form.js')!!}"></script>
    <script type="text/javascript">
        // Override

        $( function() {
            $( ".start_date" ).datepicker();
            $( ".end_date" ).datepicker();
        } );

        $(function () {
            $("#property_id").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });

        $(function () {
            $('.add_directer').on('click', function (e){
                e.preventDefault();
                var property = '<select name="property_id[]" class="price_service" OnChange="result_Name(this);" style="width:300px;">'+ $('#property_select select').html() + '</select>';

                var tRowTmp = [
                    '<tr class="item-row">',
                    '<input type="hidden" name="" value="" />',
                    '<td style="text-align: left; width:300px;">'+property+'</td>',
                    '<td><input type="text" name="property_name[]" value="" class="toValidate form-control input-sm tName input-medium" required/></td>',
                    '<td> <input class="input-medium form-control" name="start_date[]" data-date-format="yyyy-mm-dd" type="text" data-provide="datepicker" data-date-language="th-th" autocomplete="off"></td>',
                    '<td> <input class="input-medium form-control" name="end_date[]" data-date-format="yyyy-mm-dd" type="text" data-provide="datepicker" data-date-language="th-th" autocomplete="off"></td>',
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

        function result_Name(strName)
        {
            //alert('ssss');
            var name = strName.value;
            name = name.split("|")[1];
            $(strName).parents('tr').find('.tName').val(name);
        }
    </script>
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.th.js')!!}"></script>
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2.css">
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2-bootstrap.css">
@endsection