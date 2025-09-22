@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Mot de passe oublié</h3>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('client.password.send-temp') }}">
        @csrf
        <div class="mb-3">
            <label for="telephone" class="form-label">Numéro de téléphone</label>
            <input type="number" name="telephone" id="telephone" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Envoyer le mot de passe temporaire</button>
    </form>
</div>
@endsection
