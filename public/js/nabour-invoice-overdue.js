var validateFineForm = false;
$(function () {

    $('.fine-choice').on('change',function () {
        if($(this).val() == "y") {
            $('#overdue-fine-input').show();
            validateFineForm = true;
        } else {
            $('#overdue-fine-input').hide();
            validateFineForm = false;
        }
        $(window).resize();
    })

    $('#fine-amount').number(true).on('keyup',function () { calFine(); });
    $('#fine-price').number( true ,2).on('keyup',function () { calFine(); });
    $('#fine-total').number( true ,2 );

    function calFine () {
        var _a = Number($('#fine-amount').val());
        var _p = Number($('#fine-price').val());
        var _t = _a * _p;
        $("#fine-total-input").val(_t);
        $('#fine-total').html($.number(_t,2));
    }

    $('#added-fine-total').on('keyup', function () {
        var fine = Number($(this).val());
        $('#added-fine-amount').attr('data-max-amount',fine);
        var sum_int = Number($('#sum-total-instalment').val());
        $('#instalment-grand-total').html($.number(sum_int+fine,2));
    });
})

function validateSubmitOverdueInvoice () {
    var r = true;
    if(validateFineForm) {
        if( Number( $('#fine-amount').val() ) <= 0 ) {
            r = false;
            $('#fine-amount').addClass('error');
        } else {
            $('#fine-amount').removeClass('error');
        }

        if( Number( $('#fine-price').val() ) <= 0 ) {
            r = false;
            $('#fine-price').addClass('error');
        } else {
            $('#fine-price').removeClass('error');
        }

        if( $('#fine-due-date').val() == "" ) {
            r = false;
            $('#fine-due-date').addClass('error');
        } else {
            $('#fine-due-date').removeClass('error');
        }
    }
    return r;
}

function updateAddedFine (fine) {
    //alert(fine);
    if($('#t_remaining').val() > 0) {
        $('#system-fine-total').html(
            $.number(fine,2)
        );

        var old_paid_balance = $('#old_fine_balance').val();
        var remaining_balance = fine - old_paid_balance;
        
        //alert(remaining_balance);
        if( remaining_balance < 0 ) {
            remaining_balance = 0;
        }
        
        $('#system-fine-amount').html(
            $.number(remaining_balance,2)
        );

        var bill_total      = Number($('#bill-grand-total').val());
        var bill_sub_total  = Number($('#bill-sub-total').val());

        bill_total -= old_paid_balance;

        bill_total += fine;

        bill_sub_total -= old_paid_balance;
        bill_sub_total  += fine;;

        $('#bill-final-total-label').html($.number(bill_total,2));
        $('#bill-sub-total-label').html($.number(bill_sub_total,2));
    }
    
}
