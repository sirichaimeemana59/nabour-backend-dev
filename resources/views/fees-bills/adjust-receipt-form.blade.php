<section class="bills-env">
    <div class="panel panel-default">
        <div class="panel-body">
        @if( $bill )
            <?php
                $lang = App::getLocale();
                if($bill->type == 1)
                $cate   = unserialize(constant('INVOICE_INCOME_CATE_'.strtoupper(App::getLocale())));
                else
                $cate   = unserialize(constant('INVOICE_EXPENSE_CATE_'.strtoupper(App::getLocale())));
                array_forget($cate,'-');
            ?>
            <div class="invoice-env">
                <!-- Invoice header -->
                <div class="invoice-header">
                        <!-- Invoice Options Buttons -->
                    <div class="invoice-logo">
                        <table>
                            <tr>
                                @if($bill->property->logo_pic_name)
                                <td style="vertical-align:top;">
                                <a href="#" class="logo">
                                    <img src="{{ env('URL_S3')."/property-file/".$bill->property->logo_pic_path.$bill->property->logo_pic_name }}" alt="property-image"/>
                                </a>
                                </td>
                                <td style="vertical-align:top;padding-left:20px;">
                                @else
                                <td style="vertical-align:top;">
                                @endif
                                    <ul class="list-unstyled">
                                        <li><strong class="title-peper-juristic">{{ $bill->property->{'juristic_person_name_'.$lang} }}</strong></li>
                                        <li>{{ trans('messages.AboutProp.address_no')." ".$bill->property->address_no}}
                                            @if($bill->property->{'street_'.$lang } != "-")
                                                {{ $bill->property->{'street_'.$lang } }}
                                            @endif
                                            {{$bill->property->{'address_'.$lang} }}
                                        </li>
                                        <li>{{
                                                $bill->property->has_province->{'name_'.$lang }." ".
                                                $bill->property->postcode
                                            }}
                                        </li>
                                        <li>
                                            @if($bill->property->tel != "-")
                                                    Tel: {{ $bill->property->tel }}
                                            @endif
                                        </li>
                                        <li>
                                            @if($bill->property->fax != "-")
                                                    Fax: {{ $bill->property->fax }}
                                            @endif
                                        </li>
                                        <li>
                                            @if($bill->property->tax_id != "-")
                                                {{ trans('messages.AboutProp.tax_id')." : ".$bill->property->tax_id}}
                                            @endif
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                    <div class="invoice-detail">
                        <table width="100%" style="text-align:right;">
                            <tr>
                                <td>
                                    <b>{{ trans('messages.feesBills.receipt_') }}
                                        @if($bill->payment_status == 5)
                                            ({{ trans('messages.feesBills.canceled') }})
                                        @endif
                                    </b>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <ul class="list-unstyled">
                                        <li class="upper">{{ trans('messages.feesBills.receipt_no') }} :
                                            <strong>
                                                @if($bill->receipt_no_label == null)
                                                {{ NB_RECEIPT.invoiceNumber($bill->receipt_no) }}
                                                    @else
                                                {{$bill->receipt_no_label}}
                                                @endif
                                            </strong>
                                        </li>
                                        @if(isset($bill->property_unit))
                                        <li class="upper">{{ trans('messages.unit_no') }} : <strong>{{ $bill->property_unit->unit_number }}</strong></li>
                                        @endif
                                    </ul>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- Client and Payment Details -->
                <div class="invoice-details">
    
                    <div class="invoice-client-info">
                        <strong>{{ trans('messages.feesBills.client') }}</strong>
                        <ul class="list-unstyled">
                            @if($bill->property_unit)
                                @if($bill->property_unit->address != null)
                                    <li>
                                        {{ $bill->property_unit->{'owner_name_'.$lang} }} <br>
                                        {{ $bill->property_unit->address }}
                                    </li>
                                @else
                                    <li>
                                        @if( $bill->property_unit->{'owner_name_'.$lang} )
                                            {{ $bill->property_unit->{'owner_name_'.$lang} }}<br>
                                        @else
                                            @if($bill->payer_name)
                                                {{ $bill->payer_name }}<br>
                                            @else
                                                @if($bill->property->property_type == 1)
                                                    {{ trans('messages.feesBills.owner_home') }}<br>
                                                @elseif($bill->property->property_type == 2 || $bill->property->property_type == 3)
                                                    {{ trans('messages.feesBills.owner_room') }}<br>
                                                @else
                                                    {{ trans('messages.feesBills.owner_other') }}<br>
                                                @endif
                                            @endif
                                        @endif
                                        <?php
                                            if($bill->property_unit->building)
                                                $building = trans('messages.Prop_unit.building')." ".$bill->property_unit->building;
                                            else
                                                $building = "";
    
                                            if($bill->property_unit->unit_floor){
                                                $unit_floor = "(".$bill->property_unit->unit_floor.")";
                                            }else{
                                                $unit_floor = "";
                                            }
                                        ?>
                                        {{
                                            trans('messages.AboutProp.address_no')." ".
                                            $bill->property_unit->unit_number." ".$building." ".$unit_floor.
                                            (($bill->property_unit->unit_soi != null || $bill->property_unit->unit_soi != "") ? trans('messages.Prop_unit.unit_soi')." ". $bill->property_unit->unit_soi : "")." ".
                                            $bill->property->{'property_name_'.$lang}." ".
                                            $bill->property->{'address_'.$lang}
                                        }}
    
                                        {{ $bill->property->has_province->{'name_'.$lang }." ".$bill->property->postcode }}
                                    </li>
                                @endif
                            <li>
                                {{ trans('messages.tel') }} {{ (is_null($bill->property_unit->phone) || $bill->property_unit->phone == "" ? "-" : $bill->property_unit->phone) }}
                            </li>
                            @else
                            <li>
                                {!! nl2br(e($bill->payer_name)) !!}
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
            {!! Form::model($bill,array('url'=>['root/admin/edit/receipt/save'],'method'=>'post','class'=>'form-horizontal','id'=>'create-receipt-form','autocomplete' => 'off')) !!}
            {!! Form::hidden('id') !!}    
            <div class="row">
                <div style="padding:0px 15px;">
                    <div class="form-group">
                        <label class="control-label col-sm-2">{{ trans('messages.feesBills.invoice_name') }}</label>
                        <div class="col-sm-4">
                            {!! Form::text('name',null,array('class'=>'form-control','maxlength'=>100)) !!}
                        </div>
                        <label class="control-label col-sm-2">{{ trans('messages.Expenses.ref_no') }}</label>
                        <div class="col-sm-4">
                            {!! Form::text('ref_no',null,array('class'=>'form-control','maxlength'=>50)) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div style="padding:0px 15px;">
                    <div class="form-group">
                        <label class="control-label col-sm-2">{{ trans('messages.feesBills.due_date') }}</label>
                        <div class="col-sm-4 block-input">
                            {{--{!! Form::date('due_date',$bill->due_date,array('class'=>'form-control')) !!}--}}
                            <input type="text" required class="form-control datepicker" value="{!! $bill->due_date !!}" name="due_date" data-format="yyyy-mm-dd" autocomplete="off">

                        </div>
                        <label class="control-label col-sm-2">{{ trans('messages.feesBills.create_date_receipt') }}</label>
                        <div class="col-sm-4 block-input">
                            {{--{!! Form::date('receipt_date',$bill->updated_at,array('class'=>'form-control')) !!}--}}
                            <input type="text" required class="form-control datepicker" value="{!! $bill->updated_at !!}" name="receipt_date" data-format="yyyy-mm-dd" autocomplete="off">
                        </div>
                    </div>
                </div>
            </div>

            <hr/>
            <table class="table table-striped table-condensed" id="itemsTable" style="min-width:600px;">
                <thead>
                <tr>
                    <th style="width: 25%">{{ trans('messages.detail') }}</th>
                    <th style="width: 25%" class="text-center">{{ trans('messages.category') }}</th>
                    <th style="width: 10%" class="text-right">{{ trans('messages.feesBills.quantity') }}</th>
                    <th style="width: 20%" class="text-right">{{ trans('messages.feesBills.per_piece') }}</th>
                    <th style="width: 15%" class="text-right">{{ trans('messages.feesBills.total') }}</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($bill->transaction as $key => $transaction)
                    @if($transaction->transaction_type != 3 && $transaction->transaction_type != 4)
                    <tr class="item-row">
                        <td>
                            <input type="hidden" name="transaction[{{ $key }}][id]" value="{{ $transaction->id }}" />
                            <input type="text" name="transaction[{{ $key }}][detail]" value="{{ $transaction->detail }}" class="toValidate form-control input-sm tDesc"/>
                        </td>
                        <td>
                            <div class="text-center">{{ $cate[$transaction->category] }}</div>
                        </td>
                        <td class="text-right">
                            {{ number_format($transaction->quantity,2) }}
                        </td>
                        <td class="text-right">
                            {{ number_format($transaction->price,2) }}
                        </td>
                        <td>
                            <div class="text-right">
                                {{ number_format($transaction->total,2) }}
                                <input class="tLineTotal input-sm form-control" type="hidden" value="{{ $transaction->total }}"/>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-offset-7 col-md-5 text-right">
                    <div class="row">
                        <div class="col-md-7 text-right">{{ trans('messages.feesBills.sub_total') }}:</div>
                        <div class="col-md-5 text-right"><span id="subTotal">{{ number_format($bill->total,2) }}</span> {{ trans('messages.Report.baht') }}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-7 text-right">{{ trans('messages.feesBills.discount') }}: </div>
                        <div class="col-md-5 text-right">
                            <span>{{ number_format($bill->discount,2) }}</span> {{ trans('messages.Report.baht') }}
                            <input type="hidden" name="discount" id="discount" maxlength="20" value="{{ $bill->discount }}" class="text-right form-control input-sm" value="0">
                        </div>
                    </div>

                    @if($bill->sub_from_balance > 0)
                        <div class="row">
                            <div class="col-md-7 text-right">
                                @if( !$bill->is_common_fee_bill)
                                {{ trans('messages.feesBills.substract') }} :
                                @else
                                {{ trans('messages.feesBills.prepaid_balance') }} :
                                @endif
                            </div>
                            <div class="col-md-5 text-right">
                                <span>{{ number_format($bill->sub_from_balance, 2) }}</span> {{ trans('messages.Report.baht') }}
                                <input type="hidden" value="{{ $bill->sub_from_balance }}" class="text-right form-control input-sm" value="0">
                            </div>
                        </div>
                        @endif
                    <div class="row">
                        <div class="col-md-7 text-right"><h4>{{ trans('messages.feesBills.grand_total') }}:</h4></div>
                        <div class="col-md-5 text-right"><h4><span id="grandTotal">{{ number_format($bill->final_grand_total,2) }}</span> {{ trans('messages.Report.baht') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <hr/>
            <div class="row form-group">
                <div class="col-md-12">
                    {!! Form::textarea('remark',$bill->remark,array('class'=>'form-control','placeholder' => trans('messages.feesBills.remark'),'maxlength'=>1000,'rows'=>4)) !!}
                </div>
            </div>
            <div class="row form-group">
                <div class="col-md-offset-4 col-md-8">
                    <div class="row">
                        <div class="col-sm-5 block-input">
                            {!! Form::select('payment_type',[ 1 => trans('messages.feesBills.cash'), 2 => trans('messages.feesBills.transfer')],null,['id' => 'payment_method']) !!}
                        </div>
                        <div class="col-md-7 text-right block-input">
                            <label class="col-sm-4 control-label">
                                {{ trans('messages.RevenueRecord.receive_date') }}
                            </label>
                            <div class="col-sm-8 no-padding-right">
                                {{--{!! Form::date('payment_date',$bill->payment_date,array('id'=>'payment_date','class'=>'form-control')) !!}--}}
                                <input type="text" required class="form-control datepicker" value="{!! $bill->payment_date !!}" name="payment_date" data-format="yyyy-mm-dd" autocomplete="off">

                                <input type="text" required class="form-control datepicker"  name="payment_date" data-format="yyyy-mm-dd" autocomplete="off">


                            </div>
                        </div>
                    </div>
                    <div class="row" id="select-bank-block" @if( $bill->payment_type == 1) style="display:none;" @endif>
                        <div class="col-sm-12">
                        <?php 
                            if( $bill->payment_type == 2 ) {
                                $bank_id = $bill->bankTransaction->bank_id;
                            } else {
                                $bank_id = null;
                            }
                        ?>
                            {!! Form::select('bank_id',$bank_list,$bank_id,array('id'=>'payment_bank')) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-right">
                            <hr>
                            <a href="{{url('admin/retroactive-receipt')}}" class="btn btn-white">{{ trans('messages.back') }}</a>
                            <button type="button" id="create-receipt-btn" class="btn btn-primary">{{ trans('messages.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <input name="grand_total" id="form-grand-total" type="hidden" value="{{ $bill->total }}"/>
            <input name="total" id="form-total" type="hidden" value="{{ $bill->final_grand_total }}"/>
            {!! Form::close() !!}
           
            <input type="hidden" id="baht-label" value="{{ trans('messages.Report.baht') }}" />
            <div id="invoice-category-template" style="display:none;">
            {!! Form::select('category',$cate,null,array('class'=>'form-control')) !!}
            </div>
            <script type="text/javascript" src="{{ url('/') }}/js/nabour-validate-payment.js"></script>
            <script type="text/javascript" src="{{ url('/') }}/js/nabour-create-invoice.js"></script>
                <?php $t = time(); ?>
                <script type="text/javascript" src="{{ url('/') }}/js/datepicker/bootstrap-datepicker.js?v={!! $t !!}"></script>
                <script type="text/javascript" src="{{ url('/') }}/js/datepicker/bootstrap-datepicker.th.js?v={!! $t !!}"></script>
            <script type="text/javascript">

            $(function () {

                $('#itemsTable').find('tr:last select').selectBoxIt().on('open', function(){
                    $(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
                });

                $('#create-receipt-form').validate({
                    rules: {
                        name        : "required",
                        due_date    : "required",
                        payment_date    : "required",
                        payer_name      : { required: function () {
                            if($('#for-unit').val() == 2) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        }
                    },
                    errorPlacement: function(error, element) {}
                });
            });
            </script>
        @else
            <div style="padding:30px;" class="text-center">ไม่พบใบเสร็จรับเงินที่ตรงกับเงื่อนไข</div>
        @endif
        </div>
    </div>
</section>