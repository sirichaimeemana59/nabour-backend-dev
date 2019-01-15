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
                    <th width="8%">วันที่สร้าง</th>
                    <th width="8%">Convert</th>
                    <th width="15%">ชื่อ - สกุล</th>
                    <th width="10%">ชื่อบริษัท</th>
                    <th width="10%">เบอร์โทร</th>
                    <th width="10%">จังหวัด</th>
                    <th width="10%">พนักงานขาย</th>
                    <th width="8%">สัญญา</th>
                    <th width="*">การจัดการ</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $i=1;
                ?>
                @foreach($customer as $row)
                    <tr>
                        <?php
                        $created_at = new DateTime($row->created_at);
                        $convert_date = new DateTime($row->convert_date);
                        $count_date = $created_at->diff($convert_date);// count date
                        $days = $count_date->format('%a');//out put to number
                        //dd($interval);
                        ?>
                        <td style="text-align: center;">{!!$i!!}</td>
                        <td>{!!localDate($row->created_at)!!}</td>
                        @if(!empty($row->convert_date))
                            <td>{!!$days!!} วัน</td>
                        @else
                            <td>-</td>
                        @endif
                        <td>{!!$row->firstname.' '.$row->lastname !!}</td>
                        <td>{!!$row->company_name !!}</td>
                        <td>{!!$row->phone !!}</td>
                        <td>{!!$provinces[$row->province]!!}</td>
                        <td>{!!$row->latest_sale->name!!}</td>
                        <td class="text-right">{!! $row->contract->count() !!}</td>
                        <td>
                            <div class="btn-group left-dropdown">
                                <button type="button" class="btn btn-success" data-toggle="dropdown">เลือกการจัดการ</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span> </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <?php
                                    if(Auth::user()->role !=2){
                                        $class='edit-customer';
                                    }   else{
                                        $class='edit-customer-detail';
                                    }
                                    ?>
                                    <li><a href="#" class="edit {!! $class !!}" data-toggle="modal" data-target="#edit-customer" data-vehicle-id="{!!$row->id!!}">
                                            <i class="fa-pencil-square-o"></i>แก้ไข
                                        </a>
                                    </li>
                                    @if($row->status != 't')
                                        <li><a href="#"  data-toggle="modal" data-target="#delete" data-original-title="ลบ Customer" onclick="mate_del('{!!$row->id!!}')">
                                                {{--<a href="{{url('root/admin/package/delete/'.$row->id)}}" class="btn btn-danger delete-member" data-status="0" data-uid="" data-toggle="tooltip" data-placement="top" data-original-title="ลบ Package" onclick="return confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่ ?')">--}}
                                                <i class="fa-trash"></i>ลบ
                                            </a>
                                        </li>
                                    @else
                                        <li><a href="#"  data-toggle="modal" data-target="#delete1" data-original-title="Open Customer" onclick="mate_del3('{!!$row->id!!}')">
                                                {{--<a href="{{url('root/admin/package/delete/'.$row->id)}}" class="btn btn-danger delete-member" data-status="0" data-uid="" data-toggle="tooltip" data-placement="top" data-original-title="ลบ Package" onclick="return confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่ ?')">--}}
                                                <i class="fa-check"></i>เปิดใช้งาน Customer
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        @if(Auth::user()->role !=2)
                                            <a href="{!!url('/customer/service/quotation/add/'.$row->id)!!}" >
                                        @else
                                            <a href="{!!url('/customer/service/sales/quotation/add/'.$row->id)!!}" >
                                        @endif
                                            {{--<a href="{{url('root/admin/package/delete/'.$row->id)}}" class="btn btn-danger delete-member" data-status="0" data-uid="" data-toggle="tooltip" data-placement="top" data-original-title="ลบ Package" onclick="return confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่ ?')">--}}
                                            <i class="fa fa-newspaper-o"></i>ออกใบเสนอราคา
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