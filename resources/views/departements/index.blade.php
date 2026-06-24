@extends('layouts.app')

@section('title', 'Départements')
@section('page-title', 'Départements')
@section('page-subtitle', 'Gérer les départements de votre entreprise')

@section('content')
<div class="table-container">
    <div class="table-header">
        <div class="flex items-center gap-4">
            {{-- Search --}}
            <form method="GET" action="{{ route('departements.index') }}" class="search-wrapper">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input
                    type="text"
                    name="recherche"
                    value="{{ request('recherche') }}"
                    class="search-input"
                    placeholder="Rechercher un département..."
                >
            </form>

            @if(request('recherche'))
                <a href="{{ route('departements.index') }}" class="btn-ghost text-xs">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Effacer
                </a>
            @endif
        </div>

        <a href="{{ route('departements.create') }}" class="btn-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Ajouter un département
        </a>
    </div>

    @if($departements->count() > 0)
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Localisation</th>
                        <th>Description</th>
                        <th>Employés</th>
                        <th class="text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($departements as $departement)
                        <tr>
                            <td>
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-lg flex items-center justify-center flex-shrink-0" style="background-color: var(--color-primary-light);">
                                        <svg class="w-4 h-4" style="color: var(--color-primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                                        </svg>
                                    </div>
                                    <span class="font-semibold">{{ $departement->nom }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="flex items-center gap-1.5">
                                    <svg class="w-3.5 h-3.5" style="color: var(--color-text-lighter);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $departement->localisation }}
                                </div>
                            </td>
                            <td>
                                <span class="text-sm" style="color: var(--color-text-light);">
                                    {{ Str::limit($departement->description, 50) ?: '—' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-primary">{{ $departement->employes_count }} employé(s)</span>
                            </td>
                            <td>
                                <div class="flex items-center justify-end gap-1">
                                    <a href="{{ route('departements.edit', $departement) }}" class="btn-icon" style="color: var(--color-primary); background-color: var(--color-primary-light);" title="Modifier">
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                    </a>
                                    <button
                                        type="button"
                                        data-modal-target="delete-dept-{{ $departement->id }}"
                                        class="btn-icon"
                                        style="color: var(--color-danger); background-color: var(--color-danger-light);"
                                        title="Supprimer"
                                    >
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </div>

                                @include('components.delete-modal', [
                                    'modalId' => 'delete-dept-' . $departement->id,
                                    'action' => route('departements.destroy', $departement),
                                    'message' => 'Êtes-vous sûr de vouloir supprimer le département « ' . $departement->nom . ' » ? Cette action est irréversible et supprimera tous les employés associés.',
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($departements->hasPages())
            <div class="pagination-wrapper">
                <p class="text-sm" style="color: var(--color-text-light);">
                    Affichage de {{ $departements->firstItem() }} à {{ $departements->lastItem() }} sur {{ $departements->total() }} résultats
                </p>
                {{ $departements->links() }}
            </div>
        @endif
    @else
        <div class="empty-state">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
            <h3>Aucun département</h3>
            <p>Commencez par ajouter votre premier département.</p>
            <a href="{{ route('departements.create') }}" class="btn-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Ajouter un département
            </a>
        </div>
    @endif
</div>
@endsection
