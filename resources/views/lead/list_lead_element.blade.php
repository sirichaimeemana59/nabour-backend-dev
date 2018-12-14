<div class="panel-body member-list-content">
    <div class="tab-pane active" id="member-list">
        <div id="member-list-content">
            <table cellspacing="0" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="20%">ชื่อ - สกุล</th>
                    <th width="*">เบอร์โทร</th>
                    <th width="*">พนักงานขาย</th>
                    <th width="180px"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($_lead as $row)
                    <tr>
                        <td>{!!$row->firstname.' '.$row->lastname !!}</td>
                        <td>{!!$row->phone !!}</td>
                        <td>{!!$row->latest_sale->name!!}</td>
                        <td>
                            <div class="btn-group left-dropdown">
                                <button type="button" class="btn btn-success" data-toggle="dropdown">เลือกการจัดการ</button>
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span> </button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    <li><a href="#" class="edit edit-lead" data-toggle="modal" data-target="#edit-lead" data-vehicle-id="{!!$row->id!!}">
                                            <i class="fa-pencil-square-o"></i>แก้ไข
                                        </a>
                                    </li>
                                    <li><a href="#"  data-toggle="modal" data-target="#delete" data-original-title="ลบ Lead" onclick="mate_del('{!!$row->id!!}')">
                                            {{--<a href="{{url('root/admin/package/delete/'.$row->id)}}" class="btn btn-danger delete-member" data-status="0" data-uid="" data-toggle="tooltip" data-placement="top" data-original-title="ลบ Package" onclick="return confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่ ?')">--}}
                                            <i class="fa-trash"></i>ลบ
                                        </a>
                                    </li>
                                    <li><a href="{!!url('/service/quotation/add/'.$row->id)!!}" >
                                            {{--<a href="{{url('root/admin/package/delete/'.$row->id)}}" class="btn btn-danger delete-member" data-status="0" data-uid="" data-toggle="tooltip" data-placement="top" data-original-title="ลบ Package" onclick="return confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่ ?')">--}}
                                            <i class="fa fa-newspaper-o"></i>ออกใบเสนอราคา
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>