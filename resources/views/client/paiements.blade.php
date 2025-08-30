@extends('layouts.client')

@section('title', 'Historique des paiements')

@section('content')
<div class="container">
    <h3 class="mb-4 text-white">💰 Historique de mes paiements</h3>

    <div class="row">
        @forelse($paiements as $paiement)
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow border-0 h-100">
                    <div class="card-body">
                        <h5 class="card-title text-primary">
                            {{ $paiement->bien->titre ?? 'Bien non défini' }}
                        </h5>
                        <p class="card-text">
                            <strong>Montant :</strong> {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA <br>
                            <strong>Période :</strong> {{ $paiement->mois }} / {{ $paiement->annee }} <br>
                            <strong>Statut :</strong> 
                            <strong>Statut :</strong> 
                            @if($paiement->status_paiement == 'paye')
                                <span class="badge bg-success">Payé</span>
                            @elseif($paiement->status_paiement == 'impaye')
                                <span class="badge bg-danger">Impayé</span>
                            @elseif($paiement->status_paiement == 'reste_a_payer')
                                <span class="badge bg-warning text-dark">Reste à payer</span>
                            @endif
                        </p>
                        <button class="btn btn-sm btn-outline-dark" 
                                data-bs-toggle="modal" 
                                data-bs-target="#detailsPaiement{{ $paiement->id }}">
                            Voir détails
                        </button>
                    </div>
                </div>
            </div>

            <!-- Modal détails -->
            <div class="modal fade" id="detailsPaiement{{ $paiement->id }}" tabindex="-1" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Détails du paiement</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                  </div>
                  <div class="modal-body">
                      <p><strong>Bien :</strong> {{ $paiement->bien->titre ?? '-' }}</p>
                      <p><strong>Montant :</strong> {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</p>
                      <p><strong>Période :</strong> {{ $paiement->mois }}/{{ $paiement->annee }}</p>
                      <p><strong>Date de paiement :</strong> {{ $paiement->created_at->format('d/m/Y H:i') }}</p>
                      <p><strong>Mode de paiement :</strong> {{ $paiement->mode ?? 'Non spécifié' }}</p>
                      <p><strong>Référence :</strong> {{ $paiement->reference ?? '-' }}</p>
                      <p><strong>Statut :</strong> 
                        <p><strong>Statut :</strong>
                            @if($paiement->status_paiement == 'paye')
                                ✅ Payé
                            @elseif($paiement->status_paiement == 'impaye')
                                ❌ Impayé
                            @elseif($paiement->status_paiement == 'reste_a_payer')
                                ⏳ Reste à payer
                            @endif
                        </p>                        
                      </p>
                  </div>
                  <div class="modal-footer">
                    <button class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                  </div>
                </div>
              </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    Aucun paiement trouvé pour l’instant.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
