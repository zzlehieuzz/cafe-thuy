<span class="whatshot"><a href="{{ URL('home/menu') }}">{{ Lang::get('guest_common.find_out_more') }}</a></span>

@if (isset($dish))
    <div>
        @foreach($dish as $dishItem)
            <a href="{{ URL('home/menu') }}">
                {{ HTML::image(Dish::getPathDishThumpImage() . '/' . $dishItem['thump_image_name'], 'no-image',
                    array('width'  => Dish::DISH_THUMP_WIDTH ,
                          'height' => Dish::DISH_THUMP_HEIGHT)) }}
            </a>
        @endforeach
    </div>
@endif