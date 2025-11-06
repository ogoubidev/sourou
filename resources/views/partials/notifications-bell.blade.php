@auth
<div class="dropdown">
    <!-- Icône cloche -->
    <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-bell" style="font-size: 1.4rem;"></i>
        @if(auth()->user()->unreadNotifications->count() > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ auth()->user()->unreadNotifications->count() }}
            </span>
        @endif
    </a>

    <!-- Dropdown menu -->
    <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="notificationsDropdown" style="width: 320px; max-height: 420px; overflow-y:auto;">
        
        <!-- Header -->
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

        <!-- Les 5 dernières notifications -->
        @forelse(auth()->user()->notifications->take(5) as $notification)
            @php
                $openUrl = route('notifications.open', $notification->id);
                $type = $notification->data['type'] ?? 'info'; // type perso

                $icons = [
                    'loyer' => 'bi-cash-coin text-success',
                    'attribution_terminee' => 'bi-x-circle text-danger',
                    'attribution_relancee' => 'bi-arrow-repeat text-primary',
                    'nouvelle_attribution' => 'bi-house-door text-warning',
                    'depense' => 'bi-coin text-danger',
                    'info' => 'bi-info-circle text-muted'
                ];

            @endphp

            <a href="{{ $openUrl }}" class="dropdown-item d-flex align-items-start {{ $notification->read_at ? '' : 'fw-bold' }}">
                <div class="me-2 mt-1"><i class="bi {{ $icons[$type] ?? 'bi-info-circle' }}"></i></div>
                <div>
                    <div>{{ $notification->data['message'] ?? 'Notification' }}</div>
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
            </a>
            <div class="dropdown-divider"></div>
        @empty
            <div class="dropdown-item text-muted">Aucune notification</div>
        @endforelse

        <!-- Bouton voir plus si +5 -->
        @if(auth()->user()->notifications->count() > 5)
            <div class="text-center py-2">
                <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#allNotificationsModal">
                    Voir toutes les notifications
                </button>
            </div>
        @endif
    </div>
</div>

<!-- Modal toutes les notifications -->
<div class="modal fade" id="allNotificationsModal" tabindex="-1" aria-labelledby="allNotificationsLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-scrollable">
    <div class="modal-content rounded-4 shadow">
      
      <!-- Header -->
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title" id="allNotificationsLabel">Toutes vos notifications</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      
      <!-- Body -->
      <div class="modal-body p-0">
        <div class="list-group list-group-flush">
            @forelse(auth()->user()->notifications as $notification)
                @php
                    $openUrl = route('notifications.open', $notification->id);
                    $type = $notification->data['type'] ?? 'info';
                    $icons = [
                        'loyer' => 'bi-cash-coin text-success',
                        'attribution_terminee' => 'bi-x-circle text-danger',
                        'attribution_relancee' => 'bi-arrow-repeat text-primary',
                        'nouvelle_attribution' => 'bi-house-door text-warning',
                        'info' => 'bi-info-circle text-muted'
                    ];
                @endphp
                <a href="{{ $openUrl }}" 
                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-start {{ $notification->read_at ? '' : 'fw-bold bg-light' }}">
                    <div class="me-2"><i class="bi {{ $icons[$type] ?? 'bi-info-circle' }}"></i></div>
                    <div class="flex-grow-1">
                        <div>{{ $notification->data['message'] ?? 'Notification' }}</div>
                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                    </div>
                    <i class="bi bi-chevron-right text-muted"></i>
                </a>
            @empty
                <div class="text-center text-muted py-3">
                    Aucune notification
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
@endauth
