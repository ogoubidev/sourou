@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">

@section('content')

<section class="hero">
    <h1 class="pt-5 mb-0" >Contactez nos Experts</h1>
    <p class="mb-0">Notre équipe d'experts immobiliers est à votre écoute pour vous accompagner dans tous vos projets</p>
</section>

<section class="contact-section container">
    <div class="row g-4">
        <div class="col-12">
          <div class="map-container rounded mb-4 shadow-sm">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.0617275351315!2d2.672963674359357!3d6.51387152327648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x103b5beace390c49%3A0x97cbd92bf62e82d0!2sSOUROU%20IMMOBILIER%20SERVICE!5e0!3m2!1sfr!2sfr!4v1756228854455!5m2!1sfr!2sfr"
               width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
             </iframe>
          </div>
        </div>
        <div class="col-md-5 animate__animated animate__fadeInLeft">
            <div class="contact-card legal-info">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-telephone me-2 text-primary"></i>
                    <h6 class="mb-0 text-primary">Téléphone</h6>
                </div>
                <p>0229 0196233121<br>0156 001 930</p>
            </div>

            <div class="contact-card legal-info">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-envelope me-2 text-primary"></i>
                    <h6 class="mb-0 text-primary">Email</h6>
                </div>
                <p>contact@sourouimmobilier.com</p>
            </div>

            <div class="contact-card legal-info">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-geo-alt me-2 text-primary"></i>
                    <h6 class="mb-0 text-primary">Adresse</h6>
                </div>
                <p>PORTO NOVO, BÉNIN</p>
            </div>

            <div class="contact-card legal-info">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-clock me-2 text-primary"></i>
                    <h6 class="mb-0 text-primary">Horaires</h6>
                </div>
                <p>Lundi - Vendredi : 8h30 - 14h & 15h - 17h30<br>Samedi : 10h - 14h</p>
            </div>

            <div class="contact-card legal-info">
                <div class="d-flex align-items-center mb-2">
                    <i class="bi bi-file-earmark-text me-2 text-primary"></i>
                    <h6 class="mb-0 text-primary">Informations légales</h6>
                </div>
                <p>RCC : RB/PNO/22B4118<br>IFU : 32022508482554</p>
            </div>
        </div>

        <!-- Carte et formulaire -->
        <div class="col-md-7 animate__animated animate__fadeInRight">
            <div class="contact-card legal-info">
                <h5><i class="bi bi-chat-dots me-2"></i> Envoyez-nous un message</h5>
                <p>Décrivez votre projet en détail. Réponse sous 24h ouvrées.</p>
                <form id="contactForm" action="{{ route('contact.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nom">Nom *</label>
                            <input type="text" class="form-control" name="nom" required>
                        </div>
                        <div class="col">
                            <label for="prenom">Prénom *</label>
                            <input type="text" class="form-control" name="prenom" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="col">
                            <label for="tel">Téléphone</label>
                            <input type="text" class="form-control" name="tel">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="prestation">Type de prestation</label>
                        <select class="form-control" name="prestation">
                            <option selected disabled>Sélectionnez le type de votre projet</option>
                            <option>Achat de bien immobilier</option>
                            <option>Location de propriété</option>
                            <option>Vente de bien immobilier</option>
                            <option>Évaluation immobilière</option>
                            <option>Conseil et expertise</option>
                            <option>Autre demande</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="message">Votre message *</label>
                        <textarea name="message" class="form-control" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="bi bi-send me-2"></i> Envoyer le message
                    </button>
                </form>
                
            </div>
        </div>
    </div>
</section>

@endsection
