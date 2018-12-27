@if($officers->count())
<?php
	$from   = (($officers->currentPage()-1)*$officers->perPage())+1;
    $to     = (($officers->currentPage()-1)*$officers->perPage())+$officers->perPage();
    $to     = ($to > $officers->total()) ? $officers->total() : $to;
    $allpage = $officers->lastPage();
    $curPage = $officers->currentPage();
 ?>
 <p>{!!  __('messages.Officer.officer_total',['no' => $officers->total()]) !!}</p><br/>
	<table cellspacing="0" class="table table-bordered table-striped">
		<thead>
			<tr>
				<th width="*">{!!  __('messages.user') !!}</th>
				<th width="160px">{!!  __('messages.Member.account_status') !!}</th>
				<th width="130px">{!!  __('messages.action') !!}</th>
			</tr>
		</thead>
		<tbody>
			@foreach($officers as $member)
			<tr>
				<td class="user-image">
					@if($member->profile_pic_name)
	                <img style="margin-top:0;" src="{!! env('URL_S3')."/profile-img/".$member->profile_pic_path.$member->profile_pic_name !!}" class="img-circle" alt="user-pic" />
	                @else
	                <img style="margin-top:0;" src="{!! url('/') !!}/images/user-1.png" alt="user-pic" class="img-circle" />
	                @endif
	                <div class="user-detail" style="margin-top:7px;">
						<a href="#" class="name">{!! $member->name !!}</a>
					</div>
				</td>
				<td>
					@if($member->active)
					{!!  __('messages.Member.account_active') !!}
					@else
					{!!  __('messages.Member.account_inactive') !!}
					@endif
				</td>
				<td class="action-links">
					<a href="#" class="btn btn-info view-member" data-uid="{!! $member->id !!}" data-toggle="tooltip" data-placement="top" data-original-title="{!!  __('messages.detail') !!}">
			            <i class="fa-eye"></i>
			        </a>
					<a href="#" class="btn btn-success edit-member" data-uid="{!! $member->id !!}" data-toggle="tooltip" data-placement="top" data-original-title="{!!  __('messages.edit') !!}">
			            <i class="fa-edit"></i>
			        </a>
			        @if($member->active)
			        <a href="#" class="btn btn-warning active-status" data-status="0" data-uid="{!! $member->id !!}" data-toggle="tooltip" data-placement="top" data-original-title="{!!  __('messages.Member.account_ban') !!}">
			            <i class="fa-lock"></i>
			        </a>
			        @else
					<a href="#" class="btn btn-success active-status" data-status="1" data-uid="{!! $member->id !!}" data-toggle="tooltip" data-placement="top" data-original-title="{!!  __('messages.Member.account_unban') !!}">
			            <i class="fa-key"></i>
			        </a>
					@endif
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
<div class="row">
	@if($allpage > 1)
	<div class="col-md-6">
		<div class="dataTables_info" id="example-1_info" role="status" aria-live="polite">
			{!!  __('messages.showing',['from'=>$from,'to'=>$to,'total'=>$officers->total()]) !!}
		</div>
	</div>
	<div class="col-sm-6 text-right">
		<ul class="pagination no-margin member-pagination">
			@if($curPage > 1)
			<li>
				<a href="#" data-page="{!! $curPage-1 !!}">
					<i class="fa-angle-left"></i>
				</a>
			</li>
			@endif

			@for($i = 1; $i <= $allpage; $i++)
			<li @if($curPage == $i) class="active" @endif>
				<a href="#" data-page="{!! $i !!}">{!!$i!!}</a>
			</li>
			@endfor
			@if($officers->hasMorePages())
			<li>
				<a href="#" data-page="{!! $curPage+1 !!}">
					<i class="fa-angle-right"></i>
				</a>
			</li>
			@endif
		</ul>
	</div>
	@endif
</div>
@else
<div class="col-sm-12 text-center">{!!  __('messages.Member.member_not_found') !!}</div><div class="clearfix"></div>
@endif
