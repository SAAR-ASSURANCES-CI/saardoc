<x-layouts.app>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-900 dark:text-zinc-100">
                    <div class="flex items-center justify-between mb-6">
                        <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">
                            {{ __('Tableau de bord') }}
                        </h1>
                        @if(auth()->user()->canManageDocuments())
                        <a href="{{ route('documents.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            {{ __('Publier un document') }}
                        </a>
                        @endif
                    </div>

                    <!-- Barre de recherche -->
                    <div class="mb-6">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-5 w-5 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                            <input wire:model.live="search" type="text" class="block w-full pl-10 pr-3 py-2 border border-zinc-300 rounded-md leading-5 bg-white dark:bg-zinc-700 dark:border-zinc-600 dark:text-white placeholder-zinc-500 dark:placeholder-zinc-400 focus:outline-none focus:placeholder-zinc-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm" placeholder="{{ __('Rechercher un document...') }}">
                        </div>
                    </div>

                    <!-- Filtres par type -->
                    <div class="mb-6">
                        <div class="flex flex-wrap gap-2">
                            <button wire:click="filterByType('') class="px-3 py-1 text-sm rounded-full {{ $selectedType === '' ? 'bg-blue-600 text-white' : 'bg-zinc-200 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-300 dark:hover:bg-zinc-600' }}">
                                {{ __('Tous') }}
                            </button>
                            @foreach($documentTypes as $type)
                            <button wire:click="filterByType('{{ $type }}') class="px-3 py-1 text-sm rounded-full {{ $selectedType === $type ? 'bg-blue-600 text-white' : 'bg-zinc-200 dark:bg-zinc-700 text-zinc-700 dark:text-zinc-300 hover:bg-zinc-300 dark:hover:bg-zinc-600' }}">
                                {{ $type }}
                            </button>
                            @endforeach
                        </div>
                    </div>

                    <!-- Statistiques -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
                        @foreach($statsByType as $type => $count)
                        <div class="bg-zinc-50 dark:bg-zinc-700 p-4 rounded-lg">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                        <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4">
                                    <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400">{{ $type }}</p>
                                    <p class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">{{ $count }}</p>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Liste des documents -->
                    <div class="bg-white dark:bg-zinc-800 shadow overflow-hidden sm:rounded-md">
                        @if($documents->count() > 0)
                        <ul class="divide-y divide-zinc-200 dark:divide-zinc-700">
                            @foreach($documents as $document)
                            <li class="px-6 py-4 hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-colors duration-150">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="flex items-center">
                                                <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $document->titre }}</p>
                                                <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                    {{ $document->type }}
                                                </span>
                                            </div>
                                            <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400 mt-1">
                                                <span>{{ __('Publié par') }} {{ $document->user->name }}</span>
                                                <span class="mx-2">•</span>
                                                <span>{{ $document->date_publication->format('d/m/Y') }}</span>
                                                <span class="mx-2">•</span>
                                                <span>{{ $document->taille_formatee }}</span>
                                            </div>
                                            @if($document->description)
                                            <p class="text-sm text-zinc-600 dark:text-zinc-400 mt-1">{{ Str::limit($document->description, 100) }}</p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('documents.view', $document) }}" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-300 dark:bg-blue-900 dark:hover:bg-blue-800">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            {{ __('Consulter') }}
                                        </a>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                        @else
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ __('Aucun document trouvé') }}</h3>
                            <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                {{ $search ? 'Aucun document ne correspond à votre recherche.' : 'Commencez par publier votre premier document.' }}
                            </p>
                            @if(auth()->user()->canManageDocuments())
                            <div class="mt-6">
                                <a href="{{ route('documents.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    {{ __('Publier un document') }}
                                </a>
                            </div>
                            @endif
                        </div>
                        @endif
                    </div>

                    <!-- Pagination -->
                    @if($documents->hasPages())
                    <div class="mt-6">
                        {{ $documents->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
