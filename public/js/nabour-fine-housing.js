$(function () {
    $('#input-fine-month').number( true ,0 );
    $('#input-fine-month').on('keyup',function () {
        if($(this).val() == "" || $(this).val() < 3) {
            $(this).val(3)
        }
        $('#fine-amount-hidden').val($(this).val());
        $('#fine-month-label').html($(this).val());
        calFine();
    });

    $('#input-fine-rate-per-unit').on('keyup',function () {
        $('#fine-rate-per-unit').val($(this).val());
        calFine();
    });

    $('.cancel-fine').on('click',function (){
        cancelFine ();
    });

    $('#payment_date').datepicker().on("changeDate", function () {
        calOverdueDate();
    })
});

function parseDate(str) {
    return new Date(str);
}

function daydiff () {
    var first = parseDate($('#payment_date').val());
    var second = parseDate($('#bill-due-date').val());
    return Math.round((first-second)/(1000*60*60*24));
}


function calOverdueDate () {
    var difday = daydiff();
    if( $('#fine-type-setting').val() == 2 ) {
        $('#fine-amount-hidden').val(difday);
        $('#input-fine-amount').val($.number(difday,2));
        $('#fine-total-label').html($.number(difday,2));
        calFine();
        //$('.payment-instalments').hide();
    } else {
        if( difday > 0 ) {
            $('#fine-amount-hidden').val(1);
            //$('.payment-instalments').hide();
            calFine();
        } else {
            //$('.payment-instalments').show();
            cancelFine();
        }
    }
}

function calFine() {
    
    var d_count         = $('#fine-amount-hidden').val();
    var bill_total      = Number($('#bill-grand-total').val());
    var bill_sub_total  = Number($('#bill-sub-total').val());
    var fine_rate       = Number($('#fine-rate-setting').val());
    var day_in_year     = Number($('#day-in-year').val());
    var fine;
    var cf_remaining    = Number($('#cf-remaining-total').val());
    var old_fine = Number($('#old_fine_total').val());
    

    var fine_price = Number($('#fine-price-hidden').val());
    if(cf_remaining > 0 && d_count > 0) {
        if( old_fine ){
            bill_total      -= old_fine;
            bill_sub_total  -= old_fine;
        }
        $('.fine-row').show();
        fine = parseFloat(fine_price * d_count).toFixed(2);
        bill_total      += parseFloat(fine);
        bill_sub_total  += parseFloat(fine);
        $('#fine-total').html($.number(fine,2));
        $('#bill-final-total-label').html($.number(bill_total,2));
        $('#bill-sub-total-label').html($.number(bill_sub_total,2));
        $('#fine-rate-label').html($.number($('#fine-rate').val(),2));
        $('#fine-total-hidden').val(fine);
        $('#fine-amount-hidden').val(d_count);

        var fine_remaining = fine - Number($('#old_fine_instalment').val());
        if(fine_remaining < 0) fine_remaining = 0;
        $('#system-fine-amount').html($.number(fine_remaining,2))
        $('#new_fine_total').val(fine.toFixed(2));
        $('#system-fine-total').html($.number(fine,2));

        setInstalment(fine);

        // set min payment amount
        $('#remaining-total,#pay_amount').val(bill_total);
        $('#pay_amount-label,#remain_amount-label').html($.number(bill_total,2));

        getTotalText (bill_total);
        updateAddedFine (fine);
    } else {
        cancelFine();
    }
    // set min payment amount
    $('#remaining-total,#pay_amount').val(bill_total);
    $('#pay_amount-label,#remain_amount-label').html($.number(bill_total,2));
}

function cancelFine() {
    $('.fine-row').hide();
    $('#fine-amount-hidden').val(0);
    $('#cal_fine_flag,#added-fine-amount').val(0);
    $('#bill-sub-total-label').html($.number($('#bill-sub-total').val(),2));
    $('#bill-final-total-label').html($.number($('#bill-grand-total').val(),2));
    var bill_total      = Number($('#bill-grand-total').val());
    $('#remaining-total,#pay_amount').val(bill_total);
    $('#pay_amount-label,#remain_amount-label').html($.number(bill_total,2));
    var sum_int = Number($('#sum-total-instalment-hidden').val());
    $('#instalment-grand-total').html($.number(sum_int,2));
    CalInstalmentTotal ();
    getTotalText (bill_total);
}

function getTotalText (bill_total) {
    //
    bill_total.toFixed(2);
     $.ajax({
        url     : $('#root-url').val()+"/admin/fees-bills/get-total-text",
        data    : ({total:bill_total}),
        dataType: "html",
        method: 'post',
        success: function (h) {
            $('.total-read').html(' '+h+' ');
        }
    })
}

