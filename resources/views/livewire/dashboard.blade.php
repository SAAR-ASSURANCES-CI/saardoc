<div class="py-12 animate-in fade-in duration-500">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.1s">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                <div class="space-y-2">
                    <h1 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100">
                        {{ __('Bonjour') }}, {{ auth()->user()->name }}!
                    </h1>
                    <p class="text-lg text-zinc-600 dark:text-zinc-400 max-w-2xl">
                        {{ __('Explorez les informations et l\'activité de vos documents') }}
                    </p>
                </div>
                
                <div class="flex items-center space-x-4">
                    <div class="search-container">
                        <div class="search-icon">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <input 
                            wire:model.live="search" 
                            type="text" 
                            class="search-input" 
                            placeholder="{{ __('Rechercher...') }}"
                        >
                    </div>
                    
                    <div class="relative">
                        <select 
                            wire:model.live="selectedType" 
                            class="filter-dropdown"
                        >
                            <option value="">{{ __('Tous les types') }}</option>
                            @foreach($documentTypes as $type)
                            <option value="{{ $type }}">{{ $type }}</option>
                            @endforeach
                        </select>
                        <div class="dropdown-arrow">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </div>
                    
                    @if(auth()->user()->canManageDocuments())
                    <a href="{{ route('documents.create') }}" class="btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        {{ __('Publier') }}
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="mb-12 animate-fade-in-up" style="animation-delay: 0.2s">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stat-card-modern">
                    <div class="stat-content">
                        <div class="stat-header">
                            <h3 class="stat-title">{{ __('Documents ce mois') }}</h3>
                            <div class="stat-icon bg-blue-100 dark:bg-blue-900">
                                <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value">{{ $documents->where('date_publication', '>=', now()->startOfMonth())->count() }}</div>
                        <div class="stat-chart">
                            <div class="mini-bar-chart">
                                @for($i = 0; $i < 6; $i++)
                                <div class="bar" style="height: {{ rand(20, 80) }}%"></div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card-modern">
                    <div class="stat-content">
                        <div class="stat-header">
                            <h3 class="stat-title">{{ __('Nouveaux utilisateurs') }}</h3>
                            <div class="stat-icon bg-green-100 dark:bg-green-900">
                                <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value">{{ \App\Models\User::where('created_at', '>=', now()->startOfMonth())->count() }}</div>
                        <div class="stat-chart">
                            <div class="mini-line-chart">
                                <svg class="w-full h-8" viewBox="0 0 100 32">
                                    <path d="M0,24 Q25,20 50,16 T100,8" stroke="currentColor" stroke-width="2" fill="none" class="line-path"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card-modern">
                    <div class="stat-content">
                        <div class="stat-header">
                            <h3 class="stat-title">{{ __('Espace utilisé') }}</h3>
                            <div class="stat-icon bg-amber-100 dark:bg-amber-900">
                                <svg class="w-6 h-6 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value">{{ number_format($documents->sum('taille') / 1024 / 1024, 1) }} MB</div>
                        <div class="stat-chart">
                            <div class="mini-bar-chart">
                                @for($i = 0; $i < 4; $i++)
                                <div class="bar" style="height: {{ rand(30, 90) }}%"></div>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stat-card-modern stat-card-accent">
                    <div class="stat-content">
                        <div class="stat-header">
                            <h3 class="stat-title text-white">{{ __('Activité') }}</h3>
                            <div class="stat-icon bg-white/20">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="stat-value text-white">{{ $documents->where('date_publication', '>=', now()->subDays(7))->count() }}</div>
                        <div class="stat-chart">
                            <div class="mini-line-chart">
                                <svg class="w-full h-8" viewBox="0 0 100 32">
                                    <path d="M0,20 Q25,16 50,12 T100,8" stroke="white" stroke-width="2" fill="none" class="line-path"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="animate-fade-in-up" style="animation-delay: 0.3s">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-2xl font-bold text-zinc-900 dark:text-zinc-100">
                    {{ __('Documents récents') }}
                </h2>
                <div class="text-sm text-zinc-500 dark:text-zinc-400">
                    {{ $documents->total() }} {{ __('document(s) trouvé(s)') }}
                </div>
            </div>

            @if($documents->count() > 0)
            @include('components.export-buttons')
            
            <div class="table-container-modern">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-zinc-200/50 dark:divide-zinc-700/50" id="documents-table">
                        <thead class="bg-zinc-50/50 dark:bg-zinc-700/50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    {{ __('Document') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    {{ __('Type') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    {{ __('Auteur') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    {{ __('Date') }}
                                </th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    {{ __('Taille') }}
                                </th>
                                <th class="px-6 py-4 text-right text-xs font-medium text-zinc-500 dark:text-zinc-400 uppercase tracking-wider">
                                    {{ __('Actions') }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-transparent divide-y divide-zinc-200/50 dark:divide-zinc-700/50">
                            @foreach($documents as $document)
                            <tr class="table-row-modern animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.05 }}s">
                                <td class="px-6 py-5">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <div class="w-10 h-10 bg-gradient-to-br from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800 rounded-xl flex items-center justify-center shadow-md">
                                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-zinc-900 dark:text-zinc-100">
                                                {{ $document->titre }}
                                            </div>
                                            @if($document->description)
                                            <div class="text-sm text-zinc-500 dark:text-zinc-400 max-w-xs truncate">
                                                {{ Str::limit($document->description, 80) }}
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="badge badge-primary">
                                        {{ $document->type }}
                                    </span>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center text-sm text-zinc-900 dark:text-zinc-100">
                                        <div class="w-8 h-8 bg-gradient-to-br from-zinc-100 to-zinc-200 dark:from-zinc-700 dark:to-zinc-600 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-xs font-medium text-zinc-600 dark:text-zinc-400">
                                                {{ strtoupper(substr($document->user->name, 0, 1)) }}
                                            </span>
                                        </div>
                                        {{ $document->user->name }}
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-sm text-zinc-900 dark:text-zinc-100">
                                        {{ $document->date_publication->format('d/m/Y') }}
                                    </div>
                                    <div class="text-xs text-zinc-500 dark:text-zinc-400">
                                        {{ $document->date_publication->diffForHumans() }}
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-sm text-zinc-900 dark:text-zinc-100">
                                        {{ $document->taille_formatee }}
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-right">
                                    <a 
                                        href="{{ route('documents.view', $document) }}" 
                                        class="btn-consult"
                                        title="{{ __('Consulter le document') }}"
                                    >
                                        <svg class="w-5 h-5 transition-transform duration-300 hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @else
            <div class="empty-state">
                <div class="empty-state-icon">
                    <svg class="mx-auto h-20 w-20 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="empty-state-title">{{ __('Aucun document trouvé') }}</h3>
                <p class="empty-state-description">
                    {{ $search ? 'Aucun document ne correspond à votre recherche.' : 'Commencez par publier votre premier document.' }}
                </p>
                @if(auth()->user()->canManageDocuments())
                <div class="mt-8">
                    <a href="{{ route('documents.create') }}" class="btn-primary">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        {{ __('Publier un document') }}
                    </a>
                </div>
                @endif
            </div>
            @endif
        </div>

        @if($documents->hasPages())
        <div class="pagination-container animate-fade-in-up" style="animation-delay: 0.4s">
            {{ $documents->links() }}
        </div>
        @endif
    </div>
</div>
