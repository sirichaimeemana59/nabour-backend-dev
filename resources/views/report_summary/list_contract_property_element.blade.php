<form method="POST" action="{!! url('report_admin/report_summary_excel') !!}" accept-charset="UTF-8" class="form-horizontal">
    <input type="hidden" name="c_no" value="{!! $c_no !!}">
    <input type="hidden" name="customer_id" value="{!! $customer_id !!}">

    <button type="submit"  class="btn btn-info btn-primary action-float-right"><i class="fa fa-download"> </i> ดาวน์โหลด</button>
</form>
<br><br><br>
<?php
$from=0;
$to=0;
$allpage=0;
?>
@if($p_rows->count() > 0)
    <?php
    $from   = (($p_rows->currentPage()-1)*$p_rows->perPage())+1;
    $to     = (($p_rows->currentPage()-1)*$p_rows->perPage())+$p_rows->perPage();
    $to     = ($to > $p_rows->total()) ? $p_rows->total() : $to;
    $allpage 	= $p_rows->lastPage();
    ?>

    <div class="row">
        <div class="col-md-4" style="margin-bottom: 10px;">
            <div class="dataTables_info" role="status" aria-live="polite" style="padding:0 0 10px 0;">
                {!! trans('messages.showing',['from'=>$from,'to'=>$to,'total'=>$p_rows->total()]) !!}
            </div>
        </div>
        <div class="col-md-8">
            <div class="text-right" >
                <div class="invoice-options hidden-print option-top-md">
                    @if($allpage > 1)
                        @if($p_rows->currentPage() > 1)
                            <a class="btn btn-white paginate-link" href="#" data-page="{{ $p_rows->currentPage()-1 }}">{{ trans('messages.prev') }}</a>
                        @endif
                        @if($p_rows->lastPage() > 1)
                            <?php echo Form::selectRange('page', 1, $p_rows->lastPage(),$p_rows->currentPage(),['class'=>'form-control paginate-select']); ?>
                        @endif
                        @if($p_rows->hasMorePages())
                            <a class="btn btn-white paginate-link" href="#" data-page="{{ $p_rows->currentPage()+1 }}">{{ trans('messages.next') }}</a>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
<p class="keyword"></p>
    <table class="table table-bordered table-striped">
        <thead>
        <tr>
            <th width="7%">เลขที่</th>
            <th width="140px">เลขที่สัญญา</th>
            <th width="*">ชื่อโครงการนิติบุคคลอาคารชุด</th>
            <th width="150px">วันที่ขึ้นระบบ</th>
            <th width="150px">วันที่สิ้นสุด</th>
            <th width="150px">วันที่เริ่มรอบบิล</th>
            <th width="150px">ลักษณะการใช้งาน</th>
            <th width="160px">ค่าบริการ (รายเดือน)</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $i=1;
        ?>
        @foreach($p_rows as $row)
            <tr>
                <td>{!! $i; !!}</td>
                <td>{!! $row->contract_id !!}</td>
                @if(!empty($row->latest_property))
                    <td>{!!$row->latest_property->property_name_th!!}</td>
                @else
                    <td>ไม่พบข้อมูล</td>
                @endif

                <td>@if(empty($row->start_date)) - @else {!! localDate($row->start_date) !!} @endif</td>
                <td>@if(empty($row->end_date)) - @else {!! localDate($row->end_date) !!} @endif</td>
                <td>{!! localDate(Date('y-m-d')) !!}</td>

                <td></td>
                <td style="text-align: right;">@if(empty($row->latest_contract)) - @else <?php $sum = $row->latest_contract->latest_quotation->product_price_with_vat+ $row->latest_contract->latest_quotation->product_vat+ $row->latest_contract->latest_quotation->grand_total_price;?>{!! number_format($sum,2) !!} @endif</td>
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
                {!! trans('messages.showing',['from'=>$from,'to'=>$to,'total'=>$p_rows->total()]) !!}
            </div>
        </div>
        <div class="col-md-8">
            <div class="text-right" >
                <div class="invoice-options hidden-print option-top-md">
                    @if($allpage > 1)
                        @if($p_rows->currentPage() > 1)
                            <a class="btn btn-white paginate-link" href="#" data-page="{{ $p_rows->currentPage()-1 }}">{{ trans('messages.prev') }}</a>
                        @endif
                        @if($p_rows->lastPage() > 1)
                            <?php echo Form::selectRange('page', 1, $p_rows->lastPage(),$p_rows->currentPage(),['class'=>'form-control paginate-select']); ?>
                        @endif
                        @if($p_rows->hasMorePages())
                            <a class="btn btn-white paginate-link" href="#" data-page="{{ $p_rows->currentPage()+1 }}">{{ trans('messages.next') }}</a>
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