@extends('layouts.app')

@section('content')
<section class="register-section" style="background-color: #e5f0ff; min-height: 100vh; display: flex; align-items: center; padding: 50px 0;">
  <div class="container">
    <div class="row justify-content-center align-items-center shadow rounded" style="background: #fff; border-radius: 12px; overflow: hidden; min-height: 500px;">
      
      <!-- Partie gauche : Formulaire -->
      <div class="col-lg-6 p-5">
        <h2 class="text-center mb-1" style="font-weight: 600;">Créer un compte</h2>
        <p class="text-center text-muted mb-4">Remplissez les informations suivantes pour vous inscrire</p>

        <div id="erreurs" class="alert alert-danger d-none"></div>

        <form action="{{ route('register') }}" method="post" enctype="multipart/form-data">
          @csrf
          
          <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Nom" value="{{ old('name') }}" required>
            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label for="surname" class="form-label">Prénom</label>
            <input type="text" id="surname" name="surname" class="form-control @error('surname') is-invalid @enderror" placeholder="Prénom" value="{{ old('surname') }}" required>
            @error('surname')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email professionnel" value="{{ old('email') }}">
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label for="telephone" class="form-label">Téléphone</label>
            <input type="number" name="telephone" id="telephone" class="form-control @error('telephone') is-invalid @enderror" placeholder="Votre numéro de téléphone" value="{{ old('telephone') }}" required>
            @error('telephone')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label for="mdp" class="form-label">Mot de passe</label>
            <input type="password" id="mdp" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe" required>
            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label for="confirm-mdp" class="form-label">Confirmer mot de passe</label>
            <input type="password" id="confirm-mdp" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirmez le mot de passe" required>
            @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input @error('terms') is-invalid @enderror" id="terms" name="terms" required>
            <label class="form-check-label" for="terms">J'accepte les conditions d'utilisation</label>
            @error('terms')<div class="text-danger">{{ $message }}</div>@enderror
          </div>

          <div class="mb-3">
            <label for="profil" class="form-label">Photo de profil (optionnelle)</label>
            <input type="file" id="profil" name="profil" class="form-control @error('profil') is-invalid @enderror" accept="image/*">
            @error('profil')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>          

          <button class="btn btn-primary w-100 mb-2" type="submit">S'inscrire</button>
          <button class="btn btn-outline-primary w-100" type="button" onclick="window.location.href='{{ route('login') }}'">Se connecter</button>
        </form>
      </div>

      <!-- Partie droite : Image -->
      <div class="col-lg-6 d-none d-lg-block p-0">
        <img src="{{ asset('assets/images/login-photo.jpg') }}" alt="Illustration" style="width: 100%; height: 100%; object-fit: cover;">
      </div>

    </div>
  </div>
</section>
@endsection
