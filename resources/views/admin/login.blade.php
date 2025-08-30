@extends('layouts.app')

@section('content')
<section class="login-section" style="background-color: #e5f0ff; min-height: 100vh; display: flex; align-items: flex-start; padding-top: 80px; padding-bottom: 50px;">
  <div class="container">
    <div class="row justify-content-center align-items-center shadow rounded" style="background: #fff; border-radius: 12px; overflow: hidden;">

      <!-- Partie gauche : Formulaire -->
      <div class="col-lg-6 p-5">
        <h2 class="text-center mb-3" style="font-weight: 600; color: #005078;">Connexion Administrateur</h2>
        <p class="text-center text-muted mb-4">Entrez vos informations pour vous connecter</p>

        <form method="POST" action="{{ route('admin.login.submit') }}">
          @csrf

          {{-- Email --}}
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
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
          <div class="d-grid mb-3">
            <button type="submit" class="btn btn-primary" style="background-color: #005078; border-color: #005078;">
                Se connecter
            </button>
          </div>

          <div class="text-center">
            <a href="{{ route('admin.password.change') }}" class="text-primary">Mot de passe oublié ?</a>
          </div>
        </form>
      </div>

      <div class="col-lg-6 d-none d-lg-block p-0">
        <img src="{{ asset('assets/images/admin.jpeg') }}" alt="Illustration Admin" style="width: 100%; height: 100%; object-fit: cover;">
      </div>

    </div>
  </div>
</section>
@endsection
