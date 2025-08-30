<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIS | Admin - @yield('title')</title>
    <!-- Icône de l’entreprise -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logotype sourou bleu_Plan de travail 1.png') }}">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Icons (Bootstrap Icons) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>

        body{
            background: rgba(15, 63, 88, 0.6)
        }
                    /* Sidebar */
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
        }

        /* Logo */
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

        /* Liens */
        .sidebar a {
            color: #E2E8F0;
            text-decoration: none;
            padding: 12px 15px;
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
        .sidebar a.active, .sidebar a:hover {
            background-color: #334155;
            color: #fff;
        }

        /* Responsive : icons only */
        @media (max-width: 768px) {
            .sidebar {
                width: 70px;
                align-items: center;
            }
            .sidebar a {
                justify-content: center;
            }
            .sidebar a span {
                display: none; /* cacher les textes */
            }
            .sidebar a i {
                margin-right: 0;
                font-size: 20px;
            }
            .sidebar .logo h5, 
            .sidebar .logo small {
                display: none; /* cacher le texte du logo */
            }
        }

        /* Navbar */
        .navbar {
            background-color: #334155;
            color: white;
            margin-left: 240px;
            transition: margin-left 0.3s ease;
        }
        @media (max-width: 768px) {
            .navbar {
                margin-left: 70px;
            }
        }

        /* Content */
        .content {
            margin-left: 240px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        @media (max-width: 768px) {
            .content {
                margin-left: 70px;
            }
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
              style="width: 45px; height:45px;" alt="">&nbsp;
              <h5 class="mb-0 mx-0">SOUROU <br> <small class="text-center">IMMOBILLIER</small></h5>
          </a>
      </div>

      <a href="{{ route('admin.dashboard.index') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
          <i class="bi bi-speedometer2"></i> <span>Tableau de bord</span>
      </a>

      <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.index*') ? 'active' : '' }}">
          <i class="bi bi-people"></i> <span>Utilisateurs</span>
      </a>

      <a href="{{ route('admin.biens.index') }}" class="{{ request()->routeIs('admin.biens.*') ? 'active' : '' }}">
          <i class="bi bi-file-earmark-text"></i> <span>Biens</span>
      </a>

      <a href="{{ route('admin.demandes.index') }}" class="{{ request()->routeIs('admin.demandes.index*') ? 'active' : '' }}">
        <i class="bi bi-person"></i> <span>Demandes</span>
      </a>

      <a href="{{ route('admin.attributions.index') }}" class="{{ request()->routeIs('admin.attributions.*') ? 'active' : '' }}">
          <i class="bi bi-person"></i> <span>Attributions</span>
      </a>

      <a href="{{ route('admin.paiements.index') }}" class="{{ request()->routeIs('admin.paiements.*') ? 'active' : '' }}">
          <i class="bi bi-currency-dollar"></i> <span>Transactions</span>
      </a>

      <a href="{{ route('admin.contacts.index') }}" class="{{ request()->routeIs('admin.contacts.index') ? 'active' : '' }}">
          <i class="bi bi-gear"></i> <span>Contact</span>
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
    <nav class="navbar p-3 justify-content-between">
        <span><i class="bi bi-person-circle"></i><p class="text-light fw-semibold"> Admin connecté </p></span>
        
        <div class="gap-2">
            <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalAddBien">
                + Ajouter un bien
            </button>
            <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#modalAddProprietaire">
                + Ajouter un propriétaire
            </button>
        </div>

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

    </nav>

    <!-- Content -->
    <div class="content">
        @yield('content')

    <!-- Modal Ajouter Bien -->
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
                            <input type="text" name="adresse" 
                                class="form-control @error('adresse') is-invalid @enderror" 
                                value="{{ old('adresse') }}" required>
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
                                <option value="">-- Sélectionnez un propriétaire --</option>
                                @foreach($proprietaires as $proprio)
                                    <option value="{{ $proprio->id }}">{{ $proprio->name }} {{ $proprio->surname }}</option>
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
                            </select>
                            @error('categorie')
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


    <!-- Modal Ajouter Propriétaire -->
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



            <label for="name">name</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="name" value="{{ old('name') }}" required />
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            

            <label for="surname">Prénom</label>
            <input type="text" id="surname" name="surname" class="form-control @error('surname') @enderror" placeholder="Prénom" value="{{ old('surname') }}" required />
            @error('surname')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror


            <label for="telephone">Téléphone</label>
            <input type="number" name="telephone" id="telephone" class="form-control @error('telephone') is-invalid @enderror" placeholder="Votre numéro de téléphone" value="{{ old('telephone') }}" required/>
            @error('telephone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
                
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email professionnel" value="{{ old('email') }}"/>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-success">Enregistrer</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            </div>
        </form>
        </div>
    </div>
    </div>

</div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
