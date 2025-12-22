@extends('layouts.app')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="{{ asset('css/apropos.css') }}">


@section('content')

<section class="hero">
    <div class="mt-2 mb-2">
        <h1 class="fw-bold mb-0 pt-5">
            À Propos de Sourou Immobilier
        </h1>
    </div>
    <p class="text-light pb-1">
        Votre partenaire de confiance depuis plus de 15 ans pour tous vos besoins immobiliers au Bénin.<br>
       <strong>Excellence, transparence et accompagnement personnalisé.</strong>
    </p>
</section>


<section class="video">
  <center>
    <video src="{{ asset('assets/videos/vidéo.mp4') }}"  style="width: 450px; height: 450px;" autoplay muted playsinline loop>
    </video>
  </center>
</section>

<section id="presentation" class="">
    <template>
        <div class="container text-center pt-3">        
            <div class="container pt-5">
                <div class="row g-4">
                    <div class="col-md-3">
                        <div class="service-card text-center mx-2 p-4 shadow-sm rounded-4" data-aos="zoom-in" data-aos-delay="200">
                            <h2><i class="bi bi-people-fill"></i></h2>
                            <h5 class="mt-4 mb-0" style="color: #005078"><strong>500+</strong></h5>
                            <h6 class="fw-bold" style="color: #005078"><span>clients satisfaits</span></h6>
                            <p class="mt-0 mb-0" class="text-muted"><h6>Particuliers et professionnels nous font confiance.</h6></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="service-card text-center mx-2 p-4 shadow-sm rounded-4" data-aos="zoom-in" data-aos-delay="200">
                           <h2> <i class="bi bi-building"></i></h2>
                            <h5 class="mt-4 mb-0" style="color: #005078"><strong>300+</strong></h5>
                            <h6 class="fw-bold" style="color: #005078"><span>Bien vendus</span></h6>
                            <p class="mt-0 mb-3" class="text-muted"><h6>Maisons, appartements et terrains.</h6></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="service-card text-center mx-2 p-4 shadow-sm rounded-4" data-aos="zoom-in" data-aos-delay="200">
                            <h2><i class="bi bi-graph-up"></i></h2>
                            <h5 class="mt-4 mb-0" style="color: #005078"><strong>15+</strong></h5>
                            <h6 class="fw-bold" style="color: #005078"><span>Années d'expériences</span></h6>
                            <p class="mt-0 mb-3" class="text-muted"><h6>Au service du marché immobillier béninois.</h6></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="service-card text-center mx-2 p-4 shadow-sm rounded-4" data-aos="zoom-in" data-aos-delay="200">
                            <h2><i class="bi bi-star-fill"></i></h2>
                            <h5 class="mt-4 mb-0" style="color: #005078"><strong>98%</strong></h5>
                            <h6 class="fw-bold" style="color: #005078"><span>Taux de satisfaction</span></h6>
                            <p class="mt-0 mb-3" class="text-muted"><h6>Clients recommandants bos services.</h6></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>


    <div class="container my-5">
        <div class="row g-4">
            <div class="col-md-3">
                <div class="service-card text-center p-4 shadow-sm rounded-4">
                    <div class="icon-wrapper ">
                        <center>
                            <h3><i class="bi bi-house-add"></i></h3>
                        </center>
                    </div>
                    <h5 class="mt-4">Achat</h5>
                    <p class="text-muted">Trouvez la maison de vos rêves parmi nos offres premium.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="service-card text-center p-4 shadow-sm rounded-4">
                    <div class="icon-wrapper">
                        <center>
                        <h3><i class="bi bi-car-front"></i></h3>
                        </center>
                    </div>
                    <h5 class="mt-4">Vente</h5>
                    <p class="text-muted">Vendez rapidement vos biens immobiliers en toute confiance.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="service-card text-center p-4 shadow-sm rounded-4">
                    <div class="icon-wrapper">
                        <center>
                        <h3><i class="bi bi-house-slash"></i></h3>
                        </center>
                    </div>
                    <h5 class="mt-4">Location</h5>
                    <p class="text-muted">Découvrez nos appartements et villas disponibles à la location.</p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="service-card text-center p-4 shadow-sm rounded-4">
                    <div class="icon-wrapper">
                        <h3><i class="bi bi-check2-circle"></i></h3>
                    </div>
                    <h5 class="mt-4">Conseil</h5>
                    <p class="text-muted">Bénéficiez de notre expertise pour la réussir vos projets immobilier.</p>
                </div>
            </div>

             <div class="col-md-3">
                <div class="service-card text-center p-4 shadow-sm rounded-4">
                    <div class="icon-wrapper">
                        <h3> <i class="bi bi-file-earmark-text"></i></h3>
                    </div>
                    <h5 class="mt-4">GESTION & LOCATIVE</h5>
                    <p class="text-muted">Confiez la gestion et location de vos résidences  à notre équipe professionnelle et  bénéficiez d’un suivi transparent, rigoureux.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="histoire" id="histoire">
    <div class="histoire__wrap container">
      <h3 class="histoire__title" aria-label="Notre Histoire">
        <span>Notre Histoire</span>
        <i class="histoire__underline" aria-hidden="true"></i>
      </h3>
  
      <div class="histoire__grid">
        <article class="histoire__about card reveal-left" role="article">

          <p class="paragraphe">
            <strong>SOUROU IMMOBILIER SERVICE SARL</strong> est née d’une vision claire : apporter des solutions simples, sécurisées et accessibles à tous dans le domaine de l’immobilier au Bénin.
            Depuis notre création, nous avons compris que l’acquisition ou la gestion d’un bien immobilier n’est pas seulement une transaction financière, mais un projet de vie, souvent le rêve d’une famille ou l’investissement d’une vie.
          </p>

          <p class="paragraphe mb-0">
            Avec passion et professionnalisme, notre équipe a bâti une réputation fondée sur trois valeurs essentielles : <mark style="  background-color: #cceeff;padding: 0 2px;border-radius: 3px;">confiance, transparence et satisfaction du client</mark> 
            Nous mettons un point d’honneur à offrir :
            <ul>
              <li> Des terrains sécurisés, avec tous les documents légaux nécessaires. </li>
              <li> Un service de gestion locative fiable et rigoureux, qui soulage les propriétaires tout en protégeant les intérêts des locataires. </li>
              <li> Des offres accessibles, adaptées aux jeunes investisseurs comme aux familles souhaitant bâtir leur avenir.</li>
            </ul>
          </p>
          
          <p class="paragraphe">
            Au fil des années, nous avons accompagné de nombreux clients qui ont pu réaliser leur rêve d’avoir un chez-soi ou un investissement rentable. Leur confiance renouvelée reste notre plus grande fierté et notre meilleure publicité.
            Notre slogan, <span>« Votre satisfaction, notre priorité »</span>, n’est pas qu’une phrase : c’est l’engagement quotidien de notre Directeur Général, M. Nino S. GBODOGBE, et de toute son équipe, pour offrir un service de qualité où chaque client est écouté, conseillé et accompagné jusqu’au bout de son projet.
          </p>

          <p class="paragraphe">
            Aujourd’hui, <strong style="color: #005078">SOUROU IMMOBILIER SERVICE SARL</strong> innove constamment pour se rapprocher de vous et garantir que l’immobilier au Bénin soit un secteur de confiance et de réussite pour tous.
          </p>

          <ul class="histoire__badges" aria-label="Nos points forts">
            <li>Transparence</li>
            <li>Expertise</li>
            <li>Accompagnement</li>
          </ul>
        </article>
  
        <div class="histoire__services reveal-right">
          <div class="service-card">
            <header class="service-card__head">
              <h6>Immobilier Résidentiel</h6>
              <small class="service-card__accent">Vente et location de maisons, appartements, villas avec un accompagnement complet</small>
            </header>
            <div class="atouts-container"> 
              <span class="atouts-item">Évaluation précise</span>
              <span class="atouts-item">Marketing ciblé</span>
              <span class="atouts-item">Négociation experte</span>
            </div>
          </div>
  
          <div class="service-card">
            <header class="service-card__head">
              <h6>Terrains & Parcelles</h6>
              <small class="service-card__accent">Acquisition de terrains viabilisés et non viabilisés dans les meilleures zones</small>
            </header>
            <div class="atouts-container">
              <span class="atouts-item">Vérification juridique</span>
              <span class="atouts-item">Étude de faisabilité</span>
              <span class="atouts-item">Conseil en investissement</span>
            </div>
          </div>
  
          <div class="service-card">
            <header class="service-card__head">
              <h6>Services Connexes</h6>
              <small class="service-card__accent">Véhicules et mobilier pour compléter votre projet d'installation</small>
            </header>
            <div class="atouts-container">
              <span class="atouts-item">Sélection rigoureuse</span>
              <span class="atouts-item">Garantie qualité</span>
              <span class="atouts-item">Service après vente</span>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
  

