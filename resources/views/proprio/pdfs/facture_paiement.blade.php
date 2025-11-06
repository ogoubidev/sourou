<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<style>
body {
    font-family: 'DejaVu Sans', sans-serif;
    font-size: 13px;
    color: #333;
}
.header {
    text-align: center;
    color: #005078;
    border-bottom: 2px solid #005078;
    padding-bottom: 10px;
    margin-bottom: 20px;
}
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
}
.table th, .table td {
    border: 1px solid #ccc;
    padding: 8px;
}
.table th {
    background: #005078;
    color: white;
}
.info {
    margin-bottom: 10px;
}
.section-title {
    color: #005078;
    font-weight: bold;
    margin-top: 20px;
    border-bottom: 1px solid #005078;
}
</style>
</head>
<body>
    <div class="header">
        <h2>Facture de Paiement de Loyer</h2>
        <p>Mois concerné : <strong>{{ ucfirst($mois_concerne) }}</strong></p>
    </div>

    <div class="info">
        <p><strong>Nom du locataire :</strong> {{ $paiement->attribution->client->name.' '.$paiement->attribution->client->surname }}</p>
        <p><strong>Bien loué :</strong> {{ $paiement->attribution->bien->titre ?? 'Non spécifié' }}</p>
        <p><strong>Date du paiement :</strong> {{ $paiement->created_at->format('d/m/Y') }}</p>
        <p><strong>Mode de paiement :</strong> {{ $paiement->mode ?? 'Non précisé' }}</p>
    </div>

    <h4 class="section-title">Détails du bail</h4>
    <p><strong>Durée officielle :</strong> 
        {{ $paiement->attribution->date_debut->format('d/m/Y') }} 
        au {{ $paiement->attribution->date_fin->format('d/m/Y') }}
    </p>
    <p><strong>Loyer mensuel :</strong> {{ number_format($paiement->attribution->loyer_mensuel ?? 0, 0, ',', ' ') }} FCFA</p>
    <p><strong>Loyer déjà payé :</strong> {{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</p>

    @php
        $moisTotal = $paiement->attribution->moisTotal();
        $moisPayes = $paiement->attribution->moisPayes();
        $moisRestants = max($moisTotal - $moisPayes, 0);
        $reste = $moisRestants * ($paiement->attribution->loyer_mensuel ?? 0);
    @endphp

    <p><strong>Mois total du bail :</strong> {{ $moisTotal }}</p>
    <p><strong>Mois payés :</strong> {{ $moisPayes }}</p>
    <p><strong>Mois restants :</strong> {{ $moisRestants }}</p>
    <p><strong>Reste à payer :</strong> <span style="color:red">{{ number_format($reste, 0, ',', ' ') }} FCFA</span></p>

    <table class="table">
        <thead>
            <tr>
                <th>Description</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Paiement du mois de {{ ucfirst($mois_concerne) }}</td>
                <td>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</td>
            </tr>
            <tr>
                <td><strong>Total payé</strong></td>
                <td><strong>{{ number_format($paiement->montant, 0, ',', ' ') }} FCFA</strong></td>
            </tr>
        </tbody>
    </table>

    <p style="margin-top:20px;">Fait le {{ now()->format('d/m/Y') }} à <strong>Sourou Immobillier Service</strong></p>
    <p style="color:#005078;">Merci de votre confiance.</p>
</body>
</html>
