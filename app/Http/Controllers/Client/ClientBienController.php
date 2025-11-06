<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use FedaPay\FedaPay as FedaPaySDK;
use FedaPay\Transaction as FedaPayTransaction;
use App\Models\Transaction;
use App\Models\Bien;
use Illuminate\Support\Str;

class ClientBienController extends Controller
{
    public function acheter($bienId)
    {
        $bien = Bien::findOrFail($bienId);

        $transactions = auth()->user()->transactions()->latest()->take(10)->get();

        return view('client.biens.acheter', compact('bien', 'transactions'));
    }

    public function payer(Request $request)
    {
        $request->validate([
            'bien_id' => 'required|exists:biens,id',
            'montant' => 'required|numeric|min:100',
            'mode_paiement' => 'required|in:mobile_money,carte_credit,virement_bancaire',
        ]);

        $bien = Bien::findOrFail($request->bien_id);
        $mode = $request->mode_paiement;

        // Montant pour FedaPay (en centimes, entier)
        $amountFeda = (int) ($request->montant * 100);

        // Montant pour PayPal (float avec 2 décimales)
        $amountPayPal = number_format($request->montant, 2, '.', '');

        $transaction = Transaction::create([
            'user_id' => auth()->id(),
            'bien_id' => $bien->id,
            'reference' => Str::uuid(),
            'montant' => $amountFeda,
            'mode_paiement' => $mode,
            'statut' => 'en_attente',
            'details' => null,
        ]);

        if ($mode === 'mobile_money') {
            FedaPaySDK::setApiKey(config('services.fedapay.api_key'));
            FedaPaySDK::setEnvironment(config('services.fedapay.mode'));

            return response()->json([
                'public_key' => 'pk_live_yV2KhV_Yl-pw54zAt4ugq8wb',
                'montant' => $amountFeda,
                'description' => "Paiement achat bien #{$bien->id}",
                'transaction_id' => $transaction->id,
            ]);
        }

        if ($mode === 'carte_credit') {
            // Lien PayPal Me correct de l'entreprise à renseigner ici
            $paypalLink = 'https://www.paypal.me/ComptePaypal_sourou_immobillier/' . $amountPayPal;
            return redirect()->away($paypalLink);
        }

        if ($mode === 'virement_bancaire') {
            return back()->with('virement', true)->with('montant', $amountPayPal);
        }

        return back()->with('error', 'Mode de paiement inconnu.');
    }

    public function callback(Request $request)
    {
        $transaction = Transaction::where('id', $request->get('transaction_id'))->first();

        if (!$transaction) {
            return redirect()->route('client.biens.acheter', $request->get('bien_id'))
                             ->with('error', 'Transaction introuvable.');
        }

        FedaPaySDK::setApiKey(config('services.fedapay.api_key'));
        FedaPaySDK::setEnvironment(config('services.fedapay.mode'));

        try {
            $fpTransaction = FedaPayTransaction::retrieve($transaction->details['fedapay_token'] ?? null);

            if ($fpTransaction && $fpTransaction->status === 'completed') {
                $transaction->statut = 'reussi';
                $transaction->details = array_merge($transaction->details ?? [], ['fedapay_status' => 'completed']);
                $transaction->save();

                return redirect()->route('client.biens.acheter', $transaction->bien_id)
                                 ->with('success', 'Paiement réussi via Mobile Money.');
            } else {
                $transaction->statut = 'echoue';
                $transaction->save();
                return redirect()->route('client.biens.acheter', $transaction->bien_id)
                                 ->with('error', 'Le paiement a échoué.');
            }
        } catch (\Exception $e) {
            $transaction->statut = 'echoue';
            $transaction->save();
            return redirect()->route('client.biens.acheter', $transaction->bien_id)
                             ->with('error', 'Erreur lors de la vérification du paiement.');
        }
    }


    public function uploadProof(Request $request)
    {
        $request->validate([
            'bien_id' => 'required|exists:biens,id',
            'proof_file' => 'required|mimes:pdf|max:10240', // max 10MB
        ]);

        $file = $request->file('proof_file');
        $filename = 'preuve_'.$request->user()->id.'_'.time().'.'.$file->getClientOriginalExtension();
        $path = $file->storeAs('proofs', $filename, 'public');

        // Ici tu peux soit enregistrer le chemin dans une table (ex: proof_files)
        // soit l'associer à la transaction correspondante
        // Exemple simple :
        \App\Models\Transaction::where('user_id', $request->user()->id)
            ->where('bien_id', $request->bien_id)
            ->latest()
            ->first()
            ->update(['proof_path' => $path]);

        return back()->with('success', 'Preuve uploadée avec succès !');
    }

}
