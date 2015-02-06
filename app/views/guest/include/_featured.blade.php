<span class="whatshot"><a href="{{ URL('home/menu') }}">{{ Lang::get('guest_common.find_out_more') }}</a></span>

@if (isset($dish))
    <div>
        @foreach($dish as $dishItem)
            <a href="{{ URL('home/menu') }}">
                {{ HTML::image($dishItem['image_url'], 'no-image', array(
                'width'=>Dish::WIDTH_THUMPS_IMAGE,
                'height'=>Dish::HEIGHT_THUMPS_IMAGE)) }}
            </a>
        @endforeach
    </div>
@endif