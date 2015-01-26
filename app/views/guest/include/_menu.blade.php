<?php
    $action = Route::currentRouteName();

    switch($action) {
        case 'home-index';
            $isHomeIndex = true;
            break;

        case 'home-gallery';
            $isHomeGallery = true;
            break;

        case 'home-location';
            $isHomeLocation = true;
            break;

        case 'home-menu';
            $isHomeMenu = true;
            break;

        case 'home-about';
            $isAboutIndex = true;
            break;

        default:
            $isHomeIndex = true;
            break;
    }
?>

<ul>
    <li class="@if (isset($isHomeIndex)) {{ 'current' }} @endif">
        <a href="{{ URL('home/index') }}">Home</a>
    </li>
    <li class="@if (isset($isHomeMenu)) {{ 'current' }} @endif">
        <a href="{{ URL('home/menu') }}">Menu</a>
    </li>
    <li class="@if (isset($isHomeGallery)) {{ 'current' }} @endif">
        <a href="{{ URL('home/gallery') }}">Gallery</a>
    </li>
    <li class="@if (isset($isHomeLocation)) {{ 'current' }} @endif">
        <a href="{{ URL('home/location') }}">Locations</a>
    </li>
    <li class="@if (isset($isAboutIndex)) {{ 'current' }} @endif">
        <a href="{{ URL('home/about') }}">About Us</a>
    </li>
</ul>