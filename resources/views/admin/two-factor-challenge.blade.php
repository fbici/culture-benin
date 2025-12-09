@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 text-warning">
                <i class="bi bi-shield-lock me-2"></i>Vérification de Sécurité
            </h3>
        </div>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow border-warning">
            <div class="card-header bg-warning text-dark py-3">
                <h5 class="m-0 fw-bold text-center">
                    <i class="bi bi-shield-check me-2"></i>Authentification à Deux Facteurs
                </h5>
            </div>
            
            <div class="card-body py-4">
                <div class="text-center mb-4">
                    <i class="bi bi-phone display-1 text-warning mb-3"></i>
                    <h4 class="text-warning">Vérification Requise</h4>
                    <p class="text-muted">
                        Pour accéder à l'administration, veuillez saisir le code de vérification 
                        généré par votre application d'authentification.
                    </p>
                </div>

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.2fa.verify') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="code" class="form-label fw-bold">
                            <i class="bi bi-key me-1"></i>Code de vérification à 6 chiffres
                        </label>
                        <input type="text" 
                               class="form-control form-control-lg text-center @error('code') is-invalid @enderror" 
                               id="code" 
                               name="code" 
                               placeholder="000000" 
                               maxlength="6"
                               pattern="[0-9]{6}"
                               required
                               autofocus>
                        @error('code')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">
                            Ouvrez votre application d'authentification (Google Authenticator, Authy, etc.) 
                            et entrez le code à 6 chiffres affiché.
                        </small>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning btn-lg">
                            <i class="bi bi-shield-check me-2"></i>Vérifier et Continuer
                        </button>
                    </div>
                </form>

                <hr class="my-4">

                <div class="text-center">
                    <p class="text-muted small mb-2">
                        Vous avez perdu votre appareil d'authentification ?
                    </p>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#recoveryModal">
                        <i class="bi bi-key me-1"></i>Utiliser un code de récupération
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Codes de Récupération -->
<div class="modal fade" id="recoveryModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Code de Récupération</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('admin.2fa.verify') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="recovery_code" class="form-label">Entrez un code de récupération</label>
                        <input type="text" class="form-control" id="recovery_code" name="code" required>
                        <small class="text-muted">
                            Utilisez l'un des codes de récupération que vous avez sauvegardés.
                        </small>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning">Utiliser ce code</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const codeInput = document.getElementById('code');
    
    // Auto-soumettre quand 6 chiffres saisis
    codeInput.addEventListener('input', function() {
        if (this.value.length === 6) {
            this.form.submit();
        }
    });
    
    // Focus automatique
    codeInput.focus();
});
</script>
@endpush