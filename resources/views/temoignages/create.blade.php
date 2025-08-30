@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Ajouter un témoignage</h2>

    <form action="{{ route('temoignages.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Message --}}
        <div class="mb-3">
            <label for="message" class="form-label">Votre message</label>
            <textarea name="message" rows="4" class="form-control" required></textarea>
        </div>

        {{-- Note --}}
        <div class="mb-3">
            <label for="note" class="form-label">Votre note (1 à 5)</label>
            <input type="number" name="note" class="form-control" min="1" max="5" value="5" required>
        </div>

        {{-- Photo optionnelle --}}
        <div class="mb-3">
            <label for="photo" class="form-label">Votre photo (optionnelle)</label>
            <input type="file" name="photo" class="form-control">
        </div>

        {{-- Champs cachés (auto via Auth) --}}
        <input type="hidden" name="nom" value="{{ Auth::user()->nom }}">
        <input type="hidden" name="prenom" value="{{ Auth::user()->prenom }}">
        <input type="hidden" name="role" value="{{ Auth::user()->role }}">

        <button type="submit" class="btn btn-success">Envoyer</button>
    </form>
</div>
@endsection
