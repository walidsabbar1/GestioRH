@extends('layouts.guest')

@section('content')
<div class="login-page">
    {{-- Left Panel — Branding --}}
    <div class="login-brand">
        <div class="login-brand-content">
            <div class="login-brand-logo">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
            </div>
            <h1>GestioRH</h1>
            <p class="login-brand-tagline">Gestion des Ressources Humaines simplifiée</p>

            <div class="login-brand-features">
                <div class="login-brand-feature">
                    <div class="feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span>Suivi des employés en temps réel</span>
                </div>
                <div class="login-brand-feature">
                    <div class="feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span>Gestion des départements</span>
                </div>
                <div class="login-brand-feature">
                    <div class="feature-icon">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <span>Tableaux de bord analytiques</span>
                </div>
            </div>
        </div>

        <p class="login-brand-footer">© {{ date('Y') }} GestioRH. Tous droits réservés.</p>
    </div>

    {{-- Right Panel — Login Form --}}
    <div class="login-form-panel">
        <div class="login-form-wrapper">
            <div class="login-form-header">
                {{-- Mobile-only logo --}}
                <div class="login-mobile-logo">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                </div>
                <h2>Bon retour !</h2>
                <p>Connectez-vous à votre espace de travail</p>
            </div>

            <form method="POST" action="{{ route('connexion') }}">
                @csrf

                {{-- Email --}}
                <div class="login-field">
                    <label for="email" class="login-label">Adresse email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="login-input {{ $errors->has('email') ? 'has-error' : '' }}"
                        placeholder="votre@email.com"
                        autofocus
                    >
                    @error('email')
                        <p class="login-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="login-field">
                    <label for="password" class="login-label">Mot de passe</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="login-input {{ $errors->has('password') ? 'has-error' : '' }}"
                        placeholder="Entrez votre mot de passe"
                    >
                    @error('password')
                        <p class="login-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Remember --}}
                <div class="login-remember">
                    <label class="login-checkbox-label">
                        <input type="checkbox" name="remember" class="login-checkbox">
                        <span>Se souvenir de moi</span>
                    </label>
                </div>

                {{-- Submit --}}
                <button type="submit" class="login-submit">
                    Se connecter
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                    </svg>
                </button>
            </form>

            <p class="login-form-footer">
                © {{ date('Y') }} GestioRH
            </p>
        </div>
    </div>
</div>
@endsection
