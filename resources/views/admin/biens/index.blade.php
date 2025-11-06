
@extends('layouts.admin')

@section('content')
<div class="container mt-1">
    <h4 class="mb-2">Liste des biens</h4>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="justify-content-between ">
            <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#modalAddBien">
                + Ajouter un bien
            </button>
    
        {{-- Toggle view --}}
        <div class="btn-group mb-3" role="group">
            <button id="btnList" type="button" class="btn btn-outline-primary active">Liste</button>
            <button id="btnCards" type="button" class="btn btn-outline-primary">Cards</button>
        </div>
    </div>

    {{-- LISTE --}}
    <div id="view-list">
        <div class="table-responsive">
            <table class="table table-hover align-middle w-100">
                <thead class="table-primary">
                    <tr>
                        <th class="identifiant">Id</th>
                        <th>Titre</th>
                        <th>Categorie</th>
                        <th>Propriétaire</th>
                        <th>Prix</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($biens as $bien)
                    <tr>
                        <td class="identifiant">{{ $bien->id }}</td>
                        <td>{{ $bien->titre }}</td>
                        <td>{{ $bien->categorie }}</td>
                        <td>{{ $bien->proprietaire->name." ".$bien->proprietaire->surname }}</td>
                        <td>{{ number_format($bien->prix, 2, ',', ' ') }} FCFA</td>
                        <td class="action">
                            <button class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#bienModal{{ $bien->id }}">
                                👁 Voir
                            </button>

                            @if($bien->statut === 'disponible')
                                <button class="btn btn-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#editBienModal{{ $bien->id }}">
                                    ✏️ Modifier
                                </button>
                                <form action="{{ route('admin.biens.destroy', $bien->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Voulez-vous vraiment supprimer ce bien ?')">🗑 Supprimer</button>
                                </form>
                            @else                                
                                <span class="badge bg-danger p-1">Déjà Attribué</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
                        <p class="mb-1"><strong>Catégorie: </strong>{{ $bien->categorie }}</p>
                        <p class="mb-1"><strong>Propriétaire :</strong> {{ $bien->proprietaire->name." ".$bien->proprietaire->surname }}</p>
                        <p class="mb-1"><strong>Prix :</strong> {{ number_format($bien->prix, 2, ',', ' ') }} FCFA</p>
                        <button class="btn btn-info btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#bienModal{{ $bien->id }}">
                            👁 Voir
                        </button>

                        @if($bien->statut === 'disponible')
                            <button class="btn btn-warning btn-sm mb-1" data-bs-toggle="modal" data-bs-target="#editBienModal{{ $bien->id }}">
                                ✏️ Modifier
                            </button>
                            <form action="{{ route('admin.biens.destroy', $bien->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm mb-1" onclick="return confirm('Voulez-vous vraiment supprimer ce bien ?')">🗑 Supprimer</button>
                            </form>
                        @else                                
                            <span class="badge bg-danger p-1">Déjà Attribué</span>
                        @endif
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

<style>
        table {
            min-width: 750px;
        }

        thead td {
            padding: 10px;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody tr:nth-child(even) {
            background-color: #e9ecef;
        }

        tbody tr:hover {
            background-color: rgba(0, 80, 120, 0.6);
            color: #000;
            font-weight: bold;
            cursor: pointer;
        }


        @media (max-width: 768px) {
        table {
            font-size: 14px;
        }
        thead td, tbody td {
            padding: 6px 8px;
        }

        .identifiant {
            display: none;
        }

        .action {
            flex-direction: column;
           flex: 2;
        }
    }
</style>