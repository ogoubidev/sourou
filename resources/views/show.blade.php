<div class="container mt-4">
    <h4>{{ $conversation->titre }}</h4>
    <div class="border rounded p-3 mb-3" style="height:400px; overflow-y:auto;">
        @foreach($conversation->messages as $msg)
            <div class="mb-2 d-flex {{ $msg->expediteur_id == auth()->id() ? 'justify-content-end' : 'justify-content-start' }}">
                <div class="p-2 rounded {{ $msg->expediteur_id == auth()->id() ? 'bg-primary text-white' : 'bg-light' }}">
                    {{ $msg->contenu }}
                    <br><small class="text-muted">{{ $msg->created_at->format('d/m/Y H:i') }}</small>
                </div>
            </div>
        @endforeach
    </div>

    <form action="{{ route(Auth::user()->role . '.messagerie.send', $conversation) }}" method="POST">
        @csrf
        <div class="input-group">
            <input type="text" name="contenu" class="form-control" placeholder="Votre message..." required>
            <button class="btn btn-primary"><h4><i class="bi bi-send-fill"></i></h4></button>
        </div>
    </form>    
</div>
