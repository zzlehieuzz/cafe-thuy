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
            <a href="{{ URL('home/location') }}" class="locations">Locations</a>
            <div>
                <dl>
                    <dt>Yay&#33;KOFFEE</dt>
                    <dd>Lorem ipsum dolor sit amet</dd>
                    <dd>Consectetur adipiscing elit</dd>
                    <dd>Nulla lobortis, arcu odio dapibus odio</dd>
                    <dd>Mauris et arcu</dd>
                </dl>
                <dl>
                    <dt>Yay&#33;KOFFEE</dt>
                    <dd>Lorem ipsum dolor sit amet</dd>
                    <dd>Consectetur adipiscing elit</dd>
                    <dd>Nulla lobortis, arcu odio dapibus odio</dd>
                    <dd>Mauris et arcu</dd>
                </dl>
                <dl>
                    <dt>Yay&#33;KOFFEE</dt>
                    <dd>Lorem ipsum dolor sit amet</dd>
                    <dd>Consectetur adipiscing elit</dd>
                    <dd>Nulla lobortis, arcu odio dapibus odio</dd>
                    <dd>Mauris et arcu</dd>
                </dl>
                <dl>
                    <dt>Yay&#33;KOFFEE</dt>
                    <dd>Lorem ipsum dolor sit amet</dd>
                    <dd>Consectetur adipiscing elit</dd>
                    <dd>Nulla lobortis, arcu odio dapibus odio</dd>
                    <dd>Mauris et arcu</dd>
                </dl>
                <dl>
                    <dt>Yay&#33;KOFFEE</dt>
                    <dd>Lorem ipsum dolor sit amet</dd>
                    <dd>Consectetur adipiscing elit</dd>
                    <dd>Nulla lobortis, arcu odio dapibus odio</dd>
                    <dd>Mauris et arcu</dd>
                </dl>
                <dl>
                    <dt>Yay&#33;KOFFEE</dt>
                    <dd>Lorem ipsum dolor sit amet</dd>
                    <dd>Consectetur adipiscing elit</dd>
                    <dd>Nulla lobortis, arcu odio dapibus odio</dd>
                    <dd>Mauris et arcu</dd>
                </dl>
                <dl>
                    <dt>Yay&#33;KOFFEE</dt>
                    <dd>Lorem ipsum dolor sit amet</dd>
                    <dd>Consectetur adipiscing elit</dd>
                    <dd>Nulla lobortis, arcu odio dapibus odio</dd>
                    <dd>Mauris et arcu</dd>
                </dl>
                <dl>
                    <dt>Yay&#33;KOFFEE</dt>
                    <dd>Lorem ipsum dolor sit amet</dd>
                    <dd>Consectetur adipiscing elit</dd>
                    <dd>Nulla lobortis, arcu odio dapibus odio</dd>
                    <dd>Mauris et arcu</dd>
                </dl>
                <dl>
                    <dt>Yay&#33;KOFFEE</dt>
                    <dd>Lorem ipsum dolor sit amet</dd>
                    <dd>Consectetur adipiscing elit</dd>
                    <dd>Nulla lobortis, arcu odio dapibus odio</dd>
                    <dd>Mauris et arcu</dd>
                </dl>
                <dl>
                    <dt>Yay&#33;KOFFEE</dt>
                    <dd>Lorem ipsum dolor sit amet</dd>
                    <dd>Consectetur adipiscing elit</dd>
                    <dd>Nulla lobortis, arcu odio dapibus odio</dd>
                    <dd>Mauris et arcu</dd>
                </dl>
            </div>
        </div>
    </div>
@endsection