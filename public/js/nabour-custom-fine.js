$(function () {
	$('#input-fine-amount').number( true ,0 );
        $('#input-fine-price,#added-fine-total').number( true ,2 );

        $('.cancel-fine').on('click',function (){
            cancelFine ();
        });

        $('#input-fine-amount').on('keyup',function () {
            calFine();
        });

        $('#input-fine-price').on('keyup',function () {
            calFine();
        });

        $('#input-fine-text').on('keyup',function () {
            var _t = $(this).val();
            $('#added-fine-detail').val(_t);
        });
})

function cancelFine() {
    $('.fine-row').hide();
    $('.fine-input-hidden').val(0);
    $('#cal_fine_flag,#added-fine-amount').val(0);
    $('#bill-sub-total-label').html($.number($('#bill-sub-total').val(),2));
    $('#bill-final-total-label').html($.number($('#bill-grand-total').val(),2));
    var bill_total = Number($('#bill-grand-total').val());
    $('#remaining-total,#pay_amount').val(bill_total);
    
    $('#pay_amount-label,#remain_amount-label').html($.number(bill_total,2));

    var sum_int = Number($('#sum-total-instalment-hidden').val());
    $('#instalment-grand-total').html($.number(sum_int,2));
    CalInstalmentTotal ();
    getTatalText (bill_total);
}

function calFine() {
    var amount       = $('#input-fine-amount').val();
    var price        = $('#input-fine-price').val();
    var fine_total = Number(amount) * Number(price);
    var bill_total      = Number($('#bill-grand-total').val());
    var bill_sub_total  = Number($('#bill-sub-total').val());

    bill_total += fine_total;
    bill_sub_total += fine_total;

    bill_total = bill_total.toFixed(2);
    bill_sub_total = bill_sub_total.toFixed(2);

    $('#fine-total').html($.number(fine_total,2));
    $('#bill-final-total-label').html($.number(bill_total,2));
    $('#bill-sub-total-label').html($.number(bill_sub_total,2));

    $('#fine-total-hidden').val(fine_total);
    $('#fine-price').val(Number(price));
    $('#fine-amount').val(Number(amount));
    // set min payment amount
    $('#remaining-total,#pay_amount').val(bill_total);
    $('#pay_amount-label,#remain_amount-label').html($.number(bill_total,2));
    
    setInstalment(fine_total);
    getTatalText (bill_total);
}

function getTatalText (bill_total) {
    //
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