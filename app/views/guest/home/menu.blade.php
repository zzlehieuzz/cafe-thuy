@extends('guest')

@section('main')
    @if ($public = Config::get('app.view')) @endif
    <div id="figure">
        {{ HTML::image($public . '/guest/images/headline-menu.jpg', 'no-image') }}
        <span id="home">abc <a href="{{ URL('home/menu') }}">Find out why.</a></span>
    </div>
    <div>
        <a href="{{ URL('home/menu') }}" class="whatshot">What&#39;s Hot</a>
        <div>
            <ul>
                <li>
                    <a href="{{ URL('home/menu') }}">{{ HTML::image($public . '/guest/images/coffee1.jpg', 'no-image') }}</a>
                    <div>
                        <a href="{{ URL('home/menu') }}">Lorem ipsum</a>
                        <p>
                            Lorem ipsum &#36;0.00
                        </p>
                    </div>
                </li>
                <li>
                    <a href="{{ URL('home/menu') }}">{{ HTML::image($public . '/guest/images/coffee2.jpg', 'no-image') }}</a>
                    <div>
                        <a href="{{ URL('home/menu') }}">Dolor sit amet</a>
                        <p>
                            Lorem ipsum &#36;0.00
                        </p>
                    </div>
                </li>
                <li>
                    <a href="{{ URL('home/menu') }}">{{ HTML::image($public . '/guest/images/coffee3.jpg', 'no-image') }}</a>
                    <div>
                        <a href="{{ URL('home/menu') }}">Donie quis</a>
                        <p>
                            Lorem ipsum &#36;0.00
                        </p>
                    </div>
                </li>
                <li>
                    <a href="{{ URL('home/menu') }}">{{ HTML::image($public . '/guest/images/coffee4.jpg', 'no-image') }}</a>
                    <div>
                        <a href="{{ URL('home/menu') }}">Lorem ipsum</a>
                        <p>
                            Lorem ipsum &#36;0.00
                        </p>
                    </div>
                </li>
                <li>
                    <a href="{{ URL('home/menu') }}">{{ HTML::image($public . '/guest/images/coffee5.jpg', 'no-image') }}</a>
                    <div>
                        <a href="{{ URL('home/menu') }}">Dolor sit amet</a>
                        <p>
                            Lorem ipsum &#36;0.00
                        </p>
                    </div>
                </li>
                <li>
                    <a href="{{ URL('home/menu') }}">{{ HTML::image($public . '/guest/images/coffee6.jpg', 'no-image') }}</a>
                    <div>
                        <a href="{{ URL('home/menu') }}">Donie quis</a>
                        <p>
                            Lorem ipsum &#36;0.00
                        </p>
                    </div>
                </li>
            </ul>
        </div>
    </div>
@endsection