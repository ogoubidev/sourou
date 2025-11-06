@php
$notifPaiements = auth()->user()->notifications()
    ->where('type', \App\Notifications\PaiementEffectue::class)
    ->latest()
    ->get();
@endphp

<li class="nav-item dropdown">
    <!-- Icône paiements -->
    <a class="nav-link position-relative" href="#" id="notificationsPaiementDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-cash-stack" style="font-size: 1.4rem;"></i>
        @if($notifPaiements->whereNull('read_at')->count() > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $notifPaiements->whereNull('read_at')->count() }}
            </span>
        @endif
    </a>

    <!-- Dropdown paiements -->
    <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationsPaiementDropdown" style="width: 320px; max-height: 420px; overflow-y:auto;">
        
        <!-- Header -->
        <div class="d-flex align-items-center justify-content-between px-3 py-2">
            <strong>Paiements</strong>
            @if($notifPaiements->whereNull('read_at')->count() > 0)
            <form method="POST" action="{{ route('notifications.markAllRead') }}">
                @csrf
                <button class="btn btn-sm btn-outline-primary">Tout marquer comme lu</button>
            </form>
            @endif
        </div>
        <div class="dropdown-divider"></div>

        <!-- 5 derniers paiements -->
        @forelse($notifPaiements->take(5) as $notification)
            @php
                $openUrl = route('notifications.open', $notification->id);
            @endphp

            <a href="{{ $openUrl }}" class="dropdown-item d-flex align-items-start {{ $notification->read_at ? '' : 'fw-bold' }}">
                <div class="me-2 mt-1"><i class="bi bi-cash-coin text-success"></i></div>
                <div>
                    <div>{!! $notification->data['message'] !!}</div>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            </a>
            <div class="dropdown-divider"></div>
        @empty
            <div class="dropdown-item text-muted">Aucun paiement récent</div>
        @endforelse

        <!-- Voir plus -->
        @if($notifPaiements->count() > 5)
            <div class="text-center py-2">
                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#allPaiementsModal">
                    Voir tous les paiements
                </button>
            </div>
        @endif
    </div>
</li>

<!-- Modal tous les paiements -->
<div class="modal fade" id="allPaiementsModal" tabindex="-1" aria-labelledby="allPaiementsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content rounded-4 shadow">
      
      <!-- Header -->
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="allPaiementsLabel">Historique des paiements</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      
      <!-- Body -->
      <div class="modal-body p-0">
        <div class="list-group list-group-flush">
            @forelse($notifPaiements as $notification)
                @php
                    $openUrl = route('notifications.open', $notification->id);
                @endphp
                <a href="{{ $openUrl }}" 
                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-start {{ $notification->read_at ? '' : 'fw-bold bg-light' }}">
                    <div class="me-2"><i class="bi bi-cash-coin text-success"></i></div>
                    <div class="flex-grow-1">
                        <div>{!! $notification->data['message'] !!}</div>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    <i class="bi bi-chevron-right text-muted"></i>
                </a>
            @empty
                <div class="text-center text-muted py-3">
                    Aucun paiement enregistré
                </div>
            @endforelse
        </div>
      </div>
      
      <!-- Footer -->
      <div class="modal-footer">
        <form method="POST" action="{{ route('notifications.markAllRead') }}" class="me-auto">
            @csrf
            <button class="btn btn-sm btn-outline-primary">Tout marquer comme lu</button>
        </form>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>

    </div>
  </div>
</div>
