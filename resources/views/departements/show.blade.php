@extends('layouts.app')

@section('title', $departement->nom)
@section('page-title', $departement->nom)
@section('page-subtitle', $departement->localisation ?? 'Département')

@section('content')
{{-- Department Info Card --}}
<div class="stat-card" style="margin-bottom: 1.5rem;">
    <div class="flex items-start justify-between">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, var(--color-primary), var(--color-secondary));">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                </svg>
            </div>
            <div>
                <h3 class="text-lg font-bold" style="color: var(--color-text);">{{ $departement->nom }}</h3>
                <div class="flex items-center gap-3 mt-1">
                    @if($departement->localisation)
                        <span class="flex items-center gap-1 text-sm" style="color: var(--color-text-light);">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $departement->localisation }}
                        </span>
                    @endif
                    <span class="badge badge-primary">{{ $employes->total() }} employé(s)</span>
                </div>
                @if($departement->description)
                    <p class="text-sm mt-2" style="color: var(--color-text-light);">{{ $departement->description }}</p>
                @endif
            </div>
        </div>
        <a href="{{ route('departements.index') }}" class="btn-ghost text-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Retour
        </a>
    </div>
</div>

{{-- Employees Table --}}
<div class="table-container">
    <div class="table-header">
        <div class="flex items-center gap-4">
            {{-- Search --}}
            <form method="GET" action="{{ route('departements.show', $departement) }}" class="search-wrapper">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    name="recherche"
                    value="{{ request('recherche') }}"
                    class="search-input"
                    placeholder="Rechercher un employé..."
                >
            </form>

            @if(request('recherche'))
                <a href="{{ route('departements.show', $departement) }}" class="btn-ghost text-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Effacer
                </a>
            @endif
        </div>
    </div>

    @if($employes->count() > 0)
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Employé</th>
                        <th>Email</th>
                        <th>Fonction</th>
                        <th>Salaire</th>
                        <th>Date d'embauche</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($employes as $employe)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <img src="{{ $employe->photo_url }}" alt="{{ $employe->nom_complet }}" class="avatar avatar-md">
                                    <div>
                                        <a href="{{ route('employes.show', $employe) }}" class="font-semibold text-sm hover:underline" style="color: var(--color-primary);">{{ $employe->nom_complet }}</a>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span class="text-sm" style="color: var(--color-text-light);">{{ $employe->email }}</span>
                            </td>
                            <td>
                                <span class="text-sm">{{ $employe->fonction }}</span>
                            </td>
                            <td>
                                <span class="text-sm font-semibold">{{ $employe->salaire_formate }}</span>
                            </td>
                            <td>
                                <span class="text-sm" style="color: var(--color-text-light);">{{ $employe->date_embauche->format('d/m/Y') }}</span>
                            </td>
                            <td>
                                <div class="flex items-center justify-end gap-1">

                                    <a href="{{ route('employes.edit', $employe) }}" class="btn-icon" style="color: var(--color-primary); background-color: var(--color-primary-light);" title="Modifier">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($employes->hasPages())
            <div class="pagination-wrapper">
                <p class="text-sm" style="color: var(--color-text-light);">
                    Affichage de {{ $employes->firstItem() }} à {{ $employes->lastItem() }} sur {{ $employes->total() }} résultats
                </p>
                {{ $employes->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <h3>Aucun employé dans ce département</h3>
            <p>Ce département ne contient aucun employé pour le moment.</p>
            <a href="{{ route('employes.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Ajouter un employé
            </a>
        </div>
    @endif
</div>
@endsection
