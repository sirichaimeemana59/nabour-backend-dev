<table class="table table-bordered" id="itemsTable">
    <tr>
        @if($cal_cf_fine_flag || $cal_cf_house_fine_flag || $cal_normal_bill_fine_flag)
            <th class="fine-row hidden-print" width="22px"></th>
        @endif
        <th class="text-center hidden-xs">#</th>
        <th class="text-center" style="width: *">{{ trans('messages.detail') }}</th>
        <th class="text-center" style="width: 20%">{{ trans('messages.category') }}</th>
        <th class="text-center" style="width: 13%">{{ trans('messages.feesBills.quantity') }}</th>
        <th class="text-center" style="width: 13%">{{ trans('messages.feesBills.per_piece') }}</th>
        <th class="text-center" >{{ trans('messages.feesBills.total') }}</th>
        <th class="text-center" >Delete</th>
    </tr>

    <?php $i = $total = 0; ?>
    @foreach($bill->transaction as $transaction)
        @if($transaction->transaction_type != 3 && $transaction->transaction_type != 4)
            <tr>
                @if($cal_cf_fine_flag || $cal_cf_house_fine_flag || $cal_normal_bill_fine_flag)
                    <td class="fine-row hidden-print"></td>
                @endif
                <?php if($transaction->category == 1) $per_unit = $transaction->price; ?>
                <td class="text-center hidden-xs">{{ ++$i }}</td>
                <td style="text-align: left;">{{ $transaction->detail }}</td>
                <td class="text-center">{{ $cate[$transaction->category] }}</td>
                <td class="text-center">{{ $transaction->quantity }}</td>
                <td class="text-right">{{ displayPrice($transaction->price) }}</td>
                <td class="text-right text-primary text-bold">{{ number_format($transaction->total, 2) }}</td>
                    @if($transaction->category == 7)
                        <td class="text-right text-primary text-bold"><button class="btn btn-danger delete_tran" data-id="{!! $transaction->id !!}">Delete</button></td>
                        @else
                        <td class="text-right text-primary text-bold">-</td>
                    @endif
            </tr>
        @endif
    @endforeach
    @if($cal_cf_fine_flag)
        <tr class="fine-row" style="vertical-align: middle;">
            <td class="hidden-print" style="vertical-align: middle;"><i class="fa-trash cancel-fine"></i></td>
            <td class="text-center hidden-xs" style="vertical-align: middle;">{{ ++$i }}</td>
            <td style="vertical-align: middle;text-align: left;">{{ trans('messages.feesBills.cf_fine_text') }} ( {!! '<span id="fine-rate-label">'.$fine_rate.'</span>' !!}% ) </td>
            <td class="text-center" style="vertical-align: middle;">{{ trans('messages.feesBills.fine_text') }} </td>
            <td class="text-center" style="padding: 1px; vertical-align: middle;">
                <label id="multiplier-label">{{ $fine_multiply }}</label>
            </td>
            <td class="text-right">
                <input type="text" id="input-fine-price" class="form-control input-sm text-right" value="{{ $fine_amount }}"/>
            </td>
            <td class="text-right text-primary text-bold" style="vertical-align: middle;">
                <span id="fine-total">{{ number_format($total_fine, 2) }}</span>
            </td>
        </tr>
    @elseif($cal_cf_house_fine_flag)
        <tr class="fine-row">
            <td class="hidden-print"><i class="fa-trash cancel-fine"></i></td>
            <td class="text-center hidden-xs">{{ ++$i }}</td>
            <td class="text-left">{{ trans('messages.feesBills.cf_fine_text') }} ( {{ number_format($bill->property->settings->housing_estate_fine_rate,2) }}% )</td>
            <td class="text-center">{{ trans('messages.feesBills.fine_text') }} </td>
            <td class="text-center">
                <input type="hidden" id="input-fine-amount" class="form-control input-sm text-center" value="{{ $fine_amount }}"/> <span id="fine-total-label">{{ number_format($fine_amount,2) }}</span>
            </td>
            <td class="text-right">
                <span id="fine-value-label">{{ number_format($fine_rate,2) }}</span>
            </td>
            <td class="text-right text-primary text-bold">
                <span id="fine-total">{{ number_format($total_fine, 2) }}</span>
            </td>
        </tr>
    @elseif($cal_normal_bill_fine_flag)

        <tr class="fine-row">
            <td class="hidden-print"><i class="fa-trash cancel-fine"></i></td>
            <td class="text-center hidden-xs">{{ ++$i }}</td>
            <td  style="padding: 1px;"><input type="text" id="input-fine-text" class="form-control input-sm"/></td>
            <td class="text-center">{{ trans('messages.feesBills.fine') }}</td>
            <td class="text-center" style="padding: 1px;">
                <input type="text" id="input-fine-amount" class="form-control input-sm text-center" value="0"/>
            </td>
            <td class="text-right" style="padding: 1px;">
                <input type="text" id="input-fine-price" class="form-control input-sm text-right" value="0.00"/>
            </td>
            <td class="text-right text-primary text-bold">
                <span id="fine-total">0.00</span>
            </td>
        </tr>
    @endif
</table>
