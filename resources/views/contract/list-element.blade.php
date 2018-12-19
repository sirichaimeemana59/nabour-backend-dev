@if( $contracts ->count())
<?php
    $from   = (($contracts->currentPage()-1)*$contracts->perPage())+1;
    $to     = (($contracts->currentPage()-1)*$contracts->perPage())+$contracts->perPage();
    $to     = ($to > $contracts->total()) ? $contracts->total() : $to;
    $allpage 	= $contracts->lastPage();
?>

<div class="row">
    <div class="col-md-4" style="margin-bottom: 10px;">
        <div class="dataTables_info" role="status" aria-live="polite" style="padding:0 0 10px 0;">
            {!! trans('messages.showing',['from'=>$from,'to'=>$to,'total'=>$contracts->total()]) !!}
        </div>
    </div>
    <div class="col-md-8">
        <div class="text-right">
            <div class="invoice-options hidden-print option-top-md">
                @if($allpage > 1)
                    @if($contracts->currentPage() > 1)
                        <a class="btn btn-white paginate-link" href="#" data-page="{{ $contracts->currentPage()-1 }}">{{ trans('messages.prev') }}</a>
                    @endif
                    @if($contracts->lastPage() > 1)
                        <?php echo Form::selectRange('page', 1, $contracts->lastPage(),$contracts->currentPage(),['class'=>'form-control paginate-select']); ?>
                    @endif
                    @if($contracts->hasMorePages())
                        <a class="btn btn-white paginate-link" href="#" data-page="{{ $contracts->currentPage()+1 }}">{{ trans('messages.next') }}</a>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

<table class="table table-bordered table-striped">
    <thead>
    <tr>
        <th>เลขที่สัญญา</th>
        <th>ลูกค้า</th>
        <th>Sales</th>
        <th>วันที่เริ่ม</th>
        <th>วันที่สิ้นสุด</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($contracts as $row)
    <tr>
        <td>{!! $row->contract_code !!}</td>
        <td>{!! $row->customer->company_name !!}</td>
        <td>{!! $row->latest_sale->name !!}</td>
        <td>{!! $row->start_date !!}</td>
        <td>{!! $row->end_date !!}</td>
        <td> Action </td>
    </tr>
    @endforeach
    </tbody>
</table>

<div class="row">
    <div class="col-md-4" style="margin-bottom: 10px;">
        <div class="dataTables_info" role="status" aria-live="polite" style="padding:0 0 10px 0;">
            {!! trans('messages.showing',['from'=>$from,'to'=>$to,'total'=>$contracts->total()]) !!}
        </div>
    </div>
    <div class="col-md-8">
        <div class="text-right" >
            <div class="invoice-options hidden-print option-top-md">
                @if($allpage > 1)
                    @if($contracts->currentPage() > 1)
                        <a class="btn btn-white paginate-link" href="#" data-page="{{ $contracts->currentPage()-1 }}">{{ trans('messages.prev') }}</a>
                    @endif
                    @if($contracts->lastPage() > 1)
                        <?php echo Form::selectRange('page', 1, $contracts->lastPage(),$contracts->currentPage(),['class'=>'form-control paginate-select']); ?>
                    @endif
                    @if($contracts->hasMorePages())
                        <a class="btn btn-white paginate-link" href="#" data-page="{{ $contracts->currentPage()+1 }}">{{ trans('messages.next') }}</a>
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
<?php
/*
         <div class="col-sm-4">
    <div class="well">
       <p>เลขที่ใบเสนอราคา :  {!!$row->quotation_code!!}</p>
        <p>Package : </p>
        <p>ราคาสุทธิ : </p>
        <br>
        <div style="text-align: right;">
            @if($row->status !=1)
            @if($row->remark == 0 )
            <a href="{!! url('service/quotation/check/quotation/'.$row->quotation_code.'/'.$row->lead_id) !!}" class="edit edit-service btn btn-success"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="ใช้ใบเสนอราคา">
                <i class="fa-check"></i>
            </a>
            @endif

            @if($row->remark == 1)
            <a href="{!! url('service/quotation/check_out/quotation/'.$row->quotation_code.'/'.$row->lead_id) !!}" class="edit edit-service btn btn-danger"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="ยกเลิกใบเสนอราคา">
               <i class="fa-close"></i>
            </a>
            <a href="{!! url('service/quotation/print_quotation/'.$row->quotation_code) !!}" class="edit edit-service btn btn-info"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="พิมพ์ใบเสนอราคา">
                <i class="fa-print"></i>
            </a>
                @else
                    <a href="{!! url('service/quotation/update/form/'.$row->quotation_code) !!}" class="edit edit-service btn btn-warning"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="แก้ไข">
                        <i class="fa-pencil-square-o"></i>
                    </a>
                    <a href="#" class="btn btn-danger view-member"  data-toggle="tooltip" data-placement="top" data-original-title="ลบ">
                        <i class="fa-trash"></i>
                    </a>
            @endif

            @endif
                <a href="#" class="edit edit-service btn btn-info view-member"  data-toggle="modal" data-target="#edit-package" data-placement="top" data-original-title="{{ trans('messages.detail') }}" data-vehicle-id="{!!$row->quotation_code!!}" >
                    <i class="fa-eye"></i>
                </a>
        </div>
    </div>
</div>
         */ ?>