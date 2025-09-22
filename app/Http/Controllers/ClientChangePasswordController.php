<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ClientChangePasswordController extends Controller
{
    public function showChangeForm()
    {
        return view('client.auth.passwords.change'); // formulaire de changement
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();
        $user->password = Hash::make($request->password);
        $user->must_change_password = 0; // reset du flag
        $user->save();

        return redirect()->route('client.dashboard')->with('status', '✅ Votre mot de passe a été mis à jour avec succès');
    }
}
