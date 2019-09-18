
<?php
    $lang = App::getLocale();
    if($bill->type == 1)
        $cate   = unserialize(constant('INVOICE_INCOME_CATE_'.strtoupper(App::getLocale())));
    else
        $cate   = unserialize(constant('INVOICE_EXPENSE_CATE_'.strtoupper(App::getLocale())));
    array_forget($cate,'-');

    $remaining_total = $bill->final_grand_total;
    $sum_instalment = 0;

    $is_admin   = Auth::user()->role == 1?true:false;
    $role 		= Auth::user()->position;

    ?>

    @if($bill->payment_status == 0 || $bill->payment_status == 1)
        <div class="action-float-right" style="margin-top: -3px;">
            @if($bill->payment_status == 0)
{{--                || $role->cancel_invoice--}}
                @if($is_admin  )
                    <a href="#" class="action-float-right  btn btn-danger" data-toggle="modal" data-target="#cancel-invoice-modal" data-status="2">{!! trans('messages.feesBills.reject_invoice') !!}</a></li>
                @endif
{{--                <a class="action-float-right btn btn-secondary btn-icon print-bill print-multiple-invice" href="#" data-target="#confirm-copy-invoice-print-modal" data-toggle="modal">--}}
{{--                    <i class="fa-print"></i> {!! trans('messages.feesBills.print') !!}--}}
{{--                </a>--}}
            @else
                <a href="#" class="action-float-right btn btn-danger change-bill-status" data-toggle="modal" data-target="#change-rejected-modal" data-status="3">{!! trans('messages.feesBills.rejected') !!}</a></li>
            @endif
        </div>
    @endif

    <div id="print-origin-element">
        <section class="bills-env bills-master bills-top" style="position:relative;">
            <div class="panel panel-default" style="position:relative:z-index:5;">
                <div class="panel-heading hidden-print">
                    {!!$bill->name!!}
                </div>
                <div class="panel-body">
                    <section class="invoice-env">
                        <!-- Invoice header -->
                        <div class="invoice-header">
                            <!-- Invoice Options Buttons -->
                            <div class="invoice-logo">
                                <table>
                                    <tr>
                                        @if($bill->property->logo_pic_name)
                                            <td style="vertical-align:top;">
                                                <a href="#" class="logo">
                                                    <img src="{!! env('URL_S3')."/property-file/".$bill->property->logo_pic_path.$bill->property->logo_pic_name !!}" alt="property-image"/>
                                                </a>
                                            </td>
                                            <td style="vertical-align:top;padding-left:20px;">
                                        @else
                                            <td style="vertical-align:top;">
                                                @endif
                                                <ul class="list-unstyled">
                                                    <li><strong class="title-peper-juristic">{!! $bill->property->{'juristic_person_name_'.$lang} !!}</strong></li>
                                                    <li>{!! trans('messages.AboutProp.address_no')." ".$bill->property->address_no!!}
                                                        @if($bill->property->{'street_'.$lang } != "-")
                                                            {!! $bill->property->{'street_'.$lang } !!}
                                                        @endif
                                                        {!!$bill->property->{'address_'.$lang} !!}
                                                    </li>
                                                    <li>{!!
                                                            $bill->property->has_province->{'name_'.$lang }." ".
                                                            $bill->property->postcode
                                                        !!}
                                                    </li>
                                                    <li>
                                                        @if($bill->property->tel != "-")
                                                            Tel: {!! $bill->property->tel !!}
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if($bill->property->fax != "-")
                                                            Fax: {!! $bill->property->fax !!}
                                                        @endif
                                                    </li>
                                                    <li>
                                                        @if($bill->property->tax_id != "-")
                                                            {!! trans('messages.AboutProp.tax_id')." : ".$bill->property->tax_id!!}
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
                                            <b>
                                                {!! trans('messages.feesBills.invoice') !!}
                                                @if($bill->payment_status == 4)
                                                    ({!! trans('messages.feesBills.canceled') !!})
                                                @endif
                                            </b>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <ul class="list-unstyled">
                                                <li class="upper">{!! trans('messages.feesBills.invoice_no') !!} :
                                                    <strong>
                                                        @if($bill->invoice_no_label == null)
                                                            {!! NB_INVOICE.invoiceNumber($bill->invoice_no)!!}
                                                        @else
                                                            {!! $bill->invoice_no_label !!}
                                                        @endif
                                                    </strong>
                                                </li>
                                                @if(isset($bill->property_unit))
                                                    <li class="upper">{!! trans('messages.unit_no') !!} : <strong>{!! $bill->property_unit->unit_number !!}</strong></li>
                                                @endif
                                                <li class="upper">{!! trans('messages.feesBills.create_date_invoice') !!} : <strong>{!!localDate($bill->created_at)!!}</strong></li>
                                                <li class="upper">{!! trans('messages.feesBills.due_date') !!} : <strong>{!!localDate($bill->due_date)!!}</strong></li>
                                                @if($bill->payment_status == 1)
                                                    <li class="upper hidden-print">{!! trans('messages.status') !!} :
                                                        <div class="label label-info">{!! trans('messages.feesBills.confirm') !!}</div>
                                                @elseif($bill->payment_status == 0)
                                                    <li class="upper hidden-print">{!! trans('messages.status') !!} :
                                                        <div class="label label-warning">{!! trans('messages.feesBills.waiting') !!}</div>
                                                @elseif($bill->payment_status == 3)
                                                    <li class="upper hidden-print">{!! trans('messages.status') !!} :
                                                        <div class="label label-default">{!! trans('messages.feesBills.rejected') !!}</div>
                                                        @endif
                                                        <?php
                                                        if($bill->payment_status == 0 && $is_overdue_invoice):
                                                            echo '<span class="label label-danger">'.trans('messages.feesBills.overdue_amont')." ".calOverdue($bill->due_date,$bill->submit_date)."</span>";
                                                        endif;
                                                        ?>
                                                    </li>
                                            </ul>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <!-- Client and Payment Details -->
                        <div class="invoice-details">

                            <div class="invoice-client-info">
                                <strong>{!! trans('messages.feesBills.client') !!}</strong>
                                <ul class="list-unstyled">
                                    @if($bill->property_unit)
                                        @if($bill->property_unit->address != null)
                                            <li>
                                                {!! $bill->property_unit->{'owner_name_'.$lang} !!} <br>
                                                <span style="white-space: pre">{!! $bill->property_unit->address !!}</span>
                                            </li>
                                        @else
                                            <li>
                                                @if( $bill->property_unit->{'owner_name_'.$lang} )
                                                    {!! $bill->property_unit->{'owner_name_'.$lang} !!}<br>
                                                @else
                                                    @if($bill->payer_name)
                                                        {!! $bill->payer_name !!}<br>
                                                    @else
                                                        @if($bill->property->property_type == 1)
                                                            {!! trans('messages.feesBills.owner_home') !!}<br>
                                                        @elseif($bill->property->property_type == 2 || $bill->property->property_type == 3)
                                                            {!! trans('messages.feesBills.owner_room') !!}<br>
                                                        @else
                                                            {!! trans('messages.feesBills.owner_other') !!}<br>
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
                                                {!!

                                                    trans('messages.AboutProp.address_no')." ".
                                                    $bill->property_unit->unit_number." ".$building." ".$unit_floor.
                                                    (($bill->property_unit->unit_soi != null || $bill->property_unit->unit_soi != "") ? trans('messages.Prop_unit.unit_soi')." ". $bill->property_unit->unit_soi : "")." ".
                                                    $bill->property->{'property_name_'.$lang}." ".
                                                    $bill->property->{'address_'.$lang}
                                                !!}

                                                {!! $bill->property->has_province->{'name_'.$lang }." ".$bill->property->postcode !!}
                                            </li>
                                        @endif
                                        <li>
                                            {!! trans('messages.tel') !!} {!! (is_null($bill->property_unit->phone) || $bill->property_unit->phone == "" ? "-" : $bill->property_unit->phone) !!}
                                        </li>
                                    @else
                                        <li>
                                            {!! nl2br(e($bill->payer_name)) !!}
                                        </li>
                                    @endif
                                </ul>
                            </div>

                            @if($bill->payment_status > 0)
                                @if($bill->payment_status != 4)
                                    <div class="invoice-payment-info text-right">
                                        <strong>{!! trans('messages.feesBills.payment_detail') !!}</strong>
                                        <ul class="list-unstyled">
                                            <li class="upper"> {!! trans('messages.feesBills.payment_type') !!} :
                                                <strong>
                                                    @if($bill->payment_type == 1) {!! trans('messages.feesBills.cash') !!}
                                                    @else {!! trans('messages.feesBills.transfer') !!}
                                                    @endif
                                                </strong>
                                            </li>
                                        </ul>
                                    </div>
                                @endif
                            @endif
                        </div>

                        <!-- Invoice Entries -->
                        <div class="table-responsive">
                            @include('invoice.admin-invoice-detail-table')
                        </div>

                        <!-- Invoice Subtotals and Totals -->
                        <div class="invoice-totals">
                            <div class="invoice-subtotals-totals">
                                <span>
                                    {!! trans('messages.feesBills.sub_total') !!} :
                                    <strong>
                                    <span id="bill-sub-total-label" style="display:inline;">{!! number_format($bill->total-$sum_instalment, 2)!!}</span>
                                        {!! trans('messages.Report.baht') !!}
                                    </strong>
                                </span>
                                @if($bill->discount > 0)
                                    <span>
                                    {!! trans('messages.feesBills.discount') !!} :
                                    <strong>{!!number_format($bill->discount, 2)." ".trans('messages.Report.baht') !!}</strong>
                                </span>
                                @endif
                                @if($bill->sub_from_balance > 0)
                                    <span>
                                    @if( !$bill->is_common_fee_bill)
                                            {!! trans('messages.feesBills.substract') !!} :
                                        @else
                                            {!! trans('messages.feesBills.prepaid_balance') !!} :
                                        @endif
                                        <strong>{!!number_format($bill->sub_from_balance, 2)." ".trans('messages.Report.baht') !!}</strong>
                                </span>
                                @endif
                                <hr />
                            </div>
                        </div>
                        <?php $_total = $bill->final_grand_total-$sum_instalment; ?>
                        <div class="g-block-left text-right">
                            (<span class='total-read'>
                            @if( $lang == "en" )
                                    {!! convertIntToTextEng($_total) !!}
                                @else
                                    {!! convertIntToTextThai($_total) !!}
                                @endif
                        </span>)

                        </div>
                        <div class="g-total-block text-right">
                            <span>
                                {!! trans('messages.feesBills.grand_total') !!} :
                                <strong class="g-total-invoice">
                                    <span id="bill-final-total-label">{!! number_format($_total, 2) !!}</span> {!!trans('messages.Report.baht') !!}
                                </strong>
                            </span>
                        </div>
                    </section>
                </div>
                <hr/>
                <?php
                // set maximum instalment payment amount
                $max_ins = $_total;
                ?>
                @if($bill->payment_status != 4)
                    @if($bill->remark)
                        <div class="row remark-row" style="margin-bottom:20px;">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        *{!! displayTextAreaVal($bill->remark) !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @elseif ($bill->cancelled_at)
                    <div class="row remark-row">
                        <div class="col-md-12">
                            <div>{!! trans('messages.feesBills.cancelled_at') !!} : {!! localDate($bill->cancelled_at) !!}</div>
                            <div>{!! trans('messages.feesBills.cancelled_by') !!} : {!! $bill->cancelledBy->name !!}</div>
                            <div>
                                {!! trans('messages.feesBills.cancel_reason') !!} :
                                {!! $bill->cancel_reason !!}
                            </div>
                        </div>
                    </div>
                @endif

                <div class="row payment-evidence">
{{--                    @if($bill->payment_status < 2)--}}
                        <div class="col-sm-12 text-right">
{{--                            <button class="btn btn-warning" type="reset">ยกเลิก</button>--}}
{{--                            <button class="btn btn-primary" type="submit">บันทึก</button>--}}
{{--                            <a href="{!!url('admin/fees-bills/invoice')!!}" class="btn btn-white">{!! trans('messages.back') !!}</a>--}}
{{--                            <a href="{!!url('admin/fees-bills/invoice/create-receipt/'.$bill->id)!!}" class="btn btn-primary change-bill-status" data-status="2">สร้างใบเสร็จรับเงิน</a>--}}
                        </div>
{{--                    @endif--}}
                </div>
                @if($bill->instalmentLog->count())
                    <div class="row">
                        <div class="col-md-12">
                            <hr class="hidden-print"/>
                            <h3>{!! trans('messages.feesBills.instalment_log')!!}</h3>
                        </div>
                        <div class="col-md-12">
                            <div class="table-responsive dataTables_wrapper">
                                <table class="general-table">
                                    <tr>
                                        <th>{!! trans('messages.feesBills.log_order')!!}</th>
                                        <th>{!! trans('messages.feesBills.log_title')!!}</th>
                                        <th>{!! trans('messages.feesBills.create_date')!!}</th>
                                        <th>{!! trans('messages.feesBills.log_receipt_no')!!}</th>
                                        <th>{!! trans('messages.Fund.amount') !!}</th>
                                    </tr>
                                    <?php $sum = 0; ?>
                                    @foreach($bill->instalmentLog as $no => $log)
                                        <?php $sum += $log->amount; ?>
                                        <tr>
                                            <td class="text-center">{!! $no+1 !!}</td>
                                            <td>{!! $log->title !!}</td>
                                            <td class="text-center">{!! localDate($log->created_at) !!}</td>
                                            <td class="text-center">
                                                    @if($log->receipt_no_label == null)
                                                        {!!NB_RECEIPT.invoiceNumber($log->receipt_no)!!}
                                                    @else
                                                        {!!$log->receipt_no_label!!}
                                                    @endif
                                                </td>
                                            <td class="text-right">{!! number_format($log->amount,2)." ".trans('messages.Report.baht') !!}</td>
                                        </tr>
                                    @endforeach
                                    <?php
                                    $date = date('Y-m-01',strtotime($log->to_date));
                                    $next_month = strtotime('+1 month',strtotime($date));
                                    $latest_month = date('m',$next_month);
                                    $latest_year = date('Y',$next_month);
                                    ?>
                                    <tr>
                                        <td class="text-right" colspan="4">{!! trans('messages.PettyCash.total') !!}</td>
                                        <td class="text-right">{!! number_format($sum,2)." ".trans('messages.Report.baht') !!}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right" colspan="4">{!! trans('messages.feesBills.total_remain') !!}</td>
                                        <td class="text-right">{!! number_format($bill->final_grand_total,2)." ".trans('messages.Report.baht') !!}</td>
                                    </tr>
                                    <tr>
                                        <?php $remaining_total = $bill->final_grand_total - $sum; ?>
                                        <td class="text-right" colspan="4">
                                            {!! trans('messages.feesBills.remain') !!}
                                        </td>
                                        <td class="text-right">
                                            @if($remaining_total >= 0)
                                                {!! number_format(($remaining_total),2)." ".trans('messages.Report.baht') !!}
                                            @else
                                                {!! number_format(0,2)." ".trans('messages.Report.baht') !!}<br/>
                                                {!! '('.trans('messages.feesBills.paid_over')." ".number_format(abs($remaining_total),2)." ".trans('messages.Report.baht').")" !!}
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <hr/>
                        </div>
                    </div>
                @endif
            </div>
        </section>
    </div>
    @if($bill->payment_status != 3)
        <div class="modal fade" id="change-rejected-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">{!! trans('messages.feesBills.confirm_change_head') !!}</h4>
                    </div>
                    <form method="post" id="submit-reject-status-form" class="form-horizontal" action="{!!url('admin/fees-bills/status')!!}">
                        <div class="modal-body">
                            {!! trans('messages.feesBills.confirm_change_msg') !!} "{!! trans('messages.feesBills.rejected') !!}" {!! trans('messages.feesBills.rejected_label') !!}
                            <div class="form-group">
                                <div class="col-sm-12" style="margin-top:10px;">
                                    {!! Form::textarea('reject-remark',null,array('class'=>'form-control','maxlength'=>1000,'placeholder'=>trans('messages.feesBills.remark'),'rows'=>4)) !!}
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="status" id="b-status" value="3"/>
                        <input type="hidden" name="bid" value="{!!$bill->id!!}"/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
                            <button type="button" class="btn btn-primary" id="submit-reject-status">{!! trans('messages.confirm') !!}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="cancel-invoice-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">{!! trans('messages.feesBills.confirm_cancel_head') !!}</h4>
                    </div>
                    <form method="post" id="cancel-invoice-form" action="{!!url('admin/fees-bills/cancel')!!}">
                        <div class="modal-body">
                            {!! trans('messages.feesBills.confirm_cancel_msg') !!}
                            <div style="margin-top: 5px;">
                                {!! Form::textarea('reason',null,['class' => 'form-control','rows' => 3,'id' => 'cancel-invoice-reason']) !!}
                            </div>
                        </div>
                        <input type="hidden" name="bid" value="{!!$bill->id!!}"/>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
                            <button type="button" class="btn btn-primary" id="cancel-invoice-btn">{!! trans('messages.confirm') !!}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <input id="lang_session" type="hidden" value="{!! App::getLocale() !!}"/>
    <div class="modal fade" id="confirm-copy-invoice-print-modal" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa-paper"></i> {!! trans('messages.print') !!}</h4>
                </div>
                <div class="modal-body">
                    {!! Form::checkbox('original-print-flag','yes', true,['class'=>'cbr cbr-replaced cbr-turquoise','id'=>'original-print-flag']) !!} {!! trans('messages.original') !!}

                    {!! Form::checkbox('copy-print-flag','yes', true,['class'=>'cbr cbr-replaced cbr-turquoise','id'=>'copy-print-flag']) !!} {!! trans('messages.copy') !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary print-invoice" data-dismiss="modal">{!! trans('messages.ok') !!}</button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
                </div>
            </div>
        </div>
    </div>
    <form action="{!! url('admin/fees-bills/invoice/print-invoice-list' ) !!}" method="POST" target="_blank" id="print-bill-list">
        <input type="hidden" name="list-bill" id="list-bill" value="{!! $bill->id !!}">
        <input type="hidden" name="original-print" id="original-print" value="true">
        <input type="hidden" name="copy-print" id="copy-print" value="true">
        <input type="hidden" name="add-fine-print" id="add-fine-print" value="true">
    </form>

@section('script')
    <script>
        $(function () {
            $('.print-invoice').on('click',function () {
                if($("#original-print-flag").is(':checked')) {
                    $('#original-print').val('true');
                    $('#print-origin-element').removeClass('hidden-print');
                }
                else {
                    $('#original-print').val('false');
                    $('#print-origin-element').addClass('hidden-print');
                }

                if($("#copy-print-flag").is(':checked')) {
                    $('#copy-print').val('true');
                    $('#print-copy-element').removeClass('hidden-print');
                }
                else {
                    $('#copy-print').val('false');
                    $('#print-copy-element').addClass('hidden-print');
                }

                //print-invoice
                $('#list-bill').val();
                $('#confirm-copy-invoice-print-modal').modal('hide');
                $('#print-bill-list').submit();
            });

            @if(Auth::user()->role == 1 || Auth::user()->role == 3)
            $('#submit-reject-status').on('click', function () {
                $('#submit-reject-status-form').submit();
                $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
            });
            $('#cancel-invoice-btn').on('click', function () {
                var r_box = $('#cancel-invoice-reason');
                if(r_box.val() == "") {
                    r_box.addClass('error');
                } else {
                    r_box.removeClass('error');
                    $('#cancel-invoice-form').submit();
                    $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
                }
            });
            @endif
        })
    </script>
@endsection
