$(function () {

    $('#submit-y-report').on('click', function () {
        if($('#ie-search-from-date').val() != "" && $('#ie-search-to-date').val() != "") {
            $('#ie-search-from-date,#ie-search-to-date').removeClass('error');
            if (!$(this).is(':disabled')) {
                var _this = $(this);
                _this.prepend('<i class="fa-spin fa-spinner"></i> ');
                _this.attr('disabled');
                $('#chart-year').css('opacity', '0.6');
                var parent_ = $(this).parents('form');
                var data = parent_.serialize();
                $.ajax({
                    url: $('#root-url').val() + "/admin/fees-bills/report/year",
                    data: data,
                    dataType: "json",
                    method: 'post',
                    success: function (h) {
                        firstVisitYearTab = false;
                        if (h.status) {
                            renderGraph('y', h);
                            renderRealIncome('y', h);
                            renderExpense('y', h);
                            renderBankBalance('y', h);
                            renderCashOnHand('y', h);

                            //var year_ = $('#year-report-input-year :selected').val();
                            //var year_label = $('#year-report-input-year :selected').html();
                            var from = $('#ie-search-from-date').val();
                            var to = $('#ie-search-to-date').val();

                            $('.ie-from-date-input').val(from);
                            $('.ie-to-date-input').val(to);
                            //$('#report-dl-input,#y-my-cash-flow-report-dl-input').val(year_);
                            //$('.year_label').html(year_label);
                        } else {
                            firstVisitYearTab = true;
                            $('#chart-year').hide();
                            $('#chart-none').show();
                        }
                        _this.removeAttr('disabled').find('i').remove();
                    }
                })
            }
        } else {
            if($('#ie-search-from-date').val() == "") $('#ie-search-from-date').addClass('error');
            if($('#ie-search-to-date').val() == "") $('#ie-search-to-date').addClass('error');
        }
    });

    $('#submit-debtor-report').on('click', function () {
         if(!$(this).is(':disabled')) {
            var _this = $(this);
            _this.prepend('<i class="fa-spin fa-spinner"></i> ');
            _this.attr('disabled');
            $('#debtor-report').css('opacity','0.6');
            var parent_ = $(this).parents('form');
            var data = parent_.serialize();
            $.ajax({
                url     : $('#root-url').val()+"/admin/fees-bills/report/debtor",
                data    : data,
                dataType: "html",
                method: 'post',
                success: function (h) {
                    $('#debtor-report').show();
                    $('#debtor-report').html(h);
                    $('#debtor-report').css('opacity','1');
                    _this.removeAttr('disabled').find('i').remove();
                    firstVisitDebtorTab = false;
                    //$('.general-table').fixedHeaderTable({ footer: false, cloneHeadToFoot: true, fixedColumn: false });

                     $('.general-table').floatThead({scrollContainer: function($table){
                         return $table.closest('.table-responsive');
                     }});
                }
            });
         }
    });

    $('#submit-invoice-receipt-report').on('click', function () {
        if(!$(this).is(':disabled')) {
            var _this = $(this);
            _this.prepend('<i class="fa-spin fa-spinner"></i> ');
            _this.attr('disabled');
            $('#invoice-receipt-report').css('opacity','0.6');
            var parent_ = $(this).parents('form');
            var data = parent_.serialize();
            $.ajax({
                url     : $('#root-url').val()+"/admin/fees-bills/report/invoice-receipt",
                data    : data,
                dataType: "html",
                method: 'post',
                success: function (h) {
                    $('#invoice-receipt-report').show();
                    $('#invoice-receipt-report').html(h);
                    $('#invoice-receipt-report').css('opacity','1');
                    _this.removeAttr('disabled').find('i').remove();
                    firstVisitInvoiceReceiptTab = false;
                    $('.receipt-table').floatThead({scrollContainer: function($table){
                        return $table.closest('.table-responsive');
                    }});
                }
            });
        }
    });

    $('#submit-receipt-invoice-report').on('click', function () {
        var $start = $('input[name=start-payment-date]');
        var $end = $('input[name=end-payment-date]');
        if( $start.val() != "" && $end.val() != "") {
            $('input[name=start-payment-date]').removeClass('error');
            $('input[name=end-payment-date]').removeClass('error');
            if(!$(this).is(':disabled')) {
                var _this = $(this);
                _this.prepend('<i class="fa-spin fa-spinner"></i> ');
                _this.attr('disabled');
                $('#receipt-invoice-report').css('opacity','0.6');
                var parent_ = $(this).parents('form');
                var data = parent_.serialize();
                $.ajax({
                    url     : $('#root-url').val()+"/admin/fees-bills/report/receipt-invoice",
                    data    : data,
                    dataType: "html",
                    method: 'post',
                    success: function (h) {
                        $('#receipt-invoice-report').show();
                        $('#receipt-invoice-report').html(h);
                        $('#receipt-invoice-report').css('opacity','1');
                        _this.removeAttr('disabled').find('i').remove();
                        firstVisitReceiptInvoiceTab = false;
                        $('.receipt-invoice-table').floatThead({scrollContainer: function($table){
                            return $table.closest('.table-responsive');
                        }});
                    }
                });
            }
        } else {
            if($start.val() == "") {
                $start.addClass('error');
            } else {
                $start.removeClass('error');
            }

            if($end.val() == "") {
                $end.addClass('error');
            } else {
                $end.removeClass('error');
            }
        }
    });
})

