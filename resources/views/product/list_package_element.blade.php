<div class="panel-body member-list-content">
    <div class="tab-pane active" id="member-list">
        <div id="member-list-content">
            <table cellspacing="0" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th width="10%">เลขที่</th>
                    <th width="20%">ชื่อผลิตภัณฑ์</th>
                    <th width="*">รายละเอียด</th>
                    <th width="180px">{{ trans('messages.action') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($package as $row)
                        <tr>
                        <td>{!!$row->product_code!!}</td>
                        <td>{!!$row->name!!}</td>
                        <td>{!!$row->description!!}</td>
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
                                    <a href="#" class="btn btn-danger"  data-toggle="modal" data-target="#delete" data-original-title="ลบ Package" onclick="mate_del('{!!$row->id!!}')">
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