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
                    @endif
                </div>
                <table cellspacing="0" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="6%">เลขที่</th>
                        <th width="25%">Leads</th>
                        <th width="15%">พนักงานขาย</th>
                        <th width="15%">จำนวน Quotation</th>
                        <th width="15%">การจัดการ</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=1;
                    ?>
                    @foreach($p_rows as $row)
                        <tr>
                            <td>{!!$i!!}</td>
                            <td>{!!$row->firstname !!} {!!$row->lastname !!}</td>
                            <td>{!!$row->latest_sale->name !!}</td>
                            <td>{!!$row->quotation->count() !!}</td>
                            <td>
                                <div class="btn-group left-dropdown">
                                    <button type="button" class="btn btn-success" data-toggle="dropdown">เลือกการจัดการ</button>
                                    <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span> </button>
                                    <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        <li><a href="{!! url('/report_quotation/view/'.$row->id) !!}">
                                                <i class="fa-eye"></i>ดูรายละเอียด
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <?php
                        $i++;
                        ?>
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
    </div>