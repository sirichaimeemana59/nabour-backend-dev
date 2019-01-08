<!doctype html>
<html lang="en" class="no-js">
<head>
    <title>Nabour</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @if(Request::route()->parameter('subdomain') == 'dev')
        <!-- disable robot -->
        <meta name="robots" content="noindex, nofollow,noarchive,nosnippet">
        <meta name="googlebot" content="noindex, nofollow,noarchive,nosnippet">
    @endif
    {{--{!!--<meta name="robots" content="noindex, nofollow,noarchive,nosnippet">--}}
    {{--<meta name="googlebot" content="noindex, nofollow,noarchive,nosnippet">--!!}--}}

    <meta property="og:description" content="Nabour แอปพลิเคชันที่ทำให้การสื่อสารและการบริหารจัดการภายในโครงการที่อยู่อาศัยเป็นเรื่องง่ายขึ้น">
    <meta property="og:image" content="https://nabour.me/home-theme/img/facebook_website_ads.png">
    <meta property="og:url" content="https://nabour.me/">
    <meta property="og:title" content="Nabour">
{{--{!!--<link href='//fonts.googleapis.com/css?family=Raleway:400,300' rel='stylesheet' type='text/css'>--}}
{{--<link href='//fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>--!!}--}}

    <!-- Resource style -->
    <link rel="stylesheet" type="text/css" href="{!! url('/') !!}/home-theme/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{!! url('/') !!}/home-theme/css/swipebox.css">
    <link rel="stylesheet" type="text/css" href="{!! url('/') !!}/home-theme/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="{!! url('/') !!}/home-theme/css/theme.css?<?php echo time(); ?>">

    <!-- Color style -->
    <link rel="stylesheet" href="{!! url('/') !!}/home-theme/css/colors/turquoise.css" class="colors">
    <link rel="stylesheet" href="{!! url('/') !!}/font/thaisans/font.css">

    <!-- Important Owl stylesheet -->
    <link rel="stylesheet" href="{!! url('/') !!}/owl-carousel/assets/owl.carousel.css">
    <link rel="stylesheet" href="{!! url('/') !!}/owl-carousel/assets/owl.theme.default.min.css">

    <!-- SweetAlert Library -->
    <script src="{!! url('/') !!}/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{!! url('/') !!}/sweetalert/dist/sweetalert.css">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{!! url('/') !!}/home-theme/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{!! url('/') !!}/home-theme/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{!! url('/') !!}/home-theme/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{!! url('/') !!}/home-theme/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{!! url('/') !!}/home-theme/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{!! url('/') !!}/home-theme/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{!! url('/') !!}/home-theme/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{!! url('/') !!}/home-theme/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{!! url('/') !!}/home-theme/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" href="{!! url('/') !!}/home-theme/img/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="{!! url('/') !!}/home-theme/img/favicon/android-icon-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="{!! url('/') !!}/home-theme/img/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="{!! url('/') !!}/home-theme/img/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="{!! url('/') !!}/home-theme/img/favicon/manifest.json">
    <meta name="msapplication-TileImage" content="{!! url('/') !!}/home-theme/img/favicon/mstile-144x144.png">

    <!-- Modernizr -->
    <script src="{!! url('/') !!}/home-theme/js/modernizr.js"></script>


</head>
<body class="index-agency">
    <input type="hidden" id="root-url" value="{!! url('/') !!}">
<div id="preloader">
    <div class="spinner">
    </div>
    <div class="logo-spinner"></div>
</div>
<header class="cd-header-fixed">
    <div class="cd-logo"><a href="{!!url('/')!!}"><img src="{!! url('/') !!}/home-theme/img/nb-logo-green.png" alt="Logo"></a></div>
    <nav>
        <ul class="cd-secondary-nav">
            @if(!Auth::user())
            <li><a href="#" data-toggle="modal" data-target="#loginModal" id="login-link">{!! trans('messages.Landing.login_menu') !!}</a></li>
            @endif
            <li><a href="https://blog.nabour.me">{!! trans('messages.Landing.blog_menu') !!}</a></li>
            <li><a href="{!!url('about')!!}">{!! trans('messages.Landing.about_us') !!}</a></li>
        </ul>
    </nav>
    <!-- cd-nav -->
    <div class="language">
        <span class="current-language">
            @if(Lang::getLocale() == 'th')
                <li><a href="?lang=en">EN</a></li>
            @else
                <li><a href="?lang=th">TH</a></li>
            @endif
        </span>
        {{--{!!-- <span class="current-language">{!! Lang::getLocale() !!}</span>
        <ul class="language-list">
            <li><a href="?lang=en">EN</a></li>
            <li><a href="?lang=th">TH</a></li>
        </ul> --!!}--}}
    </div>
    <a class="cd-primary-nav-trigger" href="javascript:void(0);">
        <span class="cd-menu-icon"></span>
    </a><!-- cd-primary-nav-trigger -->
</header>
<!-- /Header -->
<!-- cd-primary-nav -->
<nav>
    <ul class="cd-primary-nav">
        <li><a href="#" data-toggle="modal" data-target="#loginModal" id="login-link">{!! trans('messages.Landing.login_menu') !!}</a></li>
        <li><a href="https://blog.nabour.me">{!! trans('messages.Landing.blog_menu') !!}</a></li>
        <li><a href="{!!url('about')!!}">{!! trans('messages.Landing.about_us') !!}</a></li>
        {{--{!!--<li class="cd-label">Follow us</li>--}}

        {{--<li class="cd-social cd-facebook"><a href="https://www.facebook.com/nabour/">Facebook</a></li>--!!}--}}
        <!--<li class="cd-social cd-instagram"><a href="#">Instagram</a></li>
        <li class="cd-social cd-dribbble"><a href="#">Dribbble</a></li>
        <li class="cd-social cd-twitter"><a href="#">Twitter</a></li>-->
    </ul>
</nav>
<!-- cd-primary-nav -->
@yield('content')
<!-- Modal -->
<section id="modals">
    <!-- Login Modal -->
    <div class="modal login fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="form-signin-heading modal-title" id="myModalLabel">{!! trans('messages.Landing.login_menu') !!}</h2>
                </div>
                {!! Form::open(array('url' => '','id'=>'ajaxform','class'=>'login-form fade-in-effect',"autocomplete"=>"off")) !!}
                    <input type="text" style="display:none">
                    <input type="password" style="display:none">
                    <div class="modal-body">
                        <fieldset>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span class="input">
                                        <p id="login-error" style="display:none;padding:0.4em 1em;" class="bg-warning">{!! trans('messages.Landing.login_fail') !!}</p>
                                    </span>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span class="input input--chisato">
                                        <input autocomplete="off" class="input__field input__field--chisato" type="email" name="email"
                                               id="email"/>
                                        <label class="input__label input__label--chisato" for="email">
                                            <span class="input__label-content input__label-content--chisato"
                                                  data-content="{!! trans('messages.email') !!}">{!! trans('messages.email') !!}</span>
                                        </label>
                                    </span>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <span class="input input--chisato">
                                        <input autocomplete="off" class="input__field input__field--chisato" type="password"
                                               name="password" id="password"/>
                                        <label class="input__label input__label--chisato" for="password">
                                            <span class="input__label-content input__label-content--chisato"
                                                  data-content="{!! trans('messages.Verify.password') !!}">{!! trans('messages.Verify.password') !!} </span>
                                        </label>
                                    </span>
                                </div>
                            </div>

                             <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="checkbox text-right">
                                        <input type="checkbox" name="remember" id="remember"/> <label for="remember">{!! trans('messages.Landing.remember_me') !!}</label>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="modal-footer">
                        <a href="{!! url('password/forgot') !!}" class="pull-left lost-pwd">({!! trans('messages.Landing.forgot_pass') !!})</a>
                        <button type="button" class="btn btn-default btn-border" data-dismiss="modal">{!! trans('messages.close') !!}</button>
                        <button type="button" id="login-btn" class="btn btn-color">{!! trans('messages.Landing.login_menu') !!}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Login Modal -->
</section>
<!-- Footer area -->
<footer class="footer-area">
    <div class="container">
        {{--{!!--<div class="row text-center">--}}
            {{--<div class="col-md-8 col-md-offset-2">--}}
                {{--<div class="share">--}}
                    {{--<a href="#" target="_blank" class="twitter"><img src="{!! url('/') !!}/home-theme/img/icon_tw.png" alt="twitter">--}}

                        {{--<p class="txt">Twitter</p>--}}

                        {{--<p id="tweetNum" class="num"></p>--}}
                    {{--</a>--}}
                    {{--<a href="https://www.facebook.com/nabour" target="_blank" class="facebook"><img src="{!! url('/') !!}/home-theme/img/icon_fb.png" alt="facebook">--}}

                        {{--<p class="txt">Facebook</p>--}}

                        {{--<p id="fbNum" class="num"></p>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="row">--}}
            {{--<div class="col-sm-10 col-sm-offset-1 col-xs-12">--}}
                {{--<nav class="footer-nav">--}}
                    {{--<ul class="footer-nav-inner">--}}
                        {{--<li><a href="{!!url('policy')!!}" target="_blank">Privacy Policy</a></li>--}}
                        {{--<li><a href="{!!url('terms')!!}" target="_blank">Terms of service</a></li>--}}
                    {{--</ul>--}}
                {{--</nav>--}}
            {{--</div>--}}
        {{--</div>--!!}--}}

        <div class="row">
            <div class="col-md-4">
                <div class="copyright-info" style="text-align: center;">
                    <span><a href="{!!url('policy')!!}" target="_blank">PRIVACY POLICY</a></span>
                    <span><a href="{!!url('terms')!!}" target="_blank">TERMS OF SERVICE</a></span>
                </div>
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="copyright-info" style="text-align: center;">
                    <p>© 2015 Nabour. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Scroll To Top -->
{{--{!!--<a href="#" class="scrollup"><i class="fa fa-angle-up"></i></a>--!!}--}}

<script src="{!! url('/') !!}/home-theme/js/jquery-1.11.3.min.js"></script>
<script src="{!! url('/') !!}/home-theme/js/bootstrap.min.js"></script>
<script src="{!! url('/') !!}/home-theme/js/jquery.ajaxchimp.min.js"></script>
<script src="{!! url('/') !!}/home-theme/js/jquery.swipebox.min.js"></script>
<script src="{!! url('/') !!}/home-theme/js/fappear.js"></script>
<script src="{!! url('/') !!}/home-theme/js/classie.js"></script>
<script src="{!! url('/') !!}/home-theme/js/jquery.countTo.js"></script>
<script src="{!! url('/') !!}/home-theme/js/jquery.typer.js"></script>
<script src="{!! url('/') !!}/home-theme/js/jquery.smooth-scroll.js"></script>
<script src="{!! url('/') !!}/home-theme/js/main.js"></script>
<script src="{!! url('/') !!}/home-theme/js/parallax.min.js"></script>
<script src="{!! url('/') !!}/owl-carousel/owl.carousel.min.js"></script>
<script type="text/javascript" src="{!!url('/')!!}/fancybox/jquery.fancybox.pack.js?v=2.1.5"></script>
<!-- Resource jQuery -->
<script type="text/javascript">
    $(document).ready(function() {
        $('#main-brief-content').css('min-height', $(window).height() - 70 +'px');

        var owl = $('#problem-carousel');
        owl.owlCarousel({
            dots : true, // Show next and prev buttons
            items:1,
            loop:true,
            autoplay:true,
            autoplaySpeed:1000,
            autoplayTimeout:10000,
            autoplayHoverPause:true
        });

        $('#login-link').on('click', function () {
            $("#login-error").hide();
        })

        $('.language').on('click', function () {
            $('.language-list').slideToggle(300);
        })

        $('#login-btn').on('click', function() {
            var $btn = $(this);
            $btn.attr('disabled','disabled');
            ajaxLogin ($btn);
            return false;
        });

        $('#ajaxform').on('keydown', function(e) {
            if(e.keyCode == 13) {
                var $btn = $('#login-btn');
                $btn.attr('disabled','disabled');
                ajaxLogin ($btn);
                return false;
            }

        });
    })

    function ajaxLogin($btn) {
        $.ajax({
            type: 'post',
            cache: false,
            url: '{!!url('signin')!!}',
            dataType: 'json',
            data: $('form#ajaxform').serialize(),
            beforeSend: function() {
                $("#login-error").hide();
            },
            success: function(data) {
                if(data.auth == 0) {
                    $btn.removeAttr('disabled');
                    $("#login-error").slideDown(300);
                } else {
                    window.location.href = "{!! url('auth/login') !!}";
                }
            },
            error: function(xhr, textStatus, thrownError) {
                alert('Something went to wrong.Please Try again later...');
            }
        });
    }
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-72495831-1', 'auto');
  ga('send', 'pageview', location.pathname);

</script>
<link rel="stylesheet" href="{!!url('/')!!}/fancybox/jquery.fancybox.css" type="text/css" media="screen" />

@yield('script')
</body>
</html>
