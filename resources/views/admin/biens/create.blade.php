@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Ajouter un bien</h2>

    <form action="{{ route('admin.biens.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
    
        <div class="mb-3">
            <label for="titre" class="form-label">Titre du bien</label>
            <input type="text" name="titre" id="titre" class="form-control" required>
        </div>
    
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>
    
        <div class="mb-3">
            <label for="adresse" class="form-label">Adresse</label>
            <input type="text" name="adresse" id="adresse" class="form-control">
        </div>
    
        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input type="number" step="0.01" name="prix" id="prix" class="form-control">
        </div>
    
        <div class="mb-3">
            <label for="proprietaire_id" class="form-label">Propriétaire</label>
            <select name="proprietaire_id" id="proprietaire_id" class="form-select" required>
                @foreach($proprietaires as $proprietaire)
                    <option value="{{ $proprietaire->id }}">{{ $proprietaire->name }} {{ $proprietaire->surname }}</option>
                @endforeach
            </select>
        </div>
    
        <div class="mb-3">
            <label for="medias" class="form-label">Médias du bien (images ou vidéos)</label>
            <input type="file" name="medias[]" id="medias" class="form-control" accept="image/*,video/*" multiple>
            <small class="text-muted">Vous pouvez ajouter plusieurs images ou une vidéo (formats mp4, mov, avi).</small>
        </div>
    
        <button type="submit" class="btn btn-success"> Enregistrer</button>
        <a href="{{ route('admin.biens.index') }}" class="btn btn-secondary">⬅ Retour</a>
    </form>
</div>
@endsection
