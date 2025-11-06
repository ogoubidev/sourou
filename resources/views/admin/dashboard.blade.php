@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')


    <!-- Styles -->
    <style>
        .stat-card { transition: transform 0.2s ease, box-shadow 0.2s ease; }
        .stat-card:hover { transform: translateY(-5px); box-shadow: 0 6px 18px rgba(0,0,0,0.1); }
        .icon-circle { width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; }
        .empty-state img { width: 100px; opacity: 0.6; }


        @media (max-width: 768px) {
            .heure, .bi-icons {
                display: none;
            }
        }
    </style>


    @if (session('status'))
    <div class="alert alert-success mt-3">
        {{ session('status') }}
    </div>
    @endif

    <!-- Cartes statistiques -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 stat-card h-100">
                <div class="card-body text-center">
                    <div class="icon-circle bg-primary mb-3">
                        <i class="bi bi-people text-white"></i>
                    </div>
                    <h5 class="card-title">Propriétaires</h5>
                    <h3 class="fw-bold">{{ $nombreProprio }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 stat-card h-100">
                <div class="card-body text-center">
                    <div class="icon-circle bg-success mb-3">
                        <i class="bi bi-person text-white"></i>
                    </div>
                    <h5 class="card-title">Clients</h5>
                    <h3 class="fw-bold">{{ $nombreClients }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 stat-card h-100">
                <div class="card-body text-center">
                    <div class="icon-circle bg-info mb-3">
                        <i class="bi bi-file-earmark-text text-white"></i>
                    </div>
                    <h5 class="card-title">Biens</h5>
                    <h3 class="fw-bold">{{ $nombreBiens }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 stat-card h-100">
                <div class="card-body text-center">
                    <div class="icon-circle bg-warning mb-3">
                        <i class="bi bi-currency-dollar text-white"></i>
                    </div>
                    <h5 class="card-title">Transactions</h5>
                    <h3 class="fw-bold">{{ $nombreTransactions }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Graphes --}}

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light fw-bold">
                    Évolution des Locations (FCFA)
                </div>
                <div class="card-body">
                    <canvas id="locationChart" height="200"></canvas>
                </div>
            </div>
        </div>
    
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light fw-bold">
                    Évolution des Ventes (FCFA)
                </div>
                <div class="card-body">
                    <canvas id="venteChart" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    

    <div class="row g-4">
        <!-- Transactions récentes -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Transactions récentes</span>
                    @if($transactions->count() > 4)
                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#allTransactionsModal">
                            Voir plus
                        </button>
                    @endif
                </div>
                <div class="card-body">
                    @forelse($transactions->take(6) as $t)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <i class="bi bi-cash-coin text-success"></i>
                                <span class="fw-semibold" > {{ $t->montant }} FCFA</span> pour <span class="fw-semibold">{{ $t->attribution->bien->titre ?? 'Inconnu' }}</span> par <span class="fw-semibold">{{ $t->attribution->client->surname ?? 'Inconnu' }}</span>
                            </div>
                            <small class="text-muted heure">{{ $t->created_at->diffForHumans() }}</small>
                        </div>
                    @empty
                        <div class="empty-state text-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucune transaction" class="empty-img">
                            <p>Aucune transaction récente</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Attributions récentes -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Attributions récentes</span>
                    @if($attributions->count() > 4)
                        <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#allAttributionsModal">
                            Voir plus
                        </button>
                    @endif
                </div>
                <div class="card-body">
                    @forelse($attributions->take(6) as $a)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <div>
                                <i class="bi bi-house-door text-primary bi-icons"></i>
                                <span class="fw-semibold">{{ $a->bien->titre ?? 'Bien inconnu' }}</span> au client <span class="fw-semibold">{{ optional($a->client)->name.' '.optional($a->client)->surname ?? 'Inconnu' }}</span>
                            </div>                            
                            <small class="text-muted heure">{{ $a->created_at->diffForHumans() }}</small>
                        </div>
                    @empty
                        <div class="empty-state text-center">
                            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucune attribution" class="empty-img">
                            <p>Aucune attribution récente</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Transactions -->
    <div class="modal fade" id="allTransactionsModal" tabindex="-1" aria-labelledby="allTransactionsLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content rounded-4 shadow">
          <div class="modal-header bg-success text-white">
            <h5 class="modal-title" id="allTransactionsLabel">Toutes les transactions</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body p-0">
            <div class="list-group list-group-flush">
              @foreach($transactions as $t)
                <div class="list-group-item d-flex justify-content-between">
                    <div>
                        <i class="bi bi-cash text-success"></i>
                        {{ $t->montant }} FCFA - {{ $t->attribution->bien->titre ?? 'Inconnu' }} - {{ $t->attribution->client->name.' '.$t->attribution->client->surname ?? 'Inconnu' }}
                    </div>
                    <small class="text-muted">{{ $t->created_at->format('d/m/Y H:i') }}</small>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Modal Attributions -->
    <div class="modal fade" id="allAttributionsModal" tabindex="-1" aria-labelledby="allAttributionsLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content rounded-4 shadow">
          <div class="modal-header bg-primary text-white">
            <h5 class="modal-title" id="allAttributionsLabel">Toutes les attributions</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body p-0">
            <div class="list-group list-group-flush">
              @foreach($attributions as $a)
                <div class="list-group-item d-flex justify-content-between">
                    <div>
                        <i class="bi bi-house text-primary"></i>
                        {{ $a->bien->titre ?? 'Bien inconnu' }} - {{ $a->client->name ?? 'Client inconnu' }}
                    </div>
                    <small class="text-muted">{{ $a->created_at->format('d/m/Y H:i') }}</small>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const mois = @json($labels);
        const locationData = @json($locationTotals);
        const venteData = @json($venteTotals);

        // Graphique des Locations
        new Chart(document.getElementById('locationChart'), {
            type: 'line',
            data: {
                labels: mois,
                datasets: [{
                    label: 'Locations',
                    data: locationData,
                    borderColor: '#0d6efd',
                    backgroundColor: 'rgba(13, 110, 253, 0.2)',
                    tension: 0.3,
                    fill: true,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });

        // Graphique des Ventes
        new Chart(document.getElementById('venteChart'), {
            type: 'line',
            data: {
                labels: mois,
                datasets: [{
                    label: 'Ventes',
                    data: venteData,
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25, 135, 84, 0.2)',
                    tension: 0.3,
                    fill: true,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { display: false } },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
    </script>


@endsection
