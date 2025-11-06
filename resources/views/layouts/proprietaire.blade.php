<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIS | Propriétaire - @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logotype sourou bleu_Plan de travail 1.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        body { background: rgba(15, 63, 88, 0.6); }

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
        .sidebar .logo img { width: 45px; height: 45px; }
        .sidebar .logo h5 { margin-top: 8px; font-size: 16px; }
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
        .sidebar a i { font-size: 18px; margin-right: 10px; }
        .sidebar a.active, .sidebar a:hover { background-color: #334155; color: #fff; }

        /* --- Navbar & Content --- */
        .navbar, .content { margin-left: 240px; transition: margin-left 0.3s ease; }
        .navbar { background-color: #334155; color: white; }

        /* --- Responsive --- */
        @media (max-width: 768px) {
          .sidebar { width: 70px; align-items: center; }
          .sidebar a { justify-content: center; }
          .sidebar a span { display: none; }
          .sidebar a i { margin-right: 0; font-size: 20px; }
          .sidebar .logo h5, .sidebar .logo small { display: none; }
          .navbar, .content { margin-left: 70px; }
        }

        .content { padding: 20px; }

        /* --- Cards Dashboard --- */
        .card-dashboard { border-radius: 8px; background-color: #f8f9fa; padding: 20px; margin-bottom: 20px; }
        .card-dashboard h6 { font-weight: bold; }
    </style>
</head>
<body>

<!-- Sidebar -->
<div class="sidebar p-3">
    <div class="logo">
        <a class="navbar-brand text-center text-light" href="{{ url('accueil') }}">
            <img class="border border-3 border-light rounded-circle" src="{{ asset('assets/images/logotype sourou bleu_Plan de travail 1.png') }}" alt="">
            <h5 class="mb-0 mx-0">SOUROU <br><small class="text-center">IMMOBILLIER</small></h5>
        </a>
    </div>

    <a href="{{ route('proprietaire.dashboard') }}" class="{{ request()->routeIs('proprietaire.dashboard') ? 'active' : '' }}">
        <i class="bi bi-speedometer2"></i> <span>Tableau de bord</span>
    </a>
    <a href="{{ route('proprietaire.biens') }}" class="{{ request()->routeIs('proprietaire.biens') ? 'active' : '' }}">
        <i class="bi bi-building"></i> <span>Mes Biens</span>
    </a>
    <a href="{{ route('proprietaire.locataires') }}" class="{{ request()->routeIs('proprietaire.locataires*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> <span>Mes Locataires</span>
    </a>

    <a href="{{ route('proprietaire.ventes') }}" class="{{ request()->routeIs('proprietaire.ventes') ? 'active' : '' }}">
        <i class="bi bi-cart"></i> <span>Mes ventes</span>
    </a>

    <a href="{{ route('proprietaire.paiements') }}" class="{{ request()->routeIs('proprietaire.paiements') ? 'active' : '' }}">
        <i class="bi bi-currency-dollar"></i> <span>Reversements & Loyers</span>
    </a>
    <a href="{{ route('proprietaire.depenses') }}" class="{{ request()->routeIs('proprietaire.depenses') ? 'active' : '' }}">
        <i class="bi bi-receipt"></i> <span>Dépenses</span>
    </a>
    <a href="{{ route('conversations.index') }}" class="{{ request()->routeIs('conversations.index') ? 'active' : '' }}">
        <i class="bi bi-chat-dots"></i> <span>Messagerie</span>
    </a>
    <a href="{{route('parametres.index') }}" class="{{ request()->routeIs('parametres.index') ? 'active' : '' }}">
        <i class="bi bi-gear"></i><span>Paramètres</span>
    </a>
    <a href="{{ url('/accueil') }}">
        <i class="bi bi-globe"></i> <span>Accueil</span>
    </a>
    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        <i class="bi bi-box-arrow-right"></i> <span>Déconnexion</span>
    </a>
    <form id="logout-form" action="{{ route('proprietaire.logout') }}" method="POST" style="display:none;">@csrf</form>
</div>

<!-- Navbar -->
<nav class="navbar p-3 justify-content-between">
    <span><i class="bi bi-person-circle"></i> Propriétaire connecté : {{ $proprio->name.' '.$proprio->surname }}</span>
    <div class="d-flex align-items-center gap-3">
        @include('partials.notifications-bell')
    </div>
</nav>

<!-- Content -->
<div class="content">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Exemple de script pour Chart.js sur Dashboard -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const ctx = document.getElementById('loyersChart');
        if(ctx){
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: @json($loyersMoisLabels ?? []),
                    datasets: [{
                        label: 'Loyers encaissés',
                        data: @json($loyersMoisData ?? []),
                        backgroundColor: '#0f3f58'
                    }]
                },
                options: { responsive: true, plugins: { legend: { display: false } } }
            });
        }
    });
</script>
</body>
</html>
