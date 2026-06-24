@extends('layouts.app')

@section('title', 'Ajouter un employé')
@section('page-title', 'Ajouter un employé')
@section('page-subtitle', 'Créer une nouvelle fiche employé')

@section('content')
<div class="max-w-3xl">
    <div class="card">
        <form method="POST" action="{{ route('employes.store') }}" enctype="multipart/form-data">
            @csrf

            {{-- Photo Upload --}}
            <div class="form-group">
                <label class="form-label">Photo</label>
                <div id="photo-upload" class="photo-upload">
                    <img id="photo-preview" src="" alt="Preview" class="hidden">
                    <div id="photo-placeholder" class="photo-placeholder">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        <span class="text-xs font-medium">Ajouter</span>
                    </div>
                    <div class="photo-overlay">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                    </div>
                </div>
                <input type="file" id="photo-input" name="photo" class="hidden" accept="image/jpg,image/jpeg,image/png,image/webp">
                <p class="text-xs mt-2" style="color: var(--color-text-lighter);">JPG, JPEG, PNG ou WebP. 5 Mo maximum.</p>
                @error('photo')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6">
                {{-- Nom --}}
                <div class="form-group">
                    <label for="nom" class="form-label">Nom <span style="color: var(--color-danger);">*</span></label>
                    <input
                        type="text"
                        id="nom"
                        name="nom"
                        value="{{ old('nom') }}"
                        class="form-input {{ $errors->has('nom') ? 'error' : '' }}"
                        placeholder="Ex: Benali"
                    >
                    @error('nom')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Prénom --}}
                <div class="form-group">
                    <label for="prenom" class="form-label">Prénom <span style="color: var(--color-danger);">*</span></label>
                    <input
                        type="text"
                        id="prenom"
                        name="prenom"
                        value="{{ old('prenom') }}"
                        class="form-input {{ $errors->has('prenom') ? 'error' : '' }}"
                        placeholder="Ex: Youssef"
                    >
                    @error('prenom')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="email" class="form-label">Email <span style="color: var(--color-danger);">*</span></label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        class="form-input {{ $errors->has('email') ? 'error' : '' }}"
                        placeholder="Ex: y.benali@rhmanager.com"
                    >
                    @error('email')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Fonction --}}
                <div class="form-group">
                    <label for="fonction" class="form-label">Fonction <span style="color: var(--color-danger);">*</span></label>
                    <input
                        type="text"
                        id="fonction"
                        name="fonction"
                        value="{{ old('fonction') }}"
                        class="form-input {{ $errors->has('fonction') ? 'error' : '' }}"
                        placeholder="Ex: Développeur Full Stack"
                    >
                    @error('fonction')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Salaire --}}
                <div class="form-group">
                    <label for="salaire" class="form-label">Salaire (MAD) <span style="color: var(--color-danger);">*</span></label>
                    <input
                        type="number"
                        id="salaire"
                        name="salaire"
                        value="{{ old('salaire') }}"
                        class="form-input {{ $errors->has('salaire') ? 'error' : '' }}"
                        placeholder="Ex: 12000"
                        step="0.01"
                        min="0"
                    >
                    @error('salaire')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Date d'embauche --}}
                <div class="form-group">
                    <label for="date_embauche" class="form-label">Date d'embauche <span style="color: var(--color-danger);">*</span></label>
                    <input
                        type="date"
                        id="date_embauche"
                        name="date_embauche"
                        value="{{ old('date_embauche') }}"
                        class="form-input {{ $errors->has('date_embauche') ? 'error' : '' }}"
                    >
                    @error('date_embauche')
                        <p class="form-error">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Département --}}
            <div class="form-group">
                <label for="departement_id" class="form-label">Département <span style="color: var(--color-danger);">*</span></label>
                <select
                    id="departement_id"
                    name="departement_id"
                    class="form-select {{ $errors->has('departement_id') ? 'error' : '' }}"
                >
                    <option value="">— Sélectionner un département —</option>
                    @foreach($departements as $dept)
                        <option value="{{ $dept->id }}" {{ old('departement_id') == $dept->id ? 'selected' : '' }}>
                            {{ $dept->nom }} ({{ $dept->localisation }})
                        </option>
                    @endforeach
                </select>
                @error('departement_id')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-4" style="border-top: 1px solid var(--color-border);">
                <a href="{{ route('employes.index') }}" class="btn-secondary">Annuler</a>
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Ajouter l'employé
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
