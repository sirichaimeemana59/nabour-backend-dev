<form method="POST" action="{!! url('report_quotation_ratio_excel') !!}" accept-charset="UTF-8" class="form-horizontal">
    <input type="hidden" name="from" value="{!! $from !!}">
    <input type="hidden" name="to" value="{!! $to !!}">
    <input type="hidden" name="channel_id" value="{!! $channel !!}">
    <input type="hidden" name="type_id" value="{!! $type !!}">

    <button type="submit" class="btn btn-info btn-primary action-float-right"><i class="fa fa-download"> </i> ดาวน์โหลด</button>
</form>
<?php
$channel1=unserialize(constant('LEADS_SOURCE'));
$type1=unserialize(constant('LEADS_TYPE'));
?>

@if(!empty($from))
    <h4 class="panel-title">ผลการค้นหาระหว่างวันที่ {!! localDate($from) !!}  ถึง  {!! localDate($to) !!}</h4>
@endif

@if($channel != null)
    <h4 class="panel-title">ผลการค้นหาจากแหล่งที่มา :
        @foreach ($channel1 as $key => $value)
            @if($channel == $key)
                {!! $value !!}
            @endif
        @endforeach
    </h4>
@endif

@if(!empty($type))
    <h4 class="panel-title">ผลการค้นหาจากประเภท :
        @foreach ($type1 as $key => $value)
            @if($type == $key)
                {!! $value !!}
            @endif
        @endforeach
    </h4>
@endif


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
                                        <?php
                                            echo Form::selectRange('page', 1, $p_rows->lastPage(),$p_rows->currentPage(),['class'=>'form-control p-paginate-select paginate-select']);
                                            ?>
                                    @endif
                                    @if($p_rows->hasMorePages())
                                        <a class="btn btn-white p-paginate-link paginate-link" href="#" data-page="{!! $p_rows->currentPage()+1 !!}">{!! trans('messages.next') !!}</a>
                                    @endif
                                </div>
                            </div>
                        @endif
               </div>
               <table cellspacing="0" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th width="6%">เลขที่</th>
                        <th width="20%">วันที่สร้าง</th>
                        <th width="40%">ชื่อ - สกุล</th>
                        <th width="20%">สถานะ</th>
                        <th width="*">พนักงานขาย</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i=1;
                    $count=0;
                    ?>
                    @foreach($p_rows as $row)
                        <tr>
                            <td style="text-align: center;">{!! $i !!}</td>
                            <td>{!! localDate($row->created_at) !!}</td>
                            <td>{!! $row->firstname !!}  {!! $row->lastname !!}</td>
                            <?php
                                $status_=$row->role==1?"Customer":"Leads";
                                if($row->role==1){
                                    $count++;
                                }
                            ?>
                            <td>{!! $status_ !!}</td>
                            <td>{!! $row->latest_sale->name !!}</td>
                        </tr>
                        <?php
                        $i++;
                        ?>
                    @endforeach
                    <tr>
                        <td colspan="3" style="font-weight: bold; text-align: right;">รวม</td>
                        <td style="font-weight: bold; text-align: right;">{!! $i-1 !!}</td>
                        <td style="font-weight: bold;">คน</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold; text-align: right;">เป็นลูกค้า</td>
                        <td style="font-weight: bold; text-align: right;">{!! $count !!}</td>
                        <td style="font-weight: bold;">คน</td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-weight: bold; text-align: right;">คิดเป็น</td>
                        <td style="font-weight: bold; text-align: right;">{!! number_format(($count/$i)*100,2) !!}</td>
                        <td style="font-weight: bold;">%</td>
                    </tr>
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
                                    <?php
                                        echo Form::selectRange('page', 1, $customer->lastPage(),$p_rows->currentPage(),['class'=>'form-control p-paginate-select paginate-select']);
                                        ?>
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
    <div class="col-sm-12 text-center">ไม่พบข้อมูล</div><div class="clearfix"></div>
@endif