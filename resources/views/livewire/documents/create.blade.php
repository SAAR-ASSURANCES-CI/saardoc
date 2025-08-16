<div class="py-12 animate-in fade-in duration-500">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="card-hover">
            <div class="p-8 text-zinc-900 dark:text-zinc-100">
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100 mb-3">
                        {{ __('Publier un nouveau document') }}
                    </h1>
                    <p class="text-zinc-600 dark:text-zinc-400 text-lg">
                        {{ __('Remplissez le formulaire ci-dessous pour publier un nouveau document.') }}
                    </p>
                </div>

                <form wire:submit="store" class="space-y-8">
                    <!-- Titre -->
                    <div class="form-group">
                        <label for="titre" class="form-label">
                            {{ __('Titre du document') }} <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="titre" type="text" id="titre" class="form-input" placeholder="{{ __('Entrez le titre du document') }}">
                        @error('titre') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <!-- Type -->
                    <div class="form-group">
                        <label for="type" class="form-label">
                            {{ __('Type de document') }} <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="type" id="type" class="form-input">
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
                        @error('type') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <!-- Description -->
                    <div class="form-group">
                        <label for="description" class="form-label">
                            {{ __('Description') }}
                        </label>
                        <textarea wire:model="description" id="description" rows="4" class="form-input" placeholder="{{ __('Entrez une description du document (optionnel)') }}"></textarea>
                        @error('description') <span class="form-error">{{ $message }}</span> @enderror
                    </div>

                    <!-- Fichier avec zone de dépôt améliorée -->
                    <div class="form-group">
                        <label for="fichier" class="form-label">
                            {{ __('Fichier') }} <span class="text-red-500">*</span>
                        </label>
                        
                        <div class="mt-3">
                            <div class="file-drop-zone {{ $fichier ? 'has-file' : '' }}" 
                                 x-data="{ 
                                     isDragOver: false,
                                     handleDragOver(e) { e.preventDefault(); this.isDragOver = true; },
                                     handleDragLeave(e) { e.preventDefault(); this.isDragOver = false; },
                                     handleDrop(e) { 
                                         e.preventDefault(); 
                                         this.isDragOver = false; 
                                         if (e.dataTransfer.files.length > 0) {
                                             $wire.upload('fichier', e.dataTransfer.files[0]);
                                         }
                                     }
                                 }"
                                 @dragover="handleDragOver($event)"
                                 @dragleave="handleDragLeave($event)"
                                 @drop="handleDrop($event)"
                                 :class="{ 'drag-over': isDragOver }">
                                
                                <div class="space-y-4 text-center">
                                    @if($fichier)
                                        <!-- Prévisualisation du fichier sélectionné -->
                                        <div class="animate-in zoom-in-95 duration-300">
                                            <div class="mx-auto w-16 h-16 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center mb-4">
                                                <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                            </div>
                                            <div class="text-sm text-zinc-600 dark:text-zinc-400">
                                                <p class="font-medium text-zinc-900 dark:text-zinc-100 mb-1">{{ $fichier->getClientOriginalName() }}</p>
                                                <p class="text-xs">{{ __('Fichier sélectionné avec succès') }}</p>
                                            </div>
                                            <button type="button" wire:click="$set('fichier', null)" class="mt-3 text-sm text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 transition-colors duration-150">
                                                {{ __('Changer de fichier') }}
                                            </button>
                                        </div>
                                    @else
                                        <!-- Zone de dépôt vide -->
                                        <svg class="mx-auto h-16 w-16 text-zinc-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex flex-col text-sm text-zinc-600 dark:text-zinc-400">
                                            <label for="fichier" class="relative cursor-pointer bg-white dark:bg-zinc-700 rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500 transition-colors duration-150">
                                                <span class="text-lg">{{ __('Télécharger un fichier') }}</span>
                                                <input wire:model="fichier" id="fichier" type="file" class="sr-only" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt">
                                            </label>
                                            <p class="mt-2">{{ __('ou glisser-déposer ici') }}</p>
                                        </div>
                                        <p class="text-xs text-zinc-500 dark:text-zinc-400">
                                            {{ __('PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT jusqu\'à 10MB') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        
                        @error('fichier') <span class="form-error mt-2 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Boutons d'action -->
                    <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-4 pt-6 border-t border-zinc-200 dark:border-zinc-700">
                        <a href="{{ route('documents.index') }}" class="btn-secondary order-2 sm:order-1">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                            {{ __('Annuler') }}
                        </a>
                        <button type="submit" class="btn-primary order-1 sm:order-2" wire:loading.attr="disabled" wire:loading.class="opacity-75 cursor-not-allowed">
                            <div wire:loading.remove class="flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Publier le document') }}
                            </div>
                            <div wire:loading class="flex items-center">
                                <div class="loading-spinner mr-2"></div>
                                {{ __('Publication en cours...') }}
                            </div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
