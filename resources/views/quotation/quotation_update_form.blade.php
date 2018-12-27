@extends('base-admin')
@section('content')
    <?php
    /*$lang = App::getLocale();
    $property_type = unserialize(constant('PROPERTY_TYPE_'.strtoupper($lang)));*/
    ?>

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
                @if(Auth::user()->role !=2)
                        {!! Form::model(null,array('url' => array('service/quotation/update/file'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form1')) !!}
                    @else
                        {!! Form::model(null,array('url' => array('service/sales/quotation/update/file'),'class'=>'form-horizontal','id'=>'p_form','name'=>'form1')) !!}
                @endif
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
                        <input type="hidden" name="_data[{{ $key }}][id_]" value="{{$quo->id}}">
                        <input type="hidden" name="_data[{{ $key }}][id]" value="{{$quo->quotation_id}}">
                        <input type="hidden" name="_data[{{ $key }}][lead_id]" value="{{$quo->lead_id}}">

                        <?php
                            $read=$quo->lastest_package->status==1?"readonly":"";
                            $id_=$quo->lastest_package->status==1?"unit_price":"";
                            $t_price=$quo->lastest_package->status==1?"tprice":"";
                            $t_month=$quo->lastest_package->status==1?"tmonth":"";
                            $_service=$quo->lastest_package->status==1?"service_":"";
                        ?>
                        <tr class="item-row">
                            {{--<a href="{{url('root/admin/report_quotation_update/'.$quo->id.'/'.$quo->property_id)}}"><i class="fa-trash"></i></a>--}}
                            <td></td>
                            <td>
                                    @if($quo->lastest_package->status==1)
                                    <select name="_data[{{ $key }}][service]" id="{!! $_service !!}" class="toValidate form-control input-sm unit-select-project" required OnChange="resutPrice(this.value);">
                                        <option value="">กรุณาเลือกค่าบริการ</option>
                                            @foreach($package as $row_)
                                                <?php
                                                $select_=$row_->id==$quo->package_id?"selected":"";
                                                ?>
                                                <option value="{{$row_->id}}|{!! $row_->price !!}" {{$select_}}>{{$row_->name}}</option>
                                            @endforeach
                                    </select>
                                        @else
                                        <select name="_data[{{ $key }}][service]" id="service" class="toValidate form-control input-sm" required>
                                            <option value="">กรุณาเลือกค่าบริการ</option>
                                            @foreach($service as $row)
                                                <?php
                                                $select=$row->id==$quo->package_id?"selected":"";
                                                ?>
                                                <option value="{{$row->id}}" {{$select}}>{{$row->name}}</option>
                                            @endforeach
                                        </select>
                                    @endif
                            </td>
                            <input type="hidden" name="_data[{{ $key }}][quotation_code]" value="{{$quo->quotation_code}}"/>
                            <td><input type="text" required name="_data[{{ $key }}][project]" id="{!! $t_price !!}" style="text-align: right;" value="{!!$quo->project_package!!}" class="toValidate form-control  tPrice"/>
                            </td>
                            <td>
                                <input type="text" required style="text-align: right;" id="{!! $t_month !!}" class="toValidate form-control input-sm" name="_data[{{ $key }}][price]" value="{{$quo->month_package}}" maxlength="15"/>

                            </td>
                            <td><div class="input-group">
                                    <span class="input-group-addon">฿</span>
                                    <input type="text" style="text-align: right;" required name="_data[{{ $key }}][unit_price]" id="{!! $id_ !!}" value="{!!$quo->unit_package!!}" class="toValidate form-control input-sm tQty" {!! $read !!}/>
                                </div>
                            <td>
                                <div class="text-right">
                                    <span class="colTotal" id="_colTotal">{{$quo->total_package}}</span> บาท
                                </div>
                                <input name="_data[{{ $key }}][total1]" required class="tLineTotal" id="_tLineTotal" type="hidden" value="{{$quo->total_package}}"/>
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
                        <div class="row">
                            <div class="col-md-8 text-right"><h5>{{ trans('messages.feesBills.sub_total') }}:</h5></div>
                            <div class="col-md-4 text-right"><h5><span id="subTotal">{!! $quotation->grand_total_price !!}</span> {{ trans('messages.Report.baht') }}</h5>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8 text-right"><h5>{{ trans('messages.feesBills.discount') }}: </h5></div>
                            <div class="col-md-4 text-right">
                                <input type="text" name="discount" id="discount" maxlength="20" value="{!! $quotation->discount !!}" class="text-right form-control input-sm">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-5 col-md-offset-3 text-right">
                                <div class="input-group">
                                    <input placeholder="{{ trans('messages.feesBills.vat') }}" type="text" name="tax" id="tax" maxlength="2" value="" class="form-control input-sm">
                                    <span class="input-group-addon">%</span>
                                </div>
                            </div>
                            <div class="col-md-4 text-right">
                                <input type="text" name="vat" class="text-right form-control input-sm salesTax" value="{!! $quotation->product_vat !!}" readonly style="border: none;">
                            </div>
                        </div>
                        <?php
                            $grand_total=($quotation->grand_total_price+$quotation->product_vat)-$quotation->discount;
                        ?>
                        <div class="row">
                            <div class="col-md-8 text-right"><h5>{{ trans('messages.feesBills.grand_total') }} :</h5></div>
                            <div class="col-md-4 text-right"><h5><span id="grandTotal">{!! $grand_total !!}</span> {{ trans('messages.Report.baht') }}</h5>
                                <input type="hidden" id="h_total" name="sub_total">
                            </div>
                        </div>
                        <input name="grand_total_" id="form-grand-total" type="hidden" value="{!! $grand_total !!}"/>
                        <input type="hidden" name="quotation_code1" value="{{$quo->quotation_code}}">
                        <input type="hidden" name="quotation_code" value="{{$quo->quotation_id}}">
                        <input type="hidden" name="sales_id" value="{{$quotation->sales_id}}">
                        <input type="hidden" name="lead_id" value="{{$quotation->lead_id}}">


                        {{--<div class="row">--}}
                        {{--<div class="col-md-8 text-right"><h5>{{ trans('messages.feesBills.grand_total') }}:</h5></div>--}}
                        {{--<div class="col-md-4 text-right"><h5><span id="_grandTotal">0.00</span> {{ trans('messages.Report.baht') }}</h5>--}}
                        {{--</div>--}}
                        {{--</div>--}}

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
                                                    <input type="text" required class="form-control datepicker" name="invalid_date" data-format="yyyy-mm-dd" value="{!! $quotation->invalid_date !!}">
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
    <script type="text/javascript" src="{!!url('/js/number.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/datepicker/bootstrap-datepicker.th.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/nabour-create-quotation.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/jquery-validate/jquery.validate.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/jquery-ui/jquery-ui.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/selectboxit/jquery.selectBoxIt.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/select2/select2.min.js')!!}"></script>
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

        $(function () {

            $('#tprice').keyup(function() {
                updatePriceService();
            });

            $('#tmonth').keyup(function() {
                updatePriceService();
            });

            $('#unit_price').keyup(function() {
                updatePriceService();
            });

            $('#service_').click(function() {
                updatePriceService();
            });

            $('.unit-select-project').click(function() {
                updatePriceService();
            });


            var updatePriceService = function () {
                var price = parseInt($('#tprice').val());
                var project_package = parseInt($('#tmonth').val());
                var month_package = parseInt($('#unit_price').val());
                //var TotalTax = parseInt($('#tax').val());
               //alert(project_package);
                var total = parseFloat((price*project_package*month_package) || 0).toFixed(2);

                $('#_colTotal').text(total);
                $('#_tLineTotal').val(total);
                calTotal();
            };


        });

        function resutPrice(strCusPrice)
        {
            //form1.id_package.value = strCusPrice.split("|")[0];
            form1.unit_price.value = strCusPrice.split("|")[1];
        }
    </script>
@endsection