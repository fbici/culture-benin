@extends('layouts.app')

@section('title', $media->titre . ' - Mes Médias - Culture Benin')

@section('content')
<div class="media-detail-container">
    <!-- Navigation -->
    <div class="media-navigation mb-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="{{ route('user.dashboard') }}" class="text-decoration-none">
                        <i class="bi bi-house-door me-1"></i>Dashboard
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{ route('user.medias.index') }}" class="text-decoration-none">
                        <i class="bi bi-images me-1"></i>Mes Médias
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    {{ Str::limit($media->titre, 30) }}
                </li>
            </ol>
        </nav>
    </div>

    <!-- En-tête -->
    <div class="media-header-card mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="media-title-main mb-3">
                    <i class="bi bi-file-earmark-text me-2"></i>
                    {{ $media->titre }}
                </h1>
                <div class="media-badges mb-3">
                    <span class="badge bg-warning text-dark me-2">
                        <i class="bi bi-tag me-1"></i>
                        {{ $media->typeMedia->nom ?? 'Non classé' }}
                    </span>
                    <span class="badge bg-info text-white me-2">
                        <i class="bi bi-calendar me-1"></i>
                        Ajouté le {{ $media->created_at->format('d/m/Y') }}
                    </span>
                    @if($media->is_premium)
                    <span class="badge bg-success text-white">
                        <i class="bi bi-star me-1"></i>
                        Premium
                    </span>
                    @endif
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="btn-group" role="group">
                    <a href="{{ route('user.medias.edit', $media->id_media) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i>Modifier
                    </a>
                    <a href="{{ route('user.medias.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8">
            <!-- Aperçu du média -->
            <div class="media-preview-card mb-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="bi bi-eye me-2"></i>
                            Aperçu du média
                        </h5>
                    </div>
                    <div class="card-body text-center">
                        @if($media->typeMedia && $media->typeMedia->nom == 'Image')
                            @if($media->Chemin && file_exists(public_path('storage/' . $media->Chemin)))
                            <img src="{{ asset('storage/' . $media->Chemin) }}" 
                                 alt="{{ $media->titre }}" 
                                 class="img-fluid rounded"
                                 style="max-height: 500px;">
                            @else
                            <div class="alert alert-warning">
                                <i class="bi bi-exclamation-triangle me-2"></i>
                                L'image n'est pas disponible
                            </div>
                            @endif
                        @else
                        <div class="media-placeholder-large">
                            <div class="placeholder-icon">
                                <i class="bi bi-{{ $media->typeMedia->nom == 'Vidéo' ? 'play-btn' : 'file-earmark' }}"></i>
                            </div>
                            <h4 class="mt-3">{{ $media->typeMedia->nom ?? 'Document' }}</h4>
                            <p class="text-muted">Ce type de média nécessite un téléchargement</p>
                            <a href="{{ asset('storage/' . $media->Chemin) }}" 
                               class="btn btn-primary"
                               download>
                                <i class="bi bi-download me-2"></i>
                                Télécharger
                            </a>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informations détaillées -->
            <div class="media-info-card mb-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="bi bi-info-circle me-2"></i>
                            Informations détaillées
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <label class="text-muted">Titre</label>
                                    <p class="fw-bold">{{ $media->titre }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="text-muted">Type de média</label>
                                    <p class="fw-bold">{{ $media->typeMedia->nom ?? 'Non spécifié' }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="text-muted">Date d'ajout</label>
                                    <p class="fw-bold">{{ $media->created_at->format('d/m/Y à H:i') }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-item mb-3">
                                    <label class="text-muted">Statut</label>
                                    <p class="fw-bold">
                                        @if($media->statut == 'actif')
                                        <span class="badge bg-success">Actif</span>
                                        @else
                                        <span class="badge bg-warning">{{ ucfirst($media->statut) }}</span>
                                        @endif
                                    </p>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="text-muted">Téléchargements</label>
                                    <p class="fw-bold">{{ $media->downloads ?? 0 }}</p>
                                </div>
                                <div class="info-item mb-3">
                                    <label class="text-muted">Format</label>
                                    <p class="fw-bold">{{ strtoupper($media->extension) ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="info-item mb-3">
                            <label class="text-muted">Description</label>
                            <div class="description-content p-3 bg-light rounded">
                                {!! nl2br(e($media->description)) !!}
                            </div>
                        </div>

                        <!-- Métadonnées techniques -->
                        @if($media->largeur || $media->hauteur || $media->taille_fichier)
                        <div class="info-item">
                            <label class="text-muted">Métadonnées techniques</label>
                            <div class="row">
                                @if($media->largeur && $media->hauteur)
                                <div class="col-md-4">
                                    <div class="tech-info">
                                        <small class="text-muted">Résolution</small>
                                        <p class="fw-bold">{{ $media->largeur }} × {{ $media->hauteur }}</p>
                                    </div>
                                </div>
                                @endif
                                @if($media->taille_fichier)
                                <div class="col-md-4">
                                    <div class="tech-info">
                                        <small class="text-muted">Taille du fichier</small>
                                        <p class="fw-bold">
                                            @php
                                                $size = $media->taille_fichier;
                                                $units = ['B', 'KB', 'MB', 'GB'];
                                                $i = 0;
                                                while ($size >= 1024 && $i < count($units) - 1) {
                                                    $size /= 1024;
                                                    $i++;
                                                }
                                                echo round($size, 2) . ' ' . $units[$i];
                                            @endphp
                                        </p>
                                    </div>
                                </div>
                                @endif
                                @if($media->mime_type)
                                <div class="col-md-4">
                                    <div class="tech-info">
                                        <small class="text-muted">Type MIME</small>
                                        <p class="fw-bold">{{ $media->mime_type }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Actions rapides -->
            <div class="media-actions-card mb-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="bi bi-lightning me-2"></i>
                            Actions rapides
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ asset('storage/' . $media->Chemin) }}" 
                               class="btn btn-primary"
                               download>
                                <i class="bi bi-download me-2"></i>
                                Télécharger
                            </a>
                            <a href="{{ route('user.medias.edit', $media->id_media) }}" 
                               class="btn btn-warning">
                                <i class="bi bi-pencil me-2"></i>
                                Modifier
                            </a>
                            <button type="button" 
                                    class="btn btn-outline-danger" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal">
                                <i class="bi bi-trash me-2"></i>
                                Supprimer
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Informations de publication -->
            <div class="media-pub-info-card mb-4">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="bi bi-share me-2"></i>
                            Publication
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="pub-info-item mb-3">
                            <label class="text-muted">Statut de publication</label>
                            <p class="fw-bold">
                                @if($media->is_valide)
                                <span class="badge bg-success">Validé</span>
                                @else
                                <span class="badge bg-warning">En attente</span>
                                @endif
                            </p>
                        </div>
                        <div class="pub-info-item mb-3">
                            <label class="text-muted">Visibilité</label>
                            <p class="fw-bold">
                                @if($media->is_premium)
                                <span class="badge bg-success">Premium</span>
                                @else
                                <span class="badge bg-info">Public</span>
                                @endif
                            </p>
                        </div>
                        @if($media->is_premium && $media->prix)
                        <div class="pub-info-item">
                            <label class="text-muted">Prix</label>
                            <p class="fw-bold h4 text-success">
                                {{ number_format($media->prix, 0, ',', ' ') }} FCFA
                            </p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Informations légales -->
            @if($media->auteur_original || $media->copyright)
            <div class="media-legal-card">
                <div class="card">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">
                            <i class="bi bi-c-circle me-2"></i>
                            Informations légales
                        </h5>
                    </div>
                    <div class="card-body">
                        @if($media->auteur_original)
                        <div class="legal-info-item mb-3">
                            <label class="text-muted">Auteur original</label>
                            <p class="fw-bold">{{ $media->auteur_original }}</p>
                        </div>
                        @endif
                        @if($media->copyright)
                        <div class="legal-info-item">
                            <label class="text-muted">Copyright</label>
                            <p class="fw-bold">{{ $media->copyright }}</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirmer la suppression</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Êtes-vous sûr de vouloir supprimer ce média ?</p>
                <div class="alert alert-warning">
                    <i class="bi bi-exclamation-triangle me-2"></i>
                    Cette action est irréversible. Le fichier sera définitivement supprimé.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <form action="{{ route('user.medias.destroy', $media->id_media) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Supprimer définitivement</button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .media-detail-container {
        max-width: 1400px;
        margin: 100px auto 40px;
        padding: 0 2rem;
    }

    .media-header-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        border: 1px solid #e9ecef;
    }

    .media-title-main {
        font-size: 1.8rem;
        font-weight: 700;
        color: #1a1d21;
    }

    .media-preview-card .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .media-placeholder-large {
        padding: 3rem;
        text-align: center;
        background: #f8f9fa;
        border-radius: 10px;
    }

    .placeholder-icon {
        font-size: 4rem;
        color: #adb5bd;
        margin-bottom: 1rem;
    }

    .media-info-card .card,
    .media-actions-card .card,
    .media-pub-info-card .card,
    .media-legal-card .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .info-item label,
    .pub-info-item label,
    .legal-info-item label {
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        display: block;
    }

    .info-item p,
    .pub-info-item p,
    .legal-info-item p {
        margin: 0;
    }

    .description-content {
        min-height: 100px;
        white-space: pre-line;
    }

    .tech-info {
        padding: 0.75rem;
        background: #f8f9fa;
        border-radius: 8px;
        text-align: center;
    }

    .btn-group .btn {
        border-radius: 8px !important;
    }

    @media (max-width: 768px) {
        .media-detail-container {
            padding: 0 1rem;
            margin-top: 80px;
        }

        .media-header-card {
            padding: 1.5rem;
        }

        .media-title-main {
            font-size: 1.5rem;
        }
    }
</style>
@endsection