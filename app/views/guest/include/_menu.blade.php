<?php $action = Route::currentRouteName(); ?>

<ul>
    @if ($menuItems)
        @foreach($menuItems as $key => $menuItem)
            <li class="@if ($action == str_replace("/","-",$menuItem['routes'])) {{ 'current' }} @endif">
                <a href="{{ URL($menuItem['routes']) }}">{{$menuItem['name']}}</a>
            </li>
        @endforeach
    @endif
</ul>