@extends('layouts.proprietaire')

@section('title', 'Historique des Loyers')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 fw-bold"> Historique des Loyers</h3>

    @if($paiements->isEmpty())
        <div class="text-center py-5">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" 
                 alt="Pas de paiement" 
                 style="width:120px; opacity:0.7;">
            <p class="mt-3 text-muted">Aucun paiement de loyer enregistré.</p>
        </div>
    @else
        <div class="table-responsive shadow-sm rounded">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Locataire</th>
                        <th>Bien</th>
                        <th>Montant</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paiements as $paiement)
                        <tr>
                            <td>{{ $paiement->attribution->client->name ?? '—' }}</td>
                            <td>{{ $paiement->attribution->bien->titre ?? '—' }}</td>
                            <td><strong>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</strong></td>
                            <td>
                                <span class="badge bg-{{ $paiement->statut == 'payé' ? 'success' : 'warning' }}">
                                    {{ ucfirst($paiement->statut) }}
                                </span>
                            </td>
                            <td>{{ $paiement->created_at->format('d/m/Y') }}</td>
                            <td>
                                <!-- Bouton modal -->
                                <button class="btn btn-sm btn-outline-primary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#detailsPaiement{{ $paiement->id }}">
                                    Voir détails
                                </button>
                            </td>
                        </tr>

                        <!-- Modal Détails -->
                        <div class="modal fade" id="detailsPaiement{{ $paiement->id }}" tabindex="-1">
                          <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content shadow-lg border-0 rounded">
                              <div class="modal-header bg-primary text-white">
                                <h5 class="modal-title">Détails du paiement</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                              </div>
                              <div class="modal-body">
                                <p><strong>Locataire :</strong> {{ $paiement->attribution->client->name ?? '—' }}</p>
                                <p><strong>Bien :</strong> {{ $paiement->attribution->bien->titre ?? '—' }}</p>
                                <p><strong>Montant :</strong> {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</p>
                                <p><strong>Statut :</strong> {{ ucfirst($paiement->statut) }}</p>
                                <p><strong>Date :</strong> {{ $paiement->created_at->format('d/m/Y') }}</p>
                                <p><strong>Heure :</strong> {{ $paiement->created_at->format('H:i:s') }}</p>
                                <p><strong>Méthode :</strong> {{ $paiement->methode ?? 'Non spécifié' }}</p>
                                <p><strong>Référence :</strong> {{ $paiement->reference ?? '—' }}</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>

<style>
.table {
    border-radius: .5rem;
    overflow: hidden;
}
.table th {
    font-weight: 600;
}
.badge {
    font-size: 0.9rem;
    padding: 0.4em 0.7em;
}
.modal-content {
    border-radius: .75rem;
}
</style>
@endsection
