<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
    <div class="flex justify-between flex-1 sm:hidden">
        {{-- flex items-center justify-center px-3 h-8 text-sm font-medium text-gray-500 bg-white border border-gray-300
        rounded-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400
        dark:hover:bg-gray-700 dark:hover:text-white --}}
        @if ($paginator->onFirstPage())
        <span
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-light-300 bg-light-50 border border-light-300 rounded-md dark:bg-dark-800 dark:border-dark-700 dark:text-dark-600">
            {!! __('pagination.previous') !!}
        </span>
        @else
        <a href="{{ $paginator->previousPageUrl() }}"
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-dark-500 bg-light-50 border border-light-400 rounded-md hover:bg-light-100 hover:text-dark-700 dark:bg-dark-800 dark:border-dark-600 dark:text-dark-300 dark:hover:bg-dark-700 dark:hover:text-light-50">
            {!! __('pagination.previous') !!}
        </a>
        @endif

        @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}"
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-dark-500 bg-light-50 border border-light-400 rounded-md hover:bg-light-100 hover:text-dark-700 dark:bg-dark-800 dark:border-dark-600 dark:text-dark-300 dark:hover:bg-dark-700 dark:hover:text-light-50">
            {!! __('pagination.next') !!}
        </a>
        @else
        <span
            class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-light-300 bg-light-50 border border-light-300 rounded-md dark:bg-dark-800 dark:border-dark-700 dark:text-dark-600">
            {!! __('pagination.next') !!}
        </span>
        @endif
    </div>

    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-dark-700 dark:text-dark-400 leading-5">
                {!! __('Showing') !!}
                @if ($paginator->firstItem())
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                {!! __('to') !!}
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                @else
                {{ $paginator->count() }}
                @endif
                {!! __('of') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('results') !!}
            </p>
        </div>

        <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-md">
                {{-- Previous Page Link --}}
                @if ($paginator->onFirstPage())
                <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                    <span
                        class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-light-300 dark bg-light-50 border border-light-300 dark:bg-dark-800 dark:border-dark-700 dark:text-dark-600 cursor-default rounded-l-md leading-5"
                        aria-hidden="true">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
                @else
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev"
                    class="relative inline-flex items-center px-2 py-2 text-sm font-medium rounded-l-md leading-5 text-dark-500 bg-light-50 border border-light-400 hover:bg-light-100 hover:text-dark-700 dark:bg-dark-800 dark:border-dark-600 dark:text-dark-300 dark:hover:bg-dark-700 dark:hover:text-light-50"
                    aria-label="{{ __('pagination.previous') }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                <span aria-disabled="true">
                    <span
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-dark-500 bg-light-50 border border-light-400 hover:bg-light-100 hover:text-dark-700 dark:bg-dark-800 dark:border-dark-600 dark:text-dark-300 dark:hover:bg-dark-700 dark:hover:text-light-50 cursor-default leading-5">{{
                        $element }}</span>
                </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                @foreach ($element as $page => $url)
                @if ($page == $paginator->currentPage())
                <span aria-current="page">
                    <span
                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-light-50 bg-primary-600 border border-primary-600 cursor-default leading-5">{{
                        $page }}</span>
                </span>
                @else
                <a href="{{ $url }}"
                    class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium leading-5 text-dark-500 bg-light-50 border border-light-400 hover:bg-light-100 hover:text-dark-700 dark:bg-dark-800 dark:border-dark-600 dark:text-dark-300 dark:hover:bg-dark-700 dark:hover:text-light-50"
                    aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                    {{ $page }}
                </a>
                @endif
                @endforeach
                @endif
                @endforeach

                {{-- Next Page Link --}}
                @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" rel="next"
                    class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium rounded-r-md leading-5 text-dark-500 bg-light-50 border border-light-400 hover:bg-light-100 hover:text-dark-700 dark:bg-dark-800 dark:border-dark-600 dark:text-dark-300 dark:hover:bg-dark-700 dark:hover:text-light-50"
                    aria-label="{{ __('pagination.next') }}">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd" />
                    </svg>
                </a>
                @else
                <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                    <span
                        class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-light-300 dark bg-light-50 border border-light-300 dark:bg-dark-800 dark:border-dark-700 dark:text-dark-600 cursor-default rounded-r-md leading-5"
                        aria-hidden="true">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                    </span>
                </span>
                @endif
            </span>
        </div>
    </div>
</nav>