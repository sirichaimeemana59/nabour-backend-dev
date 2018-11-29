$(function () {
    var root = $('#root-url').val();
    $('#mg-id').on('change', function () {
        $.ajax({
            url: root+'/management/property/list',
            data: $('#search-form').serialize(),
            method: 'POST',
            dataType: "json",
            success: function (r) {
                var $select = $('#p-list');
                $('#p-list option:not(:first)').remove();
                $.each(r, function(i, v){
                    $select.append($('<option />', { value: i, text: v }));
                });
            }
        });
    })
})