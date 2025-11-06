@extends('layouts.client')

@section('title', 'Détails du signalement')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold text-primary">Détails du signalement</h3>

    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="card-title">{{ ucfirst($signalement->categorie ?? 'Autre') }}</h5>
            <p class="card-text">{{ $signalement->description }}</p>
            <p>
                <strong>Statut :</strong> {{ ucfirst($signalement->statut) }}
            </p>
            @if($signalement->reponse_admin)
                <p>
                    <strong>Réponse de l'admin :</strong> {{ $signalement->reponse_admin }}
                </p>
            @endif
        </div>
        <div class="card-footer text-end">
            <a href="{{ route('client.signalements.index') }}" class="btn btn-secondary">Retour</a>
        </div>
    </div>
</div>
@endsection
