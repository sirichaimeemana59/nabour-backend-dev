$(function () {
    $("#order-status").selectBoxIt().on('open', function(){
        $(this).data('selectBoxSelectBoxIt').list.perfectScrollbar();
    });

    $("#unit-id").select2({
        placeholder: "{{ trans('messages.unit_number') }}",
        allowClear: true,
        dropdownAutoWidth: true
    });

    $('.reset-s-btn').on('click',function () {
        $(this).closest('form').find("input").val("");
        $(this).closest('form').find("select option:selected").removeAttr('selected');
        $('#unit-id').val('-').trigger('change');
        searchOrder ();
    });


    $('#body-item').on('click','.paginate-link', function (e){
        e.preventDefault();
        page($(this).attr('data-page'));
    });

    $('#body-item').on('change','.paginate-select', function (e){
        e.preventDefault();
        page($(this).val());
    });

    $('#submit-search').on('click', function () {
        searchOrder();
    })

    $('body').on('change', '#check-all', function () {
        //var allPages = $('.bills-id')//table.fnGetNodes();
        if (!$(this).prop('checked')) {
            $('.check-order').not(':disabled').prop('checked', false).parents('.cbr-replaced').removeClass('cbr-checked');
            $('.order-table tbody').removeClass('selected');
        } else {
            $('.check-order').not(':disabled').prop('checked', true).parents('.cbr-replaced').addClass('cbr-checked');
            $('.order-table tbody').addClass('selected');
        }
        var checked = $('.check-order:checked').length;
        $('.selected-counter').html(checked);
        allowReminder (checked);
    });

    $('body').on('change', '.check-order', function () {
        if( $(this).prop('checked') ) {
            $(this).parents('tbody').addClass('selected');
        } else {
            $(this).parents('tbody').removeClass('selected');
        }
        var checked = $('.check-order:checked').length;
        $('.selected-counter').html(checked);
        allowReminder (checked);
    });

    $('body').on('click', '#send-reminder', function () {
        $('#confirm-send-reminder-modal').modal('show');
    });

    $('#confirm-send-reminder').on('click', function () {
        sendReminder ();
    });
});

function allowReminder (checked) {
    if( checked > 0 ) {
        $('#send-reminder').show();
    } else
        $('#send-reminder').hide();
}