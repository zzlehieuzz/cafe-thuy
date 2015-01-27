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
            @if (isset($groupMenu))
                @foreach($groupMenu as $groupMenuItem)
                    <span style="background-color: crimson; color: #f5f5f5; font-weight: bolder; font-size: 20px; padding: 5px;">{{ $groupMenuItem['category_name'] }}</span>
                    <?php unset($groupMenuItem['category_name']) ?>
                    <ul>
                        @foreach($groupMenuItem as $dishItem)
                            <li>
                                <a href="{{ URL('home/menu') }}">
                                    {{ HTML::image(Dish::getPathDishThumpImage() . '/' . $dishItem['thump_image_name'], 'no-image',
                                        array('width'  => Dish::DISH_THUMP_WIDTH ,
                                              'height' => Dish::DISH_THUMP_HEIGHT)) }}
                                </a>
                                <div>
                                    <a style="color: #2b542c">{{ $dishItem['title'] }}</a>
                                    <p style="color: #287db5">{{ number_format($dishItem['price'])}} VNĐ</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            @endif
        </div>
    </div>
@endsection