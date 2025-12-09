@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Détails du Type de Média</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.type_medias.index') }}">Types Médias</a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

<style>
    /* Style réutilisé pour l'info-card */
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
    <div class="col-lg-8">

        <div class="card">
            <div class="card-header card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white mb-0">
                        <i class="bi bi-info-circle me-2"></i>Détails du Type de Média
                    </h3>
                    <span class="badge bg-light text-dark">
                        ID: {{ $typeMedia->id_type }}
                    </span>
                </div>
            </div>
            
            <div class="card-body">

                <div class="text-center mb-4 border-bottom pb-3">
                    <div class="display-4 text-primary mb-2">
                        <i class="bi bi-file-earmark-bar-graph-fill"></i>
                    </div>

                    <h2>{{ $typeMedia->nom }}</h2>
                    <p class="text-muted fst-italic">Informations de base pour le type de média.</p>
                </div>

                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="info-card">
                            <h5 class="text-primary mb-3">
                                <i class="bi bi-tag-fill me-2"></i>Identification
                            </h5>

                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-folder-symlink-fill me-1"></i> Nom :</span>
                                <span class="ms-2 fw-semibold">{{ $typeMedia->nom }}</span>
                            </p>
                            <p class="mb-0">
                                <span class="icon-label"><i class="bi bi-key-fill me-1"></i> Clé Primaire :</span>
                                <span class="ms-2 text-muted fst-italic">{{ $typeMedia->id_type }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-card">
                            <h5 class="text-primary mb-3">
                                <i class="bi bi-clock me-2"></i>Horodatages
                            </h5>

                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-calendar-plus me-1"></i> Créé le :</span>
                                <span class="ms-2 text-muted">
                                    {{ $typeMedia->created_at->format('d/m/Y H:i') }}
                                </span>
                            </p>
                            <p class="mb-0">
                                <span class="icon-label"><i class="bi bi-arrow-repeat me-1"></i> Modifié le :</span>
                                <span class="ms-2 text-muted">
                                    {{ $typeMedia->updated_at->format('d/m/Y H:i') }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                    
                    <a href="{{ route('admin.type_medias.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Retour à la Liste
                    </a>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.type_medias.edit', $typeMedia->id_type) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Modifier
                        </a>

                        <a href="{{ route('admin.type_medias.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Nouveau Type
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection