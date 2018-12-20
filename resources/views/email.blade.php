<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>
<body class="page-body" style="color:#666;line-height:20px;font-size:14px;">
    <div class="content" style="border: 2px solid #2dbca6; border-radius: 5px; background-color: #fff;">
        <div class="logo" style="padding: 20px; text-align: center; background-color: #2dbca6;">
            <a href="{!! url('/') !!}"><img width="180px" src="{!! url('home-theme/img/nb-logo.png') !!}" /></a>
        </div>
        <div class="email-text" style="padding: 20px;">
            @yield('content')
        </div>
        <hr style="border:none; border-top:1px solid #ddd; margin:0 10px;"/>
        <div style="padding: 20px;">
            <table border="0" width="100%">
                <tr>
                    <td width="50%">
                        <a href="https://www.facebook.com/nabour/" style="text-decoration:none; color:#2dbca6;"><img style=" margin-bottom: -11px; margin-top: -5px; margin-right: 6px;" src="{!! url('/') !!}/home-theme/img/square-facebook.png"> Find us on Facebook </a>
                    </td>
                    <td width="50%" style="text-align: right;">
                        <a href="{!! url('/') !!}" style="text-decoration:none; color:#2dbca6;">About us</a> | <a href="{!! url('terms') !!}" style="text-decoration:none; color:#2dbca6;">Terms of Service</a> | <a href="{!! url('policy') !!}" style="text-decoration:none; color:#2dbca6;">Privacy Policy</a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>
