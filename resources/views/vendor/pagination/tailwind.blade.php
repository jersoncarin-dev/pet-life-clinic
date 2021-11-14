@if ($paginator->hasPages())
    <nav aria-label="Pagination">
        <ul class="pagination pagination-sm justify-content-end mt-2">
            @if ($paginator->onFirstPage())
                <li class="page-item">
                    <a class="page-link" style="pointer-events: none;" tabindex="-1" aria-label="Previous">Prev</a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" tabindex="-1" aria-label="Previous">Prev</a>
                </li>
            @endif

            @foreach ($elements as $element)
                @if (is_string($element))
                    <li class="page-item">
                        <a class="page-link" style="pointer-events: none;" href="javascript:void(0)">{{ $element }}</a>
                    </li>
                @endif

                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="page-item active">
                                <a class="page-link" style="pointer-events: none;" href="javascript:void(0)">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if (!$paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" style="pointer-events: none;" tabindex="-1" aria-label="Next">Next</a>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" tabindex="-1" aria-label="Next">Next</a>
                </li>
            @endif
        </ul>
    </nav>
@endif