@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 text-primary">
                <i class="bi bi-shield-lock me-2"></i>Authentification à Deux Facteurs
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Tableau de Bord</a></li>
                <li class="breadcrumb-item active" aria-current="page">2FA</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-primary">
                    <i class="bi bi-phone me-2"></i>Configuration de l'Authentification à Deux Facteurs
                </h5>
            </div>
            
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ $errors->first() }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                @if(!$user->two_factor_confirmed_at)
                    <!-- Étape 1 : Configuration avec QR Code -->
                    <div class="alert alert-info">
                        <h6 class="alert-heading"><i class="bi bi-info-circle me-2"></i>Configuration requise</h6>
                        <p class="mb-0">
                            Scannez le QR Code ci-dessous avec votre application d'authentification (Google Authenticator, Authy, etc.)
                        </p>
                    </div>

                    <div class="text-center mb-4">
                        @if($qrCode)
                            <img src="{{ $qrCode }}" alt="QR Code pour l'authentification à deux facteurs" class="img-fluid border rounded" style="max-width: 200px;">
                        @endif
                    </div>

                    <div class="mb-4">
                        <h6>Code secret (manuel) :</h6>
                        <div class="input-group">
                            <input type="text" class="form-control font-monospace" value="{{ $user->two_factor_secret ?? 'Génération...' }}" readonly id="secretKey">
                            <button class="btn btn-outline-secondary" type="button" onclick="copySecretKey()">
                                <i class="bi bi-clipboard"></i>
                            </button>
                        </div>
                        <small class="text-muted">Utilisez ce code si vous ne pouvez pas scanner le QR Code</small>
                    </div>

                    <!-- Formulaire de confirmation -->
                    <form method="POST" action="{{ route('admin.2fa.confirm') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="code" class="form-label fw-bold">
                                <i class="bi bi-key me-1"></i>Entrez le code de vérification
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg text-center @error('code') is-invalid @enderror" 
                                   id="code" 
                                   name="code" 
                                   placeholder="000000" 
                                   maxlength="6"
                                   required>
                            @error('code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="text-muted">
                                Entrez le code à 6 chiffres généré par votre application d'authentification
                            </small>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-shield-check me-2"></i>Activer l'Authentification à Deux Facteurs
                            </button>
                        </div>
                    </form>

                @else
                    <!-- Étape 2 : 2FA déjà activée -->
                    <div class="alert alert-success">
                        <h6 class="alert-heading"><i class="bi bi-shield-check me-2"></i>Authentification à deux facteurs activée</h6>
                        <p class="mb-0">
                            Votre compte est maintenant protégé par l'authentification à deux facteurs.
                        </p>
                    </div>

                    <!-- Codes de récupération -->
                    <div class="mb-4">
                        <h6 class="fw-bold text-danger">
                            <i class="bi bi-exclamation-triangle me-1"></i>Codes de Récupération
                        </h6>
                        <p class="text-muted">
                            Conservez ces codes de récupération en lieu sûr. Ils vous permettront d'accéder à votre compte si vous perdez votre appareil d'authentification.
                        </p>
                        
                        @if($user->two_factor_recovery_codes)
                            <div class="bg-light p-3 rounded">
                                <div class="row">
                                    @foreach(json_decode($user->two_factor_recovery_codes) as $code)
                                        <div class="col-md-6 mb-2">
                                            <code class="font-monospace">{{ $code }}</code>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('admin.2fa.generate-codes') }}" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-outline-warning btn-sm">
                                <i class="bi bi-arrow-repeat me-1"></i>Générer de nouveaux codes
                            </button>
                        </form>
                    </div>

                    <!-- Désactivation -->
                    <div class="border-top pt-3">
                        <h6 class="fw-bold text-muted">Désactivation</h6>
                        <p class="text-muted small">
                            Vous pouvez désactiver l'authentification à deux facteurs si nécessaire.
                        </p>
                        <form method="POST" action="{{ route('admin.2fa.destroy') }}" onsubmit="return confirm('Êtes-vous sûr de vouloir désactiver l\\'authentification à deux facteurs ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">
                                <i class="bi bi-shield-x me-1"></i>Désactiver la 2FA
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- Information sur les applications d'authentification -->
        <div class="card shadow mt-4">
            <div class="card-header bg-white py-3">
                <h6 class="m-0 fw-bold text-primary">
                    <i class="bi bi-question-circle me-2"></i>Applications Recommandées
                </h6>
            </div>
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-4 mb-3">
                        <i class="bi bi-phone fs-1 text-primary"></i>
                        <h6>Google Authenticator</h6>
                        <small class="text-muted">Disponible sur iOS et Android</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <i class="bi bi-shield-check fs-1 text-success"></i>
                        <h6>Authy</h6>
                        <small class="text-muted">Multi-appareils, sauvegarde cloud</small>
                    </div>
                    <div class="col-md-4 mb-3">
                        <i class="bi bi-microsoft fs-1 text-info"></i>
                        <h6>Microsoft Authenticator</h6>
                        <small class="text-muted">Intégration Microsoft</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function copySecretKey() {
    const secretKey = document.getElementById('secretKey');
    secretKey.select();
    secretKey.setSelectionRange(0, 99999);
    document.execCommand('copy');
    
    // Afficher un message temporaire
    const button = event.target;
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="bi bi-check"></i>';
    button.classList.remove('btn-outline-secondary');
    button.classList.add('btn-success');
    
    setTimeout(() => {
        button.innerHTML = originalText;
        button.classList.remove('btn-success');
        button.classList.add('btn-outline-secondary');
    }, 2000);
}

// Auto-focus sur le champ code
@if(!$user->two_factor_confirmed_at)
    document.getElementById('code').focus();
@endif
</script>
@endpush