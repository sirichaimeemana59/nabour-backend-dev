/**
 * Created by ManSuttipong on 7/12/17.
 */
$(window).load(function () {
    $(".gallery").fancybox({
        helpers: {
            overlay: {
                locked: false
            }
        },
        beforeLoad: function(){
            $('html').css('overflow','hidden');
        },
        afterClose: function(){
            $('html').css('overflow','auto');
        },
        'padding'           : 0,
        'transitionIn'      : 'elastic',
        'transitionOut'     : 'elastic',
        'changeFade'        : 0
    });

    /*$('.print-invoice').on('click',function () {
        if($("#original-print-flag").is(':checked')) {
            $('#original-print').val('true');
            $('#print-origin-element').removeClass('hidden-print');
        }
        else {
            $('#original-print').val('false');
            $('#print-origin-element').addClass('hidden-print');
        }

        if($("#copy-print-flag").is(':checked')) {
            $('#copy-print').val('true');
            $('#print-copy-element').removeClass('hidden-print');
        }
        else {
            $('#copy-print').val('false');
            $('#print-copy-element').addClass('hidden-print');
        }

        //print-invoice
        $('#list-bill').val();
        $('#confirm-copy-invoice-print-modal').modal('hide');
        javascript:window.print();
    });*/
})