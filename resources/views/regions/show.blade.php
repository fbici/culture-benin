@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Détails de la Région</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.regions.index') }}">Régions</a></li>
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
        color: #6c757d; /* Gris pour les icônes de label */
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-10">

        <div class="card">
            <div class="card-header card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white mb-0">
                        <i class="bi bi-info-circle me-2"></i>Détails de la Région
                    </h3>
                    <span class="badge bg-light text-dark">
                        ID: {{ $region->id_region }}
                    </span>
                </div>
            </div>
            
            <div class="card-body">

                <div class="text-center mb-4">
                    <div class="display-4 text-primary mb-2">
                        <i class="bi bi-geo-alt-fill"></i>
                    </div>

                    <h2>{{ $region->nom_region }}</h2>
                </div>

                <div class="row mb-4">
                    
                    <div class="col-md-6">
                        <div class="info-card">
                            <h5 class="text-primary mb-3">
                                <i class="bi bi-info-circle me-2"></i>Informations Générales
                            </h5>

                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-tag-fill me-1"></i> Nom :</span>
                                <span class="ms-2 fw-semibold">{{ $region->nom_region }}</span>
                            </p>
                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-person-fill me-1"></i> Population :</span>
                                <span class="ms-2">
                                    @if($region->population)
                                        <span class="fw-semibold text-dark">{{ number_format($region->population, 0, ',', ' ') }}</span> habitants
                                    @else
                                        <span class="text-muted fst-italic">Non spécifié</span>
                                    @endif
                                </span>
                            </p>
                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-clock me-1"></i> Créé le :</span>
                                <span class="ms-2 text-muted">
                                    {{ $region->created_at->format('d/m/Y H:i') }}
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-card">
                            <h5 class="text-primary mb-3">
                                <i class="bi bi-globe-americas me-2"></i>Données Géographiques
                            </h5>
                            
                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-rulers me-1"></i> Superficie :</span>
                                <span class="ms-2">
                                    @if($region->superficie)
                                        <span class="fw-semibold text-dark">{{ number_format($region->superficie, 2, ',', ' ') }}</span> km²
                                    @else
                                        <span class="text-muted fst-italic">Non spécifiée</span>
                                    @endif
                                </span>
                            </p>
                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-compass-fill me-1"></i> Localisation :</span>
                                <span class="ms-2 text-wrap">
                                    @if($region->localisation)
                                        {{ $region->localisation }}
                                    @else
                                        <span class="text-muted fst-italic">Non spécifiée</span>
                                    @endif
                                </span>
                            </p>
                            <p class="mb-2">
                                <span class="icon-label"><i class="bi bi-arrow-repeat me-1"></i> Modifié le :</span>
                                <span class="ms-2 text-muted">
                                    {{ $region->updated_at->format('d/m/Y H:i') }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <h5 class="text-primary mb-3">
                        <i class="bi bi-card-text me-2"></i>Description Détaillée
                    </h5>

                    @if($region->description)
                        <p class="ms-1">{{ $region->description }}</p>
                    @else
                        <p class="text-muted fst-italic ms-1">Aucune description disponible pour cette région.</p>
                    @endif
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                    <a href="{{ route('admin.regions.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Retour à la Liste
                    </a>

                    <div class="btn-group">
                        <a href="{{ route('admin.regions.edit', $region->id_region) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Modifier
                        </a>

                        <a href="{{ route('admin.regions.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Nouvelle Région
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection