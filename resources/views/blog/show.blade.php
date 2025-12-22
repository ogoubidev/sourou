@extends('layouts.app')

@section('title', $post->titre)

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h2 class="fw-semibold mb-3">{{ $post->titre }}</h2>
            <p class="text-muted mb-4">
                Publié le {{ $post->created_at->format('d/m/Y') }}
                @if($post->categorie)
                    | Catégorie : {{ $post->categorie->nom }}
                @endif
            </p>
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->titre }}" class="img-fluid rounded mb-4">

            <div class="content">
                {!! nl2br(e($post->contenu)) !!}
            </div>

            <hr class="my-5">

            <h4 class="fw-bold mb-3">Articles récents</h4>
            <ul>
                @foreach($recentPosts as $recent)
                    <li>
                        <a href="{{ route('blog.show', $recent->slug) }}">{{ $recent->titre }}</a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection
