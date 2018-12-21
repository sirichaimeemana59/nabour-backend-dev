<div class="table-responsive dataTables_wrapper ">
    <table class="table table-striped" id="p-list" style="min-width:900px;">
        @if(!empty($list_property))
            <thead>
            <tr>
                <th width="17%">ชื่อนิติบุคคลทดลอง</th>
                <th width="8%">รหัสผ่าน</th>
                <th width="10%">วันหมดอายุ</th>
                <th width="*">ใช้งานโดย</th>
                <th width="15%">ชื่อผู้ติดต่อ</th>
                <th width="12%">เบอร์โทรผู้ติดต่อ</th>
                <th width="180px">การจัดการ</th>
            </tr>
            </thead>
            <tbody class="middle-align">
            @foreach($list_property as $row)
                <tr>
                    <td>
                        {!!$row->property->property_name_th!!}
                        @if($row->status == 0 && $row->isExpire != 1)
                            <div class="label label-success">ว่าง</div>
                        @elseif($row->status == 1 && $row->isExpire != 1)
                            <div class="label label-info">ไม่ว่าง</div>
                        @elseif($row->status == 2 || $row->isExpire == 1)
                            <div class="label label-warning">หมดเวลาทดลอง</div>
                        @else
                            <div class="label label-danger">ระงับการใช้งาน</div>
                        @endif
                    </td>
                    <td>{!!$row->default_password!!}</td>
                    <td>{!! ($row->trial_expire != null) ? date('Y/m/d', strtotime($row->trial_expire)) : "ไม่มีกำหนด"!!}</td>
                    <td>
                        @if($row->property_test_name)
                            {!!$row->property_test_name!!}
                        @else
                            <span style="color:#b3b3b3;">ยังไม่มีการใช้งาน</span>
                        @endif
                    </td>
                    <td>
                        @if($row->contact_name)
                            {!!$row->contact_name!!}
                        @else
                            <span style="color:#b3b3b3;">ยังไม่มีการใช้งาน</span>
                        @endif
                    <td>
                        @if($row->tel_contact)
                            {!!$row->tel_contact!!}
                        @else
                            <span style="color:#b3b3b3;">-</span>
                        @endif
                    <td>
                        <div class="btn-group left-dropdown"> 
                        <button type="button" class="btn btn-success" data-toggle="dropdown">เลือกการจัดการ</button> 
                        <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span> </button> 
                        <ul class="dropdown-menu dropdown-green" role="menu"> 
                            <li><a href="{!! url('sales/property/view/'.$row->id) !!}">
                                ดูรายละเอียด
                            </a></li>
                            <li><a href="#" data-demo-id="{!! $row->id !!}" class="reset-data-button">
                                ทำการลบข้อมูลทั้งหมด
                            </a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modal-assign-property-demo" data-id="{!! $row->id !!}">
                                ส่งให้นิติบุคคลอื่นทดลองใช้
                            </a></li>
                            @if($row->status != 3)
                            <li><a href="#" class="disable-data-button" data-demo-id="{!! $row->id !!}">
                                ระงับการใช้งาน
                            </a></li>
                            @else
                            <li><a href="#" class="enable-data-button" data-demo-id="{!! $row->id !!}">
                                เปิดให้ใช้งาน
                            </a></li>
                            @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        @else
            <tr><td>{!! trans('messages.PropertyForm.form_not_found') !!}</td></tr>
        @endif
    </table>
    <div>
        <br>
        <p>
            *แต่ละหมู่บ้านจะมี account เช่น หมู่บ้าน <b>nb001</b> จะมี accout เป็น
        <ul>
            <li>admin_<b>nb001</b>@nabour.me => สำหรับนิติบุคคล</li>
            <li>com_<b>nb001</b>@nabour.me => สำหรับคณะกรรมการหมู่บ้าน</li>
            <li>user2_<b>nb001</b>@nabour.me => สำหรับลูกบ้านหลังที่ 1</li>
            <li>user3_<b>nb001</b>@nabour.me => สำหรับลูกบ้านหลังที่ 2</li>
            <li>user4_<b>nb001</b>@nabour.me => สำหรับลูกบ้านหลังที่ 3</li>
        </ul>
        </p>
    </div>
</div>
