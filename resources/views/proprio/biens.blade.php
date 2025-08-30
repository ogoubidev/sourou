@extends('layouts.proprietaire')

@section('title', 'Mes Biens')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Mes Biens</h2>

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
                    <th>Prix</th>
                    <th>Statut</th>
                    <th>Rendue</th>
                </tr>
            </thead>
            <tbody>
                @foreach($biens as $bien)
                <tr>
                    <td>{{ $bien->id }}</td>
                    <td>{{ $bien->titre }}</td>
                    <td>{{ number_format($bien->prix, 2, ',', ' ') }} FCFA</td>
                    <td>
                        @if($bien->statut === 'disponible')
                            <span class="badge bg-success">Disponible</span>
                        @else
                            <span class="badge bg-warning text-dark">Attribué</span>
                        @endif
                    </td>
                    <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bienModal{{ $bien->id }}">
                            👁 Voir
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @foreach($biens as $bien)
        @include('admin.biens.partials._show_modal', ['bien' => $bien])
    @endforeach

    {{-- CARDS --}}
    <div id="view-cards" class="row g-4 d-none">
        @foreach($biens as $bien)
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 animate__animated animate__fadeInUp">
                {{-- Media preview --}}
                @php
                    $medias = $bien->medias ?? collect();
                    $mediasPreview = $medias->take(4);
                @endphp

                @if($bien->image)
                    <img src="{{ asset('storage/'.$bien->image) }}" class="card-img-top" alt="Image du bien">
                @elseif($mediasPreview->count() > 0)
                    <div class="row g-1 p-2">
                        @foreach($mediasPreview as $media)
                            <div class="col-6">
                                @if($media->type === 'image')
                                    <img src="{{ asset('storage/' . $media->path) }}" class="img-fluid rounded shadow-sm" style="height:100px; object-fit:cover; width:100%;">
                                @elseif($media->type === 'video')
                                    <video class="img-fluid rounded shadow-sm" style="height:100px; object-fit:cover; width:100%;" muted>
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
                    </div>
                @else
                    <img src="https://via.placeholder.com/400x250?text=Aucune+image" class="card-img-top rounded-top" alt="Image du bien">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $bien->titre }}</h5>
                    <p class="mb-1"><strong>Prix :</strong> {{ number_format($bien->prix, 2, ',', ' ') }} FCFA</p>
                    <p class="mb-1"><strong>Statut :</strong> {{ ucfirst($bien->statut) }}</p>
                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bienModal{{ $bien->id }}">
                        👁 Voir
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
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
