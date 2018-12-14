@extends('base-admin')
@section('content')
    <?php
    /*$lang = App::getLocale();
    $property_type = unserialize(constant('PROPERTY_TYPE_'.strtoupper($lang)));*/
    ?>
    <script language="javascript">
        function fnccheck(){
            var month;/*//เดือน*/
            var total;/*//รวม*/
            var unit;/*//ยูนิต*/
            var price;/*//ราคา*/


            month=parseFloat(document.form1.month.value);
            unit=parseFloat(document.form1.month.value);
            price=parseFloat(document.form1.service.value);

            total=month*5000;

            document.form1.total.value=total;
            document.form1.unit.value=unit;
        }

        function fnccheck_package(){
            var month_package;/*//เดือน*/
            var total;/*//รวม*/
            var project_package;/*//ยูนิต*/
            var total_package;/*//ราคา*/


            month_package=parseFloat(document.form1.month_package.value);
            project_package=parseFloat(document.form1.project_package.value);
            total_package=parseFloat(document.form1.price1.value);

            total=(month_package*project_package)*total_package;

            document.form1.total_package.value=total;
        }

        $(function() {

            $('#project_package').keyup(function() {
                updateTotal();
            });
            $('#discount').keyup(function() {
                updateTotal();
            });


            var updateTotal = function () {
                var grandTotal = parseInt($('#grandTotal').text().replace(',',''));
                var project_package = parseInt($('#project_package').val());
                var total_package = parseInt($('#total_package').val());
                var discount = parseInt($('#discount').val());

                var sub_total = parseFloat((grandTotal + total_package) || 0).toFixed(2);

                var vat = parseFloat(((grandTotal + total_package)*(7/100)) || 0).toFixed(2);
                var vat1 = parseFloat((grandTotal + total_package)*(7/100)) || 0;

                var sumgrand = (sub_total-discount) + vat1;

                $('#sub_total').val(sub_total);
                $('#vat').val(vat);
                $('#grand_total1').val(sumgrand).toFixed(2);
            };
        });
    </script>
    <?php
    $sum = 0;
    ?>
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">ใบเสนอราคา</h1>
        </div>
        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>{{ trans('messages.page_home') }}</a>
                </li>
                <li>Service</li>
                <li class="active">
                    <strong>ใบเสนอราคา</strong>
                </li>
            </ol>
        </div>
    </div>
    <a href="{{url('root/admin/property/print_quotation')}}" target="_blank" class="action-float-right btn btn-primary"><i class="fa fa-print"> </i> พิมพ์ใบเสนอราคา</a><span></span>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">รายละเอียดโครงการ</h3>
                </div>
                <div class="panel-body member-list-content">
                    <div class="tab-pane active" id="member-list">
                        <div id="member-list-content">
                            {{--content--}}
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">ชื่อ - นามสกุล : {{$quotation->latest_lead->firstname ."   ". $quotation->latest_lead->lastname}} </label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">โทร :  {{$quotation->latest_lead->phone}}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">E - mail  :  {{$quotation->latest_lead->email}}</label>
                            </div>
                            {{--endcontent--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{----}}
    <section class="bills-env">
        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::model(null,array('url' => array('service/quotation/update/file'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form1')) !!}

                <table class="table table-striped table-condensed" id="itemsTable" style="min-width:600px;">
                    <thead>
                    <tr>
                        <th style="width: 5%"></th>
                        <th style="width: 25%">ค่าบริการ</th>
                        <th style="width: 10%">Project</th>
                        <th style="width: 20%">Month</th>
                        <th style="width: 20%">Unit_price</th>
                        <th style="width: 15%">{{ trans('messages.feesBills.total') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($quotation_service as $key => $quo)
                        <input type="hidden" name="_data[{{ $key }}][id]" value="{{$quo->id}}">
                        <input type="hidden" name="_data[{{ $key }}][lead_id]" value="{{$quo->lead_id}}">
                        <tr class="item-row">
                            {{--<a href="{{url('root/admin/report_quotation_update/'.$quo->id.'/'.$quo->property_id)}}"><i class="fa-trash"></i></a>--}}
                            <td></td>
                            <td>
                                <select name="_data[{{ $key }}][service]" id="service" class="toValidate form-control input-sm" required>
                                    <option value="">กรุณาเลือกค่าบริการ</option>
                                    @foreach($service as $row)
                                        <?php
                                        $select=$row->id==$quo->package_id?"selected":"";
                                        ?>
                                        <option value="{{$row->id}}" {{$select}}>{{$row->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <input type="hidden" name="_data[{{ $key }}][quotation_code]" value="{{$quo->quotation_code}}"/>
                            <td><input type="text" required name="_data[{{ $key }}][project]" style="text-align: right;" value="{{number_format($quo->project_package,0)}}" class="toValidate form-control  tPrice"/>
                            </td>
                            <td>
                                <input type="text" required style="text-align: right;" class="toValidate form-control input-sm" name="_data[{{ $key }}][price]" value="{{$quo->month_package}}" maxlength="15"/>

                            </td>
                            <td><div class="input-group">
                                    <span class="input-group-addon">฿</span>
                                    <input type="text" style="text-align: right;" required name="_data[{{ $key }}][unit_price]" value="{{number_format($quo->unit_package,2)}}" class="toValidate form-control input-sm tQty"/>
                                </div>
                            <td>
                                <div class="text-right">
                                    <span class="colTotal">{{number_format($quo->total_package,2)}}</span> บาท
                                </div>
                                <input name="_data[{{ $key }}][total1]" required class="tLineTotal" type="hidden" value="{{$quo->total_package}}"/>
                            </td>
                        </tr>
                        <?php
                        $sum +=$quo->total_package;
                        ?>
                    @endforeach
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-7">
                        {{--<input type="hidden">--}}
                        {{--<a href="#" id="addRowBtn" class="btn btn-primary"><i class="fa-plus"></i> {{ trans('messages.feesBills.add_item') }}</a>--}}
                    </div>
                    <div class="col-md-5 text-right">
                        {{-- <div class="row">
                             <div class="col-md-8 text-right"><h5>{{ trans('messages.feesBills.sub_total') }}:</h5></div>
                             <div class="col-md-4 text-right"><h5><span id="subTotal">0.00</span> {{ trans('messages.Report.baht') }}</h5>
                             </div>
                         </div>--}}
                        <div class="row">
                            <div class="col-md-8 text-right"><h5>{{ trans('messages.feesBills.grand_total') }}:</h5></div>
                            <div class="col-md-4 text-right"><h5><span id="grandTotal">{{number_format($sum,2)}}</span> {{ trans('messages.Report.baht') }}</h5>
                            </div>
                        </div>
                        <div class="property-balance" style="display:none;">
                            <hr/>
                            <div class="row">
                                <div class="col-md-8 text-right"><h5>{{ trans('messages.Prepaid.prepaid_balance') }}:</h5></div>
                                <div class="col-md-4 text-right"><h5><span class="current-balance">0.00</span> {{ trans('messages.Report.baht') }}</h5></div>
                            </div>
                            <div class="row">
                                <div class="col-md-8 text-right"><h5>{{ trans('messages.Prepaid.added_pay') }}:</h5></div>
                                <div class="col-md-4 text-right"><h5><span id="final-balance">0.00</span> {{ trans('messages.Report.baht') }}</h5></div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr/>
                <div class="form-group">
                    <div class="col-sm-9">
                        <input type="hidden">
                    </div>
                    {{--<div class="col-sm-3 text-right">
                        <a href="{{url('admin/fees-bills/invoice')}}" class="btn btn-white">{{ trans('messages.cancel') }}</a>
                        <button type="button" id="create-invoice-btn" class="btn btn-primary">{{ trans('messages.feesBills.create_invoice_head') }}</button>
                    </div>--}}
                </div>
                <input name="grand_total" id="form-grand-total" type="hidden"/>
                <input name="balance" id="unit-balance-input" type="hidden"/>
                <input name="total" id="form-total" type="hidden"/>

                {{----}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Package ของระบบ Nabour</h3>
                            </div>
                            <div class="panel-body">
                                <div class="tab-pane active" id="member-list">
                                    <div id="member-list-content">
                                        {{--content--}}
                                        <div id="cal_package">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">เลขที่ใบเสนอราคา</label>
                                                    <div class="col-sm-10">
                                                        <input type="text" class="form-control" required name="quotation_number" id="quotation_number" readonly value="{!! $quotation->quotation_code !!}">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">Package</label>
                                                    <div class="col-sm-10">
                                                        <input type="hidden" name="quotation_code" value="{{$quotation->quotation_code}}"/>
                                                        <input type="hidden" class="form-control" name="package_id"  readonly value="{!! $quotation->product_id !!}">
                                                        <input type="text" required class="form-control" required name="package" id="package" readonly value="{!! $quotation->lastest_package->name !!}">
                                                        <input type="hidden" class="form-control" name="price1" id="price1" readonly value="{!! $quotation->lastest_package->price !!}">
                                                        <input type="hidden" class="form-control" name="sales_id"  readonly value="{!! $quotation->sales_id !!}">
                                                        <input type="hidden" class="form-control" name="lead_id"  readonly value="{!! $quotation->lead_id !!}">
                                                        {{--<input type="hidden" class="form-control" name="quotation_id"  readonly value="{!! $quotation->quotation_id !!}">--}}
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">จำนวนโครงการ</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control tpack" required  name="project_package" value="{!! $quotation->product_amount !!}" id="project_package" type="text"  onkeyup="JavaScript:return fnccheck_package();" >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">จำนวนเดือน</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control tmonth" required name="month_package" id="month_package" type="text" readonly value="{!! $quotation->month_package !!}" >
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">จำนวนหน่วย</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control tunit" required name="unit_package" value="{!! $quotation->unit_price !!}" id="unit_package" type="text" readonly>
                                                    </div>
                                                </div>
                                                <?php
                                                    $sum_package=$quotation->product_amount*$quotation->month_package*$quotation->unit_price;
                                                ?>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label">รวมเป็นเงิน</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" name="total_package" id="total_package" type="text" readonly value="{!! $sum_package !!}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        {{--endcontent--}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                {{----}}
                {{---------------------}}
                <?php
                    $subtotal=$sum+$sum_package;
                ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">รวมค่าบริการ</h3>
                            </div>
                            <div class="panel-body">
                                <div class="tab-pane active" id="member-list">
                                    <div id="member-list-content">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Sub Total</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control"  name="sub_total" id="sub_total" readonly value="{!! number_format($subtotal,2) !!}" onclick="JavaScript:return sum_total();">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Distotal</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="discount" id="discount" type="text"  value="{!! $quotation->discount !!}">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Vat 7%</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="vat" id="vat" type="text" value="{!! $quotation->product_vat !!}" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Grand Total</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" value="{!! $quotation->product_price_with_vat !!}" name="grand_total" id="grand_total1" type="text" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">อายุใบเสนอราคา</h3>
                            </div>
                            <div class="panel-body">
                                <div class="tab-pane active" id="member-list">
                                    <div id="member-list-content">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">วันหมดอายุ </label>
                                                <div class="col-sm-10">
                                                    {{--{!! Form::text('due_date',null,array('class'=>'form-control datepicker','data-format' => "yyyy/mm/dd",'size'=>25,'readonly','data-language'=>App::getLocale(),'style'=>'z-index:1 !important;')) !!}--}}
                                                    <input type="text" required class="form-control datepicker" name="invalid_date" data-format="yyyy/mm/dd" value="{!! $quotation->invalid_date !!}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" id="baht-label" value="{{ trans('messages.Report.baht') }}" />

            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default text-right">
                {{--<a class="btn btn-gray" href="{{url('root/admin/property/list')}}">Cancel</a>--}}
                {{--{!! Form::button('บันทึก',['class'=>'btn btn-primary','id'=>'submit-form']) !!}--}}
                <input type="submit" name="submit" id="create-invoice-btn" value="บันทึก" class="btn btn-primary">
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <div id="invoice-category-template" style="display:none;">
        <select name="transaction[0][service]" id="service" class="toValidate form-control input-sm">
            <option value="">กรุณาเลือกค่าบริการ</option>
            @foreach($service as $row)
                <option value="{{$row->id}}">{{$row->name}}</option>
            @endforeach
        </select>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.th.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/nabour-create-quotation.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/jquery-validate/jquery.validate.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/jquery-ui/jquery-ui.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/selectboxit/jquery.selectBoxIt.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/select2/select2.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/number.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/inputmask/jquery.inputmask.bundle.js')!!}"></script>
    <link rel="stylesheet" href="{!!url('/js/select2/select2.css')!!}">
    <link rel="stylesheet" href="{!!url('/js/select2/select2-bootstrap.css')!!}">
    <script type="text/javascript">
        // Override
        function validateForm () {
            $("#p_form").validate({
                rules: {
                    name    : 'required',
                    detail    : 'required',
                },
                errorPlacement: function(error, element) { element.addClass('error'); }
            });
        }
        $('#create-invoice-btn').on('click',function (){
            var allGood = validateInputCreateForm_invoice()
            if($('#create-invoice-form').valid() && allGood ) {
                //check is an invoice for internal property unit and has remaining property unit balance
                if($('#for-unit').val() == 0 && Number($('#unit-balance-input').val()) > 0) {
                    remain = Number($('#unit-balance-input').val()) - Number($('#form-grand-total').val());
                    if(remain >= 0 ) {
                        $('#enough-balance').modal('show');
                    } else {
                        $('#not-enough-balance').modal('show');
                    }
                } else {
                    $('#create-invoice-form').submit();
                    $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                    //alert('GO');
                }
            }
        });

        function validateInputCreateForm_invoice () {
            var valid = validateTransaction();
            if($('#for-unit').val() == 0 && $('#unit-select').val() =="0") {
                valid = false;
                $('#unit-selectSelectBoxIt').addClass('error');
            } else {
                $('#unit-selectSelectBoxIt').removeClass('error');
            }
            return valid;
        }
    </script>
@endsection