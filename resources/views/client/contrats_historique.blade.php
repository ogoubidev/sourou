@extends('layouts.client')

@section('title', 'Historique des demandes')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-2 text-light">Mes contrats payés</h4>
        <a href="{{ route('client.contrats') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-box-arrow-left"></i> Retour à la liste des contrats
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-sm table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#id</th>
                    <th>Bien</th>
                    <th>Proprietaire</th>
                    <th>Date_début</th>
                    <th>Date_fin</th>
                    <th>Montant payé</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($attributionsPayees as $att_paye )
                    <tr>
                        <td>{{ $att_paye->id }}</td>
                        <td>{{ $att_paye->bien->titre }}</td>
                        <td>{{ $att_paye->bien->proprietaire->name }} {{ $att_paye->bien->proprietaire->surname }}</td>
                        <td>{{ $att_paye->date_debut }}</td>
                        <td>{{ $att_paye->date_fin }}</td>
                        <td>{{ $att_paye->loyer_mensuel * $att_paye->mois_total }}</td>
                    </tr>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            Aucun paiement trouvé pour l’instant.
                        </div>
                    </div>
                @endforelse()
            </tbody>
        </table>
    </div>
</div>

<style>
    table {
        min-width: 750px;
    }

    thead td {
        padding: 10px;
    }

    tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    tbody tr:nth-child(even) {
        background-color: #e9ecef;
    }

    tbody tr:hover {
        background-color: rgba(0, 80, 120, 0.6);
        color: #000;
        font-weight: bold;
        cursor: pointer;
    }


    @media (max-width: 768px) {
    table {
        font-size: 14px;
    }
    thead td, tbody td {
        padding: 6px 8px;
    }

    .identifiant {
        display: none;
    }

    .action {
        flex-direction: column;
       flex: 2;
    }
}
</style>
@endsection
