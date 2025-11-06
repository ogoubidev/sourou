@extends('layouts.admin')

@section('title', 'Transactions')

@section('content')
<div class="container mt-3">

    {{-- Messages succès --}}
    @if(session('success'))
        <div class="alert alert-success animate__animated animate__fadeIn">
            {{ session('success') }}
        </div>
    @endif

    {{-- Onglets Location / Vente --}}
    <div class="btn-group btn-group-toggle mb-3" data-bs-toggle="buttons" role="group">
        <button type="button" class="btn btn-outline-primary active" id="tab-location">Location</button>
        <button type="button" class="btn btn-outline-primary" id="tab-vente">Vente</button>
    </div>

    {{-- Section Location --}}
    <div id="section-location" class="scrollable-section">
        <h4>Transactions pour location</h4>

        @if($paiements->isEmpty())
            <div class="empty-state text-center my-3">
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucune transaction" style="width:200px; height: 200px;">
                <p>Aucune transaction pour le moment.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-sm table-striped table-bordered mt-2">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
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

    {{-- Section Vente --}}
    <div id="section-vente" class="scrollable-section d-none">
        <h4>Transactions pour vente</h4>

        @if($ventes->isEmpty())
            <div class="empty-state text-center my-3">
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucune transaction" style="width:200px; height: 200px;">
                <p>Aucune transaction pour le moment.</p>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover table-sm table-striped table-bordered mt-2">
                    <thead class="table-dark">
                        <tr>
                            <th>Id</th>
                            <th>Client</th>
                            <th>Bien</th>
                            <th>Montant</th>
                            <th>Date paiement</th>
                            <th>Mode</th>
                            <th>Statut</th>
                            <th>Preuve</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($ventes as $vente)
                            <tr>
                                <td>{{ $vente->id }}</td>
                                <td>{{ $vente->user->name ?? '—' }} {{ $vente->user->surname ?? '' }}</td>
                                <td>{{ $vente->bien->titre ?? '—' }}</td>
                                <td>{{ number_format($vente->montant, 0, ',', ' ') }} FCFA</td>
                                <td>{{ $vente->created_at->format('d/m/Y H:i') }}</td>
                                <td>{{ ucfirst($vente->mode_paiement) }}</td>
                                <td>{{ ucfirst($vente->statut) }}</td>
                                <td>
                                    @if(!empty($vente->proof_path))
                                        <a href="{{ route('admin.ventes.downloadProof', $vente->id) }}" class="btn btn-sm btn-primary">
                                            <i class="bi bi-download"></i> Télécharger
                                        </a>
                                    @else
                                        -
                                    @endif
                                </td>                                
                                <td>
                                    @if($vente->statut !== 'reussi')
                                    <form action="{{ route('admin.ventes.update', $vente->id) }}" method="POST">
                                        @csrf
                                        @method('PUT') <!-- ici PUT au lieu de PATCH -->
                                        <select name="statut" class="form-select form-select-sm mb-1">
                                            <option value="en_attente" {{ $vente->statut == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                            <option value="reussi" {{ $vente->statut == 'reussi' ? 'selected' : '' }}>Approuvé</option>
                                            <option value="echoue" {{ $vente->statut == 'echoue' ? 'selected' : '' }}>Échoué</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-success w-100">Mettre à jour</button>
                                    </form>                                    
                                    @else
                                        <span class="text-success fw-bold"> Validé</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabLocation = document.getElementById('tab-location');
        const tabVente = document.getElementById('tab-vente');
        const sectionLocation = document.getElementById('section-location');
        const sectionVente = document.getElementById('section-vente');

        tabLocation.addEventListener('click', () => {
            sectionLocation.classList.remove('d-none');
            sectionVente.classList.add('d-none');
            tabLocation.classList.add('active');
            tabVente.classList.remove('active');
        });

        tabVente.addEventListener('click', () => {
            sectionVente.classList.remove('d-none');
            sectionLocation.classList.add('d-none');
            tabVente.classList.add('active');
            tabLocation.classList.remove('active');
        });
    });
</script>

<style>
    .scrollable-section {
        max-height: 600px;
        overflow-y: auto;
        padding-bottom: 10px;
    }

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
</style>
@endsection