<section class="equipeDirigeante pb-5">
    <h3 class="text-center fw-bold pb-3 mb-0" style="color: #005078; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Notre équipe dirigeante</h3>
    <div class="underline mx-auto my-0"></div>
    <p class="text-center fw-semibold">Une équipe expérimentée, dévouée et passionnée, dédiée à votre succès immobilier</p>

    <div class="container">
        <div class="row align-items-center">
            <!-- DGA - Image à gauche -->
            <div class="col-md-3 text-center">
                <div class="service-card border border-1 rounded rounded-2 p-3 h-100">
                    <img src="{{ asset('assets/images/membre/IMG-20251125-WA0052.jpg') }}" class="rounded rounded-4 img-thumbnail mb-3" style="height: 270px; width: 280px" alt="Directeur Général Adjoint">
                    <div>
                        <h5 class="text-center" style="color: #005078"><strong>Mr ZOUNDJIEKPON Vincent</strong></h5>
                        <p class="text-center fw-semibold">Directeur Général Adjoint/p>
                        <p class="text-center small">Il apporte son expertise technique et managériale pour assurer l'excellence opérationnelle au quotidien et soutenir la vision stratégique de l'entreprise.</p>
                    </div>
                    <center>
                        <p class="atouts-item">Gestion Opérationnelle</p>
                        <p class="atouts-item">Coordination Équipes</p>
                        <p class="atouts-item">Optimisation Processus</p>
                    </center>
                </div>
            </div>

            <!-- PDG - Image centrale (maintenue) -->
            <div class="col-md-6">
                <div class="service-card border border-1 rounded rounded-2 p-3 h-100">
                    <center><img src="{{ asset('assets/images/membre/IMG-20251125-WA0069 (2).jpg') }}" class="rounded rounded-4 img-thumbnail mt-2 mb-3" style="height: 330px; width: 480px" alt="Président Directeur Général"></center>
                   <div>
    <center><h5 style="color: #005078"><strong>Mr GBODOGBE SOUROU NINO</strong></h5>
    <p class="fw-semibold">Président Directeur Général</p></center>
    <p class="text-start">En tant que President Directeur Général de SOUROU IMMOBILIER SERVICE SARL, Je porte une vision claire et ambitieuse :<br>
    faire de la société une référence incontournable de l'immobilier au Bénin, où chaque béninoise trouve une solution fiable, rapide et adaptée à ses besoins.

    Sa conviction est simple : 
    <br><i>Un client satisfait aujourd'hui est l'ambassadeur de demain.</i>
    Grâce à cette vision et à un leadership orienté vers la transparence, la confiance et l'innovation, SOUROU IMMOBILIER SERVICE SARL continue de grandir et de s'imposer comme un acteur majeur de l'immobilier au Bénin.</p>
