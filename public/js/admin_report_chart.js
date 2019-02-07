// start chart lead and customer
$('.reset-s-btn').on('click',function () {
    $(this).closest('form').find("input").val("");
    $(this).closest('form').find("select option:selected").removeAttr('selected');
});


$(function () {
    $("#name").select2({
        placeholder: "{{ trans('messages.unit_number') }}",
        allowClear: true,
        dropdownAutoWidth: true
    });
});

$(function () {
    $("#sale_id").select2({
        placeholder: "{{ trans('messages.unit_number') }}",
        allowClear: true,
        dropdownAutoWidth: true
    });
});

$(function () {
    $("#name1").select2({
        placeholder: "{{ trans('messages.unit_number') }}",
        allowClear: true,
        dropdownAutoWidth: true
    });
});

$(function () {
    $("#sale_id1").select2({
        placeholder: "{{ trans('messages.unit_number') }}",
        allowClear: true,
        dropdownAutoWidth: true
    });
});

$(function () {
    $("#year").select2({
        placeholder: "{{ trans('messages.unit_number') }}",
        allowClear: true,
        dropdownAutoWidth: true
    });
});

function numberWithCommas(number) {
    var parts = number.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
$(document).ready(function() {
    $("#agent_commission_model td").each(function() {
        var num = $(this).text();
        var commaNum = numberWithCommas(num);
        $(this).text(commaNum);
    });
});


$('#p-search-property').on('click', function () {
    $('#ie-search-from-date,#ie-search-to-date').removeClass('error');
    if (!$(this).is(':disabled')) {
        var _this = $(this);
        _this.prepend('<i class="fa-spin fa-spinner"></i> ');
        _this.attr('disabled');
        $('#chart-year').css('opacity', '0.6');
        var parent_ = $(this).parents('form');
        var data = parent_.serialize();
        $.ajax({
            url: $('#root-url').val() + "/report_quotation/ratio/report/date",
            data: data,
            dataType: "json",
            method: 'post',
            success: function (h) {
                renderGraph(h);
                _this.removeAttr('disabled').find('i').remove();
            }
        })
    }
});

$('#p-search-property-chart').on('click', function () {
    var _this = $(this);
    _this.prepend('<i class="fa-spin fa-spinner"></i> ');
    _this.attr('disabled');
    $('#chart-year').css('opacity', '0.6');
    var parent_ = $(this).parents('form');
    var data = parent_.serialize();
    //alert(data);
    $.ajax({
        url: $('#root-url').val() + "/report_quotation/ratio/report/date",
        data: data,
        dataType: "json",
        method: 'post',
        success: function (h) {
            renderGraph(h);
            _this.removeAttr('disabled').find('i').remove();
        }
    })
});

function renderGraph (h) {
    $('.chart').show();
    $('.search_year_lead').show();
    $('.search_year_quotaion').hide();
    $('.search_year_sum').hide();
    $('.chart_line').show();
    $('.chart_bar').hide();
    $('.chart_target').hide();
    $('.chart_target_detail').hide();
    var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var number = ['12.5','14','19','17','18','25.5','14.0','15.26','25.60','25.69','22.50'];

    var rDataSource = [];
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
            rDataSource.push({type:month[i],value:v,number:h.customer[i]});
        }
    });
    text_ ="Leads/Customer Ratio in " + per + "%";

    $('#chart').dxChart('instance').option('dataSource', rDataSource);
    $('#chart').dxChart('instance').render();

    $('#reqs-per-second').dxCircularGauge('instance').option('value', per);
    $('#reqs-per-second').dxCircularGauge('instance').render();

    $('#chart').dxChart('instance').option('title', text_);
    $('#chart').dxChart('instance').render();

    $('#per').html("Leads/Customer Ratio in " + per + "%");
    // text ="Leads/Customer Ratio in " + per + "%";
    $('#per_').html(per);
    $('#total_lead').html("Total Leads is. " + leads);
    $('#total_customer').html("Total Customer is. " + customer);
}
$('.reset-s-btn').on('click',function () {
    $(this).closest('form').find("input").val("");
    $(this).closest('form').find("select option:selected").removeAttr('selected');
});

