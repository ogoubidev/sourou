@extends('layouts.proprietaire')

@section('title', 'Mes Locataires')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Mes Locataires</h2>

    @if($attributions->isEmpty())
        <div class="empty-state text-center">
            <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucun locataire" class="empty-img" style="width:100px; opacity:0.6;">
            <p>Aucun locataire pour le moment.</p>
        </div>
    @else
        <div class="row g-4">
            @foreach($attributions as $attribution)
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 h-100 animate__animated animate__fadeInUp">
                        <div class="card-body">
                            <h5 class="card-title">{{ $attribution->client->name }} {{ $attribution->client->surname }}</h5>
                            <p class="mb-1"><strong>Bien :</strong> {{ $attribution->bien->titre }}</p>
                            <p class="mb-1"><strong>Dates de location :</strong> {{ $attribution->date_debut->format('d/m/Y') }} - {{ $attribution->date_fin->format('d/m/Y') }}</p>
                            <p class="mb-1"><strong>Loyer mensuel :</strong> {{ number_format($attribution->loyer_mensuel ?? 0, 2, ',', ' ') }} FCFA</p>
                        </div>
                    </div>
                </div>
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
