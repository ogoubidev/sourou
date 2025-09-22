@extends('layouts.admin')

@section('title', 'Transactions')

@section('content')
<div class="container mt-1">
    <h4>Transactions effectuées</h4>

    @if(session('success'))
        <div class="alert alert-success animate__animated animate__fadeIn">
            {{ session('success') }}
        </div>
    @endif

    @if($paiements->isEmpty())
        <div class="empty-state text-center">
            <center>
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucune transaction" style="width:200px; height: 200px;">
                <p>Aucune transaction pour le moment.</p>
            </center>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-sm table-middle table-striped table-bordered mt-3">
                <thead class="table-dark">
                    <tr>
                        <th>Id_paiement</th>
                        <th>Attribution n°</th>
                        <th>Client</th>
                        <th>Bien</th>
                        <th>Montant</th>
                        <th>Date paiement</th>
                        <th>Mode</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($paiements as $paiement)
                        <tr>
                            <td>{{ $paiement->id }}</td>
                            <td>{{ $paiement->attribution->id }}</td>
                            <td>{{ $paiement->attribution->client->name ?? '—' }} {{ $paiement->attribution->client->surname ?? '' }}</td>
                            <td>{{ $paiement->attribution->bien->titre ?? '—' }}</td>
                            <td>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $paiement->date_paiement->format('d/m/Y H:i') }}</td>
                            <td>{{ ucfirst($paiement->mode) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection




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