<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-indigo-900 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto">
        
        <!-- Header Section avec animations spectaculaires -->
        <div class="text-center mb-12 animate-fade-in-up">
            <div class="relative">
                <!-- Cercles décoratifs animés -->
                <div class="absolute -top-4 -left-4 w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full animate-pulse"></div>
                <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-pink-400 to-red-500 rounded-full animate-bounce"></div>
                
                <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-slate-900 via-blue-800 to-indigo-900 dark:from-white dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent animate-slide-in-bottom">
                    {{ __('Publier un nouveau document') }}
                </h1>
                
                <div class="mt-4 text-xl text-slate-600 dark:text-slate-300 animate-fade-in" style="animation-delay: 0.3s;">
                    {{ __('Remplissez le formulaire ci-dessous pour publier un nouveau document.') }}
                </div>
                
                <!-- Ligne décorative animée -->
                <div class="mt-6 flex justify-center">
                    <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full animate-scale-in"></div>
                </div>
            </div>
        </div>

        <!-- Formulaire avec design premium -->
        <div class="animate-fade-in-up" style="animation-delay: 0.5s;">
            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 dark:border-slate-700/20 overflow-hidden">
                <div class="p-8 md:p-12">
                    
                    <form wire:submit="store" class="space-y-8">
                        
                        <!-- Titre du document -->
                        <div class="form-group-premium animate-fade-in-up" style="animation-delay: 0.7s;">
                            <label for="titre" class="form-label-premium">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <span>{{ __('Titre du document') }}</span>
                                    <span class="text-red-500 font-bold">*</span>
                                </div>
                            </label>
                            
                            <div class="relative group">
                                <input wire:model="titre" 
                                       type="text" 
                                       id="titre" 
                                       class="form-input-premium focus-premium" 
                                       placeholder="{{ __('Entrez le titre du document') }}">
                                
                                <!-- Effet de focus -->
                                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-500/0 via-purple-500/0 to-indigo-500/0 focus-within:from-blue-500/10 focus-within:via-purple-500/10 focus-within:to-indigo-500/10 transition-all duration-500 pointer-events-none"></div>
                                
                                <!-- Icône de validation -->
                                @if($titre && !$errors->has('titre'))
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                    <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center animate-bounce-in">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                </div>
                                @endif
                            </div>
                            
                            @error('titre') 
                            <div class="error-message-premium animate-slide-in-right">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <!-- Type de document -->
                        <div class="form-group-premium animate-fade-in-up" style="animation-delay: 0.9s;">
                            <label for="type" class="form-label-premium">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                        </svg>
                                    </div>
                                    <span>{{ __('Type de document') }}</span>
                                    <span class="text-red-500 font-bold">*</span>
                                </div>
                            </label>
                            
                            <div class="relative group">
                                <select wire:model="type" 
                                        id="type" 
                                        class="form-select-premium focus-premium">
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
                                
                                <!-- Icône de flèche -->
                                <div class="absolute right-4 top-1/2 transform -translate-y-1/2 pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                                
                                <!-- Effet de focus -->
                                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-500/0 via-purple-500/0 to-indigo-500/0 focus-within:from-blue-500/10 focus-within:via-purple-500/10 focus-within:to-indigo-500/10 transition-all duration-500 pointer-events-none"></div>
                            </div>
                            
                            @error('type') 
                            <div class="error-message-premium animate-slide-in-right">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group-premium animate-fade-in-up" style="animation-delay: 1.1s;">
                            <label for="description" class="form-label-premium">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                    </div>
                                    <span>{{ __('Description') }}</span>
                                    <span class="text-slate-400 text-sm">({{ __('optionnel') }})</span>
                                </div>
                            </label>
                            
                            <div class="relative group">
                                <textarea wire:model="description" 
                                          id="description" 
                                          rows="4" 
                                          class="form-textarea-premium focus-premium resize-none" 
                                          placeholder="{{ __('Entrez une description du document (optionnel)') }}"></textarea>
                                
                                <!-- Effet de focus -->
                                <div class="absolute inset-0 rounded-2xl bg-gradient-to-r from-blue-500/0 via-purple-500/0 to-indigo-500/0 focus-within:from-blue-500/10 focus-within:via-purple-500/10 focus-within:to-indigo-500/10 transition-all duration-500 pointer-events-none"></div>
                                
                                <!-- Compteur de caractères -->
                                <div class="absolute bottom-3 right-3 text-xs text-slate-400">
                                    {{ Str::length($description ?? '') }}/500
                                </div>
                            </div>
                            
                            @error('description') 
                            <div class="error-message-premium animate-slide-in-right">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <!-- Zone de fichier premium -->
                        <div class="form-group-premium animate-fade-in-up" style="animation-delay: 1.3s;">
                            <label class="form-label-premium">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-gradient-to-br from-orange-500 to-red-600 rounded-lg flex items-center justify-center">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                    </div>
                                    <span>{{ __('Fichier') }}</span>
                                    <span class="text-red-500 font-bold">*</span>
                                </div>
                            </label>
                            
                            <div class="mt-3">
                                <div class="file-zone-premium {{ $fichier ? 'has-file' : '' }}" 
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
                                    
                                    @if($fichier)
                                        <!-- Prévisualisation du fichier sélectionné -->
                                        <div class="animate-bounce-in">
                                            <div class="text-center space-y-4">
                                                <div class="mx-auto w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-2xl flex items-center justify-center shadow-lg">
                                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                                <div class="space-y-2">
                                                    <p class="font-semibold text-slate-900 dark:text-white text-lg">
                                                        {{ $fichier->getClientOriginalName() }}
                                                    </p>
                                                    <p class="text-sm text-slate-600 dark:text-slate-400">
                                                        {{ __('Fichier sélectionné avec succès') }}
                                                    </p>
                                                </div>
                                                <button type="button" 
                                                        wire:click="$set('fichier', null)" 
                                                        class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white font-medium rounded-xl transition-all duration-300 hover:scale-105 hover:-translate-y-1">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                                    </svg>
                                                    {{ __('Changer de fichier') }}
                                                </button>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Zone de dépôt vide -->
                                        <div class="text-center space-y-6 py-12">
                                            <div class="mx-auto w-24 h-24 bg-gradient-to-br from-slate-200 to-slate-300 dark:from-slate-600 dark:to-slate-700 rounded-3xl flex items-center justify-center shadow-lg">
                                                <svg class="w-12 h-12 text-slate-400 dark:text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                </svg>
                                            </div>
                                            
                                            <div class="space-y-4">
                                                <label for="fichier" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold text-lg rounded-2xl shadow-lg hover:shadow-xl transform transition-all duration-300 hover:scale-105 hover:-translate-y-1 cursor-pointer">
                                                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                                    </svg>
                                                    {{ __('Télécharger un fichier') }}
                                                    <input wire:model="fichier" id="fichier" type="file" class="sr-only" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt">
                                                </label>
                                                
                                                <p class="text-slate-600 dark:text-slate-400">
                                                    {{ __('ou glisser-déposer ici') }}
                                                </p>
                                                
                                                <p class="text-sm text-slate-500 dark:text-slate-400">
                                                    {{ __('PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX, TXT jusqu\'à 10MB') }}
                                                </p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            @error('fichier') 
                            <div class="error-message-premium animate-slide-in-right mt-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>{{ $message }}</span>
                            </div>
                            @enderror
                        </div>

                        <!-- Boutons d'action premium -->
                        <div class="flex flex-col sm:flex-row justify-end space-y-4 sm:space-y-0 sm:space-x-6 pt-8 border-t border-slate-200/50 dark:border-slate-700/50 animate-fade-in-up" style="animation-delay: 1.5s;">
                            
                            <a href="{{ route('documents.index') }}" 
                               class="btn-secondary-premium order-2 sm:order-1">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                {{ __('Annuler') }}
                            </a>
                            
                            <button type="submit" 
                                    class="btn-primary-premium order-1 sm:order-2" 
                                    wire:loading.attr="disabled" 
                                    wire:loading.class="opacity-75 cursor-not-allowed">
                                
                                <div wire:loading.remove class="flex items-center">
                                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                    {{ __('Publier le document') }}
                                </div>
                                
                                <div wire:loading class="flex items-center">
                                    <div class="loading-spinner-premium mr-3"></div>
                                    {{ __('Publication en cours...') }}
                                </div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
