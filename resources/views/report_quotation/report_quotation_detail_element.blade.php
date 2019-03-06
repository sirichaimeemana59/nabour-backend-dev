<?php
$from=0;
$to=0;
$allpage=0;
?>
@if($p_rows->count() > 0)
    <?php
    $to   	= $p_rows->total() - (($p_rows->currentPage())*$p_rows->perPage());
    $to     = ($to > 0) ? $to : 1;
    $from   = $p_rows->total() - (($p_rows->currentPage())*$p_rows->perPage())+$p_rows->perPage();
    $allpage = $p_rows->lastPage();
    ?>

    <div class="panel-body member-list-content">
        <div class="tab-pane active" id="member-list">
            <div id="member-list-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="dataTables_info" id="example-1_info" role="status" aria-live="polite">
                            {!! trans('messages.showing',['from'=>$from,'to'=>$to,'total'=>$p_rows->total()]) !!}<br/><br/>
                        </div>
                    </div>

                    @if($allpage > 1)
                        <div class="col-md-6 text-right">
                            <div class="dataTables_paginate paging_simple_numbers" >
                                @if($p_rows->currentPage() > 1)
                                    <a class="btn btn-white p-paginate-link paginate-link" href="#" data-page="{!! $p_rows->currentPage()-1 !!}">{!! trans('messages.prev') !!}</a>
                                @endif
                                @if($p_rows->lastPage() > 1)
                                    <?php echo Form::selectRange('page', 1, $customer->lastPage(),$p_rows->currentPage(),['class'=>'form-control p-paginate-select paginate-select']); ?>
                                @endif
                                @if($p_rows->hasMorePages())
                                    <a class="btn btn-white p-paginate-link paginate-link" href="#" data-page="{!! $p_rows->currentPage()+1 !!}">{!! trans('messages.next') !!}</a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
                <table class="table table-bordered table-striped">
                    <tr>
                        <th width="6%">ลำดับ</th>
                        <th style="text-align: center;">ชื่อ - สกุล</th>
                        <th style="text-align: center;">ใบเสนอราคา</th>
                        <th style="text-align: center;">รวม</th>
                        <th style="text-align: center;">VAT</th>
                        <th style="text-align: center;">รวมสุทธิ</th>
                        <th style="text-align: center;" width="*">Action</th>
                    </tr>
                    <?php
                    $total =0;
                    $i=1;
                    ?>
                    @foreach($p_rows as $row)
                        <tr>
                            <td>{!! $i !!}</td>
                            @if(!empty($row->latest_lead->firstname) OR !empty($row->latest_lead->lastname))
                                <td>{!! $row->latest_lead->firstname !!}  {!! $row->latest_lead->lastname !!}</td>
                            @else
                                <td>ไม่พบข้อมูล</td>
                            @endif
                            <td style="text-align: right;">{!! $row->count !!} ใบ</td>
                            <td style="text-align: right;">{!! number_format($row->sum_total,2) !!} บาท</td>
                            <td style="text-align: right;">{!! number_format($row->sum_vat,2) !!} บาท</td>
                            <td style="text-align: right;">{!! number_format($row->sum,2) !!} บาท</td>
                            <td class="action-links">
                                <a href="{!! url('report_quotation/view/'.$row->lead_id) !!}" class="view-quotation btn btn-success"   title="ดูรายละเอียด">
                                    <i class="fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                        $total += $row->sum;
                        $i++;
                        ?>
                    @endforeach
                    <tr>
                        <td colspan="5" style="font-weight: bold;">รวมสุทธิ</td>
                        <td style="text-align: right; font-weight: bold;">{!! number_format($total,2) !!} บาท</td>
                        <td></td>
                    </tr>

                </table>
                <div class="row">
                    <div class="col-md-6">
                        <div class="dataTables_info" id="example-1_info" role="status" aria-live="polite">
                            {!! trans('messages.showing',['from'=>$from,'to'=>$to,'total'=>$p_rows->total()]) !!}<br/><br/>
                        </div>
                    </div>

                    @if($allpage > 1)
                        <div class="col-md-6 text-right">
                            <div class="dataTables_paginate paging_simple_numbers" >
                                @if($p_rows->currentPage() > 1)
                                    <a class="btn btn-white p-paginate-link paginate-link" href="#" data-page="{!! $p_rows->currentPage()-1 !!}">{!! trans('messages.prev') !!}</a>
                                @endif
                                @if($p_rows->lastPage() > 1)
                                    <?php echo Form::selectRange('page', 1, $customer->lastPage(),$p_rows->currentPage(),['class'=>'form-control p-paginate-select paginate-select']); ?>
                                @endif
                                @if($p_rows->hasMorePages())
                                    <a class="btn btn-white p-paginate-link paginate-link" href="#" data-page="{!! $p_rows->currentPage()+1 !!}">{!! trans('messages.next') !!}</a>
                                @endif
                            </div>
                        </div>
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