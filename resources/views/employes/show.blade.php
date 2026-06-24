@extends('layouts.app')

@section('title', $employe->nom_complet)
@section('page-title', 'Fiche employé')
@section('page-subtitle', $employe->nom_complet)

@section('content')
<div class="max-w-3xl">
    {{-- Back link --}}
    <a href="{{ route('employes.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium mb-6" style="color: var(--color-primary);">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
        </svg>
        Retour à la liste
    </a>

    <div class="profile-card">
        {{-- Profile Header --}}
        <div class="profile-header">
            <img src="{{ $employe->photo_url }}" alt="{{ $employe->nom_complet }}" class="avatar avatar-xl mb-4">
            <h2 class="text-xl font-bold" style="color: var(--color-text);">{{ $employe->nom_complet }}</h2>
            <p class="text-sm mt-1" style="color: var(--color-text-light);">{{ $employe->fonction }}</p>
            <span class="badge badge-primary mt-3">{{ $employe->departement->nom ?? '—' }}</span>
        </div>

        {{-- Profile Info --}}
        <div class="profile-info">
            <div class="profile-field">
                <dt>
                    <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Nom
                </dt>
                <dd>{{ $employe->nom }}</dd>
            </div>

            <div class="profile-field">
                <dt>
                    <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Prénom
                </dt>
                <dd>{{ $employe->prenom }}</dd>
            </div>

            <div class="profile-field">
                <dt>
                    <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                    </svg>
                    Email
                </dt>
                <dd>
                    <a href="mailto:{{ $employe->email }}" style="color: var(--color-primary);">{{ $employe->email }}</a>
                </dd>
            </div>

            <div class="profile-field">
                <dt>
                    <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2M3.6 9h16.8"/>
                    </svg>
                    Fonction
                </dt>
                <dd>{{ $employe->fonction }}</dd>
            </div>

            <div class="profile-field">
                <dt>
                    <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Salaire
                </dt>
                <dd class="text-base font-bold" style="color: var(--color-success);">{{ $employe->salaire_formate }}</dd>
            </div>

            <div class="profile-field">
                <dt>
                    <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Date d'embauche
                </dt>
                <dd>{{ $employe->date_embauche->format('d/m/Y') }}</dd>
            </div>

            <div class="profile-field">
                <dt>
                    <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Département
                </dt>
                <dd>{{ $employe->departement->nom ?? '—' }} — {{ $employe->departement->localisation ?? '' }}</dd>
            </div>

            <div class="profile-field">
                <dt>
                    <svg class="w-3.5 h-3.5 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Ancienneté
                </dt>
                <dd>{{ $employe->date_embauche->diffForHumans(null, true) }}</dd>
            </div>
        </div>

        {{-- Actions --}}
        <div class="flex items-center justify-end gap-3 mt-8 pt-6" style="border-top: 1px solid var(--color-border);">
            <a href="{{ route('employes.edit', $employe) }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Modifier
            </a>
            <button type="button" data-modal-target="delete-emp-{{ $employe->id }}" class="btn-danger">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                </svg>
                Supprimer
            </button>
        </div>
    </div>
</div>

@include('components.delete-modal', [
    'modalId' => 'delete-emp-' . $employe->id,
    'action' => route('employes.destroy', $employe),
    'message' => 'Voulez-vous vraiment supprimer l\'employé « ' . $employe->nom_complet . ' » ? Cette action est irréversible.',
])
@endsection
