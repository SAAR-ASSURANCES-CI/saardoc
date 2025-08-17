<x-layouts.app>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-indigo-900 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            
            <!-- Header Section avec animations spectaculaires -->
            <div class="text-center mb-12 animate-fade-in-up">
                <div class="relative">
                    <!-- Cercles décoratifs animés -->
                    <div class="absolute -top-4 -left-4 w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full animate-pulse"></div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-pink-400 to-red-500 rounded-full animate-bounce"></div>
                    
                    <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-slate-900 via-blue-800 to-indigo-900 dark:from-white dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent animate-slide-in-bottom">
                        {{ __('Bonjour,') }} {{ auth()->user()->name }} !
                    </h1>
                    
                    <div class="mt-4 text-xl text-slate-600 dark:text-slate-300 animate-fade-in" style="animation-delay: 0.3s;">
                        {{ __('Bienvenue sur votre tableau de bord') }}
                    </div>
                    
                    <!-- Ligne décorative animée -->
                    <div class="mt-6 flex justify-center">
                        <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full animate-scale-in"></div>
                    </div>
                </div>
            </div>

            <!-- Bouton principal avec animations spectaculaires -->
            @if(auth()->user()->canManageDocuments())
            <div class="flex justify-center mb-12 animate-bounce-in" style="animation-delay: 0.5s;">
                <a href="{{ route('documents.create') }}" 
                   class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 hover:from-blue-700 hover:via-purple-700 hover:to-indigo-700 text-white font-bold text-lg rounded-2xl shadow-2xl hover:shadow-blue-500/50 transform transition-all duration-500 ease-out hover:scale-110 hover:-translate-y-2 active:scale-95">
                    
                    <!-- Effet de brillance au survol -->
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out"></div>
                    
                    <!-- Icône animée -->
                    <svg class="w-6 h-6 mr-3 transform group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    
                    {{ __('Publier un document') }}
                    
                    <!-- Particules décoratives -->
                    <div class="absolute -top-2 -right-2 w-4 h-4 bg-yellow-400 rounded-full animate-ping"></div>
                </a>
            </div>
            @endif

            <!-- Barre de recherche magnifique -->
            <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.7s;">
                <div class="relative max-w-2xl mx-auto">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <div class="w-6 h-6 text-slate-400 group-focus-within:text-blue-500 transition-colors duration-300">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                    
                    <input wire:model.live="search" 
                           type="text" 
                           class="block w-full pl-12 pr-4 py-4 bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm border-2 border-slate-200 dark:border-slate-700 rounded-2xl text-lg placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-blue-500/30 focus:border-blue-500 transition-all duration-300 hover:bg-white dark:hover:bg-slate-800 hover:shadow-xl focus:shadow-2xl" 
                           placeholder="{{ __('Rechercher dans vos documents...') }}">
                    
                    <!-- Effet de focus -->
                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-500/0 via-purple-500/0 to-indigo-500/0 focus-within:from-blue-500/10 focus-within:via-purple-500/10 focus-within:to-indigo-500/10 transition-all duration-500 pointer-events-none"></div>
                </div>
            </div>

            <!-- Filtres avec design moderne -->
            <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.9s;">
                <div class="flex flex-wrap justify-center gap-3">
                    <button wire:click="filterByType('') 
                            class="group px-6 py-3 text-sm font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 {{ $selectedType === '' ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg shadow-blue-500/50' : 'bg-white/80 dark:bg-slate-800/80 text-slate-700 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-800 hover:shadow-lg' }}">
                        <span class="relative z-10">{{ __('Tous') }}</span>
                        @if($selectedType === '')
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-500 rounded-xl opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        @endif
                    </button>
                    
                    @foreach($documentTypes as $type)
                    <button wire:click="filterByType('{{ $type }}') 
                            class="group px-6 py-3 text-sm font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 {{ $selectedType === $type ? 'bg-gradient-to-r from-blue-600 to-purple-600 text-white shadow-lg shadow-blue-500/50' : 'bg-white/80 dark:bg-slate-800/80 text-slate-700 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-800 hover:shadow-lg' }}">
                        <span class="relative z-10">{{ $type }}</span>
                        @if($selectedType === $type)
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-purple-500 rounded-xl opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                        @endif
                    </button>
                    @endforeach
                </div>
            </div>

            <!-- Statistiques avec design premium -->
            <div class="mb-12 animate-fade-in-up" style="animation-delay: 1.1s;">
                <h2 class="text-2xl font-bold text-center text-slate-900 dark:text-white mb-8">
                    {{ __('Répartition par type de documents') }}
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($statsByType as $type => $count)
                    <div class="stat-card-premium animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s;">
                        <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-3xl shadow-xl border border-white/20 dark:border-slate-700/20 p-6 hover:shadow-2xl transition-all duration-300 hover:scale-105 hover:-translate-y-2">
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="ml-4 flex-1">
                                    <p class="text-sm font-medium text-slate-600 dark:text-slate-400 mb-1">{{ $type }}</p>
                                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2 mb-2">
                                        <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-2 rounded-full transition-all duration-500" style="width: {{ $count > 0 ? '100%' : '0%' }}"></div>
                                    </div>
                                    <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $count }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Liste des documents avec design premium -->
            <div class="animate-fade-in-up" style="animation-delay: 1.3s;">
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 dark:border-slate-700/20 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-slate-900 dark:text-white">
                                {{ __('Documents récents') }}
                            </h2>
                            <span class="text-sm text-slate-600 dark:text-slate-400">
                                {{ $documents->count() }} {{ __('document(s) trouvé(s)') }}
                            </span>
                        </div>

                        @if($documents->count() > 0)
                        <div class="space-y-4">
                            @foreach($documents as $document)
                            <div class="document-card-premium animate-fade-in-up" 
                                 style="animation-delay: {{ $loop->index * 0.05 }}s;">
                                <div class="bg-white/60 dark:bg-slate-700/60 backdrop-blur-sm rounded-2xl p-6 border border-white/30 dark:border-slate-600/30 hover:bg-white/80 dark:hover:bg-slate-700/80 transition-all duration-300 hover:scale-102 hover:-translate-y-1 hover:shadow-lg">
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center flex-1">
                                            <div class="flex-shrink-0">
                                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                                                    <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="ml-4 flex-1">
                                                <div class="flex items-center mb-2">
                                                    <h3 class="text-lg font-semibold text-slate-900 dark:text-white">{{ $document->titre }}</h3>
                                                    <span class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 dark:from-blue-900 dark:to-purple-900 dark:text-blue-200">
                                                        {{ $document->type }}
                                                    </span>
                                                </div>
                                                <div class="flex items-center text-sm text-slate-600 dark:text-slate-400 mb-2">
                                                    <div class="w-8 h-8 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center mr-2">
                                                        <span class="text-xs font-bold text-white">{{ substr($document->user->name, 0, 1) }}</span>
                                                    </div>
                                                    <span>{{ __('Publié par') }} {{ $document->user->name }}</span>
                                                    <span class="mx-2">•</span>
                                                    <span>{{ $document->date_publication->format('d/m/Y') }}</span>
                                                    <span class="mx-2">•</span>
                                                    <span>{{ $document->taille_formatee }}</span>
                                                </div>
                                                @if($document->description)
                                                <p class="text-sm text-slate-600 dark:text-slate-400">{{ Str::limit($document->description, 100) }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-3">
                                            <a href="{{ route('documents.view', $document) }}" 
                                               class="group inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white rounded-2xl shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-indigo-500/30 transition-all duration-300 hover:scale-110 hover:-translate-y-1 active:scale-95">
                                                
                                                <!-- Effet de brillance -->
                                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out rounded-2xl"></div>
                                                
                                                <svg class="w-6 h-6 relative z-10 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="text-center py-20">
                            <div class="mb-8">
                                <div class="w-24 h-24 bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-600 dark:to-slate-700 rounded-full flex items-center justify-center mx-auto mb-6 animate-pulse">
                                    <svg class="w-12 h-12 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">
                                    {{ $search ? __('Aucun document trouvé') : __('Aucun document') }}
                                </h3>
                                <p class="text-slate-600 dark:text-slate-400 text-lg">
                                    {{ $search ? __('Aucun document ne correspond à votre recherche.') : __('Commencez par publier votre premier document.') }}
                                </p>
                            </div>
                            
                            @if(auth()->user()->canManageDocuments())
                            <a href="{{ route('documents.create') }}" 
                               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold text-lg rounded-2xl shadow-xl hover:shadow-2xl transform transition-all duration-300 hover:scale-105 hover:-translate-y-1 active:scale-95">
                                <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Publier un document') }}
                            </a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Pagination avec design moderne -->
            @if($documents->hasPages())
            <div class="mt-12 animate-fade-in-up" style="animation-delay: 1.5s;">
                <div class="flex justify-center">
                    {{ $documents->links() }}
                </div>
            </div>
            @endif
        </div>
    </div>
</x-layouts.app>
