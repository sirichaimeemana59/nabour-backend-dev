<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Major Care - Major Development" />
    <meta name="author" content="" />

    <title>NABOUR - Administrator</title>

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

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ url('images/mjd-icon.png') }}">
    {{--<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Arimo:400,700,400italic">--}}
    <link rel="stylesheet" href="{{ url('/') }}/css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/xenon-core.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/xenon-forms.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/xenon-components.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/xenon-skins.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/custom.css">
    <link rel="stylesheet" href="{{ url('/') }}/font/Stidti/font.css">

    <script src="{{ url('/') }}/js/jquery-1.11.1.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="page-body login-page">
<div class="login-container">
    <div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <script type="text/javascript">
                jQuery(document).ready(function($)
                {
                    // Reveal Login form
                    setTimeout(function(){ $(".fade-in-effect").addClass('in'); }, 1);
                    // Set Form focus
                    $("form#login .form-group:has(.form-control):first .form-control").focus();
                });
            </script>

            <!-- Errors container -->
            <div class="errors-container">


            </div>

            <!-- Add class "fade-in-effect" for login form effect -->
            <form method="POST" action="{!! route('login') !!}" class="login-form fade-in-effect">
            {{--{!! Form::open(array('url' => 'auth/login','id'=>'login','class'=>'login-form fade-in-effect')) !!}--}}
            <div class="login-header" style="margin-bottom: 20px;">

                    <img src="{{ url('/images/nb-logo.png') }}"/><br/>
                    {{--<div>NABOUR Backend</div>--}}

            </div>

            <div class="form-group">
                <!-- <label class="control-label" for="email">Email</label> -->
                <input type="text" class="form-control input-dark" name="email" id="email" autocomplete="off" placeholder="Email"/>
            </div>

            <div class="form-group">
                <!-- <label class="control-label" for="passwd">Password</label> -->
                <input type="password" class="form-control input-dark" name="password" id="passwd" autocomplete="off" placeholder="Password" />
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-dark  btn-block text-left">
                    <i class="fa-lock"></i>
                    Log In
                </button>
            </div>

            <!-- <div class="login-footer">
                <a href="#">Forgot your password?</a>
            </div> -->
            </form>

        </div>

    </div>

</div>

<style>
    @import url(https://fonts.googleapis.com/css?family=Lato:400,700,900);
    .logo img {
        float: left;
        margin-right: 20px;
    }
    .login-page .login-form .login-header .logo div {
        padding-top: 11px;
        font-size: 38px;
        line-height: 41px;
        color: #d8d8d8;
    }
    .login-page .login-form .form-group .form-control.input-dark {
        border: 1px solid #d8d8d8;
    }
    .login-page .login-form .form-group .btn.btn-dark {
        background: #3c3c3c;
        color: #d8d8d8;
    }
    .login-page .login-form .form-group .btn.btn-dark:hover {
        border: 1px solid #d8d8d8;
    }
    .login-page .login-form .login-footer {
        margin-top: 10px;
    }
    .login-page .login-form .login-footer a {
        font-size: 14px;
    }
    .login-page {
        background: #2dbca6;
    }
</style>

</body>
</html>