<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sourou Immobilier</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/images/logotype sourou bleu_Plan de travail 1.png') }}">

  <!-- Bootstrap + Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

  <style>
    :root {
      --main-blue: #005078;
      --gold: #ffc107;
      --light-bg: #f5f5f5;
    }

    body {
      font-family: 'Poppins', sans-serif;
      overflow-x: hidden;
    }

    /* === TOPBAR === */
    .topbar {
      background: var(--light-bg);
      color: #333;
      font-size: 14px;
      z-index: 1040;
      position: relative;
    }

    .topbar i {
      color: var(--main-blue);
    }

    /* === NAVBAR === */
    .navbar {
      position: sticky;
      top: 0;
      background: white;
      transition: all 0.3s ease-in-out;
      z-index: 1050;
    }

    .navbar-brand h6, .navbar-brand small {
      color: var(--main-blue);
    }

    .nav-link {
      color: var(--main-blue) !important;
      font-weight: 500;
      position: relative;
      transition: color 0.3s ease;
    }

    .nav-link:hover, .nav-link.active {
      color: var(--gold) !important;
    }

    .navbar.scrolled {
      background: var(--main-blue) !important;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    }

    .navbar.scrolled .nav-link {
      color: white !important;
    }

    .navbar.scrolled .navbar-brand h6,
    .navbar.scrolled .navbar-brand small {
      color: white !important;
    }

    /* Dropdown hover */
    .dropdown-menu {
      border-radius: 10px;
      border: none;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      display: none;
      opacity: 0;
      transition: all 0.3s ease;
    }

    .dropdown:hover > .dropdown-menu {
      display: block;
      opacity: 1;
    }

    .dropdown-item:hover {
      background-color: #e6f2f8;
      color: var(--main-blue);
    }

    /* Sous-menus */
    .dropdown-submenu {
      position: relative;
    }

    .dropdown-submenu:hover .dropdown-menu {
      top: 0;
      left: 100%;
      margin-left: 0.2rem;
      display: block;
      opacity: 1;
      color: #005078;
    }

    /* === DROPDOWN DANS LA SIDEBAR MOBILE === */
    .mobile-sidebar .dropdown-menu {
      background-color: #005078; /* fond semi-transparent blanc */
      border-radius: 8px;
      margin-left: 15px;
      padding: 5px 0;
      transition: all 0.3s ease;
    }

    .mobile-sidebar .dropdown-item {
      color: #fff;
      font-weight: 500;
      padding-left: 30px;
    }

    .mobile-sidebar .dropdown-item:hover {
      background-color: rgba(255, 255, 255, 0.25);
      color: #0dcaf0;
    }

    /* Couleur de fond des sous-menus */
    .dropdown-menu {
      background-color: #005078 !important;
    }

    .dropdown-menu .dropdown-item {
      color: #fff !important;
    }

    .dropdown-menu .dropdown-item:hover {
      background-color: #0dcaf0 !important;
      color: #005078 !important;
    }

    /* Pour les sous-niveaux */
    .dropdown-submenu .dropdown-menu {
      background-color: #005078 !important;
    }

    .topbar {
      background-color: #005078;
      color: white;
      font-size: 0.9rem;
      overflow: hidden;
    }

    /* Animation du haut-parleur */
    .speaker-icon {
      animation: pulse 1.2s infinite alternate;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      100% { transform: scale(1.3); color: #0dcaf0; }
    }

    /* Texte publicitaire défilant */
    .pub-text {
      white-space: nowrap;
      overflow: hidden;
      position: relative;
      width: 250px;
    }

    .pub-text span {
      display: inline-block;
      position: absolute;
      animation: slideText 12s linear infinite;
    }

    @keyframes slideText {
      0% { left: 100%; }
      100% { left: -100%; }
    }

    /* Responsive */
    @media (max-width: 576px) {
      .pub-text { width: 150px; font-size: 0.8rem; }
      .speaker-icon { font-size: 1.2rem; }
    }

    .topbar {
      background-color: #005078;
      color: white;
      font-size: 0.9rem;
    }

    /* Animation du haut-parleur */
    .speaker-icon {
      animation: pulse 1.2s infinite alternate;
    }

    @keyframes pulse {
      0% { transform: scale(1); }
      100% { transform: scale(1.3); color: #0dcaf0; }
    }

    /* Texte publicitaire défilant */
    .pub-text span {
      display: inline-block;
      position: absolute;
      white-space: nowrap;
      animation: slideText 8s linear forwards;
    }

    @keyframes slideText {
      0% { left: 100%; }
      100% { left: -100%; }
    }

    @media (max-width: 576px) {
      .pub-text { width: 150px; font-size: 0.8rem; }
      .speaker-icon { font-size: 1.2rem; }
    }


    .topbar {
      position: static;
    }



    /* === SEARCH OVERLAY === */
    .search-overlay {
      position: fixed;
      top: 0; left: 0;
      width: 100vw;
      height: 100vh;
      background: rgba(0, 80, 120, 0.95);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 2000;
      animation: fadeIn 0.4s ease;
    }

    .search-overlay.active {
      display: flex;
    }

    .search-form {
      display: flex;
      gap: 10px;
      align-items: center;
      background: white;
      padding: 12px 20px;
      border-radius: 50px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
      width: 70%;
      max-width: 600px;
    }

    .search-input {
      flex: 1;
      border: none;
      outline: none;
      font-size: 1.1rem;
    }

    .search-submit {
      border: none;
      background: var(--main-blue);
      color: white;
      border-radius: 50%;
      width: 42px; height: 42px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .close-search {
      position: absolute;
      top: 30px;
      right: 40px;
      background: none;
      border: none;
      color: white;
      font-size: 2rem;
      cursor: pointer;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: scale(1.05); }
      to { opacity: 1; transform: scale(1); }
    }

    /* === MOBILE SIDEBAR === */
    .mobile-sidebar {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background: var(--main-blue);
      color: white;
      transform: translateX(-100%);
      transition: all 0.4s ease;
      z-index: 1500;
      padding-top: 90px;
      overflow-y: auto;
    }

    .mobile-sidebar.active {
      transform: translateX(0);
    }

    .mobile-sidebar a {
      color: white;
      display: block;
      padding: 12px 20px;
      transition: background 0.3s;
    }

    .mobile-sidebar a:hover {
      background: rgba(255,255,255,0.15);
    }

    .mobile-sidebar .dropdown-menu {
      background: rgba(255,255,255,0.1);
      display: none;
      padding-left: 15px;
    }

    .mobile-sidebar .dropdown.open > .dropdown-menu {
      display: block;
    }

    .sidebar-close {
      position: absolute;
      top: 20px;
      right: 25px;
      font-size: 2rem;
      color: white;
      cursor: pointer;
    }

    /* === FOOTER === */
    footer {
      background: var(--main-blue);
      color: white;
      padding-top: 50px;
    }

    footer a {
      color: #ddd;
    }

    footer a:hover {
      color: white;
    }
  </style>
</head>

<body>

  <!-- === TOPBAR === -->
  <div class="topbar py-2 px-3 d-flex justify-content-between align-items-center flex-wrap">
    <div class="d-flex align-items-center gap-2 position-relative">
      <i class="bi bi-megaphone-fill text-info fs-4 speaker-icon"></i>
      <div class="pub-text text-light position-relative overflow-hidden" style="width: 250px; height: 1.2rem;">
        <!-- Les messages défilants seront injectés ici par JS -->
      </div>
    </div>

    <div class="d-flex align-items-center gap-3 mt-2 mt-sm-0">
      @auth
          @php
              $role = Auth::user()->role ?? 'client';
          @endphp
  
          @if($role === 'admin')
              <span class="text-light small"> Bonjour Admin, {{ Auth::user()->name }}</span>
          @elseif($role === 'proprietaire')
              <span class="text-light small"> Bonjour Propriétaire, {{ Auth::user()->name }}</span>
          @else
              <span class="text-light small"> Bonjour, {{ Auth::user()->name }}</span>
          @endif
  
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-sm btn-outline-light">Déconnexion</button>
          </form>
      @else
          <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Se connecter</a>
          <a href="{{ route('register') }}" class="btn btn-sm btn-warning text-dark">S’inscrire</a>
      @endauth
    </div>
  

  </div>

  <nav class="navbar navbar-expand-lg shadow-sm">
    <div class="container-fluid px-4">
      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center fw-bold" href="/">
        <img src="{{ asset('assets/images/logotype sourou bleu_Plan de travail 1.png') }}"
             alt="Logo" class="border border-3 border-light rounded-circle me-2"
             style="width: 48px; height: 48px;">
        <div class="lh-1">
          <h6 class="mb-0">SOUROU</h6>
          <small>IMMOBILIER</small>
        </div>
      </a>

      <!-- Burger -->
      <button id="burgerMenu" class="navbar-toggler border-0 text-dark" type="button">
        <i class="bi bi-list fs-2"></i>
      </button>

      <!-- Liens -->
      <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto text-center gap-3">
          <li class="nav-item">
            <a class="nav-link {{ request()->is('accueil') ? 'active' : '' }}" href="/accueil">Accueil</a>
          </li>
          <li class="nav-item">
              <a class="nav-link {{ request()->is('apropos') ? 'active' : '' }}" href="/apropos">A Propos</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->is('nos-services') ? 'active' : '' }}" href="/nos-services">Nos services</a>
          </li>
          
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle {{ request('type') === 'vente' ? 'active' : '' }}" 
               href="#" id="navbarDropdownVente" role="button" data-bs-toggle="dropdown" 
               aria-expanded="false">
                Propriété à vendre
            </a>
        
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownVente">
                <!-- Sous-menu Maison à vendre -->
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">
                        Maison à vendre
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/catalogue?categorie=maisons&type=vente&etat=batie">Maisons bâties</a></li>
                        <li><a class="dropdown-item" href="/catalogue?categorie=maisons&type=vente&etat=inachevee">Maisons inachevées</a></li>
                    </ul>
                </li>
        
                <li><a class="dropdown-item" href="/catalogue?categorie=parcelles&type=vente">Terrain à vendre</a></li>
        
                <!-- Sous-menu Appartement à vendre -->
                <li class="dropdown-submenu">
                    <a class="dropdown-item dropdown-toggle" href="#">
                        Appartement à vendre
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/catalogue?categorie=appartements&type=vente&etat=meuble">Meublé</a></li>
                        <li><a class="dropdown-item" href="/catalogue?categorie=appartements&type=vente&etat=non_meuble">Non meublé</a></li>
                    </ul>
                </li>
            </ul>
          </li>
          
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle {{ request('type') === 'location' ? 'active' : '' }}"
                href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Propriété à louer
              </a>
          
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <!-- Sous-menu Appartement -->
                  <li class="dropdown-submenu">
                      <a class="dropdown-item dropdown-toggle" href="#">
                          Appartement à louer
                      </a>
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="/catalogue?categorie=appartements&type=location&etat=meuble">Meublé</a></li>
                          <li><a class="dropdown-item" href="/catalogue?categorie=appartements&type=location&etat=non_meuble">Non meublé</a></li>
                      </ul>
                  </li>
          
                  <!-- Sous-menu Maison -->
                  <li class="dropdown-submenu">
                      <a class="dropdown-item dropdown-toggle" href="#">
                          Maison à louer
                      </a>
                      <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="/catalogue?categorie=maisons&type=location&etat=meuble">Meublée</a></li>
                          <li><a class="dropdown-item" href="/catalogue?categorie=maisons&type=location&etat=non_meuble">Non meublée</a></li>
                      </ul>
                  </li>
          
                  <li>
                      <a class="dropdown-item" href="/catalogue?categorie=parcelles&type=location">Terrain à louer</a>
                  </li>
              </ul>
          </li>
        

          <li class="nav-item">
            <a class="nav-link {{ request()->is('gestion-locative') ? 'active' : '' }}" href="gestion-locative">Gestion locative</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->is('actualite') ? 'active' : '' }}" href="/actualite">Blog</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->is('nos-partenaire') ? 'active' : '' }}" href="/nos-partenaire">Partenaires</a>
          </li>

          <li class="nav-item">
            <a class="nav-link {{ request()->is('faq') ? 'active' : '' }}" href="/faq">FAQ</a>
          </li>
          
     
          <li class="nav-item">
              <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}" href="/contact">Contact</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- === OVERLAY RECHERCHE === -->
  <div id="searchOverlay" class="search-overlay">
    <button class="close-search"><i class="bi bi-x-lg"></i></button>
    <form action="{{ route('catalogue') }}" method="get" class="search-form">
      <input type="text" name="query" class="search-input" placeholder="Rechercher un bien...">
      <button type="submit" class="search-submit"><i class="bi bi-search"></i></button>
    </form>
  </div>

  <div id="mobileSidebar" class="mobile-sidebar">
    <i class="bi bi-x sidebar-close"></i>
  
    <a href="/accueil"><i class="bi bi-house me-2"></i>Accueil</a>
    <a href="/apropos"><i class="bi bi-info-circle me-2"></i>À propos</a>
    <a href="/nos-services"><i class="bi bi-briefcase me-2"></i>Nos services</a>
  
    <!-- Propriétés à vendre -->
    <div class="dropdown">
      <a href="#" class="dropdown-toggle"><i class="bi bi-building me-2"></i>Propriétés à vendre</a>
      <div class="dropdown-menu">
        <!-- Maison -->
        <div class="dropdown-submenu">
          <a class="dropdown-item dropdown-toggle" href="#">Maison à vendre</a>
          <div class="dropdown-menu">
            <a class="dropdown-item text-white" href="/catalogue?categorie=maisons&type=vente&etat=batie">Maisons bâties</a>
            <a class="dropdown-item text-white" href="/catalogue?categorie=maisons&type=vente&etat=inachevee">Maisons inachevées</a>
          </div>
        </div>
        <!-- Appartement -->
        <div class="dropdown-submenu">
          <a class="dropdown-item dropdown-toggle" href="#">Appartement à vendre</a>
          <div class="dropdown-menu">
            <a class="dropdown-item text-white" href="/catalogue?categorie=appartements&type=vente&etat=meuble">Meublé</a>
            <a class="dropdown-item text-white" href="/catalogue?categorie=appartements&type=vente&etat=non_meuble">Non meublé</a>
          </div>
        </div>
        <!-- Terrain -->
        <a class="dropdown-item text-white" href="/catalogue?categorie=parcelles&type=vente">Terrain à vendre</a>
      </div>
    </div>
  
    <!-- Propriétés à louer -->
    <div class="dropdown">
      <a href="#" class="dropdown-toggle"><i class="bi bi-door-open me-2"></i>Propriétés à louer</a>
      <div class="dropdown-menu">
        <!-- Appartement -->
        <div class="dropdown-submenu">
          <a class="dropdown-item dropdown-toggle" href="#">Appartement à louer</a>
          <div class="dropdown-menu">
            <a class="dropdown-item text-white" href="/catalogue?categorie=appartements&type=location&etat=meuble">Meublé</a>
            <a class="dropdown-item text-white" href="/catalogue?categorie=appartements&type=location&etat=non_meuble">Non meublé</a>
          </div>
        </div>
        <!-- Maison -->
        <div class="dropdown-submenu">
          <a class="dropdown-item dropdown-toggle" href="#">Maison à louer</a>
          <div class="dropdown-menu">
            <a class="dropdown-item text-white" href="/catalogue?categorie=maisons&type=location&etat=meuble">Meublée</a>
            <a class="dropdown-item text-white" href="/catalogue?categorie=maisons&type=location&etat=non_meuble">Non meublée</a>
          </div>
        </div>
        <!-- Terrain -->
        <a class="dropdown-item text-white" href="/catalogue?categorie=parcelles&type=location">Terrain à louer</a>
      </div>
    </div>
  
    <a href="/gestion-locative"><i class="bi bi-gear me-2"></i>Gestion locative</a>
    <a href="/actualite"><i class="bi bi-journal me-2"></i>Blog</a>
    <a href="/nos-partenaire"><i class="bi bi-people me-2"></i>Partenaires</a>
    <a href="/faq"><i class="bi bi-question-circle me-2"></i>FAQ</a>
    <a href="/contact"><i class="bi bi-envelope me-2"></i>Contact</a>
  
    <hr class="text-white my-3">
    <a href="#" id="mobileSearch"><i class="bi bi-search me-2"></i>Rechercher</a>
    
      @auth
      <form action="{{ route('logout') }}" method="POST" class="d-inline">
          @csrf
          <button type="submit" class="btn btn-sm btn-outline-light">Déconnexion</button>
      </form>
      @else
        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">Se connecter</a>
        <a href="{{ route('register') }}" class="btn btn-sm btn-warning text-dark">S’inscrire</a>
      @endauth
  </div>  

  <main id="mainContent">
    @yield('content')
  </main>

  <footer class="text-white pt-5 pb-3 custom-primary">
    <div class="container">
      <div class="row">
        <!-- Colonne 1 : Logo + description -->
        <div class="col-md-4 mb-4">
          <div class="d-flex align-items-center mb-3">
            <img src="{{ asset('assets/images/logotype sourou bleu_Plan de travail 1.png') }}" 
                 alt="logo Sourou" 
                 class="me-2 rounded-circle border border-2 border-light" 
                 style="width:60px; height:60px;">
            <div>
              <h5 class="mb-0 fw-bold">SOUROU IMMOBILIER</h5>
              <small>SERVICE SARL</small>
            </div>
          </div>
          <p class="text-light">
            Votre partenaire de confiance pour tous vos projets immobiliers au Bénin. 
            Spécialisés dans la vente, la location et la gestion de biens immobiliers 
            avec plus de 15 ans d'expertise.
          </p>

          <form action="{{ route('newsletter.subscribe') }}" method="POST" class="bonjour-footer-newsletter">
            @csrf
            <input type="email" name="email" class="form-control" placeholder="Entrez votre email et abonnez-vous..." required>
            <button type="submit" class="btn w-100 p-2 mt-1 bg-info text-white"><strong>S'abonner</strong></button>
        </form>        
        </div>
  
        <!-- Colonne 2 : Contact -->
        <div class="col-md-4 mb-4">
          <h5 class="mb-3 border-bottom border-light pb-2">Contact</h5>
          <p><i class="bi bi-geo-alt-fill me-2 text-light"></i>Porto-Novo, Gbodjè(Bénin) à 200 mettre de le l'église catholique Saint Antoine de Padoue</p>
          <p><i class="bi bi-telephone-fill me-2 text-light"></i>+229 01 96 23 31 21</p>
          <p><i class="bi bi-telephone-fill me-2 text-light"></i>+229 01 56 00 19 30</p>
          <p><i class="bi bi-envelope-fill me-2 text-light"></i>contact@sourouimmobilier.com</p>
          <p><i class="bi bi-globe me-2 text-light"></i>sourouimmobilier.com</p>
        </div>
  
        <!-- Colonne 3 : Infos légales -->
        <div class="col-md-4 mb-4">
          <h5 class="mb-3 border-bottom border-light pb-2">Informations Légales</h5>
          <div class="p-1 mb-3 rounded-2 fw-bold" style="background: rgba(245, 245, 245, 0.9); color:#005078">
            <strong>RCC</strong><br>RB/PNO/22B4118
          </div>
          <div class="p-1 mb-3 rounded-2 fw-bold" style="background: rgba(245, 245, 245, 0.9); color:#005078">
            <strong>IFU</strong><br>32022508482554
          </div>
        </div>
      </div>
    </div>
  
    <!-- Ligne Copyright -->
    <div class="text-center mt-3 border-top border-secondary pt-3">
      © 2025 Sourou Immobilier Service SARL. Tous droits réservés.
    </div>
  </footer>  

  <!-- === SCRIPTS === -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Navbar change au scroll
    window.addEventListener("scroll", function () {
      const navbar = document.querySelector(".navbar");
      if (window.scrollY > 50) navbar.classList.add("scrolled");
      else navbar.classList.remove("scrolled");
    });

    // Sidebar mobile
    const burger = document.getElementById("burgerMenu");
    const sidebar = document.getElementById("mobileSidebar");
    const closeSidebar = document.querySelector(".sidebar-close");
    burger.addEventListener("click", () => sidebar.classList.add("active"));
    closeSidebar.addEventListener("click", () => sidebar.classList.remove("active"));

    // Gestion des sous-menus mobiles
    document.querySelectorAll(".mobile-sidebar .dropdown-toggle").forEach(item => {
      item.addEventListener("click", e => {
        e.preventDefault();
        const parent = item.closest(".dropdown");
        parent.classList.toggle("open");
      });
    });

    // Recherche overlay
    const searchToggle = document.getElementById("searchToggle");
    const searchOverlay = document.getElementById("searchOverlay");
    const closeSearch = document.querySelector(".close-search");
    const mobileSearch = document.getElementById("mobileSearch");
    if (searchToggle) searchToggle.addEventListener("click", () => searchOverlay.classList.add("active"));
    if (mobileSearch) mobileSearch.addEventListener("click", () => {
      sidebar.classList.remove("active");
      searchOverlay.classList.add("active");
    });
    closeSearch.addEventListener("click", () => searchOverlay.classList.remove("active"));
    window.addEventListener("keydown", e => { if (e.key === "Escape") searchOverlay.classList.remove("active"); });
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const dropdowns = document.querySelectorAll('.nav-item.dropdown > .nav-link');
    
      dropdowns.forEach(link => {
        link.addEventListener('click', () => {
          dropdowns.forEach(l => l.classList.remove('active'));
          link.classList.add('active');
        });
      });
    });
  </script>
  
  <!-- ===  Défilement des messages === -->
  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const pubMessages = [
        " Sourou Immobilier Service : trouvez la maison de vos rêves !",
        " Achetez ou louez votre véhicule en toute sécurité !",
        " Mobilier de qualité, livraison rapide !",
        " Sourou : L'immobilier autrement."
      ];
    
      const pubContainer = document.querySelector(".pub-text");
      let index = 0;
    
      function showNextMessage() {
        pubContainer.innerHTML = "";
    
        const span = document.createElement("span");
        span.textContent = pubMessages[index];
        pubContainer.appendChild(span);
    
        // Calculer la largeur du texte et de son conteneur pour adapter la durée
        const textWidth = span.offsetWidth;
        const containerWidth = pubContainer.offsetWidth;
        const distance = containerWidth + textWidth;
        const speed = 50; 
        const duration = distance / speed * 1500;
    
        span.animate(
          [
            { transform: `translateX(${containerWidth}px)` },
            { transform: `translateX(${-textWidth}px)` }
          ],
          {
            duration: duration,
            iterations: 1,
            easing: "linear"
          }
        );
    
        setTimeout(() => {
          index = (index + 1) % pubMessages.length;
          showNextMessage();
        }, duration);
      }
    
      showNextMessage();
    });
  </script>
    
  

  
  
</body>
</html>
