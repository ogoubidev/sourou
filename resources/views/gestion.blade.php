@extends('layouts.app')

@section('title', 'Gestion Locative')


<style>
    .gestion-locative {
    background-color: #f8f9fa;
    }

    .gestion-locative h2, .gestion-locative h4 {
    font-family: 'Poppins', sans-serif;
    }

    .hover-card {
    transition: all 0.3s ease;
    cursor: pointer;
    }
    .hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 20px rgba(0, 80, 120, 0.15);
    background-color: #e9f4fa;
    }

    .num-circle {
        width: 45px;
        height: 45px;
        background-color: #005078;
        color: white;
        font-weight: bold;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .gestion-card:hover .num-circle {
        background-color: #00aaff;
        transform: scale(1.1);
        }

        .gestion-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .gestion-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 80, 120, 0.2);
        }

        ul li {
        margin-bottom: 6px;
        }

    .titre-avec-num {
    display: flex;
    align-items: center;
    flex-wrap: nowrap;
    gap: 10px;
    white-space: nowrap; /* Empêche le retour à la ligne */
    }

    .titre-avec-num h4 {
    margin: 0;
    }



    /* Animation fade-in */
    .fade-in {
    opacity: 0;
    transform: translateY(40px);
    animation: fadeSlideIn 1s forwards;
    }

    @keyframes fadeSlideIn {
    from {
        opacity: 0;
        transform: translateY(40px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
    }

</style>
@section('content')
<section class="gestion-locative py-5">
    <div class="container">
  
      
      <div class="text-center mb-5">
        <h2 class="fw-bold" style="color: #005078;"> Gestion Locative Professionnelle</h2>
        <p class="text-muted fs-5">Simplifiez, sécurisez et valorisez la gestion de vos biens immobiliers avec notre expertise digitale.</p>
      </div>
  
      <!-- SECTION 1 : Système de gestion -->
      <div class="row align-items-center mb-5 fade-in">
        <div class="col-md-6 mb-4 mb-md-0">
          <img src="{{ asset('assets/images/IMG-20240821-WA0098.jpg') }}" alt="Système de gestion" class="img-fluid rounded-4 shadow">
        </div>
        <div class="col-md-6">
        <div class="titre-avec-num mb-3">
            <div class="num-circle">1</div>
            <h4 class="fw-bold mb-0" style="color: #005078;">Système de gestion moderne</h4>
          </div>
          <p>Chez <strong>SOUROU IMMOBILIER SERVICE SARL</strong>, nous mettons à votre disposition un logiciel de gestion locative moderne et attractif, conçu pour :</p>
          <ul class="list-unstyled ps-3">
            <li> Suivre les loyers et charges facilement.</li>
            <li> Visualiser l’état de vos biens à tout moment.</li>
            <li> Accéder à un tableau de bord clair et intuitif.</li>
            <li> Recevoir des alertes et notifications en temps réel.</li>
          </ul>
          <p>Notre interface digitale est simple, sécurisée et transparente, offrant une vision complète de vos biens en temps réel.</p>
        </div>
      </div>
  
      <!-- SECTION 2 : Rôles -->
      <div class="row align-items-center flex-md-row-reverse mb-5 fade-in">
        <div class="col-md-6 mb-4 mb-md-0">
          <img src="{{ asset('assets/images/IMG-20250904-WA0030(1).jpg') }}" style="" alt="Rôle de la société" class="img-fluid rounded-4 shadow">
        </div>
        <div class="col-md-6">
            <div class="titre-avec-num mb-3">
                <div class="num-circle">2</div>
                <h4 class="fw-bold mb-0" style="color: #005078;">Rôle de la société et des propriétaires</h4>
            </div>
          <div class="mb-3">
            <h6 class="fw-bold text-secondary mb-1">La société :</h6>
            <ul class="list-unstyled ps-3">
              <li> Gère les aspects administratifs et financiers.</li>
              <li> Collecte les loyers et effectue les reversements mensuels.</li>
              <li> Gère l’entretien, les réparations et la communication avec les locataires.</li>
            </ul>
          </div>
          <div>
            <h6 class="fw-bold text-secondary mb-1">Le propriétaire :</h6>
            <p>Dispose d’un accès permanent à ses données, ses revenus, et peut suivre la gestion en toute transparence.</p>
          </div>
        </div>
      </div>
  
      <!-- SECTION 3 : Suivi -->
      <div class="row align-items-center mb-5 fade-in">
        <div class="col-md-6 mb-4 mb-md-0">
          <img src="{{ asset('assets/images/FB_IMG_1751631901423.jpg ') }}" alt="Suivi des biens" class="img-fluid rounded-4 shadow">
        </div>
        <div class="col-md-6">
            <div class="titre-avec-num mb-3">
                <div class="num-circle">3</div>
                <h4 class="fw-bold mb-0" style="color: #005078;">Suivi et transparence totale</h4>
            </div>
          <ul class="list-unstyled ps-3">
            <li> <strong>Tableau de bord personnalisé :</strong> loyers encaissés, impayés, taux d’occupation.</li>
            <li> <strong>Historique complet :</strong> transactions et interventions enregistrées.</li>
            <li> <strong>Rapports mensuels :</strong> synthèse claire des revenus et dépenses.</li>
            <li> <strong>Alertes intelligentes :</strong> rappels pour loyers, contrats et entretiens.</li>
          </ul>
        </div>
      </div>
  
      <!-- SECTION 4 : Avantages -->
      <div class="card shadow-lg border-0 p-4 fade-in" style="border-radius: 15px;">
        <div class="card-body">
            <div class="titre-avec-num text-center mb-4 justify-content-center">
                <div class="num-circle">4</div>
                <h4 class="fw-bold mb-0" style="color: #005078;">Pourquoi confier sa maison à SOUROU IMMOBILIER ?</h4>
            </div>
          <div class="row row-cols-1 row-cols-md-3 g-4">
            <div class="col">
              <div class="p-4 bg-light rounded-4 h-100 text-center hover-card">
                <i class="bi bi-cash-coin fs-1 mb-3" style="color: #005078;"></i>
                <h6 class="fw-bold">Rentabilité optimisée</h6>
                <p>Loyers évalués et encaissés efficacement pour une rentabilité maximale.</p>
              </div>
            </div>
            <div class="col">
              <div class="p-4 bg-light rounded-4 h-100 text-center hover-card">
                <i class="bi bi-shield-check fs-1 mb-3" style="color: #005078;"></i>
                <h6 class="fw-bold">Sécurité & sérénité</h6>
                <p>Protection juridique et administrative de vos biens, zéro stress pour vous.</p>
              </div>
            </div>
            <div class="col">
              <div class="p-4 bg-light rounded-4 h-100 text-center hover-card">
                <i class="bi bi-graph-up-arrow fs-1 mb-3" style="color: #005078;"></i>
                <h6 class="fw-bold">Valorisation du bien</h6>
                <p>Présentation professionnelle et entretien régulier pour maximiser les revenus.</p>
              </div>
            </div>
          </div>
  
          <div class="text-center mt-5">
            <a href="/contact" class="rounded-pill px-4 py-2 shadow-sm" style="text-decoration:none; background-color: #005078; color:white;">Confier mon bien</a>
          </div>
        </div>
      </div>
  
    </div>
  </section>
  
@endsection