$(function () {
    $('#input-fine-month').number( true ,0 );
    $('#input-fine-month').on('keyup',function () {
        if($(this).val() == "" || $(this).val() < 3) {
            $(this).val(3)
        }
        //$('#fine-amount-hidden').val($(this).val());
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
function calOverdueDate () {
    var pay_date = $('#payment_date').val();
    var due_date = $('#bill-due-date').val();
    var a = new Date(pay_date);
    var b = new Date(due_date);
    var months;
    months = (a.getFullYear() - b.getFullYear()) * 12;
    months -= b.getMonth();
    months += a.getMonth();
    if (a.getDate() > b.getDate())
    {
        months++;
    }
    var diff = months <= 0 ? 0 : months;
    $('#fine-amount-hidden').val(diff);
    calFine();
}

function calFine() {
    
    var m_count         = $('#fine-amount-hidden').val();
    if(m_count < 7) {
        $('#fine-rate').val($('#fine-rate-setting-1st').val());
    } else {
        $('#fine-rate').val($('#fine-rate-setting-2nd').val());
    }
    var fine_rate       = Number($('#fine-rate').val());
    var bill_total      = Number($('#bill-grand-total').val());
    var cf_remaining    = Number($('#cf-remaining-total').val());
    var bill_sub_total  = Number($('#bill-sub-total').val());

    var old_fine = Number($('#old_fine_total').val());
    var o_month = Number($('#fine-month-setting').val());

    if(cf_remaining > 0 && m_count > o_month) {
        if( old_fine ){
            bill_total      -= old_fine;
            bill_sub_total  -= old_fine;
        }
        $('.fine-row').show();
        var fine            = parseFloat((fine_rate/100)*cf_remaining).toFixed(2);
        if(fine < 0) fine = 0;
        var fine_per_unit   = parseFloat(fine_rate*cf_remaining/100).toFixed(2);
        $('#fine-value-label').html($.number(fine_per_unit,2));
        $('#fine-total').html($.number(fine,2));

        bill_total      += parseFloat(fine);
        bill_sub_total  += parseFloat(fine);

        $('#bill-final-total-label').html($.number(bill_total,2));
        $('#bill-sub-total-label').html($.number(bill_sub_total,2));
        $('#fine-rate-label').html($.number($('#fine-rate').val(),2));

        $('#fine-total-hidden').val(fine);
        $('#fine-price-hidden').val(fine_per_unit);
        $('#fine-amount-hidden').val(m_count);

        var fine_remaining = fine - Number($('#old_fine_instalment').val());
        if(fine_remaining < 0) fine_remaining = 0;
        $('#system-fine-amount').html($.number(fine_remaining,2))
        $('#new_fine_total').val(fine);
        $('#system-fine-total').html($.number(fine,2));

        setInstalment(fine);

        // set min payment amount
        $('#remaining-total,#pay_amount').val(bill_total);
        $('#pay_amount-label,#remain_amount-label').html($.number(bill_total,2));

        getTotalText (bill_total);
    } else {
        cancelFine();
    }
    // set min payment amount
    $('#remaining-total,#pay_amount').val(bill_total);
    $('#pay_amount-label,#remain_amount-label').html($.number(bill_total,2));
   
}

function cancelFine() {
    $('.fine-row').hide();
    $('.fine-input-hidden').val(0);
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