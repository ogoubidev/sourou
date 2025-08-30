<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TemoignageController extends Controller
{
    public function index()
    {
        $temoignages = Temoignage::latest()->take(10)->get();
        return view('admin.temoignages.index', compact('temoignages'));
    }

    public function create()
    {
        return view('temoignages.create');
    }


    public function store(Request $request)
{
    $request->validate([
        'message' => 'required|string',
        'photo' => 'nullable|image|max:2048',
        'note' => 'required|integer|min:1|max:5',
    ]);

    $user = Auth::user();

    $data = [
        'name' => $user->name,
        'surname' => $user->surname,
        'role' => $user->role, // client / proprietaire
        'message' => $request->message,
        'note' => $request->note,
    ];

    if ($request->hasFile('photo')) {
        $data['photo'] = $request->file('photo')->store('temoignages', 'public');
    }

    Temoignage::create($data);

    return redirect()->route('accueil')->with('success', 'Merci pour votre témoignage !');

}

    
    
}

