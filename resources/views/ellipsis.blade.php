{{-- @if ($paginator->onFirstPage())
    <span class="pagination-ellipsis">&hellip;</span>
@else
    <a href="{{ $paginator->url(1) }}" class="pagination-link">1</a>
@endif

@if ($paginator->currentPage() > 2)
    <span class="pagination-ellipsis">&hellip;</span>
@endif

@foreach (range( max(2, $paginator->currentPage() - 2), min($paginator->currentPage() + 2, $paginator->lastPage() - 1) ) as $page)
    @if ($page == $paginator->currentPage())
        <span class="pagination-current">{{ $page }}</span>
    @else
        <a href="{{ $paginator->url($page) }}" class="pagination-link">{{ $page }}</a>
    @endif
@endforeach

@if ($paginator->currentPage() < $paginator->lastPage() - 2)
    <span class="pagination-ellipsis">&hellip;</span>
@endif

@if ($paginator->currentPage() < $paginator->lastPage() - 1)
    <a href="{{ $paginator->url($paginator->lastPage()) }}" class="pagination-link">{{ $paginator->lastPage() }}</a>
@endif --}}

{{-- @if ($paginator->hasPages())
    <ul class="pagination">
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&laquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
            </li>
        @endif

        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&raquo;</a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
                <span class="page-link" aria-hidden="true">&raquo;</span>
            </li>
        @endif
    </ul>
@endif --}}

