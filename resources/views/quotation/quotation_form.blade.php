@extends('base-admin')
@section('content')
    <?php
   /* $lang = App::getLocale();
    $property_type = unserialize(constant('PROPERTY_TYPE_'.strtoupper($lang)));*/
    ?>
    <script type='text/javascript' src='//code.jquery.com/jquery-1.11.0.js'></script>
    <script language="javascript">
        $(function() {

            $('.tQty').keyup(function() {
                updateTotal();
            });
            $('.tPrice').keyup(function() {
                updateTotal();
            });

            /* $('#project_package').keyup(function() {
                 updateTotal_package();
             });

             $('#project_package').keyup(function() {
                 updateTotal();
             });*/

            $('#month_package').keyup(function() {
                updateTotal_package();
            });

            $('#month_package').keyup(function() {
                updateTotal();
            });

            $('#discount').keyup(function() {
                updateTotal();
            });

            var updateTotal_package = function () {
                var unit_package = parseInt($('#unit_package').val());
                var project_package = parseInt($('#project_package').val());
                var month_package = parseInt($('#month_package').val());



                var total = parseFloat((month_package*project_package*unit_package) || 0).toFixed(2);

                $('#total_package').val(total);
            };


            var updateTotal = function () {
                var grandTotal = parseInt($('#grandTotal').text().replace(',',''));
                var project_package = parseInt($('#project_package').val());
                var total_package = parseInt($('#total_package').val());
                var discount = parseInt($('#discount').val());
                var month_package = parseInt($('#month_package').val());



                var total = parseFloat(((month_package*project_package)*total_package) || 0).toFixed(2);

                var sub_total = parseFloat((grandTotal + total_package) || 0).toFixed(2);

                var vat = parseFloat(((grandTotal + total_package)*(7/100)) || 0).toFixed(2);
                var vat1 = parseFloat((grandTotal + total_package)*(7/100)) || 0;

                var sumgrand = (sub_total-discount) + vat1;

                $('#sub_total').val(sub_total);
                $('#vat').val(vat);
                $('#grand_total1').val(sumgrand).toFixed(2);
                $('#total_package').val(project_package).toFixed(2);
            };
        });

        function resutPrice(strCusPrice)
        {
            //form1.id_package.value = strCusPrice.split("|")[0];
            form1.unit_package.value = strCusPrice.split("|")[1];
        }

        function resutServicePrice(strCusServicePrice)
        {
            //form1.id_package.value = strCusServicePrice.split("|")[0];
            form1.unit_price.value = strCusServicePrice.split("|")[1];
        }
    </script>
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
                {!! Form::model(null,array('url' => array('/service/quotation/add/insert'),'class'=>'form-horizontal','id'=>'create-invoice-form','name'=>'form1')) !!}

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
                    <tr class="item-row">
                        <td></td>
                        <td>
                            <select name="transaction[0][service]" id="service unit-select" class="toValidate form-control input-sm" required>
                                <option value="">กรุณาเลือกค่าบริการ</option>
                                @foreach($service as $row)
                                    <option value="{!!$row->id!!}">{!!$row->name!!}</option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" name="transaction[0][project]" class="toValidate form-control  tPrice" required/>
                        </td>
                        <td>
                            <input type="text" class="toValidate form-control input-sm" name="transaction[0][price]" maxlength="15" required/>

                        </td>
                        <td><div class="input-group">
                                <span class="input-group-addon">฿</span>
                                <input type="text" style="text-align: right;" name="transaction[0][unit_price]" id="unit_price" value="" class="toValidate form-control input-sm tQty"/>
                            </div>
                        <td>
                            <div class="text-right">
                                <span class="colTotal">0</span> บาท
                            </div>
                            <input name="transaction[0][total]" class="tLineTotal" type="hidden" value=""/>
                        </td>
                    </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col-sm-7">
                        <a href="#" id="addRowBtn" class="btn btn-primary"><i class="fa-plus"></i> {{ trans('messages.feesBills.add_item') }}</a>
                    </div>
                    <div class="col-md-5 text-right">
                        {{-- <div class="row">
                             <div class="col-md-8 text-right"><h5>{{ trans('messages.feesBills.sub_total') }}:</h5></div>
                             <div class="col-md-4 text-right"><h5><span id="subTotal">0.00</span> {{ trans('messages.Report.baht') }}</h5>
                             </div>
                         </div>--}}
                        <div class="row">
                            <div class="col-md-8 text-right"><h5>{{ trans('messages.feesBills.grand_total') }}:</h5></div>
                            <div class="col-md-4 text-right"><h5><span id="grandTotal">0.00</span> {{ trans('messages.Report.baht') }}</h5>
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
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">พนักงานขาย</label>
                                                <div class="col-sm-10">
                                                    <input type="text" name="sale" value="{{$lead->lastest_sale->name}}" class="form-control" readonly>
                                                    <input type="hidden" name="sales_id" value="{{$lead->sale_id}}" class="form-control" readonly>
                                                </div>
                                            </div>

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
                                                        <?php
                                                        foreach ($package as $pac){
                                                            $price=$pac->price_with_vat!=0?$pac->price_with_vat:$pac->price;
                                                            echo "<option value='$pac->id|$price'>$pac->name</option>";
                                                        }
                                                        ?>
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
                                                    {{-- <input type="hidden" name="id_package" id="id_package">--}}
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label">รวมเป็นเงิน</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" required name="total_package" id="total_package" type="text" readonly >
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
                                                    {{--<input type="text" name="test" id="test">--}}
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
                                                    <input type="text" required class="form-control datepicker" name="invalid_date" data-format="yyyy/mm/dd">
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
                {{--<input type="submit" id="create-invoice-btn" name="submit" value="บันทึก" class="btn btn-primary">--}}
                <button type="button" id="create-invoice-btn" class="btn btn-primary">บันทึก</button>
            </div>
        </div>
    </div>
    {!! Form::close() !!}

    <div id="invoice-category-template" style="display:none;">
        <select name="transaction[0][service]" id="service unit-select" class="toValidate form-control input-sm" required>
            <option value="">กรุณาเลือกค่าบริการ</option>
            @foreach($service as $row)
                <option value="{!!$row->id!!}">{!!$row->name!!}</option>
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
@endsection