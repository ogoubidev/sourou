<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Fedapay\FedaPay;

class TransactionController extends Controller
{
    public function initPayment(Request $request, Bien $bien)
    {
        $request->validate([
            'date_debut' => 'required|date',
            'date_fin'   => 'required|date|after:date_debut',
        ]);

        $client = Auth::user();

        if ($bien->statut !== 'disponible') {
            return back()->with('error', 'Ce bien n\'est plus disponible.');
        }

        $nbMois = \Carbon\Carbon::parse($request->date_debut)
                   ->diffInMonths(\Carbon\Carbon::parse($request->date_fin)) + 1;

        $montant = $bien->loyer_mensuel * $nbMois;

        // Créer transaction locale dans DB
        $transaction = Transaction::create([
            'bien_id'    => $bien->id,
            'client_id'  => $client->id,
            'montant'    => $montant,
            'status'     => 'pending',
            'date_debut' => $request->date_debut,
            'date_fin'   => $request->date_fin
        ]);

        // Créer la transaction FedaPay
        FedaPay::setApiKey(config('services.fedapay.secret'));

        $fpTransaction = FedaPay\Transaction::create([
            'amount' => $montant,
            'currency' => 'XOF',
            'callback_url' => route('transactions.callback'),
            'return_url'   => route('transactions.success'),
            'customer' => [
                'email' => $client->email,
                'first_name' => $client->name,
                'last_name'  => $client->surname,
            ],
            'metadata' => [
                'transaction_id' => $transaction->id
            ]
        ]);

        // Sauvegarder l'ID FedaPay
        $transaction->update(['feda_transaction_id' => $fpTransaction->id]);

        return redirect($fpTransaction->getPaymentUrl());
    }

    public function callback(Request $request)
    {
        $fedaId = $request->input('transaction_id');
        $transaction = Transaction::where('feda_transaction_id', $fedaId)->first();

        if (!$transaction) {
            return redirect()->route('catalogue')->with('error', 'Transaction introuvable.');
        }

        $fpTransaction = FedaPay\Transaction::retrieve($fedaId);

        if ($fpTransaction->status === 'approved') {
            $transaction->update(['status' => 'approved']);

            // Créer l'attribution
            $attribution = $transaction->bien->attributions()->create([
                'client_id' => $transaction->client_id,
                'date_debut' => $transaction->date_debut,
                'date_fin'   => $transaction->date_fin,
                'loyer_mensuel' => $transaction->montant / \Carbon\Carbon::parse($transaction->date_debut)->diffInMonths(\Carbon\Carbon::parse($transaction->date_fin) + 1),
                'date_attribution' => now()->toDateString()
            ]);

            $transaction->bien->update(['statut' => 'attribue']);

            return redirect()->route('catalogue')->with('success', 'Paiement réussi et location confirmée !');
        }

        $transaction->update(['status' => 'failed']);
        return redirect()->route('catalogue')->with('error', 'Le paiement a échoué.');
    }
}
