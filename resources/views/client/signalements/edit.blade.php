@extends('layouts.client')

@section('title', 'Modifier le signalement')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold text-primary">Modifier le signalement</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('client.signalements.update', $signalement->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie</label>
            <select name="categorie" id="categorie" class="form-select">
                <option value="" {{ $signalement->categorie == null ? 'selected' : '' }}>Autre</option>
                <option value="bug" {{ $signalement->categorie == 'bug' ? 'selected' : '' }}>Bug</option>
                <option value="paiement" {{ $signalement->categorie == 'paiement' ? 'selected' : '' }}>Paiement</option>
                <option value="bien" {{ $signalement->categorie == 'bien' ? 'selected' : '' }}>Bien</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description du problème</label>
            <textarea name="description" id="description" rows="5" class="form-control" required>{{ old('description', $signalement->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('client.signalements.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
