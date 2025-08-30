@extends('layouts.app')

<link rel="stylesheet" href="{{ asset('css/accueil.css') }}">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

@section('content')

  <div id="carouselCustom" class="carousel slide pt-4" data-bs-ride="carousel" data-bs-interval="10000">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('assets/images/new0.jpg') }}" class="" alt="nature1">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/images/new1.jpg') }}" class="" alt="nature2">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/images/new6.jpg') }}" class="" alt="nature3">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/images/r.jpg') }}" class="" alt="nature4">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/images/new8.jpg') }}" class="" alt="nature5">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/images/g.jpg') }}" class="" alt="nature6">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/images/new7.jpg') }}" class="" alt="nature7">
      </div>
    </div>
  
    <!-- Dots -->
    <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselCustom" data-bs-slide-to="0" class="active"></button>
        <button type="button" data-bs-target="#carouselCustom" data-bs-slide-to="1"></button>
        <button type="button" data-bs-target="#carouselCustom" data-bs-slide-to="2"></button>
        <button type="button" data-bs-target="#carouselCustom" data-bs-slide-to="3"></button>
        <button type="button" data-bs-target="#carouselCustom" data-bs-slide-to="4"></button>
        <button type="button" data-bs-target="#carouselCustom" data-bs-slide-to="5"></button>
        <button type="button" data-bs-target="#carouselCustom" data-bs-slide-to="6"></button>
    </div>
  
  
    <!-- Dégradés -->
    <div class="carousel-gradient-left"></div>
    <div class="carousel-gradient-right"></div>
    <div class="carousel-gradient-bottom"></div>

  </div>



  <section id="presentation" class="my-5">
      <div class="container text-center">
          <div class="custom-primary d-inline-flex align-items-center px-4 py-2 rounded-pill shadow-sm mb-3">
              <svg xmlns="http://www.w3.org/2000/svg" 
                  width="30" height="30" viewBox="0 0 24 24" fill="none" 
                  stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" 
                  class="me-2">
                  <path d="M11.525 2.295a.53.53 0 0 1 .95 0l2.31 4.679a2.123 2.123 0 0 0 1.595 1.16l5.166.756a.53.53 0 0 1 .294.904l-3.736 3.638a2.123 2.123 0 0 0-.611 1.878l.882 5.14a.53.53 0 0 1-.771.56l-4.618-2.428a2.122 2.122 0 0 0-1.973 0L6.396 21.01a.53.53 0 0 1-.77-.56l.881-5.139a2.122 2.122 0 0 0-.611-1.879L2.16 9.795a.53.53 0 0 1 .294-.906l5.165-.755a2.122 2.122 0 0 0 1.597-1.16z"></path>
              </svg>
              <span class="fw-semibold text-white p-1">
                  Votre Partenaire Immobilier &amp; Services de Confiance depuis 15 ans
              </span>
          </div>
  
          <marquee class="mt-2 mb-3" direction="left">
              <h1 class="fw-bold" style="font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif">
                  Immobilier & Services Premium <span style="color: #005078;">au Cœur du Bénin</span>
              </h1>
          </marquee>
  
          <h5 class="text-muted">
              Découvrez notre sélection exclusive de biens immobiliers et nos services d'accompagnement.<br>
              Plus de <strong>500 clients</strong> nous font confiance pour concrétiser leurs projets.
          </h5>

          <br>

          <div class="d-flex justify-content-center gap-2 mt-2">
              <a href="{{ route('catalogue') }}" class="btn btn-sm btn-dark d-flex align-items-center gap-2 btn-explorer">
                  Explorer le catalogue
                  <svg xmlns="http://www.w3.org/2000/svg" 
                      width="35" height="35" viewBox="0 0 24 24" fill="none" 
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <line x1="5" y1="12" x2="19" y2="12"></line>
                      <polyline points="12 5 19 12 12 19"></polyline>
                  </svg>
              </a>
              <a href="tel:+2290196233121" class="btn btn-sm btn-outline-dark d-flex align-items-center gap-2 btn-consult">
                  Consultation gratuite
                  <svg xmlns="http://www.w3.org/2000/svg" 
                      width="20" height="20" viewBox="0 0 24 24" fill="none" 
                      stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                      <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.63 A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.41 12.41 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11l-1.27 1.27  a16 16 0 0 0 6 6l1.27-1.27  a2 2 0 0 1 2.11-.45 12.41 12.41 0 0 0 2.81.7 A2 2 0 0 1 22 16.92z"></path>
                  </svg>
              </a>
          </div>

          <div class="my-5 animate">
            <div class="container aide-grid">
              <div class="row">
                <div class="col-12 col-lg-6 mb-5 card-link animate__animated animate__fadeInLeft">
                  <a href="http://127.0.0.1:8000/contact" class="aide-card-link js-nav-link" data-target="dashboard">
                    <div class="icon-top-left">
                      <i class="bi bi-house-add"></i>
                    </div>
                    <center><h5>Achat & vente de bien</h5></center>
                    <p>
                      Trouvez et acquérez le bien immobilier de vos rêves grâce à notre sélection rigoureuse de maisons, appartements et terrains de qualité supérieure.
                    </p>
                    <span class="arrow">→</span>
                  </a>
                </div>
        
                <div class="col-12 col-lg-6 mb-5 card-link animate__animated animate__fadeInRight">
                  <a href="http://127.0.0.1:8000/contact" class="aide-card-link js-nav-link" data-target="demandes">
                    <div class="icon-top-left">
                      <i class="bi bi-car-front"></i>
                    </div>
                    <center><h5>Gestion Locative</h5></center>
                    <p>
                      Confiez-nous la vente de votre bien immobilier et bénéficiez d’un accompagnement personnalisé pour une transaction rapide, sûre et avantageuse.
                    </p>
                    <span class="arrow">→</span>
                  </a>
                </div>
          
                <div class="col-12 col-lg-6 mb-5 card-link animate__animated animate__fadeInLeft">
                  <a href="http://127.0.0.1:8000/contact" class="aide-card-link js-nav-link" data-target="calendrier">
                    <div class="icon-top-left">
                      <i class="bi bi-building"></i>
                    </div>
                    <center><h5>BTP & construction</h5></center>
                    <p>
                      Découvrez notre large catalogue d’appartements de luxe pour toutes occasions, studios et villas modernes à la location, adaptés à vos besoins et à votre budget.
                    </p>
                    <span class="arrow">→</span>
                  </a>
                </div>

                <div class="col-12 col-lg-6 mb-5 card-link animate__animated animate__fadeInRight">
                  <a href="http://127.0.0.1:8000/contact" class="aide-card-link js-nav-link" data-target="parametres">
                    <div class="icon-top-left">
                      <i class="bi bi-check2-circle"></i>
                    </div>
                    <center><h5>Conseils</h5></center>
                    <p>
                      Profitez de notre expertise et de notre engagement et recevez des conseils stratégiques pour optimiser vos projets immobiliers en toute sérénité.
                    </p>
                    <span class="arrow">→</span>
                  </a>
                </div>
              </div>
            </div>
          </div>          
      </div>
    </div>
  </section>


  <section class="plans pb-5">
    <div class="container">
      <h2 class="text-center fw-bold mb-2" style="color:#005078;">
        Choisissez le plan qui vous convient
      </h2>
      <p class="text-center mb-5">
        Des offres flexibles pour les propriétaires et les locataires.
      </p>

      <center>
        <div class="btn-group plan-btn-group" role="group" aria-label="Plans">
          <button class="btn plan-tab first" data-target="gestion">
            <i class="fas fa-cogs"></i> Gestion locative
          </button>
          <button class="btn plan-tab middle" data-target="location">
            <i class="fas fa-key"></i> Mise en location
          </button>
          <button class="btn plan-tab last" data-target="annonce">
            <i class="fas fa-bullhorn"></i> Annonce
          </button>
        </div>        
      </center>

      <div class="plans-content my-3">
        <div class="plan-panel active" id="gestion">
          <div class="row g-4">
            <div class="col-md-6">
              <div class="card shadow-lg plan-card h-100">
                <div class="card-body">
                  <h5 class="fw-bold mb-3 text-center text-white rounded p-2" style="background-color: #005078">
                    <i class="fas fa-box me-2"></i> Offre Standard
                  </h5>
                  <h3 class="fw-bold text-center mb-3">8 % du loyer / mois</h3>
                  <ul class="list-unstyled">
                    <li><i class="bi bi-patch-check-fill"></i> Gestion des loyers en ligne</li>
                    <li><i class="bi bi-patch-check-fill"></i> Suivi des paiements en temps réel</li>
                    <li><i class="bi bi-patch-check-fill"></i> Accès aux rapports financiers</li>
                    <li><i class="bi bi-patch-check-fill"></i> Support client basique</li>
                  </ul>
                  <div class="text-center mt-3">
                    <a href="{{ route('contact') }}" class="btn btn-dark btn-lg" style="background-color: #005078">Prendre contact</a>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="col-md-6">
              <div class="card shadow-lg plan-card h-100 border premium border-success">
                <div class="card-body">
                  <h5 class="fw-bold mb-3 text-center text-white bg-success rounded p-2">
                    <i class="fas fa-gem me-2"></i> Offre Premium
                  </h5>
                  <h3 class="fw-bold text-center mb-3">10 % du loyer / mois</h3>
                  <ul class="list-unstyled">
                    <li><i class="bi bi-patch-check-fill"></i>Toutes les fonctionnalités Standard</li>
                    <li><i class="bi bi-patch-check-fill"></i>Assistance 24/7 prioritaire</li>
                    <li><i class="bi bi-patch-check-fill"></i>Contrats numériques</li>
                    <li><i class="bi bi-patch-check-fill"></i>Tableau de bord dédié</li>
                    <li><i class="bi bi-patch-check-fill"></i>Notifications Email + SMS</li>
                  </ul>
                  <div class="text-center mt-3">
                    <a href="{{ route('contact') }}" class="btn btn-success btn-lg">Prendre contact</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  
        <!-- Mise en location -->
        <div class="plan-panel" id="location">
          <div class="card shadow-lg plan-card mx-auto" style="max-width:450px;">
            <div class="card-body">
              <h5 class="fw-bold mb-3 text-center text-white bg-primary rounded p-2">
                <i class="fas fa-lightbulb me-2"></i> Offre Découverte
              </h5>
              <h3 class="fw-bold text-center mb-3">Frais unique : 1 mois de loyer</h3>
              <ul class="list-unstyled">
                <li><i class="bi bi-patch-check-fill"></i> Annonce attractive</li>
                <li><i class="bi bi-patch-check-fill"></i> Gestion des visites et locataires</li>
                <li><i class="bi bi-patch-check-fill"></i> Rapport détaillé</li>
                <li><i class="bi bi-patch-check-fill"></i> Suivi des nouveaux locataires</li>
              </ul>
              <div class="text-center mt-3">
                <a href="{{ route('contact') }}" class="btn btn-primary btn-lg">Prendre contact</a>
              </div>
            </div>
          </div>
        </div>
  
        <div class="plan-panel" id="annonce">
          <div class="row g-4">
            <div class="col-md-6">
              <div class="card shadow-lg plan-card h-100">
                <div class="card-body">
                  <h5 class="fw-bold mb-3 text-center text-white rounded p-2" style="background-color: #005078">
                    <i class="fas fa-bullhorn me-2"></i> Annonce Standard
                  </h5>
                  <h3 class="fw-bold text-center mb-3">6 000 XOF</h3>
                  <ul class="list-unstyled">
                    <li><i class="bi bi-patch-check-fill"></i>Mise en ligne pendant 1 mois</li>
                    <li><i class="bi bi-patch-check-fill"></i>Support pour optimiser l’annonce</li>
                    <li><i class="bi bi-patch-check-fill"></i>Accès à une liste d’intéressés</li>
                  </ul>
                  <div class="text-center mt-3">
                    <a href="{{ route('contact') }}" class="btn btn-lg text-light" style="background-color: #005078">Prendre contact</a>
                  </div>
                </div>
              </div>
            </div>
  
            <div class="col-md-6">
              <div class="card shadow-lg plan-card h-100 border premium border-success">
                <div class="card-body">
                  <h5 class="fw-bold mb-3 text-center text-white bg-success rounded p-2">
                    <i class="fas fa-star me-2"></i> Annonce Premium
                  </h5>
                  <h3 class="fw-bold text-center mb-3">10 000 XOF</h3>
                  <ul class="list-unstyled">
                    <li><i class="bi bi-patch-check-fill text-success"></i> Mise en avant sur la page d’accueil</li>
                    <li><i class="bi bi-patch-check-fill text-success"></i></i> Campagne de boostage visibilité</li>
                    <li><i class="bi bi-patch-check-fill text-success"></i> Accès à une liste premium d’intéressés</li>
                  </ul>
                  <div class="text-center mt-3">
                    <a href="{{ route('contact') }}" class="btn btn-success btn-lg">Prendre contact</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
  
      </div>
    </div>
  </section>

  <section class="allServices py-2">
    <div class="container">
      <h2 class="text-center fw-bold mb-3" style="color: #005078;">
        Tous Nos Services
      </h2>
      <p class="text-center mb-5">
        Un accompagnement complet pour l'immobilier et bien plus encore
      </p>
  
      <div class="row g-4">
        <!-- Service 1 -->
        <div class="col-md-6 col-lg-4" data-aos="fade-up">
          <div class="allservice-card text-center p-4 shadow-sm h-100">
            <div class="icon mb-3">
              <i class="bi bi-tags" style="font-size:2rem; color:#1d4ed8;"></i>
            </div>
            <h5 class="fw-bold">Immobilier - Location - Vente</h5>
            <p class="text-muted small">  
              Accompagnement complet dans la vente de votre bien avec estimation gratuite, marketing personnalisé, et gestion locative complète de votre patrimoine immobilier.
            </p>
          </div>
        </div>
  
        <!-- Service 2 -->
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="allservice-card text-center p-4 shadow-sm h-100">
            <div class="icon mb-3">
              <i class="bi bi-house" style="font-size:2rem; color:#1d4ed8;"></i>
            </div>
            <h5 class="fw-bold">BTP et construction</h5>
            <p class="text-muted small">
              Suivi de chantier - Construction de bâtiments (résidences, immeubles) -Vente de matériaux de construction modernes

            </p>
          </div>
        </div>
  
        <!-- Service 3 -->
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
          <div class="allservice-card text-center p-4 shadow-sm h-100">
            <div class="icon mb-3">
              <i class="bi bi-check-circle" style="font-size:2rem; color:#1d4ed8;"></i>
            </div>
            <h5 class="fw-bold">Conseil & Expertise</h5>
            <p class="text-muted small">
              Conseils d'experts pour vos investissements immobiliers et évaluation professionnelle de vos biens.
            </p>
          </div>
        </div>
  
        <!-- Service 4 -->
        <div class="col-md-6 col-lg-4" data-aos="fade-up">
          <div class="allservice-card text-center p-4 shadow-sm h-100">
            <div class="icon mb-3">
              <i class="bi bi-airplane" style="font-size:2rem; color:#1d4ed8;"></i>
            </div>
            <h5 class="fw-bold">Voyage à l'Étranger</h5>
            <p class="text-muted small">
              Organisation complète de voyages d'affaires et touristiques avec assistance visa.
            </p>
          </div>
        </div>
  
        <!-- Service 5 -->
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
          <div class="allservice-card text-center p-4 shadow-sm h-100">
            <div class="icon mb-3">
              <i class="bi bi-flower3" style="font-size:2rem; color:#1d4ed8;"></i>
            </div>
            <h5 class="fw-bold">Entretien Espace Vert</h5>
            <p class="text-muted small">
              Entretien professionnel de jardins, espaces verts et aménagement paysager.
            </p>
          </div>
        </div>
  
        <!-- Service 6 -->
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
          <div class="allservice-card text-center p-4 shadow-sm h-100">
            <div class="icon mb-3">
              <i class="bi bi-stars" style="font-size:2rem; color:#1d4ed8;"></i>
            </div>
            <h5 class="fw-bold">Entretien Carrelage</h5>
            <p class="text-muted small">
              Nettoyage, rénovation et entretien professionnel des carrelages et sols.
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>
  
  
  <section class="carousel-apple pt-5" id="caroussel">
    <div class="swiper mySwiper">
      <div class="swiper-wrapper">
        <div class="swiper-slide"><img src="{{ asset('assets/images/new2.jpg') }}" alt="Image 1" class="w-100"></div>
        <div class="swiper-slide"><img src="{{ asset('assets/images/new8.jpg') }}" alt="Image 2" class="w-100"></div>
        <div class="swiper-slide"><img src="{{ asset('assets/images/new7.jpg') }}" alt="Image 3" class="w-100"></div>
        <div class="swiper-slide"><img src="{{ asset('assets/images/new17.jpg') }}" alt="Image 4" class="w-100"></div>
        <div class="swiper-slide"><img src="{{ asset('assets/images/c.jpg') }}" alt="Image 5" class="w-100"></div>
      </div>    
  
      <!-- Pagination spécifique -->
      <div class="swiper-pagination mySwiper-pagination"></div>
    </div>
  </section>


  <section class="nosResultats py-4">
    <div class="container">
      <h2 class="titre" style="color: #005078">Nos Résultats Parlent d'Eux-Mêmes</h2>
      <p class="sous-titre" style="color: #005078">Plus de 15 ans d'expertise au service de vos projets</p>
  
      <div class="row resultats-grid g-4"> <!-- g-4 = marges entre colonnes/rows -->
        
        <div class="col-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300"> 
          <div class="resultat-item">
            <i class="bi bi-people-fill"></i>
            <h3>500+</h3>
            <p>Clients Satisfaits</p>
          </div>
        </div>
  
        <div class="col-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300"> 
          <div class="resultat-item">
            <i class="bi bi-building"></i>
            <h3>300+</h3>
            <p>Biens Vendus</p>
          </div>
        </div>
  
        <div class="col-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300"> 
          <div class="resultat-item">
            <i class="bi bi-graph-up"></i>
            <h3>15+</h3>
            <p>Années d'Expérience</p>
          </div>
        </div>
  
        <div class="col-6 col-lg-3" data-aos="zoom-in" data-aos-delay="300"> 
          <div class="resultat-item">
            <i class="bi bi-star-fill"></i>
            <h3>4.8<span>/5</span></h3>
            <p>Note Moyenne</p>
          </div>
        </div>
  
      </div>
    </div>
  </section>
  
  <section class="temoignage py-5">
    <div class="container">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold mb-0" style="color: #005078;">Ce Que Disent Nos Clients</h2>
        
        <!-- Flèches sur la même ligne -->
        <div class="d-flex gap-2">
          <button class="temoignage-prev btn btn-outline-primary rounded-circle p-2"></button>
          <button class="temoignage-next btn btn-outline-primary rounded-circle p-2"></button>
        </div>
      </div>
  
      <div class="swiper temoignage-swiper">
        <div class="swiper-wrapper">
          @foreach($temoignages as $temoignage)
            <div class="swiper-slide">
              <div class="card text-center p-3">
                <div class="stars text-warning mb-2">★★★★★</div>
                <img src="{{ $temoignage->photo 
                          ? asset('storage/' . $temoignage->photo) 
                          : asset('assets/images/default-user.jpg') }}" 
                     class="rounded-circle mb-2 mx-auto" 
                     style="width:60px; height:60px; object-fit:cover;" alt="photo">
                <p class="fst-italic">"{{ $temoignage->message }}"</p>
                <h6 class="fw-bold mb-0">{{ $temoignage->nom }} {{ $temoignage->prenom }}</h6>
                <small class="text-muted">{{ $temoignage->profession ?? ucfirst($temoignage->role) }}</small>
              </div>
            </div>
          @endforeach
        </div>
  
        <!-- Pagination spécifique -->
        <div class="swiper-pagination temoignage-pagination mt-0"></div>
      </div>

      <div class="text-center mt-4"> <a href="{{ route('temoignages.create') }}" class="btn btn-outline-success rounded-pill px-4 py-2 d-inline-flex align-items-center gap-2 mx-auto"> <span class="fs-5 fw-bold">+</span> <span>Ajouter un témoignage</span> </a>
    </div>
  </section>


  <section class="concretiserProjet pt-1">
    <div class="d-flex justify-content-center">
      <div class="text-center text-light border border-1 rounded-pill px-4 py-2 bg-dark d-inline-block">
        <p class="mb-0 fw-semibold">
          Consultation Gratuite • Accompagnement Personnalisé
        </p>
      </div>
    </div>

    <h5 class="text-center pt-3" style="color: #005078">
      Que vous souhaitiez acheter, vendre, louer ou bénéficier de nos services d'accompagnement.
    </h5>

    <h6  class="text-center" style="color: #005078" ><strong>Notre équipe d'experts vous accompagne à chaque étape avec un service personnalisé.<br></strong></h6>
  

    <br>

    <div class="d-flex justify-content-center gap-2 mt-2">
        <a href="{{ route('contact') }}" class="btn btn-sm btn-dark d-flex align-items-center gap-2 btn-explorer">
            Démarrer mon projet
            <svg xmlns="http://www.w3.org/2000/svg" 
                width="35" height="35" viewBox="0 0 24 24" fill="none" 
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </a>
        <a href="{{ route('catalogue') }}" class="btn btn-sm btn-outline-dark d-flex align-items-center gap-2 btn-consult">
          Pacourir le catalogue
            <svg xmlns="http://www.w3.org/2000/svg" 
                width="20" height="20" viewBox="0 0 24 24" fill="none" 
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.63 A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.41 12.41 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11l-1.27 1.27  a16 16 0 0 0 6 6l1.27-1.27  a2 2 0 0 1 2.11-.45 12.41 12.41 0 0 0 2.81.7 A2 2 0 0 1 22 16.92z"></path>
            </svg>
        </a>
    </div>

    <div class="container py-4">
      <div class="row text-center">
        
        <div class="col-6 col-lg-3 mb-3">
          <div class="d-flex align-items-center justify-content-center gap-2">
            <h6><i class="bi bi-check-circle-fill text-primary"></i></h6>
            <span class="fw-semibold">Estimation gratuite</span>
          </div>
        </div>
    
        <div class="col-6 col-lg-3 mb-3">
          <div class="d-flex align-items-center justify-content-center gap-2">
            <h6><i class="bi bi-check-circle-fill text-primary"></i></h6>
            <span class="fw-semibold">Accompagnement juridique</span>
          </div>
        </div>
    
        <div class="col-6 col-lg-3 mb-3">
          <div class="d-flex align-items-center justify-content-center gap-2">
            <h6><i class="bi bi-check-circle-fill text-primary"></i></h6>
            <span class="fw-semibold">Suivi personnalisé</span>
          </div>
        </div>
    
        <div class="col-6 col-lg-3 mb-3">
          <div class="d-flex align-items-center justify-content-center gap-2">
            <h6><i class="bi bi-check-circle-fill text-primary"></i></h6>
            <span class="fw-semibold">Services multiples</span>
          </div>
        </div>
    
      </div>
    </div>
  
  </section>
  
  
