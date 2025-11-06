@extends('layouts.' . Auth::user()->role)

@section('title', 'Utilisateurs disponibles')

@section('content')
<div class="container py-4">
    <h3 class="mb-4 fw-bold text-primary">Démarrer une conversation</h3>

    <div class="row">
        @foreach($users as $u)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm p-3 text-center">
                    <img src="{{ $u->avatar ?? asset('assets/images/default-avatar.png') }}" class="rounded-circle mx-auto mb-2" width="70" height="70" alt="avatar">
                    <h6>{{ $u->name }}</h6>
                    <a href="{{ route('conversations.start', $u->id) }}" class="btn btn-outline-primary btn-sm mt-2">Discuter</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
