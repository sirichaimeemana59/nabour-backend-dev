$(function () {

    rewokeMask ();
    $("#for-unit,#unit-select,#income-cate").selectBoxIt().on('open', function(){
        $(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
    });
    $("#unit-list").select2({
        allowClear: true
    }).on('select2-open', function()
    {
        $(this).data('select2').results.addClass('overflow-hidden').perfectScrollbar();
    });
    //
    $('#for-unit').on('change',function () {
        $('#external-payee,#multiple-unit-select').hide();
        if($(this).val() == 0) {
            $('#multiple-unit-select').show();
            if($('#unit-balance-input').val() > 0 ) $('.property-balance').show();
        } else if($(this).val() == 2) {
            $('#external-payee').show();
            $('.property-balance').hide();
        }
    });

    $('#create-invoice-form').validate({
        rules: {
            name        : "required",
            due_date    : "required",
            payer_name      : { required: function () {
                    if($('#for-unit').val() == 2) {
                        return true;
                    } else {
                        return false;
                    }
                }
            }
        },
        errorPlacement: function(error, element) {}
    })

    $('#addRowBtn').on('click', function (e){
        e.preventDefault();
        var time = $.now();
        var bath = $('#baht-label').val();
        var category = '<select name="transaction['+time+'][service]" class="price_service" OnChange="result_Price(this);">'+ $('#invoice-category-template select').html() + '</select>';
        var tRowTmp = [
            '<tr class="item-row">',
            '<td><i class="deleteRow fa-trash"></i></td>',
            '<td>'+category+'</td>',
            '<td><input class="toValidate tQty form-control input-sm" name="transaction['+time+'][project]" type="text"  maxlength="15"/></td>',
            '<td></td>',//.join('');
            '<td><div class="input-group"><span class="input-group-addon">฿</span>'+'<input   class="toValidate tPrice form-control input-sm" style="text-align: right;" name="transaction['+time+'][unit_price]"  type="text"  maxlength="15"  readonly/></td>'];
        if($(this).data('vat')) {
            tRowTmp.push('<td><input id="vat-'+time+'"  name="transaction['+time+'][vat]" value="1" class="cbr cbr-replaced cbr-turquoise vat-check" type="checkbox"></td>');
        }
        tRowTmp.push(
            '<td><div class="text-right">' +
            '<span class="colTotal">0</span> '+bath+'</div><input class="tLineTotal" name="transaction['+time+'][total]" type="hidden"></td>','</tr>');
        tRowTmp = tRowTmp.join('');

        $('#itemsTable').append(tRowTmp);
        $('#itemsTable').find('tr:last select').selectBoxIt().on('open', function(){
            $(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
        });
        if($(this).data('vat')) {
            cbr_replace();
        }
        rewokeMask ();
    });


    $('#itemsTable').on('click','.deleteRow', function () {
        if($(this).data('tid')) {
            $('#delete-temp').append(
                $('<input/>').attr({
                    type:'hidden',
                    name: 'removedTransaction[]',
                    value: $(this).data('tid')
                }))
        }
        $(this).parents('.item-row').remove();
        calTotal();
    })

    $('#previews-edit-form').on('click','.remove-file', function (e) {
        e.preventDefault();
        if($(this).data('fid')) {
            $('#delete-temp').append(
                $('<input/>').attr({
                    type:'hidden',
                    name: 'removedFile[]',
                    value: $(this).data('fid')
                }));
            $(this).parent().remove();
        }
    })

    $('#itemsTable').on('keyup','.tQty,.tPrice', function () {
        calRowTotal ($(this));
    });

    $('#tax,#withholding_tax,#discount').on('keyup',function() {
        calTotal();
    })

    $("#tax,#withholding_tax,#discount").number( true , 0);

    $('#itemsTable').on('change', '.vat-check', function (){
        calTotal();
    });
});

function calRowTotal ($obj) {
    var pt = $obj.parents('.item-row');
    var amnt = pt.find('.tQty').val();
    var prc = pt.find('.tPrice').val();
    var rTotal = pt.find('.tLineTotal');
    var cTotal = pt.find('.colTotal');
    if (!isNaN(amnt) && !isNaN(prc) ) {
        var total = Number(prc)*Number(amnt);
        var total_ = $.number(total,2);
        rTotal.val(total);
        cTotal.html(total_);
        calTotal();
    }
}

function calTotal () {
    var Total = TotalTax = 0;

    $('.tLineTotal').each(function () {
        if ( $(this).val() !== "" ) {
            t = Number($(this).val());
            Total += t;
            // chk = $(this).parents('td').prev().find('.vat-check');
            // if(chk.length) {
            //     if(chk.prop('checked')) {
            //         TotalTax += t;
            //     }
            // }
        }
    })

    //console.log(Total);
    var tax;
    var _total_grand = $('#h_total').text();
    var tax1 = $('#tax').val();
    tax = (Total*tax1)/100;
    var _tax = $.number(tax,2);
    $('.salesTax').val(_tax);
    // if($('#tax').val() === "" || !$('#tax').length) {
    //     tax = 0;
    // } else {
    //     tax = tax1;
    // }

    //alert(tax);
    //if(tax < 0 ) tax = 0;
    //$('#tax_total').val(tax.toFixed(2));
    //var tax_ = $.number(tax,2);

    //console.log(tax);
    var h_tax;
    if($('#withholding_tax').val() === "" || !$('#withholding_tax').length) {
        h_tax = 0;
    } else {
        h_tax = Number($('#withholding_tax').val());
    }
    h_tax = TotalTax*h_tax/100;
    if(h_tax < 0 ) h_tax = 0;
    $('#withholding_total').val(h_tax.toFixed(2));
    var h_tax_ = $.number(h_tax,2);
    $('#withholdingTax').html(h_tax_);

    // Total
    Total_ = $.number(Total,2);
    $('#subTotal').html(Total_);
    $('#form-total').val(Total.toFixed(2));
    // Grand Total
    var grandTotal = Total+tax-h_tax;

    //Discount
    if($('#discount').length) {
        var discount = Number($('#discount').val());
        grandTotal = grandTotal-discount;
    }

    var grandTotal_ = $.number(grandTotal,2);
    $('#grandTotal').html(grandTotal_);
    $('#h_total').val(grandTotal_);
    $('#form-grand-total').val(grandTotal_);

    if($('#unit-balance-input').length && Number($('#unit-balance-input').val()) > 0 ) {
        calFinalGrandTotal();
    }
}

function validateInputCreateForm () {
    var valid = validateTransaction();

    if($('#for-unit').val() == 1 && !$('#unit-list').val()) {
        valid = false;
        $('.select2-container').addClass('error');
    } else {
        $('.select2-container').removeClass('error');
    }
    return valid;
}

function validateInputCreateCfRetroForm () {
    var valid = validateTransaction();

    if($('#for-unit').val() == 0 && !$('#unit-list').val()) {
        valid = false;
        $('.select2-container').addClass('error');
    } else {
        $('.select2-container').removeClass('error');
    }
    return valid;
}

function validateInputCreateReceiptForm () {
    var valid = validateTransaction();
    if($('#for-unit').val() == 0 && !$('#unit-select').val()) {
        valid = false;
        $('.select2-container').addClass('error');
    } else {
        $('.select2-container').removeClass('error');
    }

    return valid;
}

function validateTransaction () {
    var valid = true;
    $('#itemsTable tbody tr').each(function (){
        if(!$(this).hasClass('hidden')) {
            $(this).find('input.toValidate').each(function (){
                if($(this).val() === "") {
                    $(this).addClass('error__');
                    valid = false;
                } else {
                    $(this).removeClass('error__');
                }
            })
        }
    })
    return valid;
}

function rewokeMask () {
    $(".tQty").number( true, 0 );
    $(".tPrice").number( true, 2 );
    $("#unitprice").number(true,2);
    // $(".colTotal").number( true, 2 );
}

function validatePayment () {
    var payValid = false;
    if($('#payment_method').val() === "" ) {
        $('#payment_methodSelectBoxIt').css('border','1px solid red');
    } else {
        $('#payment_methodSelectBoxIt').removeAttr('style');
        payValid = true;
    }

    return payValid;
}

function checkAttachment () {
    if($('.preview-img-item').length) {
        $('.attachment-error').hide();
        return true;
    }
    else {
        $('.attachment-error').show();
        return false;
    }
}

function calFinalGrandTotal () {
    final = Number($('#unit-balance-input').val()) - Number($('#form-grand-total').val());
    if(final > 0) final = 0;
    var f = $.number(Math.abs(final),2);
    $('#final-balance,.remaining-grand-total').html(f);
}



