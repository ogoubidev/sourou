@extends('layouts.guest')

@section('content')
<div class="container mt-5">
    <h3 class="text-center mb-4">Changer mon mot de passe</h3>

    @if(session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif

    <form method="POST" action="{{ route('client.password.update') }}">
        @csrf
        <div class="mb-3">
            <label for="password" class="form-label">Nouveau mot de passe</label>
            <input id="password" name="password" type="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success w-100">Mettre à jour</button>
    </form>
</div>
@endsection
