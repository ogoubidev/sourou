@extends('layouts.admin')

@section('title', 'Liste des attributions')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Liste des attributions</h2>

    <div class="d-flex justify-content-between mb-3">
        <a href="{{ route('admin.attributions.create') }}" class="btn btn-primary">Nouvelle attribution</a>

        <div class="btn-group" role="group" aria-label="Affichage">
            <button type="button" class="btn btn-outline-primary active" id="btn-list">Liste</button>
            <button type="button" class="btn btn-outline-primary" id="btn-cards">Cards</button>
        </div>
    </div>

    {{-- Tableau des attributions --}}
    <div id="view-list">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#Id</th>
                    <th>Bien</th>
                    <th>Propriétaire</th>
                    <th>Client</th>
                    <th>Date de liaison</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attributions as $attribution)
                    <tr>
                        <td>{{ $attribution->id }}</td>
                        <td>{{ $attribution->bien->titre ?? '—' }}</td>
                        <td>{{ $attribution->bien->proprietaire->name." ".$attribution->bien->proprietaire->surname ?? '—' }}</td>
                        <td>{{ $attribution->client->name." ".$attribution->client->surname ?? '—' }}</td>
                        <td>{{ $attribution->created_at->format('d/m/Y H:i') }}</td>
                        <td> 
                            @if($attribution->status === 'active')
                                <span class="badge bg-success">Active</span>
                                <form action="{{ route('admin.attributions.terminer', $attribution->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn btn-sm btn-warning">Mettre un terme</button>
                                </form>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bienModal{{ $attribution->bien->id }}">
                                    👁 Voir
                                </button>                                
                            @elseif($attribution->status === 'terminee')
                                <span class="badge bg-secondary">Terminée</span>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bienModal{{ $attribution->bien->id }}">
                                    👁 Voir
                                </button>                                
                            @else
                                <span class="badge bg-info">À venir</span>
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bienModal{{ $attribution->bien->id }}">
                                    👁 Voir
                                </button>                                
                            @endif
                        </td>                        
                    </tr>
                @empty
                        <td colspan="6" class="text-center">Aucune attribution trouvée</td>                   
                @endforelse
            </tbody>
        </table>
    </div>

    @foreach($attributions as $attribution)
    @if($attribution->bien)
        @include('admin.biens.partials._show_modal', ['bien' => $attribution->bien])
        @endif
    @endforeach


    <div id="view-cards" class="row g-4" style="display:none;">
        @forelse($attributions as $attribution)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100 animate__animated animate__fadeInUp">
                    
                    {{-- Galerie réduite du bien attribué --}}
                    <div class="row g-1 p-2">
                        @php
                            $medias = $attribution->bien?->medias ?? collect();
                            $mediasPreview = $medias->take(4);
                        @endphp
    
                        @if($attribution->bien?->image)
                            <img src="{{ asset('storage/'.$attribution->bien->image) }}" 
                                 class="card-img-top rounded-top" 
                                 alt="Image principale du bien">
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
    
                            {{-- Badge si plus de 4 médias --}}
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
    
                    {{-- Contenu de la card --}}
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $attribution->bien->titre ?? 'Bien sans titre' }}</h5>
                        <p class="mb-1"><strong>Propriétaire :</strong> {{ $attribution->bien?->proprietaire?->name }} {{ $attribution->bien?->proprietaire?->surname }}</p>
                        <p class="mb-1"><strong>Client :</strong> {{ $attribution->client?->name }} {{ $attribution->client?->surname }}</p>
                        <p class="mb-1"><strong>Date attribution :</strong> {{ $attribution->created_at->format('d/m/Y') }}</p>
                        <p class="mb-1"><strong>Loyer mensuel :</strong> {{ number_format($attribution->loyer_mensuel ?? 0, 0, ',', ' ') }} FCFA</p>

                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bienModal{{ $attribution->bien->id }}">
                            👁 Voir le bien
                        </button>     
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">Aucune attribution trouvée</p>
        @endforelse
    </div>
    
</div>

{{-- Script pour basculer entre Liste et Cards --}}
<script>
    const btnList = document.getElementById('btn-list');
    const btnCards = document.getElementById('btn-cards');
    const viewList = document.getElementById('view-list');
    const viewCards = document.getElementById('view-cards');

    btnList.addEventListener('click', () => {
        viewList.style.display = '';
        viewCards.style.display = 'none';
        btnList.classList.add('active');
        btnCards.classList.remove('active');
    });

    btnCards.addEventListener('click', () => {
        viewList.style.display = 'none';
        viewCards.style.display = '';
        btnCards.classList.add('active');
        btnList.classList.remove('active');
    });
</script>
@endsection
