@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

    <!-- Cartes statistiques -->
    <div class="row g-4 mb-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0 stat-card h-100">
                <div class="card-body text-center">
                    <div class="icon-circle bg-primary mb-3">
                        <i class="bi bi-people text-white"></i>
                    </div>
                    <h5 class="card-title">Propriétaires</h5>
                    <h3 class="fw-bold">{{  $nombreProprio }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 stat-card h-100">
                <div class="card-body text-center">
                    <div class="icon-circle bg-success mb-3">
                        <i class="bi bi-person text-white"></i>
                    </div>
                    <h5 class="card-title">Clients</h5>
                    <h3 class="fw-bold">{{ $nombreClients }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 stat-card h-100">
                <div class="card-body text-center">
                    <div class="icon-circle bg-info mb-3">
                        <i class="bi bi-file-earmark-text text-white"></i>
                    </div>
                    <h5 class="card-title">Bien</h5>
                    <h3 class="fw-bold">{{  $nombreBiens }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card shadow-sm border-0 stat-card h-100">
                <div class="card-body text-center">
                    <div class="icon-circle bg-warning mb-3">
                        <i class="bi bi-currency-dollar text-white"></i>
                    </div>
                    <h5 class="card-title">Transactions</h5>
                    <h3 class="fw-bold">{{ $nombreTransactions }}</h3>
                </div>
            </div>
        </div>
    </div>

    <!-- Deux blocs en dessous -->
    <div class="row g-4">
        <!-- Transactions récentes -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Transactions récentes</span>
                    <a href="#" class="text-decoration-none small"><i class="bi bi-eye"></i> Voir tout</a>
                </div>
                <div class="card-body">
                    <div class="empty-state">
                        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucune transaction" class="empty-img">
                        <p>Aucune transaction récente</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Derniers articles -->
        <div class="col-md-6">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-header bg-light d-flex justify-content-between align-items-center">
                    <span class="fw-bold">Derniers articles</span>
                    <a href="#" class="text-decoration-none small"><i class="bi bi-eye"></i> Voir tout</a>
                </div>
                <div class="card-body">
                    <div class="empty-state">
                        <img src="https://cdn-icons-png.flaticon.com/512/4076/4076549.png" alt="Aucun article" class="empty-img">
                        <p>Aucun article récent</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Styles pour effets hover -->
    <style>
        .stat-card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.1);
        }
        .icon-circle {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }
        .empty-state img {
            width: 100px;
            opacity: 0.6;
        }
    </style>
@endsection
