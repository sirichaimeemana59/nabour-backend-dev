$(function () {
    $('.instalment-input-amount').number(true,2);

    $('.instalment-input-amount').on('keyup', function () {
        checkFineInstalment();
        CalInstalmentTotal ();
    });

    /*$('.payment-instalments').on('click', function () {
       // validAddForm.form();
        var validPayment = validatePayment();
        var validBank = checkBankPayment();
        if(validAddForm.valid() && validPayment && validBank) {
            $('#instalment-modal').modal('show');
        }
    });*/

    $('#submit-instalment-form').on('click', function () {
        var validMaxAmount = validMax ();
        if( validMaxAmount && validPay () ) {
            $('#hidden_payment_type').val($('#payment_method').val());
            $('#hidden_payment_date').val($('#payment_date').val());
            $('#hidden_payment_bank').val($('#payment_bank').val());
            $('.payment-evidence input[type="hidden"]').each(function () {
                $(this).clone().appendTo( "#hidden-input");
            });
            $('#instalment-form').submit();
            $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
        }
    });
})

function CalInstalmentTotal () {
    var sum_t = 0;
    $('.instalment-input-amount').each(function () {
        sum_t += Number($(this).val());
    });
    $('#instalment-amount').val(sum_t);
    $('#sum-total-instalment').html($.number(sum_t,2));


    var remain = sum_t - $('#remaining-total').val();
    if($('#fine-paid-over').length) remain += Number($('#fine-paid-over').val());
    if(remain < 0) remain = 0;
    //$('#inst-balance_amount_').val(remain);
    $('#balance_instalment_amount_').val(remain);
    $('#inst-balance_amount-label,#inst-balance-cf-amount').html($.number(remain,2));

    if($('#unit_cf_rate').val()) {
        month = Math.floor(remain / $('#unit_cf_rate').val());
        if(month > 0) {
            $('#inst-balance-cf-month').html(month);
            r = remain - (month*$('#unit_cf_rate').val());
            $('#balance_instalment_amount_').val(r);
            $('#inst-balance-cf-amount').html($.number(r,2));
            $('.inst-cf-month-paid-over').show();
        } else {
            $('.inst-cf-month-paid-over').hide();
        }
    } else {
        $('.inst-cf-month-paid-over').hide();
    }
    $('#inst-cf_month_over').val(month);
    $(window).resize();

}

function validPay () {
        if($('#instalment-amount').val() > 0 ) {
            $('.instalment-input-amount').removeClass('error');
            return true;
        } else {
            $('.instalment-input-amount').addClass('error');
            return false;
        }
    }
function validMax () {
    var valid = true;
    var noCompleted = false;
    $('.validate-max .instalment-input-amount').each( function () {
        if($(this).val() > $(this).data('max-amount') ) {
            $(this).addClass('error');
            valid = false;
        } else {
            if($(this).val() < $(this).data('max-amount') ) noCompleted = true;
            $(this).removeClass('error');
        }
    });

    var cftRow = $('.gray .instalment-input-amount');
    if(cftRow.length) {
        if(noCompleted  && cftRow.val() > cftRow.data('max-amount')) {
            valid = false;
            cftRow.addClass('error');
            $('#cf-instalment-error').show();
        } else {
             cftRow.removeClass('error');
            $('#cf-instalment-error').hide();
        }
        $(window).resize();
    }
    
    return valid;
}

function setInstalment (fine) {
    $('#cal_fine_flag').val(1);
    $('#added-fine-amount').attr('data-max-amount',fine);
    $('#added-fine-total').val($.number(fine,2));
    $('#added-fine-total-label').html($.number(fine,2));
    var sum_int = Number($('#sum-total-instalment-hidden').val());
    $('#instalment-grand-total').html($.number(sum_int+fine,2));
}

function checkFineInstalment () {
    var total_cf = Number($('#cf-remaining-total').val());
    total_cf -= Number($('.instalment-input-amount').val());
    if(total_cf <= 0) {
        $('#added-fine-amount').removeAttr('disabled');
    } else {
        $('#added-fine-amount').attr('disabled','disabled');
         $('#added-fine-amount').val('0.00');
    }
}