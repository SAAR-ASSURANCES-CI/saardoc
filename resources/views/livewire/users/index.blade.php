<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 dark:from-slate-900 dark:via-slate-800 dark:to-indigo-900 py-12 px-4 sm:px-6 lg:px-8 animate-fade-in">
    <div class="max-w-7xl mx-auto">
        
        <!-- Header Section avec animations spectaculaires -->
        <div class="text-center mb-12 animate-fade-in-up">
            <div class="relative">
                <!-- Cercles décoratifs animés -->
                <div class="absolute -top-4 -left-4 w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full animate-pulse"></div>
                <div class="absolute -top-2 -right-2 w-6 h-6 bg-gradient-to-r from-pink-400 to-red-500 rounded-full animate-bounce"></div>
                
                <h1 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-slate-900 via-blue-800 to-indigo-900 dark:from-white dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent animate-slide-in-bottom">
                    {{ __('Gestion des utilisateurs') }}
                </h1>
                
                <div class="mt-4 text-xl text-slate-600 dark:text-slate-300 animate-fade-in" style="animation-delay: 0.3s;">
                    {{ __('Gérez les comptes et permissions des utilisateurs') }}
                </div>
                
                <!-- Ligne décorative animée -->
                <div class="mt-6 flex justify-center">
                    <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full animate-scale-in"></div>
                </div>
            </div>
        </div>

        <!-- Bouton principal avec animations spectaculaires -->
        <div class="flex justify-center mb-12 animate-bounce-in" style="animation-delay: 0.5s;">
            <a href="{{ route('users.create') }}" 
               class="group relative inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-600 hover:from-blue-700 hover:via-purple-700 hover:to-indigo-700 text-white font-bold text-lg rounded-2xl shadow-2xl hover:shadow-blue-500/50 transform transition-all duration-500 ease-out hover:scale-110 hover:-translate-y-2 active:scale-95">
                
                <!-- Effet de brillance au survol -->
                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-1000 ease-out"></div>
                
                <!-- Icône animée -->
                <svg class="w-6 h-6 mr-3 transform group-hover:rotate-180 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                
                {{ __('Créer un utilisateur') }}
                
                <!-- Particules décoratives -->
                <div class="absolute -top-2 -right-2 w-4 h-4 bg-yellow-400 rounded-full animate-ping"></div>
            </a>
        </div>

        <!-- Messages de succès/erreur avec design premium -->
        @if(session('success'))
        <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.7s;">
            <div class="max-w-2xl mx-auto bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 border-2 border-green-200 dark:border-green-700 rounded-2xl p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mr-4 animate-bounce-in">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-green-800 dark:text-green-200">{{ __('Succès !') }}</h3>
                        <p class="text-green-700 dark:text-green-300">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        @if(session('error'))
        <div class="mb-8 animate-fade-in-up" style="animation-delay: 0.7s;">
            <div class="max-w-2xl mx-auto bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/20 dark:to-pink-900/20 border-2 border-red-200 dark:border-red-700 rounded-2xl p-6 shadow-lg">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-gradient-to-br from-red-500 to-pink-600 rounded-full flex items-center justify-center mr-4 animate-bounce-in">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold text-red-800 dark:text-red-200">{{ __('Erreur !') }}</h3>
                        <p class="text-red-700 dark:text-red-300">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Liste des utilisateurs avec design premium -->
        <div class="animate-fade-in-up" style="animation-delay: 0.9s;">
            <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 dark:border-slate-700/20 overflow-hidden">
                <div class="p-6">
                    @if($users->count() > 0)
                    <div class="space-y-4">
                        @foreach($users as $user)
                        <div class="user-card-premium animate-fade-in-up" 
                             style="animation-delay: {{ $loop->index * 0.05 }}s;">
                            <div class="bg-white/60 dark:bg-slate-700/60 backdrop-blur-sm rounded-2xl p-6 border border-white/30 dark:border-slate-600/30 hover:bg-white/80 dark:hover:bg-slate-700/80 transition-all duration-300 hover:scale-102 hover:-translate-y-1 hover:shadow-lg">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center flex-1">
                                        <div class="flex-shrink-0">
                                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg">
                                                <span class="text-xl font-bold text-white">
                                                    {{ $user->initials() }}
                                                </span>
                                            </div>
                                        </div>
                                        <div class="ml-6 flex-1">
                                            <div class="flex items-center mb-3">
                                                <h3 class="text-xl font-bold text-slate-900 dark:text-white">{{ $user->name }}</h3>
                                                <span class="ml-4 inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-blue-100 to-purple-100 text-blue-800 dark:from-blue-900 dark:to-purple-900 dark:text-blue-200">
                                                    {{ ucfirst($user->role) }}
                                                </span>
                                                @if($user->est_bloque)
                                                <span class="ml-3 inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-gradient-to-r from-red-100 to-pink-100 text-red-800 dark:from-red-900 dark:to-pink-900 dark:text-red-200">
                                                    {{ __('Bloqué') }}
                                                </span>
                                                @endif
                                            </div>
                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm text-slate-600 dark:text-slate-400">
                                                <div class="flex items-center">
                                                    <div class="w-5 h-5 bg-gradient-to-br from-blue-400 to-purple-500 rounded-lg flex items-center justify-center mr-3">
                                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                                        </svg>
                                                    </div>
                                                    <span>{{ $user->email }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <div class="w-5 h-5 bg-gradient-to-br from-green-400 to-emerald-500 rounded-lg flex items-center justify-center mr-3">
                                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                        </svg>
                                                    </div>
                                                    <span>{{ __('Matricule :') }} {{ $user->matricule }}</span>
                                                </div>
                                                <div class="flex items-center">
                                                    <div class="w-5 h-5 bg-gradient-to-br from-purple-400 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                                                        <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-8 0h8m-8 0H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-1"></path>
                                                        </svg>
                                                    </div>
                                                    <span>{{ __('Créé le :') }} {{ $user->created_at->format('d/m/Y') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-3 ml-6">
                                        <!-- Bouton Voir -->
                                        <a href="{{ route('users.show', $user) }}" 
                                           class="group inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white rounded-2xl shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-500/30 transition-all duration-300 hover:scale-110 hover:-translate-y-1 active:scale-95">
                                            
                                            <!-- Effet de brillance -->
                                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out rounded-2xl"></div>
                                            
                                            <svg class="w-6 h-6 relative z-10 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                        </a>

                                        <!-- Bouton Modifier -->
                                        <a href="{{ route('users.edit', $user) }}" 
                                           class="group inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-yellow-500 to-orange-600 hover:from-yellow-600 hover:to-orange-700 text-white rounded-2xl shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-yellow-500/30 transition-all duration-300 hover:scale-110 hover:-translate-y-1 active:scale-95">
                                            
                                            <!-- Effet de brillance -->
                                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out rounded-2xl"></div>
                                            
                                            <svg class="w-6 h-6 relative z-10 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </a>
                                        
                                        <!-- Bouton bloquer/débloquer -->
                                        <form action="{{ route('users.toggle-block', $user) }}" method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="group inline-flex items-center justify-center w-12 h-12 rounded-2xl shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 transition-all duration-300 hover:scale-110 hover:-translate-y-1 active:scale-95 {{ $user->est_bloque ? 'bg-gradient-to-r from-green-500 to-emerald-600 hover:from-green-600 hover:to-emerald-700 focus:ring-green-500/30' : 'bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 focus:ring-red-500/30' }} text-white">
                                                
                                                <!-- Effet de brillance -->
                                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out rounded-2xl"></div>
                                                
                                                <svg class="w-6 h-6 relative z-10 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    @if($user->est_bloque)
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    @else
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"></path>
                                                    @endif
                                                </svg>
                                            </button>
                                        </form>

                                        <!-- Bouton changer mot de passe -->
                                        <button onclick="openChangePasswordModal({{ $user->id }})" 
                                                class="group inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-600 hover:from-purple-600 hover:to-pink-700 text-white rounded-2xl shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-purple-500/30 transition-all duration-300 hover:scale-110 hover:-translate-y-1 active:scale-95">
                                            
                                            <!-- Effet de brillance -->
                                            <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out rounded-2xl"></div>
                                            
                                            <svg class="w-6 h-6 relative z-10 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                            </svg>
                                        </button>

                                        @if($user->id !== auth()->id())
                                        <!-- Bouton Supprimer -->
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer cet utilisateur ?') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="group inline-flex items-center justify-center w-12 h-12 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 text-white rounded-2xl shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-red-500/30 transition-all duration-300 hover:scale-110 hover:-translate-y-1 active:scale-95">
                                                
                                                <!-- Effet de brillance -->
                                                <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -skew-x-12 -translate-x-full group-hover:translate-x-full transition-transform duration-700 ease-out rounded-2xl"></div>
                                                
                                                <svg class="w-6 h-6 relative z-10 transform group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
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
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-3">
                                {{ __('Aucun utilisateur trouvé') }}
                            </h3>
                            <p class="text-slate-600 dark:text-slate-400 text-lg">
                                {{ __('Commencez par créer votre premier utilisateur.') }}
                            </p>
                        </div>
                        
                        <a href="{{ route('users.create') }}" 
                           class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold text-lg rounded-2xl shadow-xl hover:shadow-2xl transform transition-all duration-300 hover:scale-105 hover:-translate-y-1 active:scale-95">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            {{ __('Créer un utilisateur') }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Pagination avec design moderne -->
        @if($users->hasPages())
        <div class="mt-12 animate-fade-in-up" style="animation-delay: 1.1s;">
            <div class="flex justify-center">
                {{ $users->links() }}
            </div>
        </div>
        @endif
    </div>

    <!-- Modal pour changer le mot de passe avec design premium -->
    <div id="changePasswordModal" class="modal-overlay hidden fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center p-4" x-data="{ open: false }" x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="modal-content bg-white/90 dark:bg-slate-800/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-white/20 dark:border-slate-700/20 p-8 max-w-md w-full mx-4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
            <div class="mb-8 text-center">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-600 rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mb-2">{{ __('Changer le mot de passe') }}</h3>
                <p class="text-slate-600 dark:text-slate-400">{{ __('Entrez le nouveau mot de passe pour cet utilisateur.') }}</p>
            </div>
            
            <form id="changePasswordForm" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                <div class="form-group-premium">
                    <label for="password" class="form-label-premium">
                        <div class="flex items-center space-x-2">
                            <div class="w-5 h-5 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <span>{{ __('Nouveau mot de passe') }}</span>
                        </div>
                    </label>
                    <input type="password" id="password" name="password" required class="form-input-premium" placeholder="{{ __('Entrez le nouveau mot de passe') }}">
                </div>
                <div class="form-group-premium">
                    <label for="password_confirmation" class="form-label-premium">
                        <div class="flex items-center space-x-2">
                            <div class="w-5 h-5 bg-gradient-to-br from-green-500 to-emerald-600 rounded-lg flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span>{{ __('Confirmer le mot de passe') }}</span>
                        </div>
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="form-input-premium" placeholder="{{ __('Confirmez le nouveau mot de passe') }}">
                </div>
                <div class="flex justify-end space-x-4 pt-6">
                    <button type="button" onclick="closeChangePasswordModal()" 
                            class="btn-secondary-premium">
                        {{ __('Annuler') }}
                    </button>
                    <button type="submit" 
                            class="btn-primary-premium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        {{ __('Changer') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openChangePasswordModal(userId) {
            const modal = document.getElementById('changePasswordModal');
            const form = document.getElementById('changePasswordForm');
            form.action = `/users/${userId}/change-password`;
            
            // Utiliser Alpine.js pour ouvrir le modal
            Alpine.store('modal', { open: true });
            modal.__x.$data.open = true;
        }

        function closeChangePasswordModal() {
            const modal = document.getElementById('changePasswordModal');
            modal.__x.$data.open = false;
        }

        // Fermer le modal en cliquant à l'extérieur
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('changePasswordModal');
            if (event.target === modal) {
                closeChangePasswordModal();
            }
        });
    </script>
</div>
