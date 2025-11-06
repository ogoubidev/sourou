@extends('layouts.admin')

@section('title', 'Dépenses')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 text-white">💰 Gestion des Dépenses</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- FORMULAIRE D’AJOUT -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header bg-dark text-light">Ajouter une dépense</div>
        <div class="card-body">
            <form action="{{ route('admin.depenses.store') }}" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Bien</label>
                        <select name="bien_id" class="form-select" required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($biens as $bien)
                                <option value="{{ $bien->id }}">{{ $bien->titre }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Type</label>
                        <select name="type" class="form-select" required>
                            <option value="réparation">Réparation</option>
                            <option value="entretien">Entretien</option>
                            <option value="frais_gestion">Frais de gestion</option>
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Montant (FCFA)</label>
                        <input type="number" step="0.01" name="montant" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Date</label>
                        <input type="date" name="date_depense" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Prestataire</label>
                        <input type="text" name="prestataire" class="form-control" placeholder="Nom du prestataire">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-control" placeholder="Détails de la dépense..."></textarea>
                    </div>
                </div>

                <div class="text-end mt-3">
                    <button class="btn btn-primary"> Enregistrer</button>
                </div>
            </form>
        </div>
    </div>

    <!-- TABLEAU DES DÉPENSES -->
    <div class="card shadow">
        <div class="card-header bg-dark text-light">Liste des dépenses enregistrées</div>
        <div class="card-body table-responsive">
            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Bien</th>
                        <th>Type</th>
                        <th>Montant</th>
                        <th>Prestataire</th>
                        <th>Date</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($depenses as $depense)
                        <tr>
                            <td>{{ $depense->bien->titre ?? '—' }}</td>
                            <td>{{ ucfirst($depense->type) }}</td>
                            <td>{{ number_format($depense->montant, 0, ',', ' ') }} FCFA</td>
                            <td>{{ $depense->prestataire ?? '—' }}</td>
                            <td>{{ \Carbon\Carbon::parse($depense->date_depense)->format('d/m/Y') }}</td>
                            <td>{{ $depense->description ?? '—' }}</td>
                            <td>
                                <!-- Boutons -->
                                <button class="btn btn-sm btn-warning" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal{{ $depense->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>

                                <form action="{{ route('admin.depenses.destroy', $depense) }}" method="POST" class="d-inline" onsubmit="return confirm('Supprimer cette dépense ?')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>

                        <!-- MODALE ÉDITION -->
                        <div class="modal fade" id="editModal{{ $depense->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header bg-dark text-light">
                                        <h5 class="modal-title">Modifier la dépense</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin.depenses.update', $depense) }}" method="POST">
                                            @csrf @method('PUT')
                                            <div class="row g-3">
                                                <div class="col-md-4">
                                                    <label class="form-label">Bien</label>
                                                    <select name="bien_id" class="form-select" required>
                                                        @foreach($biens as $bien)
                                                            <option value="{{ $bien->id }}" {{ $depense->bien_id == $bien->id ? 'selected' : '' }}>
                                                                {{ $bien->titre }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Type</label>
                                                    <select name="type" class="form-select" required>
                                                        <option value="réparation" {{ $depense->type == 'réparation' ? 'selected' : '' }}>Réparation</option>
                                                        <option value="entretien" {{ $depense->type == 'entretien' ? 'selected' : '' }}>Entretien</option>
                                                        <option value="frais_gestion" {{ $depense->type == 'frais_gestion' ? 'selected' : '' }}>Frais de gestion</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2">
                                                    <label class="form-label">Montant</label>
                                                    <input type="number" step="0.01" name="montant" class="form-control" value="{{ $depense->montant }}" required>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="form-label">Date</label>
                                                    <input type="date" name="date_depense" class="form-control" value="{{ $depense->date_depense }}" required>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Prestataire</label>
                                                    <input type="text" name="prestataire" class="form-control" value="{{ $depense->prestataire }}">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="form-label">Description</label>
                                                    <textarea name="description" class="form-control">{{ $depense->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="text-end mt-3">
                                                <button type="submit" class="btn btn-success"> Enregistrer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <tr><td colspan="7" class="text-center text-muted">Aucune dépense enregistrée</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
