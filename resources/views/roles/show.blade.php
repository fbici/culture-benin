@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Détails du Rôle</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}">Rôles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

<style>
    /* Votre style info-card est réutilisé ici */
    .info-card {
        border-radius: 12px;
        padding: 22px;
        background: #f8f9fa;
        border: 1px solid #e3e3e3;
        margin-bottom: 25px;
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-6">

        <div class="card">
            <div class="card-header card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white mb-0">
                        <i class="bi bi-info-circle me-2"></i>Détails du Rôle
                    </h3>
                    <span class="badge bg-light text-dark">
                        ID: {{ $role->id_role }}
                    </span>
                </div>
            </div>
            
            <div class="card-body">

                <div class="text-center mb-4">
                    <div class="display-4 text-primary mb-2">
                        <i class="bi bi-person-badge-fill"></i>
                    </div>

                    <h2>{{ $role->nom_role }}</h2>
                </div>

                <div class="info-card">
                    <h5 class="text-primary mb-3">
                        <i class="bi bi-info-circle me-2"></i>Informations Générales
                    </h5>
                    
                    <p class="mb-2">
                        <strong>Nom du Rôle :</strong>
                        <span class="ms-2 fw-semibold">{{ $role->nom_role }}</span>
                    </p>

                    <p class="mb-2">
                        <strong>Identifiant :</strong>
                        <span class="ms-2 text-muted">{{ $role->id_role }}</span>
                    </p>
                </div>

                <div class="info-card">
                    <h5 class="text-primary mb-3">
                        <i class="bi bi-clock me-2"></i>Historique
                    </h5>

                    <p class="mb-2">
                        <strong>Créé le :</strong>
                        <span class="ms-2 text-muted">
                            {{ $role->created_at->format('d/m/Y H:i') }}
                        </span>
                    </p>

                    <p class="mb-2">
                        <strong>Modifié le :</strong>
                        <span class="ms-2 text-muted">
                            {{ $role->updated_at->format('d/m/Y H:i') }}
                        </span>
                    </p>
                </div>
                
                @if($role->utilisateurs()->count() > 0)
                <div class="alert alert-warning border-0 mb-4">
                    <i class="bi bi-people-fill me-2"></i>
                    Ce rôle est attribué à **{{ $role->utilisateurs()->count() }}** utilisateur(s).
                </div>
                @endif


                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                    <a href="{{ route('admin.roles.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Retour
                    </a>

                    <div class="btn-group">
                        <a href="{{ route('admin.roles.edit', $role->id_role) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Modifier
                        </a>

                        <a href="{{ route('admin.roles.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle me-2"></i>Nouveau Rôle
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection