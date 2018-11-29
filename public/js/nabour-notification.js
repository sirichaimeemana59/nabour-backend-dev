var root;
    $(function (){
        root = $('#root-url').val();
        $('#notification-type-list a').on('click',function (e) {
            e.preventDefault();
            $('.mail-env').css('opacity','0.6');
            $('#notification-type-list li').removeClass('active');
            $(this).parent().addClass('active');
            var type = $(this).data('type');
            var r = $.ajax({
                url:  root+"/notification",
                data:({'type':type}),
                dataType: "html"
            });
            r.done(function( result ) {
                $('.mail-env').html( result );
                $('.mail-env').css('opacity','1');
            });
        })

        $('.mail-env').on('click','.next-page,.prev-page', function (e){
            e.stopImmediatePropagation();
            e.preventDefault();
            $('.mail-env').css('opacity','0.6');
            if(!$(this).hasClass('disabled')) {
                var page = $(this).data('page');
                var type = $('#notification-type-list li.active a').data('type');
                var r = $.ajax({
                    url:  root+"/notification",
                    data:({'type':type,'page':page}),
                    dataType: "html"
                });
                r.done(function( result ) {
                    $('.mail-env').html( result );
                    $('.mail-env').css('opacity','1');
                });
            }
        });

        $('#noti-list-content').on('click','a',function (e) {
            e.preventDefault();
            var _this = $(this);
            getNotificationContent(_this);
        })
    })
    function getNotificationContent(obj) {
        var btn = obj;
            btn.prepend('<i class="fa-spinner"></i> ');
        if(obj.data('type') == 'popup') {
             var r = $.ajax({
                url:  root+"/notification/get",
                data:({'nid':btn.data('noti-id')}),
                dataType: "html",
                method: 'post'
            });
            r.done(function( result ) {
                $('#notification-content').html( result );
                $('#modal-notification-detail').modal('show', {backdrop: 'static'});
                if(btn.hasClass('mark-as-read')) {
                    markAsRead (btn.data('noti-id'),btn);
                    btn.removeClass('mark-as-read');
                }
                if(obj.data('type') == 'popup') {
                    btn.children('i').remove();
                }
            });
        } else {
            if(btn.hasClass('mark-as-read')) {
                markAsRead (btn.data('noti-id'),btn);
                btn.removeClass('mark-as-read');
            } else window.location.href = btn.attr('href');
        }


    }

    function markAsRead (noti_id,obj) {
        var _this = obj;
        var r = $.ajax({
                url:  root+"/notification/markasread",
                data:({'nid':noti_id}),
                dataType: "json",
                method: 'post'
            });
            r.done(function( result ) {
                if(result.status == true) {
                    _this.children('span').remove();
                    var count   = $('#notification-type-list li.active a span').html();
                    count       = parseInt(count)-1;
                    if(count == 0) $('#notification-type-list li.active a span').remove();
                    else $('#notification-type-list li.active a span').html(count);
                    _this.removeClass('make-read');
                    if(obj.data('type') != 'popup') {
                        window.location.href = obj.attr('href');
                    }
                }
            });
    }
