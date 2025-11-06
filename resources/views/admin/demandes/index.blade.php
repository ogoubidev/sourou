@extends('layouts.admin')

@section('title', 'Demandes de location')

@section('content')
<div class="container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <a href="{{ route('admin.demandes.historique') }}" class="btn btn-secondary btn-sm flex-direction-row justify-content-end">
        Historique des demandes
    </a>

    @if($demandes->isEmpty())
        <div class="empty-state">
            <h4 class="mb-2">Demandes de location</h4>
            <center>
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucune transaction" style="width:200px; height: 200px;">
                <p>Aucune demande de location non approuvé pour l'instant.</p>
            </center>
        </div>
    @else
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="mb-2">Demandes récentes</h4>
        </div>
        <div class="table-responsive">
            <table class="table table-hover table-sm table-middle table-striped table-bordered">
                <thead class="table-primary">
                    <tr>
                        <th>#</th>
                        <th>Bien</th>
                        <th>Client</th>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Statut</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($demandes as $demande)
                        <tr>
                            <td>{{ $demande->id }}</td>
                            <td>{{ $demande->bien->titre }}</td>
                            <td>{{ $demande->user->name }} {{ $demande->user->surname }}</td>
                            <td>{{ $demande->date_debut->format('d/m/Y') }}</td>
                            <td>{{ $demande->date_fin->format('d/m/Y') }}</td>
                            <td>
                                @if($demande->statut === 'en_attente')
                                    <span class="badge bg-warning">En attente</span>
                                @elseif($demande->statut === 'approuve')
                                    <span class="badge bg-success">Approuvée</span>
                                @endif
                            </td>
                            <td>
                                @if($demande->statut === 'en_attente')
                                    <!-- Bouton pour ouvrir modal -->
                                    <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#approuverModal{{ $demande->id }}">
                                        Approuver
                                    </button>
    
                                    <!-- Modal -->
                                    <div class="modal fade" id="approuverModal{{ $demande->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form action="{{ route('admin.demandes.approuver', $demande) }}" method="POST">
                                            @csrf
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Approuver la demande</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Bien : <strong>{{ $demande->bien->titre }}</strong></p>
                                                    <p>Client : <strong>{{ $demande->user->name }} {{ $demande->user->surname }}</strong></p>
                                                    <div class="mb-3">
                                                        <label for="loyer_mensuel_{{ $demande->id }}" class="form-label">Loyer mensuel</label>
                                                        <input type="number" name="loyer_mensuel" id="loyer_mensuel_{{ $demande->id }}" class="form-control" required min="100">
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    {{--  On désactive le boutton si la demande à déjà été approuvé une fois --}}
                                                    <button type="submit" class="btn btn-success" 
                                                        onclick="this.disabled=true; this.form.submit();">
                                                        Valider
                                                    </button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
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