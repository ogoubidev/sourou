<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Liste des utilisateurs (sauf l'utilisateur connecté)
     */
    public function index()
    {
        $user = Auth::user();

        $users = User::where('id', '!=', $user->id)->get();

        // On garde la vue commune
        return view('dashboard.users.index', compact('users', 'user'));
    }
}
