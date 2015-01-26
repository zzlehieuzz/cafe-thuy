<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Login {{ Config::get('app.title') }} System</title>
        @if ($public = Config::get('app.view')) @endif
        <link rel="icon" type="image/x-icon" href="{{ url($public . 'common/img/breakfast.ico') }}" />

        {{ HTML::style($public . 'login/css/style.css') }}
        {{ HTML::style($public . 'admin/css/bootstrap.min.css') }}
        {{ HTML::script($public . 'login/js/modernizr.custom.63321.js') }}
    </head>
    <body>
        <div class="container">
            <section class="main">
                {{ Form::open(['action' => 'login-post','method' => 'POST', 'class' => 'form-2']) }}
                    <h1><span class="log-in">{{ Lang::get('common.login') }}</span></h1>
                    @if($errors->has())
                        <ul class="alert alert-danger">
                            {{ implode('', $errors->all('<li>:message</li>')) }}
                        </ul>
                    @endif

                    @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{ '<div>' . Session::get('success') . '</div>' }}
                        </div>
                    @endif

                    {{ Form::text('user_name', 'user01', ['placeholder'=>'Username here']) }}
                    {{ Form::input('password', 'password', '123456', ['placeholder'=>'Password here']) }}

                    <p class="clearfix">
                        <div class="float-right">
                          {{ Form::submit('Login',['class'=>'submit']) }}
                        </div>
                        <div class="clear-both"></div>
                {{ Form::close() }}
            </section>
        </div>
    </body>
</html>