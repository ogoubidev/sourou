@extends('layouts.app')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

@section('title', 'FAQ')

<style>
    .faq-section {
      background: #f9fcff;
    }
    
    .faq-container {
      max-width: 900px;
      margin: 0 auto;
      animation: fadeInUp 0.8s ease both;
    }
    
    .faq-item {
      background: white;
      border-radius: 20px;
      box-shadow: 0 5px 15px rgba(0,80,120,0.12);
      margin-bottom: 15px;
      overflow: hidden;
      transition: all 0.3s ease;
    }
    
    .faq-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 18px 25px;
      cursor: pointer;
      transition: background 0.3s ease;
    }
    
    .faq-header:hover {
      background: #e7f5ff;
    }
    
    .faq-header h5 {
      flex: 1;
      margin-left: 12px;
      color: #005078;
      font-weight: 600;
    }
    
    .faq-header .circle {
      width: 45px;
      height: 45px;
      background: #005078;
      color: white;
      border-radius: 50%;
      text-align: center;
      line-height: 45px;
      font-size: 18px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.2);
    }

    .faq-header .circle i {
      margin: 15px 0 5px 0;
    }
    
    .toggle-icon {
      font-size: 26px;
      color: #005078;
      font-weight: bold;
      transition: transform 0.3s ease;
    }
    
    .faq-item.active .toggle-icon {
      transform: rotate(180deg);
      content: "-";
    }
    
    .faq-body {
      max-height: 0;
      overflow: hidden;
      padding: 0 25px;
      background: #fcfdff;
      border-top: 1px solid #e1ecf3;
      transition: all 0.4s ease;
    }
    
    .faq-body p, .faq-body li {
      color: #333;
      font-size: 15px;
      margin-bottom: 6px;
    }
    
    .faq-body ul {
      padding-left: 20px;
    }
    
    .faq-item.active .faq-body {
      max-height: 700px;
      padding: 20px 25px 25px;
    }
    
    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
</style>

@section('content')
    <section class="faq-section py-5">
        <div class="container">
          <h2 class="text-center fw-bold mb-5" style="color:#005078;">Conditions d’accès à nos services</h2>
      
          <div class="faq-container">

            <div class="faq-item">
              <div class="faq-header">
                <div class="circle"><i class="fas fa-user-check"></i></div>
                <h5>Modalités générales pour devenir client</h5>
                <div class="toggle-icon">+</div>
              </div>
              <div class="faq-body">
                <ul>
                  <li>Remplir un formulaire de demande spécifique au service choisi.</li>
                  <li>Fournir les documents requis selon le type de service.</li>
                  <li>Accepter et signer un contrat clair et conforme à la loi.</li>
                  <li>Respecter les conditions de paiement et garanties propres à chaque service.</li>
                </ul>
              </div>
            </div>
      
            <div class="faq-item">
              <div class="faq-header">
                <div class="circle"><i class="fas fa-folder-open"></i></div>
                <h5>Documents à fournir selon le type de service</h5>
                <div class="toggle-icon">+</div>
              </div>
              <div class="faq-body">
                <p><strong>Service de Gestion Locative :</strong></p>
                <ul>
                  <li>Pièce d’identité valide.</li>
                  <li>Preuve de titre de propriété du bien à gérer.</li>
                  <li>Relevé bancaire ou preuve de domicile.</li>
                  <li>Photos récentes du bien à gérer.</li>
                </ul>
                <p><strong>Service de Location (Simple ou Meublé) :</strong></p>
                <ul>
                  <li>Pièce d’identité valide.</li>
                  <li>Deux photos d’identité récentes.</li>
                  <li>Preuve de profession ou justificatif de revenus.</li>
                  <li>Inventaire signé pour location meublée.</li>
                </ul>
              </div>
            </div>
      
            <div class="faq-item">
              <div class="faq-header">
                <div class="circle"><i class="fas fa-coins"></i></div>
                <h5>Conditions de paiement et garanties</h5>
                <div class="toggle-icon">+</div>
              </div>
              <div class="faq-body">
                <p><strong>Service de Gestion Locative :</strong> 10.000 F CFA par résidence.</p>
                <p><strong>Service de Location Simple :</strong></p>
                <ul>
                  <li>Caution : 3 mois de loyer (remboursable).</li>
                  <li>Commission société : 1 mois de loyer (non remboursable).</li>
                  <li>Frais administratifs : 2.000 F CFA.</li>
                </ul>
                <p><strong>Service de Location Meublée :</strong></p>
                <ul>
                  <li>Caution sur loyer (remboursable à la fin du séjour).</li>
                  <li>Paiement total avant l’occupation.</li>
                  <li>Frais administratifs : 2.000 F CFA.</li>
                </ul>
              </div>
            </div>
      
            <div class="faq-item">
              <div class="faq-header">
                <div class="circle"><i class="fas fa-money-bill-wave"></i></div>
                <h5>Modes de paiement acceptés</h5>
                <div class="toggle-icon">+</div>
              </div>
              <div class="faq-body">
                <ul>
                  <li>Espèces directement au bureau.</li>
                  <li>Mobile Money (MTN).</li>
                  <li>Virement ou dépôt bancaire.</li>
                </ul>
              </div>
            </div>
      
            <div class="faq-item">
              <div class="faq-header">
                <div class="circle"><i class="fas fa-file-signature"></i></div>
                <h5>Documents à signer</h5>
                <div class="toggle-icon">+</div>
              </div>
              <div class="faq-body">
                <ul>
                  <li>Contrat clair et conforme à la législation béninoise.</li>
                  <li>Conditions de paiement et garanties détaillées.</li>
                  <li>Modalités de résiliation et d’annulation.</li>
                </ul>
              </div>
            </div>
      
            <div class="faq-item">
              <div class="faq-header">
                <div class="circle"><i class="fas fa-shield-alt"></i></div>
                <h5>Politique de transparence et sécurité foncière</h5>
                <div class="toggle-icon">+</div>
              </div>
              <div class="faq-body">
                <ul>
                  <li>Chaque transaction est documentée et traçable.</li>
                  <li>Les biens proposés sont sécurisés et conformes à la législation.</li>
                  <li>Tous les contrats sont signés dans le respect de la transparence.</li>
                  <li>Nous protégeons vos droits et vos investissements.</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </section>
      
      <!-- Font Awesome -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
      
    <script>
      document.querySelectorAll('.faq-header').forEach(header => {
        header.addEventListener('click', () => {
          const item = header.parentElement;
          const icon = header.querySelector('.toggle-icon');
          item.classList.toggle('active');
          icon.textContent = item.classList.contains('active') ? '−' : '+';
        });
      });
    </script>
      
  
@endsection