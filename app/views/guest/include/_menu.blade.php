<?php $action = Route::currentRouteName(); ?>

<ul>
    @if ($menuItems)
        @foreach($menuItems as $key => $menuItem)
            <li class="@if (strpos($action, str_replace("/","-", $menuItem['routes'])) !== false) {{ 'current' }} @endif">
                <a href="{{ URL($menuItem['routes']) }}">{{$menuItem['name']}}</a>
            </li>
        @endforeach
    @endif
</ul>