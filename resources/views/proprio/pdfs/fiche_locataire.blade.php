<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Fiche locataire - SOUROU IMMOBILIER SERVICE SARL</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f9fb;
            color: #333;
            line-height: 1.6;
        }

        /* --- EN-TÊTE --- */
        header {
            background-color: #005078;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px 30px;
            flex-wrap: nowrap;
        }

        header img {
            height: 65px;
            width: auto;
            flex-shrink: 0;
        }

        .company-info {
            text-align: right;
            font-size: 13px;
            line-height: 1.5;
            white-space: nowrap;
        }

        /* --- CONTENU PRINCIPAL --- */
        main {
            background: #fff;
            margin: 40px auto;
            padding: 40px 50px;
            max-width: 750px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            color: #005078;
            border-bottom: 3px solid #005078;
            display: inline-block;
            margin-bottom: 25px;
            padding-bottom: 5px;
        }

        .info-section {
            font-size: 13px;
            margin-bottom: 15px;
        }

        .info-section p {
            margin: 6px 0;
        }

        .info-section strong {
            color: #005078;
        }

        /* --- ZONE DE SIGNATURE --- */
        .signature {
            margin-top: 40px;
            text-align: right;
            font-size: 13px;
        }

        /* --- PIED DE PAGE --- */
        footer {
            background-color: #005078;
            color: #fff;
            text-align: center;
            padding: 12px;
            font-size: 12px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <!-- EN-TÊTE -->
    <header>
        <img src="{{ public_path('assets/images/Logo SIS SARL Groupe transparent_Plan de travail 1.png') }}" alt="Logo SOUROU">
        <div class="company-info">
            <strong>SOUROU IMMOBILIER SERVICE SARL</strong><br>
            Gestion locative & Vente de biens immobiliers — Porto-Novo, Gbodjè (Bénin)<br>
            Tél : +229 01 96 23 31 21 — Email : contact@sourouimmobilier.com<br>
            Web : sourouimmobilier.com
        </div>
    </header>

    <!-- CONTENU PRINCIPAL -->
    <main>
        <h2>Fiche Locataire</h2>

        <div class="info-section">
            <p><strong>Propriétaire :</strong> {{ auth()->user()->name }}</p>
            <p><strong>Locataire :</strong> {{ $attribution->client->name }} {{ $attribution->client->surname }}</p>
            <p><strong>Téléphone :</strong> {{ $attribution->client->telephone ?? '—' }}</p>
            <p><strong>Bien loué :</strong> {{ $attribution->bien->titre }}</p>
            <p><strong>Adresse du bien :</strong> {{ $attribution->bien->adresse }}</p>
            <p><strong>Période de location :</strong> {{ $attribution->date_debut->format('d/m/Y') }} au {{ $attribution->date_fin->format('d/m/Y') }}</p>
            <p><strong>Loyer mensuel :</strong> {{ number_format($attribution->loyer_mensuel, 0, ',', ' ') }} FCFA</p>
            <p><strong>Statut :</strong> {{ ucfirst($attribution->status) }}</p>
        </div>

        <p style="text-align: justify; font-size: 12px; margin-top: 20px;">
            La présente fiche locataire récapitule les informations essentielles relatives au bien loué et à son occupant.
            Le locataire s’engage à respecter les termes du contrat de location, à entretenir le logement 
            et à régler le loyer dans les délais convenus avec <strong>SOUROU IMMOBILIER SERVICE SARL</strong>.
        </p>

        <div class="signature">
            <p>Fait à Porto Novo, le {{ now()->format('d/m/Y') }}</p>
            <p><strong>Signature du propriétaire</strong></p>
        </div>
    </main>

    <!-- PIED DE PAGE -->
    <footer>
        © {{ date('Y') }} SOUROU IMMOBILIER SERVICE SARL — Tous droits réservés
    </footer>

</body>
</html>
