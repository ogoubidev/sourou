@extends('layouts.client')

@section('content')
<div class="container mt-4">

    

    <div class="d-flex justify-content-between mb-3">
        <h2 class="mb-4 fw-bold text-light">Mes Contrats</h2>
        <div class="btn-group" role="group">
            <button type="button" class="btn btn-outline-light active" id="btn-list">Liste</button>
            <button type="button" class="btn btn-outline-light" id="btn-cards">Cards</button>
        </div>
    </div>

    @php
        $attributions = $attributions ?? collect();
    @endphp

    {{-- Vue liste --}}
    <div id="view-list">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#Id</th>
                    <th>Bien</th>
                    <th>Propriétaire</th>
                    <th>Date début</th>
                    <th>Date fin</th>
                    <th>Loyer mensuel</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($attributions as $attribution)
                    <tr>
                        <td>{{ $attribution->id }}</td>
                        <td>{{ $attribution->bien->titre ?? '—' }}</td>
                        <td>{{ $attribution->bien->proprietaire->name ?? '—' }} {{ $attribution->bien->proprietaire->surname ?? '' }}</td>
                        <td>{{ $attribution->date_debut ? $attribution->date_debut->format('d/m/Y') : '—' }}</td>
                        <td>{{ $attribution->date_fin ? $attribution->date_fin->format('d/m/Y') : '—' }}</td>
                        <td>{{ number_format($attribution->loyer_mensuel ?? 0, 0, ',', ' ') }} FCFA</td>
                        <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bienModal{{ $attribution->bien->id }}">
                                👁 Voir le bien
                            </button>     
                            <button type="button" 
                                    class="btn btn-success btn-sm mt-1"
                                    id="pay-btn-{{ $attribution->id }}" 
                                    data-montant="{{ $attribution->loyer_mensuel }}">
                                  Payer le loyer
                            </button>

                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Aucun contrat trouvé</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @foreach($attributions as $attribution)
    @if($attribution->bien)
        @include('admin.biens.partials._show_modal', ['bien' => $attribution->bien])
        @endif
    @endforeach

    {{-- Vue cards --}}
    <div id="view-cards" class="row g-4" style="display:none;">
        @forelse($attributions as $attribution)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100 animate__animated animate__fadeInUp">
    
                    {{-- Galerie réduite --}}
                    <div class="row g-1 p-2">
                        @php
                            $medias = $attribution->bien?->medias ?? collect();
                            $mediasPreview = $medias->take(4);
                        @endphp
    
                        @if($attribution->bien?->image)
                            <img src="{{ asset('storage/'.$attribution->bien->image) }}" 
                                 class="card-img-top rounded-top" alt="Image principale">
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
                                 class="card-img-top rounded-top" alt="Aucune image">
                        @endif
                    </div>
    
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $attribution->bien->titre ?? 'Bien sans titre' }}</h5>
                        <p class="mb-1"><strong>Propriétaire :</strong> {{ $attribution->bien?->proprietaire?->name }} {{ $attribution->bien?->proprietaire?->surname }}</p>
                        <p class="mb-1"><strong>Date début :</strong> {{ optional($attribution->date_debut)->format('d/m/Y') }}</p>
                        <p class="mb-1"><strong>Loyer :</strong> {{ number_format($attribution->loyer_mensuel ?? 0, 0, ',', ' ') }} FCFA</p>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bienModal{{ $attribution->bien->id }}">
                            👁 Voir le bien
                        </button> 
                            {{-- Bouton Payer via Fedapay --}}
                            <button type="button" 
                            class="btn btn-success btn-sm mt-1" 
                            id="pay-btn-{{ $attribution->id }}" 
                            data-montant="{{ $attribution->loyer_mensuel }}">
                          Payer le loyer
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted text-center">Aucun contrat trouvé</p>
        @endforelse
    </div>
    

</div>

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


<script src="https://cdn.fedapay.com/checkout.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    @foreach($attributions as $attribution)
        {
            let btnElement = document.getElementById('pay-btn-{{ $attribution->id }}');
            if(btnElement){
                let montant = parseInt(btnElement.getAttribute('data-montant'));
                console.log("Montant pour contrat #{{ $attribution->id }}:", montant);

                FedaPay.init('#pay-btn-{{ $attribution->id }}', {
                    public_key: 'pk_live_yV2KhV_Yl-pw54zAt4ugq8wb',
                    transaction: {
                        amount: montant,
                        description: 'Paiement du loyer - Contrat #{{ $attribution->id }}'
                    }
                });
            }
        }
    @endforeach
});
</script>



@endsection
