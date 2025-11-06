@extends('layouts.proprietaire')

@section('title', 'Mes Dépenses')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between">
        <h4 class="mb-4">Mes Dépenses</h4>

        {{-- Toggle view --}}
        <div class="btn-group mb-3" role="group">
            <button id="btnList" type="button" class="btn btn-outline-primary active">Liste</button>
            <button id="btnCards" type="button" class="btn btn-outline-primary">Cards</button>
        </div>
    </div>

    {{-- LISTE --}}
    <div id="view-list" class="table-responsive">
        <table class="table table-hover table-sm table-middle">
            <thead>
                <tr>
                    <th>Bien</th>
                    <th>Type</th>
                    <th>Montant</th>
                    <th>Date</th>
                    <th>Prestataire</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @foreach($depenses as $depense)
                <tr>
                    <td>{{ $depense->bien->titre ?? '-' }}</td>
                    <td>{{ ucfirst($depense->type) }}</td>
                    <td>{{ number_format($depense->montant, 2, ',', ' ') }} FCFA</td>
                    <td>{{ \Carbon\Carbon::parse($depense->date_depense)->format('d/m/Y') }}</td>
                    <td>{{ $depense->prestataire ?? '-' }}</td>
                    <td>{{ $depense->description ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- CARDS --}}
    <div id="view-cards" class="row g-4 d-none">
        @foreach($depenses as $depense)
        @php
            $bien = $depense->bien;
            $medias = $bien->medias ?? collect();
            $mediasPreview = $medias->take(4);
        @endphp
        <div class="col-md-4">
            <div class="card shadow-sm border-0 h-100 animate__animated animate__fadeInUp">

                {{-- Image / preview --}}
                @if($bien && $bien->image)
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
                    <img src="https://via.placeholder.com/400x250?text=Aucune+image" class="card-img-top rounded-top" alt="Aucune image">
                @endif

                <div class="card-body">
                    <h5 class="card-title">{{ $bien->titre ?? 'Bien inconnu' }}</h5>
                    <p class="mb-1"><strong>Type :</strong> {{ ucfirst($depense->type) }}</p>
                    <p class="mb-1"><strong>Montant :</strong> {{ number_format($depense->montant, 2, ',', ' ') }} FCFA</p>
                    <p class="mb-1"><strong>Date :</strong> {{ \Carbon\Carbon::parse($depense->date_depense)->format('d/m/Y') }}</p>
                    <p class="mb-1"><strong>Prestataire :</strong> {{ $depense->prestataire ?? '-' }}</p>
                    <p class="mb-1"><strong>Description :</strong> {{ $depense->description ?? '-' }}</p>
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
