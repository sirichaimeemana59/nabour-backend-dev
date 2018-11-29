$(function () {
    $('#submit-m-report').on('click', function () {
        if(!$(this).is(':disabled')) {
            var _this = $(this);
            _this.prepend('<i class="fa-spin fa-spinner"></i> ');
            _this.attr('disabled','disabled');
            $('#chart-month').css('opacity','0.6');
            var parent_ = $(this).parents('form');
            var data = parent_.serialize();
            $.ajax({
                url     : $('#root-url').val()+"/fees-bills/report/month",
                data    : data,
                dataType: "json",
                method: 'post',
                success: function (h) {
                    firstVisitMonthTab = false;
                    if(h.status) {
                        renderGraph('m',h);
                    } else {
                        firstVisitMonthTab = true;
                        $('#chart-month').hide();
                        $('#chart-none').show();
                    }
                    _this.removeAttr('disabled').find('i').remove();
                }
            })
        }
    })

    $('#submit-y-report').on('click', function () {
        if(!$(this).is(':disabled')) {
            var _this = $(this);
            _this.prepend('<i class="fa-spin fa-spinner"></i> ');
            _this.attr('disabled','disabled');
            $('#chart-year').css('opacity','0.6');
            var parent_ = $(this).parents('form');
            var data = parent_.serialize();
            $.ajax({
                url     : $('#root-url').val()+"/fees-bills/report/year",
                data    : data,
                dataType: "json",
                method: 'post',
                success: function (h) {
                    firstVisitYearTab = false;
                    if(h.status) {
                        renderGraph('y',h);
                    } else {
                        firstVisitYearTab = true;
                        $('#chart-year').hide();
                        $('#chart-none').show();
                    }
                    _this.removeAttr('disabled').find('i').remove();
                }
            })
        }
    })
})
