@if( $quotations->count() )
    <?php
    $from   = (($quotations->currentPage()-1)*$quotations->perPage())+1;
    $to     = (($quotations->currentPage()-1)*$quotations->perPage())+$quotations->perPage();
    $to     = ($to > $quotations->total()) ? $quotations->total() : $to;
    $allpage 	= $quotations->lastPage();
    ?>

    <div class="row">
        <div class="col-md-4" style="margin-bottom: 10px;">
            <div class="dataTables_info" role="status" aria-live="polite" style="padding:0 0 10px 0;">
                {!! trans('messages.showing',['from'=>$from,'to'=>$to,'total'=>$quotations->total()]) !!}
            </div>
        </div>
        <div class="col-md-8">
            <div class="text-right" >
                <div class="invoice-options hidden-print option-top-md">
                    @if($allpage > 1)
                        @if($quotations->currentPage() > 1)
                            <a class="btn btn-white paginate-link" href="#" data-page="{{ $quotations->currentPage()-1 }}">{{ trans('messages.prev') }}</a>
                        @endif
                        @if($quotations->lastPage() > 1)
                            <?php echo Form::selectRange('page', 1, $quotations->lastPage(),$quotations->currentPage(),['class'=>'form-control paginate-select']); ?>
                        @endif
                        @if($quotations->hasMorePages())
                            <a class="btn btn-white paginate-link" href="#" data-page="{{ $quotations->currentPage()+1 }}">{{ trans('messages.next') }}</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th width="160px">เลขที่ใบเสนอราคา</th>
            <th width="*">Leads</th>
            <th width="180px">ราคาสุทธิ</th>
            <th width="160px">สถานะ</th>
            <th width="215px">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($quotations as $row)
        <tr>
            <td>{!! $row->quotation_code !!}</td>
            <td>{!! $row->latest_lead->firstname." ".$row->latest_lead->lastname !!}</td>
            <td class="text-right">{!! number_format($row->product_price_with_vat,2) !!}</td>
            @if(!empty($row->latest_contract->id))
                <td>{!! $row->latest_contract->contract_code !!}</td>
            @else
                <td>ไม่มีข้อมูลสัญญา</td>
            @endif
            <td class="action-links">
                <a href="{!! url('service/sales/contract/sign/form/'.$row->id) !!}" class="edit edit-service btn btn-success"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="ออกสัญญา">
                    <i class="fa-check"></i>
                </a>
                <a href="{!! url('service/quotation/print_quotation/'.$row->id) !!}" class="edit edit-service btn btn-info"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="พิมพ์ใบเสนอราคา" target="_blank">
                    <i class="fa-print"></i>
                </a>

                {{--<a href="#" class="btn btn-danger view-member"  data-toggle="tooltip" data-placement="top" data-original-title="ลบ">--}}
                    {{--<i class="fa-trash"></i>--}}
                {{--</a>--}}
                <a href="#" class="view-quotation btn btn-info"  data-toggle="modal" data-target="#view-quotaion" data-placement="top" data-original-title="{{ trans('messages.detail') }}" data-q-id="{!!$row->quotation_code!!}" >
                    <i class="fa-eye"></i>
                </a>
                @if(empty($row->latest_contract->quotation_id))
                    <a href="{!! url('service/sales/quotation/update/form/'.$row->id) !!}" class="edit edit-service btn btn-warning"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="แก้ไข">
                        <i class="fa-pencil-square-o"></i>
                    </a>
                    <a href="#" class="view-quotation btn btn-danger"  data-toggle="modal" data-target="#delete" data-placement="top" data-original-title="{{ trans('messages.delete') }}" onclick="mate_del('{!!$row->id!!}')" >
                        <i class="fa-trash"></i>
                    </a>
                @endif
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>

    <div class="row">
        <div class="col-md-4" style="margin-bottom: 10px;">
            <div class="dataTables_info" role="status" aria-live="polite" style="padding:0 0 10px 0;">
                {!! trans('messages.showing',['from'=>$from,'to'=>$to,'total'=>$quotations->total()]) !!}
            </div>
        </div>
        <div class="col-md-8">
            <div class="text-right" >
                <div class="invoice-options hidden-print option-top-md">
                    @if($allpage > 1)
                        @if($quotations->currentPage() > 1)
                            <a class="btn btn-white paginate-link" href="#" data-page="{{ $quotations->currentPage()-1 }}">{{ trans('messages.prev') }}</a>
                        @endif
                        @if($quotations->lastPage() > 1)
                            <?php echo Form::selectRange('page', 1, $quotations->lastPage(),$quotations->currentPage(),['class'=>'form-control paginate-select']); ?>
                        @endif
                        @if($quotations->hasMorePages())
                            <a class="btn btn-white paginate-link" href="#" data-page="{{ $quotations->currentPage()+1 }}">{{ trans('messages.next') }}</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

@else
<div class="row">
    <div class="col-sm-12 text-center">
        ไม่พบข้อมูล
    </div>
</div>
@endif