<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Icône de l’entreprise -->
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logotype sourou bleu_Plan de travail 1.png') }}">
    <title>Sourou Immobillier</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

      <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
     
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

      <!-- AOS Animations -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <style>
    /* Navbar */
    .custom-primary {
      background: linear-gradient(135deg, #004060, #005078);
      box-shadow: 0 3px 12px rgba(0, 0, 0, 0.2);
    }

    .navbar-nav .nav-link {
      position: relative;
      font-weight: 500;
      color: #fff;
      padding: 6px 12px;
      transition: color 0.3s ease;
    }

    .navbar-nav .nav-link::before,
    .navbar-nav .nav-link::after {
      content: "";
      position: absolute;
      left: 0;
      width: 100%;
      height: 2px;
      background: #00c4ff;
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    /* Lignes visibles sur actif */
    .navbar-nav .nav-link.active::before,
    .navbar-nav .nav-link.active::after {
      transform: scaleX(1);
      transform-origin: center;
    }

    /* Hover animation */
    .navbar-nav .nav-link:hover::before {
      transform: scaleX(1);
      transform-origin: left;
    }
    .navbar-nav .nav-link:hover::after {
      transform: scaleX(1);
      transform-origin: right;
    }

    /* Input recherche */
    .search-wrapper {
      position: relative;
      width: 200px;
      transition: width 0.3s ease;
    }
    .search-wrapper:focus-within {
      width: 260px;
    }
    .search-bar {
      height: 36px;
      width: 100%;
      padding-left: 14px;
      font-size: 0.85rem;
      border-radius: 1.5rem;
      border: 1px solid rgba(255, 255, 255, 0.6);
      background: rgba(255, 255, 255, 0.15);
      color: #fff;
      outline: none;
      transition: all 0.3s ease-in-out;
    }
    .search-bar::placeholder {
      color: rgba(255, 255, 255, 0.7);
    }
    .search-bar:focus {
      background: rgba(255, 255, 255, 0.25);
      border-color: #fff;
      box-shadow: 0 0 8px rgba(0, 196, 255, 0.6);
    }
    .search-btn {
      position: absolute;
      right: 3px;
      top: 0;
      border: none;
      border-radius: 50%;
      padding: 6px;
      cursor: pointer;
      transition: background 0.3s ease;
    }


      /* footer */

      html, body {
        height: 100%;
        margin: 0;
        display: flex;
        flex-direction: column;
      }

      main {
        flex: 1;
      }

      footer {
        color: white;
        text-align: center;
        padding: 10px;
      }

      /* Contact en z-index */

      .contact-widget {
        position: fixed;
        bottom: 20%;
        right: 20px;
        z-index: 9999;
      }

      .contact-btn {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: none;
        background: #005078;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        transition: transform 0.3s ease;
      }

      .contact-btn:hover {
        transform: scale(1.1);
      }

      /* Options cachées par défaut */
      .contact-option {
        position: absolute;
        bottom: 0;
        right: 0;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: #fff;
        color: #005078;
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        pointer-events: none;
        transition: all 0.4s ease;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      }

      /* Directions */
      .contact-top   { transform: translateY(0); }
      .contact-bottom{ transform: translateY(0); }
      .contact-left  { transform: translateX(0); }

      /* Actif (après clic) */
      .contact-widget.active .contact-top {
        transform: translateY(-80px);
        opacity: 1; pointer-events: auto;
      }

      .contact-widget.active .contact-bottom {
        transform: translateY(80px);
        opacity: 1; pointer-events: auto;
      }

      .contact-widget.active .contact-left {
        transform: translateX(-80px);
        opacity: 1; pointer-events: auto;
      }

  </style>
</head>
<body>
  <header>
    <nav class="navbar navbar-expand-lg fixed-top custom-primary shadow-sm py-2">
      <div class="container-fluid">
        
        <!-- Logo + Nom -->
        <a class="navbar-brand d-flex align-items-center text-light fw-bold" href="#">
          <img src="{{ asset('assets/images/logotype sourou bleu_Plan de travail 1.png') }}" 
               alt="Logo" class="border border-3 border-light rounded-circle me-2" 
               style="width: 50px; height: 50px;">
          <div class="lh-1">
            <h6 class="mb-0">SOUROU</h6>
            <small>IMMOBILIER</small>
          </div>
        </a>

        <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-list fs-2"></i>
        </button>

        <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
          <ul class="navbar-nav mx-auto text-center gap-3">
            <li class="nav-item">
              <a class="nav-link text-light {{ request()->is('accueil') ? 'active' : '' }}" href="/accueil">Accueil</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light {{ request()->is('apropos') ? 'active' : '' }}" href="/apropos">A Propos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light {{ request()->is('catalogue') ? 'active' : '' }}" href="/catalogue">Catalogue</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-light {{ request()->is('contact') ? 'active' : '' }}" href="/contact">Contact</a>
            </li>
          </ul>
        </div>

      

        <div class="d-flex align-items-center gap-2">
          <form action="{{ route('catalogue') }}" method="get" class="d-flex align-items-center">
            <div class="search-wrapper">
              <input type="text" name="query" class="search-bar" placeholder="Rechercher un bien..." value="{{ request('query') }}">
              <button type="submit" class="btn search-btn">
                <h5><i class="bi bi-search text-info"></i></h5>
              </button>
            </div>
          </form>          
          <form action="{{ route('register') }}" method="get">
            <button class="btn btn-sm btn-outline-info rounded-3 px-3">S'inscrire</button>
          </form>
        </div>
      </div>
    </nav>
  </header>
  

  <main class="py-4">
    @yield('content')
  </main>

    <!-- Bouton flottant de contact -->
  <div class="contact-widget">
      <button id="contactToggle" class="contact-btn">
        <i class="bi bi-chat-dots"></i>
      </button>

    <!-- Options de contact -->
    <a href="tel:+2290196233121" class="contact-option contact-top" title="Appel">
      <i class="bi bi-telephone-fill"></i>
    </a>
    <a href="https://www.facebook.com/" target="_blank" class="contact-option contact-bottom" title="Facebook">
      <i class="bi bi-facebook"></i>
    </a>
    <a href="https://wa.me/2290196233121" target="_blank" class="contact-option contact-left" title="WhatsApp">
      <i class="bi bi-whatsapp"></i>
    </a>
  </div>





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
          <p><i class="bi bi-geo-alt-fill me-2 text-light"></i>PORTO NOVO, BÉNIN</p>
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

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.getElementById("contactToggle").addEventListener("click", function() {
      document.querySelector(".contact-widget").classList.toggle("active");
    });
  </script>  
  <script>
      // Animation AOS
      AOS.init({
          duration: 1000,
          once: true
      });
   </script>

</body>