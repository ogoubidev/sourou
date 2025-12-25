@extends('layouts.app')

@section('title', 'Actualités')

@section('content')
<style>

.blog-container {
    max-width: 1200px;
    margin: 60px auto;
    padding: 0 20px;
}

.blog-header {
    text-align: center;
    margin-bottom: 40px;
}

.blog-header h2 {
    font-weight: 700;
    font-size: 2.2rem;
    color: #222;
    position: relative;
}

.blog-header h2::after {
    content: "";
    display: block;
    width: 80px;
    height: 4px;
    background: #005078;
    margin: 10px auto 0;
    border-radius: 2px;
}

.blog-layout {
    display: grid;
    grid-template-columns: 3fr 1fr;
    gap: 30px;
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

/* --- CARD --- */
.blog-card {
    position: relative;
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
    cursor: pointer;
}

.blog-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}

/* --- IMAGE --- */
.blog-card img {
    width: 100%;
    height: 230px;
    object-fit: cover;
    transition: transform 0.4s ease;
    position: relative;
    z-index: 1;
}

/* Bordure animée sur l’image */
.blog-card img::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 4px;
    background: #005078;
    transform: translateX(-50%);
    transition: all 0.5s ease;
    border-radius: 2px;
    z-index: 2;
}

.blog-card:hover img::after {
    width: 100%;
}

.blog-card:hover img {
    transform: scale(1.05);
}

/* --- LOGO CIRCULAIRE --- */
.blog-logo-circle {
    position: absolute;
    top: 190px; /* chevauche image et carte */
    left: 50%;
    transform: translateX(-50%);
    width: 90px;
    height: 90px;
    background: #fff;
    border-radius: 50%;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 3;
    overflow: hidden;
    border: 3px solid #005078;
}

.blog-logo-circle img {
    width: 100%;
    height: auto;
}

/* --- CORPS --- */
.blog-card-body {
    padding: 70px 20px 25px;
    text-align: center;
}

.blog-card-body h5 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #00334d;
    margin-bottom: 10px;
}

.blog-card-body p {
    color: #555;
    font-size: 0.95rem;
    margin-bottom: 15px;
    min-height: 50px;
}