</div>
                    <center>
                        <p class="atouts-item">Gestion Patrimoine</p>
                        <p class="atouts-item">Relation Client</p>
                        <p class="atouts-item">Administration</p>
                        <p class="atouts-item">Suivi Proactif</p>
                        <p class="atouts-item">Conseil Expert</p>
                    </center>
                </div>
            </div>

            <!-- Responsable Affaires Locatives - Image à droite -->
            <div class="col-md-3 text-center">
                <div class="service-card border border-1 rounded rounded-2 p-3 h-100">
                    <img src="{{ asset('assets/images/membre/IMG-20251125-WA0077(1).jpg') }}" class="rounded rounded-4 img-thumbnail mb-3" style="height: 290px; width: 280px" alt="Responsable des Affaires Locatives">
                    <div>
                        <h5 class="text-center" style="color: #005078"><strong>Mme GOUNON Bernice</strong></h5>
                        <p class="text-center fw-semibold">Responsable des Affaires Locatives</p>
                        <p class="text-center small">Le Responsable des Affaires Locatives assure la gestion optimale du parc locatif, garantissant des relations sereines entre propriétaires et locataires.</p>
                    </div>
                    <center>
                        <p class="atouts-item">Gestion Locative</p>
                        <p class="atouts-item">Relation Locataires</p>
                        <p class="atouts-item">Suivi Loyers</p>
                    </center>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="nosValeurs pt-2">
    <h3 class="text-center fw-bold pb-3 mb-0" style="color: #005078; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Nos valeurs</h3>
    <div class="underline mx-auto my-0"></div>
    <p class="text-center fw-semibold">Les principes qui guident chacune de nos actions et décisions</p>

    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
              <div class="service-card text-center p-4 shadow-sm h-100">
                <div class="icon iconAllService mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" style="color: #005078" height="32" fill="currentColor" class="bi bi-gem" viewBox="0 0 16 16">
                        <path d="M3.1.7a.5.5 0 0 1 .4-.2h9a.5.5 0 0 1 .4.2l2.976 3.974c.149.185.156.45.01.644L8.4 15.3a.5.5 0 0 1-.8 0L.1 5.3a.5.5 0 0 1 0-.6zm11.386 3.785-1.806-2.41-.776 2.413zm-3.633.004.961-2.989H4.186l.963 2.995zM5.47 5.495 8 13.366l2.532-7.876zm-1.371-.999-.78-2.422-1.818 2.425zM1.499 5.5l5.113 6.817-2.192-6.82zm7.889 6.817 5.123-6.83-2.928.002z"/>
                    </svg>
                </div>
                <h5 class="fw-bold">Confiance</h5>
                <p class="text-dark">
                  Instaurer une relation durable avec nos clients.
                </p>
              </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos-delay="100">
              <div class="service-card text-center p-4 shadow-sm h-100">
                <div class="icon iconAllService mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" style="color: #005078" height="32" fill="currentColor" class="bi bi-award-fill" viewBox="0 0 16 16">
                        <path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864z"/>
                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z"/>
                    </svg>
                </div>
                <h5 class="fw-bold">Transparence</h5>
                <p class="text-dark">
                    Agir avec honnêteté et clarté à chaque étape.
                </p>
              </div>
            </div>
      
            <div class="col-md-6 col-lg-4" data-aos-delay="100">
              <div class="service-card text-center p-4 shadow-sm h-100">
                <div class="icon iconAllService mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" style="color: #005078" height="32" fill="currentColor" class="bi bi-award-fill" viewBox="0 0 16 16">
                        <path d="m8 0 1.669.864 1.858.282.842 1.68 1.337 1.32L13.4 6l.306 1.854-1.337 1.32-.842 1.68-1.858.282L8 12l-1.669-.864-1.858-.282-.842-1.68-1.337-1.32L2.6 6l-.306-1.854 1.337-1.32.842-1.68L6.331.864z"/>
                        <path d="M4 11.794V16l4-1 4 1v-4.206l-2.018.306L8 13.126 6.018 12.1z"/>
                    </svg>
                </div>
                <h5 class="fw-bold">Excellence</h5>
                <p class="text-dark">
                  Offrir un service professionnel et de qualité.
                </p>
              </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos-delay="200">
              <div class="service-card text-center p-4 shadow-sm h-100">
                <div class="icon iconAllService mb-3">
                    <h2><i class="bi bi-people-fill"  style="color: #005078"></i></h2>
                </div>
                <h5 class="fw-bold">Proximité</h5>
                <p class="text-dark">
                  Ecouter et comprendre les besoins de nos clients pour mieux les accompagner.
                </p>
              </div>
            </div>

            <div class="col-md-6 col-lg-4" data-aos-delay="200">
              <div class="service-card text-center p-4 shadow-sm h-100">
                <div class="icon iconAllService mb-3">
                    <h2><i class="bi bi-people-fill"  style="color: #005078"></i></h2>
                </div>
                <h5 class="fw-bold">Innovation</h5>
                <p class="text-dark">
                  Proposer des solutions modernes et adaptées aux défis du marché immobilier.
                </p>
              </div>
            </div>
        </div>
    </div>
