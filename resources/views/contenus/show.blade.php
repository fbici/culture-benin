@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green"><i class="bi bi-info-circle-fill me-2"></i>Détails du Contenu</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.contenus.index') }}">Contenus</a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

<style>
    .info-card {
        border-radius: 8px;
        padding: 15px;
        background: #f8f9fa;
        border: 1px solid #e3e3e3;
        margin-bottom: 15px;
    }
    .info-label {
        color: #6c757d; 
        font-weight: 500;
        min-width: 120px;
        display: inline-block;
    }
    .content-card {
        border-left: 5px solid var(--bs-primary);
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-10">

        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white mb-0">
                        <i class="bi bi-file-earmark-text me-2"></i>Contenu : **{{ Str::limit($contenu->titre, 60) }}**
                    </h3>
                    <span class="badge bg-light text-dark">ID: {{ $contenu->id_contenu }}</span>
                </div>
            </div>
            
            <div class="card-body p-4">

                <div class="text-center mb-4 border-bottom pb-3">
                    <h1 class="text-primary mb-2">
                        <i class="bi bi-book-half"></i>
                    </h1>
                    <h2 class="h4">{{ $contenu->titre }}</h2>
                    @php
                        $statusInfo = $statuts[$contenu->statut] ?? $statuts['brouillon'];
                    @endphp
                    <span class="badge fs-6 {{ $statusInfo['badge'] }}">{{ $statusInfo['label'] }}</span>
                </div>

                <div class="row">
                    
                    <div class="col-md-6">
                        <h5 class="text-primary mb-3"><i class="bi bi-tag-fill me-2"></i>Classification</h5>

                        <div class="info-card">
                            <p class="mb-2">
                                <span class="info-label"><i class="bi bi-folder-fill me-1"></i> Type :</span>
                                <strong>{{ $contenu->typeContenu->nom ?? 'Non défini' }}</strong>
                            </p>
                            <p class="mb-2">
                                <span class="info-label"><i class="bi bi-geo-alt-fill me-1"></i> Région :</span>
                                {{ $contenu->region->nom_region ?? 'N/A' }}
                            </p>
                            <p class="mb-0">
                                <span class="info-label"><i class="bi bi-translate me-1"></i> Langue :</span>
                                {{ $contenu->langue->nom_langue ?? 'N/A' }}
                            </p>
                        </div>
                        
                        <h5 class="text-primary mb-3 mt-4"><i class="bi bi-people-fill me-2"></i>Auteurs & Workflow</h5>
                        
                        <div class="info-card">
                            <p class="mb-2">
                                <span class="info-label"><i class="bi bi-person-fill me-1"></i> Auteur :</span>
                                **{{ $contenu->auteur->nom_complet ?? 'Inconnu' }}**
                            </p>
                            <p class="mb-0">
                                <span class="info-label"><i class="bi bi-shield-fill me-1"></i> Modérateur :</span>
                                @if($contenu->moderateur)
                                    <span class="text-success">{{ $contenu->moderateur->nom_complet }}</span>
                                @else
                                    <span class="text-muted">En attente / Non modéré</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-primary mb-3"><i class="bi bi-clock-fill me-2"></i>Horodatages</h5>

                        <div class="info-card">
                            <p class="mb-2">
                                <span class="info-label"><i class="bi bi-calendar-plus me-1"></i> Créé le :</span>
                                {{ $contenu->date_creation?->format('d/m/Y') }} ({{ $contenu->created_at->format('H:i') }})
                            </p>
                            <p class="mb-2">
                                <span class="info-label"><i class="bi bi-arrow-repeat me-1"></i> Dernière MAJ :</span>
                                {{ $contenu->updated_at->format('d/m/Y H:i') }}
                            </p>
                            <p class="mb-0">
                                <span class="info-label"><i class="bi bi-check-circle-fill me-1"></i> Validé le :</span>
                                @if($contenu->date_validation)
                                    <strong class="text-success">{{ $contenu->date_validation->format('d/m/Y H:i') }}</strong>
                                @else
                                    <span class="text-muted fst-italic">Non validé</span>
                                @endif
                            </p>
                        </div>
                        
                        <h5 class="text-primary mb-3 mt-4"><i class="bi bi-diagram-3-fill me-2"></i>Hiérarchie</h5>
                        
                        <div class="info-card">
                            <p class="mb-2">
                                <span class="info-label"><i class="bi bi-box-arrow-in-up-right me-1"></i> Parent :</span>
                                @if($contenu->parent)
                                    <a href="{{ route('admin.contenus.show', $contenu->parent->id_contenu) }}" class="text-decoration-none">
                                        **{{ Str::limit($contenu->parent->titre, 30) }}**
                                    </a>
                                @else
                                    <span class="text-muted">Contenu principal</span>
                                @endif
                            </p>
                            <p class="mb-0">
                                <span class="info-label"><i class="bi bi-box-arrow-in-down-right me-1"></i> Enfants :</span>
                                <span class="badge bg-info">{{ $contenu->enfants->count() }}</span> éléments liés.
                            </p>
                        </div>
                    </div>
                </div>

                <h5 class="text-primary mt-4 mb-3"><i class="bi bi-justify-left me-2"></i>Corps du Contenu</h5>
                <div class="p-3 bg-light content-card mb-4 border rounded">
                    <div class="text-muted">
                        {{ Str::limit($contenu->texte, 500) }} 
                    </div>
                    @if (strlen($contenu->texte) > 500)
                        <small class="d-block mt-2 text-muted fst-italic">... Contenu tronqué pour l'affichage des détails. Voir le contenu complet dans le front-end ou la base de données.</small>
                    @endif
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-4">
                    
                    <a href="{{ route('admin.contenus.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Retour à la Liste
                    </a>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.contenus.edit', $contenu->id_contenu) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Modifier
                        </a>

                        <a href="{{ route('admin.contenus.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Créer Nouveau
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection