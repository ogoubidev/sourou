@extends('layouts.admin')

@section('title', 'Demandes de location')

@section('content')
<div class="container">
    <h2 class="mb-4">Demandes de location</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($demandes->isEmpty())
        <div class="empty-state">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucune demande">
            <p>Aucune demande de location pour le moment.</p>
        </div>
    @else
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
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
                                                <button type="submit" class="btn btn-success">Valider</button>
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
    @endif
</div>
@endsection
