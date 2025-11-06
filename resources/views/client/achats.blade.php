@extends('layouts.client')

@section('title', 'Mes achats')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4 fw-bold" style="color: #005078;">Mes Achats</h3>

    @if($achats->isEmpty())
        <div class="text-center mt-5">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" 
                 alt="Aucun achat" style="width:200px; height:200px;">
            <p class="mt-3 text-muted">Aucun achat pour le moment.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Bien</th>
                        <th>Montant</th>
                        <th>Date d’achat</th>
                        <th>Mode de paiement</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($achats as $achat)
                        <tr>
                            <td>{{ $achat->id }}</td>
                            <td>{{ $achat->bien->titre ?? '—' }}</td>
                            <td>{{ number_format($achat->montant, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $achat->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ ucfirst($achat->mode_paiement) }}</td>
                            <td>
                                @if($achat->statut == 'reussi')
                                    <span class="badge bg-success">Réussi</span>
                                @elseif($achat->statut == 'en_attente')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @else
                                    <span class="badge bg-danger">Échoué</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
