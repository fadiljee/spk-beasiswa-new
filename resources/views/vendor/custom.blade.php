@if ($paginator->hasPages())
<nav>
    <ul class="pagination pagination-custom justify-content-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link" aria-hidden="true">&laquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&laquo;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active" aria-current="page"><span class="page-link">{{ $page }}</span></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
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
</nav>
@endif

<style>
.pagination-custom {
  gap: 0.6rem;
  padding-left: 0;
  list-style: none;
}

.pagination-custom .page-item {
  border-radius: 8px;
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
  box-shadow: 0 3px 8px rgba(0,0,0,0.05);
}

.pagination-custom .page-link {
  color: #374151;
  border: none;
  padding: 0.5rem 0.9rem;
  background-color: #f9fafb;
  font-weight: 600;
  font-size: 1rem;
  cursor: pointer;
  border-radius: 8px;
  min-width: 40px;
  text-align: center;
  display: inline-block;
  user-select: none;
  transition: background-color 0.3s ease;
}

.pagination-custom .page-item:hover:not(.active) .page-link {
  background-color: #e5e7eb;
  box-shadow: 0 5px 15px rgba(0,0,0,0.1);
  color: #111827;
}

.pagination-custom .page-item.active .page-link {
  background-color: #2563eb;
  color: white;
  font-weight: 700;
  box-shadow: 0 6px 15px rgba(37, 99, 235, 0.6);
  cursor: default;
}

.pagination-custom .page-item.disabled .page-link {
  color: #9ca3af;
  cursor: not-allowed;
  background-color: transparent;
  box-shadow: none;
}

.pagination-custom .page-link:focus {
  outline: none;
  box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.5);
}
</style>
