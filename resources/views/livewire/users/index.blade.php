<div class="py-12 animate-fade-in">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="card-hover">
            <div class="p-6 text-zinc-900 dark:text-zinc-100">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h1 class="text-3xl font-bold text-zinc-900 dark:text-zinc-100 mb-2">
                            {{ __('Gestion des utilisateurs') }}
                        </h1>
                        <p class="text-zinc-600 dark:text-zinc-400">
                            {{ __('Gérez les comptes et permissions des utilisateurs') }}
                        </p>
                    </div>
                    <a href="{{ route('users.create') }}" class="btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        {{ __('Créer un utilisateur') }}
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

                <!-- Liste des utilisateurs améliorée -->
                <div class="table-container">
                    @if($users->count() > 0)
                    <ul class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @foreach($users as $user)
                        <li class="table-row px-6 py-5 animate-fade-in" style="animation-delay: {{ $loop->index * 0.05 }}s">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center flex-1">
                                    <div class="flex-shrink-0">
                                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center shadow-md">
                                            <span class="text-lg font-semibold text-blue-600 dark:text-blue-400">
                                                {{ $user->initials() }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4 flex-1">
                                        <div class="flex items-center mb-2">
                                            <h3 class="text-lg font-semibold text-zinc-900 dark:text-zinc-100">{{ $user->name }}</h3>
                                            <span class="ml-3 badge badge-primary">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                            @if($user->est_bloque)
                                            <span class="ml-2 badge badge-danger">
                                                {{ __('Bloqué') }}
                                            </span>
                                            @endif
                                        </div>
                                        <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400 mb-2">
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                                </svg>
                                                {{ $user->email }}
                                            </span>
                                            <span class="mx-3">•</span>
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                                </svg>
                                                {{ __('Matricule :') }} {{ $user->matricule }}
                                            </span>
                                            <span class="mx-3">•</span>
                                            <span class="flex items-center">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-8 0h8m-8 0H5a2 2 0 00-2 2v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-1"></path>
                                                </svg>
                                                {{ __('Créé le :') }} {{ $user->created_at->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-3 ml-6">
                                    <a href="{{ route('users.show', $user) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-300 dark:bg-blue-900 dark:hover:bg-blue-800 transition-all-smooth hover-lift">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        {{ __('Voir') }}
                                    </a>
                                    <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 dark:text-yellow-300 dark:bg-yellow-900 dark:hover:bg-yellow-800 transition-all-smooth hover-lift">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        {{ __('Modifier') }}
                                    </a>
                                    
                                    <!-- Bouton bloquer/débloquer -->
                                    <form action="{{ route('users.toggle-block', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg transition-all-smooth hover-lift {{ $user->est_bloque ? 'text-green-700 bg-green-100 hover:bg-green-200 dark:text-green-300 dark:bg-green-900 dark:hover:bg-green-800' : 'text-red-700 bg-red-100 hover:bg-red-200 dark:text-red-300 dark:bg-red-900 dark:hover:bg-red-800' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{ $user->est_bloque ? 'green' : 'red' }}-500">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                @if($user->est_bloque)
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                @else
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636m12.728 12.728L5.636 5.636"></path>
                                                @endif
                                            </svg>
                                            {{ $user->est_bloque ? __('Débloquer') : __('Bloquer') }}
                                        </button>
                                    </form>

                                    <!-- Bouton changer mot de passe -->
                                    <button onclick="openChangePasswordModal({{ $user->id }})" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-purple-700 bg-purple-100 hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 dark:text-purple-300 dark:bg-purple-900 dark:hover:bg-purple-800 transition-all-smooth hover-lift">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                        </svg>
                                        {{ __('Mot de passe') }}
                                    </button>

                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer cet utilisateur ?') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-lg text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:text-red-300 dark:bg-red-900 dark:hover:bg-red-800 transition-all-smooth hover-lift">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            {{ __('Supprimer') }}
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    @else
                    <div class="empty-state">
                        <div class="empty-state-icon">
                            <svg class="mx-auto h-16 w-16 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                            </svg>
                        </div>
                        <h3 class="empty-state-title">{{ __('Aucun utilisateur trouvé') }}</h3>
                        <p class="empty-state-description">
                            {{ __('Commencez par créer votre premier utilisateur.') }}
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('users.create') }}" class="btn-primary">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Créer un utilisateur') }}
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Pagination améliorée -->
                @if($users->hasPages())
                <div class="pagination-container">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal pour changer le mot de passe amélioré -->
    <div id="changePasswordModal" class="modal-overlay hidden" x-data="{ open: false }" x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="modal-content" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform scale-95" x-transition:enter-end="opacity-100 transform scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95">
            <div class="mb-6">
                <h3 class="text-xl font-semibold text-zinc-900 dark:text-zinc-100 mb-2">{{ __('Changer le mot de passe') }}</h3>
                <p class="text-zinc-600 dark:text-zinc-400">{{ __('Entrez le nouveau mot de passe pour cet utilisateur.') }}</p>
            </div>
            
            <form id="changePasswordForm" method="POST" class="space-y-6">
                @csrf
                @method('PATCH')
                <div class="form-group">
                    <label for="password" class="form-label">
                        {{ __('Nouveau mot de passe') }}
                    </label>
                    <input type="password" id="password" name="password" required class="form-input" placeholder="{{ __('Entrez le nouveau mot de passe') }}">
                </div>
                <div class="form-group">
                    <label for="password_confirmation" class="form-label">
                        {{ __('Confirmer le mot de passe') }}
                    </label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required class="form-input" placeholder="{{ __('Confirmez le nouveau mot de passe') }}">
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="closeChangePasswordModal()" class="btn-secondary">
                        {{ __('Annuler') }}
                    </button>
                    <button type="submit" class="btn-primary">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
