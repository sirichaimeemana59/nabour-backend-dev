$(function () {
    $.validator.addMethod("notEqual", function(value, element, param) {
      return this.optional(element) || value != param;
    });
    var $table = $('#unit-table');
    $table.floatThead({ scrollContainer : true});
    $('.unit-area').number(true,2);
    $(".price").number(true);
    $('#search-geo-btn').on('click',function () {
        codeAddress();
    });

    $('#add-unit-row').on('click', function () {
        addRow();
    })

    $('#unit-table').on('click','.remove-row', function () {
        $(this).parents('tr').remove();
        ordering ();
    })
})

function validateForm () {
    $("#p_form").validate({
        rules: {
            property_name_th    : 'required',
            property_name_en    : 'required',
            juristic_person_name_th    : 'required',
            juristic_person_name_en    : 'required',
            min_price           : {required:true,number:true},
            max_price           : {required:true,number:true},
            unit_size           : 'required',
            address_th          : 'required',
            address_en          : 'required',
            street_th           : 'required',
            street_en           : 'required',
            province            : 'required',
            postcode            : 'required',
            property_type       : {required:true,notEqual:0},
        },
        errorPlacement: function(error, element) { element.addClass('error'); }
    });
}
function addRow () {
    loop = $('#loop-add-row').val();
    time = $.now();
    for (var i = 0; i < loop; i++) {
        var $append = $('<tr/>').append(
            $('<td/>').attr('class','count-row')
        ).append(
            $('<td/>').append( $('<input/>').attr({'name':'unit['+(time+i)+'][no]','class':'form-control input-unit-no'}) )
        ).append(
            $('<td/>').append(
                $('<select/>').attr({'name':'unit['+(time+i)+'][is_land]','class':'form-control'}).append(
                    $('<option>').attr('value',0).html($('#property-label').val())
                ).append(
                    $('<option>').attr('value',1).html($('#land-label').val())
                )
            )
        ).append(
            $('<td/>').append( $('<input/>').attr({'name':'unit['+(time+i)+'][area]','class':'form-control '}).number(true,2) )
        ).append(
            $('<td/>').append( $('<input/>').attr({'name':'unit['+(time+i)+'][owner_name_th]','class':'form-control','maxlength':100}) )
        ).append(
            $('<td/>').append( $('<input/>').attr({'name':'unit['+(time+i)+'][owner_name_en]','class':'form-control','maxlength':100}) )
        ).append(
            $('<td/>').append( $('<button/>').attr({'class':'remove-row'}).html('<i class="fa fa-trash"></i>') )
        );
        $('#unit-table').append($append);
    }
    ordering ();
    $(window).resize();
}

function ordering () {
    loop = $('#unit-table tr').length;
    for (var i = 1; i < loop; i++) {
        $('#unit-table tr').eq(i).children('.count-row').html(i+'.');
    }
}

function checkField () {
    var check = true;
    $('#unit-table input.input-unit-no').each(function (){
        if($(this).val() == "") {
            $(this).addClass('error__');
            check = false;
        } else {
            $(this).removeClass('error__');
        }
    })
    return check;
}
