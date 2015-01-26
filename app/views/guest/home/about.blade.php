@extends('guest')

@section('main')
    @if ($public = Config::get('app.view')) @endif
    <div id="figure">
        {{ HTML::image($public . '/guest/images/headline-about.jpg', 'no-image') }}
        <span id="home">abc <a href="{{ URL('home/menu') }}">Find out why.</a></span>
    </div>
    <div>
        <a href="{{ URL('home/about') }}" class="about">About</a>
        <div>
            <h3>We Have Free Templates for Everyone</h3>
            <p>
                Our website templates are created with inspiration, checked for quality and originality and meticulously sliced and coded. What's more, they're absolutely free! You can do a lot with them. You can modify them. You can use them to design websites for clients, so long as you agree with the <a href="http://www.freewebsitetemplates.com/about/termsofuse/">Terms of Use</a>. You can even remove all our links if you want to.
            </p>
            <h3>We Have More Templates for You</h3>
            <p>
                Looking for more templates? Just browse through all our <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a> and find what you're looking for. But if you don't find any website template you can use, you can try our <a href="http://www.freewebsitetemplates.com/freewebdesign/">Free Web Design</a> service and tell us all about it. Maybe you're looking for something different, something special. And we love the challenge of doing something different and something special.
            </p>
            <h3>Be Part of Our Community</h3>
            <p>
                If you're experiencing issues and concerns about this website template, join the discussion <a href="http://www.freewebsitetemplates.com/forums/">on our forum</a> and meet other people in the community who share the same interests with you.
            </p>
            <h3>Template Details</h3>
            <p>
                Design version 3<br>Code version 2
            </p>
            <p>
                Website Template details, discussion and updates for this <a href="http://www.freewebsitetemplates.com/discuss/coffeewebsitetemplate/">Coffee Website Template</a>.<br>Website Template design by <a href="http://www.freewebsitetemplates.com/">Free Website Templates</a>.
            </p>
            <p>
                Please feel free to remove some or all the text and links of this page and replace it with your own About content.
            </p>
        </div>
    </div>
@endsection