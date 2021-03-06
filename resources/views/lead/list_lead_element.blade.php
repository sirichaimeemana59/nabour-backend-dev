<?php
    $from=0;
    $to=0;
    $allpage=0;
    $status_leads=unserialize(constant('status_leads'));
    $type_property=unserialize(constant('LEADS_TYPE'));
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
            <table cellspacing="0" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="6%">เลขที่</th>
                    <th width="9%">วันที่สร้าง</th>
                    <th width="18%">ชื่อ - สกุล</th>
                    <th width="13%">เบอร์โทร</th>
                    <th width="10%">พนักงานขาย</th>
                    <th width="9%">ใบเสนอราคา</th>
                    <th width="10%">ประเภท</th>
                    <th width="10%">สถานะ</th>
                    <th width="*">การจัดการ</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $i=1;
                ?>
                @foreach($p_rows as $row)
                    <?php $doc_count = $row->quotation->count(); ?>
                    <tr>
                        <td style="text-align: center;">{!!$i!!}</td>
                        <td>{!!localDate($row->created_at)!!}</td>
                        <td>{!!$row->firstname.' '.$row->lastname !!}</td>
                        <td>{!!$row->phone !!}</td>
                        <td>@if($row->latest_sale){!!$row->latest_sale->name!!}@else ไม่พบข้อมูล @endif</td>
                        <td class="text-right">{!! $doc_count > 0 ? $doc_count : 'ไม่มีข้อมูล'; !!}</td>
                        <td>@if($row->type != null){!! $type_property[$row->type] !!}@else ไม่พบข้อมูล @endif</td>
                        <td>@if($row->status_leads){!!$status_leads[$row->status_leads]!!}@else ไม่พบข้อมูล @endif</td>
                        <td>
                            <div class="btn-group left-dropdown">
                                <button type="button" class="btn btn-success" data-toggle="dropdown">เลือกการจัดการ</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span> </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <?php
                                    if(Auth::user()->role !=2){
                                        $class='edit-lead';
                                    }   else{
                                        $class='edit-lead-detail';
                                    }
                                    ?>
                                    @if($row->status_leads != 5 AND $row->status_leads != 6)
                                        @if(Auth::user()->role !=2)
                                            <li><a href="#" class="view" data-toggle="modal" data-target="#view-lead" data-id="{!!$row->id!!}">
                                                    <i class="fa-eye"></i>ดู
                                                </a>
                                            </li>
                                                @else
                                            <li><a href="#" class="view_sales" data-toggle="modal" data-target="#view-lead-sales" data-id="{!!$row->id!!}">
                                                    <i class="fa-eye"></i>ดู
                                                </a>
                                            </li>
                                        @endif


                                    <li><a href="#" class="edit {!! $class !!}" data-toggle="modal" data-target="#edit-lead" data-vehicle-id="{!!$row->id!!}">
                                            <i class="fa-pencil-square-o"></i>แก้ไข
                                        </a>
                                    </li>
                                    <li><a href="#"  data-toggle="modal" data-target="#delete" data-original-title="ลบ Lead" onclick="mate_del('{!!$row->id!!}')">
                                                {{--<a href="{{url('root/admin/package/delete/'.$row->id)}}" class="btn btn-danger delete-member" data-status="0" data-uid="" data-toggle="tooltip" data-placement="top" data-original-title="ลบ Package" onclick="return confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่ ?')">--}}
                                                <i class="fa-trash"></i>ลบ
                                            </a>
                                        </li>
                                    <li>
                                        @if(Auth::user()->role !=2)
                                                <a href="{!!url('/customer/service/quotation/add/'.$row->id)!!}" >
                                            @else
                                                <a href="{!!url('/customer/service/sales/quotation/add/'.$row->id)!!}" >
                                        @endif
                                            {{--<a href="{{url('root/admin/package/delete/'.$row->id)}}" class="btn btn-danger delete-member" data-status="0" data-uid="" data-toggle="tooltip" data-placement="top" data-original-title="ลบ Package" onclick="return confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่ ?')">--}}
                                            <i class="fa fa-newspaper-o"></i>ออกใบเสนอราคา
                                        @if(Auth::user()->role==2)
                                            <li><a href="#"  data-toggle="modal" data-target="#demo_sale" data-original-title="" data-id="{!! $row->id !!}">
                                                    <i class="fa-pencil-square-o"></i>นิติบุคคลทดลองใช้
                                                </a>
                                            </li>
                                        @else
                                            <li><a href="#"  data-toggle="modal" data-target="#demo" data-original-title="" data-id="{!! $row->id !!}">
                                                    <i class="fa-pencil-square-o"></i>นิติบุคคลทดลองใช้
                                                </a>
                                            </li>
                                        @endif
                                        </a>
                                    </li>

                                            <li><a href="#" class="note"  data-toggle="tooltip" data-original-title="หมายเหตุ" data-id="{!! $row->id !!}" data-detail="{!! $row->note !!}">
                                                    {{--<a href="{{url('root/admin/package/delete/'.$row->id)}}" class="btn btn-danger delete-member" data-status="0" data-uid="" data-toggle="tooltip" data-placement="top" data-original-title="ลบ Package" onclick="return confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่ ?')">--}}
                                                    <i class="fa-newspaper-o"></i>หมายเหตุ
                                                </a>
                                            </li>
                                        @else
                                                    @if(Auth::user()->role !=2)
                                                        <li><a href="#" class="view" data-toggle="modal" data-target="#view-lead" data-id="{!!$row->id!!}">
                                                                <i class="fa-eye"></i>ดู
                                                            </a>
                                                        </li>
                                                    @else
                                                        <li><a href="#" class="view_sales" data-toggle="modal" data-target="#view-lead-sales" data-id="{!!$row->id!!}">
                                                                <i class="fa-eye"></i>ดู
                                                            </a>
                                                        </li>
                                                    @endif


                                                    <li><a href="#" class="edit {!! $class !!}" data-toggle="modal" data-target="#edit-lead" data-vehicle-id="{!!$row->id!!}">
                                                            <i class="fa-pencil-square-o"></i>แก้ไข
                                                        </a>
                                                    </li>
                                                    <li><a href="#" class="note"  data-toggle="tooltip" data-original-title="หมายเหตุ" data-id="{!! $row->id !!}" data-detail="{!! $row->note !!}">
                                                            {{--<a href="{{url('root/admin/package/delete/'.$row->id)}}" class="btn btn-danger delete-member" data-status="0" data-uid="" data-toggle="tooltip" data-placement="top" data-original-title="ลบ Package" onclick="return confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่ ?')">--}}
                                                            <i class="fa-newspaper-o"></i>หมายเหตุ
                                                        </a>
                                                    </li>
                                        @endif
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
@else
    <div class="row">
        <div class="col-sm-12 text-center">
            ไม่พบข้อมูล
        </div>
    </div>
@endif