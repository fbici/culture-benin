@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 text-warning">
                <i class="bi bi-shield-exclamation me-2"></i>Sécurité Requise
            </h3>
        </div>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-warning">
            <div class="card-header bg-warning text-dark py-3">
                <h5 class="m-0 fw-bold">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>Authentification à Deux Facteurs Obligatoire
                </h5>
            </div>
            
            <div class="card-body text-center py-5">
                <i class="bi bi-shield-lock display-1 text-warning mb-4"></i>
                
                <h3 class="text-warning mb-3">Sécurité Renforcée Requise</h3>
                
                <p class="lead mb-4">
                    Pour accéder à l'administration, vous devez activer l'authentification à deux facteurs (2FA) 
                    pour protéger votre compte et les données sensibles.
                </p>

                <div class="alert alert-info text-start mb-4">
                    <h6 class="alert-heading"><i class="bi bi-info-circle me-2"></i>Pourquoi la 2FA est obligatoire ?</h6>
                    <ul class="mb-0">
                        <li>Protection contre les accès non autorisés</li>
                        <li>Sécurisation des données culturelles sensibles</li>
                        <li>Conformité aux standards de sécurité</li>
                    </ul>
                </div>

                <div class="d-grid gap-2 col-md-6 mx-auto">
                    <a href="{{ route('admin.2fa.show') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-shield-check me-2"></i>Activer la 2FA Maintenant
                    </a>
                    
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary">
                            <i class="bi bi-box-arrow-left me-2"></i>Se Déconnecter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection