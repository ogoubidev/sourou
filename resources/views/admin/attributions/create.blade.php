@extends('layouts.admin')

@section('title', 'Nouvelle attribution')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4"> Nouvelle attribution</h2>

    <form action="{{ route('admin.attributions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="bien_id" class="form-label">Bien</label>
            <select name="bien_id" id="bien_id" class="form-control" required>
                <option value="">-- Choisir un bien --</option>
                @foreach($biens as $bien)
                    <option value="{{ $bien->id }}" data-proprietaire="{{ $bien->proprietaire->name }} ({{ $bien->proprietaire->telephone }})">
                        {{ $bien->titre }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Propriétaire (auto rempli selon le bien) --}}
        <div class="mb-3">
            <label class="form-label">Propriétaire</label>
            <input type="text" id="proprietaire_display" class="form-control" disabled>
            {{-- Champ caché pour envoyer l’ID du propriétaire en BDD --}}
            <input type="hidden" name="proprietaire_id" id="proprietaire_id">
        </div>

        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select name="client_id" id="client_id" class="form-control" required>
                <option value="">-- Choisir un client --</option>
                @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }} ({{ $client->telephone }})</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date_debut" class="form-label">Date de début de location</label>
            <input type="date" name="date_debut" id="date_debut" class="form-control">
        </div>

        <div class="mb-3">
            <label for="date_fin" class="form-label">Date de fin de location</label>
            <input type="date" name="date_fin" id="date_fin" class="form-control">
        </div>

        <div class="mb-3">
            <label for="loyer_mensuel" class="form-label">Loyer Mensuel</label>
            <input type="number" name="loyer_mensuel" id="loyer_mensuel" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('admin.attributions.index') }}" class="btn btn-secondary">⬅ Retour</a>
    </form>
</div>

{{-- Script pour auto-remplir propriétaire --}}
<script>
document.addEventListener("DOMContentLoaded", function() {
    let bienSelect = document.getElementById("bien_id");
    let proprietaireDisplay = document.getElementById("proprietaire_display");
    let proprietaireHidden = document.getElementById("proprietaire_id");

    bienSelect.addEventListener("change", function() {
        let selectedOption = bienSelect.options[bienSelect.selectedIndex];
        if (selectedOption.value) {
            proprietaireDisplay.value = selectedOption.getAttribute("data-proprietaire");
            
            proprietaireHidden.value = selectedOption.getAttribute("data-proprietaire-id");
        } else {
            proprietaireDisplay.value = "";
            proprietaireHidden.value = "";
        }
    });
});
</script>
@endsection
