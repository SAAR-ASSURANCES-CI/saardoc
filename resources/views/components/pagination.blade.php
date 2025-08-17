@if ($paginator->hasPages())
<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
    <div class="flex justify-between flex-1 sm:hidden">
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 cursor-default rounded-lg">
                {{ __('Précédent') }}
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-700 bg-white dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-600 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-md">
                {{ __('Précédent') }}
            </a>
        @endif

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-zinc-700 bg-white dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 rounded-lg hover:bg-zinc-50 dark:hover:bg-zinc-600 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-md">
                {{ __('Suivant') }}
            </a>
        @else
            <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 cursor-default rounded-lg">
                {{ __('Suivant') }}
            </span>
        @endif
    </div>

    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
        <div>
            <p class="text-sm text-zinc-700 dark:text-zinc-300">
                {!! __('Affichage de') !!}
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                {!! __('à') !!}
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                {!! __('sur') !!}
                <span class="font-medium">{{ $paginator->total() }}</span>
                {!! __('résultats') !!}
            </p>
        </div>

        <div>
            <span class="relative z-0 inline-flex shadow-sm rounded-lg">
                @if ($paginator->onFirstPage())
                    <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                        <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 cursor-default rounded-l-lg" aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 rounded-l-lg hover:bg-zinc-50 dark:hover:bg-zinc-600 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-md" aria-label="{{ __('pagination.previous') }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif

                @foreach ($elements as $element)
                    @if (is_string($element))
                        <span aria-disabled="true">
                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-zinc-700 bg-white dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 cursor-default">{{ $element }}</span>
                        </span>
                    @endif

                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <span aria-current="page">
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-gradient-to-r from-blue-600 to-blue-700 border border-blue-600 cursor-default z-10 shadow-lg">{{ $page }}</span>
                                </span>
                            @else
                                <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-zinc-700 bg-white dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 hover:bg-zinc-50 dark:hover:bg-zinc-600 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-md" aria-label="{{ __('Aller à la page :page', ['page' => $page]) }}">
                                    {{ $page }}
                                </a>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 rounded-r-lg hover:bg-zinc-50 dark:hover:bg-zinc-600 focus:z-10 focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-300 ease-in-out hover:-translate-y-1 hover:shadow-md" aria-label="{{ __('pagination.next') }}">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @else
                    <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                        <span class="relative inline-flex items-center px-3 py-2 -ml-px text-sm font-medium text-zinc-500 bg-white dark:bg-zinc-700 border border-zinc-300 dark:border-zinc-600 cursor-default rounded-r-lg" aria-hidden="true">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                            </svg>
                        </span>
                    </span>
                @endif
            </span>
        </div>
    </div>
</nav>
@endif
