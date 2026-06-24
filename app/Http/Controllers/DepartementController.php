<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartementRequest;
use App\Http\Requests\UpdateDepartementRequest;
use App\Models\Departement;
use Illuminate\Http\Request;

class DepartementController extends Controller
{
    /**
     * Liste des départements avec recherche et pagination.
     */
    public function index(Request $request)
    {
        $query = Departement::withCount('employes');

        if ($search = $request->input('recherche')) {
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('localisation', 'like', "%{$search}%");
            });
        }

        $departements = $query->latest()->paginate(10)->withQueryString();

        return view('departements.index', compact('departements'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        return view('departements.create');
    }

    /**
     * Enregistrer un nouveau département.
     */
    public function store(StoreDepartementRequest $request)
    {
        Departement::create($request->validated());

        return redirect()
            ->route('departements.index')
            ->with('success', 'Département créé avec succès.');
    }

    /**
     * Formulaire d'édition.
     */
    public function edit(Departement $departement)
    {
        return view('departements.edit', compact('departement'));
    }

    /**
     * Mettre à jour un département.
     */
    public function update(UpdateDepartementRequest $request, Departement $departement)
    {
        $departement->update($request->validated());

        return redirect()
            ->route('departements.index')
            ->with('success', 'Département mis à jour avec succès.');
    }

    /**
     * Supprimer un département.
     */
    public function destroy(Departement $departement)
    {
        $departement->delete();

        return redirect()
            ->route('departements.index')
            ->with('success', 'Département supprimé avec succès.');
    }
}
