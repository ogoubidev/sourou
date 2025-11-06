@extends('layouts.client')

@section('title', 'Dashboard')

@section('content')
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 stat-card h-100">
                <div class="card-body text-center">
                    <div class="icon-circle bg-primary mb-3">
                        <i class="bi bi-people text-white"></i>
                    </div>
                    <h5 class="card-title">Biens louées</h5>
                    <h3 class="fw-bold">{{ $nbBiensLoue }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm border-0 stat-card h-100">
                <div class="card-body text-center">
                    <div class="icon-circle bg-success mb-3">
                        <i class="bi bi-file-earmark-text text-white"></i>
                    </div>
                    <h5 class="card-title">Propriétaire</h5>
                    <h3 class="fw-bold">{{ $nbProprietaires }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Paiements de loyer récents</span>
                    @if($transactionsRecentes->count() > 5)
                        <div class="mt-2 text-end">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#paiementsModal">
                                <i class="bi bi-eye"></i> Voir plus
                            </button>
                        </div>
                    @endif    
                </div>
                <div class="card-body">
                    @if ($transactionsRecentes->isEmpty())
                        <center>
                            <div class="empty-state">
                                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucun paiement trouvé" class="empty-img">
                                <p>Aucun paiement trouvé</p>
                            </div>
                        </center>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($transactionsRecentes->take(5) as $paiement)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $paiement->attribution->client->name ?? '—' }} - 
                                    {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA
                                    <span class="badge bg-primary">{{ $paiement->created_at->format('d/m/Y') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Nouvelles locations de biens</span>
                    @if($attributionsRecentes->count() >= 5)
                        <div class="mt-2 text-end">
                            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#attributionsModal">
                                <i class="bi bi-eye"></i> Voir plus
                            </button>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    @if($attributionsRecentes->isEmpty())
                        <center>
                            <div class="empty-state">
                                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucun article" class="empty-img">
                                <p>Aucune location récentes</p>
                            </div>
                        </center>
                    @else
                        <ul class="list-group list-group-flush">
                            @foreach($attributionsRecentes as $att)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $att->bien->titre ?? '—' }} - 
                                    {{ number_format($att->loyer_mensuel, 0, ',', ' ') }} FCFA
                                    <span class="badge bg-primary text-end">{{ $att->created_at->format('d/m/y') }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="paiementsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tous les paiements de loyer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    @php
                        $clientId = Auth::id();
                        $paiements = \App\Models\Paiement::with(['attribution.bien'])
                            ->whereHas('attribution', fn($q) => $q->where('client_id', $clientId))
                            ->latest()
                            ->get();
                    @endphp

                    @if($paiements->isEmpty())
                        <center>
                            <div class="empty-state">
                                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" 
                                    alt="Aucun paiement trouvé" class="empty-img mb-3" width="100">
                                <p>Aucun paiement trouvé</p>
                            </div>
                        </center>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered align-middle">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Bien</th>
                                        <th>Montant</th>
                                        <th>Date du paiement</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paiements as $paiement)
                                        <tr>
                                            <td>{{ $paiement->attribution->bien->titre ?? '—' }}</td>
                                            <td>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                                            <td><span class="badge bg-primary">{{ $paiement->created_at->format('d/m/Y') }}</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="attributionsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tous les biens loués</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    @php
                        $clientId = Auth::id();
                        $attributions = \App\Models\Attribution::with(['bien.proprietaire'])
                            ->where('client_id', $clientId)
                            ->latest('date_debut')
                            ->get();
                    @endphp

                    @if($attributions->isEmpty())
                        <center>
                            <div class="empty-state">
                                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png"
                                    alt="Aucune location trouvée" class="empty-img mb-3" width="100">
                                <p>Aucune location trouvée</p>
                            </div>
                        </center>
                    @else
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered align-middle">
                                <thead class="table-primary">
                                    <tr>
                                        <th>Bien</th>
                                        <th>Propriétaire</th>
                                        <th>Loyer mensuel</th>
                                        <th>Période</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($attributions as $attrib)
                                        <tr>
                                            <td>{{ $attrib->bien->titre ?? '—' }}</td>
                                            <td>{{ $attrib->bien->proprietaire->name.' '.$attrib->bien->proprietaire->surname ?? '—' }}</td>
                                            <td>{{ number_format($attrib->loyer_mensuel, 0, ',', ' ') }} FCFA</td>
                                            <td>
                                                <span class="badge bg-secondary">
                                                    {{ $attrib->date_debut->format('d/m/Y') }}
                                                    au
                                                    {{ $attrib->date_fin?->format('d/m/Y') ?? '—' }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>






    <style>
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }
        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        .empty-state img {
            width: 100px;
            opacity: 0.6;
        }
    </style>


@endsection




