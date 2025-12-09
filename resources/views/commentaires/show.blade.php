@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green"><i class="bi bi-info-circle-fill me-2"></i>Détails du Commentaire</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.commentaires.index') }}">Commentaires</a></li>
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
        min-width: 150px;
        display: inline-block;
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white mb-0">
                        <i class="bi bi-chat-dots me-2"></i>Commentaire ID: **{{ $commentaire->id_commentaire }}**
                    </h3>
                    <span class="badge bg-light text-dark">
                        Note: 
                        @for ($i = 1; $i <= 5; $i++)
                            @if ($i <= $commentaire->note)
                                <i class="bi bi-star-fill text-warning"></i>
                            @else
                                <i class="bi bi-star text-muted"></i>
                            @endif
                        @endfor
                    </span>
                </div>
            </div>
            
            <div class="card-body p-4">

                <div class="text-center mb-4 border-bottom pb-3">
                    <h1 class="text-primary mb-2">
                        <i class="bi bi-chat-left-text-fill display-4"></i>
                    </h1>
                    <h2 class="h4">{{ Str::limit($commentaire->texte, 80) }}</h2>
                    <p class="text-muted">Par **{{ $commentaire->utilisateur->nom_complet ?? 'Auteur inconnu' }}**</p>
                </div>

                <h5 class="text-primary mb-3"><i class="bi bi-link-45deg me-2"></i>Relations</h5>
                <div class="info-card">
                    <p class="mb-2">
                        <span class="info-label"><i class="bi bi-person-fill me-1"></i> Auteur du Commentaire :</span>
                        @if($commentaire->utilisateur)
                            <a href="#" class="text-decoration-none">
                                **{{ $commentaire->utilisateur->nom_complet }}** (ID: {{ $commentaire->id_utilisateur }})
                            </a>
                        @else
                            <span class="text-danger">Utilisateur supprimé (ID: {{ $commentaire->id_utilisateur }})</span>
                        @endif
                    </p>
                    <p class="mb-0">
                        <span class="info-label"><i class="bi bi-file-earmark-text-fill me-1"></i> Contenu Commenté :</span>
                        @if($commentaire->contenu)
                            <a href="{{ route('admin.contenus.show', $commentaire->contenu->id_contenu) }}" class="text-decoration-none">
                                **{{ Str::limit($commentaire->contenu->titre, 40) }}** (ID: {{ $commentaire->id_contenu }})
                            </a>
                        @else
                            <span class="text-danger">Contenu supprimé (ID: {{ $commentaire->id_contenu }})</span>
                        @endif
                    </p>
                </div>

                <h5 class="text-primary mt-4 mb-3"><i class="bi bi-clock-fill me-2"></i>Horodatages</h5>
                <div class="info-card">
                    <p class="mb-2">
                        <span class="info-label"><i class="bi bi-calendar-check me-1"></i> Date de Publication :</span>
                        **{{ $commentaire->date->format('d/m/Y H:i') }}**
                    </p>
                    <p class="mb-0">
                        <span class="info-label"><i class="bi bi-arrow-repeat me-1"></i> Dernière Mise à Jour :</span>
                        {{ $commentaire->updated_at->format('d/m/Y H:i') }}
                    </p>
                </div>
                
                <h5 class="text-primary mt-4 mb-3"><i class="bi bi-chat-square-text-fill me-2"></i>Texte Intégral</h5>
                <div class="p-3 bg-light border rounded mb-4">
                    <p class="mb-0">{{ $commentaire->texte }}</p>
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-4">
                    
                    <a href="{{ route('admin.commentaires.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Retour à la Liste
                    </a>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.commentaires.edit', $commentaire->id_commentaire) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Modifier
                        </a>

                        <a href="{{ route('admin.commentaires.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Ajouter Nouveau
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection