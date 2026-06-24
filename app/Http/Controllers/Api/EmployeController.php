<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeRequest;
use App\Http\Requests\UpdateEmployeRequest;
use App\Models\Employe;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class EmployeController extends Controller
{
    public function index(): JsonResponse
    {
        $employes = Employe::with('departement')->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $employes,
        ]);
    }

    public function show(Employe $employe): JsonResponse
    {
        $employe->load('departement');

        return response()->json([
            'success' => true,
            'data' => $employe,
        ]);
    }

    public function store(StoreEmployeRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('employes', 'public');
        }

        $employe = Employe::create($data);
        $employe->load('departement');

        return response()->json([
            'success' => true,
            'message' => 'Employé créé avec succès.',
            'data' => $employe,
        ], 201);
    }

    public function update(UpdateEmployeRequest $request, Employe $employe): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            if ($employe->photo) {
                Storage::disk('public')->delete($employe->photo);
            }
            $data['photo'] = $request->file('photo')->store('employes', 'public');
        }

        $employe->update($data);
        $employe->load('departement');

        return response()->json([
            'success' => true,
            'message' => 'Employé mis à jour avec succès.',
            'data' => $employe,
        ]);
    }

    public function destroy(Employe $employe): JsonResponse
    {
        if ($employe->photo) {
            Storage::disk('public')->delete($employe->photo);
        }

        $employe->delete();

        return response()->json([
            'success' => true,
            'message' => 'Employé supprimé avec succès.',
        ]);
    }
}
