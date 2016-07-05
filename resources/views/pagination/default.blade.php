<?php
// config
$link_limit = 8; // maximum number of links
?>

@if ($paginator->lastPage() > 1)
    <ul class="pagination text-center">
        <li class="pagination-previous{{ ($paginator->currentPage() == 1) ? ' disabled' : '' }}">
            @if ($paginator->currentPage() != 1)
                <a href="{{ $paginator->url($paginator->currentPage()-1) }}">Previous</a>
            @else
                Previous
            @endif
         </li>
        @for ($i = 1; $i <= $paginator->lastPage(); $i++)
            <?php
            $half_total_links = floor($link_limit / 2);
            $from = $paginator->currentPage() - $half_total_links;
            $to = $paginator->currentPage() + $half_total_links;
            if ($paginator->currentPage() < $half_total_links) {
               $to += $half_total_links - $paginator->currentPage();
            }
            if ($paginator->lastPage() - $paginator->currentPage() < $half_total_links) {
                $from -= $half_total_links - ($paginator->lastPage() - $paginator->currentPage()) - 1;
            }
            ?>
            @if ($from < $i && $i < $to)
                <li class="{{ ($paginator->currentPage() == $i) ? ' current' : '' }}">
                    <a href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endif
        @endfor
        <li class="pagination-next{{ ($paginator->currentPage() == $paginator->lastPage()) ? ' disabled' : '' }}">
            @if ($paginator->currentPage() != $paginator->lastPage())
                <a href="{{ $paginator->url($paginator->currentPage()+1) }}">Next</a>
            @else
                Next
            @endif
        </li>
    </ul>
@endif