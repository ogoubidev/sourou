@php
$notifPaiements = auth()->user()->unreadNotifications()->where('type', \App\Notifications\PaiementEffectue::class)->get();
@endphp

<li class="nav-item dropdown">
    <a class="nav-link position-relative" href="#" id="notificationsPaiementDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-cash-stack" style="font-size: 1.4rem;"></i>
        @if($notifPaiements->count() > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $notifPaiements->count() }}
            </span>
        @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationsPaiementDropdown" style="width: 320px; max-height: 400px; overflow-y: auto;">
        <li class="dropdown-header">Paiements</li>
        @forelse($notifPaiements as $notification)
            <li>
                <a href="{{ route('notifications.open', $notification) }}" class="dropdown-item d-flex align-items-start {{ $notification->read_at ? '' : 'fw-bold' }}">
                    <div>
                        <div>{!! $notification->data['message'] !!}</div>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                </a>
            </li>
            <li><hr class="dropdown-divider"></li>
        @empty
            <li class="dropdown-item text-muted">Aucun paiement récent</li>
        @endforelse
    </ul>
</li>
