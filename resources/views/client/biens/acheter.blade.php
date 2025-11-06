@extends('layouts.client')

@section('content')
<div class="container py-5 d-flex flex-column">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Acheter un bien</h4>
        <!-- Bouton pour ouvrir le modal -->
        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#uploadProofModal">
            Enrégistrer une preuve
        </button>
    </div>

    {{-- Messages succès / erreur --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Formulaire paiement --}}
    <form id="payment-form" class="p-4 border rounded bg-light shadow-sm">
        @csrf
        <div class="mb-3">
            <label class="form-label fw-semibold">Montant à payer (en Fcfa)</label>
            <input type="number" id="montant" class="form-control" value="{{ $bien->prix }}" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label fw-semibold">Mode de paiement</label>
            <select id="mode_paiement" class="form-select" required>
                <option value="" selected disabled>-- Sélectionnez un mode --</option>
                <option value="mobile_money">Mobile Money (via FedaPay)</option>
                <option value="carte_credit">Carte bancaire (via PayPal)</option>
                <option value="virement_bancaire">Virement bancaire</option>
            </select>
        </div>

        {{-- Coordonnées bancaires dynamiques --}}
        <div id="virement-info" class="alert alert-info mt-3 d-none transition" style="transition: all 0.4s ease;">
            <h5 class="fw-bold mb-2">Informations pour le virement bancaire</h5>
            <ul class="list-unstyled mb-2">
                <li><strong>Banque :</strong> Bank of Africa</li>
                <li><strong>Titulaire :</strong> Société Sourou SARL</li>
                <li><strong>Numéro de compte :</strong> 123 456 789 000</li>
                <li><strong>IBAN :</strong> BJ12BOA00123456789000</li>
                <li><strong>Montant :</strong> <span id="virement-montant">{{ $bien->prix }}</span> Fcfa</li>
            </ul>
            <p class="mb-0">Veuillez effectuer le virement et envoyer la preuve au service client.</p>
        </div>

        <button type="button" id="pay-btn" class="btn btn-primary px-4 mt-3">Payer</button>
    </form>
</div>

{{-- Modal pour uploader la preuve --}}
<div class="modal fade" id="uploadProofModal" tabindex="-1" aria-labelledby="uploadProofModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('client.proof.upload') }}" method="POST" enctype="multipart/form-data" class="modal-content">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title" id="uploadProofModalLabel">Enrégistrer une preuve de paiement</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="bien_id" class="form-label">Bien concerné</label>
                    <select name="bien_id" id="bien_id" class="form-select" required>
                        <option value="" selected disabled>-- Sélectionnez un bien --</option>
                        @php
                            $biens = App\Models\Bien::whereIn('id', auth()->user()->transactions()->pluck('bien_id'))
                                    ->where('type', 'vente')
                                    ->where('statut', 'disponible')
                                    ->get();
                        @endphp
                        @foreach($biens as $b)
                            <option value="{{ $b->id }}">{{ $b->titre }}</option>
                        @endforeach
                    </select>                    
                </div>
                <div class="mb-3">
                    <label for="proof_file" class="form-label">Fichier preuve (PDF uniquement)</label>
                    <input type="file" name="proof_file" id="proof_file" class="form-control" accept="application/pdf" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="submit" class="btn btn-success">Uploader</button>
            </div>
        </form>
    </div>
</div>

{{-- Fedapay et logique dynamique --}}
<script src="https://cdn.fedapay.com/checkout.js"></script>
<script>
const modeSelect = document.getElementById('mode_paiement');
const virementDiv = document.getElementById('virement-info');
const payBtn = document.getElementById('pay-btn');
const montantInput = document.getElementById('montant');

modeSelect.addEventListener('change', function() {
    if(this.value === 'virement_bancaire'){
        virementDiv.classList.remove('d-none');
        virementDiv.style.opacity = 1;
    } else {
        virementDiv.style.opacity = 0;
        setTimeout(() => virementDiv.classList.add('d-none'), 400);
    }
});

payBtn.addEventListener('click', function() {
    const montant = montantInput.value;
    const mode = modeSelect.value;

    if(!mode) return alert('Veuillez sélectionner un mode de paiement');

    if(mode === 'mobile_money'){
        fetch("{{ route('client.biens.payer') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                bien_id: {{ $bien->id }},
                montant: montant,
                mode_paiement: mode
            })
        })
        .then(res => res.json())
        .then(data => {
            if(data.public_key){
                FedaPay.init('#pay-btn', {
                    public_key: data.public_key,
                    transaction: {
                        amount: data.montant,
                        description: data.description
                    },
                    onComplete: function(response){
                        if(response.reason === 'CHECKOUT COMPLETE'){
                            window.location.href = "{{ route('client.paiement.callback') }}?transaction_id=" + data.transaction_id;
                        }
                    }
                });
            } else {
                alert('Erreur lors de l\'initialisation du paiement.');
            }
        });
    }

    if(mode === 'carte_credit'){
        window.location.href = 'https://www.paypal.me/tonComptePaypal/' + montant;
    }

    if(mode === 'virement_bancaire'){
        virementDiv.scrollIntoView({ behavior: 'smooth' });
    }
});
</script>

<style>
.transition {
    opacity: 0;
    transform: translateY(-10px);
}
.transition.d-none {
    display: none;
}
.transition:not(.d-none) {
    display: block;
    transform: translateY(0);
}
</style>
@endsection
