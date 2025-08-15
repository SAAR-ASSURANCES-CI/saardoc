@extends('components.layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-zinc-900 dark:text-zinc-100">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">
                        {{ __('Gestion des utilisateurs') }}
                    </h1>
                    <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        {{ __('Créer un utilisateur') }}
                    </a>
                </div>

                @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded dark:bg-green-900 dark:border-green-700 dark:text-green-300">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded dark:bg-red-900 dark:border-red-700 dark:text-red-300">
                    {{ session('error') }}
                </div>
                @endif

                <!-- Liste des utilisateurs -->
                <div class="bg-white dark:bg-zinc-800 shadow overflow-hidden sm:rounded-md">
                    @if($users->count() > 0)
                    <ul class="divide-y divide-zinc-200 dark:divide-zinc-700">
                        @foreach($users as $user)
                        <li class="px-6 py-4 hover:bg-zinc-50 dark:hover:bg-zinc-700 transition-colors duration-150">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                            <span class="text-sm font-medium text-blue-600 dark:text-blue-400">
                                                {{ $user->initials() }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="flex items-center">
                                            <p class="text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ $user->name }}</p>
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                            @if($user->est_bloque)
                                            <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                                {{ __('Bloqué') }}
                                            </span>
                                            @endif
                                        </div>
                                        <div class="flex items-center text-sm text-zinc-500 dark:text-zinc-400 mt-1">
                                            <span>{{ $user->email }}</span>
                                            <span class="mx-2">•</span>
                                            <span>{{ __('Matricule :') }} {{ $user->matricule }}</span>
                                            <span class="mx-2">•</span>
                                            <span>{{ __('Créé le :') }} {{ $user->created_at->format('d/m/Y') }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <a href="{{ route('users.show', $user) }}" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-blue-700 bg-blue-100 hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 dark:text-blue-300 dark:bg-blue-900 dark:hover:bg-blue-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        {{ __('Voir') }}
                                    </a>
                                    <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-yellow-700 bg-yellow-100 hover:bg-yellow-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 dark:text-yellow-300 dark:bg-yellow-900 dark:hover:bg-yellow-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        {{ __('Modifier') }}
                                    </a>
                                    
                                    <!-- Bouton bloquer/débloquer -->
                                    <form action="{{ route('users.toggle-block', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md {{ $user->est_bloque ? 'text-green-700 bg-green-100 hover:bg-green-200 dark:text-green-300 dark:bg-green-900 dark:hover:bg-green-800' : 'text-red-700 bg-red-100 hover:bg-red-200 dark:text-red-300 dark:bg-red-900 dark:hover:bg-red-800' }} focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-{{ $user->est_bloque ? 'green' : 'red' }}-500">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                                    <button onclick="openChangePasswordModal({{ $user->id }})" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-purple-700 bg-purple-100 hover:bg-purple-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 dark:text-purple-300 dark:bg-purple-900 dark:hover:bg-purple-800">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                                        </svg>
                                        {{ __('Mot de passe') }}
                                    </button>

                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Êtes-vous sûr de vouloir supprimer cet utilisateur ?') }}')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent text-sm leading-4 font-medium rounded-md text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 dark:text-red-300 dark:bg-red-900 dark:hover:bg-red-800">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    <div class="text-center py-12">
                        <svg class="mx-auto h-12 w-12 text-zinc-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                        </svg>
                        <h3 class="mt-2 text-sm font-medium text-zinc-900 dark:text-zinc-100">{{ __('Aucun utilisateur trouvé') }}</h3>
                        <p class="mt-1 text-sm text-zinc-500 dark:text-zinc-400">
                            {{ __('Commencez par créer votre premier utilisateur.') }}
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('users.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                {{ __('Créer un utilisateur') }}
                            </a>
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Pagination -->
                @if($users->hasPages())
                <div class="mt-6">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Modal pour changer le mot de passe -->
    <div id="changePasswordModal" class="fixed inset-0 bg-zinc-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white dark:bg-zinc-800">
            <div class="mt-3">
                <h3 class="text-lg font-medium text-zinc-900 dark:text-zinc-100 mb-4">{{ __('Changer le mot de passe') }}</h3>
                <form id="changePasswordForm" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ __('Nouveau mot de passe') }}
                        </label>
                        <input type="password" id="password" name="password" required class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm">
                    </div>
                    <div>
                        <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                            {{ __('Confirmer le mot de passe') }}
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm">
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeChangePasswordModal()" class="px-4 py-2 border border-zinc-300 rounded-md text-zinc-700 bg-white hover:bg-zinc-50 dark:bg-zinc-700 dark:border-zinc-600 dark:text-zinc-300 dark:hover:bg-zinc-600">
                            {{ __('Annuler') }}
                        </button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            {{ __('Changer') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openChangePasswordModal(userId) {
            const modal = document.getElementById('changePasswordModal');
            const form = document.getElementById('changePasswordForm');
            form.action = `/users/${userId}/change-password`;
            modal.classList.remove('hidden');
        }

        function closeChangePasswordModal() {
            const modal = document.getElementById('changePasswordModal');
            modal.classList.add('hidden');
        }
    </script>
</div>
@endsection
