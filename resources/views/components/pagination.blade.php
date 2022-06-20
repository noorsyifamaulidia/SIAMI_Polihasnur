<nav class="d-flex justify-items-center justify-content-between">
  <div class="d-flex justify-content-between flex-fill d-sm-none">
      <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
          <li class="page-item disabled" aria-disabled="true">
              <span class="page-link">@lang('pagination.previous')</span>
          </li>
        @else
          <li class="page-item">
              <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">@lang('pagination.previous')</a>
          </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
          <li class="page-item">
              <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">@lang('pagination.next')</a>
          </li>
        @else
          <li class="page-item disabled" aria-disabled="true">
              <span class="page-link">@lang('pagination.next')</span>
          </li>
        @endif
      </ul>
  </div>

  <div class="d-none flex-sm-fill d-sm-flex align-items-sm-center justify-content-sm-between">
      <div>
          <p class="small text-muted">
              Showing
              <span class="font-medium">{{ $paginator->currentPage() }}</span>
              to
              <span class="font-medium">{{ $paginator->perPage() }}</span>
              of
              <span class="font-medium">{{ $paginator->total() }}</span>
              results
          </p>
      </div>

      <div>
        {{ $paginator->links() }}
      </div>
  </div>
</nav>