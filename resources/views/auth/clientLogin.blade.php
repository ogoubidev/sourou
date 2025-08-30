
@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">

                <h2 class="mt-5">Connexion client</h2>

                <form method="POST" action="{{ route('client.login.submit') }}">
                    @csrf
            
                    {{-- Numéro de téléphone --}}
                    <div class="my-4">
                        <label for="telephone" class="form-label">Téléphone</label>
                        <input id="telephone" type="number" 
                                class="form-control @error('telephone') is-invalid @enderror" 
                                name="telephone" value="{{ old('telephone') }}" required autofocus>
                        @error('telephone')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
            
                    {{-- Mot de passe --}}
                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input id="password" type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                name="password" required>
            
                        @error('password')
                            <span class="invalid-feedback" role="alert">{{ $message }}</span>
                        @enderror
                    </div>
            
                    {{-- Se souvenir de moi --}}
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember">
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>
            
                    {{-- Bouton de connexion --}}
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Se connecter</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
@endsection














