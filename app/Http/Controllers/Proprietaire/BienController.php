<?php

namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use Illuminate\Support\Facades\Auth;

class BienController extends Controller
{

    public function index()
    {
        $proprioId = Auth::id();

        $biens = Bien::where('proprietaire_id', $proprioId)
                     ->latest()
                     ->get();

        return view('proprio.biens', compact('biens'));
    }

}
