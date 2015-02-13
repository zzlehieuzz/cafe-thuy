<ul>
    @if (isset($dish))
        @foreach($dish as $dishItem)
            <li>
                <h3><a>{{$dishItem['title']}}</a> <b>( {{ number_format($dishItem['price'])}} VND )</b></h3>
                <a href="{{ URL('home/menu') }}" class="readmore">Read more</a>
            </li>
        @endforeach
    @endif
</ul>