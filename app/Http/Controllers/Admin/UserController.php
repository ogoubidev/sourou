<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Récupérer tous les utilisateurs et biens ou juste les derniers
        $users = User::latest()->take(12)->get();
        $biens = Bien::latest()->take(12)->get();

        // Passer à la vue
        return view('admin.users', compact('users', 'biens'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'telephone' => ['required', 'digits:10', 'unique:users,telephone'],
            'email' => ['nullable', 'string', 'lowercase', 'email', 'max:255'],
        ]);
    
        // Générer un mot de passe temporaire: 8 caractères
        $passwordTemp = Str::random(8); 
    
        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'telephone' => $request->telephone,
            'email' => $request->email,
            'password' => Hash::make($passwordTemp),
            'role' => 'proprietaire', 
            'must_change_password' => true, // champ booléen qui informe si le mot de passe à été changer ou non
        ]);
    
        session()->flash('password_temp', $passwordTemp);
    
        return redirect()->route('admin.users.index')->with('success', 'Utilisateur créé avec succès. Mot de passe temporaire : '.$passwordTemp);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


















}
