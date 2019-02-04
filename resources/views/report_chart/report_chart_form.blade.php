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
    {{--Menu tab--}}
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-tabs">
                <li class="active">
                    <a href="#lead" data-toggle="tab" aria-expanded="false">
                        <span>Leads And Customer</span>
                    </a>
                </li>
                <li>
                    <a href="#quotation" data-toggle="tab" aria-expanded="false">
                        <span>Quotation And Contract</span>
                    </a>
                </li>
                <li>
                    <a href="#quotation" data-toggle="tab" aria-expanded="false">
                        <span>Set Target</span>
                    </a>
                </li>
            </ul>

            {{--content--}}
            <div class="tab-content">
                <div class="tab-pane active" id="lead">
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
                                {!! Form::select('type_id',unserialize(constant('LEADS_TYPE')),null,array('class'=>'form-control','placeholder'=>'ประเภท')) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>
                                <button type="button" class="btn btn-secondary p-search-property" id="p-search-property">{!! trans('messages.search') !!}</button>
                            </div>
                        </div>
                    </form>
                </div>
                    <div class="tab-pane" id="quotation">
                        <form method="POST" id="search-form" action="#" accept-charset="UTF-8" class="form-horizontal">
                            <div class="row">
                                <label class="col-sm-1 control-label">ชื่อ</label>
                                <div class="col-sm-3">
                                    <select name="name" id="name" class="form-control">
                                        <option value="">กรุณาเลือกชื่อลูกค้า</option>
                                        @foreach($p_rows as $row)
                                            <option value="{!! $row->id !!}">{!! $row->firstname !!}  {!! $row->lastname !!}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <label class="col-sm-2 control-label">พนักงานขาย</label>
                                <div class="col-sm-3">
                                    <select name="sale_id" id="sale_id" class="form-control">
                                        <option value="">กรุณาเลือกพนักงานขาย</option>
                                        @foreach($sale as $srow)
                                            <option value="{!!$srow->id!!}">{!!$srow->name!!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="col-sm-1 control-label">ปี</label>
                                <div class="col-sm-3">
                                    <select name="year" id="year" class="form-control">
                                        @foreach($year as $key => $value)
                                            <option value="{!! $value !!}">{!! $value !!}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 text-right">
                                    <button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>
                                    <button type="button" class="btn btn-secondary p-search-quotation" id="p-search-quotation">{!! trans('messages.search') !!}</button>
                                </div>
                            </div>
                        </form>
                    </div>
    </div>
        </div>
    </div>

    {{--End Menu tab--}}
    <div class="row chart" style="display: none;">
        <div class="col-md-12">
            <div class="panel panel-default" id="panel-lead-list">
                <div class="panel-heading">
                    <h3 class="panel-title">Quotation Ratio</h3>
                    <br>
                    <br>
                </div>
                <div class="panel-body" id="landing-property-list">
                    @include('report_chart.report_chart_form_element')
                </div>
            </div>
        </div>
    </div>
    {{--end content--}}
    {{--@endif--}}
@endsection

@section('script')
    <script type="text/javascript" src="{!! url('/')!!}/js/admin_report_chart.js"></script>
    <script type="text/javascript" src="{!! url('/')!!}/js/devexpress-web-14.1/js/globalize.min.js"></script>
    <script type="text/javascript" src="{!! url('/')!!}/js/devexpress-web-14.1/js/dx.chartjs.js"></script>
    <script type="text/javascript" src="{!! url('/')!!}/js/xenon-widgets.js"></script>
    <script type="text/javascript" src="{!! url('/')!!}/js/devexpress-web-14.1/js/knockout-3.1.0.js"></script>


    <link rel="stylesheet" href="{!! url('https://cdn3.devexpress.com/jslib/18.2.5/css/dx.light.css') !!}">
    <link rel="stylesheet" href="{!! url('https://cdn3.devexpress.com/jslib/18.2.5/css/dx.common.css') !!}">
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript" src="{!! url('/') !!}/js/datepicker/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="{!! url('/') !!}/js/datepicker/bootstrap-datepicker.th.js"></script>
    {{--<script type="text/javascript" src="{!!url('/js/selectboxit/jquery.selectBoxIt.min.js')!!}"></script>--}}
    <script type="text/javascript" src="{!!url('/js/select2/select2.min.js')!!}"></script>

    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2.css">
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2-bootstrap.css">
@endsection