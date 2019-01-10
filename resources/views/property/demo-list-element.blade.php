 @if($p_rows->count() > 0)
 <?php
    $from   = (($p_rows->currentPage()-1)*$p_rows->perPage())+1;
    $to     = (($p_rows->currentPage()-1)*$p_rows->perPage())+$p_rows->perPage();
    $to     = ($to > $p_rows->total()) ? $p_rows->total() : $to;
    $allpage = $p_rows->lastPage();
 ?>
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
				<a class="btn btn-white d-paginate-link paginate-link" href="#" data-page="{!! $p_rows->currentPage()-1 !!}">{!! trans('messages.prev') !!}</a>
			@endif
			@if($p_rows->lastPage() > 1)
			<?php echo Form::selectRange('page', 1, $p_rows->lastPage(),$p_rows->currentPage(),['class'=>'form-control d-paginate-select paginate-select']); ?>
			@endif
			@if($p_rows->hasMorePages())
				<a class="btn btn-white d-paginate-link paginate-link" href="#" data-page="{!! $p_rows->currentPage()+1 !!}">{!! trans('messages.next') !!}</a>
			@endif
		</div>
	</div>
	@endif
</div>

<table class="table table-bordered table-striped" id="p-list" width="100%">
	@if(!empty($p_rows))
	<thead>
		<tr>
			<th width="*">นิติบุคคลทดลอง</th>
			<th width="10%">Default Password</th>
			<th width="30%">ใช้งานโดย</th>
			<th width="15%">ชื่อผู้ติดต่อ</th>
			<th width="15%">เบอร์โทรผู้ติดต่อ</th>
			<th width="180px">การจัดการ</th>
		</tr>
	</thead>
	<tbody class="middle-align">
		@foreach($p_rows as $row)
		<tr>
			<td class="name">{!!$row->property_name_th!!}</td>
			@if(!empty($row->sale_property->default_password))
				<td>{!!$row->sale_property->default_password!!}</td>
			@else
				<td>-</td>
			@endif
			<td>
			@if($row->sale_property && $row->sale_property->property_test_name)
				{!!$row->sale_property->property_test_name!!}
			@else
				<span style="color:#b3b3b3;">ยังไม่มีการใช้งาน</span>
			@endif
			</td>
			<td>
			@if($row->sale_property && $row->sale_property->contact_name)
				{!!$row->sale_property->contact_name!!}
			@else
				<span style="color:#b3b3b3;">ยังไม่มีการใช้งาน</span>
			@endif
			</td>
			<td>
			@if($row->sale_property && $row->sale_property->tel_contact)
				{!!$row->sale_property->tel_contact!!}
			@else
				-
			@endif
			</td>
			<td>
				<div class="btn-group left-dropdown"> 
					<button type="button" class="btn btn-success" data-toggle="dropdown">เลือกการจัดการ</button> 
					<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span> </button> 
					<ul class="dropdown-menu dropdown-green" role="menu"> 
						<li><a href="{!!url('/customer/property/view/'.$row->id)!!}">
    					<i class="fa-eye"></i> ดู 
						</a>
						<li><a href="{!!url('/customer/property/edit/'.$row->id)!!}">
							<i class="fa-edit"></i> แก้ไข
						</a>
						</li>
						<li><a href="#" data-demo-id="{!! $row->id !!}" class="reset-data-button">
								<i class="fa-trash-o"></i>ทำการลบข้อมูลทั้งหมด
							</a></li>
						<li><a href="#" data-toggle="modal" data-target="#modal-assign-property-demo" data-id="{!! $row->id !!}">
								<i class="fa-send-o"></i>ส่งให้นิติบุคคลอื่นทดลองใช้
							</a></li>
						<?php /* <li><a href="#" class="edit-property-feature" data-status="1" data-pid="{!! $row->id !!}">
							<i class="fa-cogs"></i> แก้ไขเมนูของนิติบุคคล
						</a></li>
						<li><a href="#" class="property-initial-meter-data" data-status="1" data-pid="{!! $row->id !!}">
							<i class="fa-list-alt"></i> ข้อมูลมิเตอร์ตั้งต้น
						</a></li> */ ?>
						@if($row->active_status)
						<li><a href="#" class="active-status" data-status="0" data-pid="{!! $row->id !!}">
							<i class="fa-lock"></i> {!! trans('messages.Member.account_ban') !!}
						</a></li>
						@else
						<li><a href="#" class="active-status" data-status="1" data-pid="{!! $row->id !!}">
							<i class="fa-key"></i> {!! trans('messages.Member.account_unban') !!}
						</a></li>
						@endif
					</ul> 
				</div>

				<div class="action-links">
    				
				</div>
			</td>
		</tr>
		@endforeach
	</tbody>
	@else
	<tr><td> Not found </td></tr>
	@endif
</table>

<div class="row">
	<div class="col-md-6">
		<div class="dataTables_info" id="example-1_info" role="status" aria-live="polite">
			{!! trans('messages.showing',['from'=>$from,'to'=>$to,'total'=>$p_rows->total()]) !!}
		</div>
	</div>
	@if($allpage > 1)
	<div class="col-md-6 text-right">
		<div class="dataTables_paginate paging_simple_numbers" >
			@if($p_rows->currentPage() > 1)
				<a class="btn btn-white d-paginate-link paginate-link" href="#" data-page="{!! $p_rows->currentPage()-1 !!}">{!! trans('messages.prev') !!}</a>
			@endif
			@if($p_rows->lastPage() > 1)
			<?php echo Form::selectRange('page', 1, $p_rows->lastPage(),$p_rows->currentPage(),['class'=>'form-control d-paginate-select paginate-select']); ?>
			@endif
			@if($p_rows->hasMorePages())
				<a class="btn btn-white d-paginate-link paginate-link" href="#" data-page="{!! $p_rows->currentPage()+1 !!}">{!! trans('messages.next') !!}</a>
			@endif
		</div>
	</div>
	@endif
</div>
@else
<div class="col-sm-12 text-center">ไม่พบข้อมูล</div><div class="clearfix"></div>
@endif
