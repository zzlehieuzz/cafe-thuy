<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
@section('title')
    <title>{{ Config::get('app.title') }}</title>
@show

<link rel="icon" type="image/x-icon" href="{{ url(Config::get('app.view') . 'common/img/breakfast.ico') }}" />
@if ($public = Config::get('app.view')) @endif
{{ HTML::style($public . 'admin/css/bootstrap.min.css') }}
{{ HTML::style($public . 'admin/css/plugins/metisMenu/metisMenu.min.css') }}
{{ HTML::style($public . 'admin/css/sb-admin-2.css') }}
{{ HTML::style($public . 'admin/font-awesome-4.1.0/css/font-awesome.min.css') }}

{{ HTML::style($public . 'common/css/style.css') }}

<!-- jQuery -->
{{ HTML::script($public . 'admin/js/jquery.js') }}
{{ HTML::script($public . 'admin/js/bootstrap.min.js') }}
{{ HTML::script($public . 'admin/js/sb-admin-2.js') }}
{{ HTML::script($public . 'admin/js/plugins/metisMenu/metisMenu.min.js') }}

<!-- Common -->
{{ HTML::script($public . 'common/js/common.js') }}