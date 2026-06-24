<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Models\Employe;

class DashboardController extends Controller
{
    public function index()
    {
        $totalEmployes = Employe::count();
        $totalDepartements = Departement::count();
        $derniersEmployes = Employe::with('departement')
            ->latest()
            ->take(5)
            ->get();

        // Répartition des employés par département
        $repartition = Departement::withCount('employes')
            ->orderBy('employes_count', 'desc')
            ->get();

        $chartLabels = $repartition->pluck('nom');
        $chartData = $repartition->pluck('employes_count');

        return view('dashboard', compact(
            'totalEmployes',
            'totalDepartements',
            'derniersEmployes',
            'chartLabels',
            'chartData'
        ));
    }
}
