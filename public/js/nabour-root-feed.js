$(window).load(function () {
    var root = $('#root-url').val();
    loadFeed ();
    $('.act-as-now').on('click', function () {
        if($('.act-as-block').is(':hidden')) {
            $('.act-as-block').show();
        } else {
            $('.act-as-block').hide();
        }
    })

    $('.act-as-block li').on('click', function () {
        var as = $(this).data('act');
        $('.act-as-now').html($(this).html());
        $('#act_as').val(as);
        $('.act-as-block').hide();
        if(as == 'prop') $('.set-sticky-post').show();
        else $('.set-sticky-post').hide();
    })

    $('body').on('click', '.add-comment', function () {
        if( $(this).prev().val() != "" ) {
            var target = $(this);
            target.attr('disabled','disabled').find('.fa-comment').remove();
            target.prepend('<i class="fa-spin fa-spinner"></i>');
            var post = $(this).prev().data('post');
            var data = target.parent().serialize();
                data+= "&pid="+ post;
            var request = $.ajax({
            url:  root+"/comment/add",
                method: "POST",
                data: data,
                dataType: "json"
            });
            request.done(function( result ) {
                if(result.status == true) {
                    target.parent().prev().html(result.content);
                    $('#count-comment-'+post).html('('+result.count+')');
                    $('[data-toggle="tooltip"]').tooltip()
                }
                target.prev().val('');
                target.removeAttr('disabled').find('.fa-spin').remove();
                target.prepend('<i class="fa fa-comment"></i>');
            });
        }
    })

    $('body').on('click', '.like', function (e){
        var like_ = $(this);
        var post = $(this).data('post');
        like_.removeClass('like').children('.ltxt').html(_liked);
        var request = $.ajax({
        url:  root+"/post/like",
            method: "POST",
            data: ({pid:post}),
            dataType: "json"
        });
        request.done(function( result ) {
            if(result.status == true) {
                $('#count-like-'+post).html('('+result.count+')').parent().addClass('post-liked');
            }
        });
    })

    $('.user-timeline-stories').on('click','.post-delete', function (e){
        e.preventDefault();
        $('#modal-delete-post').modal('show');
        target_tmp      = $(this).parents('ul').data('pid');
        target_element  = $(this);
    });

    $('.user-timeline-stories').on('click','.post-edit', function (e){
        e.preventDefault();
        target_tmp      = $(this).parents('ul').data('pid');
        target_element  = $(this);
        createEditPostBlock(target_tmp);
    });

    $('.user-timeline-stories').on('click','.save-edit-post-btn',function () {
        var _this = $(this);
        _this.attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
        var text = $(this).parents('.edit-post-block').find('textarea').val();
        var parent = $(this).parents('.edit-post-block').parent();
        var id = $(this).parent().data('pid');
        if(text != "") {
            var pid = $(this).data('pid');
            $.ajax({
                url     : root+"/post/edit",
                data    : ({pid:id,text:text}),
                method  : 'post',
                dataType: 'html',
                success: function(t){
                    parent.html(t);
                }
            });
        }
    })

    $('.user-timeline-stories').on('click','.cancel-editpost', function (){
        var text = $(this).parents('.edit-post-block').find('textarea').val();
        $(this).parents('.edit-post-block').parent().html($(this).data('oldtext'));
    });

    $('.user-timeline-stories').on('click','.comment-delete', function (){
        $('#modal-delete-comment').modal('show');
        target_tmp      = $(this).data('cid');
        target_element  = $(this);
    });

    $('.user-timeline-stories').on('click','.post-report', function (){
        target_tmp      = $(this).data('id');
        target_element  = $(this);
        checkReport ();
    });

    $('.user-timeline-stories').on('click','.to-message', function (){
        $('#modal-message').modal('show');
    });


    $('#delete-post-btn').on('click',function () {
        var _this = $(this);
        _this.attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
        $.ajax({
            url     : root+"/root/admin/post/remove",
            data    : 'pid='+target_tmp,
            method  : 'post',
            dataType: 'json',
            success: function(r){
                if(r.status){
                    _this.removeAttr('disabled').find('.fa-spinner').remove();
                    $('#modal-delete-post').modal('hide');
                    target_element.parents('.timeline-story').fadeOut(300, function () { $(this).remove(); });
                }
            }
        });
    });

    $('#delete-comment-btn').on('click',function () {
        var _this = $(this);
        _this.attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
        $.ajax({
            url     : root+"/comment/remove",
            data    : 'cid='+target_tmp,
            method  : 'post',
            dataType: 'json',
            success: function(r){
                if(r.status){
                    $('#modal-delete-comment').modal('hide');
                    target_element.parents('li').fadeOut(300, function () {
                        $(this).remove();
                    });
                    $('#count-comment-'+r.pid).html("("+r.count+")")
                }
                _this.removeAttr('disabled').find('.fa-spinner').remove();
            }
        });
    })

    $('#report-post-btn').on('click',function () {
        if($("#post-report-form").valid()) {
            $(this).attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
            $.ajax({
                url     : root+"/report",
                data    : 'id='+target_tmp+"&reason="+$('#input-report').val()+'&type=1',
                method  : 'post',
                dataType: 'json',
                success: function(r){
                    $('#modal-report-post').modal('hide');
                    $('#modal-report-post-result .modal-body').html(r.msg);
                    $('#modal-report-post-result').modal('show');
                    $('#input-report').val('');
                    $('#report-post-btn').removeAttr('disabled').children('.fa-spinner').remove();
                }
            });
        }
    })

function checkReport () {
        var loader = $('<i><img class="post-action-loader" src="'+root+'/images/ajax-loader.gif"/></i>');
        target_element.after(loader);
        target_element.hide();
        $.ajax({
                url     : root+"/report-check",
                data    : 'id='+target_tmp+'&type=1',
                method  : 'post',
                dataType: 'json',
                success: function(r){
                    if(r.status) {
                        validator.resetForm();
                        $("label.error").hide();
                        $(".error").removeClass("error");
                        $('#modal-report-post').modal('show');
                    } else {
                        $('#modal-report-post-result .modal-body').html(r.msg);
                        $('#modal-report-post-result').modal('show');
                    }
                    loader.remove();
                    target_element.show();
                }
            });
    }
})