function renderRealIncome (type,h) {
    var real_income = h.real_balances.real_income - h.total.forward_balance;
    var real_paid   =  h.real_balances.paid - h.total.forward_balance;
    $('#'+type+'-real_income').html($.number( real_income, 2 ));
    $('#'+type+'-real_paid').html($.number( real_paid, 2 ));
    $('#'+type+'-real_unpaid').html($.number( h.real_balances.unpaid, 2 ));
    $('#'+type+'-total_int').html(h.real_balances.int_invoice);
    $('#'+type+'-forward_balance').html($.number( h.total.forward_balance, 2 ));

    if(h.real_balances.unpaid > 0) {
        $('.'+type+'-has_ramining_invoice').show();
        $('#'+type+'-total_int_remaining').html($.number( h.real_balances.int_unpaid, 2 ));
        $('#'+type+'-total_ext').html(h.real_balances.ext_invoice);
        $('#'+type+'-total_ext_remaining').html($.number( h.real_balances.ext_unpaid, 2 ));
    } else {
        $('.'+type+'-has_ramining_invoice').hide();
    }
}

function renderExpense (type,h) {
    $('#'+type+'-expense-summary-table').html('');
    if(!h.expense) {
        $('#'+type+'-expense-summary').hide();
    } else {
        var sum_e = 0;
        $.each(h.expense,function (i,v) {
            if(i != 'total') {
                var row = $('<tr/>').append(
                    $('<th/>').html(i)
                ).append(
                    $('<td/>').html($.number(v,2)+' '+$('#baht').val())
                );
                //sum_e += v;
                $('#'+type+'-expense-summary-table').append(row);
            } else {
                // sum_e -= v;
            }
            
        });
        // summary row
        var row = $('<tr/>').append(
                $('<th/>').css('text-align','right').html($('#summary').val())
        ).append(
            $('<td/>').html($.number(h.expense.total,2)+' '+$('#baht').val())
        );
        $('#'+type+'-expense-summary-table').append(row);
        $('#'+type+'-expense-summary').show();
    }
}

function renderBankBalance (type,h) {
    if(h.bank_balance_result.result) {
        if(h.bank_balance_result.bank) {
            $.each(h.bank_balance_result.bank,function (i,v) {
                $('#'+type+'-'+i+'-get').html($.number(v.get,2));
                $('#'+type+'-'+i+'-pay').html($.number(v.pay,2));
                $('#'+type+'-'+i+'-balance').html($.number(v.balance,2));
            });
        }
        
    }
}

function renderCashOnHand (type,h) {
    $('#'+type+'-cash-on-hand').html($.number(h.cash_on_hand.balance,2));
    $('#'+type+'-cash-on-hand-count').html(h.cash_on_hand.count);
}