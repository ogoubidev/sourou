<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>SIS | Admin - @yield('title')</title>

  <!-- Icône -->
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logotype sourou bleu_Plan de travail 1.png') }}">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: rgba(15, 63, 88, 0.6);
    }

    /* --- Sidebar --- */
    .sidebar {
      background-color: #1E293B;
      min-height: 100vh;
      color: white;
      position: fixed;
      width: 240px;
      transition: all 0.3s ease;
      display: flex;
      flex-direction: column;
      align-items: start;
      z-index: 1050;
    }
    .sidebar .logo {
      text-align: center;
      margin-bottom: 20px;
    }
    .sidebar .logo img {
      width: 45px;
      height: 45px;
    }
    .sidebar .logo h5 {
      margin-top: 8px;
      font-size: 16px;
    }
    .sidebar a {
      color: #E2E8F0;
      text-decoration: none;
      padding: 3px 8px;
      display: flex;
      align-items: center;
      border-radius: 6px;
      margin-bottom: 8px;
      font-size: 15px;
      transition: background 0.2s;
    }
    .sidebar a i {
      font-size: 18px;
      margin-right: 10px;
    }
    .sidebar a.active,
    .sidebar a:hover {
      background-color: #334155;
      color: #fff;
    }

    /* --- Navbar & Content (PC) --- */
    .navbar,
    .content {
      margin-left: 240px;
      transition: margin-left 0.3s ease;
    }
    .navbar {
      background-color: #334155;
      color: white;
    }

    /* --- Responsive --- */
    @media (max-width: 768px) {
      .sidebar {
        width: 70px;
        align-items: center;
      }
      .sidebar a {
        justify-content: center;
      }
      .sidebar a span {
        display: none;
      }
      .sidebar a i {
        margin-right: 0;
        font-size: 15px;
        padding: 1px 8px;
      }
      .sidebar .logo h5,
      .sidebar .logo small {
        display: none;
      }

      .navbar,
      .content {
        margin-left: 0; /* contenu en pleine largeur */
      }
    }

    @media (max-width: 768px) {
    .navbar,
    .content {
        margin-left: 70px; /* Décale le contenu du même espace que la sidebar réduite */
    }
    }


    .content {
      padding: 20px;
    }
  </style>
