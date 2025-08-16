<div class="py-12 animate-in fade-in duration-500">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="card-hover">
            <div class="p-6 text-zinc-900 dark:text-zinc-100">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100 mb-2">
                            {{ __('Tableau de bord') }}
                        </h1>
                        <p class="text-zinc-600 dark:text-zinc-400">
                            {{ __('Bienvenue sur votre espace de gestion de documents') }}
                        </p>
                    </div>
                    @if(auth()->user()->canManageDocuments())
                    <a href="{{ route('documents.create') }}" class="btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        {{ __('Publier un document') }}
                    </a>
                    @endif
                </div>

                <!-- Barre de recherche améliorée -->
                <div class="mb-8">
                    <div class="search-container">
                        <div class="search-icon">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input wire:model.live="search" type="text" class="search-input" placeholder="{{ __('Rechercher un document...') }}">
                        @if($search)
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <button wire:click="$set('search', '')" class="text-zinc-400 hover:text-zinc-600 dark:hover:text-zinc-300 transition-colors duration-150">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Filtres par type améliorés -->
                <div class="mb-8">
                    <div class="filter-tabs">
                        <button wire:click="filterByType('')" class="filter-tab {{ $selectedType === '' ? 'active' : 'inactive' }}">
                            {{ __('Tous') }}
                        </button>
                        @foreach($documentTypes as $type)
                        <button wire:click="filterByType('{{ $type }}')" class="filter-tab {{ $selectedType === $type ? 'active' : 'inactive' }}">
                            {{ $type }}
                        </button>
                        @endforeach
                    </div>
                </div>

                <!-- Statistiques améliorées -->
                <div class="responsive-grid mb-8">
                    @foreach($statsByType as $type => $count)
                    <div class="card-hover p-6 animate-in zoom-in-95 duration-300" style="animation-delay: {{ $loop->index * 0.1 }}s">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center shadow-lg">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-zinc-600 dark:text-zinc-400 mb-1">{{ $type }}</p>
                                <p class="text-3xl font-bold text-zinc-900 dark:text-zinc-100">{{ $count }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Liste des documents améliorée -->
                <div class="table-container">
                    @if($documents->count() > 0)
                    <ul class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @foreach($documents as $document)
                        <li class="table-row px-6 py-5 animate-in fade-in duration-300" style="animation-delay: {{ $loop->index * 0.05 }}s">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center flex-1">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center shadow-md">
                                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center mb-2">
                                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">{{ $document->titre }}</h3>
                                            <span class="ml-3 badge badge-primary">
                                                {{ $document->type }}
                                            </span>
                                        </div>
                                        <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400 mb-2">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                                </svg>
                                                {{ $document->user->name }}
                                            </span>
                                            <span class="mx-3">•</span>
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-8 0h8m-8 0H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-1"></path>
                                                </svg>
                                                {{ $document->date_publication->format('d/m/Y') }}
                                            </span>
                                            <span class="mx-3">•</span>
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                {{ $document->taille_formatee }}
                                            </span>
                                        </div>
                                        @if($document->description)
                                        <p class="text-sm text-zinc-600 dark:text-zinc-400">{{ Str::limit($document->description, 120) }}</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3 ml-6">
                                                                            <a href="{{ route('documents.view', $document) }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-300 dark:bg-blue-900 dark:hover:bg-blue-800 transition-all duration-300 ease-in-out hover:-translate-y-0.5 hover:shadow-lg">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <svg class="mx-auto h-16 w-16 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="empty-state-title">{{ __('Aucun document trouvé') }}</h3>
                        <p class="empty-state-description">
                            {{ $search ? 'Aucun document ne correspond à votre recherche.' : 'Commencez par publier votre premier document.' }}
                        </p>
                        @if(auth()->user()->canManageDocuments())
                        <div class="mt-6">
                            <a href="{{ route('documents.create') }}" class="btn-primary">
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

                <!-- Pagination améliorée -->
                @if($documents->hasPages())
                <div class="pagination-container">
                    {{ $documents->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
