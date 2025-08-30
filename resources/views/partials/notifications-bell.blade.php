@auth
<div class="dropdown">
    <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-bell" style="font-size: 1.4rem;"></i>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        @endif
    </a>

    <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationsDropdown" style="width: 320px; max-height: 420px; overflow-y:auto;">
        <div class="d-flex align-items-center justify-content-between px-3 py-2">
            <strong>Notifications</strong>
            @if(auth()->user()->unreadNotifications->count() > 0)
            <form method="POST" action="{{ route('notifications.markAllRead') }}">
                @csrf
                <button class="btn btn-sm btn-outline-primary">Tout marquer comme lu</button>
            </form>
            @endif
        </div>
        <div class="dropdown-divider"></div>

        @forelse(auth()->user()->notifications as $notification)
            @php
                // On passe par une route dédiée qui marque comme lue et redirige intelligemment
                $openUrl = route('notifications.open', $notification->id);
            @endphp
            <a href="{{ $openUrl }}" class="dropdown-item d-flex align-items-start {{ $notification->read_at ? '' : 'fw-bold' }}">
                <div class="me-2 mt-1"><i class="bi bi-info-circle"></i></div>
                <div>
                    <div>{{ $notification->data['message'] ?? 'Notification' }}</div>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            </a>
            <div class="dropdown-divider"></div>
        @empty
            <div class="dropdown-item text-muted">Aucune notification</div>
        @endforelse
    </div>
</div>
@endauth
