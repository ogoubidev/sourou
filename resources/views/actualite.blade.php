@extends('layouts.app')

@section('title', 'Actualités')

@section('content')
<style>

.blog-container {
    max-width: 1200px;
    margin: 60px auto;
    padding: 0 20px;
}

.blog-header {
    text-align: center;
    margin-bottom: 40px;
}

.blog-header h2 {
    font-weight: 700;
    font-size: 2.2rem;
    color: #222;
    position: relative;
}

.blog-header h2::after {
    content: "";
    display: block;
    width: 80px;
    height: 4px;
    background: #005078;
    margin: 10px auto 0;
    border-radius: 2px;
}

.blog-layout {
    display: grid;
    grid-template-columns: 3fr 1fr;
    gap: 30px;
}

.blog-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 30px;
}

/* --- CARD --- */
.blog-card {
    position: relative;
    background: #fff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    transition: all 0.4s ease;
    cursor: pointer;
}

.blog-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 30px rgba(0,0,0,0.15);
}

/* --- IMAGE --- */
.blog-card img {
    width: 100%;
    height: 230px;
    object-fit: cover;
    transition: transform 0.4s ease;
    position: relative;
    z-index: 1;
}

/* Bordure animée sur l’image */
.blog-card img::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 4px;
    background: #005078;
    transform: translateX(-50%);
    transition: all 0.5s ease;
    border-radius: 2px;
    z-index: 2;
}

.blog-card:hover img::after {
    width: 100%;
}

.blog-card:hover img {
    transform: scale(1.05);
}

/* --- LOGO CIRCULAIRE --- */
.blog-logo-circle {
    position: absolute;
    top: 190px; /* chevauche image et carte */
    left: 50%;
    transform: translateX(-50%);
    width: 90px;
    height: 90px;
    background: #fff;
    border-radius: 50%;
    box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 3;
    overflow: hidden;
    border: 3px solid #005078;
}

.blog-logo-circle img {
    width: 100%;
    height: auto;
}

/* --- CORPS --- */
.blog-card-body {
    padding: 70px 20px 25px;
    text-align: center;
}

.blog-card-body h5 {
    font-size: 1.2rem;
    font-weight: 700;
    color: #00334d;
    margin-bottom: 10px;
}

.blog-card-body p {
    color: #555;
    font-size: 0.95rem;
    margin-bottom: 15px;
    min-height: 50px;
}

/* --- BOUTON “VOIR +” --- */
.blog-card .view-btn {
    display: inline-block;
    background: #005078;
    color: #fff;
    font-weight: 600;
    padding: 8px 18px;
    border-radius: 25px;
    text-decoration: none;
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.4s ease;
    position: relative;
    overflow: hidden;
}

.blog-card:hover .view-btn {
    opacity: 1;
    transform: translateY(0);
    animation: flashArrow 1.5s infinite;
}

@keyframes flashArrow {
    0% { box-shadow: 0 0 0px #005078; }
    50% { box-shadow: 0 0 15px #0073aa; }
    100% { box-shadow: 0 0 0px #005078; }
}

.view-btn span {
    display: inline-block;
    transition: transform 0.3s;
}

.view-btn:hover span {
    transform: translateX(5px);
}

/* --- SIDEBAR --- */
.sidebar {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    height: fit-content;
}

.sidebar h4 {
    margin-bottom: 15px;
    font-weight: 700;
    color: #00334d;
    border-bottom: 3px solid #005078;
    display: inline-block;
    padding-bottom: 5px;
}

.recent-posts a {
    display: block;
    color: #333;
    margin-bottom: 10px;
    text-decoration: none;
    font-size: 0.95rem;
    transition: 0.3s;
}

.recent-posts a:hover {
    color: #005078;
}

.search-box input {
    width: 100%;
    padding: 10px 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    outline: none;
}

@media(max-width: 992px) {
    .blog-layout {
        grid-template-columns: 1fr;
    }
}


/* --- WRAPPER IMAGE --- */
.image-wrapper {
    position: relative;
    overflow: hidden;
}

/* Bordure animée qui traverse l'image au survol */
.image-wrapper::after {
    content: "";
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 8px;
    background: #005078;
    transform: translateX(-50%);
    transition: all 0.6s ease;
    border-radius: 2px;
    z-index: 3;
}

.blog-card:hover .image-wrapper::after {
    width: 100%;
}

/* Effet zoom sur l’image au survol */
.image-wrapper img {
    width: 100%;
    height: 230px;
    object-fit: cover;
    transition: transform 0.4s ease;
    position: relative;
    z-index: 1;
}

.blog-card:hover .image-wrapper img {
    transform: scale(1.05);
}

</style>

<div class="blog-container">
    <div class="blog-header">
        <h2>Nos Actualités</h2>
    </div>

    @if(isset($query))
        <h4>Résultats pour « {{ $query }} »</h4>
    @endif

    <div class="blog-layout">
        <!-- SECTION DES ARTICLES -->
        <div class="blog-grid">
            @foreach ($posts as $post)
                <div class="blog-card">
                    <div class="image-wrapper">
                        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->titre }}">
                    </div>

                    <!-- Logo circulaire au centre -->
                    <div class="blog-logo-circle">
                        <img src="{{ asset('assets/images/logotype sourou bleu_Plan de travail 1.png') }}" alt="SIS SARL">
                    </div>

                    <div class="blog-card-body">
                        <h5>{{ $post->titre }}</h5>
                        <p>{{ Str::limit($post->resume, 100) }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="view-btn">
                            Voir plus <span>&raquo;&raquo;&raquo;</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- SIDEBAR -->
        <div class="sidebar">
            <div class="search-box mb-4">
                <form action="{{ route('blog.search') }}" method="GET" class="d-flex">
                    <input 
                        type="text" 
                        name="q" 
                        placeholder="Rechercher un article..." 
                        value="{{ request('q') }}" 
                        class="form-control me-2"
                    >
                    <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
                </form>
            </div>

            <div class="recent-posts">
                <h4>Articles récents</h4>
                @foreach ($recentPosts as $recent)
                    <a href="{{ route('blog.show', $recent->slug) }}">{{ $recent->titre }}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
