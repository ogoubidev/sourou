@extends('layouts.admin')

@section('title', 'Modifier Signalement')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold">Modifier le signalement #{{ $signalement->id }}</h3>

    <form action="{{ route('admin.signalements.update', $signalement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Statut</label>
            <select name="statut" class="form-select">
                <option value="en_attente" {{ $signalement->statut === 'en_attente' ? 'selected' : '' }}>En attente</option>
                <option value="en_cours" {{ $signalement->statut === 'en_cours' ? 'selected' : '' }}>En cours</option>
                <option value="resolu" {{ $signalement->statut === 'resolu' ? 'selected' : '' }}>Résolu</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Réponse admin</label>
            <textarea name="reponse_admin" class="form-control" rows="4">{{ $signalement->reponse_admin }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('admin.signalements.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
