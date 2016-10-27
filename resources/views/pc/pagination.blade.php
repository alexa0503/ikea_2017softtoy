@if (isset($paginator) && $paginator->lastPage() > 1)

    <div class="listNav">

        <?php
        $interval = isset($interval) ? abs(intval($interval)) : 3 ;
        $from = $paginator->currentPage() - $interval;
        if($from < 1){
            $from = 1;
        }

        $to = $paginator->currentPage() + $interval;
        if($to > $paginator->lastPage()){
            $to = $paginator->lastPage();
        }
        ?>

        <!-- first/previous -->
        @if($paginator->currentPage() > 1)

                <a href="{{ $paginator->url(1) }}" aria-label="First">
                    <span aria-hidden="true">首页</span>
                </a>

                <a href="{{ $paginator->url($paginator->currentPage() - 1) }}" aria-label="Previous">
                    <span aria-hidden="true">上一页</span>
                </a>

        @endif

        <!-- links -->
        @for($i = $from; $i <= $to; $i++)
            <?php
            $isCurrentPage = $paginator->currentPage() == $i;
            ?>
                <a href="{{ !$isCurrentPage ? $paginator->url($i) : '#' }}" class="{{ $isCurrentPage ? 'active' : '' }}">
                    {{ $i }}
                </a>
        @endfor

        <!-- next/last -->
        @if($paginator->currentPage() < $paginator->lastPage())
                <a href="{{ $paginator->url($paginator->currentPage() + 1) }}" aria-label="Next">
                    <span aria-hidden="true">下一页</span>
                </a>
                <a href="{{ $paginator->url($paginator->lastpage()) }}" aria-label="Last">
                    <span aria-hidden="true">尾页</span>
                </a>
        @endif

    </div>

@endif
