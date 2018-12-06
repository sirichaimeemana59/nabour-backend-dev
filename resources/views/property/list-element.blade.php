@if($p_rows->count() > 0)
    <?php
    $to   	= $p_rows->total() - (($p_rows->currentPage())*$p_rows->perPage());
    $to     = ($to > 0) ? $to : 1;
    $from   = $p_rows->total() - (($p_rows->currentPage())*$p_rows->perPage())+$p_rows->perPage();
    $allpage = $p_rows->lastPage();
    ?>
	{{--{!!$date_now= date("Y/m/d")!!}--}}
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
                        <?php echo Form::selectRange('page', 1, $p_rows->lastPage(),$p_rows->currentPage(),['class'=>'form-control p-paginate-select paginate-select']); ?>
					@endif
					@if($p_rows->hasMorePages())
						<a class="btn btn-white p-paginate-link paginate-link" href="#" data-page="{!! $p_rows->currentPage()+1 !!}">{!! trans('messages.next') !!}</a>
					@endif
				</div>
			</div>
		@endif
	</div>
	<table class="table table-bordered table-striped" id="p-list" width="100%">
		@if(!empty($p_rows))
			<thead>
			<tr>
				<th width="100px">ลำดับ</th>
				<th width="*">รายชื่อนิติบุคคล</th>
				<th width="15%">จังหวัด</th>
				<th width="180px">กลุ่มผู้บริหารนิติบุคคล</th>
				<th width="180px">การจัดการ</th>
			</tr>
			</thead>
			<tbody class="middle-align">
			@foreach($p_rows as $key => $row)
				<td>NB00000</td>
				<td class="name">{!!$row->property_name_th." / ".$row->property_name_en!!}</td>
				<td>{!!$provinces[$row->province]!!}</td>
				<td class="text-center">
					@if( $row->developer_group_id )
					{!! $pmg[$row->developer_group_id] !!}
					@else
						อื่นๆ
					@endif
				</td>
				<td>
					<div class="btn-group left-dropdown">
						<button type="button" class="btn btn-success" data-toggle="dropdown">เลือกการจัดการ</button>
						<button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="true"> <span class="caret"></span> </button>
						<ul class="dropdown-menu dropdown-menu-right" role="menu">
							<li><a href="{!!url('/customer/property/view/'.$row->id)!!}">
									<i class="fa-eye"></i> ดู
								</a>
							<li><a href="{!!url('/customer/property/edit/'.$row->id)!!}">
									<i class="fa-edit"></i> แก้ไข
								</a>
							</li>
							<?php /*
							<li><a href="{!!url('/customer/property/directlogin/'.$row->id)!!}">
									<i class="fa-user"></i> Login เป็น Admin
								</a>
							</li>
							<li><a href="#" class="edit-property-feature"  data-pid="{!! $row->id !!}">
									<i class="fa-cogs"></i> แก้ไขเมนูของนิติบุคคล
								</a></li>
							<li><a href="#" class="edit-property-feature-user"  data-pid="{!! $row->id !!}">
									<i class="fa-cogs"></i> แก้ไขเมนูของลูกบ้าน
								</a></li>
							<li><a href="#" class="property-initial-meter-data"  data-pid="{!! $row->id !!}">
									<i class="fa-list-alt"></i> ข้อมูลมิเตอร์ตั้งต้น
								</a></li>
							<li><a href="#" class="add-unit-link" data-toggle="modal" data-target="#add-unit-csv-modal" data-pid="{!! $row->id !!}">
									<i class="fa-home"></i> เพิ่มข้อมูลที่พักอาศัยครั้งแรก
								</a></li>
							<li><a href="{!! url('/customer/property/receipt/import/'.$row->id) !!}">
									<i class="fa fa-money"></i> นำเข้าข้อมูลใบแจ้งหนี้ / ใบเสร็จ
								</a></li>
							<li><a href="{!! url('/customer/property/expense/import/'.$row->id) !!}">
									<i class="fa fa-money"></i> นำเข้าข้อมูลบันทึกรายจ่าย
								</a></li>
							@if($row->active_status)
								<li><a href="#" class="active-status" data-status="0" data-pid="{!! $row->id !!}">
										<i class="fa-lock"></i> {!! trans('messages.Member.account_ban') !!}
									</a></li>
							@else
								<li><a href="#" class="active-status" data-status="1" data-pid="{!! $row->id !!}">
										<i class="fa-key"></i> {!! trans('messages.Member.account_unban') !!}
									</a></li>
							@endif
							<li><a href="#" class="add-unit-link" data-toggle="modal" data-target="#update-unit-csv-modal" data-pid="{!! $row->id !!}">
									<i class="fa-home"></i> เพิ่มข้อมูลที่พักอาศัยเพิ่มเติม
								</a></li>
							<li><a href="#" class="add-unit-link" data-toggle="modal" data-target="#edit-unit-csv-modal" data-pid="{!! $row->id !!}">
									<i class="fa-home"></i> แก้ไขข้อมูลที่พักอาศัยโดยใช้ ID
								</a></li> */?>
							<li><a href="#" class="view-sign" data-toggle="tooltip" data-pid="{!! $row->id !!}">
									<i class="fa-file-o"></i> ดู/แก้ไขสัญญา Nabour
								</a></li>
							<li><a href="#" target="_bank">
									<i class="fa-print"></i> พิมพ์ใบสัญญา
								</a>
							</li>
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
						<a class="btn btn-white p-paginate-link paginate-link" href="#" data-page="{!! $p_rows->currentPage()-1 !!}">{!! trans('messages.prev') !!}</a>
					@endif
					@if($p_rows->lastPage() > 1)
                        <?php echo Form::selectRange('page', 1, $p_rows->lastPage(),$p_rows->currentPage(),['class'=>'form-control p-paginate-select paginate-select']); ?>
					@endif
					@if($p_rows->hasMorePages())
						<a class="btn btn-white p-paginate-link paginate-link" href="#" data-page="{!! $p_rows->currentPage()+1 !!}">{!! trans('messages.next') !!}</a>
					@endif
				</div>
			</div>
		@endif
	</div>
@else
	<div class="col-sm-12 text-center">ไม่พบข้อมูล</div><div class="clearfix"></div>
@endif
