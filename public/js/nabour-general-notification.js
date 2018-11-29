$(function () {
	$('ul.notifications').on('click','a.make-read',function (e) {
		e.preventDefault();
		var target_url = $(this).attr('href');
		getMarkReadAdRedirect($(this),target_url);
	})

	function getMarkReadAdRedirect(obj,url) {
		obj.find('i').removeAttr('class').addClass('fa-spin fa-spinner');
        var noti_id = obj.data('noti-id');
        var r = $.ajax({
                url:  $('#root-url').val()+"/notification/markasread",
                data:({'nid':noti_id}),
                dataType: "json",
                method: 'post'
            });
            r.done(function( result ) {
                window.location.href = url;
            });
    }

	$('.noti-list').scroll(function () {
		if($('#noti-page').length) {
			var bar_top = $(this).find('.ps-scrollbar-y').offset().top;
			var bar_height = $(this).find('.ps-scrollbar-y').height();
			var scroll_top = $(this).find('.ps-scrollbar-y-rail').offset().top;
			var scroll_height = $(this).find('.ps-scrollbar-y-rail').height();
			var real_top = bar_top-scroll_top;
			var top_percentage = ((real_top+bar_height)/scroll_height)*100;
			if(top_percentage == 100) {
				getNotificationPage($('#noti-page').data('page'));
			}
		}
		//console.log('top-percentage:'+top_percentage+'%');
	})

	function getNotificationPage(page) {
        var r = $.ajax({
                url:  $('#root-url').val()+"/notification/page",
                data:({'page':page}),
                dataType: "html",
                method: 'post'
            });
        r.done(function( result ) {
			$('#noti-page').remove();
			$('.noti-list').append( result );
			$('.ps-scrollbar').perfectScrollbar('update');
        });
    }
})
