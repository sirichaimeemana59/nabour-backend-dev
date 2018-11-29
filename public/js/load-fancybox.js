loadFancy();
function loadFancy () {
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
}
