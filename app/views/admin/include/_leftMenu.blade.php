<?php
    $action = Route::currentRouteName();

    switch($action) {
        case 'dash-board-index ';
            $isDashBoardIndex = true;
            break;

        case 'dish-index';
            $isDishIndex = true;
            break;

        case 'category-index';
            $isCategoryIndex = true;
            break;

        default:
            $isDashBoardIndex = true;
            break;
    }
?>

<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a class="@if (isset($isDashBoardIndex)) {{ 'active' }} @endif" href="{{ URL('dash-board/index') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
        </ul>
    </div>

    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                @if ($public = Config::get('app.view')) @endif

                <a class="@if (isset($isDishIndex)) {{ 'active' }} @endif" href="{{ URL('dish/listDish') }}">
                    <i class="fa fa-table fa-fw"></i> List dish</a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL('dish/createDish') }}"> Create dish</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a class="@if (isset($isCategoryIndex)) {{ 'active' }} @endif" href="{{ URL('category/listCategory') }}">
                    <i class="fa fa-table fa-fw"></i> List category</a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="{{ URL('category/createCategory') }}"> Create category</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>

    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a class="" href="{{ URL('dish/index') }}"><i class="fa fa-table fa-fw"></i> List menu</a>
            </li>
        </ul>
    </div>

    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a class="" href="{{ URL('dish/index') }}"><i class="fa fa-table fa-fw"></i> List page</a>
            </li>
        </ul>
    </div>

    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a class="" href="{{ URL('dish/index') }}"><i class="fa fa-table fa-fw"></i> About</a>
            </li>
        </ul>
    </div>
</div>
