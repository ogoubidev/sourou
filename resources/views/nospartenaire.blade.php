@extends('layouts.app')

@section('title', 'Nos Partenaires')

@section('content')

<!-- ====== SECTION PARTENAIRES ====== -->
<section class="py-5 partenaires-section" style="background: linear-gradient(180deg, #f7f9fb 0%, #ffffff 100%);">
  <div class="container text-center">
    <h2 class="fw-bold mb-3" style="color:#005078;"> Nos Partenaires</h2>
    <p class="text-muted mb-5">Nous collaborons avec des partenaires de confiance pour offrir des services complets et de qualité à nos clients.</p>

    <!-- CARROUSEL DES LOGOS -->
    <div id="carouselPartenaires" class="carousel slide mb-5" data-bs-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="d-flex justify-content-center align-items-center gap-4 flex-wrap">
            <a href="https://agecibsarlbenin.com/" style="text-decoration: none;">
                <div class="logo-card shadow-sm">
                    <img src="{{ asset('assets/images/AGECIB.png') }}" alt="AGECIB" class="img-fluid">
                    <h6 class="mt-2 fw-semibold" style="color: #005078;">AGECIB</h6>
                    <p class="small text-muted mb-0">partenaire dans le domaine bancaire et financement immobilier.
                    </p>
                </div>
            </a>

            <a href="https://www.aim-transactions.com/" style="text-decoration: none;">
                <div class="logo-card shadow-sm">
                    <img src="{{ asset('assets/images/aim.png') }}" alt="AIM" class="img-fluid">
                    <h6 class="mt-2 fw-semibold" style="color: #005078;">AIM</h6>
                    <p class="small text-muted mb-0">Soutien et expertise pour la gestion locative et transactions sécurisées.
                    </p>
                </div>
            </a>

          </div>
        </div>
      </div>
    </div>

    <!-- SECTION DEVENIR PARTENAIRE -->
    <div class="row justify-content-center fade-in">
      <div class="col-lg-10">
        <div class="rounded-4 shadow-lg bg-glass text-start position-relative overflow-hidden">
            <img src="{{ asset('assets/images/partenariat_international.jpeg') }}" alt="partenariat" style="height: 400px;" class="w-100 img-fluid">
          <h3 class="fw-bold mt-5 text-center" style="color:#005078;">Rejoignez notre réseau de partenaires</h3>
          <p class="text-muted fs-5 m-5">
            Développons ensemble le marché immobilier au Bénin !
            Collaborez avec <strong>SOUROU IMMOBILIER SERVICE SARL</strong> et bénéficiez de :
          </p>

          <div class="row g-3 mb-4 m-5">
            <div class="col-md-6 d-flex align-items-start">
              <i class="fa-solid fa-users fa-lg me-3" style="color: #005078;"></i>
              <p class="mb-0"><strong>Un réseau ciblé</strong> d’investisseurs et de clients sérieux.</p>
            </div>
            <div class="col-md-6 d-flex align-items-start">
              <i class="fa-solid fa-bullhorn fa-lg me-3" style="color: #005078;"></i>
              <p class="mb-0"><strong>Visibilité accrue</strong> grâce à nos campagnes marketing.</p>
            </div>
            <div class="col-md-6 d-flex align-items-start">
              <i class="fa-solid fa-handshake fa-lg me-3" style="color: #005078;"></i>
              <p class="mb-0"><strong>Partenariats transparents</strong> et basés sur la confiance.</p>
            </div>
            <div class="col-md-6 d-flex align-items-start">
              <i class="fa-solid fa-city fa-lg me-3" style="color: #005078;"></i>
              <p class="mb-0"><strong>Opportunités communes</strong> dans le développement immobilier.</p>
            </div>
          </div>

          <div class="text-center m-4">
            <a href="/contact" class="btn btn-primary btn-lg rounded-pill shadow-sm px-5">
              <i class="fa-solid fa-envelope me-2"></i>Devenir partenaire
            </a>
          </div>

          <!-- Effet de fond animé -->
          <div class="bg-bubbles"></div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Font Awesome (icônes) -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<!-- ====== STYLE ====== -->
<style>
  .logo-card {
    width: 180px;
    padding: 20px;
    border-radius: 15px;
    background-color: white;
    transition: all 0.3s ease;
  }

  .logo-card img {
    max-width: 100px;
    height: auto;
    transition: transform 0.3s ease;
  }

  .logo-card:hover img {
    transform: scale(1.1);
  }

  .logo-card:hover {
    box-shadow: 0 10px 25px rgba(0, 80, 120, 0.2);
    transform: translateY(-5px);
  }

  .bg-glass {
    background: rgba(255, 255, 255, 0.85);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.4);
  }

  .bg-bubbles::before, .bg-bubbles::after {
    content: "";
    position: absolute;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: rgba(0, 80, 120, 0.1);
    animation: float 6s infinite ease-in-out alternate;
  }

  .bg-bubbles::after {
    right: -80px;
    bottom: -80px;
    background: rgba(0, 170, 255, 0.15);
    animation-delay: 2s;
  }

  @keyframes float {
    0% { transform: translateY(0px) scale(1); }
    100% { transform: translateY(-25px) scale(1.05); }
  }

  .fade-in {
    animation: fadeInUp 0.8s ease-out both;
  }

  @keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
  }
</style>

@endsection
