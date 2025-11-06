    <!-- Modal de confirmation Terminer -->
    <div class="modal fade" id="terminerModal{{ $attribution->id }}" tabindex="-1" aria-labelledby="terminerModalLabel{{ $attribution->id }}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header bg-warning text-dark">
            <h5 class="modal-title text-dark" id="terminerModalLabel{{ $attribution->id }}">Confirmer la fin de l'attribution</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
            Êtes-vous sûr de vouloir mettre un terme à cette attribution ?  <br> <p class="mt-2 fw-semibold ">Le bien sera disponible immédiatement.</p>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
            <form action="{{ route('admin.attributions.terminer', $attribution->id) }}" method="POST" class="d-inline">
                @csrf
                @method('PATCH')
                <button class="btn btn-warning">Confirmer</button>
            </form>
            </div>
        </div>
        </div>
    </div>

    <!-- Modal Relancer -->
    <div class="modal fade" id="relancerModal{{ $attribution->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content rounded-4 shadow">
                <div class="modal-header bg-success text-white">
                    <h5 class="modal-title">Relancer l'attribution</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form class="relancer-form" data-attribution-id="{{ $attribution->id }}" action="{{ route('admin.attributions.relancer', $attribution->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="mb-3">
                            <label>Date début</label>
                            <input type="date" name="date_debut" class="form-control" required min="{{ now()->toDateString() }}">
                        </div>
                        <div class="mb-3">
                            <label>Date fin</label>
                            <input type="date" name="date_fin" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success">Relancer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>