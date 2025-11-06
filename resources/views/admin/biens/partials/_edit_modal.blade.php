<div class="modal fade" id="editBienModal{{ $bien->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content rounded-3 shadow-lg">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title">Modifier le bien : {{ $bien->titre }}</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.biens.update', $bien->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
  
            <div class="mb-3">
              <label for="titre{{ $bien->id }}" class="form-label">Titre du bien</label>
              <input type="text" name="titre" id="titre{{ $bien->id }}" class="form-control" value="{{ old('titre', $bien->titre) }}" required>
            </div>
  
            <div class="mb-3">
              <label for="description{{ $bien->id }}" class="form-label">Description</label>
              <textarea name="description" id="description{{ $bien->id }}" class="form-control">{{ old('description', $bien->description) }}</textarea>
            </div>
  
            <div class="mb-3">
              <label for="type{{ $bien->id }}" class="form-label">Type</label>
              <select name="type" id="type{{ $bien->id }}" class="form-select @error('type') is-invalid @enderror" required>
                <option value="" disabled {{ old('type', $bien->type) ? '' : 'selected' }}>-- Sélectionner --</option>
                <option value="vente" {{ old('type', $bien->type)=='vente' ? 'selected' : '' }}>Vente</option>
                <option value="location" {{ old('type', $bien->type)=='location' ? 'selected' : '' }}>Location</option>
              </select>
              @error('type') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
  
            <div class="mb-3">
              <label for="categorie{{ $bien->id }}" class="form-label">Catégorie</label>
              <select name="categorie" id="categorie{{ $bien->id }}" class="form-select @error('categorie') is-invalid @enderror" required>
                <option value="" disabled>-- Sélectionner --</option>
                @foreach(['maisons','parcelles','vehicules','mobilier','appartements'] as $cat)
                  <option value="{{ $cat }}" {{ old('categorie', $bien->categorie) == $cat ? 'selected' : '' }}>{{ ucfirst($cat) }}</option>
                @endforeach
              </select>
              @error('categorie') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label for="etat{{ $bien->id }}" class="form-label">État</label>
                <select name="etat" id="etat{{ $bien->id }}" class="form-select @error('etat') is-invalid @enderror" required>
                  <option value="" disabled>-- Sélectionner un état --</option>
                </select>
                @error('etat') <span class="invalid-feedback">{{ $message }}</span> @enderror
            </div>
              
  
            <div class="mb-3">
              <label for="adresse{{ $bien->id }}" class="form-label">Adresse</label>
              <input type="text" name="adresse" id="adresse{{ $bien->id }}" class="form-control" value="{{ old('adresse', $bien->adresse) }}">
            </div>
  
            <div class="mb-3">
              <label for="prix{{ $bien->id }}" class="form-label">Prix</label>
              <input type="number" step="0.01" name="prix" id="prix{{ $bien->id }}" class="form-control" value="{{ old('prix', $bien->prix) }}">
            </div>
  
            <div class="mb-3">
              <label for="proprietaire_id{{ $bien->id }}" class="form-label">Propriétaire</label>
              <select name="proprietaire_id" id="proprietaire_id{{ $bien->id }}" class="form-select" required>
                @foreach($proprietaires as $proprio)
                  <option value="{{ $proprio->id }}" {{ $bien->proprietaire_id == $proprio->id ? 'selected' : '' }}>
                    {{ $proprio->name }} {{ $proprio->surname }}
                  </option>
                @endforeach
              </select>
            </div>
  
            <!-- Médias existants -->
            <div class="mb-3">
              <label class="form-label">Médias existants</label>
              <div class="d-flex flex-wrap gap-2">
                @foreach($bien->medias as $media)
                  <div class="position-relative">
                    @if($media->type==='image')
                      <img src="{{ asset('storage/' . $media->path) }}" class="img-thumbnail" width="120">
                    @elseif($media->type==='video')
                      <video width="120" controls>
                        <source src="{{ asset('storage/' . $media->path) }}" type="video/mp4">
                      </video>
                    @endif
                    <input type="checkbox" name="delete_medias[]" value="{{ $media->id }}" class="form-check-input position-absolute top-0 end-0">
                  </div>
                @endforeach
              </div>
              <small class="text-muted">Cochez pour supprimer certains médias.</small>
            </div>
  
            <!-- Ajouter de nouveaux médias -->
            <div class="mb-3">
              <label for="medias{{ $bien->id }}" class="form-label">Ajouter de nouveaux médias</label>
              <input type="file" name="medias[]" id="medias{{ $bien->id }}" class="form-control" accept="image/*,video/*" multiple>
            </div>
  
            <div class="d-flex justify-content-end gap-2">
              <button type="submit" class="btn btn-primary">Mettre à jour</button>
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">⬅ Annuler</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  


  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Obtenir tous les modals de modification
      const modals = document.querySelectorAll('[id^="editBienModal"]');
    
      // États possibles selon catégorie
      const etatsOptions = {
              maisons: ['batie', 'inachevee', 'meuble', 'non_meuble'],
              appartements: ['meuble', 'non_meuble'],
              parcelles: ['terrain'],
              vehicules: ['neuf', 'occasion'],
              mobilier: ['meuble', 'non_meuble']
          };
    
      modals.forEach(modal => {
        const id = modal.id.replace('editBienModal', '');
        const categorieSelect = modal.querySelector(`#categorie${id}`);
        const etatSelect = modal.querySelector(`#etat${id}`);
    
        function updateEtatOptions(selectedEtat = null) {
          const cat = categorieSelect.value;
          etatSelect.innerHTML = '<option value="" disabled selected>-- Sélectionner un état --</option>';
    
          if (etatsOptions[cat]) {
            etatsOptions[cat].forEach(etat => {
              const option = document.createElement('option');
              option.value = etat;
              option.textContent = etat.charAt(0).toUpperCase() + etat.slice(1).replace('_', ' ');
              if (etat === selectedEtat) option.selected = true;
              etatSelect.appendChild(option);
            });
          }
        }
    
        // Charger au changement de catégorie
        categorieSelect.addEventListener('change', () => updateEtatOptions());
    
        // Initialiser avec la valeur actuelle du bien
        const currentEtat = "{{ old('etat', $bien->etat ?? '') }}";
        const currentCategorie = categorieSelect.value;
        if (currentCategorie) updateEtatOptions(currentEtat);
      });
    });
    </script>
    