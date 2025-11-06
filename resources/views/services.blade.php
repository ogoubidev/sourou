@extends('layouts.app')

@section('title', 'Gestion Locative')


<style>
    .service-card {
        transition: all 0.3s ease;
        border-radius: 15px;
        }

        .service-item {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 15px;
        overflow: hidden;
        }

        .service-item:hover {
        transform: translateY(-8px);
        box-shadow: 0 8px 20px rgba(0, 80, 120, 0.25);
        }

        .service-item img {
        height: 180px;
        object-fit: cover;
        transition: transform 0.4s ease;
        }

        .service-item:hover img {
        transform: scale(1.08);
        }

        .btn-outline-primary {
        border-color: #005078;
        color: #005078;
        transition: 0.3s;
        }

        .btn-outline-primary:hover {
        background-color: #005078;
        color: #fff;
        }

</style>
@section('content')
<section class="services-principaux py-5 bg-light">
    <div class="container">
      <h4 class="text-center fw-bold mb-2" style="color: #005078;">
        Aperçu de nos services principaux
      </h4>
      <p class="text-center mb-5">Découvrez l’ensemble des services que nous proposons pour répondre à tous vos besoins avec professionnalisme et fiabilité.</p>
  
      <!-- ====== IMMOBILIER ====== -->
      <div class="card mb-5 shadow-lg border-0 service-card">
        <div class="card-body">
          <h4 class="fw-bold text-center mb-4" style="color:#005078;">IMMOBILIER</h4>
          <div class="row row-cols-1 row-cols-md-3 g-4">
            
            <div class="col">
              <div class="card h-100 shadow-sm service-item">
                <img src="{{ asset('assets/images/Gestion locative .jpeg') }}" alt="Gestion locative">
                <div class="card-body">
                  <h5 class="card-title fw-bold" style="color:#005078;">Gestion locative transparente</h5>
                  <p class="card-text">Nous prenons en charge la gestion complète de vos biens : suivi des loyers, entretien, communication avec les locataires. Cela vous garantit tranquillité et rentabilité, tout en protégeant vos intérêts</p>
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="card h-100 shadow-sm service-item">
                <img src="{{ asset('assets/images/Location d’appartements.jpeg') }}" alt="Location appartements meublés">
                <div class="card-body">
                  <h5 class="card-title fw-bold" style="color:#005078;">Location d’appartements et résidences meublée(luxe ou simple)
                </h5>
                  <p class="card-text">Pour un séjour court ou long, nous proposons des logements adaptés à votre budget et à vos besoins, offrant confort et sécurité.</p>
                </div>
              </div>
            </div>
            
            <div class="col">
              <div class="card h-100 shadow-sm service-item">
                <img src="{{ asset('assets/images/Vente et achat de terrains.jpeg') }}" alt="Vente terrains">
                <div class="card-body">
                  <h5 class="card-title fw-bold" style="color:#005078;">Vente et achat de terrains sécurisés</h5>
                  <p class="card-text">Nous sélectionnons uniquement des terrains avec documents fiables, pour un investissement sûr et durable.
                </p>
                </div>
              </div>
            </div>
  
            <div class="col">
              <div class="card h-100 shadow-sm service-item">
                <img src="{{ asset('assets/images/MisENvaleurBien.jpeg') }}" alt="Mise en valeur">
                <div class="card-body">
                  <h5 class="card-title fw-bold" style="color:#005078;">Mise en valeur des biens</h5>
                  <p class="card-text">Valorisation de vos terrains, maisons et appartements grâce à une présentation professionnelle et communication efficace, afin de trouver rapidement des acheteurs ou locataires.
                </p>
                </div>
              </div>
            </div>
  
            <div class="col">
              <div class="card h-100 shadow-sm service-item">
                <img src="{{ asset('assets/images/Estimation loyers.jpeg') }}" alt="Estimation loyers">
                <div class="card-body">
                  <h5 class="card-title fw-bold" style="color:#005078;">Estimation loyers et terrains</h5>
                  <p class="card-text">Évaluation juste et professionnelle de la valeur locative ou marchande de vos biens, pour vous aider à prendre des décisions éclairées.
                    </p>
                </div>
              </div>
            </div>
          </div>
  
          <div class="text-center mt-4">
            <a href="/contact" class="btn btn-outline-primary rounded-pill px-4">En savoir plus</a>
          </div>
        </div>
      </div>
  
      <!-- ====== BTP & CONSTRUCTION ====== -->
      <div class="card mb-5 shadow-lg border-0 service-card">
        <div class="card-body">
          <h4 class="fw-bold text-center mb-4" style="color:#005078;"> BTP & CONSTRUCTION</h4>
          <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
              <div class="card h-100 shadow-sm service-item">
                <img src="{{ asset('assets/images/suiviChantier.jpeg') }}" alt="Suivi de chantier">
                <div class="card-body">
                  <h5 class="card-title fw-bold" style="color:#005078;">Suivi de chantier</h5>
                  <p class="card-text">Contrôle rigoureux de l’évolution des travaux, respect des délais et qualité des matériaux.
                </p>
                </div>
              </div>
            </div>
  
            <div class="col">
              <div class="card h-100 shadow-sm service-item">
                <img src="{{ asset('assets/images/réalisation de projet.jpeg') }}" alt="Réalisation de projets">
                <div class="card-body">
                  <h5 class="card-title fw-bold" style="color:#005078;">Réalisation de projets (résidences, immeubles, villas)</h5>
                  <p class="card-text">De la conception aux finitions, nous construisons vos logements ou bâtiments d’affaires avec professionnalisme et respect des normes.
                </p>
                </div>
              </div>
            </div>
  
            <div class="col">
              <div class="card h-100 shadow-sm service-item">
                <img src="{{ asset('assets/images/fourniture de matériaux moderne.jpeg') }}" alt="Fourniture de matériaux">
                <div class="card-body">
                  <h5 class="card-title fw-bold" style="color:#005078;">Fourniture de matériaux modernes</h5>
                  <p class="card-text">Accès à des matériaux fiables et adaptés, pour des constructions solides et durables.
                </p>
                </div>
              </div>
            </div>
          </div>
  
          <div class="text-center mt-4">
            <a href="/contact" class="btn btn-outline-primary rounded-pill px-4">En savoir plus</a>
          </div>
        </div>
      </div>
  
      <!-- ====== AUTRES SERVICES D’ACCOMPAGNEMENT ====== -->
      <div class="card mb-5 shadow-lg border-0 service-card">
        <div class="card-body">
          <h4 class="fw-bold text-center mb-4" style="color:#005078;">AUTRES SERVICES D’ACCOMPAGNEMENT</h4>
          <div class="row row-cols-1 row-cols-md-3 g-4">
            
            <div class="col">
              <div class="card h-100 shadow-sm service-item">
                <img src="{{ asset('assets/images/voyage et billet d\'avion.jpeg') }}" alt="Voyage">
                <div class="card-body">
                  <h5 class="card-title fw-bold" style="color:#005078;">Voyage et achat de billets d’avion</h5>
                  <p class="card-text">Assistance pour l’organisation de vos voyages avec réservation de billets au meilleur prix.
                </p>
                </div>
              </div>
            </div>
  
            <div class="col">
              <div class="card h-100 shadow-sm service-item">
                <img src="{{ asset('assets/images/entretien et nettoyage.jpeg') }}" alt="Nettoyage">
                <div class="card-body">
                  <h5 class="card-title fw-bold" style="color:#005078;">Entretien & nettoyage</h5>
                  <p class="card-text">Services professionnels pour maintenir vos résidences, bureaux ou chantiers propres et accueillants, garantissant confort et sécurité.
                </p>
                </div>
              </div>
            </div>
          </div>
  
          <div class="text-center mt-4">
            <a href="/contact" class="btn btn-outline-primary rounded-pill px-4">En savoir plus</a>
          </div>
        </div>
      </div>
    </div>
  </section>
  
@endsection