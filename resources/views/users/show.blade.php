@extends('components.layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-zinc-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-zinc-900 dark:text-zinc-100">
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-semibold text-zinc-900 dark:text-zinc-100">
                        {{ __('Détails de l\'utilisateur') }}
                    </h1>
                    <div class="flex space-x-2">
                        <a href="{{ route('users.edit', $user) }}" class="inline-flex items-center px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-700 focus:bg-yellow-700 active:bg-yellow-900 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            {{ __('Modifier') }}
                        </a>
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 bg-zinc-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-zinc-700 focus:bg-zinc-700 active:bg-zinc-900 focus:outline-none focus:ring-2 focus:ring-zinc-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            {{ __('Retour') }}
                        </a>
                    </div>
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

                <!-- Informations de l'utilisateur -->
                <div class="bg-white dark:bg-zinc-800 shadow overflow-hidden sm:rounded-lg">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-zinc-900 dark:text-zinc-100">
                            {{ __('Informations personnelles') }}
                        </h3>
                    </div>
                    <div class="border-t border-zinc-200 dark:border-zinc-700">
                        <dl>
                            <div class="bg-zinc-50 dark:bg-zinc-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">
                                    {{ __('Nom complet') }}
                                </dt>
                                <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100 sm:mt-0 sm:col-span-2">
                                    {{ $user->name }}
                                </dd>
                            </div>
                            <div class="bg-white dark:bg-zinc-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">
                                    {{ __('Email') }}
                                </dt>
                                <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100 sm:mt-0 sm:col-span-2">
                                    {{ $user->email }}
                                </dd>
                            </div>
                            <div class="bg-zinc-50 dark:bg-zinc-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">
                                    {{ __('Matricule') }}
                                </dt>
                                <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100 sm:mt-0 sm:col-span-2">
                                    {{ $user->matricule }}
                                </dd>
                            </div>
                            <div class="bg-white dark:bg-zinc-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">
                                    {{ __('Rôle') }}
                                </dt>
                                <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100 sm:mt-0 sm:col-span-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </dd>
                            </div>
                            <div class="bg-zinc-50 dark:bg-zinc-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">
                                    {{ __('Statut') }}
                                </dt>
                                <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100 sm:mt-0 sm:col-span-2">
                                    @if($user->est_bloque)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                            {{ __('Bloqué') }}
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            {{ __('Actif') }}
                                        </span>
                                    @endif
                                </dd>
                            </div>
                            <div class="bg-white dark:bg-zinc-800 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">
                                    {{ __('Date de création') }}
                                </dt>
                                <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100 sm:mt-0 sm:col-span-2">
                                    {{ $user->created_at->format('d/m/Y à H:i') }}
                                </dd>
                            </div>
                            <div class="bg-zinc-50 dark:bg-zinc-700 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-zinc-500 dark:text-zinc-400">
                                    {{ __('Dernière modification') }}
                                </dt>
                                <dd class="mt-1 text-sm text-zinc-900 dark:text-zinc-100 sm:mt-0 sm:col-span-2">
                                    {{ $user->updated_at->format('d/m/Y à H:i') }}
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
