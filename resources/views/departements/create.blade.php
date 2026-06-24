@extends('layouts.app')

@section('title', 'Ajouter un département')
@section('page-title', 'Ajouter un département')
@section('page-subtitle', 'Créer un nouveau département')

@section('content')
<div class="max-w-2xl">
    <div class="card">
        <form method="POST" action="{{ route('departements.store') }}">
            @csrf

            {{-- Nom --}}
            <div class="form-group">
                <label for="nom" class="form-label">Nom du département <span style="color: var(--color-danger);">*</span></label>
                <input
                    type="text"
                    id="nom"
                    name="nom"
                    value="{{ old('nom') }}"
                    class="form-input {{ $errors->has('nom') ? 'error' : '' }}"
                    placeholder="Ex: Informatique"
                    autofocus
                >
                @error('nom')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Localisation --}}
            <div class="form-group">
                <label for="localisation" class="form-label">Localisation <span style="color: var(--color-danger);">*</span></label>
                <input
                    type="text"
                    id="localisation"
                    name="localisation"
                    value="{{ old('localisation') }}"
                    class="form-input {{ $errors->has('localisation') ? 'error' : '' }}"
                    placeholder="Ex: Casablanca"
                >
                @error('localisation')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="form-group">
                <label for="description" class="form-label">Description</label>
                <textarea
                    id="description"
                    name="description"
                    class="form-textarea {{ $errors->has('description') ? 'error' : '' }}"
                    placeholder="Description du département (optionnel)"
                    rows="4"
                >{{ old('description') }}</textarea>
                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Actions --}}
            <div class="flex items-center justify-end gap-3 pt-4" style="border-top: 1px solid var(--color-border);">
                <a href="{{ route('departements.index') }}" class="btn-secondary">Annuler </a>
                <button type="submit" class="btn-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Créer le département
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
