<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Xenon Boostrap Admin Panel" />
    <meta name="author" content="" />

    <title>Nabour</title>

    <!-- Print Invoice & Receipt -->

    <link rel="stylesheet" href="{!! url('/') !!}/css/print/print-type0.css?version={!!time()!!}">
    <link rel="stylesheet" href="{!! url('/') !!}/css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="{!! url('/') !!}/css/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{!! url('/') !!}/css/bootstrap.css">
    <link rel="stylesheet" href="{!! url('/') !!}/css/xenon-core.css">
    <link rel="stylesheet" href="{!! url('/') !!}/css/xenon-forms.css">
    <link rel="stylesheet" href="{!! url('/') !!}/css/xenon-components.css">
    <link rel="stylesheet" href="{!! url('/') !!}/css/custom.css?version={!!time()!!}">
    <link rel="stylesheet" href="{!! url('/') !!}/font/thaisans/font.css">
    <link rel="stylesheet" href="{!! url('/') !!}/css/fonts/elusive/css/elusive.css">

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

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="print-only-content">
        @yield('content')
    <script src="{!! url('/') !!}/js/jquery-1.11.1.min.js"></script>
    <script>
        $(window).load( function () {
            window.print();
            setTimeout(function(){window.close();}, 1);
        });
    </script>
</body>
</html>
