@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Liste des biens</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAddBien">
        + Ajouter un bien
    </button>

    {{-- Toggle view --}}
    <div class="btn-group mb-3" role="group">
        <button id="btnList" type="button" class="btn btn-outline-primary active">Liste</button>
        <button id="btnCards" type="button" class="btn btn-outline-primary">Cards</button>
    </div>

    {{-- LISTE --}}
    <div id="view-list">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Titre</th>
                    <th>Propriétaire</th>
                    <th>Prix</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($biens as $bien)
                <tr>
                    <td>{{ $bien->id }}</td>
                    <td>{{ $bien->titre }}</td>
                    <td>{{ $bien->proprietaire->name." ".$bien->proprietaire->surname }}</td>
                    <td>{{ number_format($bien->prix, 2, ',', ' ') }} FCFA</td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bienModal{{ $bien->id }}">
                            👁 Voir
                        </button>

                        @if($bien->attributions->isEmpty())
                            <button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editBienModal{{ $bien->id }}">
                                ✏️ Modifier
                            </button>
                            <form action="{{ route('admin.biens.destroy', $bien->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce bien ?')">🗑 Supprimer</button>
                            </form>
                        @else
                            <span class="badge bg-success p-1">Déjà Attribué</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- CARDS --}}
    <div id="view-cards" class="row g-4 d-none">
        @foreach($biens as $bien)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100 animate__animated animate__fadeInUp">
                    
                    {{-- Galerie réduite dans la card --}}
                    <div class="row g-1 p-2">

                        @php
                            $medias = $bien->medias ?? collect();
                            // On limite à 4 miniatures dans la card
                            $mediasPreview = $medias->take(4);
                        @endphp

                        @if($bien->image)
                            <img src="{{ asset('storage/'.$bien->image) }}" class="card-img-top" alt="Image du bien">
                        @elseif($mediasPreview->count() > 0)
                            @foreach($mediasPreview as $media)
                                <div class="col-6">
                                    @if($media->type === 'image')
                                        <img src="{{ asset('storage/' . $media->path) }}" 
                                             class="img-fluid rounded shadow-sm"
                                             style="height:100px; object-fit:cover; width:100%;">
                                    @elseif($media->type === 'video')
                                        <video class="img-fluid rounded shadow-sm" style="height:100px; object-fit:cover; width:100%;" muted>
                                            <source src="{{ asset('storage/' . $media->path) }}" type="video/mp4">
                                        </video>
                                    @endif
                                </div>
                            @endforeach
    
                            {{-- Si plus de 4 médias, badge " +X " --}}
                            @if($medias->count() > 4)
                                <div class="col-6 d-flex align-items-center justify-content-center bg-dark text-white rounded" style="height:100px;">
                                    +{{ $medias->count() - 4 }}
                                </div>
                            @endif
                        @else
                            {{-- Placeholder si aucun média --}}
                            <img src="https://via.placeholder.com/400x250?text=Aucune+image" 
                                 class="card-img-top rounded-top" 
                                 alt="Image du bien">
                        @endif
                    </div>
    
                    {{-- Contenu de la card --}}
                    <div class="card-body">
                        <h5 class="card-title">{{ $bien->titre }}</h5>
                        <p class="mb-1"><strong>Propriétaire :</strong> {{ $bien->proprietaire->name." ".$bien->proprietaire->surname }}</p>
                        <p class="mb-1"><strong>Prix :</strong> {{ number_format($bien->prix, 2, ',', ' ') }} FCFA</p>
                        <button class="btn btn-info btn-sm mt-2" data-bs-toggle="modal" data-bs-target="#bienModal{{ $bien->id }}">
                            👁 Voir
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    

    @foreach($biens as $bien)
        @include('admin.biens.partials._show_modal', ['bien' => $bien])
        @include('admin.biens.partials._edit_modal', ['bien' => $bien, 'proprietaires' => $proprietaires])
    @endforeach

    
</div>

<script>
    const btnList = document.getElementById('btnList');
    const btnCards = document.getElementById('btnCards');
    const viewList = document.getElementById('view-list');
    const viewCards = document.getElementById('view-cards');

    btnList.addEventListener('click', () => {
        viewList.classList.remove('d-none');
        viewCards.classList.add('d-none');
        btnList.classList.add('active');
        btnCards.classList.remove('active');
    });

    btnCards.addEventListener('click', () => {
        viewList.classList.add('d-none');
        viewCards.classList.remove('d-none');
        btnCards.classList.add('active');
        btnList.classList.remove('active');
    });
</script>

@endsection
