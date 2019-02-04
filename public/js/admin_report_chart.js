// start chart lead and customer
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
    $("#year").select2({
        placeholder: "{{ trans('messages.unit_number') }}",
        allowClear: true,
        dropdownAutoWidth: true
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

function renderGraph (h) {
    $('.chart').show();
    var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var number = ['12.5','14','19','17','18','25.5','14.0','15.26','25.60','25.69','22.50'];

    var rDataSource = [];
    var leads=0,customer = 0;

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

    $('#chart').dxChart('instance').option('dataSource', rDataSource);
    $('#chart').dxChart('instance').render();

    $('#reqs-per-second').dxCircularGauge('instance').option('value', per);
    $('#reqs-per-second').dxCircularGauge('instance').render();

    $('#chart').dxChart('instance').option('text', per);
    $('#chart').dxChart('instance').render();

    $('#per').html(per);
    $('#per_').html(per);
    $('#total_lead').html(leads);
    $('#total_customer').html(customer);
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

$(function(){
    var chart = $("#chart").dxChart({
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
            text: "Leads/Customer Ratio in 100%",
            subtitle: {
                text: "(Millions of Tons, customer Equivalent)"
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

function renderGraph_quotation (h) {
    $('.chart').show();
    var month = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    var number = ['12.5','14','19','17','18','25.5','14.0','15.26','25.60','25.69','22.50'];

    var rDataSource = [];
    var approved=0,_approved = 0;

    for (var i = 0; i < h.approved.length; i++) {
        approved += h.approved[i] << 0;
    }
    for (var i = 0; i < h._approved.length; i++) {
        _approved += h._approved[i] << 0;
    }

    var per = ((approved/_approved)*100).toFixed(2);

    $.each(h.approved, function (i,v) {
        if(v <= 0){
            var x=0;
            if(h._approved[i] <=0){
                var y=0;
                rDataSource.push({type:month[i],value:x,number:y});
            }
        }else{
            rDataSource.push({type:month[i],value:v,number:h._approved[i]});
        }
    });

    $('#chart').dxChart('instance').option('dataSource', rDataSource);
    $('#chart').dxChart('instance').render();

    $('#reqs-per-second').dxCircularGauge('instance').option('value', per);
    $('#reqs-per-second').dxCircularGauge('instance').render();

    $('#chart').dxChart('instance').option('text', per);
    $('#chart').dxChart('instance').render();

    $('#per').html(per);
    $('#per_').html(per);
    $('#total_lead').html(approved);
    $('#total_customer').html(_approved);
}
$('.reset-s-btn').on('click',function () {
    $(this).closest('form').find("input").val("");
    $(this).closest('form').find("select option:selected").removeAttr('selected');
});

// stop chart quotation and contract