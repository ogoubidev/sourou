@extends('layouts.admin')

@section('title', 'Historique des demandes')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-2">Historique des demandes</h4>
        <a href="{{ route('admin.demandes.index') }}" class="btn btn-primary btn-sm">
            ⬅ Retour aux demandes en attente
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-sm table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Bien</th>
                    <th>Client</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Statut</th>
                    <th>Date approbation</th>
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

                            {{-- @php
                                $attributions = $demande->
                            @endphp

                            @forelse($attributions as $attribution)
                                @if($attribution->status === 'active')
                                    <span class="badge bg-success mb-1">Active</span>
                                @elseif ($attribution->status === 'à venir')
                                    <span class="badge bg-primary mb-1">A venir</span>  
                                @elseif($attribution->status === 'terminee')
                                    <span class="badge bg-secondary mb-1">Terminée</span>
                                @endif
                            @endforelse --}}
                        </td>
                        <td>
                            {{ $demande->statut === 'approuve' ? $demande->updated_at->format('d/m/Y H:i') : '-' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
