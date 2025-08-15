<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-zinc-900 dark:text-zinc-100">
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">
                        {{ __('Publier un nouveau document') }}
                    </h1>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                        {{ __('Remplissez le formulaire ci-dessous pour publier un nouveau document.') }}
                    </p>
                </div>

                <form wire:submit="store" class="space-y-6">
                    <!-- Titre -->
                    <div>
                        <label for="titre" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ __('Titre du document') }} <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="titre" type="text" id="titre" class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm" placeholder="{{ __('Entrez le titre du document') }}">
                        @error('titre') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Type -->
                    <div>
                        <label for="type" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ __('Type de document') }} <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="type" id="type" class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm">
                            <option value="">{{ __('Sélectionnez un type') }}</option>
                            <option value="Notes de service">{{ __('Notes de service') }}</option>
                            <option value="Guides">{{ __('Guides') }}</option>
                            <option value="Manuels de procédures">{{ __('Manuels de procédures') }}</option>
                            <option value="Textes réglementaires et législatifs">{{ __('Textes réglementaires et législatifs') }}</option>
                            <option value="Tarifs">{{ __('Tarifs') }}</option>
                            <option value="Supports de formation">{{ __('Supports de formation') }}</option>
                            <option value="Organigrammes et répertoire interne">{{ __('Organigrammes et répertoire interne') }}</option>
                            <option value="Politiques et chartes internes">{{ __('Politiques et chartes internes') }}</option>
                        </select>
                        @error('type') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ __('Description') }}
                        </label>
                        <textarea wire:model="description" id="description" rows="4" class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm" placeholder="{{ __('Entrez une description du document (optionnel)') }}"></textarea>
                        @error('description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Fichier -->
                    <div>
                        <label for="fichier" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ __('Fichier') }} <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-zinc-300 border-dashed rounded-md dark:border-zinc-600">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-zinc-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-zinc-600 dark:text-zinc-400">
                                    <label for="fichier" class="relative cursor-pointer bg-white dark:bg-zinc-700 rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>{{ __('Télécharger un fichier') }}</span>
                                        <input wire:model="fichier" id="fichier" type="file" class="sr-only" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt">
                                    </label>
                                    <p class="pl-1">{{ __('ou glisser-déposer') }}</p>
                                </div>
                                <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                    {{ __('PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT jusqu\'à 10MB') }}
                                </p>
                            </div>
                        </div>
                        @if($fichier)
                        <div class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                            {{ __('Fichier sélectionné :') }} {{ $fichier->getClientOriginalName() }}
                        </div>
                        @endif
                        @error('fichier') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Boutons -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('documents.index') }}" class="inline-flex items-center px-4 py-2 border border-zinc-300 shadow-sm text-sm font-medium rounded-md text-zinc-700 bg-white hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-600">
                            {{ __('Annuler') }}
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            {{ __('Publier le document') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
