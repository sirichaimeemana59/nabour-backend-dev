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
        <?php $i = $total = $vat = $wvat = 0; ?>
        @foreach($bill->transaction as $key => $transaction)
        @if($transaction->transaction_type != 5 && $transaction->transaction_type != 6)
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
        @else
            <input type="hidden" name="transaction[{{ $key }}][id]" value="{{ $transaction->id }}" />
            <input type="hidden" name="transaction[{{ $key }}][detail]" value="{{ $transaction->detail }}" />
        @endif
        <?php 
            if($transaction->transaction_type == 5) $vat = $transaction->total;
            if($transaction->transaction_type == 6) $wvat = $transaction->total;
        ?>
        @endforeach
         </tbody>
    </table>
@if($bill->tax > 0)
<span class="field-hint vat-mark">{{ trans('messages.feesBills.vat_marked') }}</span>
@endif

<!-- Invoice Subtotals and Totals -->
<div class="invoice-totals">
    <div class="invoice-subtotals-totals">
    <span>
        {{ trans('messages.feesBills.sub_total') }}:
        <strong>{{ number_format($bill->total, 2)." ".trans('messages.Report.baht') }}</strong>
    </span>
    @if( $bill->tax > 0)
    <span>
        {{ trans('messages.feesBills.vat')." ".number_format($bill->tax) ."%" }}:
        <strong class="g-total-invoice">{{ number_format($vat,2)." ".trans('messages.Report.baht')  }}</strong>
    </span>
    @endif
    @if( $bill->withholding_tax > 0)
    <span>
        {{ trans('messages.feesBills.withholding_tax')." ".number_format($bill->withholding_tax) ."%" }}:
        <strong class="g-total-invoice">{{ number_format($wvat,2)." ".trans('messages.Report.baht') }}</strong>
    </span>
    @endif
    <hr />
    </div>
</div>
<div class="g-block-left text-right">
        @if( $lang == "en" )
            {{ "( ".convertIntToTextEng($bill->grand_total)." )" }}
        @else
            {{ "( ".convertIntToTextThai($bill->grand_total)." )" }}
        @endif
</div>
<div class="g-total-block text-right">
    <span>
        {{ trans('messages.feesBills.grand_total') }}:
        <strong class="g-total-invoice">{{ number_format($bill->grand_total, 2)." ".trans('messages.Report.baht') }}</strong>
    </span>
</div>
    