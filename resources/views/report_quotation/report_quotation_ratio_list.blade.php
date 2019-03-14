@extends('base-admin')
@section('content')
    <div class="page-title">
        <div class="title-env">
            <h1 class="title">Quotation Ratio</h1>
        </div>
        <div class="breadcrumb-env">

            <ol class="breadcrumb bc-1" >
                <li>
                    <a href=""><i class="fa-home"></i>Home</a>
                </li>
                <li><a href="">Quotation Ratio</a></li>
                <li class="active">
                    <strong>List Quotation Ratio</strong>
                </li>
            </ol>
        </div>
    </div>

    {{-- //search --}}
    {{--{!! Auth::user()->role !!}--}}
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">{!! trans('messages.search') !!}</h3>
                </div>
                <div class="panel-body search-form">
                    <form method="POST" id="search-form" action="#" accept-charset="UTF-8" class="form-horizontal">
                        <div class="row">
                            <label class="col-sm-1 control-label">{!! trans('messages.Report.from_date') !!}</label>
                            <div class="col-sm-3">
                                {!! Form::text('from-date', null, array('class'=>'form-control datepicker','data-format'=>'yyyy/mm/dd','id' => 'ie-search-from-date','autocomplete'=>'off','data-language'=>App::getLocale())); !!}
                            </div>
                            <label class="col-sm-1 control-label">{!! trans('messages.Report.to_date') !!}</label>
                            <div class="col-sm-3">
                                {!! Form::text('to-date', null, array('class'=>'form-control datepicker','data-format'=>'yyyy/mm/dd','id' => 'ie-search-to-date','autocomplete'=>'off','data-language'=>App::getLocale())); !!}
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <label class="col-sm-1 control-label">แหล่งที่มา</label>
                            <div class="col-sm-3">
                                {!! Form::select('channel_id',unserialize(constant('LEADS_SOURCE')),null,array('class'=>'form-control','placeholder'=>'แหล่งที่มา')) !!}
                            </div>
                            <label class="col-sm-1 control-label">ประเภท</label>
                            <div class="col-sm-3">
                                {!! Form::select('type_id',unserialize(constant('LEADS_TYPE')),null,array('class'=>'form-control')) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-right">
                                    <button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>
                                    <button type="button" class="btn btn-secondary p-search-property">{!! trans('messages.search') !!}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--end search--}}
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="panel-lead-list">
                <div class="panel-heading">
                    <h3 class="panel-title">Quotation Ratio</h3>
                    <br>
                    <br>
                </div>
                <div class="panel-body" id="landing-property-list">
                    @include('report_quotation.report_quotation_ratio_list_element')
                </div>
            </div>
        </div>
    </div>
    {{--end content--}}
    {{--@endif--}}
@endsection

@section('script')
    <script type="text/javascript" src="{!! url('/')!!}/js/devexpress-web-14.1/js/globalize.min.js"></script>
    <script type="text/javascript" src="{!! url('/')!!}/js/devexpress-web-14.1/js/dx.chartjs.js"></script>
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
            //alert('aaa');
        });

        $('.reset-s-btn').on('click',function () {
            $(this).closest('form').find("input").val("");
            $(this).closest('form').find("select option:selected").removeAttr('selected');
            propertyPage (1);
        });

        function propertyPage (page) {
            var data = $('#search-form').serialize()+'&page='+page;
           //alert(data);
            $('#landing-property-list').css('opacity','0.6');
            $.ajax({
                url     : $('#root-url').val()+"/report_quotation/ratio/report",
                data    : data,
                dataType: "html",
                method: 'post',
                success: function (h) {
                    $('#landing-property-list').css('opacity','1').html(h);
                }
            })
        }

    </script>
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2.css">
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2-bootstrap.css">
@endsection