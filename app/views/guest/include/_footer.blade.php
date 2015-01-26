<div>
    <a href="{{ URL('home/index') }}">{{ HTML::image($public . 'guest/images/logo2.png', 'no-image') }}</a>
    <p class="footnote">&copy; {{ Config::get('app.title') }} 2014.<br>All Rights Reserved.</p>
</div>

<div class="section">
    @include('guest.include._menu')
    <div id="connect">
        <a href="http://freewebsitetemplates.com/go/facebook/" target="_blank" id="facebook">Facebook</a>
        <a href="http://freewebsitetemplates.com/go/twitter/" target="_blank" id="twitter">Twitter</a>
        <a href="http://freewebsitetemplates.com/go/googleplus/" target="_blank" id="googleplus">Google+</a>
        <a href="{{ URL('home/index') }}" id="rss">RSS</a>
    </div>
</div>