function loadFeed () {
    $(".fancybox").fancybox({
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

    $('.story-album').collageCaption();
    setCollage ();
}

function setCollage () {
    $('.steam-post').imagesLoaded ( function () {
        $('.story-album').removeWhitespace().collagePlus({
                'fadeSpeed'     : 5000,
                'targetHeight'  : 250/*,
                'effect' : "effect-3"*/
            }
        );
    })

}

function createEditPostBlock (target_tmp) {
    //var post_block = target_element.parents('.timeline-story').find('.story-content .post-detail p');
    //var temp = post_block.html();
    var root = $('#root-url').val();
    var post_id = target_tmp;
    $.ajax({
        /*url     : $('#root-url').val()+"/post/gettext",
        data    : ({pid:target_tmp}),
        method  : 'post',
        dataType: 'json',
        success: function(t){
            post_block.html('<div class="edit-post-block"><textarea class="form-control input-unstyled input-lg edit-post-input"></textarea><div class="edit-post-action-block" data-pid="'+target_tmp+'"><button class="btn btn-white cancel-editpost">'+_cancel+'</button><button class="btn btn-primary save-edit-post-btn">'+_edit+'</button></div></div>');
            post_block.find('textarea').focus().val(t.text);
            post_block.find('.cancel-editpost').data('oldtext',temp);
        }*/
        url     : root+"/root/admin/post/form/get",
        data    : 'id='+post_id,
        method  : 'post',
        dataType: 'html',
        success: function(r){
            $('#modal-post-edit .landing-edit-form').html(r);
            $('#modal-post-edit').modal('show');
            $(window).resize();
        }
    });
}

$('#send-message').on('click',function () {
    var btn = $(this);
    if($("#input-message").val() !== "" ) {
        btn.attr('disabled','disabled').prepend('<i class="fa-spin fa-spinner"></i> ');
        $.ajax({
            url     : $('#root-url').val()+"/message/send",
            data    : ({ 'text':$("#input-message").val() }),
            method  : 'post',
            dataType: 'json',
            success: function(r){
                btn.removeAttr('disabled').find('i').remove();
                $('#modal-message').modal('hide');
                $("#input-message").val('');
            }
        });
    }
})
