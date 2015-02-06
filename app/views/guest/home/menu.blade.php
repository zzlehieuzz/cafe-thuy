@extends('guest')

@section('main')
    @if ($public = Config::get('app.view')) @endif
    <div id="figure">
        {{ HTML::image($public . '/guest/images/headline-menu.jpg', 'no-image') }}
        <span id="home">abc <a href="{{ URL('home/menu') }}">Find out why.</a></span>
    </div>
    <div>
        {{--<a href="{{ URL('home/menu') }}" class="whatshot">What&#39;s Hot</a>--}}
        <div style="padding-left: 10px;">
            @if (isset($groupMenu))
                <a href="{{URL('home/menu')}}" style="background-color: crimson; color: #f5f5f5; font-weight: bolder; font-size: 20px; padding: 5px;">
                    Tất cả</a>
                    @foreach($category as $key => $categoryItem)
                    <a href="{{URL('home/menu/'.$key)}}" style="background-color: crimson; color: #f5f5f5; font-weight: bolder; font-size: 20px; padding: 5px;">
                        {{ $categoryItem }}</a>
                @endforeach
                <br>
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
            @endif
        </div>
    </div>
@endsection