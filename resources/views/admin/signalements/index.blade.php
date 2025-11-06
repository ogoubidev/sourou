@extends('layouts.admin')

@section('title', 'Signalements clients')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold">Tous les signalements</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($signalements->isEmpty())
        <div class="alert alert-info">Aucun signalement pour le moment.</div>
    @else
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Client</th>
                    <th>Catégorie</th>
                    <th>Description</th>
                    <th>Statut</th>
                    <th>Réponse Admin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($signalements as $s)
                    <tr>
                        <td>{{ $s->id }}</td>
                        <td>{{ $s->client->name }} {{ $s->client->surname }}</td>
                        <td>{{ $s->categorie ?? '-' }}</td>
                        <td>{{ $s->description }}</td>
                        <td>{{ ucfirst($s->statut) }}</td>
                        <td>{{ $s->reponse_admin ?? '-' }}</td>
                        <td>
                            <a href="{{ route('admin.signalements.edit', $s->id) }}" class="btn btn-sm btn-primary">Modifier</a>
                            <form action="{{ route('admin.signalements.destroy', $s->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce signalement ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
