{{--<span class="whatshot"><a href="{{ URL('home/menu') }}">{{ Lang::get('guest_common.find_out_more') }}</a></span>--}}

@if (isset($dish))
    @foreach($dish as $dishItem)
        <a style="padding-right: 12px;" href="{{ URL('home/menu') }}">
            {{ HTML::image($dishItem['image_url'], 'no-image', array(
            'width'=>Dish::WIDTH_THUMPS_IMAGE,
            'height'=>Dish::HEIGHT_THUMPS_IMAGE)) }}
        </a>
    @endforeach
@endif