<x-layouts.app>
    <!-- Composant de protection des documents -->
    <x-document-protection 
        :enabled="true" 
        level="high" 
        :allowSelection="false" 
        :allowRightClick="false" 
        :allowKeyboardShortcuts="false" 
        :showWarnings="true" 
    />
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-zinc-900 dark:text-zinc-100 unified-protection unified-protection-high">
                    <!-- En-tête du document -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">
                                    {{ $document->titre }}
                                </h1>
                                <div class="flex items-center mt-2 space-x-4 text-sm text-zinc-600 dark:text-zinc-400">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ $document->type }}
                                    </span>
                                    <span>{{ __('Publié par') }} {{ $document->user->name }}</span>
                                    <span>{{ __('le') }} {{ $document->date_publication->format('d/m/Y à H:i') }}</span>
                                    <span>{{ __('Taille :') }} {{ $document->taille_formatee }}</span>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <a href="{{ route('dashboard') }}" class="inline-flex items-center px-3 py-2 border border-zinc-300 shadow-sm text-sm leading-4 font-medium rounded-md text-zinc-700 bg-white hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    {{ __('Retour') }}
                                </a>
                            </div>
                        </div>
                        
                        @if($document->description)
                        <div class="mt-4 p-4 bg-zinc-50 dark:bg-zinc-700 rounded-lg">
                            <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">{{ __('Description') }}</h3>
                            <p class="text-zinc-600 dark:text-zinc-400">{{ $document->description }}</p>
                        </div>
                        @endif
                    </div>

                    <!-- Aperçu du document -->
                    <div class="bg-white dark:bg-zinc-800 border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden unified-protection unified-protection-high">
                        <div class="px-4 py-3 border-b border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-zinc-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <span class="text-sm font-medium text-zinc-700 dark:text-zinc-300">{{ $document->fichier }}</span>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <span class="text-xs text-zinc-500 dark:text-zinc-400">{{ strtoupper($document->extension) }}</span>
                                    <span class="text-xs text-zinc-500 dark:text-zinc-400">{{ $document->taille_formatee }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-4">
                            @if(in_array(strtolower($document->extension), ['pdf']))
                                <!-- Aperçu PDF -->
                                <div class="w-full h-96 border border-zinc-200 dark:border-zinc-700 rounded-lg overflow-hidden unified-protection unified-protection-high">
                                    <iframe src="{{ Storage::disk('public')->url($document->chemin_fichier) }}#toolbar=0&navpanes=0&scrollbar=0" 
                                            class="w-full h-full" 
                                            frameborder="0"
                                            title="{{ $document->titre }}">
                                        <p>{{ __('Votre navigateur ne supporte pas l\'aperçu PDF.') }}</p>
                                    </iframe>
                                </div>
                            @elseif(in_array(strtolower($document->extension), ['txt']))
                                <!-- Aperçu texte -->
                                <div class="w-full max-h-96 overflow-y-auto bg-zinc-50 dark:bg-zinc-800 p-4 rounded-lg border border-zinc-200 dark:border-zinc-700 unified-protection unified-protection-high">
                                    <pre class="text-sm text-zinc-800 dark:text-zinc-200 whitespace-pre-wrap font-mono">{{ file_get_contents(Storage::disk('public')->path($document->chemin_fichier)) }}</pre>
                                </div>
                            @else
                                <!-- Aperçu non supporté -->
                                <div class="text-center py-12">
                                    <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ __('Aperçu non disponible') }}</h3>
                                    <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                                        {{ __('Ce type de fichier ne supporte pas l\'aperçu en ligne.') }}
                                    </p>
                                    <div class="mt-4">
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                            {{ __('Type de fichier :') }} {{ strtoupper($document->extension) }}
                                        </p>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                            {{ __('Taille :') }} {{ $document->taille_formatee }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Informations supplémentaires -->
                    <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-zinc-50 dark:bg-zinc-700 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">{{ __('Informations du document') }}</h3>
                            <dl class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <dt class="text-zinc-500 dark:text-zinc-400">{{ __('Type :') }}</dt>
                                    <dd class="text-zinc-900 dark:text-zinc-100">{{ $document->type }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-zinc-500 dark:text-zinc-400">{{ __('Format :') }}</dt>
                                    <dd class="text-zinc-900 dark:text-zinc-100">{{ strtoupper($document->extension) }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-zinc-500 dark:text-zinc-400">{{ __('Taille :') }}</dt>
                                    <dd class="text-zinc-900 dark:text-zinc-100">{{ $document->taille_formatee }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-zinc-500 dark:text-zinc-400">{{ __('Statut :') }}</dt>
                                    <dd class="text-zinc-900 dark:text-zinc-100">
                                        @if($document->est_public)
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                                {{ __('Public') }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                {{ __('Privé') }}
                                            </span>
                                        @endif
                                    </dd>
                                </div>
                            </dl>
                        </div>

                        <div class="bg-zinc-50 dark:bg-zinc-700 p-4 rounded-lg">
                            <h3 class="text-sm font-medium text-zinc-700 dark:text-zinc-300 mb-2">{{ __('Informations de publication') }}</h3>
                            <dl class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <dt class="text-zinc-500 dark:text-zinc-400">{{ __('Publié par :') }}</dt>
                                    <dd class="text-zinc-900 dark:text-zinc-100">{{ $document->user->name }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-zinc-500 dark:text-zinc-400">{{ __('Date de publication :') }}</dt>
                                    <dd class="text-zinc-900 dark:text-zinc-100">{{ $document->date_publication->format('d/m/Y à H:i') }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-zinc-500 dark:text-zinc-400">{{ __('Dernière modification :') }}</dt>
                                    <dd class="text-zinc-900 dark:text-zinc-100">{{ $document->updated_at->format('d/m/Y à H:i') }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Note importante -->
                    <div class="mt-6 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                    {{ __('Note importante') }}
                                </h3>
                                <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                                    <p>{{ __('Ce document est consultable en ligne pour lecture uniquement. Le téléchargement, la capture d\'écran et la prise de photo ne sont pas autorisés.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
