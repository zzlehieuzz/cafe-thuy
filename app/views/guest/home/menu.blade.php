@extends('guest')

@section('main')
    @if ($public = Config::get('app.view')) @endif
    <div id="figure">
        {{ HTML::image($public . '/guest/images/separator-blog-entry.png', 'no-image') }}
        <span id="home">abc <a href="{{ URL('home/menu') }}">Find out why.</a></span>
    </div>

    @if (isset($groupMenu))
        <a href="{{URL('home/menu')}}" class="menu-dish">Tất cả</a>
        @foreach($category as $key => $categoryItem)
            <a href="{{URL('home/menu/'.$key)}}" class="menu-dish">{{ $categoryItem }}</a>
        @endforeach
        <div>
            <div style="padding-left: 10px;">
                <br>
                <br>
                <ul>
                    @foreach($groupMenu as $key =>  $dishItem)
                        <li style="padding-bottom: 20px;">
                            <a href="{{ URL('home/menu') }}">
                                {{ HTML::image($dishItem['image_url'], 'no-image', array('width'=>120, 'height'=>120, 'class'=> 'displayed')) }}
                            </a>
                            <div style="padding: 0 6px 5px 6px;">
                                <a style="color: #2b542c">{{ $dishItem['title'] }}</a>
                                <p style="color: #287db5">{{ number_format($dishItem['price'])}} VNĐ</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@endsection