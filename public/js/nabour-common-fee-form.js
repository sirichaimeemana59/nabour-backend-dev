$(function () {
    calToDate();
    $('#select-range').on('change',function () {
        if($(this).val() != 1) {
            $('#select-month-range').show();
            
        } else { $('#select-month-range').hide(); }

        calToDate ();
        $(window).resize();
    });
    $('#select-month,#select-year').on('change',function () {
        calToDate();
    });

    $('.cal-cf-method').on('change', function () {
        //alert($(this).val());
        m = $(this).val();
        if( m == 'manual') {
            $('.auto-cf').addClass('hidden').hide();
            $('.manual-cf').removeClass('hidden').show();
            $('.label-auto').hide();
        } else {
            $('.manual-cf').addClass('hidden').hide();
            $('.auto-cf').removeClass('hidden').show();
            $('.label-auto').show();
        }
        calTotal();
    })

});

function calToDate () {
    var month =[];
    $("#select-month option").each ( function() { month.push ( $(this).html() ); });
    var r = $('#select-range').val();
    var d = new Date($('#select-year').val()+"/"+$('#select-month').val()+"/"+"01");
    d = d.setMonth( d.getMonth( ) + (parseInt(r) - 1) );
    var nd = new Date(d);
    var year = nd.getFullYear( );
    if($('#lang_session').val() == 'th') { year+=543; }
    $('#to-date').html(
        month[nd.getMonth( )]+' '+year
    );
    $('#hidden-to-date').val( nd.getFullYear( ) + '-' + ('0'+(nd.getMonth( ) + 1)).slice(-2) + '-' +   ('0'+nd.getDate( )).slice(-2));
}
