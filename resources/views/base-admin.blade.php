<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="XNabour Backend" />
    <meta name="author" content="" />
    <title>Nabour Backend</title>

    <link rel="stylesheet" href="{{ url('/') }}/css/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/bootstrap.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/xenon-core.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/xenon-forms.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/xenon-components.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/xenon-admin-skins.css">
    <link rel="stylesheet" href="{{ url('/') }}/css/custom.css?version={{time()}}">
    <link rel="stylesheet" href="{{ url('/') }}/font/Stidti/font.css">

    <!-- favicon -->
    <link rel="apple-touch-icon" sizes="57x57" href="{{ url('/') }}/home-theme/img/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ url('/') }}/home-theme/img/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ url('/') }}/home-theme/img/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ url('/') }}/home-theme/img/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ url('/') }}/home-theme/img/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="{{ url('/') }}/home-theme/img/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="{{ url('/') }}/home-theme/img/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="{{ url('/') }}/home-theme/img/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ url('/') }}/home-theme/img/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" href="{{ url('/') }}/home-theme/img/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="{{ url('/') }}/home-theme/img/favicon/android-icon-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="{{ url('/') }}/home-theme/img/favicon/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="{{ url('/') }}/home-theme/img/favicon/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="{{ url('/') }}/home-theme/img/favicon/manifest.json">
    <meta name="msapplication-TileImage" content="{{ url('/') }}/home-theme/img/favicon/mstile-144x144.png">

    <!-- SweetAlert Library -->
    <script src="{{ url('/') }}/sweetalert/dist/sweetalert.min.js"></script>
    <script src="{{ url('/') }}/js/jquery-1.11.1.min.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="page-body skin-turquoise">
<!-- Page Loading Overlay -->
<div class="page-loading-overlay">
    <div class="loader-2"></div>
</div>
    <input type="hidden" id="root-url" value="{{url('/')}}"/>

<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
        <!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
        <!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
        <!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
        <div class="sidebar-menu toggle-others fixed">

            <div class="sidebar-menu-inner">

                <header class="logo-env">

                    <!-- logo -->
                    <div class="logo">
                        <a href="{{ url('/') }}" class="logo-expanded">
                            <img src="{{ url('/') }}/images/nb-logo.png" width="160" alt="" />
                        </a>

                        <a href="{{ url('/') }}" class="logo-collapsed">
                            <img src="{{ url('/') }}/images/nb-logo-@2x.png" width="40" alt="" />
                        </a>
                    </div>

                    <!-- This will toggle the mobile menu and will be visible only on mobile devices -->
                    <div class="mobile-menu-toggle">
                        <a href="#" data-toggle="mobile-menu">
                            <i class="fa-bars"></i>
                        </a>
                    </div>
                </header>
                <?php /*@if(Auth::user()->role == 0)
                    @include('menu-layouts.super-admin.main-menu')
                @elseif(Auth::user()->role == 1)
                    @include('menu-layouts.nabour-admin.main-menu')
                @else
                    @include('menu-layouts.sales.main-menu')
                @endif */ ?>

                @include('menu-layouts.super-admin.main-menu')
            </div>
        </div>

        <div class="main-content">
            @include('menu-layouts.user-nav')

            @yield('content')

            <footer class="main-footer sticky footer-type-1">
                <div class="footer-inner">
                    <!-- Add your copyright text here -->
                    <div class="footer-text">
                        &copy; 2015
                        <strong>Nabour</strong>
                    </div>
                    <!-- Go to Top Link, just add rel="go-top" to any link to add this functionality -->
                    <div class="go-up">

                        <a href="#" rel="go-top">
                            <i class="fa-angle-up"></i>
                        </a>
                    </div>
                </div>
            </footer>
        </div>
    </div>

<script src="{{ url('/') }}/js/bootstrap.min.js"></script>
<script src="{{ url('/') }}/js/TweenMax.min.js"></script>
<script src="{{ url('/') }}/js/resizeable.js"></script>
<script src="{{ url('/') }}/js/xenon-api.js"></script>
<script src="{{ url('/') }}/js/xenon-toggles.js"></script>
<!-- JavaScripts initializations and stuff -->
<script src="{{ url('/') }}/js/xenon-custom.js"></script>

    @yield('script')

</body>
</html>