</section>
    
<section class="infosLegales py-5">
    <div class="container">
      <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #005078; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">Informations Légales</h2>
        <div class="underline mx-auto"></div>
      </div> 
      
      <div class="row g-4">
        <div class="col-md-6">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="fw-bold mb-3" style="color: #005078; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                <i class="bi bi-building me-2"></i> Identification Légale
              </h5>
              <hr class="divider">
              <p><strong>RCC:</strong> RB/PNO/22B4118</p>
              <hr class="divider">
              <p><strong>IFU:</strong> 32022508482554</p>
              <hr class="divider">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="card shadow-sm h-100">
            <div class="card-body">
              <h5 class="fw-bold mb-3" style="color: #005078; font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif">
                <i class="bi bi-telephone me-2"></i> Coordonnées de Contact
              </h5>
              <hr class="divider">
              <p><i class="bi bi-telephone me-2"></i> 0229 0196233121</p>
              <hr class="divider">
              <p><i class="bi bi-telephone me-2"></i> 0156001930</p>
              <hr class="divider">
              <p><i class="bi bi-envelope me-2"></i> contact@sourouimmobilier.com</p>
              <hr class="divider">
              <p><i class="bi bi-geo-alt me-2"></i> Porto-Novo, Gbodjè(Bénin) à 200 mettre de le l'église catholique Saint Antoine de padoue</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <script>
    (function(){
      const io=new IntersectionObserver((entries)=>{
        entries.forEach(e=>{if(e.isIntersecting)e.target.classList.add('in-view');});
      },{threshold:.2});
      document.querySelectorAll('.reveal-left,.reveal-right').forEach(el=>io.observe(el));
    
      const counters=document.querySelectorAll('.count');
      const animateCount=(el)=>{
        const target=+el.dataset.to,duration=1000,start=performance.now();
        const step=(now)=>{
          const p=Math.min(1,(now-start)/duration);
          el.textContent=Math.floor(target*p);
          if(p<1)requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
      };
      const ioCount=new IntersectionObserver((entries)=>{
        entries.forEach(e=>{if(e.isIntersecting){animateCount(e.target);ioCount.unobserve(e.target)}})
      },{threshold:.6});
      counters.forEach(c=>ioCount.observe(c));
    })();
    </script>
  
  

@endsection
