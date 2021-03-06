<div class="panel-body member-list-content">
    <div class="tab-pane active" id="member-list">
        <div id="member-list-content">
            <table cellspacing="0" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="20%">ชื่อ ค่าบริการ</th>
                    <th width="*">รายละเอียด</th>
                    <th width="180px">{!!trans('messages.action')!!}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($package as $row)

                    <tr>
                        <td>
                            {!!$row->name!!}
                        </td>
                        <td>
                            {!!$row->description!!}
                        </td>

                        @if($row->is_delete == 1)
                        <td class="action-links">
                            <a href="#" class="edit edit-service btn btn-warning" data-toggle="modal" data-target="#edit-service" data-vehicle-id="{!!$row->id!!}"  style="pointer-events: none;">
                                <i class="fa-pencil-square-o"></i>
                            </a>
                            <a href="#" class="btn btn-danger"  data-toggle="modal" data-target="#delete" data-original-title="ลบ Package" onclick="mate_del('{!!$row->id!!}')"  style="pointer-events: none;">
                                {{--<a href="{{url('root/admin/package/delete_service/'.$row->id)}}" class="btn btn-danger delete-member" data-status="0" data-uid="" data-toggle="tooltip" data-placement="top" data-original-title="ลบ Package" onclick="return confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่ ?')">--}}
                                <i class="fa-trash"></i>
                            </a>
                            <a href="#" class="btn btn-success"  data-toggle="modal" data-target="#delete_open" data-original-title="เปิดใช้งาน" onclick="mate_open('{!!$row->id!!}')">
                                {{--<a href="{{url('root/admin/package/delete_service/'.$row->id)}}" class="btn btn-danger delete-member" data-status="0" data-uid="" data-toggle="tooltip" data-placement="top" data-original-title="ลบ Package" onclick="return confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่ ?')">--}}
                                <i class="fa fa-check"></i>
                            </a>
                        </td>
                            @else
                            <td class="action-links">
                            <a href="#" class="edit edit-service btn btn-warning" data-toggle="modal" data-target="#edit-service" data-vehicle-id="{!!$row->id!!}">
                                <i class="fa-pencil-square-o"></i>
                            </a>
                            <a href="#" class="btn btn-danger"  data-toggle="modal" data-target="#delete" data-original-title="ลบ Package" onclick="mate_del('{!!$row->id!!}')">
                                {{--<a href="{{url('root/admin/package/delete_service/'.$row->id)}}" class="btn btn-danger delete-member" data-status="0" data-uid="" data-toggle="tooltip" data-placement="top" data-original-title="ลบ Package" onclick="return confirm('คุณต้องการลบรายการนี้ ใช่หรือไม่ ?')">--}}
                                <i class="fa-trash"></i>
                            </a>
                            </td>
                        @endif
                    </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>