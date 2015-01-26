<!DOCTYPE html>
<html class="no-js" lang="en">
    <head>
        @include('admin.include._head')
    </head>
    <body>
        <div id="wrapper">
            <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                @include('admin.include._topMenu')
                @include('admin.include._leftMenu')
            </nav>
            <div id="page-wrapper">
                @yield('main')
                <br>
            </div>
        </div>
        <div id="footer" class="center">
            ©2014 - 2015 Chinese guide
        </div>
    </body>
</html>