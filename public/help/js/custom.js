$(document).ready(function() {
    $('.navbar-sm a:not(.dropdown-toggle)').click(function(){
        $(".navbar-sm").collapse('hide');
    });
});