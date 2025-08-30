@extends('layouts.admin')

@section('title', 'Transactions')

@section('content')
<div class="container mt-4">
    <h2>Transactions effectuées</h2>

    @if(session('success'))
        <div class="alert alert-success animate__animated animate__fadeIn">
            {{ session('success') }}
        </div>
    @endif

    @if($paiements->isEmpty())
        <div class="empty-state text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucune transaction" style="width:100px;">
            <p>Aucune transaction pour le moment.</p>
        </div>
    @else
        <table class="table table-striped table-bordered mt-3">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
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
                        <td>{{ $paiement->attribution->client->name ?? '—' }} {{ $paiement->attribution->client->surname ?? '' }}</td>
                        <td>{{ $paiement->attribution->bien->titre ?? '—' }}</td>
                        <td>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
                        <td>{{ $paiement->date_paiement->format('d/m/Y H:i') }}</td>
                        <td>{{ ucfirst($paiement->mode) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
