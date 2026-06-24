@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Vue d\'ensemble de vos ressources humaines')

@section('content')
{{-- Statistics Cards --}}
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    {{-- Total Employés --}}
    <div class="stat-card animate-in">
        <div class="stat-icon" style="background-color: var(--color-primary-light);">
            <svg style="color: var(--color-primary);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
        </div>
        <div>
            <p class="stat-value">{{ $totalEmployes }}</p>
            <p class="stat-label">Employés</p>
        </div>
    </div>

    {{-- Total Départements --}}
    <div class="stat-card animate-in">
        <div class="stat-icon" style="background-color: var(--color-secondary-light);">
            <svg style="color: var(--color-secondary);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
            </svg>
        </div>
        <div>
            <p class="stat-value">{{ $totalDepartements }}</p>
            <p class="stat-label">Départements</p>
        </div>
    </div>

    {{-- Salaire Moyen --}}
    <div class="stat-card animate-in">
        <div class="stat-icon" style="background-color: var(--color-success-light);">
            <svg style="color: var(--color-success);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <div>
            <p class="stat-value">{{ $totalEmployes > 0 ? number_format(\App\Models\Employe::avg('salaire'), 0, ',', ' ') : '0' }}</p>
            <p class="stat-label">Salaire moyen (MAD)</p>
        </div>
    </div>

    {{-- Nouveaux ce mois --}}
    <div class="stat-card animate-in">
        <div class="stat-icon" style="background-color: var(--color-warning-light);">
            <svg style="color: var(--color-warning);" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
        </div>
        <div>
            <p class="stat-value">{{ \App\Models\Employe::whereMonth('created_at', now()->month)->whereYear('created_at', now()->year)->count() }}</p>
            <p class="stat-label">Nouveaux ce mois</p>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    {{-- Chart: Répartition par département --}}
    <div class="card lg:col-span-2 animate-in">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-base font-bold" style="color: var(--color-text);">Répartition par département</h3>
                <p class="text-xs mt-0.5" style="color: var(--color-text-light);">Nombre d'employés par département</p>
            </div>
            <div class="badge-primary badge">
                <svg class="w-3.5 h-3.5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                Graphique
            </div>
        </div>
        <div style="height: 300px;">
            <canvas id="departementChart"></canvas>
        </div>
    </div>

    {{-- Derniers employés ajoutés --}}
    <div class="card animate-in">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-base font-bold" style="color: var(--color-text);">Derniers employés</h3>
                <p class="text-xs mt-0.5" style="color: var(--color-text-light);">5 derniers ajoutés</p>
            </div>
            <a href="{{ route('employes.index') }}" class="text-xs font-semibold" style="color: var(--color-primary);">
                Voir tout →
            </a>
        </div>

        <div class="space-y-4">
            @forelse($derniersEmployes as $employe)
                <a href="{{ route('employes.show', $employe) }}" class="flex items-center gap-3 p-3 rounded-xl transition-colors hover:bg-gray-50 group">
                    <img src="{{ $employe->photo_url }}" alt="{{ $employe->nom_complet }}" class="avatar avatar-md">
                    <div class="flex-1 min-w-0">
                        <p class="text-sm font-semibold truncate" style="color: var(--color-text);">{{ $employe->nom_complet }}</p>
                        <p class="text-xs truncate" style="color: var(--color-text-light);">{{ $employe->fonction }}</p>
                    </div>
                    <span class="badge badge-primary text-xs hidden sm:inline-flex">{{ $employe->departement->nom ?? '—' }}</span>
                </a>
            @empty
                <div class="text-center py-8">
                    <p class="text-sm" style="color: var(--color-text-lighter);">Aucun employé pour le moment</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const ctx = document.getElementById('departementChart');
    if (!ctx) return;

    const labels = @json($chartLabels);
    const data = @json($chartData);

    const colors = [
        '#2563EB', '#4F46E5', '#7C3AED', '#EC4899',
        '#F59E0B', '#16A34A', '#06B6D4', '#EF4444',
        '#8B5CF6', '#14B8A6'
    ];

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Employés',
                data: data,
                backgroundColor: colors.slice(0, labels.length),
                borderRadius: 8,
                borderSkipped: false,
                barPercentage: 0.65,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1E293B',
                    titleFont: { family: 'Inter', size: 13, weight: '600' },
                    bodyFont: { family: 'Inter', size: 12 },
                    padding: 12,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            return context.parsed.y + ' employé(s)';
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: {
                        font: { family: 'Inter', size: 11, weight: '500' },
                        color: '#94A3B8',
                    },
                    border: { display: false }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: '#F1F5F9' },
                    ticks: {
                        font: { family: 'Inter', size: 11 },
                        color: '#94A3B8',
                        stepSize: 1,
                    },
                    border: { display: false }
                }
            }
        }
    });
});
</script>
@endsection
