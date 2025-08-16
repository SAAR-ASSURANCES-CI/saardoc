<div class="py-12 animate-in fade-in duration-500">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="card-hover">
            <div class="p-6 text-zinc-900 dark:text-zinc-100">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100 mb-2">
                            {{ __('Gestion des documents') }}
                        </h1>
                        <p class="text-zinc-600 dark:text-zinc-400">
                            {{ __('Gérez et organisez tous vos documents') }}
                        </p>
                    </div>
                    <a href="{{ route('documents.create') }}" class="btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        {{ __('Publier un document') }}
                    </a>
                </div>

                @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg dark:bg-green-900 dark:border-green-700 dark:text-green-300 animate-fade-in">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('success') }}
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg dark:bg-red-900 dark:border-red-700 dark:text-red-300 animate-fade-in">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        {{ session('error') }}
                    </div>
                </div>
                @endif

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
                                            @if(!$document->est_public)
                                            <span class="ml-2 badge badge-danger">
                                                {{ __('Privé') }}
                                            </span>
                                            @endif
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
                                                {{ $document->created_at->format('d/m/Y') }}
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
                            {{ __('Commencez par publier votre premier document.') }}
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('documents.create') }}" class="btn-primary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Publier un document') }}
                            </a>
                        </div>
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
