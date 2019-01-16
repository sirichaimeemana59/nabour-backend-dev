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
                    <form method="POST" id="search-form" action="{!! url('report_quotation/ratio/report') !!}" accept-charset="UTF-8" class="form-horizontal">
                        <div class="row">
                            <label class="col-sm-1 control-label">{!! trans('messages.Report.from_date') !!}</label>
                            <div class="col-sm-3">
                                {!! Form::text('from-date', null, array('class'=>'form-control datepicker','data-format'=>'yyyy/mm/dd','id' => 'ie-search-from-date','data-language'=>App::getLocale())); !!}
                            </div>
                            <label class="col-sm-1 control-label">{!! trans('messages.Report.to_date') !!}</label>
                            <div class="col-sm-3">
                                {!! Form::text('to-date', null, array('class'=>'form-control datepicker','data-format'=>'yyyy/mm/dd','id' => 'ie-search-to-date','data-language'=>App::getLocale())); !!}
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
                                {!! Form::select('type_id',unserialize(constant('LEADS_TYPE')),null,array('class'=>'form-control','placeholder'=>'ประเภท')) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-right">
                                    <button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>
                                    <button type="submit" class="btn btn-secondary p-search-property">{!! trans('messages.search') !!}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--end search--}}
    {{--<input type="hidden" name="from" value="{!! $from !!}">--}}
    {{--<input type="hidden" name="to" value="{!! $to !!}">--}}
    @if(!empty($status))

        <form method="POST" id="search-form" action="{!! url('report_quotation_ratio_excel') !!}" accept-charset="UTF-8" class="form-horizontal">
            <input type="hidden" name="from" value="{!! $from !!}">
            <input type="hidden" name="to" value="{!! $to !!}">
            <input type="hidden" name="channel_id" value="{!! $channel !!}">
            <input type="hidden" name="type_id" value="{!! $type !!}">

            <button type="submit" class="btn btn-info btn-primary action-float-right"><i class="fa fa-download"> </i> ดาวน์โหลด</button>
        </form>
        {{--content--}}
<?php
    $channel1=unserialize(constant('LEADS_SOURCE'));
    $type1=unserialize(constant('LEADS_TYPE'));
?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default" id="panel-lead-list">
                <div class="panel-heading">
                    <h3 class="panel-title">Quotation Ratio</h3>
                    <br>
                    <br>
                    @if(!empty($from))
                        <h4 class="panel-title">ผลการค้นหาระหว่างวันที่ {!! localDate($from) !!}  ถึง  {!! localDate($to) !!}</h4>
                    @endif

                    @if(!empty($channel))
                        <h4 class="panel-title">ผลการค้นหาจากแหล่งที่มา :
                            @foreach ($channel1 as $key => $value)
                                @if($channel == $key)
                                    {!! $value !!}
                                @endif
                            @endforeach
                        </h4>
                    @endif

                    @if(!empty($type))
                        <h4 class="panel-title">ผลการค้นหาจากประเภท :
                            @foreach ($type1 as $key => $value)
                                @if($type == $key)
                                    {!! $value !!}
                                @endif
                            @endforeach
                        </h4>
                    @endif

                </div>
                <div class="panel-body" id="landing-property-list">
                    @include('report_quotation.report_quotation_ratio_list_element')
                </div>
            </div>
        </div>
    </div>
    {{--end content--}}
    @endif
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

        function propertyPage (page) {
            var data = $('#search-form').serialize()+'&page='+page;
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