/* --- BOUTON “VOIR +” --- */
.blog-card .view-btn {
    display: inline-block;
    background: #005078;
    color: #fff;
    font-weight: 600;
    padding: 8px 18px;
    border-radius: 25px;
    text-decoration: none;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.blog-card:hover .view-btn {
    opacity: 1;
    transform: translateY(0);
    animation: flashArrow 1.5s infinite;
}

@keyframes flashArrow {
    0% { box-shadow: 0 0 0px #005078; }
    50% { box-shadow: 0 0 15px #0073aa; }
    100% { box-shadow: 0 0 0px #005078; }
}

.view-btn span {
    display: inline-block;
    transition: transform 0.3s;
}

.view-btn:hover span {
    transform: translateX(5px);
}

/* --- SIDEBAR --- */
.sidebar {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    height: fit-content;
}

.sidebar h4 {
    margin-bottom: 15px;
    font-weight: 700;
    color: #00334d;
    border-bottom: 3px solid #005078;
    display: inline-block;
    padding-bottom: 5px;
}

.recent-posts a {
    display: block;
    color: #333;
    margin-bottom: 10px;
    text-decoration: none;
    font-size: 0.95rem;
    transition: 0.3s;
}

.recent-posts a:hover {
    color: #005078;
}

.search-box input {
    width: 100%;
    padding: 10px 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    outline: none;
}

@media(max-width: 992px) {
    .blog-layout {
        grid-template-columns: 1fr;
    }
}


/* --- WRAPPER IMAGE --- */
.image-wrapper {
    position: relative;
    overflow: hidden;
}

/* Bordure animée qui traverse l'image au survol */
.image-wrapper::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 8px;
    background: #005078;
    transform: translateX(-50%);
    transition: all 0.6s ease;
    border-radius: 2px;
    z-index: 3;
}

.blog-card:hover .image-wrapper::after {
    width: 100%;
}

/* Effet zoom sur l’image au survol */
.image-wrapper img {
    width: 100%;
    height: 230px;
    object-fit: cover;
    transition: transform 0.4s ease;
    position: relative;
    z-index: 1;
}

.blog-card:hover .image-wrapper img {
    transform: scale(1.05);
}

</style>

<div class="blog-container">
    <div class="blog-header">
        <h2>Nos Actualités</h2>
    </div>

    @if(isset($query))
        <h4>Résultats pour « {{ $query }} »</h4>
    @endif

    <div class="blog-layout">
        <!-- SECTION DES ARTICLES -->
        <div class="blog-grid">
            @foreach ($posts as $post)
                <div class="blog-card">
                    <div class="image-wrapper">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->titre }}">
                    </div>

                    <!-- Logo circulaire au centre -->
                    <div class="blog-logo-circle">
                        <img src="{{ asset('assets/images/logotype sourou bleu_Plan de travail 1.png') }}" alt="SIS SARL">
                    </div>

                    <div class="blog-card-body">
                        <h5>{{ $post->titre }}</h5>
                        <p>{{ Str::limit($post->resume, 100) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="view-btn">
                            Voir plus <span>&raquo;&raquo;&raquo;</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="search-box mb-4">
                <form action="{{ route('blog.search') }}" method="GET" class="d-flex">
                    <input 
                        type="text" 
                        name="q" 
                        placeholder="Rechercher un article..." 
                        value="{{ request('q') }}" 
                        class="form-control me-2"
                    >
                    <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <div class="recent-posts">
                <h4>Articles récents</h4>
                @foreach ($recentPosts as $recent)
                    <a href="{{ route('blog.show', $recent->slug) }}">{{ $recent->titre }}</a>
                @endforeach
            </div>
        </div>
        
    </div>
</div>

<!-- Section Blog -->

<section class="blog-section py-5">
    <div class="container">
        <div class="row">
            <!-- NOUVELLE NOMINATION - NOUVEL ARTICLE -->
            <div class="col-lg-8 mb-5">
                <article class="blog-post card border-0 shadow-sm">
                    <!-- En-tête de l'article -->
                    <div class="card-body p-4">
                        <!-- Titre -->
                        <h1 class="blog-title fw-bold mb-3" style="color: #005078;">
                            🏆 Nominée meilleure société immobilière de l'année 2025 !
                        </h1>
                        
                      
                        <!-- Image Principale -->
                        <div class="blog-main-image mb-4">
        <div class="media-container">
  <div class="video-section">
    <video controls width="100%">
      <source src="{{ asset('assets/videos/VID-20251221-WA0013.mp4') }}" type="video/mp4">
      Votre navigateur ne supporte pas la lecture de vidéos.
    </video>
  </div>
  
  <div class="image-section">
    <img src="{{ asset('assets/videos/IMG-20251129-WA0021.jpg') }}" alt="Description de l'image" class="side-image"> <br><br>
     <video controls width="100%">
      <source src="{{ asset('assets/videos/VID-20251221-WA0012.mp4') }}" type="video/mp4">
      Votre navigateur ne supporte pas la lecture de vidéos.
    </video> <br>
    <img src="{{ asset('assets/videos/IMG-20251213-WA0010.jpg') }}" alt="Description de l'image" class="side-image">

  </div>
</div>

<style>
.media-container {
  display: flex;
  gap: 20px;
  align-items: flex-start; /* Aligne en haut */
  margin: 20px 0;
}

.video-section {
  flex: 2; /* La vidéo prend plus de place */
  min-width: 0; /* Important pour le responsive */
}

.image-section {
  flex: 1; /* L'image prend moins de place */
}

.side-image {
  width: 100%;
  height: auto;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

/* Responsive */
@media (max-width: 768px) {
  .media-container {
    flex-direction: column;
  }
}
</style>

                            <p class="text-muted text-center mt-2 small">
                                <em>Nominée au prestigieux Gala de l'Immobilier Africain 2025</em>
                            </p>
                        </div>
                        
                        <!-- Contenu de l'article -->
                        <div class="blog-content">
                            <!-- Introduction -->
                            <div class="blog-intro mb-4">
                                <p class="lead fw-semibold" style="color: #005078;">
                                    Nous sommes honorés et fiers d'annoncer que <strong>SOUROU IMMOBILIER SERVICE SARL</strong> 
                                    a été nominée <strong>"Meilleure société immobilière de l'année 2025"</strong> 
                                    au prestigieux <strong>Gala de l'Immobilier Africain</strong> !
                                </p>
                            </div>
                            
                            <!-- Section Détails -->
                            <div class="blog-details-section mb-4">
                                <h3 class="h4 fw-bold mb-3" style="color: #005078;">
                                    📍 Une reconnaissance d'excellence
                                </h3>
                                
                                <div class="row mb-4">
                                    <div class="col-md-6 mb-3">
                                        <div class="achievement-card p-4 border rounded-3 h-100">
                                            <div class="d-flex align-items-start">
                                                <div class="achievement-icon me-3">
                                                    <i class="fas fa-award fa-2x" style="color: #005078;"></i>
                                                </div>
                                                <div>
                                                    <h5 class="fw-bold mb-2">Nomination prestigieuse</h5>
                                                    <p class="mb-0">Reconnaissance parmi les meilleures sociétés immobilières d'Afrique</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="achievement-card p-4 border rounded-3 h-100">
                                            <div class="d-flex align-items-start">
                                                <div class="achievement-icon me-3">
                                                    <i class="fas fa-globe-africa fa-2x" style="color: #005078;"></i>
                                                </div>
                                                <div>
                                                    <h5 class="fw-bold mb-2">Portée continentale</h5>
                                                    <p class="mb-0">Compétition au niveau panafricain avec les plus grands acteurs du secteur</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Description du gala -->
                                <div class="gala-description p-4 bg-light rounded-3 mb-4">
                                    <h4 class="h5 fw-bold mb-3" style="color: #005078;">
                                        <i class="fas fa-star me-2"></i>À propos du Gala de l'Immobilier Africain
                                    </h4>
                                    <p class="mb-3">
                                        Le Gala de l'Immobilier Africain est l'événement annuel le plus prestigieux du secteur 
                                        immobilier en Afrique. Il récompense l'excellence, l'innovation et le leadership 
                                        des entreprises qui contribuent au développement du marché immobilier africain.
                                    </p>
                                    <ul class="mb-0">
                                        <li><strong>Périmètre :</strong> Toute l'Afrique</li>
                                        <li><strong>Catégories :</strong> 15 catégories de récompenses</li>
                                        <li><strong>Jury :</strong> Experts internationaux de l'immobilier</li>
                                     
                                    </ul>
                                </div>
                                
                                <!-- Section Réflexion -->
                                <div class="reflection-section mb-4">
                                    <h3 class="h4 fw-bold mb-3" style="color: #005078;">
                                        🤝 Ce que cette nomination signifie pour nous
                                    </h3>
                                    <p>
                                        Cette nomination est bien plus qu'une simple reconnaissance. Elle représente :
                                    </p>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="meaning-card p-3 border rounded h-100">
                                                <h6 class="fw-bold mb-2">🎯 La validation de notre vision</h6>
                                                <p class="small mb-0">Notre approche innovante et durable est reconnue au niveau continental</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="meaning-card p-3 border rounded h-100">
                                                <h6 class="fw-bold mb-2">💪 L'engagement de notre équipe</h6>
                                                <p class="small mb-0">Le travail acharné et le dévouement de chaque collaborateur portent leurs fruits</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="meaning-card p-3 border rounded h-100">
                                                <h6 class="fw-bold mb-2">🤝 La confiance de nos clients</h6>
                                                <p class="small mb-0">Votre fidélité et satisfaction nous ont permis d'atteindre ce niveau</p>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="meaning-card p-3 border rounded h-100">
                                                <h6 class="fw-bold mb-2">🌍 Le rayonnement du Bénin</h6>
                                                <p class="small mb-0">Nous portons fièrement les couleurs du Bénin sur la scène immobilière africaine</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Remerciements -->
                                <div class="thanks-section p-4 rounded-3" style="background-color: #005078; color: white;">
                                    <h4 class="h5 fw-bold mb-3">
                                        <i class="fas fa-hands-clapping me-2"></i>Nos remerciements
                                    </h4>
                                    <p class="mb-0">
                                        Nous tenons à remercier chaleureusement nos clients, partenaires, et toute notre équipe 
                                        pour leur soutien continu. Cette nomination est la vôtre autant que la nôtre !
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Signature -->
                            <div class="blog-signature mt-5 pt-4 border-top">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-trophy fa-2x" style="color: #005078;"></i>
                                    </div>
                                    <div>
                                        <p class="fw-bold mb-1" style="color: #005078;">
                                            SOUROU IMMOBILIER SERVICE SARL
                                        </p>
                                        <p class="text-muted small mb-0">
                                            Nominée "Meilleure société immobilière de l'année 2025"
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer de l'article -->
                    <div class="card-footer bg-light py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="blog-tags">
                                <span class="badge bg-warning me-2">🏆 Récompense</span>
                                <span class="badge bg-primary me-2">Immobilier</span>
                                <span class="badge bg-info me-2">Afrique</span>
                                <span class="badge bg-success">Excellence</span>
                            </div>
                            <div class="blog-share">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-share-alt me-1"></i> Partager la bonne nouvelle
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            
            <!-- ANCIEN ARTICLE - Entrée du nouvel actionnaire -->
            <div class="col-lg-8">
                <article class="blog-post card border-0 shadow-sm">
                    <!-- En-tête de l'article -->
                    <div class="card-body p-4">
                        <!-- Titre -->
                        <h1 class="blog-title fw-bold mb-3" style="color: #005078;">
                            🎉 SOUROU IMMOBILIER SERVICE SARL franchit une nouvelle étape !
                        </h1>
                        
                        <!-- Métadonnées -->
                        <div class="blog-meta d-flex flex-wrap gap-3 mb-4 text-muted">
                            <span><i class="far fa-calendar me-1"></i> 20 Novembre 2025</span>
                            <span><i class="far fa-user me-1"></i> Équipe SOUROU IMMOBILIER</span>
                            <span><i class="far fa-folder me-1"></i> Actualités, Événements</span>
                        </div>
                        
                        <!-- Image Principale -->
                        <div class="blog-main-image mb-4">
                            <img src="{{ asset('assets/images/actualite/WhatsApp Image 2025-11-29 at 10.16.31.jpeg') }}" 
                                 class="img-fluid rounded-3 w-100" 
                                 alt="Cérémonie d'entrée du nouvel actionnaire"
                                 style="max-height: 500px; object-fit: cover;">
                            <p class="text-muted text-center mt-2 small">
                                <em>Cérémonie officielle d'entrée de Dr ZOUNDJIEKPON Vincent comme nouvel actionnaire</em>
                            </p>
                        </div>
                        
                        <!-- Contenu de l'article -->
                        <div class="blog-content">
                            <!-- Introduction -->
                            <div class="blog-intro mb-4">
                                <p class="lead fw-semibold" style="color: #005078;">
                                    Nous avons eu l'honneur d'organiser le 20 Novembre 2025, la cérémonie officielle d'entrée de notre nouvel actionnaire,
                                    <strong class="text-dark">Dr ZOUNDJIEKPON Vincent</strong>, un partenaire de vision et d'ambition pour un immobilier moderne, responsable et durable au Bénin et à l'international.
                                </p>
                            </div>
                            
                            <!-- Section Thème -->
                            <div class="blog-theme-section mb-4 p-4 bg-light rounded-3">
                                <h3 class="h4 fw-bold mb-3" style="color: #005078;">
                                    🎯 Sous le thème :
                                </h3>
                                <blockquote class="blockquote fst-italic fs-5 text-center" style="color: #333;">
                                    <strong>« Ensemble pour un développement immobilier durable au Bénin et à l'international »</strong>
                                </blockquote>
                                <p class="text-center mb-0">
                                    cet événement marque une phase décisive dans l'expansion stratégique de notre société.
                                </p>
                            </div>
                            
                            <!-- Section Succès -->
                            <div class="blog-success-section mb-4">
                                <h3 class="h4 fw-bold mb-3" style="color: #005078;">
                                    ✨ La cérémonie a été un véritable succès grâce à :
                                </h3>
                                
                                <!-- Galerie des participants -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-6">
                                        <div class="participant-card p-3 border rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="participant-icon me-3">
                                                    <i class="fas fa-handshake fa-2x" style="color: #005078;"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-1">Partenaires professionnels</h6>
                                                    <p class="small text-muted mb-0">Nos collaborateurs stratégiques</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="participant-card p-3 border rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="participant-icon me-3">
                                                    <i class="fas fa-users fa-2x" style="color: #005078;"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-1">Clients fidèles</h6>
                                                    <p class="small text-muted mb-0">La confiance qui nous anime</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="participant-card p-3 border rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="participant-icon me-3">
                                                    <i class="fas fa-landmark fa-2x" style="color: #005078;"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-1">Autorités locales</h6>
                                                    <p class="small text-muted mb-0">Les autorités de l'arrondissement</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="participant-card p-3 border rounded">
                                            <div class="d-flex align-items-center">
                                                <div class="participant-icon me-3">
                                                    <i class="fas fa-heart fa-2x" style="color: #005078;"></i>
                                                </div>
                                                <div>
                                                    <h6 class="fw-bold mb-1">Famille et proches</h6>
                                                    <p class="small text-muted mb-0">Nos parents et proches</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Galerie de photos -->
                                <div class="row g-3 mb-4">
                                    <div class="col-md-4">
                                        <img src="{{ asset('assets/images/AGECIB.jpeg') }}" 
                                             class="img-fluid rounded shadow-sm" 
                                             alt="Partenaires de la cérémonie"
                                             style="height: 150px; width: 80%;">
                                    </div>
                                    <div class="col-md-4">
                                        <img src="{{ asset('assets/images/logo  aim.png') }}" 
                                             class="img-fluid rounded shadow-sm" 
                                             alt="Clients fidèles"
                                             style="height: 150px; width: 80%;">
                                    </div>
                                   
                                </div>
                                
                                <!-- Section Collaborateurs -->
                                <div class="collaborators-section p-4 bg-light rounded-3">
                                    <h4 class="h5 fw-bold mb-3" style="color: #005078;">
                                        <i class="fas fa-star me-2"></i>Et surtout nos collaborateurs engagés
                                    </h4>
                                    <p class="mb-0">
                                        Un merci spécial à notre équipe dévouée dont l'engagement et le professionnalisme 
                                        ont contribué au succès retentissant de cet événement marquant.
                                    </p>
                                </div>
                            </div>
                            
                            <!-- Signature -->
                            <div class="blog-signature mt-5 pt-4 border-top">
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <i class="fas fa-building fa-2x" style="color: #005078;"></i>
                                    </div>
                                    <div>
                                        <p class="fw-bold mb-1" style="color: #005078;">
                                            SOUROU IMMOBILIER SERVICE SARL
                                        </p>
                                        <p class="text-muted small mb-0">
                                            Votre partenaire immobilier de confiance au Bénin
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer de l'article -->
                    <div class="card-footer bg-light py-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="blog-tags">
                                <span class="badge bg-primary me-2">Immobilier</span>
                                <span class="badge bg-secondary me-2">Investissement</span>
                                <span class="badge bg-success me-2">Développement durable</span>
                                <span class="badge bg-info">Bénin</span>
                            </div>
                            <div class="blog-share">
                                <button class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-share-alt me-1"></i> Partager
                                </button>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <aside class="sidebar ps-lg-4">
                    <!-- À propos -->
                    <div class="sidebar-widget card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3" style="color: #005078;">
                                <i class="fas fa-info-circle me-2"></i>À propos
                            </h5>
                            <p class="small">
                                SOUROU IMMOBILIER SERVICE SARL est une référence dans le secteur immobilier béninois, 
                                offrant des solutions innovantes et durables pour tous vos projets immobiliers.
                            </p>
                            <div class="mt-3 p-3 rounded" style="background-color: #fff8e1;">
                                <h6 class="fw-bold mb-2" style="color: #005078;">
                                    <i class="fas fa-trophy me-1"></i>Nouvelle distinction
                                </h6>
                                <p class="small mb-0">
                                    Nominée "Meilleure société immobilière de l'année 2025" au Gala de l'Immobilier Africain
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Articles récents -->
                    <div class="sidebar-widget card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3" style="color: #005078;">
                                <i class="fas fa-newspaper me-2"></i>Articles récents
                            </h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-3 pb-2 border-bottom">
                                    <a href="#" class="text-decoration-none">
                                        <h6 class="fw-semibold mb-1">🏆 Nominée meilleure société immobilière 2025</h6>
                                        <p class="small text-muted mb-0">Décembre 2025</p>
                                    </a>
                                </li>
                                <li class="mb-3 pb-2 border-bottom">
                                    <a href="#" class="text-decoration-none">
                                        <h6 class="fw-semibold mb-1">Nouvelle entrée d'actionnaire</h6>
                                        <p class="small text-muted mb-0">20 Novembre 2025</p>
                                    </a>
                                </li>
                                <li class="mb-3 pb-2 border-bottom">
                                    <a href="#" class="text-decoration-none">
                                        <h6 class="fw-semibold mb-1">Nouveaux projets immobiliers 2025</h6>
                                        <p class="small text-muted mb-0">15 Novembre 2025</p>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="text-decoration-none">
                                        <h6 class="fw-semibold mb-1">Notre engagement pour le développement durable</h6>
                                        <p class="small text-muted mb-0">5 Novembre 2025</p>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    
                    <!-- Galerie -->
                    <div class="sidebar-widget card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold mb-3" style="color: #005078;">
                                <i class="fas fa-images me-2"></i>Galerie
                            </h5>
                            <div class="row g-2">
                                <div class="col-4">
                                    <img src="{{ asset('assets/images/actualite/WhatsApp Image 2025-11-29 at 10.16.33.jpeg') }}" 
                                         class="img-fluid rounded" 
                                         alt="Projet immobilier"
                                         style="height: 80px; width: 100%; object-fit: cover;">
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('assets/images/actualite/WhatsApp Image 2025-11-29 at 10.16.32.jpeg') }}" 
                                         class="img-fluid rounded" 
                                         alt="Équipe"
                                         style="height: 80px; width: 100%; object-fit: cover;">
                                </div>
                                <div class="col-4">
                                    <img src="{{ asset('assets/images/actualite/photo densemblee.jpeg') }}" 
                                         class="img-fluid rounded" 
                                         alt="Client"
                                         style="height: 80px; width: 100%; object-fit: cover;">
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</section>

<!-- Styles additionnels -->
<style>
    .blog-section {
        background-color: #f8f9fa;
    }
    
    .blog-title {
        font-size: 1.8rem;
        line-height: 1.3;
    }
    
    .blog-content p {
        line-height: 1.7;
        margin-bottom: 1rem;
    }
    
    .participant-card, .achievement-card, .meaning-card {
        transition: transform 0.3s ease;
    }
    
    .participant-card:hover, .achievement-card:hover, .meaning-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .blog-meta i {
        width: 16px;
    }
    
    .sidebar-widget {
        transition: transform 0.3s ease;
    }
    
    .sidebar-widget:hover {
        transform: translateX(5px);
    }
    
    /* Styles spécifiques pour la nomination */
    .achievement-card {
        border-left: 4px solid #005078 !important;
    }
    
    .meaning-card {
        background-color: #f8f9fa;
    }
    
    .gala-description {
        border: 1px solid #e9ecef;
    }
</style>

<!-- Ajouter Font Awesome pour les icônes -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection