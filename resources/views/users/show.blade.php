@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Détails de l'Utilisateur</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Utilisateurs</a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

<style>
    .info-card {
        border-radius: 12px;
        padding: 22px;
        background: #f8f9fa;
        border: 1px solid #e3e3e3;
        margin-bottom: 25px;
    }
    .info-card .icon-label {
        color: #6c757d; 
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-10">

        <div class="card">
            <div class="card-header card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white mb-0">
                        <i class="bi bi-person-circle me-2"></i>Profil Utilisateur
                    </h3>
                    <span class="badge bg-light text-dark">
                        ID: {{ $user->id_utilisateur }}
                    </span>
                </div>
            </div>
            
            <div class="card-body">

                <div class="text-center mb-4 border-bottom pb-3">
                    <div class="display-4 text-primary mb-2">
                        <i class="bi bi-person-square"></i>
                    </div>
                    <h2>{{ $user->nom_complet }}</h2>
                    <p class="text-muted mb-0">{{ $user->email }}</p>
                </div>

                <div class="row mb-4">
                    
                    <div class="col-md-6">
                        <div class="info-card">
                            <h5 class="text-primary mb-3">
                                <i class="bi bi-person-vcard me-2"></i>Détails Personnels
                            </h5>

                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-person-badge-fill me-1"></i> Nom :</span>
                                <span class="ms-2 fw-semibold">{{ $user->nom }}</span>
                            </p>
                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-person-badge me-1"></i> Prénom :</span>
                                <span class="ms-2 fw-semibold">{{ $user->prenom }}</span>
                            </p>
                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-gender-ambiguous me-1"></i> Sexe :</span>
                                <span class="ms-2">
                                    {{ $user->sexe === 'M' ? 'Masculin' : ($user->sexe === 'F' ? 'Féminin' : 'Autre') }}
                                </span>
                            </p>
                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-calendar-heart me-1"></i> Né(e) le :</span>
                                <span class="ms-2">
                                    {{ $user->date_naissance ? $user->date_naissance->format('d/m/Y') : 'Non spécifiée' }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-card">
                            <h5 class="text-primary mb-3">
                                <i class="bi bi-gear-fill me-2"></i>Permissions et Statut
                            </h5>
                            
                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-shield-fill me-1"></i> Rôle :</span>
                                <span class="ms-2 badge bg-secondary">{{ $user->role->nom_role ?? 'N/A' }}</span>
                            </p>
                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-translate me-1"></i> Langue Préf. :</span>
                                <span class="ms-2">{{ $user->langue->nom_langue ?? 'N/A' }}</span>
                            </p>
                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-activity me-1"></i> Statut :</span>
                                @php
                                    $badgeClass = match($user->statut) {
                                        'actif' => 'bg-success',
                                        'inactif' => 'bg-warning text-dark',
                                        'suspendu' => 'bg-danger',
                                        default => 'bg-secondary'
                                    };
                                @endphp
                                <span class="ms-2 badge {{ $badgeClass }}">{{ ucfirst($user->statut) }}</span>
                            </p>
                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-calendar-check me-1"></i> Inscrit le :</span>
                                <span class="ms-2 text-muted">
                                    {{ $user->date_inscription ? $user->date_inscription->format('d/m/Y H:i') : $user->created_at->format('d/m/Y H:i') }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Retour à la Liste
                    </a>

                    <div class="btn-group">
                        <a href="{{ route('admin.users.edit', $user->id_utilisateur) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Modifier
                        </a>

                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">
                            <i class="bi bi-person-add me-2"></i>Nouvel Utilisateur
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection