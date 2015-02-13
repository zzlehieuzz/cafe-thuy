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
        <ul style="padding-bottom: 10px;">
            <li>
                <a href="blog.html">
                    {{ HTML::image($public . 'guest/images/coffee-ingredients.jpg', 'no-image', array('width' => 194, 'height' => 194)) }}</a>
                <h2><a href="blog.html">Cafe</a></h2>
                <p>
                    Được lấy từ thủ phủ cafe của Buôn Ma Thuột đậm đà thơm ngon, cùng hòa quyện với hương ngọt ngào
                    của cafe Lầm Đồng Bảo Lộc.
                    Uống ly cafe, hớp 1 ngụm trà của Bảo Lộc
                    (được đặt ngay tại công ty trứ danh của Bảo Lộc) làm cho ta cảm thấy thăng hoa ...
                </p>
                {{--<a href="blog.html" class="readmore">Read More</a>--}}
            </li>
            <li>
                <a href="blog.html">
                    {{ HTML::image($public . 'guest/images/milk.jpg', 'no-image', array('width' => 194, 'height' => 194)) }}</a>
                <h2><a href="blog.html">Sữa tươi</a></h2>
                <p>
                    Được lấy từ những con bò khỏe mạnh,
                    tới tận nhà nông để lấy sữa rồi đem nấu sôi, hợp vệ sinh ...
                </p>
                {{--<a href="blog.html" class="readmore">Read More</a>--}}
            </li>
            <li>
                <a href="blog.html">
                    {{ HTML::image($public . 'guest/images/rong_bien.jpg', 'no-image', array('width' => 194, 'height' => 194)) }}</a>
                <h2><a href="blog.httuoi7">Rong biển</a></h2>
                <p>
                    Rong biển, bông cúc, mủ trôm được ở quán trực tiếp nấu lấy, chắc lọc sạch sẽ và có nguồn gốc rỏ ràng.
                    Được nấu sôi cùng hương vị thơm ngon tự nhiên và đặc biệt là không chất bảo quản. (Có bỏ mối) ...
                </p>
                {{--<a href="blog.html" class="readmore">Read More</a>--}}
            </li>
        </ul>
        <div>
            @include('guest.include._recent_dish')
        </div>
    </div>
@endsection