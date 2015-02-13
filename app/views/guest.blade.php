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
                    4/1 (267/12) Nguyễn Văn Lượng, P.16, Q.Gò Vấp, Hồ Chí Minh, Vietnam <br>
                </div><br>
            </div>
        </div>
    </body>
</html>