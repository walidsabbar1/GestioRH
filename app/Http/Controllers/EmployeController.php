<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployeRequest;
use App\Models\Departement;
use App\Models\Employe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeController extends Controller
{
    /**
     * Liste des employés avec recherche, filtre et pagination.
     */
    public function index(Request $request)
    {
        $query = Employe::with('departement');

        // Recherche
        if ($search = $request->input('recherche')) {
            $query->where(function ($q) use ($search) {
                $q->where('nom', 'like', "%{$search}%")
                  ->orWhere('prenom', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('fonction', 'like', "%{$search}%");
            });
        }

        // Filtre par département
        if ($departementId = $request->input('departement_id')) {
            $query->where('departement_id', $departementId);
        }

        $employes = $query->latest()->paginate(10)->withQueryString();
        $departements = Departement::orderBy('nom')->get();

        return view('employes.index', compact('employes', 'departements'));
    }

    /**
     * Formulaire de création.
     */
    public function create()
    {
        $departements = Departement::orderBy('nom')->get();

        return view('employes.create', compact('departements'));
    }

    /**
     * Enregistrer un nouvel employé.
     */
    public function store(StoreEmployeRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('employes', 'public');
        }

        Employe::create($data);

        return redirect()
            ->route('employes.index')
            ->with('success', 'Employé ajouté avec succès.');
    }

    /**
     * Afficher les détails d'un employé.
     */
    public function show(Employe $employe)
    {
        $employe->load('departement');

        return view('employes.show', compact('employe'));
    }

    /**
     * Formulaire d'édition.
     */
    public function edit(Employe $employe)
    {
        $departements = Departement::orderBy('nom')->get();

        return view('employes.edit', compact('employe', 'departements'));
    }

    /**
     * Mettre à jour un employé.
     */
    public function update(UpdateEmployeRequest $request, Employe $employe)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            // Supprimer l'ancienne photo
            if ($employe->photo) {
                Storage::disk('public')->delete($employe->photo);
            }

            $data['photo'] = $request->file('photo')->store('employes', 'public');
        }

        $employe->update($data);

        return redirect()
            ->route('employes.index')
            ->with('success', 'Employé mis à jour avec succès.');
    }

    /**
     * Supprimer un employé.
     */
    public function destroy(Employe $employe)
    {
        // Supprimer la photo
        if ($employe->photo) {
            Storage::disk('public')->delete($employe->photo);
        }

        $employe->delete();

        return redirect()
            ->route('employes.index')
            ->with('success', 'Employé supprimé avec succès.');
    }
}
