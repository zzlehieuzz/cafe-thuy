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
            @if (isset($groupMenu) && ($cntMenu = count($groupMenu)))
                @foreach($groupMenu as $key => $groupMenuItem)
                    <a href="{{URL('home/menu/'.$key)}}" style="background-color: crimson; color: #f5f5f5; font-weight: bolder; font-size: 20px; padding: 5px;">{{ $groupMenuItem['category_name'] }}</a>
                    <?php unset($groupMenuItem['category_name']) ?>
                    <ul>
                        @foreach($groupMenuItem as $dishItem)
                            <li>
                                <div style="padding-right: 5px;padding-bottom: 2px;">
                                    <a style="color: #2b542c">{{ $dishItem['title'] }}</a>
                                    <p style="color: #287db5">{{ number_format($dishItem['price'])}} VNĐ</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    @if($cntMenu != $key)
                        <br>
                    @endif
                @endforeach
            @endif
        </div>
    </div>
@endsection