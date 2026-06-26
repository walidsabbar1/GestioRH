@extends('layouts.app')

@section('title', 'Employés')
@section('page-title', 'Employés')
@section('page-subtitle', 'Gérer les employés de votre entreprise')

@section('content')
<div class="table-container">
    <div class="table-header">
        <div class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
            {{-- Search --}}
            <form method="GET" action="{{ route('employes.index') }}" class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                <div class="search-wrapper">
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
                </div>

                {{-- Filter by department --}}
                <select name="departement_id" class="form-select text-sm" style="max-width: 200px;" onchange="this.form.submit()">
                    <option value="">Tous les départements</option>
                    @foreach($departements as $dept)
                        <option value="{{ $dept->id }}" {{ request('departement_id') == $dept->id ? 'selected' : '' }}>
                            {{ $dept->nom }}
                        </option>
                    @endforeach
                </select>

                @if(request('recherche') || request('departement_id'))
                    <a href="{{ route('employes.index') }}" class="btn-ghost text-xs">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                        Effacer
                    </a>
                @endif
            </form>
        </div>

        <a href="{{ route('employes.create') }}" class="btn-primary flex-shrink-0">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Ajouter un employé
        </a>
    </div>

    @if($employes->count() > 0)
        <div class="overflow-x-auto">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Employé</th>
                        <th>Email</th>
                        <th>Fonction</th>
                        <th>Département</th>
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
                                <span class="badge badge-primary">{{ $employe->departement->nom ?? '—' }}</span>
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
                                    <button
                                        type="button"
                                        data-modal-target="delete-emp-{{ $employe->id }}"
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
                                    'modalId' => 'delete-emp-' . $employe->id,
                                    'action' => route('employes.destroy', $employe),
                                    'message' => 'Voulez-vous vraiment supprimer l\'employé « ' . $employe->nom_complet . ' » ? Cette action est irréversible.',
                                ])
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
            <h3>Aucun employé</h3>
            <p>Commencez par ajouter votre premier employé.</p>
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
