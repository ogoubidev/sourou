<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bien;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::latest()->take(10)->get();

        return view('admin.dashboard', [
            'nombreProprio'      => User::where('role', 'proprietaire')->count(),
            'nombreClients'      => User::where('role', 'client')->count(),
            'nombreBiens'        => Bien::count(),
            'nombreTransactions' => Paiement::count(),
            'transactionsRecentes' => Paiement::with('attribution.bien', 'attribution.client')
                                             ->latest()
                                             ->take(5)
                                             ->get(),
            'articlesRecents'    => Bien::latest()->take(5)->get(),
        ]);
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
    public function store(Request $request)
    {
        //
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
