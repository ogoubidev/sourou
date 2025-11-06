@extends('layouts.client')

@section('title', 'Nouveau signalement')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold text-primary">Nouveau signalement</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('client.signalements.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie</label>
            <select name="categorie" id="categorie" class="form-select">
                <option value="">Autre</option>
                <option value="bug">Bug</option>
                <option value="paiement">Paiement</option>
                <option value="bien">Bien</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description du problème</label>
            <textarea name="description" id="description" rows="5" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
        <a href="{{ route('client.signalements.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
