var firstVisitYearTab   = true;
var firstVisitMonthTab  = true;
var dataSource = [];

var series_pie_option = {
    dataSource: dataSource,
    series: {
        argumentField   : 'cate',
        valueField      : 'value',
        label           :
        {
            visible     : true,
            connector   : {
                            visible:true,
                            width: 1
            },
            font        : {
                            family: 'thaisans_neueregular',
                            size: 16
            },
            customizeText     : function(arg) {
                                return arg.valueText + " (" + arg.percentText + ")";
            }
        }
    },
    resolveLabelOverlapping:'shift',
    title: {
            font: {
                family: 'thaisans_neueregular',
                size: 23
            }
    },
    legend: {
                orientation: "horizontal",
                itemTextPosition: "right",
                horizontalAlignment: "center",
                verticalAlignment: "bottom",
                columnCount: 4,
                font: {
                    family: 'thaisans_neueregular',
                    size: 16
                }
    },
    onPointClick: function(e) {
        var point = e.target;
        point.isVisible() ? point.hide() : point.show();
    }
};

$(function () {
    $("#chart-m-stack,#chart-y-stack").dxChart({
        dataSource: dataSource,
        commonSeriesSettings: {
            argumentField: "cate",
            type: "stackedBar",
            /*label : {
                visible: true,
                font: {
                    family: 'thaisans_neueregular',
                    size: 12
                }
            }*/
        },
        series: serie_chart,
        legend: {
            verticalAlignment: "top",
            horizontalAlignment: "right",
            font: {
                family: 'thaisans_neueregular',
                size: 16
            }
        },
        "export": {
            enabled: true
        },
        title: {
            font: {
                family: 'thaisans_neueregular',
                size: 23
            }
        },
        argumentAxis : {
            label : {
                font: {
                    family: 'thaisans_neueregular',
                    size: 16
                }
            }
        },
        valueAxis: {
            minValueMargin: 1,
            minorGrid: {
                visible: true
            }
        },
        tooltip: {
            enabled: true,
            location: "edge"
        }
    });
    series_pie_option.series.argumentField    = "cate";
    series_pie_option.series.valueField       = "value";
    $("#chart-m-pie,#chart-y-pie").dxPieChart(series_pie_option);
    series_pie_option.series.argumentField    = "status";
    $("#chart-m-status,#chart-y-status").dxPieChart(series_pie_option);

    $('#submit-m-report').on('click',function () {
        var rDataSource = [];
        if(!$(this).is('[disabled=disabled]')) {
            var _this = $(this);
            _this.prepend('<i class="fa-spin fa-spinner"></i> ').attr('disabled');
            $('#chart-month').css('opacity','0.6');
            var parent_ = $(this).parents('form');
            var data = parent_.serialize();
            $.ajax({
                url     : $('#root-url').val()+"/admin/complain/report/month",
                data    : data,
                dataType: "json",
                method: 'post',
                success: function (r) {
                    _this.removeAttr('disabled').find('i').remove();
                    $('#chart-month').css('opacity','1');
                    firstVisitMonthTab = false;
                    if(r.result) {
                        renderChart ('m',r);
                    } else {
                        firstVisitMonthTab = true;
                        $('#chart-month').hide();
                        $('#chart-none').show();
                    }
                }
            });
        }
    });

    $('#submit-y-report').on('click',function () {
        var rDataSource = [];
        if(!$(this).is('[disabled=disabled]')) {
            var _this = $(this);
            _this.prepend('<i class="fa-spin fa-spinner"></i> ').attr('disabled');
            $('#chart-year').css('opacity','0.6');
            var parent_ = $(this).parents('form');
            var data = parent_.serialize();
            $.ajax({
                url     : $('#root-url').val()+"/admin/complain/report/year",
                data    : data,
                dataType: "json",
                method: 'post',
                success: function (r) {
                    _this.removeAttr('disabled').find('i').remove();
                    firstVisitYearTab = false;
                    if(r.result) {
                        renderChart ('y',r);
                    } else {
                        firstVisitYearTab = true;
                        $('#chart-year').hide();
                        $('#chart-none').show();
                    }
                }
            });
        }
    });

    $('.nav-tabs').on('click', 'li', function () {
        if(!$(this).hasClass('active')) {
            var _t = $(this).find('a').attr('href');
            if(_t == '#month') {
                $('#chart-year').hide();
                if(!firstVisitMonthTab) {
                    $('#chart-month').show();
                }
            } else {
                $('#chart-month').hide();
                if(!firstVisitYearTab) {
                    $('#chart-year').show();
                }
            }
        }
        $('#chart-none').hide();
    });

    function renderChart (type,data) {

        if(type == 'm') {
            $('#chart-month').show().css('opacity','1');
        } else {
            $('#chart-year').show().css('opacity','1');
        }

        //Render chart
        $('#chart-'+type+'-stack').dxChart('instance').option({'dataSource':data.graph,title:{text:data.head}});
        $('#chart-'+type+'-stack').dxChart('instance').render();
        //Render Pie chart
        var pResource = [];
        $.each(data.graph, function (i,v) {
            var s = 0;
            var _cate;
            $.each(v, function (j,k) {
                if(j != 'cate') {
                    s += k;
                } else {
                    _cate = k;
                }
            });
            pResource.push({cate:_cate,value:s});
        });
        $('#chart-'+type+'-pie').dxPieChart('instance').option({'dataSource':pResource,title:{text:data.head_pie}});
        $('#chart-'+type+'-pie').dxPieChart('instance').render();

        $('#chart-'+type+'-status').dxPieChart('instance').option({'dataSource':data.status,title:{text:data.head_status}});
        $('#chart-'+type+'-status').dxPieChart('instance').render();
        //render table data
        renderTable (type,pResource);
        renderTimeline (type,data);
    }

    function renderTable (type,pResource) {
        $('#chart-'+type+'-table table tbody').html('');
        var s = 0;
        $.each(pResource, function (i,v) {
            var tb = '<tr><td>'+v.cate+'</td><td style="text-align:right;">'+v.value+'</td></tr>';
            s += v.value;
            $('#chart-'+type+'-table table tbody').append(tb);
        });
        $('#sum-'+type+'-all').html(s);
        $('#chart-none').hide();
        renderTimeline (type,pResource);
    }

    function renderTimeline (type,data) {
        $('#'+type+'-complain-timeline').html(data.timeline);
        $('#'+type+'-timeline-head').html(data.timeline_head);
    }
})
