<meta charset="utf-8">
<meta name="viewport" content="width=device-width">
@section('title')
    <title>{{ Config::get('app.title') }}</title>
@show

<link rel="icon" type="image/x-icon" href="{{ url(Config::get('app.view') . 'common/img/breakfast.ico') }}" />

{{ HTML::style($public . 'guest/css/style.css') }}