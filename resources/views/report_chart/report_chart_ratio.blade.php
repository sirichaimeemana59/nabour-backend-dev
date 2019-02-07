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
            <div class="panel panel-default" id="panel-lead-list">
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
                                {!! Form::select('type_id',unserialize(constant('LEADS_TYPE')),null,array('class'=>'form-control','placeholder'=>'ประเภท')) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12 text-right">
                                <button type="reset" class="btn btn-white reset-s-btn">{!! trans('messages.reset') !!}</button>
                                <button type="button" class="btn btn-secondary search_ratio_chart_all" id="search_ratio_chart_all">{!! trans('messages.search') !!}</button>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
          </div>
    </div>
    </div>
    {{--End Menu tab--}}
    <div class="row show-chart" style="display: none;">
        <div class="col-md-12">
            <div class="panel panel-default" id="panel-lead-list">
                <div class="panel-heading">
                    <h3 class="panel-title">Quotation Ratio</h3>
                    <br>
                    <br>
                </div>
                <div class="panel-body" id="landing-property-list">
                    @include('report_chart.report_chart_ratio_element')
                </div>
            </div>
        </div>
    </div>
    {{--end content--}}
    {{--@endif--}}
@endsection

@section('script')
    {{--<script type="text/javascript" src="{!! url('/')!!}/js/admin_report_chart.js"></script>--}}
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
    <script>
        $('#search-year').on('click', function () {
            var _this = $(this);
            _this.prepend('<i class="fa-spin fa-spinner"></i> ');
            _this.attr('disabled');
            $('#chart-year').css('opacity', '0.6');
            var parent_ = $(this).parents('form');
            var data = parent_.serialize();
            //alert(data);
            $.ajax({
                url: $('#root-url').val() + "/report_quotation/report/chart/ratio_lead",
                data: data,
                dataType: "json",
                method: 'post',
                success: function (h) {
                    renderGraph_ratio(h);
                    renderGraph_quotation(h);
                    renderGraph_quotation_sum_ratio(h);
                    _this.removeAttr('disabled').find('i').remove();
                }
            })
        });

        $('#search_ratio_chart_all').on('click', function () {
            if (!$(this).is(':disabled')) {
                var _this = $(this);
                _this.prepend('<i class="fa-spin fa-spinner"></i> ');
                _this.attr('disabled');
                $('#chart-year').css('opacity', '0.6');
                var parent_ = $(this).parents('form');
                var data = parent_.serialize();
                //alert(data);
                $.ajax({
                    url: $('#root-url').val() + "/report_quotation/report/chart/ratio_lead",
                    data: data,
                    dataType: "json",
                    method: 'post',
                    success: function (h) {
                        renderGraph_ratio(h);
                        renderGraph_quotation(h);
                        renderGraph_quotation_sum_ratio(h);
                        _this.removeAttr('disabled').find('i').remove();
                    }
                })
            }
        });

        function renderGraph_ratio (h) {
            $('.show-chart').show();
            var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var number = ['12.5','14','19','17','18','25.5','14.0','15.26','25.60','25.69','22.50'];

            var dataSource_ratio = [];
            var leads=0,customer = 0;
            var text_ ="";

            for (var i = 0; i < h.leads.length; i++) {
                leads += h.leads[i] << 0;
            }
            for (var i = 0; i < h.customer.length; i++) {
                customer += h.customer[i] << 0;
            }

            var per = ((leads/customer)*100).toFixed(2);

            $.each(h.leads, function (i,v) {
                if(h.leads) {
                    dataSource_ratio.push({type:month[i],value:v,number:h.customer[i]});
                }
            });

            text_ ="Leads/Customer Ratio in " + per + "%";
            //console.log(dataSource_ratio);

            $('#chart_ratio').dxChart('instance').option('dataSource', dataSource_ratio);
            $('#chart_ratio').dxChart('instance').render();

            $('#reqs-per-second-ratio').dxCircularGauge('instance').option('value', per);
            $('#reqs-per-second-ratio').dxCircularGauge('instance').render();

            $('#chart_ratio').dxChart('instance').option('title', text_);
            $('#chart_ratio').dxChart('instance').render();

            $('#per-ratio-lead').html("Leads/Customer Ratio in " + per + "%");
            // text ="Leads/Customer Ratio in " + per + "%";
            $('#per_ratio').html(per);
            $('#total_lead_ratio').html("Total Leads is. " + leads);
            $('#total_customer_ratio').html("Total Customer is. " + customer);

            //console.log(dataSource_target);
        }

        $(function(){
            $("#chart_ratio").dxChart({
                palette: "Violet",
                dataSource: dataSource_ratio,
                commonSeriesSettings: {
                    argumentField: "type",
                    type: "line"
                },
                margin: {
                    bottom: 20
                },
                argumentAxis: {
                    valueMarginsEnabled: false,
                    discreteAxisDivisionMode: "crossLabels",
                    grid: {
                        visible: true
                    }
                },
                series: [
                    { valueField: "value", name: "Leads" },
                    { valueField: "number", name: "Customer" },
                ],
                legend: {
                    verticalAlignment: "bottom",
                    horizontalAlignment: "center",
                    itemTextPosition: "bottom"
                },
                title: {
                    text: text_,
                    subtitle: {
                        text: "(Millions of Tons, Oil Equivalent)"
                    }
                },
                "export": {
                    enabled: true
                },
                tooltip: {
                    enabled: true,
                    customizeTooltip: function (arg) {
                        return {
                            text: arg.valueText
                        };
                    }
                }
            }).dxChart("instance");
        });

        var dataSource_ratio = [];

        jQuery(document).ready(function($)
        {

            if( ! $.isFunction($.fn.dxChart))
                return;

            var gaugesPalette = ['#8dc63f', '#40bbea', '#ffba00', '#cc3f44'];

            // Requests per second gauge
            $('#reqs-per-second-ratio').dxCircularGauge({
                scale: {
                    startValue: 0,
                    endValue: 200,
                    majorTick: {
                        tickInterval: 50
                    }
                },
                rangeContainer: {
                    palette: 'pastel',
                    width: 3,
                    ranges: [
                        {
                            startValue: 0,
                            endValue: 50,
                            color: gaugesPalette[0]
                        }, {
                            startValue: 50,
                            endValue: 100,
                            color: gaugesPalette[1]
                        }, {
                            startValue: 100,
                            endValue: 150,
                            color: gaugesPalette[2]
                        }, {
                            startValue: 150,
                            endValue: 200,
                            color: gaugesPalette[3]
                        }
                    ],
                },
                value: per,
                valueIndicator: {
                    offset: 10,
                    color: '#2c2e2f',
                    spindleSize: 12
                }
            });
        });

        //Quotation
        function renderGraph_quotation (h) {
            var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var number = ['12.5','14','19','17','18','25.5','14.0','15.26','25.60','25.69','22.50'];

            var rDataSource = [];
            var text_ = '';
            var approved=0,_approved = 0;

            for (var i = 0; i < h.approved.length; i++) {
                approved += h.approved[i] << 0;
            }
            for (var i = 0; i < h._approved.length; i++) {
                _approved += h._approved[i] << 0;
            }

            var total_quotation = approved+_approved;
            var per = ((approved/total_quotation)*100).toFixed(2);

            $.each(h.approved, function (i,v) {
                if(v <= 0){
                    var x=0;
                    if(h._approved[i] <=0){
                        var y=0;
                        rDataSource.push({type:month[i],value:x,number:y});
                    }
                }else{
                    if(h._approved[i] <=0){
                        var y=0;
                        rDataSource.push({type:month[i],value:v,number:y});
                    }else{
                        rDataSource.push({type:month[i],value:v,number:h._approved[i]});
                    }
                }
            });

            text_ ="Quotation/Contract Ratio in " + per + "%";

            $('#chart_quotation_ratio').dxChart('instance').option('dataSource', rDataSource);
            $('#chart_quotation_ratio').dxChart('instance').render();

            $('#reqs-per-second-quotation').dxCircularGauge('instance').option('value', per);
            $('#reqs-per-second-quotation').dxCircularGauge('instance').render();

            $('#chart_quotation_ratio').dxChart('instance').option('title', text_);
            $('#chart_quotation_ratio').dxChart('instance').render();

            //$('#per').html("Quotation/Contract Ratio in " + per + "%");
            $('#per_quotation').html(per);
            $('#total_quotation_app').html("Quotation Approved " + approved);
            $('#total_quotation_nonapp').html("Quotation Non-Approved " + _approved);
        }

        $(function(){
            $("#chart_quotation_ratio").dxChart({
                palette: "Violet",
                dataSource: rDataSource,
                commonSeriesSettings: {
                    argumentField: "type",
                    type: "line"
                },
                margin: {
                    bottom: 20
                },
                argumentAxis: {
                    valueMarginsEnabled: false,
                    discreteAxisDivisionMode: "crossLabels",
                    grid: {
                        visible: true
                    }
                },
                series: [
                    { valueField: "value", name: "Quotation_Approved" },
                    { valueField: "number", name: "Quotation_Non_Approved" },
                ],
                legend: {
                    verticalAlignment: "bottom",
                    horizontalAlignment: "center",
                    itemTextPosition: "bottom"
                },
                title: {
                    text: text_,
                    subtitle: {
                        text: "(Millions of Tons, Oil Equivalent)"
                    }
                },
                "export": {
                    enabled: true
                },
                tooltip: {
                    enabled: true,
                    customizeTooltip: function (arg) {
                        return {
                            text: arg.valueText
                        };
                    }
                }
            }).dxChart("instance");
        });

        var rDataSource = [];

        jQuery(document).ready(function($)
        {

            if( ! $.isFunction($.fn.dxChart))
                return;

            var gaugesPalette = ['#8dc63f', '#40bbea', '#ffba00', '#cc3f44'];

            // Requests per second gauge
            $('#reqs-per-second-quotation').dxCircularGauge({
                scale: {
                    startValue: 0,
                    endValue: 200,
                    majorTick: {
                        tickInterval: 50
                    }
                },
                rangeContainer: {
                    palette: 'pastel',
                    width: 3,
                    ranges: [
                        {
                            startValue: 0,
                            endValue: 50,
                            color: gaugesPalette[0]
                        }, {
                            startValue: 50,
                            endValue: 100,
                            color: gaugesPalette[1]
                        }, {
                            startValue: 100,
                            endValue: 150,
                            color: gaugesPalette[2]
                        }, {
                            startValue: 150,
                            endValue: 200,
                            color: gaugesPalette[3]
                        }
                    ],
                },
                value: per,
                valueIndicator: {
                    offset: 10,
                    color: '#2c2e2f',
                    spindleSize: 12
                }
            });
        });

        //end quotation

        //start quotation_bar
        function renderGraph_quotation_sum_ratio (h) {
            var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
            var number = ['12.5','14','19','17','18','25.5','14.0','15.26','25.60','25.69','22.50'];

            var dataSource_bar = [];
            var text_ = '';
            var approved_sum=0,_approved_sum = 0;

            for (var i = 0; i < h.approved_sum.length; i++) {
                approved_sum += h.approved_sum[i] << 0;
            }
            for (var i = 0; i < h._approved_sum.length; i++) {
                _approved_sum += h._approved_sum[i] << 0;
            }

            var total_quotation = approved_sum+_approved_sum;
            var per = ((approved_sum/total_quotation)*100).toFixed(2);

            $.each(h.approved_sum, function (i,v) {
                if(h.approved_sum[i] <=0 || h._approved_sum[i] <=0){
                    dataSource_bar.push({type:month[i],value:numberWithCommas(0),number:0});
                }else{
                    dataSource_bar.push({type:month[i],value:numberWithCommas(v),number:h._approved_sum[i]});
                }
            });
            //console.log(dataSource_bar);

            text_ ="Quotation/Contract";

            $('#chart_bar_ratio').dxChart('instance').option('dataSource', dataSource_bar);
            $('#chart_bar_ratio').dxChart('instance').render();

            $('#chart_bar_ratio').dxChart('instance').option('title', text_);
            $('#chart_bar_ratio').dxChart('instance').render();

        }
        $('.reset-s-btn').on('click',function () {
            $(this).closest('form').find("input").val("");
            $(this).closest('form').find("select option:selected").removeAttr('selected');
        });

        var dataSource_bar = [];

        $(function(){
            $("#chart_bar_ratio").dxChart({
                dataSource: dataSource_bar,
                commonSeriesSettings: {
                    argumentField: "type",
                    type: "bar",
                    hoverMode: "allArgumentPoints",
                    selectionMode: "allArgumentPoints",
                    label: {
                        visible: true,
                        format: {
                            type: "fixedPoint",
                            precision: 0
                        }
                    }
                },
                series: [
                    { valueField: "value", name: "Quotation_Approved" },
                    { valueField: "number", name: "Quotation_Non_Approved" },
                ],
                title: text_,
                legend: {
                    verticalAlignment: "bottom",
                    horizontalAlignment: "center"
                },
                "export": {
                    enabled: true
                },
                onPointClick: function (e) {
                    e.target.select();
                }
            });
        });

        //stop quotation_bar
    </script>

    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2.css">
    <link rel="stylesheet" href="{!! url('/') !!}/js/select2/select2-bootstrap.css">
@endsection