</head>
<body>

  <!-- Sidebar -->
  <div class="sidebar p-3">
    <div class="logo">
      <a class="navbar-brand text-center text-light" href="{{ url('accueil') }}">
        <img class="border border-3 border-light rounded-circle"
             src="{{ asset('assets/images/logotype sourou bleu_Plan de travail 1.png') }}"
             alt="">
        <h5 class="mb-0">SOUROU <br><small>IMMOBILIER</small></h5>
      </a>
    </div>  

    <a href="{{ route('admin.dashboard.index') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
      <i class="bi bi-speedometer2"></i> <span>Tableau de bord</span>
    </a>
    <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index*') ? 'active' : '' }}">
      <i class="bi bi-people"></i> <span>Utilisateurs</span>
    </a>
    <a href="{{ route('admin.biens.index') }}" class="{{ request()->routeIs('admin.biens.*') ? 'active' : '' }}">
      <i class="bi bi-car-front"></i> <span>Biens</span>
    </a>
    <a href="{{ route('admin.demandes.index') }}" class="{{ request()->routeIs('admin.demandes.index*') ? 'active' : '' }}">
      <i class="bi bi-file-earmark-text"></i> <span>Demandes</span>
    </a>
    <a href="{{ route('admin.attributions.index') }}" class="{{ request()->routeIs('admin.attributions.*') ? 'active' : '' }}">
      <i class="bi bi-house-add"></i> <span>Attributions</span>
    </a>
    <a href="{{ route('admin.paiements.index') }}" class="{{ request()->routeIs('admin.paiements.*') ? 'active' : '' }}">
      <i class="bi bi-currency-dollar"></i> <span>Transactions</span>     
    </a>
    <a href="{{ route('admin.posts.index') }}" class="{{ request()->routeIs('admin.posts.index') ? 'active' : '' }}">
      <i class="bi bi-stickies"></i><span>Articles</span>
    </a>  

    <a href="{{ route('admin.depenses.index') }}" class="{{ request()->routeIs('admin.depenses.index') ? 'active' : '' }}">
      <i class="bi bi-currency-exchange"></i><span>Dépenses</span>
    </a>

    <a href="{{route('conversations.index') }}" class="{{ request()->routeIs('conversations.index') ? 'active' : '' }}">
      <i class="bi bi-chat-dots"></i><span>Messages</span>
    </a>

    <a href="{{route('admin.signalements.index') }}" class="{{ request()->routeIs('admin.signalements.index') ? 'active' : '' }}">
      <i class="bi bi-flag-fill"></i><span>Signaler</span>
    </a>

    <a href="{{route('parametres.index') }}" class="{{ request()->routeIs('parametres.index') ? 'active' : '' }}">
      <i class="bi bi-gear"></i><span>Paramètres</span>
    </a>

    <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">
      <i class="bi bi-person"></i> <span>Contact</span>
    </a>
    <a href="{{ url('/accueil') }}">
      <i class="bi bi-globe"></i> <span>Accueil</span>
    </a>
    <a href="{{ route('admin.logout') }}"
       onclick="event.preventDefault();document.getElementById('logout-form').submit();">
      <i class="bi bi-box-arrow-right"></i> <span>Déconnexion</span>
    </a>
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display:none;">
      @csrf
    </form>
  </div>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg p-3">
    <div class="container-fluid">
      <!-- Bouton Burger -->
      <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <i class="bi bi-list" style="font-size:1.5rem;"></i>
      </button>

      <!-- Admin -->
      <span class="navbar-text text-white fw-semibold ms-2 d-flex align-items-center">
        <i class="bi bi-person-circle me-1"></i> Admin connecté
      </span>


      <!-- Contenu -->
      <div class="collapse navbar-collapse justify-content-end gap-3" id="navbarContent">
        <div class="d-flex flex-wrap gap-2 mt-3 mt-lg-0">
          <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalAddBien">
            + Ajouter un bien
          </button>
          <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddProprietaire">
            + Ajouter un propriétaire
          </button>
          <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#paiementModal">
            + Enregistrer un paiement
          </button>

          
    
          <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#modalResetPassword">
           Reset mot de passe propriétaire
          </button>
                

        </div>

        <div class="notifs d-flex justify-content-end flex-wrap gap-4">
            <!-- Notifications Dropdown -->
            @auth
            <li class="nav-item dropdown">
                <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-bell" style="font-size: 1.4rem;"></i>
                    @if(auth()->user()->unreadNotifications->count() > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ auth()->user()->unreadNotifications->count() }}
                        </span>
                    @endif
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationsDropdown" style="width: 320px; max-height: 400px; overflow-y: auto;">
                    <li class="dropdown-header">Notifications</li>
                    @forelse(auth()->user()->notifications as $notification)
                        <li>
                            <a href="{{ url('/admin/attributions/' . $notification->data['attribution_id']) }}" class="dropdown-item d-flex align-items-start {{ $notification->read_at ? '' : 'fw-bold' }}">
                                <div>
                                    <div>{{ $notification->data['message'] }}</div>
                                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                </div>
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                    @empty
                        <li class="dropdown-item text-muted">Aucune notification</li>
                    @endforelse
                </ul>
            </li>
            @endauth
            @include('partials.notifications-paiement')
        </div>
      </div>


    </div>
  </nav>

  <!-- Content -->
  <div class="content">
    @yield('content')

    <!-- ================= Modal Ajouter Bien ================= -->
    <div class="modal fade" id="modalAddBien" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title">Ajouter un nouveau bien</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{ route('admin.biens.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="titre" class="form-label">Titre du bien</label>
                            <input type="text" name="titre" id="titre" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                <option value="" disabled {{ old('type') ? '' : 'selected' }}>-- Sélectionner --</option>
                                <option value="vente" {{ old('type')=='vente' ? 'selected' : '' }}>Vente</option>
                                <option value="location" {{ old('type')=='location' ? 'selected' : '' }}>Location</option>
                            </select>
                            @error('type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" name="adresse" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse') }}" required>
                            @error('adresse')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prix" class="form-label">Prix</label>
                            <input type="number" step="0.01" name="prix" id="prix" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="proprietaire_id" class="form-label">Propriétaire</label>
                            <select name="proprietaire_id" id="proprietaire_id" class="form-select" required>
                                <option value="" selected disabled>-- Sélectionnez un propriétaire --</option>
                                @foreach($proprietaires as $proprio)
                                    <option value="{{ $proprio->id }}">{{ $proprio->name . " " . $proprio->surname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="categorie" class="form-label">Catégorie</label>
                            <select name="categorie" id="categorie" class="form-select @error('categorie') is-invalid @enderror" required>
                                <option value="" disabled {{ old('categorie') ? '' : 'selected' }}>-- Sélectionner une catégorie --</option>
                                <option value="maisons" {{ old('categorie')=='maisons' ? 'selected' : '' }}>Maisons</option>
                                <option value="parcelles" {{ old('categorie')=='parcelles' ? 'selected' : '' }}>Parcelles</option>
                                <option value="vehicules" {{ old('categorie')=='vehicules' ? 'selected' : '' }}>Véhicules</option>
                                <option value="mobilier" {{ old('categorie')=='mobilier' ? 'selected' : '' }}>Mobilier</option>
                                <option value="appartements" {{ old('categorie')=='appartements' ? 'selected' : '' }}>Appartements</option>
                            </select>
                            @error('categorie')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="etat" class="form-label">État du bien</label>
                            <select name="etat" id="etat" class="form-select @error('etat') is-invalid @enderror" required>
                                <option value="" disabled selected>-- Sélectionner un état --</option>
                            </select>
                            @error('etat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="medias" class="form-label">Médias du bien (images ou vidéos)</label>
                            <input type="file" name="medias[]" id="medias" class="form-control" accept="image/*,video/*" multiple>
                            <small class="text-muted">Vous pouvez ajouter plusieurs images ou vidéos (mp4, mov, avi).</small>
                        </div>
                    </div>                    

                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">⬅ Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= Modal Ajouter Propriétaire ================= -->
    <div class="modal fade" id="modalAddProprietaire" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" action="{{ route('admin.users.store') }}">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Ajouter un propriétaire</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <label for="name">Nom</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        <label for="surname" class="mt-2">Prénom</label>
                        <input type="text" id="surname" name="surname" class="form-control @error('surname') is-invalid @enderror" value="{{ old('surname') }}" required>
                        @error('surname') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        <label for="telephone" class="mt-2">Téléphone</label>
                        <input type="number" id="telephone" name="telephone" class="form-control @error('telephone') is-invalid @enderror" value="{{ old('telephone') }}" required>
                        @error('telephone') <div class="invalid-feedback">{{ $message }}</div> @enderror

                        <label for="email" class="mt-2">Email (optionnel)</label>
                        <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}">
                        @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= Modal Paiement ================= -->
    <div class="modal fade" id="paiementModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('admin.paiements.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Enregistrer un paiement</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="attribution_id" class="form-label">Attribution</label>
                            <select class="form-select" id="attribution_id" name="attribution_id" required>
                                <option value="" selected disabled>-- Sélectionner --</option>
                                @foreach($attributions as $att)
                                    <option value="{{ $att->id }}" data-loyer="{{ $att->loyer_mensuel }}">
                                        {{ $att->bien->titre ?? '—' }} - {{ $att->client->name ?? '' }} {{ $att->client->surname ?? '' }}
                                        ({{ number_format($att->loyer_mensuel, 0, ',', ' ') }} FCFA / mois)
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" id="montant" name="montant">
                        <div id="montantDisplay" class="alert alert-info d-none">
                            Montant du paiement : <strong id="montantText"></strong> FCFA
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= Modal Reset Password ================= -->
    <div class="modal fade" id="modalResetPassword" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content rounded-3 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">Réinitialiser mot de passe propriétaire</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <form method="POST" action="{{ route('admin.proprietaires.reset-password') }}" id="resetPasswordForm">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="proprietaire_id" class="form-label">Sélectionnez un propriétaire</label>
                            <select name="user_id" id="proprietaire_id" class="form-select" required>
                                <option value="" selected disabled>-- Choisir un propriétaire --</option>
                                @foreach($proprietaires as $proprio)
                                    <option value="{{ $proprio->id }}">{{ $proprio->name }} {{ $proprio->surname }} - {{ $proprio->telephone }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="alert alert-warning">
                            ⚠ Le mot de passe sera réinitialisé et remplacé par un <strong>mot de passe temporaire</strong>.
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-warning">Réinitialiser le mot de passe</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- ================= Scripts ================= -->
    <script>
      document.addEventListener('DOMContentLoaded', function() {
          const categorieSelect = document.getElementById('categorie');
          const etatSelect = document.getElementById('etat');

          // États possibles selon la catégorie
          const etatsOptions = {
              maisons: ['batie', 'inachevee', 'meuble', 'non_meuble'],
              appartements: ['meuble', 'non_meuble'],
              parcelles: ['terrain'],
              vehicules: ['neuf', 'occasion'],
              mobilier: ['meuble', 'non_meuble']
          };

          function updateEtatOptions() {
              const cat = categorieSelect.value;
              etatSelect.innerHTML = '<option value="" disabled selected>-- Sélectionner un état --</option>';

              if (etatsOptions[cat]) {
                  etatsOptions[cat].forEach(etat => {
                      const option = document.createElement('option');
                      option.value = etat;
                      option.textContent = etat.charAt(0).toUpperCase() + etat.slice(1).replace('_', ' ');
                      etatSelect.appendChild(option);
                  });
              }
          }

          // Rafraîchissement dynamique quand on change de catégorie
          categorieSelect.addEventListener('change', updateEtatOptions);

          // Remplir automatiquement si old() existe (validation échouée)
          @if(old('categorie'))
              categorieSelect.value = "{{ old('categorie') }}";
              updateEtatOptions();
              @if(old('etat'))
                  etatSelect.value = "{{ old('etat') }}";
              @endif
          @endif
          
          // Script paiement
          const attributionSelect = document.getElementById("attribution_id");
          const montantInput = document.getElementById("montant");
          const montantDisplay = document.getElementById("montantDisplay");
          const montantText = document.getElementById("montantText");

          if(attributionSelect){
              attributionSelect.addEventListener("change", function() {
                  const selectedOption = this.options[this.selectedIndex];
                  const loyer = selectedOption.getAttribute("data-loyer");
                  if (loyer) {
                      montantInput.value = loyer;
                      montantText.textContent = new Intl.NumberFormat('fr-FR').format(loyer);
                      montantDisplay.classList.remove("d-none");
                  } else {
                      montantInput.value = "";
                      montantDisplay.classList.add("d-none");
                  }
              });
          }
      });
    </script>
</div>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
