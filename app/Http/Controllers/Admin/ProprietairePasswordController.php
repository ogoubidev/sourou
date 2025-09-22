<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProprietairePasswordController extends Controller
{
    public function reset(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::where('id', $request->user_id)
                    ->where('role', 'proprietaire')
                    ->firstOrFail();

        // Générer un mot de passe temporaire
        $newPassword = Str::random(8);

        // Mettre à jour le mot de passe 
        $user->password = bcrypt($newPassword);
        $user->must_change_password = 1;    // Oblige l'user à modifier son mot de passe une fois connecté avec le mot de passe généré
        
        $user->save();

        return back()->with('status', "✅ Nouveau mot de passe pour {$user->name} : $newPassword");
    }
}

