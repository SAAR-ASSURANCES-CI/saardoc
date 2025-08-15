@extends('components.layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-zinc-900 dark:text-zinc-100">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">
                        {{ __('Créer un nouvel utilisateur') }}
                    </h1>
                    <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-zinc-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-zinc-700 focus:bg-zinc-700 active:bg-zinc-900 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        {{ __('Retour') }}
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

                <!-- Formulaire de création -->
                <div class="bg-white dark:bg-zinc-800 shadow overflow-hidden sm:rounded-lg">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        
                        <div class="px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                                <div class="sm:col-span-3">
                                    <label for="name" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('Nom complet') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}" required
                                        class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm">
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="email" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('Email') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}" required
                                        class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="matricule" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('Matricule') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="matricule" id="matricule" value="{{ old('matricule') }}" required
                                        class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm">
                                    @error('matricule')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="role" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('Rôle') }} <span class="text-red-500">*</span>
                                    </label>
                                    <select name="role" id="role" required
                                        class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm">
                                        <option value="">{{ __('Sélectionner un rôle') }}</option>
                                        <option value="employe" {{ old('role') === 'employe' ? 'selected' : '' }}>
                                            {{ __('Employé') }}
                                        </option>
                                        <option value="rh" {{ old('role') === 'rh' ? 'selected' : '' }}>
                                            {{ __('RH') }}
                                        </option>
                                        <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                            {{ __('Administrateur') }}
                                        </option>
                                    </select>
                                    @error('role')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="password" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('Mot de passe') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" name="password" id="password" required
                                        class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm">
                                    @error('password')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="sm:col-span-3">
                                    <label for="password_confirmation" class="block text-sm font-medium text-zinc-700 dark:text-zinc-300">
                                        {{ __('Confirmer le mot de passe') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="password" name="password_confirmation" id="password_confirmation" required
                                        class="mt-1 block w-full border-zinc-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-zinc-700 dark:border-zinc-600 dark:text-white sm:text-sm">
                                    @error('password_confirmation')
                                        <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="px-4 py-3 bg-zinc-50 dark:bg-zinc-700 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                {{ __('Créer l\'utilisateur') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
