<div>
    <div class="float-left" style="padding-top: 25px; padding-right: 30px;">
        {{count($detail)}} of {{$totalItems}} items
    </div>
    <div class="float-right"><br>
        <ul class="pager" forForm="{{$forForm}}">
            <?php $limitNumber = $limitPage = 10;
                  $afterSelect = 4;
                  $i = 1;

                if($totalPage <= 1) {
                    $limitPage = 0;
                } elseif($totalPage <= $limitNumber) {
                    $limitPage = $totalPage - 1;

                    if($page == $totalPage) {
                        $limitPage = $page;
                    }
                } else {
                    if ($page >= $limitNumber) {
                        $limitPage = $page + $afterSelect;
                        if($page == $totalPage) {
                            $limitPage = $page;
                        } elseif($page >= ($totalPage - $afterSelect)) {
                            if ($limitPage > $totalPage) {
                                $limitPage = $totalPage - 1;
                            } else {
                                $limitPage = $page + $afterSelect - 1;
                            }
                        }
                        $i = $limitPage - $limitNumber + 1;
                    }
                }
            ?>
            @if (1 != $page)
                <li><a class="link-submit" href="#" action="{{ URL('home/detail/' . 1) }}">First</a></li>
            @endif

            @if ($limitPage > 0)
                @for ($i; $i <= $limitPage; $i++)
                    <li>
                        <?php $class = ''; ?>

                        @if ($i == $page)
                            <?php $class = " pager-hover"; ?>
                        @endif
                        <a class="link-submit{{$class}}" href="#" action="{{ URL('home/detail/' . $i) }}">
                            <i class="icon-dashboard"></i>
                            <span class="menu-text"> {{$i}} </span>
                        </a>
                    </li>
                @endfor
            @endif

            @if ($totalPage != $page)
                <li><a class="link-submit" href="#" action="{{ URL('home/detail/' . $totalPage) }}">{{$totalPage}} - End</a></li>
            @endif
        </ul>
    </div>
    <div class="clear-both"></div>
</div>