<table class="table">
    <thead>
    <tr>
        <th>เลขที่ใบเสนอราคา</th>
        <th>Package</th>
        <th>ราคาสุทธิ</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($quotation as $row)
    <tr>
        <td>{!! $row->quotation_code !!}</td>
        <td>{!! $row->lastest_package->name !!}</td>
        <td>{!! $row->product_price_with_vat !!}</td>
        <td></td>
    </tr>
    @endforeach
    </tbody>
</table>
<?php
/*
         <div class="col-sm-4">
    <div class="well">
       <p>เลขที่ใบเสนอราคา :  {!!$row->quotation_code!!}</p>
        <p>Package : </p>
        <p>ราคาสุทธิ : </p>
        <br>
        <div style="text-align: right;">
            @if($row->status !=1)
            @if($row->remark == 0 )
            <a href="{!! url('service/quotation/check/quotation/'.$row->quotation_code.'/'.$row->lead_id) !!}" class="edit edit-service btn btn-success"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="ใช้ใบเสนอราคา">
                <i class="fa-check"></i>
            </a>
            @endif

            @if($row->remark == 1)
            <a href="{!! url('service/quotation/check_out/quotation/'.$row->quotation_code.'/'.$row->lead_id) !!}" class="edit edit-service btn btn-danger"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="ยกเลิกใบเสนอราคา">
               <i class="fa-close"></i>
            </a>
            <a href="{!! url('service/quotation/print_quotation/'.$row->quotation_code) !!}" class="edit edit-service btn btn-info"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="พิมพ์ใบเสนอราคา">
                <i class="fa-print"></i>
            </a>
                @else
                    <a href="{!! url('service/quotation/update/form/'.$row->quotation_code) !!}" class="edit edit-service btn btn-warning"  data-toggle="tooltip" data-placement="top" data-toggle="modal" data-target="#edit-package" data-original-title="แก้ไข">
                        <i class="fa-pencil-square-o"></i>
                    </a>
                    <a href="#" class="btn btn-danger view-member"  data-toggle="tooltip" data-placement="top" data-original-title="ลบ">
                        <i class="fa-trash"></i>
                    </a>
            @endif

            @endif
                <a href="#" class="edit edit-service btn btn-info view-member"  data-toggle="modal" data-target="#edit-package" data-placement="top" data-original-title="{{ trans('messages.detail') }}" data-vehicle-id="{!!$row->quotation_code!!}" >
                    <i class="fa-eye"></i>
                </a>
        </div>
    </div>
</div>
         */ ?>