@extends('guest')

@section('main')
    @if ($public = Config::get('app.view')) @endif
    <div id="figure">
        {{ HTML::image($public . '/guest/images/headline-locations.jpg', 'no-image') }}
        <span id="home">abc <a href="{{ URL('home/menu') }}">Find out why.</a></span>
    </div>
    <div>
        <a href="{{ URL('home/menu') }}" class="whatshot">What&#39;s Hot</a>
        <div>
            <iframe width="690"
                    height="300"
                    frameborder="0" style="border:0"
                    src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDekdOlYq0xLzdkFf4SkEeprfHYSyh8-4Q&q=4 đường số 11, 16, Gò Vấp, Hồ Chí Minh, Việt Nam">
            </iframe>
        </div>
    </div>
@endsection