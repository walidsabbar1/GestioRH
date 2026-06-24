<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartementRequest;
use App\Http\Requests\UpdateDepartementRequest;
use App\Models\Departement;
use Illuminate\Http\JsonResponse;

class DepartementController extends Controller
{
    public function index(): JsonResponse
    {
        $departements = Departement::withCount('employes')->latest()->get();

        return response()->json([
            'success' => true,
            'data' => $departements,
        ]);
    }

    public function show(Departement $departement): JsonResponse
    {
        $departement->loadCount('employes');

        return response()->json([
            'success' => true,
            'data' => $departement,
        ]);
    }

    public function store(StoreDepartementRequest $request): JsonResponse
    {
        $departement = Departement::create($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Département créé avec succès.',
            'data' => $departement,
        ], 201);
    }

    public function update(UpdateDepartementRequest $request, Departement $departement): JsonResponse
    {
        $departement->update($request->validated());

        return response()->json([
            'success' => true,
            'message' => 'Département mis à jour avec succès.',
            'data' => $departement,
        ]);
    }

    public function destroy(Departement $departement): JsonResponse
    {
        $departement->delete();

        return response()->json([
            'success' => true,
            'message' => 'Département supprimé avec succès.',
        ]);
    }
}
