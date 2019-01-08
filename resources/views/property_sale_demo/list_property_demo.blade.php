@extends('base-admin')
@section('content')
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">{!! trans('messages.PropertyForm.page_head') !!}</h1>
            <p class="description">{!! trans('messages.PropertyForm.page_sub_head_admin') !!} </p>
        </div>
        <div class="breadcrumb-env">
            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>{!! trans('messages.page_home') !!}</a>
                </li>
                <li class="active"><a href="#"> {!! trans('messages.PropertyForm.page_head') !!}</a></li>
            </ol>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{!! trans('messages.search') !!}</h3>
                </div>
                <div class="panel-body search-form">
                    <form method="POST" id="search-form" action="#" accept-charset="UTF-8" class="form-horizontal">
                        <div class="col-sm-3">
                            <input class="form-control" size="25" placeholder="{!! trans('messages.AboutProp.property_name') !!}" name="name">
                        </div>
                        <div class="col-sm-3">
                            {!! Form::select('province',$provinces,null,['id'=>'property-province','class'=>'form-control']) !!}
                        </div>
                        <div class="col-sm-3">
                            {!! Form::select('status', ['-'=>trans('messages.status'),'0'=>trans('messages.PropertyForm.status_0'),'1'=>trans('messages.PropertyForm.status_1')],null,['class'=>'form-control']) !!}
                        </div>
                        <div class="col-sm-2 pull-right">
                            <button type="reset" class="btn btn-white">{!! trans('messages.reset') !!}</button>
                            <button type="button" class="btn btn-secondary p-search-property">{!! trans('messages.search') !!}</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body" id="landing-property-list">
                    @include('property_sale_demo.list_property_demo_element')
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="delete-form">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'officer/property-form/delete','id'=>'delete-form-form']) !!}
                {!! Form::hidden('form_id',null,['id'=>'form-id']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title"><i class="fa-trash"></i> {!! trans('messages.PropertyForm.confirm_delete_head') !!}</h4>
                </div>
                <div class="modal-body"> {!! trans('messages.PropertyForm.confirm_delete_msg') !!} </div>
                <div class="modal-footer">
                    <button type="botton" class="btn btn-default" data-dismiss="modal">{!! trans('messages.cancel') !!}</button>
                    <button type="botton" id="confirm-delete-form" class="btn btn-primary">{!! trans('messages.delete') !!}</button>
                </div>
                {!! Form::close()!!}
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript" src="{!! url('/') !!}/js/datatables/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/datatables/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/jquery-validate/jquery.validate.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/datepicker/bootstrap-datepicker.th.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/selectboxit/jquery.selectBoxIt.min.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/nabour-search-form.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/toastr/toastr.min.js"></script>
    <script type="text/javascript" src="{!!url('/js/selectboxit/jquery.selectBoxIt.min.js')!!}"></script>
    <script type="text/javascript" src="{!!url('/js/select2/select2.min.js')!!}"></script>
    <script type="text/javascript">

        $('.p-search-property').on('click',function () {
            propertyPage (1);
        });

        $(function () {
            $("#property-province").select2({
                placeholder: "{{ trans('messages.unit_number') }}",
                allowClear: true,
                dropdownAutoWidth: true
            });
        });

        function propertyPage (page) {
            var data = $('#search-form').serialize()+'&page='+page;
            $('#landing-property-list').css('opacity','0.6');
            $.ajax({
                url     : $('#root-url').val()+"/sales/demo-property/list-property",
                data    : data,
                dataType: "html",
                method: 'post',
                success: function (h) {
                    $('#landing-property-list').css('opacity','1').html(h);
                    //alert('555');
                }
            })
        }

    </script>
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2.css">
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2-bootstrap.css">
@endsection
