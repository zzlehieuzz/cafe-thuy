@extends('guest')

@section('main')
    @if ($public = Config::get('app.view')) @endif
    <div id="figure">
        {{ HTML::image($public . '/guest/images/headline-home.jpg', 'no-image') }}
        <span id="home">abc <a href="{{ URL('home/index') }}">Find out why.</a></span>
    </div>
    <div id="featured">
        @include('guest.include._featured')
    </div>
    <div class="section">
        <ul>
            <li>
                <a href="blog.html">
                    {{ HTML::image($public . 'guest/images/coffee-ingredients.jpg', 'no-image') }}</a>
                <h2><a href="blog.html">Lorem ipsum</a></h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in tellus id eros iaculis porttitor eget ultrices mauris. Nulla sodales congue ante, id
                </p>
                <a href="blog.html" class="readmore">Read More</a>
            </li>
            <li>
                <a href="blog.html">
                    {{ HTML::image($public . 'guest/images/black-coffee.jpg', 'no-image') }}</a>
                <h2><a href="blog.html">Dolor sit amet</a></h2>
                <p>
                    Nulla sodales congue ante, id fermentum mi tincidunt ac. Sed eu vestibulum nisl. Maecenas pharetra hendrerit eros sed laoreet. Maecenas malesuada
                </p>
                <a href="blog.html" class="readmore">Read More</a>
            </li>
            <li>
                <a href="blog.html">
                    {{ HTML::image($public . 'guest/images/chocolate.jpg', 'no-image') }}</a>
                <h2><a href="blog.html">Nullam quis</a></h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque in tellus id eros iaculis porttitor eget ultrices mauris. Nulla sodales congue ante, id
                </p>
                <a href="blog.html" class="readmore">Read More</a>
            </li>
        </ul>
        <div>
            <ul>
                <li>
                    <h3><a href="blog.html">Lorem ipsum</a></h3>
                    <span>28 November 2011</span>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. blandit nunc. Donec in velit sed ante interdum condimentum pretium sit amet erat.
                    </p>
                    <a href="blog.html" class="readmore">Read more</a>
                </li>
                <li>
                    <h3><a href="blog.html">Dolor sit amet</a></h3>
                    <span>25 November 2011</span>
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                    </p>
                    <a href="blog.html" class="readmore">Read more</a>
                </li>
            </ul>
        </div>
    </div>
@endsection