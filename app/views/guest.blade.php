<!DOCTYPE html>
@if ($public = Config::get('app.view')) @endif
<html>
    <head>@include('guest.include._head')</head>
    <body>
        <div id="page">
            <div>
                <div id="header">@include('guest.include._header')</div>
                <div id="body">@yield('main')</div>
                <div id="footer">@include('guest.include._footer')</div>
                <br>
                <div id="address">
                    13 Thống Nhất, 11, Gò Vấp, Hồ Chí Minh, Vietnam <br>
                    267/12 Thống Nhất, 11, Gò Vấp, Hồ Chí Minh, Vietnam
                </div><br>
            </div>
        </div>
    </body>
</html>