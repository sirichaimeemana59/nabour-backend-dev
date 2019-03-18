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
<div class="panel-body member-list-content">
    <div class="tab-pane active" id="member-list">
        <div id="member-list-content">
            <table cellspacing="0" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="6%">ลำดับ</th>
                    <th width="10%">เลขที่</th>
                    <th width="20%">ชื่อผลิตภัณฑ์</th>
                    <th width="*">รายละเอียด</th>
                    <th width="10%">ราคาไม่รวม Vat</th>
                    <th width="140px">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $i=1;
                ?>
                @foreach($p_rows as $row)
                        <tr>
                        <td>{!! $i !!}</td>
                        <td>{!!$row->product_code!!}</td>
                        <td>{!!$row->name!!}</td>
                        <td>{!!$row->description!!}</td>
                        <td>{!!number_format($row->price,2)!!}</td>
                            @if($row->is_delete == 1)
                        <td class="action-links">
                            <a href="#" class="edit edit-package btn btn-warning" disabled data-toggle="modal" data-target="#edit-package" data-vehicle-id="{!!$row->id!!}" style="pointer-events: none;">
                                <i class="fa-pencil-square-o"></i>
                            </a>
                            <a href="#" class="btn btn-danger" disabled  data-toggle="modal" data-target="#delete" data-original-title="ลบ Package" onclick="mate_del('{!!$row->id!!}')" style="pointer-events: none;">
                                <i class="fa-trash"></i>
                            </a>
                            <a href="#" class="btn btn-success"  data-toggle="modal" data-target="#delete_open" data-original-title="เปิดใช้งาน" onclick="mate_open('{!!$row->id!!}')">
                                <i class="fa fa-check"></i>
                            </a>
                        </td>
                                @else
                                <td class="action-links">
                                    <a href="#" class="edit edit-package btn btn-warning" data-toggle="modal" data-target="#edit-package" data-vehicle-id="{!!$row->id!!}">
                                        <i class="fa-pencil-square-o"></i>
                                    </a>
                                    <a href="#" class="btn btn-danger"  data-toggle="modal" data-target="#delete" data-original-title="ลบผลิตภัณฑ์" onclick="mate_del('{!!$row->id!!}')">
                                        <i class="fa-trash"></i>
                                    </a>
                                </td>
                            @endif
                    </tr>
                    <?php $i++;?>
                @endforeach
                </tbody>
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
@else
   <div class="row">
      <div class="col-sm-12 text-center">
           ไม่พบข้อมูล
      </div>
   </div>
@endif