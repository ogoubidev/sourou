@extends('layouts.app')

@section('content')
<section class="login-section" style="background-color: #e5f0ff; min-height: 100vh; display: flex; align-items: flex-start; padding-top: 80px; padding-bottom: 50px;">
  <div class="container">
    <div class="row justify-content-center align-items-center shadow rounded" style="background: #fff; border-radius: 12px; overflow: hidden;">
      
      
      <div class="col-lg-6 p-5">
        <h2 class="text-center mb-3" style="font-weight: 600;">Connexion Client</h2>
        <p class="text-center text-muted mb-4">Entrez vos informations pour vous connecter</p>

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

            {{-- Lien mot de passe oublié --}}

            <div class="text-center">
                <a href="{{ route('client.password.request') }}" class="text-primary">Mot de passe oublié ?</a>
            </div>
        </form> 
      </div>


      <!-- Partie droite : Image -->
      <div class="col-lg-6 d-none d-lg-block p-0">
        <img src="{{ asset('assets/images/client_login.png') }}" alt="Illustration" style="width: 100%; height: 100%; object-fit: cover;">
      </div>
    </div>
  </div>
</section>
@endsection











