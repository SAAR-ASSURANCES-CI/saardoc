@if ($paginator->hasPages())
    <nav class="pagination-container" role="navigation" aria-label="{{ __('Pagination Navigation') }}">
        <div class="flex items-center justify-between">
            <div class="flex justify-between flex-1 sm:hidden">
                {{-- Pagination Mobile --}}
                @if ($paginator->onFirstPage())
                    <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-500 bg-white border border-zinc-300 cursor-default dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-400 rounded-md">
                        {{ __('Précédent') }}
                    </span>
                @else
                    <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-md hover:bg-zinc-50 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-600 transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:shadow-lg">
                        {{ __('Précédent') }}
                    </a>
                @endif

                @if ($paginator->hasMorePages())
                    <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-zinc-700 bg-white border border-zinc-300 rounded-md hover:bg-zinc-50 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-600 transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:shadow-lg">
                        {{ __('Suivant') }}
                    </a>
                @else
                    <span class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-zinc-500 bg-white border border-zinc-300 cursor-default dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-400 rounded-md">
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
                    <span class="relative z-0 inline-flex shadow-sm rounded-md">
                        {{-- Lien Précédent --}}
                        @if ($paginator->onFirstPage())
                            <span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
                                <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-zinc-500 bg-white border border-zinc-300 cursor-default dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-400 rounded-l-md" aria-hidden="true">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </span>
                        @else
                            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-zinc-500 bg-white border border-zinc-300 rounded-l-md hover:bg-zinc-50 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-600 transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:shadow-lg" aria-label="{{ __('pagination.previous') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @endif

                        {{-- Liens des pages --}}
                        @foreach ($elements as $element)
                            {{-- "Three Dots" Separator --}}
                            @if (is_string($element))
                                <span aria-disabled="true">
                                    <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-zinc-700 bg-white border border-zinc-300 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-300">{{ $element }}</span>
                                </span>
                            @endif

                            {{-- Array Of Links --}}
                            @if (is_array($element))
                                @foreach ($element as $page => $url)
                                    @if ($page == $paginator->currentPage())
                                        <span aria-current="page">
                                            <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-white bg-blue-600 border border-blue-600 cursor-default dark:bg-blue-600 dark:border-blue-600">{{ $page }}</span>
                                        </span>
                                    @else
                                        <a href="{{ $url }}" class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-zinc-700 bg-white border border-zinc-300 hover:bg-zinc-50 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-600 transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:shadow-lg" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                            {{ $page }}
                                        </a>
                                    @endif
                                @endforeach
                            @endif
                        @endforeach

                        {{-- Lien Suivant --}}
                        @if ($paginator->hasMorePages())
                            <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-zinc-500 bg-white border border-zinc-300 rounded-r-md hover:bg-zinc-50 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-600 transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:shadow-lg" aria-label="{{ __('pagination.next') }}">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        @else
                            <span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
                                <span class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-zinc-500 bg-white border border-zinc-300 cursor-default dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-400 rounded-r-md" aria-hidden="true">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                            </span>
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </nav>
@endif
