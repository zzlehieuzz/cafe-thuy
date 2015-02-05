<span class="whatshot"><a href="{{ URL('home/menu') }}">{{ Lang::get('guest_common.find_out_more') }}</a></span>

@if (isset($dish))
    <div>
        @foreach($dish as $dishItem)
            <a href="{{ URL('home/menu') }}">
                {{ HTML::image(Dish::getPathThump() . '/' . $dishItem['thump_image_name'], 'no-image',
                    array('width'  => Dish::WIDTH_THUMPS_IMAGE ,
                          'height' => Dish::HEIGHT_THUMPS_IMAGE)) }}
            </a>
        @endforeach
    </div>
@endif