@extends('layouts.app')

@section('title', 'Catalogue de Biens')

@section('content')

<link rel="stylesheet" href="{{ asset('css/catalogue.css') }}">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<section class="hero text-center py-5">
    <h1 class="fw-bold animate__animated animate__fadeInDown">Découvrez nos biens de luxe</h1>
    <p class="animate__animated animate__fadeInUp">Recherchez et filtrez vos biens pour en savoir plus...</p>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="search-box position-relative">
                    <i class="bi bi-search position-absolute top-50 translate-middle-y ms-3"></i>
                    <input type="text" id="searchInput" placeholder="Rechercher un bien..." class="form-control ps-5 rounded-pill chic-input">
                </div>
            </div>
        </div>
    </div>
</section>

<section class="filtres py-5">
    <div class="container">
        <div class="card shadow-sm border-0 rounded-4 p-3 mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h6 class="fw-bold text-secondary mb-0">Catégories</h6>
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-primary active" id="btn-grid"><i class="bi bi-grid-3x3-gap-fill"></i></button>
                    <button type="button" class="btn btn-outline-primary" id="btn-list"><i class="bi bi-list-ul"></i></button>
                </div>
            </div>
            <div class="d-flex flex-wrap gap-2" id="filterTabs">
                <button class="btn btn-outline-secondary active" data-target="tout">Tout</button>
                <button class="btn btn-outline-secondary" data-target="maisons">Maisons</button>
                <button class="btn btn-outline-secondary" data-target="parcelles">Parcelles</button>
                <button class="btn btn-outline-secondary" data-target="vehicules">Véhicules</button>
                <button class="btn btn-outline-secondary" data-target="mobilier">Mobilier</button>
            </div>
        </div>


        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif


        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif



        <div id="contentArea" class="row g-4">
          @forelse($biens as $bien)
              <div class="col-md-3 col-sm-6 mix {{ $bien->categorie }} animate__animated animate__fadeIn bien-grid" data-title="{{ strtolower($bien->titre) }}">
                  <div class="card shadow-sm h-100 border-0 rounded-4">
                      <div class="row g-1 p-2">
                          @php
                              $medias = $bien->medias ?? collect();
                              $mediasPreview = $medias->take(4);
                          @endphp
      
                          @if($bien->image)
                              <img src="{{ asset('storage/'.$bien->image) }}" 
                                   class="card-img-top rounded-top" 
                                   alt="Image du bien" 
                                   style="height:200px; object-fit:cover; width:100%;">
                          @elseif($mediasPreview->count() > 0)
                              @foreach($mediasPreview as $media)
                                  <div class="col-6">
                                      @if($media->type === 'image')
                                          <img src="{{ asset('storage/' . $media->path) }}" 
                                               class="img-fluid rounded shadow-sm"
                                               style="height:100px; object-fit:cover; width:100%;">
                                      @elseif($media->type === 'video')
                                          <video class="img-fluid rounded shadow-sm" 
                                                 style="height:100px; object-fit:cover; width:100%;" muted>
                                              <source src="{{ asset('storage/' . $media->path) }}" type="video/mp4">
                                          </video>
                                      @endif
                                  </div>
                              @endforeach
                              @if($medias->count() > 4)
                                  <div class="col-6 d-flex align-items-center justify-content-center bg-dark text-white rounded" style="height:100px;">
                                      +{{ $medias->count() - 4 }}
                                  </div>
                              @endif
                          @else
                              <img src="https://via.placeholder.com/400x250?text=Aucune+image" 
                                   class="card-img-top rounded-top" 
                                   alt="Aucune image">
                          @endif
                      </div>

                      <div class="card-body">
                          <h5 class="card-title">{{ $bien->titre }}</h5>
                          <p class="card-text text-muted">
                              <span class="badge bg-info">{{ ucfirst($bien->categorie) }}</span>
                              <span class="badge bg-secondary">{{ ucfirst($bien->type) }}</span>
                          </p>
                          <p class="fw-bold">{{ number_format($bien->prix, 0, ',', ' ') }} FCFA</p>
                          
                          @if($bien->statut === 'disponible')
                            <button 
                                class="btn btn-custom" 
                                data-bs-toggle="modal" 
                                data-bs-target="#louerModal"
                                onclick="document.querySelector('#louerForm').action='{{ route('client.biens.louer', $bien->id) }}';
                                        document.querySelector('#modalBienTitre').innerText='{{ $bien->titre }}';">
                                Louer
                            </button>
                          @else
                              @if($bien->attributions->last())
                                  <span class="badge bg-danger">
                                      Déjà loué jusqu’au {{ $bien->attributions->last()->date_fin->format('d/m/Y') }}
                                  </span>
                              @else
                                  <span class="badge bg-danger">Déjà loué</span>
                              @endif
                          @endif

                          <button class="btn btn-sm btn-custom mt-2" data-bs-toggle="modal" data-bs-target="#bienModal{{ $bien->id }}">
                              👁 Voir
                          </button>
                      </div>
                  </div>
              </div>
      
              {{-- Vue LISTE --}}
              <div class="col-12 bien-list d-none mix {{ $bien->categorie }} animate__animated animate__fadeIn" data-title="{{ strtolower($bien->titre) }}">
                  <div class="d-flex justify-content-between align-items-center p-3 mb-3 shadow-sm rounded-4 bg-white">
                      <div>
                          <strong>{{ $bien->titre }}</strong><br>
                          <small class="text-muted">
                              {{ ucfirst($bien->categorie) }} - {{ ucfirst($bien->type) }}
                          </small>
                      </div>
                      <div class="d-flex align-items-center gap-3">
                          <span class="fw-bold text-primary">{{ number_format($bien->prix, 0, ',', ' ') }} FCFA</span>
                          
                          @if($bien->statut === 'disponible')
                          <button 
                                class="btn btn-custom" 
                                data-bs-toggle="modal" 
                                data-bs-target="#louerModal"
                                onclick="document.querySelector('#louerForm').action='{{ route('client.biens.louer', $bien->id) }}';
                                        document.querySelector('#modalBienTitre').innerText='{{ $bien->titre }}';">
                                Louer
                           </button>
                      
                          @else
                              @if($bien->attributions->last())
                                  <span class="badge bg-danger">
                                      Déjà loué jusqu’au {{ $bien->attributions->last()->date_fin->format('d/m/Y') }}
                                  </span>
                              @else
                                  <span class="badge bg-danger">Déjà loué</span>
                              @endif
                          @endif

                          <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#bienModal{{ $bien->id }}">
                              Voir +
                          </button>
                      </div>
                  </div>
              </div>
          @empty
              <div class="col-12 text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucun article" class="empty-img">
                <p class="text-muted">Aucun bien disponible.</p>
              </div>
          @endforelse
      </div>
    </div>
