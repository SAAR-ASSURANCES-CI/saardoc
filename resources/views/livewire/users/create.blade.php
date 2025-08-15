<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-zinc-900 dark:text-zinc-100">
                <div class="mb-6">
                    <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">
                        {{ __('Créer un nouvel utilisateur') }}
                    </h1>
                    <p class="mt-2 text-sm text-zinc-600 dark:text-zinc-400">
                        {{ __('Remplissez le formulaire ci-dessous pour créer un nouvel utilisateur.') }}
                    </p>
                </div>

                <form wire:submit="store" class="space-y-6">
                    <!-- Nom -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ __('Nom complet') }} <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="name" type="text" id="name" class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm" placeholder="{{ __('Entrez le nom complet') }}">
                        @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ __('Adresse email') }} <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="email" type="email" id="email" class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm" placeholder="{{ __('Entrez l\'adresse email') }}">
                        @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Matricule -->
                    <div>
                        <label for="matricule" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ __('Matricule') }} <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="matricule" type="text" id="matricule" class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm" placeholder="{{ __('Entrez le matricule') }}">
                        @error('matricule') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Rôle -->
                    <div>
                        <label for="role" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ __('Rôle') }} <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="role" id="role" class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm">
                            <option value="">{{ __('Sélectionnez un rôle') }}</option>
                            <option value="employe">{{ __('Employé') }}</option>
                            <option value="rh">{{ __('Ressources Humaines') }}</option>
                            <option value="admin">{{ __('Administrateur') }}</option>
                        </select>
                        @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Mot de passe -->
                    <div>
                        <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ __('Mot de passe') }} <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="password" type="password" id="password" class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm" placeholder="{{ __('Entrez le mot de passe') }}">
                        @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirmation du mot de passe -->
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ __('Confirmer le mot de passe') }} <span class="text-red-500">*</span>
                        </label>
                        <input wire:model="password_confirmation" type="password" id="password_confirmation" class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm" placeholder="{{ __('Confirmez le mot de passe') }}">
                        @error('password_confirmation') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>

                    <!-- Informations sur les rôles -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                    {{ __('Informations sur les rôles') }}
                                </h3>
                                <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                                    <ul class="list-disc list-inside space-y-1">
                                        <li><strong>{{ __('Employé :') }}</strong> {{ __('Peut consulter les documents publics') }}</li>
                                        <li><strong>{{ __('RH :') }}</strong> {{ __('Peut gérer les documents et consulter les utilisateurs') }}</li>
                                        <li><strong>{{ __('Administrateur :') }}</strong> {{ __('Accès complet à toutes les fonctionnalités') }}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="flex justify-end space-x-3">
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 border border-zinc-300 shadow-sm text-sm font-medium rounded-md text-zinc-700 bg-white hover:bg-zinc-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-600">
                            {{ __('Annuler') }}
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            {{ __('Créer l\'utilisateur') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
