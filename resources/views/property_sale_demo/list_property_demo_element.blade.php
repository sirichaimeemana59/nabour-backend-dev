@if($_form->count() > 0)
    <?php
    $from   = (($_form->currentPage()-1)*$_form->perPage())+1;
    $to     = (($_form->currentPage()-1)*$_form->perPage())+$_form->perPage();
    $to     = ($to > $_form->total()) ? $_form->total() : $to;
    $allpage = $_form->lastPage();
    ?>
    <div class="row">
        @if($allpage > 1)
            <div class="col-md-12" style="height:40px;"></div>
        @endif
        <div class="col-md-6">
            <div class="dataTables_info" id="example-1_info" role="status" aria-live="polite">
                {!! trans('messages.showing',['from'=>$from,'to'=>$to,'total'=>$_form->total()]) !!}<br/><br/>
            </div>
        </div>
        @if($allpage > 1)
            <div class="col-md-6 text-right">
                <div class="dataTables_paginate paging_simple_numbers" >
                    @if($_form->currentPage() > 1)
                        <a class="btn btn-white paginate-link" href="#" data-page="{!! $_form->currentPage()-1 !!}">{!! trans('messages.prev') !!}</a>
                    @endif
                    @if($_form->lastPage() > 1)
                        <?php echo Form::selectRange('page', 1, $_form->lastPage(),$_form->currentPage(),['class'=>'form-control paginate-select']); ?>
                    @endif
                    @if($_form->hasMorePages())
                        <a class="btn btn-white paginate-link" href="#" data-page="{!! $_form->currentPage()+1 !!}">{!! trans('messages.next') !!}</a>
                    @endif
                </div>
            </div>
        @endif
    </div>
    <table class="table table-bordered table-striped" id="p-list" width="100%">
        @if(!empty($_form))
            <thead>
            <tr>
                <th>Property Name</th>
                <th>Province</th>
                <th>Code</th>
                <th>Status</th>
                <th>created date</th>
                <th>updated date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody class="middle-align">
            @foreach($property_demo as $row)
                <tr>
                    <td>{!!$row->property->property_name_th!!}</td>
                    <td>{!!$provinces[$row->province]!!}</td>
                    <td>{!!$row->form_code!!}</td>
                    <td>{!! trans('messages.PropertyForm.status_'.$row->status) !!}</td>
                    <td>{!!date('d M Y H:i',strtotime($row->created_at))!!}</td>
                    <td>{!!date('d M Y H:i',strtotime($row->updated_at))!!}</td>
                    <td class="action-links">
                        @if($row->status == 1)
                            <a href="{!! url('officer/property-form/view/'.$row->id) !!}" class="btn btn-success btn-sm btn-icon icon-left">
                                <i class="fa-eye"></i>
                            </a>
                        @else
                            <a href="#" data-toggle="modal" data-target="#delete-form" data-form-id="{!! $row->id !!}" class="btn-delete-form btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        @else
            <tr><td>{!! trans('messages.PropertyForm.form_not_found') !!}</td></tr>
        @endif
    </table>

    <div class="row">
        <div class="col-md-6">
            <div class="dataTables_info" id="example-1_info" role="status" aria-live="polite">
                {!! trans('messages.showing',['from'=>$from,'to'=>$to,'total'=>$_form->total()]) !!}
            </div>
        </div>
        @if($allpage > 1)
            <div class="col-md-6 text-right">
                <div class="dataTables_paginate paging_simple_numbers" >
                    @if($_form->currentPage() > 1)
                        <a class="btn btn-white paginate-link" href="#" data-page="{!! $_form->currentPage()-1 !!}">{!! trans('messages.prev') !!}</a>
                    @endif
                    @if($_form->lastPage() > 1)
                        <?php echo Form::selectRange('page', 1, $_form->lastPage(),$_form->currentPage(),['class'=>'form-control paginate-select']); ?>
                    @endif
                    @if($_form->hasMorePages())
                        <a class="btn btn-white paginate-link" href="#" data-page="{!! $_form->currentPage()+1 !!}">{!! trans('messages.next') !!}</a>
                    @endif
                </div>
            </div>
        @endif
    </div>
@else
    <div class="col-sm-12 text-center">{!! trans('messages.PropertyForm.no_form')!!}</div><div class="clearfix"></div>
@endif
