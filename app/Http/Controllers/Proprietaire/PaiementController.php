<?php

namespace App\Http\Controllers\Proprietaire;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        return view('proprio.paiement');
    }
}
