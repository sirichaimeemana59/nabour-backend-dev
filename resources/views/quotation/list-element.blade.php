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
            <th width="7%">เลขที่</th>
            <th width="160px">เลขที่ใบเสนอราคา</th>
            <th width="*">Leads</th>
            <th width="200px">Sales</th>
            <th width="180px">ราคาสุทธิ</th>
            <th width="180px">เลขที่สัญญา</th>
            <th width="215px">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php
            $i=1;
        ?>
        @foreach($quotations as $row)
        <tr>
            <td>{!! $i; !!}</td>
            <td>{!! $row->quotation_code !!}</td>
            @if($row->latest_customer)
                <td>{!! $row->latest_customer->firstname." ".$row->latest_customer->lastname !!}</td>
            @else
                <td>ไม่พบข้อมูล</td>
            @endif

            @if(!empty($row->latest_sale->name))
                <td>{!!$row->latest_sale->name!!}</td>
            @else
                <td>ไม่พบข้อมูล</td>
            @endif
            <td class="text-right">{!! number_format($row->product_price_with_vat,2) !!}</td>
            @if(!empty($row->latest_contract->id))
                    <td>{!! $row->latest_contract->contract_code !!}</td>
                @else
                    <td>ไม่มีข้อมูลสัญญา</td>
            @endif

            <?php
            if(!empty($row->latest_contract->quotation_id) OR empty($row->latest_sale->name) OR empty($row->latest_customer)){
                $disable='disabled';
            }else{
                $disable='';
            }
            ?>
            <td class="action-links">
                <a href="{!! url('customer/service/contract/sign/form/'.$row->id) !!}" {!! $disable !!} class="edit edit-service btn btn-success"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="ออกสัญญา">
                    <i class="fa-check"></i>
                </a>
                <a href="{!! url('service/quotation/print_quotation/'.$row->id) !!}" {!! $disable !!} class="edit edit-service btn btn-info"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="พิมพ์ใบเสนอราคา" target="_blank">
                    <i class="fa-print"></i>
                </a>
                <a href="{!! url('customer/service/quotation/update/form/'.$row->id) !!}" {!! $disable !!} class="edit edit-service btn btn-warning"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="แก้ไข">
                    <i class="fa-pencil-square-o"></i>
                </a>
                <a href="#" class="view-quotation btn btn-info view-quotaion"  data-toggle="tooltip"  data-placement="top" data-q-id="{!!$row->quotation_code!!}"  data-original-title="ดูใบเสนอราคา">
                     <i class="fa-eye"></i>
                </a>
                <a href="#" class="view-quotation btn btn-danger delete" {!! $disable !!}  data-toggle="tooltip" data-placement="top"   data-id="{!! $row->id !!}" data-original-title="{!! trans('messages.delete') !!}">
                    <i class="fa-trash"></i>
                </a>
            </td>
        </tr>
            <?php
                $i++;
            ?>
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