jQuery(document).ready(function($)
{

    if( ! $.isFunction($.fn.dxChart))
        return;

    var gaugesPalette = ['#8dc63f', '#40bbea', '#ffba00', '#cc3f44'];

    // Requests per second gauge
    $('#reqs-per-second').dxCircularGauge({
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

var dataSource = [];
var text_ = '';
var series_name =[];

$(function(){
   $("#chart").dxChart({
        palette: "Violet",
        dataSource: dataSource,
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

// stop chart lead and customer

// start chart quotation and contract
$('#p-search-quotation').on('click', function () {
    if (!$(this).is(':disabled')) {
        var _this = $(this);
        _this.prepend('<i class="fa-spin fa-spinner"></i> ');
        _this.attr('disabled');
        $('#chart-year').css('opacity', '0.6');
        var parent_ = $(this).parents('form');
        var data = parent_.serialize();
        //alert(data);
        $.ajax({
            url: $('#root-url').val() + "/report_quotation/ratio/report/quotation",
            data: data,
            dataType: "json",
            method: 'post',
            success: function (h) {
                renderGraph_quotation(h);
                _this.removeAttr('disabled').find('i').remove();
            }
        })
    }
});

$('#p-search-quotation-chart').on('click', function () {
    if (!$(this).is(':disabled')) {
        var _this = $(this);
        _this.prepend('<i class="fa-spin fa-spinner"></i> ');
        _this.attr('disabled');
        $('#chart-year').css('opacity', '0.6');
        var parent_ = $(this).parents('form');
        var data = parent_.serialize();
        //alert(data);
        $.ajax({
            url: $('#root-url').val() + "/report_quotation/ratio/report/quotation",
            data: data,
            dataType: "json",
            method: 'post',
            success: function (h) {
                renderGraph_quotation(h);
                _this.removeAttr('disabled').find('i').remove();
            }
        })
    }
});

function renderGraph_quotation (h) {
   // console.log(h.qapproved);
    $('.chart').show();
    $('.search_year_quotation').show();
    $('.search_year_lead').hide();
    $('.search_year_sum').hide();
    $('.chart_line').show();
    $('.chart_bar').hide();
    $('.chart_target').hide();
    $('.chart_target_detail').hide();
    var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var number = ['12.5','14','19','17','18','25.5','14.0','15.26','25.60','25.69','22.50'];

    var rDataSource = [];
    var text_ = '';
    var approved=0,_approved = 0;
    // var count_qapproved=0,count_q_approved=0;
    //
    // for (var i = 0; i < h.qapproved.length; i++) {
    //     count_qapproved += h.qapproved[i] << 0;
    //     count_q_approved += h.q_approved[i] << 0;
    // }

    // var total_quotation = count_q_approved+count_qapproved;
    //console.log(count_qapproved);

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

    $('#chart').dxChart('instance').option('dataSource', rDataSource);
    $('#chart').dxChart('instance').render();

    $('#reqs-per-second').dxCircularGauge('instance').option('value', per);
    $('#reqs-per-second').dxCircularGauge('instance').render();

    $('#chart').dxChart('instance').option('title', text_);
    $('#chart').dxChart('instance').render();

    $('#per').html("Quotation/Contract Ratio in " + per + "%");
    $('#per_').html(per);
    $('#total_lead').html("Quotation Approved " + approved);
    $('#total_customer').html("Quotation Non-Approved " + _approved);
}
$('.reset-s-btn').on('click',function () {
    $(this).closest('form').find("input").val("");
    $(this).closest('form').find("select option:selected").removeAttr('selected');
});

// stop chart quotation and contract

//start chart bar quotation/contract
$('#p-search-quotation-sum').on('click', function () {
    //alert('bbb');
    if (!$(this).is(':disabled')) {
        var _this = $(this);
        _this.prepend('<i class="fa-spin fa-spinner"></i> ');
        _this.attr('disabled');
        $('#chart-year').css('opacity', '0.6');
        var parent_ = $(this).parents('form');
        var data = parent_.serialize();
        //alert(data);
        $.ajax({
            url: $('#root-url').val() + "/report_quotation/ratio/report/quotation/sum",
            data: data,
            dataType: "json",
            method: 'post',
            success: function (h) {
                renderGraph_quotation_sum(h);
                _this.removeAttr('disabled').find('i').remove();
            }
        })
    }
});

$('#p-search-quotation-sum-year').on('click', function () {
    //alert('aa');
    if (!$(this).is(':disabled')) {
        var _this = $(this);
        _this.prepend('<i class="fa-spin fa-spinner"></i> ');
        _this.attr('disabled');
        $('#chart-year').css('opacity', '0.6');
        var parent_ = $(this).parents('form');
        var data = parent_.serialize();
        //alert(data);
        $.ajax({
            url: $('#root-url').val() + "/report_quotation/ratio/report/quotation/sum",
            data: data,
            dataType: "json",
            method: 'post',
            success: function (h) {
                renderGraph_quotation_sum(h);
                _this.removeAttr('disabled').find('i').remove();
            }
        })
    }
});

function renderGraph_quotation_sum (h) {
    // console.log(h.qapproved);
    $('.chart').show();
    $('.search_year_quotation').hide();
    $('.search_year_lead').hide();
    $('.search_year_sum').show();
    $('.chart_line').hide();
    $('.chart_bar').show();
    $('.chart_target').hide();
    $('.chart_target_detail').hide();
    var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var number = ['12.5','14','19','17','18','25.5','14.0','15.26','25.60','25.69','22.50'];

    var dataSource_bar = [];
    var text_ = '';
    var approved=0,_approved = 0;
    // var count_qapproved=0,count_q_approved=0;
    //
    // for (var i = 0; i < h.qapproved.length; i++) {
    //     count_qapproved += h.qapproved[i] << 0;
    //     count_q_approved += h.q_approved[i] << 0;
    // }

    // var total_quotation = count_q_approved+count_qapproved;
    //console.log(count_qapproved);

    for (var i = 0; i < h.approved.length; i++) {
        approved += h.approved[i] << 0;
    }
    for (var i = 0; i < h._approved.length; i++) {
        _approved += h._approved[i] << 0;
    }


    $.each(h.approved, function (i,v) {
        if(h.approved[i] <=0 || h._approved[i] <=0){
            dataSource_bar.push({type:month[i],value:numberWithCommas(0),number:0});
        }else{
            dataSource_bar.push({type:month[i],value:numberWithCommas(v),number:h._approved[i]});
        }
    });

   //console.log(dataSource_bar);

    text_ ="Quotation/Contract";

    $('#chart_bar').dxChart('instance').option('dataSource', dataSource_bar);
    $('#chart_bar').dxChart('instance').render();

    // $('#reqs-per-second').dxCircularGauge('instance').option('value', per);
    // $('#reqs-per-second').dxCircularGauge('instance').render();

    $('#chart_bar').dxChart('instance').option('title', text_);
    $('#chart_bar').dxChart('instance').render();

    //$('#per').html("Quotation/Contract Ratio in " + per + "%");
    // $('#per_').html(per);
    // $('#total_lead').html("Quotation Approved " + approved);
    // $('#total_customer').html("Quotation Non-Approved " + _approved);
}
$('.reset-s-btn').on('click',function () {
    $(this).closest('form').find("input").val("");
    $(this).closest('form').find("select option:selected").removeAttr('selected');
});

var dataSource_bar = [];

$(function(){
    $("#chart_bar").dxChart({
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

//stop chart bar quotation/contract


//Start Tar Get Quotation_Contract
$('#p-search-budget').on('click', function () {
    if (!$(this).is(':disabled')) {
        var _this = $(this);
        _this.prepend('<i class="fa-spin fa-spinner"></i> ');
        _this.attr('disabled');
        $('#chart-year').css('opacity', '0.6');
        var parent_ = $(this).parents('form');
        var data = parent_.serialize();
        //alert(data);
        $.ajax({
            url: $('#root-url').val() + "/report_quotation/ratio/report/quotation/budget",
            data: data,
            dataType: "json",
            method: 'post',
            success: function (h) {
                renderGraph_target(h);
                _this.removeAttr('disabled').find('i').remove();
            }
        })
    }
});

function renderGraph_target (h) {
    $('.chart').hide();
    $('.search_year_lead').hide();
    $('.search_year_quotaion').hide();
    $('.search_year_sum').hide();
    $('.chart_line').hide();
    $('.chart_bar').hide();
    $('.chart_target').show();
    $('.chart_target_detail').show();

    var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var number = ['12.5','14','19','17','18','25.5','14.0','15.26','25.60','25.69','22.50'];

    var dataSource_target = [];

    var approved=0,_approved = 0;

    for (var i = 0; i < h.approved.length; i++) {
        approved += h.approved[i] << 0;
    }
    for (var i = 0; i < h._approved.length; i++) {
        _approved += h._approved[i] << 0;
    }

    $.each(h.approved, function (i,v) {
                dataSource_target.push({type:month[i],value:v,number:h._approved[i]});
    });

    //console.log(dataSource_target);

    $('#chart_target').dxChart('instance').option('dataSource', dataSource_target);
    $('#chart_target').dxChart('instance').render();

    $('#total_lead1').html("Quotation Approved " + approved);
    $('#total_customer1').html("Quotation Non-Approved " + _approved);

    //console.log(dataSource_target);
}
$('.reset-s-btn').on('click',function () {
    $(this).closest('form').find("input").val("");
    $(this).closest('form').find("select option:selected").removeAttr('selected');
});

$(function(){
    $("#chart_target").dxChart({
        palette: "Violet",
        dataSource: dataSource_target,
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
            { valueField: "number", name: "Quotation_Non-Approved" },
        ],
        legend: {
            verticalAlignment: "bottom",
            horizontalAlignment: "center",
            itemTextPosition: "bottom"
        },
        title: {
            text: "Target Quotation/Contract",
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

var dataSource_target = [];

//Stop Tar Get Quotation_Contract