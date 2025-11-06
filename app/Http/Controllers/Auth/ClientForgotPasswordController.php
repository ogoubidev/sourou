<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ClientForgotPasswordController extends Controller
{
    public function showForgotForm()
    {
        return view('client.auth.passwords.email');
    }

    public function sendTemporaryPassword(Request $request)
    {
        $request->validate([
            'telephone' => 'required|exists:users,telephone',
        ]);

        $user = User::where('telephone', $request->telephone)
                    ->where('role', 'client')
                    ->firstOrFail();

        // Générer mot de passe temporaire (8 caractères alphanumériques)
        $temporaryPassword = Str::random(8);

        // Enregistrer le mot de passe temporaire hashé et forcer changement
        $user->password = Hash::make($temporaryPassword);
        $user->must_change_password = true;
        $user->save();

        // Connecter automatiquement l’utilisateur avec son mot de passe temporaire
        auth()->login($user);

        // Rediriger vers la page de changement de mot de passe
        return redirect()->route('client.password.change')
                        ->with('status', "Un mot de passe temporaire a été généré. Veuillez le changer immédiatement.");

    }
}
