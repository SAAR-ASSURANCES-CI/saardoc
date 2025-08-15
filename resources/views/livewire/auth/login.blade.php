<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string')]
    public string $identifier = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        $credentials = [];
        if (filter_var($this->identifier, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $this->identifier;
        } else {
            if (!preg_match('/^SAARCI\d{3}$/', $this->identifier)) {
                throw ValidationException::withMessages([
                    'identifier' => 'Le format du matricule doit être SAARCI suivi de 3 chiffres (ex: SAARCI000)',
                ]);
            }
            $credentials['matricule'] = $this->identifier;
        }
        $credentials['password'] = $this->password;

        if (! Auth::attempt($credentials, $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'identifier' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'identifier' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->identifier).'|'.request()->ip());
    }
}; ?>

<div class="flex flex-col gap-8">
    <!-- Logo et titre -->
    <div class="text-center space-y-4">
        <div class="flex justify-center">
            <img src="{{ asset('logo.png') }}" alt="SAAR Assurance Côte d'Ivoire" class="h-16 w-auto">
        </div>
        <div class="space-y-2">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white">{{ __('Connexion à votre compte') }}</h1>
            <p class="text-gray-600 dark:text-gray-400">{{ __('Entrez votre email ou matricule et mot de passe pour vous connecter') }}</p>
        </div>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form method="POST" wire:submit="login" class="flex flex-col gap-6 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700">
        <!-- Email Address or Matricule -->
        <flux:input
            wire:model="identifier"
            :label="__('Email ou Matricule')"
            type="text"
            required
            autofocus
            autocomplete="username"
            placeholder="email@example.com ou SAARCI000"
        />

        <!-- Password -->
        <div class="relative">
            <flux:input
                wire:model="password"
                :label="__('Mot de passe')"
                type="password"
                required
                autocomplete="current-password"
                :placeholder="__('Mot de passe')"
                viewable
            />

            {{-- @if (Route::has('password.request'))
                            <flux:link class="absolute end-0 top-0 text-sm" :href="route('password.request')" wire:navigate>
                {{ __('Mot de passe oublié ?') }}
            </flux:link>
            @endif --}}
        </div>

        <!-- Remember Me -->
        <flux:checkbox wire:model="remember" :label="__('Se souvenir de moi')" />

        <div class="flex items-center justify-end">
            <flux:button variant="primary" type="submit" class="w-full py-3 text-base font-medium">{{ __('Se connecter') }}</flux:button>
        </div>
    </form>
</div>
