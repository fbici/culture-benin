@extends('layouts.app')

@section('title', 'Modifier ' . $media->titre . ' - Culture Benin')

@section('content')
<div class="media-edit-container">
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
                <li class="breadcrumb-item">
                    <a href="{{ route('user.medias.show', $media->id_media) }}" class="text-decoration-none">
                        {{ Str::limit($media->titre, 20) }}
                    </a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    Modifier
                </li>
            </ol>
        </nav>
    </div>

    <!-- En-tête -->
    <div class="media-edit-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="mb-3">
                    <i class="bi bi-pencil-square me-2"></i>
                    Modifier le média
                </h1>
                <p class="text-muted mb-0">
                    Mettez à jour les informations de votre média
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="btn-group" role="group">
                    <a href="{{ route('user.medias.show', $media->id_media) }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Retour
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Formulaire d'édition -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="bi bi-pencil me-2"></i>
                        Informations du média
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('user.medias.update', $media->id_media) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Titre -->
                        <div class="mb-3">
                            <label for="titre" class="form-label">
                                <i class="bi bi-type me-1"></i>
                                Titre du média *
                            </label>
                            <input type="text" 
                                   class="form-control @error('titre') is-invalid @enderror" 
                                   id="titre" 
                                   name="titre" 
                                   value="{{ old('titre', $media->titre) }}" 
                                   required>
                            @error('titre')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-3">
                            <label for="description" class="form-label">
                                <i class="bi bi-card-text me-1"></i>
                                Description *
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      required>{{ old('description', $media->description) }}</textarea>
                            @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Type de média -->
                        <div class="mb-3">
                            <label for="id_type_media" class="form-label">
                                <i class="bi bi-tag me-1"></i>
                                Type de média *
                            </label>
                            <select class="form-select @error('id_type_media') is-invalid @enderror" 
                                    id="id_type_media" 
                                    name="id_type_media" 
                                    required>
                                <option value="">Sélectionnez un type</option>
                                @foreach($typeMedia as $type)
                                <option value="{{ $type->id_type_media }}" 
                                        {{ old('id_type_media', $media->id_type_media) == $type->id_type_media ? 'selected' : '' }}>
                                    {{ $type->nom }}
                                </option>
                                @endforeach
                            </select>
                            @error('id_type_media')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Premium & Prix -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" 
                                           type="checkbox" 
                                           id="is_premium" 
                                           name="is_premium" 
                                           value="1"
                                           {{ old('is_premium', $media->is_premium) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_premium">
                                        <i class="bi bi-star-fill me-1"></i>
                                        Contenu Premium
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="prix" class="form-label">
                                    <i class="bi bi-currency-euro me-1"></i>
                                    Prix (FCFA)
                                </label>
                                <input type="number" 
                                       class="form-control" 
                                       id="prix" 
                                       name="prix" 
                                       value="{{ old('prix', $media->prix) }}" 
                                       min="0" 
                                       step="50"
                                       placeholder="Ex: 500">
                            </div>
                        </div>

                        <!-- Auteur original & Copyright -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="auteur_original" class="form-label">
                                    <i class="bi bi-person-badge me-1"></i>
                                    Auteur original
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="auteur_original" 
                                       name="auteur_original" 
                                       value="{{ old('auteur_original', $media->auteur_original) }}" 
                                       placeholder="Nom de l'auteur/créateur">
                            </div>
                            <div class="col-md-6">
                                <label for="copyright" class="form-label">
                                    <i class="bi bi-c-circle me-1"></i>
                                    Copyright
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="copyright" 
                                       name="copyright" 
                                       value="{{ old('copyright', $media->copyright) }}" 
                                       placeholder="Ex: © 2024 Culture Benin">
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="mb-4">
                            <label for="tags" class="form-label">
                                <i class="bi bi-tags me-1"></i>
                                Tags/Mots-clés
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   id="tags" 
                                   name="tags" 
                                   value="{{ old('tags', $media->tags ? implode(', ', $media->tags) : '') }}" 
                                   placeholder="Séparés par des virgules (Ex: culture, tradition, art, benin)">
                            <div class="form-text">
                                <i class="bi bi-info-circle"></i>
                                Aide à la recherche et au référencement
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('user.medias.show', $media->id_media) }}" class="btn btn-outline-secondary">
                                <i class="bi bi-x-circle me-1"></i>
                                Annuler
                            </a>
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-check-circle me-1"></i>
                                Mettre à jour
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Aperçu actuel -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="bi bi-eye me-2"></i>
                        Aperçu actuel
                    </h5>
                </div>
                <div class="card-body text-center">
                    @if($media->typeMedia && $media->typeMedia->nom == 'Image')
                        @if($media->Chemin && file_exists(public_path('storage/' . $media->Chemin)))
                        <img src="{{ asset('storage/' . $media->Chemin) }}" 
                             alt="{{ $media->titre }}" 
                             class="img-fluid rounded mb-3"
                             style="max-height: 200px;">
                        @else
                        <div class="alert alert-warning small">
                            <i class="bi bi-exclamation-triangle me-1"></i>
                            Image non disponible
                        </div>
                        @endif
                    @else
                    <div class="media-preview-small">
                        <div class="preview-icon">
                            <i class="bi bi-{{ $media->typeMedia->nom == 'Vidéo' ? 'play-btn' : 'file-earmark' }}"></i>
                        </div>
                        <p class="mb-0">{{ $media->typeMedia->nom }}</p>
                    </div>
                    @endif
                    
                    <div class="media-info-preview mt-3">
                        <p class="mb-1">
                            <small class="text-muted">Format:</small>
                            <strong>{{ strtoupper($media->extension) }}</strong>
                        </p>
                        <p class="mb-1">
                            <small class="text-muted">Taille:</small>
                            <strong>
                                @if($media->taille_fichier)
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
                                @else
                                N/A
                                @endif
                            </strong>
                        </p>
                    </div>
                </div>
            </div>

            <!-- Informations techniques -->
            <div class="card mb-4">
                <div class="card-header bg-light">
                    <h5 class="mb-0">
                        <i class="bi bi-gear me-2"></i>
                        Informations techniques
                    </h5>
                </div>
                <div class="card-body">
                    <div class="tech-info-item mb-2">
                        <small class="text-muted">Chemin du fichier:</small>
                        <p class="mb-0">
                            <code class="small">{{ $media->Chemin }}</code>
                        </p>
                    </div>
                    <div class="tech-info-item mb-2">
                        <small class="text-muted">Nom du fichier:</small>
                        <p class="mb-0">{{ $media->nom_fichier }}</p>
                    </div>
                    <div class="tech-info-item mb-2">
                        <small class="text-muted">Type MIME:</small>
                        <p class="mb-0">{{ $media->mime_type }}</p>
                    </div>
                    @if($media->largeur && $media->hauteur)
                    <div class="tech-info-item">
                        <small class="text-muted">Dimensions:</small>
                        <p class="mb-0">{{ $media->largeur }} × {{ $media->hauteur }}</p>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Actions rapides -->
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
                           class="btn btn-outline-primary"
                           download>
                            <i class="bi bi-download me-1"></i>
                            Télécharger le fichier
                        </a>
                        <button type="button" 
                                class="btn btn-outline-danger" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteModal">
                            <i class="bi bi-trash me-1"></i>
                            Supprimer ce média
                        </button>
                    </div>
                </div>
            </div>
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
    .media-edit-container {
        max-width: 1400px;
        margin: 100px auto 40px;
        padding: 0 2rem;
    }

    .media-edit-header {
        background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        border-radius: 15px;
        padding: 2rem;
        border: 1px solid #ffc107;
    }

    .media-edit-header h1 {
        font-size: 1.8rem;
        font-weight: 700;
        color: #856404;
    }

    .card {
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
    }

    .form-label {
        font-weight: 600;
        color: #495057;
    }

    .form-control, .form-select {
        border-radius: 10px;
        border: 2px solid #e9ecef;
        padding: 0.75rem 1rem;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
    }

    .media-preview-small {
        padding: 2rem;
        background: #f8f9fa;
        border-radius: 10px;
        text-align: center;
    }

    .preview-icon {
        font-size: 3rem;
        color: #adb5bd;
        margin-bottom: 1rem;
    }

    .tech-info-item {
        padding: 0.5rem 0;
        border-bottom: 1px solid #f1f3f4;
    }

    .tech-info-item:last-child {
        border-bottom: none;
    }

    code {
        background: #f8f9fa;
        padding: 0.2rem 0.4rem;
        border-radius: 4px;
        font-size: 0.85rem;
        color: #e83e8c;
    }

    @media (max-width: 768px) {
        .media-edit-container {
            padding: 0 1rem;
            margin-top: 80px;
        }

        .media-edit-header {
            padding: 1.5rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle le champ prix selon l'état du checkbox premium
        const premiumCheckbox = document.getElementById('is_premium');
        const prixInput = document.getElementById('prix');
        
        function togglePrixField() {
            if (premiumCheckbox.checked) {
                prixInput.disabled = false;
                prixInput.placeholder = "Ex: 500";
            } else {
                prixInput.disabled = true;
                prixInput.value = '';
                prixInput.placeholder = "Gratuit";
            }
        }
        
        premiumCheckbox.addEventListener('change', togglePrixField);
        togglePrixField(); // Initial state
    });
</script>
@endsection