@extends('layouts.client')

@section('content')
<div class="container mt-4">


    <div class="d-flex justify-content-between mb-3">
        <h4 class="mb-0 fw-bold text-light">Mes Contrats</h4>
        <h6>
            <a href="{{ route('client.contrats_payes.historique') }}" class="btn btn-dark flex-direction-row">
                Contrats payés
            </a>
        </h6>
    </div>
    
    <div class="btn-group text-end mb-3" role="group">
        <button type="button" class="btn btn-outline-light active" id="btn-list">Liste</button>
        <button type="button" class="btn btn-outline-light" id="btn-cards">Cards</button>
    </div>

    @php
        $attributions = $attributions ?? collect();
    @endphp

    {{-- Vue liste --}}
    <div id="view-list" class="table-responsive">
        <table class="table table-bordered table-striped  table-hover table-sm table-middle">
            <thead class="table-primary">
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
                                👁 Voir
                            </button>     
                        
                            @if($attribution->statut_paiement != 'paye')
                            <button type="button"
                                    class="btn btn-danger btn-sm mt-1 pay-btn"
                                    id="pay-btn-{{ $attribution->id }}"
                                    data-id="{{ $attribution->id }}"
                                    data-montant="{{ $attribution->loyer_mensuel }}">
                                Payer le loyer ({{ $attribution->paiements_effectues }}/{{ $attribution->mois_total }})
                            </button>
                            @else
                                <span class="badge bg-success">Payé</span>
                            @endif
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
                            👁 Voir
                        </button>

                        @if($attribution->statut_paiement != 'paye')
                        <button type="button"
                                class="btn btn-danger btn-sm mt-1 pay-btn"
                                id="pay-btn-{{ $attribution->id }}"
                                data-id="{{ $attribution->id }}"
                                data-montant="{{ $attribution->loyer_mensuel }}">
                            Payer le loyer ({{ $attribution->paiements_effectues }}/{{ $attribution->mois_total }})
                        </button>
                        @else
                            <span class="badge bg-success">Payé</span>
                        @endif
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
            let btn = document.getElementById('pay-btn-{{ $attribution->id }}');
            if(btn){
                let montant = parseInt(btn.getAttribute('data-montant'));
                let attributionId = btn.getAttribute('data-id');
    
                FedaPay.init('#pay-btn-{{ $attribution->id }}', {
                    public_key: 'pk_live_yV2KhV_Yl-pw54zAt4ugq8wb',
                    transaction: {
                        amount: montant,
                        description: 'Paiement du loyer - Contrat #{{ $attribution->id }}'
                    },
    
                    onComplete: function(response) {
                        if(response.reason === 'CHECKOUT COMPLETE'){
                            fetch("{{ route('client.paiements.store') }}", {
                                method: "POST",
                                headers: {
                                    "Content-Type": "application/json",
                                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                },
                                body: JSON.stringify({
                                    attribution_id: attributionId,
                                    montant: montant
                                })
                            })
                            .then(res => res.json())
                            .then(data => {
                                if(data.success){
                                    // Mettre à jour le bouton directement
                                    if(data.paiements_effectues >= {{ $attribution->mois_total }}){
                                        btn.outerHTML = '<span class="badge bg-success mt-1">Payé</span>';
                                    } else {
                                        btn.textContent = `Payer le loyer (${data.paiements_effectues}/{{ $attribution->mois_total }})`;
                                    }
    
                                    alert("Paiement enregistré avec succès");
                                }
                            })
                            .catch(err => console.error("Erreur fetch:", err));
                        }
                    }
                });
            }
        }
        @endforeach
    });
    </script>

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
    

@endsection
