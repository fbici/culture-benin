@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green"><i class="bi bi-info-circle-fill me-2"></i>Détails du Média</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.medias.index') }}">Médias</a></li>
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
        min-width: 130px;
        display: inline-block;
    }
    .media-preview-container {
        max-height: 400px; /* Limite la hauteur du conteneur */
        overflow: hidden;
        border-radius: 8px;
        background-color: #f0f0f0;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 20px;
    }
    .media-preview-container img,
    .media-preview-container video,
    .media-preview-container audio {
        max-width: 100%;
        max-height: 100%;
        display: block;
    }
    .media-placeholder {
        padding: 30px;
        text-align: center;
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white mb-0">
                        <i class="bi bi-image me-2"></i>Média ID: **{{ $media->id_media }}**
                    </h3>
                    <span class="badge bg-light text-dark">Type: {{ $media->typeMedia->nom ?? 'Inconnu' }}</span>
                </div>
            </div>
            
            <div class="card-body p-4">

                <h5 class="text-primary mb-3"><i class="bi bi-play-circle-fill me-2"></i>Aperçu du Média</h5>
                <div class="media-preview-container">
                    @php
                        $typeNom = strtolower($media->typeMedia->nom ?? 'document');
                        $chemin = asset($media->Chemin); // Assurez-vous que 'asset' pointe correctement vers votre fichier
                    @endphp

                    @if (Str::contains($typeNom, 'image'))
                        <img src="{{ $chemin }}" alt="{{ $media->description ?? 'Aperçu du média' }}" class="img-fluid">
                    
                    @elseif (Str::contains($typeNom, 'vidéo') || Str::contains($typeNom, 'video'))
                        <video controls class="w-100">
                            <source src="{{ $chemin }}" type="video/mp4">
                            Votre navigateur ne supporte pas la balise vidéo.
                        </video>

                    @elseif (Str::contains($typeNom, 'audio'))
                        <div class="p-4 w-100">
                            <audio controls class="w-100">
                                <source src="{{ $chemin }}" type="audio/mpeg">
                                Votre navigateur ne supporte pas la balise audio.
                            </audio>
                            <small class="text-muted d-block mt-2">Fichier audio : {{ basename($media->Chemin) }}</small>
                        </div>

                    @else
                        <div class="media-placeholder text-center text-muted">
                            <i class="bi bi-file-earmark-code display-1"></i>
                            <p class="mt-2">Aperçu indisponible. Type : **{{ $media->typeMedia->nom ?? 'Inconnu' }}**.</p>
                            <a href="{{ $chemin }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-download me-1"></i> Télécharger / Ouvrir le fichier
                            </a>
                        </div>
                    @endif
                </div>
                <div class="row">
                    
                    <div class="col-md-6">
                        <h5 class="text-primary mb-3"><i class="bi bi-tag-fill me-2"></i>Identification</h5>
                        <div class="info-card">
                            <p class="mb-2">
                                <span class="info-label"><i class="bi bi-key-fill me-1"></i> ID :</span>
                                <span class="ms-2 fw-semibold">{{ $media->id_media }}</span>
                            </p>
                            <p class="mb-0">
                                <span class="info-label"><i class="bi bi-folder-fill me-1"></i> Type :</span>
                                <span class="ms-2 text-primary">{{ $media->typeMedia->nom ?? 'N/A' }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-primary mb-3"><i class="bi bi-clock-fill me-2"></i>Horodatages</h5>
                        <div class="info-card">
                            <p class="mb-2">
                                <span class="info-label"><i class="bi bi-calendar-plus me-1"></i> Créé le :</span>
                                {{ $media->created_at->format('d/m/Y H:i') }}
                            </p>
                            <p class="mb-0">
                                <span class="info-label"><i class="bi bi-arrow-repeat me-1"></i> Dernière MAJ :</span>
                                {{ $media->updated_at->format('d/m/Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
                
                <h5 class="text-primary mt-4 mb-3"><i class="bi bi-chat-left-text-fill me-2"></i>Description Complète</h5>
                <div class="p-3 bg-light border rounded mb-4">
                    <p class="mb-0">{{ $media->description ?? 'Aucune description fournie.' }}</p>
                    <small class="text-muted d-block mt-2">Chemin complet : <code>{{ $media->Chemin }}</code></small>
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-4">
                    
                    <a href="{{ route('admin.medias.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Retour à la Liste
                    </a>

                    <div class="d-flex gap-2">
                        <a href="{{ route('admin.medias.edit', $media->id_media) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Modifier
                        </a>

                        <a href="{{ route('admin.medias.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>Ajouter Nouveau
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection