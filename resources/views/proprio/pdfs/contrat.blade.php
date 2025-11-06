<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Contrat de bail - SOUROU IMMOBILIER SERVICE SARL</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f9fb;
            color: #333;
        }

        /* --- EN-TÊTE --- */
        header {
            background-color: #f7f9fb;
            color: #005078;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            flex-wrap: nowrap;
        }

        header img {
            height: 65px;
            width: auto;
            flex-shrink: 0; /* empêche le logo de se réduire */
        }

        .company-info {
            margin-left: 20px;
            text-align: right;
            font-size: 13px;
            line-height: 1.5;
            white-space: nowrap; /* empêche le retour à la ligne */
        }

        /* --- CONTENU PRINCIPAL --- */
        main {
            background: #fff;
            margin: 40px auto;
            padding: 40px 50px;
            max-width: 800px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #005078;
            margin-bottom: 20px;
            border-bottom: 3px solid #005078;
            display: inline-block;
            padding-bottom: 5px;
        }

        .intro {
            text-align: justify;
            font-size: 11px;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .info-section {
            margin-bottom: 12px;
        }

        .info-section p {
            font-size: 12px;
            margin: 6px 0;
        }

        .info-section strong {
            color: #005078;
        }

        /* --- SIGNATURES --- */
        .signatures {
            margin-top: 40px;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
        }

        .signature-box {
            width: 45%;
            text-align: center;
            border-top: 1px solid #005078;
            padding-top: 10px;
            font-size: 13px;
        }

        /* --- PIED DE PAGE --- */
        footer {
            background-color: #005078;
            color: #fff;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <!-- EN-TÊTE -->
    <header style="display: flex">
        <img src="{{ public_path('assets/images/logotype sourou bleu_Plan de travail 1.png') }}" alt="Logo SOUROU">
        <div class="company-info">
            <strong>SOUROU IMMOBILIER SERVICE SARL</strong><br>
            Gestion locative & Vente de biens immobiliers — Porto-Novo, Gbodjè (Bénin)<br>
            Tél : +229 01 96 23 31 21 — Email : contact@sourouimmobilier.com<br>
            Web : sourouimmobilier.com
        </div>
    </header>

    <!-- CONTENU PRINCIPAL -->
    <main>
        <h2>Contrat de Bail</h2>

        <p class="intro">
            Ce contrat de bail est établi entre <strong>SOUROU IMMOBILIER SERVICE SARL</strong>, 
            société spécialisée dans la gestion et la mise en location de biens immobiliers, 
            et le locataire dont les informations figurent ci-dessous. 
            Il définit les droits et obligations des deux parties dans le cadre de la location du bien indiqué.
        </p>

        <div class="info-section">
            <p><strong>Nom du locataire :</strong> {{ $attribution->client->name }} {{ $attribution->client->surname }}</p>
            <p><strong>Téléphone :</strong> {{ $attribution->client->telephone ?? '—' }}</p>
            <p><strong>Bien loué :</strong> {{ $attribution->bien->titre }}</p>
            <p><strong>Période :</strong> {{ $attribution->date_debut->format('d/m/Y') }} au {{ $attribution->date_fin->format('d/m/Y') }}</p>
            <p><strong>Loyer mensuel :</strong> {{ number_format($attribution->loyer_mensuel, 0, ',', ' ') }} FCFA</p>
            <p><strong>Statut :</strong> {{ ucfirst($attribution->status) }}</p>
        </div>

        <div class="intro">
            Le locataire s’engage à respecter les termes de ce contrat, notamment à entretenir le bien loué, 
            à payer régulièrement le loyer convenu et à signaler tout dommage ou incident survenu dans le logement.  
            <br><br>
            Le présent contrat prend effet à la date de début indiquée ci-dessus et reste valable jusqu’à la fin de la période convenue, sauf résiliation anticipée conformément aux clauses internes.
        </div>

        <div class="signatures">
            <div class="signature-box">
                <strong>Le Bailleur</strong><br>
                (SOUROU IMMOBILIER SERVICE SARL)
            </div>

            <div class="signature-box">
                <strong>Le Locataire</strong><br>
                {{ $attribution->client->name }} {{ $attribution->client->surname }}
            </div>
        </div>
    </main>

    <!-- PIED DE PAGE -->
    <footer>
        © {{ date('Y') }} SOUROU IMMOBILIER SERVICE SARL — Tous droits réservés
    </footer>

</body>
</html>

