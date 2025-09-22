@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
        
        </div>
        <div class="col-md-3">
            <h3 class="text-center mb-4">Réinitialiser le mot de passe</h3>

            @if (session('status'))
                <div class="alert alert-success">{{ session('status') }}</div>
            @endif
        
            <form method="POST" action="{{ route('proprietaire.password.phone') }}">
                @csrf
                <div class="mb-3">
                    <label for="telephone" class="form-label">Numéro de téléphone</label>
                    <input id="telephone" type="text" class="form-control @error('telephone') is-invalid @enderror" 
                           name="telephone" required autofocus>
                    @error('telephone')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
        
                <button type="submit" class="btn btn-primary w-100">Envoyer le lien</button>
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection
