@extends('base-admin')
@section('content')
    <?php
   /* $lang = App::getLocale();
    $property_type = unserialize(constant('PROPERTY_TYPE_'.strtoupper($lang)));*/
    ?>
    <?php
    if(!empty($max_cus)){
        $cut_c=substr($max_cus,2);
        $sum_c=$cut_c+1;
        $new_id="0000".$sum_c;
        $count=strlen($new_id);
        if($count>5){
            $count_c=$count-5;
            $cut_new_id=substr($new_id,$count_c);
            $cus="QU".$cut_new_id;
        }else{
            $cus="QU".$new_id;
        }
    }else{
        $cus="QU00001";
    }
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
                                <label class="col-sm-6 control-label" for="field-1">ชื่อ - นามสกุล : {{$lead->firstname ."   ". $lead->lastname}} </label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">โทร :  {{$lead->phone}}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">E - mail  :  {{$lead->email}}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">พนักงานขาย  :  {{$lead->latest_sale->name}}</label>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-6 control-label" for="field-1">เลขที่ใบเสนอราคา  :  {{$cus}}</label>
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
                {{--{!! Form::open(array('url'=>['root/admin/package/quotation_detail'],'method'=>'post','class'=>'form-horizontal','id'=>'create-invoice-form','autocomplete' => 'off')) !!}--}}
                @if(Auth::user()->role !=2)
                    {!! Form::model(null,array('url' => array('/service/quotation/add/insert'),'class'=>'form-horizontal','id'=>'create-invoice-form','name'=>'form1')) !!}
                    @else
                    {!! Form::model(null,array('url' => array('/service/sales/quotation/add/insert'),'class'=>'form-horizontal','id'=>'create-invoice-form','name'=>'form1')) !!}
                @endif
                <table class="table table-striped table-condensed" id="itemsTable" style="min-width:600px;">
                    <thead>
                    <tr>
                        <th style="width: 5%"></th>
                        <th style="width: 25%">ผลิตภัณฑ์</th>
                        <th style="width: 10%">โครงการ</th>
                        <th style="width: 20%">เดือน</th>
                        <th style="width: 20%">ราคาต่อหน่วย</th>
                        <th style="width: 15%">{{ trans('messages.feesBills.total') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="item-row">
                        <td></td>
                        <td>
                            <select name="transaction[0][service]"  class="toValidate form-control input-sm  unit-select-project" required OnChange="resultPrice(this.value);">
                                <option value="">กรุณาเลือกค่าบริการ</option>
                                @foreach($package as $row)
                                    <option value="{!!$row->id!!}|{!! $row->price !!}">{!!$row->name!!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="transaction[0][project]" class="toValidate form-control" required id="tprice" style="text-align:right"/>
                        </td>
                        <td>
                            <input type="text" class="toValidate form-control input-sm" name="transaction[0][price]" maxlength="15" required id="tmonth" style="text-align:right"/>

                        </td>
                        <td><div class="input-group">
                                <span class="input-group-addon">฿</span>
                                <input type="text" style="text-align: right;" name="transaction[0][unit_price]" id="unit_price" value="" readonly class="toValidate form-control input-sm"/>
                            </div>
                        </td>
                        <td>
                            <div class="text-right">
                                <span class="colTotal" id="_colTotal">0.00</span> บาท
                            </div>
                            <input name="transaction[0][total]" class="tLineTotal" id="_tLineTotal" type="hidden" value=""/>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-7">
                        <a href="#" id="addRowBtn" class="btn btn-primary"><i class="fa-plus"></i> {{ trans('messages.feesBills.add_item') }}</a>
                    </div>
                    <div class="col-md-5 text-right">
                         <div class="row">
                             <div class="col-md-8 text-right">{{ trans('messages.feesBills.sub_total') }}:</div>
                             <div class="col-md-4 text-right"><span id="subTotal">0.00</span> {{ trans('messages.Report.baht') }}
                             </div>
                         </div>
                        <div class="row">
                            <div class="col-md-8 text-right">{{ trans('messages.feesBills.discount') }}:</div>
                            <div class="col-md-4 text-right">
                                <input type="text" name="discount" id="discount" maxlength="20" value="0" class="text-right form-control input-sm">
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
                                <input type="text" name="vat" class="text-right form-control input-sm salesTax" value="0" readonly style="border: none;">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-8 text-right"><h5>{{ trans('messages.feesBills.grand_total') }} :</h5></div>
                            <div class="col-md-4 text-right"><h5><span id="grandTotal">0.00</span> {{ trans('messages.Report.baht') }}</h5>
                                <input type="hidden" id="h_total" name="sub_total">
                            </div>
                        </div>



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
                <input type="hidden" class="form-control" name="quotation_code" id="quotation_number" readonly value="{{$cus}}">
                <input type="hidden" name="lead_id" id="lead_id" value="{!!$id!!}">
                <input type="hidden" name="sales_id" value="{{$lead->sale_id}}" class="form-control" readonly>
                {{----}}
                {{--<div class="row">
                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Package ของระบบ Nabour</h3>
                            </div>
                            <div class="panel-body">
                                <div class="tab-pane active" id="member-list">
                                    <div id="member-list-content">
                                        --}}{{--content--}}{{--
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">พนักงานขาย</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="sale" value="{{$lead->latest_sale->name}}" class="form-control" readonly>
                                                    <input type="hidden" name="sales_id" value="{{$lead->sale_id}}" class="form-control" readonly>
                                                </div>
                                            </div>


                                            <input type="hidden" name="lead_id" id="lead_id" value="{!!$id!!}">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">เลขที่ใบเสนอราคา</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" name="quotation_code" id="quotation_number" readonly value="{{$cus}}">
                                                </div>
                                            </div>
                                            <input type="hidden" name="property_id" value="{!!$id!!}">

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Package</label>
                                                <div class="col-sm-10">
                                                    <select name="id_package" id="package" class="form-control" OnChange="resutPrice(this.value);" required>
                                                        <option value="">กรุณาเลือก Package</option>

                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">จำนวนโครงการ</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" required name="project_package" id="project_package" type="text">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">จำนวนเดือน</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" required name="month_package" id="month_package" type="text"  value="" >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">จำนวนหน่วย</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" required name="unit_package" id="unit_package" type="text" readonly value="">
                                                    --}}{{-- <input type="hidden" name="id_package" id="id_package">--}}{{--
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">รวมเป็นเงิน</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" required name="total_package" id="total_package" type="text" readonly >
                                                </div>
                                            </div>
                                        </div>
                                        --}}{{--endcontent--}}{{--
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>--}}
                {{----}}
                {{---------------------}}
                {{--<div class="row">
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
                                                    <input type="text" class="form-control" name="sub_total" id="sub_total" readonly onclick="JavaScript:return sum_total();">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Discount</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="discount" id="discount" type="text" placeholder="0" value="0">
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Vat 7%</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="vat" id="vat" type="text" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">Grand Total</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" name="grand_total" id="grand_total1" type="text" readonly>
                                                    <br>
                                                    --}}{{--<input type="text" name="test" id="test">--}}{{--
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
--}}
                {{--<input class="form-control" required name="total_package" id="total_package" type="text" readonly >--}}
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
                                                    <input type="text" required class="form-control datepicker" name="invalid_date" data-format="yyyy-mm-dd">
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
                <input type="hidden" name="role" value="{!! $lead->role !!}">
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default text-right">
                {{--<a class="btn btn-gray" href="{{url('root/admin/property/list')}}">Cancel</a>--}}
                {{--{!! Form::button('บันทึก',['class'=>'btn btn-primary','id'=>'submit-form']) !!}--}}
                {{--<input type="submit" id="create-invoice-btn" name="submit" value="บันทึก" class="btn btn-primary">--}}
                <button type="button" id="create-invoice-btn" class="btn btn-primary">บันทึก</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <div id="invoice-category-template" style="display:none;">
        <select name="transaction[0][service]"  class="toValidate form-control input-sm" required>
            <option value="">กรุณาเลือกค่าบริการ</option>
            @foreach($service as $row)
                <option value="{!!$row->id!!}">{!!$row->name!!}</option>
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

        $(function () {

            $('#unit-select').on('change',function () {
                checkUnitbalance($(this).val());
                $('.property-unit-id').html(
                    $('#unit-select').find(":selected").text()
                );
            });

            $('#create-invoice-btn').on('click',function (){
                var allGood = validateInputCreateForm_invoice()
                if($('#create-invoice-form').valid() && allGood ) {
                    $('#create-invoice-form').submit();
                    $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                    //alert('GO');
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
        })
    </script>
    <script language="javascript">
        $(function() {

            $('#tprice').number(true,0);
            $('#tmonth').number(true,0);

            $('#tprice').keyup(function() {
                updatePriceService();
            });

            $('#tmonth').keyup(function() {
                updatePriceService();
            });

            $('#unit_price').keyup(function() {
                updatePriceService();
            });

            $('.unit-select-project').click(function() {
                updatePriceService();
            })

        });

        var updatePriceService = function () {
            var price = parseInt($('#tprice').val());
            var project_package = parseInt($('#tmonth').val());
            var month_package = parseInt($('#unit_price').val());
            //var TotalTax = parseInt($('#tax').val());

            var total = parseFloat((price*project_package*month_package) || 0).toFixed(2);

            $('#_colTotal').text(total);
            $('#_tLineTotal').val(total);
            calTotal();
        };

        function resultPrice(strCusPrice)
        {
            //form1.id_package.value = strCusPrice.split("|")[0];
            form1.unit_price.value = strCusPrice.split("|")[1];
            updatePriceService();
        }

    </script>
@endsection