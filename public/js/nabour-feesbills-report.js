var firstVisitYearTab = true;
var firstVisitMonthTab = true;
var firstVisitCFMonthTab = true;
var firstVisitDebtorTab = true;
var firstVisitInvoiceReceiptTab = true;
var firstVisitReceiptInvoiceTab = true;
var dataSource = [];
var series = [{
        argumentField: "type",
        valueField: "value",
        label:{
            visible: true,
            connector:{
                visible:true,
                width: 1
            },
            font: {
                family: 'thaisans_neueregular',
                size: 16
            }
        }
    }];
var legend = {
        orientation: "horizontal",
        itemTextPosition: "right",
        horizontalAlignment: "right",
        verticalAlignment: "bottom",
        columnCount: 4,
        font: {
            family: 'thaisans_neueregular',
            size: 16
        }
    };
$(function(){
    $('select').selectBoxIt().on('open', function(){
        $(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
    });

    $('.nav-tabs').on('click', 'li', function () {
        if(!$(this).hasClass('active')) {
            var _t = $(this).find('a').attr('href');
            $('section,.section').hide();
            if(_t == '#month') {
                //$('section').hide();
                if(!firstVisitMonthTab) {
                    $('#chart-month').show();
                }
            } else if(_t == '#year') {
                if(!firstVisitYearTab) {
                    $('#chart-year').show();
                }
            } else if(_t == '#cf') {
                if(!firstVisitCFMonthTab) {
                    $('#cf-report').show();
               }
            } else if(_t == '#debtor') {
                if(!firstVisitDebtorTab) {
                    $('#debtor-report').show();
                }
            } else if(_t == '#invoice-receipt') {
                if(!firstVisitInvoiceReceiptTab) {
                    $('#invoice-receipt-report').show();
                }
            } else {
                if(!firstVisitReceiptInvoiceTab) {
                    $('#receipt-invoice-report').show();
                }
            }
        }
        $('#chart-none').hide();
    });

    $('#submit-cf-report').on('click', function () {
        if(!$(this).is('[disabled=disabled]')) {
            var _this = $(this);
            _this.prepend('<i class="fa-spin fa-spinner"></i> ').attr('disabled');
            $('#cf-report').css('opacity','0.6');
            var parent_ = $(this).parents('form');
            var data = parent_.serialize();
            $.ajax({
                url     : $('#root-url').val()+"/fees-bills/report/cf",
                data    : data,
                dataType: "html",
                method: 'post',
                success: function (h) {
                    firstVisitCFMonthTab = false;
                    $('#cf-report').show();
                    $('#cf-report .panel').html(h);
                    $('#cf-report').css('opacity','1');
                    _this.removeAttr('disabled').find('i').remove();
                }
            })
        }
    })
});

function renderGraph (type,h) {
    if(type == 'm') {
        $('#chart-month').show().css('opacity','1');
    } else {
        $('#chart-year').show().css('opacity','1');
    }

    var rDataSource = [];
    $('#'+type+'-summary-chart-block').removeClass('col-sm-6').addClass('col-sm-3');
     $('#'+type+'-total-chart-block').removeClass('col-sm-12').addClass('col-sm-9');
    if(h.income.total != 0) {
        $('#'+type+'-income-chart-block').show();
         $.each(h.income, function (i,v) {
            if(i != 'total') {
                rDataSource.push({type:i,value:v});
            }
        })
        $('#'+type+'-income-chart').dxPieChart('instance').option('dataSource', rDataSource);
        $('#'+type+'-income-chart').dxPieChart('instance').render();
    } else {
        $('#'+type+'-income-chart-block').hide();
    }

    rDataSource = [];
    if(h.expense.total != 0) {
        $('#'+type+'-expense-chart-block').show();
        $.each(h.expense, function (i,v) {
            if(i != 'total') {
                rDataSource.push({type:i,value:v});
            }
        })
        $('#'+type+'-expense-chart').dxPieChart('instance').option('dataSource', rDataSource);
        $('#'+type+'-expense-chart').dxPieChart('instance').render();
    } else {
        $('#'+type+'-expense-chart-block').hide();
    }

    if(h.expense.total == 0 || h.income.total == 0) {
        $('#'+type+'-summary-chart-block').removeClass('col-sm-3').addClass('col-sm-6');
        $('#'+type+'-total-chart-block').removeClass('col-sm-9').addClass('col-sm-12');
    }

    //if(h.total) {
        rDataSource = [];
        $.each(h.total, function (i,v) {
            rDataSource.push({type:i,value:v});
        })
        $('#'+type+'-total-chart').dxPieChart('instance').option('dataSource', rDataSource);
        $('#'+type+'-total-chart').dxPieChart('instance').render();
    //}


    $('#total-'+type+'-income').html($.number(  h.income.total, 2 ));
    $('#total-'+type+'-expense').html($.number( h.expense.total, 2 ));
    $('#total-'+type+'-discount').html($.number( h.discount, 2 ));
    $('#total-'+type+'-balances').html($.number( h.balances, 2 ));

    $('#chart-none').hide();

    if(h.fund.result) {
        $('#'+type+'-fund_get').html($.number( h.fund.get, 2 ));
        $('#'+type+'-fund_pay').html($.number( h.fund.pay, 2 ));
        $('#'+type+'-fund_balance').html($.number( h.fund.balance, 2 ));
    }
}
