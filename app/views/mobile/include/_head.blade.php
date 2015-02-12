<meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
@section('title')
    <title>{{ Config::get('app.title') }}</title>
@show

<link rel="icon" type="image/x-icon" href="{{ url(Config::get('app.view') . 'common/img/breakfast.ico') }}" />

{{--<link rel="stylesheet" href="css/themes/default/jquery.mobile-1.4.5.min.css">--}}
{{--<link rel="stylesheet" href="_assets/css/jqm-demos.css">--}}
{{--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">--}}
{{--<script src="js/jquery.js"></script>--}}
{{--<script src="_assets/js/index.js"></script>--}}
{{--<script src="js/jquery.mobile-1.4.5.min.js"></script>--}}

{{ HTML::style($public . 'mobile/1.4.5/demos/css/themes/default/jquery.mobile-1.4.5.min.css') }}
{{ HTML::style($public . 'mobile/1.4.5/demos/_assets/css/jqm-demos.css') }}

{{ HTML::script($public . 'mobile/1.4.5/demos/js/jquery.js') }}
{{ HTML::script($public . 'mobile/1.4.5/demos/_assets/js/index.js') }}
{{ HTML::script($public . 'mobile/1.4.5/demos/js/jquery.mobile-1.4.5.min.js') }}