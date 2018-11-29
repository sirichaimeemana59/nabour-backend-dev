var allow_insuf_payment = false;
$(function () {
    $("#payment_method,#payment_bank").selectBoxIt().on('open', function(){
            $(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
    });
    
    $('#payment_method').on('change', function () {
        if($(this).val() == 2) {
            $('#select-bank-block').show();
        } else {
            $('#select-bank-block').hide();
        }
    });

    $('#save-short-pay-btn').on('click', function () {
        allow_insuf_payment = true;
        $('#pay_amount').removeClass('error__');
        $(this).attr('disabled', 'disabled');
        $('#no-save-short-pay-btn').removeAttr('disabled');
        $('#save_short_payment_').val(1);
    })

    $('#no-save-short-pay-btn').on('click', function () {
        allow_insuf_payment = true;
        $('#pay_amount').removeClass('error__');
        $(this).attr('disabled', 'disabled');
        $('#save-short-pay-btn').removeAttr('disabled');
        $('#save_short_payment_').val(0);
    })

    $('#pay_amount').on('keyup', function () {
        var month = 0;
        var remain = $('#pay_amount').val() - $('#remaining-total').val();
        if($('#fine-paid-over').length) remain += Number($('#fine-paid-over').val());
        if(remain > 0) {
            $('.cf-month-paid-insuf').hide();
            $('#balance_amount-label,#balance-cf-amount').html($.number(remain,2));
            $('#payment_amount_').val($('#pay_amount').val());

            if($('#unit_cf_rate').val()) {
                month = Math.floor(remain / $('#unit_cf_rate').val());
                if(month > 0) {
                    $('#balance-cf-month').html(month);
                    var r = remain - (month*$('#unit_cf_rate').val());
                    $('#balance-cf-amount').html($.number(r,2));
                    $('.cf-month-paid-over').show();
                } else {
                    $('.cf-month-paid-over').hide();
                }
            } else {
                $('.cf-month-paid-over').hide();
            }
            $('#cf_month_over').val(month);
        } else if(remain < 0) {
            $('#cf_month_over').val(0);
            $('#balance-cf-amount').html('0.00');
            $('#balance_amount-insuf-label').html($.number(remain,2));
            $('.cf-month-paid-over').hide();
            $('.cf-month-paid-insuf').show();
        } else {
            remain = 0;
            $('#cf_month_over').val(0);
            $('#balance_amount-label,#balance-cf-amount').html($.number(0,2));
            $('.cf-month-paid-over,.cf-month-paid-insuf').hide();
        }

        $('#balance_amount_').val(remain);
        allow_insuf_payment = false;
        $('.short-pay-btn').removeAttr('disabled');
        $('#save_short_payment_').val(0);
        $(window).resize();
    });
})

function validatePayment () {
    var payValid = false;
    if($('#payment_method').val() === "" ) {
        $('#payment_methodSelectBoxIt').css('border','1px solid #cc3f44');
    } else {
        $('#payment_methodSelectBoxIt').removeAttr('style');
        payValid = true;
    }
    return payValid;
}

function checkBankPayment () {
    var payValid = false;
    if($('#payment_method').val() == 2) {
        if($('#payment_bank').val() == "") {
            $('#payment_bankSelectBoxIt').css('border','1px solid #cc3f44');
        } else {
            $('#payment_bankSelectBoxIt').removeAttr('style');
            payValid = true;
        }
    } else {
        $('#payment_bankSelectBoxIt').removeAttr('style');
        payValid = true;
    }
    return payValid;
}

 function mustGreaterThanTotal (id) {
    var r = Number($('#remaining-total').val());
    var p = Number($('#pay_amount').val());
    if( p > 0){
        if(!allow_insuf_payment) {
            if((r <= p)) {
                $('#pay_amount').removeClass('error__');
                return true;
            } else {
                $('#pay_amount').addClass('error__');
                return false;
            }
        } else {
            $('#pay_amount').removeClass('error__');
            return true;
        }
    } else {
        $('#pay_amount').addClass('error__');
        return false;
    }
}