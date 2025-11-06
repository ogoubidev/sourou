@extends('layouts.client')

@section('title', 'Mes signalements')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold text-primary">Mes signalements</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <a href="{{ route('client.signalements.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Nouveau signalement
        </a>
    </div>

    @if($signalements->isEmpty())
        <div class="alert alert-info">Aucun signalement pour le moment.</div>
    @else
        <ul class="list-group shadow-sm">
            @foreach($signalements as $sig)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="mb-1">{{ ucfirst($sig->categorie ?? 'Autre') }}</h6>
                        <small class="text-muted">{{ Str::limit($sig->description, 50) }}</small>
                        <div>
                            <small class="text-info">Statut : {{ ucfirst($sig->statut) }}</small>
                        </div>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="{{ route('client.signalements.show', $sig->id) }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('client.signalements.edit', $sig->id) }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('client.signalements.destroy', $sig->id) }}" method="POST" onsubmit="return confirm('Voulez-vous vraiment supprimer ce signalement ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger"><i class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
