<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS | Locataire - @yield('title')</title>
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

      <a href="{{ route('client.dashboard') }}" class="{{ request()->routeIs('client.dashboard') ? 'active' : '' }}">
          <i class="bi bi-speedometer2"></i> <span>Tableau de bord</span>
      </a>

      <a href="{{ route('client.contrats') }}" class="{{ request()->routeIs('client.contrats') ? 'active' : '' }}">
          <i class="bi bi-file-earmark-text"></i> <span>Mes contrats</span>
      </a>

      <a href="{{ route('client.achats') }}" class="{{ request()->routeIs('client.achats') ? 'active' : '' }}">
        <i class="bi bi-cart"></i> <span>Mes achats</span>
      </a>

      <a href="{{route('client.contrats_payes.historique') }}" class="{{ request()->routeIs('client.contrats_payes.historique') ? 'active' : '' }}">
          <i class="bi bi-currency-dollar"></i> <span>Payés</span>
      </a>

      <a href="{{route('conversations.index') }}" class="{{ request()->routeIs('conversations.index') ? 'active' : '' }}">
        <i class="bi bi-chat-dots"></i><span>Messages</span>
      </a>

      <a href="{{route('client.signalements.index') }}" class="{{ request()->routeIs('client.signalements.index') ? 'active' : '' }}">
        <i class="bi bi-flag-fill"></i><span>Signaler</span>
      </a>

      <a href="{{route('parametres.index') }}" class="{{ request()->routeIs('parametres.index') ? 'active' : '' }}">
        <i class="bi bi-gear"></i><span>Paramètres</span>
      </a>

      <a href="{{ url('/accueil') }}">
          <i class="bi bi-globe"></i> <span>Accueil</span>
      </a>

      <a href="{{ route('logout') }}"
        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          <i class="bi bi-box-arrow-right"></i> <span>Déconnexion</span>
      </a>
      <form id="logout-form" action="{{ route('client.logout') }}" method="POST" style="display:none;">
          @csrf
      </form>
    </div>


    <!-- Navbar -->
    <nav class="navbar p-3 justify-content-between">
        <div class="d-flex mb-2">
            <span><i class="bi bi-person-circle"></i> Client connecté: {{ $client->name." ".$client->surname}} </span>
        </div>

        <div class="gap-4 d-flex">
            <a href="{{ url('/catalogue') }}" class="btn btn-sm btn-outline-warning">
                Visiter le catalogue
            </a>
            @include('partials.notifications-bell')
        </div>
    </nav>
        

    <!-- Content -->
    <div class="content">
        @yield('content')



   </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>




























