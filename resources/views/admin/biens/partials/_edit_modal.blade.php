
<div class="modal fade" id="editBienModal{{ $bien->id }}" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="container mt-4">
        <h2>Modifier un bien</h2>

        <form action="{{ route('admin.biens.update', $bien->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="titre" class="form-label">Titre du bien</label>
                <input type="text" name="titre" id="titre" class="form-control" 
                      value="{{ old('titre', $bien->titre) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $bien->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type</label>
                <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                    <option value="" disabled {{ old('type') ? '' : 'selected' }}>-- Sélectionner --</option>
                    <option value="vente" {{ old('type')=='vente' ? 'selected' : '' }}>Vente</option>
                    <option value="location" {{ old('type')=='location' ? 'selected' : '' }}>Location</option>
                </select>
                @error('type')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="categorie" class="form-label">Catégorie</label>
                <select name="categorie" id="categorie" class="form-select @error('categorie') is-invalid @enderror" required>
                    <option value="" disabled {{ old('categorie') ? '' : 'selected' }}>-- Sélectionner une catégorie --</option>
                    <option value="maisons" {{ old('categorie')=='maisons' ? 'selected' : '' }}>Maisons</option>
                    <option value="parcelles" {{ old('categorie')=='parcelles' ? 'selected' : '' }}>Parcelles</option>
                    <option value="vehicules" {{ old('categorie')=='vehicules' ? 'selected' : '' }}>Véhicules</option>
                    <option value="mobilier" {{ old('categorie')=='mobilier' ? 'selected' : '' }}>Mobilier</option>
                </select>
                @error('categorie')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="adresse" class="form-label">Adresse</label>
                <input type="text" name="adresse" id="adresse" class="form-control"
                      value="{{ old('adresse', $bien->adresse) }}">
            </div>

            <div class="mb-3">
                <label for="prix" class="form-label">Prix</label>
                <input type="number" step="0.01" name="prix" id="prix" class="form-control"
                      value="{{ old('prix', $bien->prix) }}">
            </div>

            <div class="mb-3">
                <label for="proprietaire_id" class="form-label">Propriétaire</label>
                <select name="proprietaire_id" id="proprietaire_id" class="form-select" required>
                    @foreach($proprietaires as $proprietaire)
                        <option value="{{ $proprietaire->id }}" 
                            {{ $bien->proprietaire_id == $proprietaire->id ? 'selected' : '' }}>
                            {{ $proprietaire->name }} {{ $proprietaire->surname }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- Médias existants --}}
            <div class="mb-3">
                <label class="form-label">Médias existants</label>
                <div class="d-flex flex-wrap gap-2">
                    @foreach($bien->medias as $media)
                        @if($media->type === 'image')
                            <div class="position-relative">
                                <img src="{{ asset('storage/' . $media->path) }}" class="img-thumbnail" width="120">
                                <input type="checkbox" name="delete_medias[]" value="{{ $media->id }}" class="form-check-input position-absolute top-0 end-0">
                            </div>
                        @elseif($media->type === 'video')
                            <div class="position-relative">
                                <video width="120" controls>
                                    <source src="{{ asset('storage/' . $media->path) }}" type="video/mp4">
                                </video>
                                <input type="checkbox" name="delete_medias[]" value="{{ $media->id }}" class="form-check-input position-absolute top-0 end-0">
                            </div>
                        @endif
                    @endforeach
                </div>
                <small class="text-muted">Cochez pour supprimer certains médias.</small>
            </div>

            {{-- Ajout de nouveaux médias --}}
            <div class="mb-3">
                <label for="medias" class="form-label">Ajouter de nouveaux médias</label>
                <input type="file" name="medias[]" id="medias" class="form-control" accept="image/*,video/*" multiple>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('admin.biens.index') }}" class="btn btn-secondary">⬅ Retour</a>
        </form>
      </div>
    </div>
  </div>
</div>




  