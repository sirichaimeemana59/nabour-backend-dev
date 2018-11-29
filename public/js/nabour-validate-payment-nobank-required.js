$(function () {
    $("#payment_method,#payment_bank").selectBoxIt().on('open', function(){
            $(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
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
function validateWithdrawDate () {
        var payValid = false;
        if($('#payment_bank').val() != "" && $('#withdraw_date').val() == "") {
            $('#withdraw_date').addClass('error');
        } else {
            $('#withdraw_date').removeClass('error');
            payValid = true;
        }
        return payValid;
    }