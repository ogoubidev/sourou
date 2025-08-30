@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Modifier le bien</h2>

    <form action="{{ route('admin.biens.update', $bien->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="titre" class="form-label">Titre</label>
            <input type="text" name="titre" class="form-control" value="{{ old('titre', $bien->titre) }}" required>
        </div>

        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" name="adresse" class="form-control" value="{{ old('adresse', $bien->adresse) }}" required>
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" name="prix" class="form-control" value="{{ old('prix', $bien->prix) }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select name="type" class="form-select" required>
                <option value="vente" {{ $bien->type == 'vente' ? 'selected' : '' }}>Vente</option>
                <option value="location" {{ $bien->type == 'location' ? 'selected' : '' }}>Location</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="proprietaire_id" class="form-label">Propriétaire</label>
            <select name="proprietaire_id" class="form-select" required>
                @foreach($proprietaires as $proprio)
                    <option value="{{ $proprio->id }}" {{ $bien->proprietaire_id == $proprio->id ? 'selected' : '' }}>
                        {{ $proprio->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Mettre à jour</button>
        <a href="{{ route('admin.biens.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
