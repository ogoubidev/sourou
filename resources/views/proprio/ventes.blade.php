@extends('layouts.proprietaire')

@section('title', 'Mes ventes')

@section('content')
<div class="container mt-3">
    <h4 class="mb-3">Mes ventes</h4>

    @if($ventes->isEmpty())
        <div class="text-center my-5">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png"
                 alt="Aucune vente"
                 style="width:150px; height:150px;">
            <p class="mt-2 text-muted">Aucune vente pour le moment.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Client</th>
                        <th>Bien vendu</th>
                        <th>Montant</th>
                        <th>Date</th>
                        <th>Mode de paiement</th>
                        <th>Statut</th>
                        <th>Preuve</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventes as $vente)
                        <tr>
                            <td>{{ $vente->id }}</td>
                            <td>{{ $vente->user->name ?? '-' }} {{ $vente->user->surname ?? '' }}</td>
                            <td>{{ $vente->bien->titre ?? '-' }}</td>
                            <td>{{ number_format($vente->montant, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $vente->created_at->format('d/m/Y H:i') }}</td>
                            <td>{{ ucfirst($vente->mode_paiement) }}</td>
                            <td>
                                @if($vente->statut == 'reussi')
                                    <span class="badge bg-success">Réussi</span>
                                @elseif($vente->statut == 'en_attente')
                                    <span class="badge bg-warning text-dark">En attente</span>
                                @else
                                    <span class="badge bg-danger">Échoué</span>
                                @endif
                            </td>
                            <td>
                                @if($vente->proof_path)
                                    <a href="{{ asset('storage/' . $vente->proof_path) }}" 
                                       class="btn btn-sm btn-primary" 
                                       target="_blank">Voir</a>
                                @else
                                    <span class="text-muted">Aucune</span>
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