</section>


@foreach($biens as $bien)
    @include('admin.biens.partials._show_modal', ['bien' => $bien])
@endforeach

<div class="modal fade" id="louerModal" tabindex="-1" aria-labelledby="louerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="louerForm" method="POST" action="{{ route('client.biens.louer', ['bien' => '__BIEN_ID__']) }}">
          @csrf
          <div class="modal-content">
              <div class="modal-header bg-custom text-white">
                  <h5 class="modal-title" id="louerModalLabel">Louer ce bien</h5>
                  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
              </div>
              <div class="modal-body">
                  <p id="modalBienTitre" class="fw-bold"></p>
                  <div class="mb-3">
                      <label for="date_debut" class="form-label">Date de début</label>
                      <input type="date" name="date_debut" class="form-control" required>
                  </div>
                  <div class="mb-3">
                      <label for="date_fin" class="form-label">Date de fin</label>
                      <input type="date" name="date_fin" class="form-control" required>
                  </div>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                  <button type="submit" class="btn btn-custom">Confirmer la location</button>
              </div>
          </div>
      </form>
    </div>
</div>
  
  
  



<script>
    // Filtrage par catégorie
    const filterButtons = document.querySelectorAll('#filterTabs button');
    const items = document.querySelectorAll('#contentArea .mix');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            filterButtons.forEach(b => b.classList.remove('active'));
            btn.classList.add('active');

            const target = btn.getAttribute('data-target');
            items.forEach(item => {
                if(target === 'tout' || item.classList.contains(target)){
                    item.style.display = '';
                    item.classList.add('animate__fadeIn');
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // Recherche par titre
    const searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', () => {
        const value = searchInput.value.toLowerCase();
        items.forEach(item => {
            const title = item.getAttribute('data-title');
            item.style.display = title.includes(value) ? '' : 'none';
        });
    });

    // Switch Grid/List
    const btnGrid = document.getElementById('btn-grid');
    const btnList = document.getElementById('btn-list');
    const gridItems = document.querySelectorAll('.bien-grid');
    const listItems = document.querySelectorAll('.bien-list');

    btnGrid.addEventListener('click', () => {
        btnGrid.classList.add('active');
        btnList.classList.remove('active');
        gridItems.forEach(item => item.classList.remove('d-none'));
        listItems.forEach(item => item.classList.add('d-none'));
    });

    btnList.addEventListener('click', () => {
        btnList.classList.add('active');
        btnGrid.classList.remove('active');
        gridItems.forEach(item => item.classList.add('d-none'));
        listItems.forEach(item => item.classList.remove('d-none'));
    });

</script>

<style>
    .btn-custom {
        background-color: #005078;
        color: white;
        border-radius: 10px;
    }
    .btn-custom:hover {
        background-color: #003d5c;
        color: white;
    }
    .bg-custom { background-color: #005078 !important; }
</style>

@endsection
