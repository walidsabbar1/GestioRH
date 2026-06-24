@extends('layouts.guest')

@section('content')
<div class="login-container">
    <div class="login-card">
        {{-- Logo --}}
        <div class="login-logo">
            <div class="logo-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h1>RH Manager</h1>
            <p>Connectez-vous à votre espace</p>
        </div>

        {{-- Login Form --}}
        <form method="POST" action="{{ route('connexion') }}">
            @csrf

            {{-- Email --}}
            <div class="form-group">
                <label for="email" class="form-label">Adresse email</label>
                <div class="relative">
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2" style="color: var(--color-text-lighter);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-input pl-11 {{ $errors->has('email') ? 'error' : '' }}"
                        placeholder="admin@rhmanager.com"
                        autofocus
                    >
                </div>
                @error('email')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="form-group">
                <label for="password" class="form-label">Mot de passe</label>
                <div class="relative">
                    <div class="absolute left-3.5 top-1/2 -translate-y-1/2" style="color: var(--color-text-lighter);">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-input pl-11 {{ $errors->has('password') ? 'error' : '' }}"
                        placeholder="••••••••"
                    >
                </div>
                @error('password')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Remember --}}
            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="checkbox" name="remember" class="w-4 h-4 rounded" style="accent-color: var(--color-primary);">
                    <span class="text-sm" style="color: var(--color-text-light);">Se souvenir de moi</span>
                </label>
            </div>

            {{-- Submit --}}
            <button type="submit" class="btn-primary w-full py-3 text-base">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                </svg>
                Se connecter
            </button>
        </form>

        {{-- Footer --}}
        <p class="text-center text-xs mt-6" style="color: var(--color-text-lighter);">
            © {{ date('Y') }} RH Manager. Tous droits réservés.
        </p>
    </div>
</div>
@endsection