<script> 
  AOS.init({
    duration: 1000, // durée de l’animation (ms)
    once: true,     // animation ne se joue qu'une seule fois
    offset: 120     // distance avant déclenchement
  });
</script>
  

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>    // Swipper, pour le caroussel central
      var swiper = new Swiper(".mySwiper", {
      centeredSlides: true,
      slidesPerView: 3,
      spaceBetween: 0,
      loop: true,
      autoplay: {
          delay: 3000,        // défilement auto toutes les 3s
          disableOnInteraction: false, 
      },
      speed: 600,           // transition plus rapide (600ms)
      pagination: {
          el: ".swiper-pagination",
          clickable: true,
      },
      breakpoints: {
          0: { slidesPerView: 1 },   // mobile
          768: { slidesPerView: 3 }, // tablette & pc
      }
      });
</script>

<script>
  // Carousel Images
  var swiperImages = new Swiper(".mySwiper", {
    centeredSlides: true,
    slidesPerView: 3,
    spaceBetween: 0,
    loop: true,
    autoplay: { delay: 3000, disableOnInteraction: false },
    speed: 600,
    pagination: { el: ".mySwiper-pagination", clickable: true },
    breakpoints: {
      0: { slidesPerView: 1 },
      768: { slidesPerView: 3 },
    }
  });

  // Carousel Témoignages
  var swiperTemoignages = new Swiper(".temoignage-swiper", {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,
    autoplay: { delay: 4000, disableOnInteraction: false },
    navigation: { nextEl: ".temoignage-next", prevEl: ".temoignage-prev" },
    pagination: { el: ".temoignage-pagination", clickable: true },
    breakpoints: {
      576: { slidesPerView: 1 },
      768: { slidesPerView: 2 },
      992: { slidesPerView: 3 },
    },
  });
</script>

<script>  // Animaion shake
    // Animation shake quand on clique dans la recherche
    const searchInput = document.querySelector('.search-bar');
    const navLinks = document.querySelectorAll('.nav-link');

    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navLinks.forEach(l => l.classList.remove('active'));    // Retire "active" de tous les lien
            link.classList.add('active');   // Ajoute "active" au lien cliqué
        });
    });

    searchInput.addEventListener('click', () => {
        searchInput.classList.add('shake');
        setTimeout(() => searchInput.classList.remove('shake'), 400);
    });
</script>

<script>  // plans standars & premium
  document.querySelectorAll(".plan-tab").forEach(btn => {
    btn.addEventListener("click", () => {
      // onglets actifs
      document.querySelectorAll(".plan-tab").forEach(b => b.classList.remove("active"));
      btn.classList.add("active");
  
      // panels
      document.querySelectorAll(".plan-panel").forEach(p => p.classList.remove("active"));
      document.getElementById(btn.dataset.target).classList.add("active");
    });
  });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

@endsection