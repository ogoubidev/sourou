@extends('layouts.proprietaire')

@section('title', 'Mes Locataires')

@section('content')
<div class="container mt-4">
    <h4 class="mb-4">Mes Locataires</h4>

    @if($attributions->isEmpty())
        <div class="empty-state text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" 
                 alt="Aucun locataire" 
                 class="empty-img" 
                 style="width:100px; opacity:0.6;">
            <p>Aucun locataire pour le moment.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($attributions as $attribution)
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100 animate__animated animate__fadeInUp">
                        <div class="card-header bg-light d-flex justify-content-between card-primary">
                            <h5 class="card-title fw-bold" style="color: #005078 ">
                                {{ $attribution->client->name }} {{ $attribution->client->surname }}
                            </h5>
                            <h4><i class="bi bi-person-circle fw-bold" style="color: #005078 "></i></h4>
                        </div>

                        <div class="card-body">
                            <p class="mb-1"><strong>Bien loué :</strong> {{ $attribution->bien->titre }}</p>
                            <p class="mb-1"><strong>Dates de location :</strong> 
                                {{ $attribution->date_debut->format('d/m/Y') }} - {{ $attribution->date_fin->format('d/m/Y') }}
                            </p>
                            <p class="mb-1"><strong>Loyer mensuel :</strong> 
                                {{ number_format($attribution->loyer_mensuel ?? 0, 2, ',', ' ') }} FCFA
                            </p>
                        
                            {{-- Statuts --}}
                            @if($attribution->status === 'active')
                                <span class="badge" style="background: #005078 ">Active</span>
                            @elseif ($attribution->status === 'à venir')
                                <span class="badge bg-primary">À venir</span>        
                            @elseif($attribution->status === 'terminee')
                                <span class="badge bg-dark">Terminée</span>
                            @endif
                        
                            @if($attribution->paiements_effectues == 0)
                                <span class="badge mt-2 bg-danger">Impayé</span>
                            @elseif($attribution->paiements_effectues >= $attribution->mois_total)
                                <span class="badge bg-success">Payé</span>
                            @else
                                <span class="badge bg-warning">En cours</span>
                            @endif
                        
                            {{-- Boutons --}}
                            <div class="mt-3">
                                <a href="{{ route('proprietaire.locataires.contrat', $attribution->id) }}" 
                                   class="btn btn-outline-primary btn-sm">
                                   <i class="bi bi-file-earmark-pdf"></i> Contrat PDF
                                </a>
                        
                                <a href="{{ route('proprietaire.locataires.fiche', $attribution->id) }}" 
                                   class="btn btn-outline-secondary btn-sm">
                                   <i class="bi bi-person-vcard"></i> Fiche locataire
                                </a>
                        
                                <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bienModal{{ $attribution->bien->id }}">
                                    👁 Voir le bien
                                </button>
                            </div>
                        </div>
                        
                        
                    </div>
                </div>

                @include('admin.attributions.partials.modals', ['attribution' => $attribution])

                @if($attribution->bien)
                    @include('admin.biens.partials._show_modal', ['bien' => $attribution->bien])
                @endif
            @endforeach
        </div>
    @endif
</div>

<style>
    .card-body {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card-body:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 18px rgba(0,0,0,0.1);
    }
</style>
@endsection
