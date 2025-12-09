@extends('layouts.app')

@section('title', 'Galerie Médias Premium - Culture Benin')

@section('content')
<div class="dashboard-container">
    <!-- Header principal avec fond noir -->
    <div class="page-header mb-4">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h1 class="page-title">
                    <i class="bi bi-images text-orange me-3"></i>
                    Galerie Médias Premium
                </h1>
                <p class="page-subtitle">
                    Collection exclusive de médias sur la culture béninoise
                </p>
            </div>
            @auth
            <div class="create-btn-wrapper">
                <a href="{{ route('user.medias.create') }}" class="btn-create-content">
                    <i class="bi bi-cloud-upload-fill me-2"></i>
                    <span class="d-none d-md-inline">Uploader un média</span>
                    <span class="d-md-none">Uploader</span>
                </a>
            </div>
            @endauth
        </div>
    </div>

    <!-- Filtres améliorés -->
    <div class="filter-card mb-5">
        <div class="filter-header">
            <div class="filter-icon">
                <i class="bi bi-funnel"></i>
            </div>
            <h5 class="filter-title">Filtrer les médias</h5>
        </div>
        <div class="filter-body">
            <form action="{{ route('medias.index') }}" method="GET" class="row g-4">
                <div class="col-xl-3 col-md-6">
                    <div class="filter-group">
                        <label class="filter-label">
                            <i class="bi bi-tag me-2"></i>
                            Type de média
                        </label>
                        <select name="type" class="filter-select">
                            <option value="">Tous les types</option>
                            @foreach($types as $type)
                                <option value="{{ $type->id_type_media }}" {{ request('type') == $type->id_type_media ? 'selected' : '' }}>
                                    {{ $type->nom }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="filter-group">
                        <label class="filter-label">
                            <i class="bi bi-search me-2"></i>
                            Recherche
                        </label>
                        <input type="text" 
                            name="search" 
                            class="filter-select"
                            placeholder="Rechercher par description..."
                            value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="filter-group">
                        <label class="filter-label">
                            <i class="bi bi-sort-down me-2"></i>
                            Trier par
                        </label>
                        <select name="sort" class="filter-select">
                            <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Plus récent</option>
                            <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Plus populaire</option>
                            <option value="downloads" {{ request('sort') == 'downloads' ? 'selected' : '' }}>Téléchargements</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="filter-actions">
                        <button type="submit" class="btn-apply-filters">
                            <i class="bi bi-funnel-fill me-2"></i>
                            Appliquer les filtres
                        </button>
                        <a href="{{ route('medias.index') }}" class="btn-reset-filters">
                            <i class="bi bi-x-circle me-2"></i>
                            Réinitialiser
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mb-5">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card-mini">
                <div class="stat-icon-mini" style="background: linear-gradient(135deg, #e17000, #ff8c00);">
                    <i class="bi bi-images"></i>
                </div>
                <div class="stat-content-mini">
                    <h4 class="stat-number-mini">{{ $medias->total() }}</h4>
                    <p class="stat-label-mini">Médias au total</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card-mini">
                <div class="stat-icon-mini" style="background: linear-gradient(135deg, #0d6efd, #6ea8fe);">
                    <i class="bi bi-image"></i>
                </div>
                <div class="stat-content-mini">
                    @php
                        $images = $medias->where('typeMedia.nom', 'Image')->count();
                    @endphp
                    <h4 class="stat-number-mini">{{ $images }}</h4>
                    <p class="stat-label-mini">Images</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card-mini">
                <div class="stat-icon-mini" style="background: linear-gradient(135deg, #198754, #20c997);">
                    <i class="bi bi-play-btn"></i>
                </div>
                <div class="stat-content-mini">
                    @php
                        $videos = $medias->where('typeMedia.nom', 'Vidéo')->count();
                    @endphp
                    <h4 class="stat-number-mini">{{ $videos }}</h4>
                    <p class="stat-label-mini">Vidéos</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="stat-card-mini">
                <div class="stat-icon-mini" style="background: linear-gradient(135deg, #6f42c1, #a370f7);">
                    <i class="bi bi-music-note-beamed"></i>
                </div>
                <div class="stat-content-mini">
                    @php
                        $audios = $medias->where('typeMedia.nom', 'Audio')->count();
                    @endphp
                    <h4 class="stat-number-mini">{{ $audios }}</h4>
                    <p class="stat-label-mini">Audios</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Grille de médias améliorée -->
    @if($medias->count() > 0)
        <div class="media-grid-premium">
            @foreach($medias as $media)
                @php
                    $mediaType = $media->typeMedia->nom ?? 'Document';
                    $typeIcons = [
                        'Image' => 'bi-image',
                        'Vidéo' => 'bi-camera-video',
                        'Audio' => 'bi-music-note-beamed',
                        'PDF' => 'bi-file-earmark-pdf',
                        'Document' => 'bi-file-earmark-text'
                    ];
                    $typeIcon = $typeIcons[$mediaType] ?? 'bi-file-earmark';
                    $typeColors = [
                        'Image' => '#0d6efd',
                        'Vidéo' => '#198754',
                        'Audio' => '#6f42c1',
                        'PDF' => '#dc3545',
                        'Document' => '#6c757d'
                    ];
                    $typeColor = $typeColors[$mediaType] ?? '#6c757d';
                @endphp
            
            <div class="media-card-premium">
                <!-- Thumbnail avec effet hover -->
                <div class="media-thumbnail-premium">
                    @if($mediaType == 'Image' && Storage::exists($media->Chemin))
                        <div class="thumbnail-container">
                            <img src="{{ Storage::url($media->Chemin) }}" 
                                alt="{{ $media->description }}"
                                class="media-image-premium"
                                loading="lazy">
                            <div class="thumbnail-overlay">
                                <div class="overlay-content">
                                    <a href="{{ route('medias.show', $media->id_media) }}" class="overlay-btn">
                                        <i class="bi bi-eye-fill me-2"></i>
                                        Voir
                                    </a>
                                    @if($mediaType == 'Image')
                                    <a href="{{ Storage::url($media->Chemin) }}" 
                                       target="_blank"
                                       class="overlay-btn secondary"
                                       download>
                                        <i class="bi bi-download me-2"></i>
                                        Télécharger
                                    </a>
                                    @else
                                    <a href="{{ route('medias.download', $media->id_media) }}" 
                                       class="overlay-btn secondary">
                                        <i class="bi bi-download me-2"></i>
                                        Télécharger
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="media-placeholder-premium" style="border-color: {{ $typeColor }};">
                            <div class="placeholder-icon-premium" style="color: {{ $typeColor }};">
                                <i class="bi {{ $typeIcon }}"></i>
                            </div>
                            <div class="placeholder-info">
                                <span class="placeholder-type" style="color: {{ $typeColor }};">{{ $mediaType }}</span>
                                @if($media->taille ?? false)
                                <span class="placeholder-size">{{ round($media->taille / 1024) }} KB</span>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                    <!-- Badges sur l'image -->
                    <div class="media-badges">
                        <span class="type-badge-premium" style="background: {{ $typeColor }};">
                            <i class="bi {{ $typeIcon }} me-1"></i>
                            {{ $mediaType }}
                        </span>
                        <span class="premium-badge-premium">
                            <i class="bi bi-star-fill me-1"></i>
                            Premium
                        </span>
                    </div>
                </div>

                <!-- Informations en bas -->
                <div class="media-content-premium">
                    <!-- Header avec titre et métadonnées -->
                    <div class="content-header">
                        <h3 class="media-title-premium">
                            <a href="{{ route('medias.show', $media->id_media) }}">
                                {{ Str::limit($media->description, 50) }}
                            </a>
                        </h3>
                        <div class="media-meta-premium">
                            <div class="meta-item-premium">
                                <i class="bi bi-person-circle"></i>
                                <span>{{ $media->user->prenom ?? 'Anonyme' }}</span>
                            </div>
                            <div class="meta-item-premium">
                                <i class="bi bi-calendar3"></i>
                                <span>{{ $media->created_at->format('d/m/Y') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <p class="media-description-premium">
                        {{ Str::limit(strip_tags($media->description), 80) }}
                    </p>

                    <!-- Footer avec actions -->
                    <div class="content-footer">
                        <div class="price-info">
                            <div class="price-tag-premium">
                                <i class="bi bi-coin"></i>
                                <span></span>
                            </div>
                            <div class="file-info">
                                <i class="bi bi-file-earmark"></i>
                                <span>{{ $mediaType }}</span>
                            </div>
                        </div>
                        <div class="action-buttons">
                            <a href="{{ route('medias.show', $media->id_media) }}" class="view-details-btn">
                                <i class="bi bi-info-circle me-2"></i>
                                Détails
                            </a>
                            <button class="quick-action-btn" title="Ajouter aux favoris">
                                <i class="bi bi-heart"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="pagination-wrapper mt-5">
            {{ $medias->links() }}
        </div>
    @else
        <!-- État vide -->
        <div class="empty-state">
            <div class="empty-state-icon">
                <i class="bi bi-images"></i>
            </div>
            <h3 class="empty-state-title">Aucun média trouvé</h3>
            <p class="empty-state-text">
                @if(request()->hasAny(['type', 'search']))
                    Aucun média ne correspond à vos critères de recherche.
                @else
                    La galerie est actuellement vide.
                @endif
            </p>
            <div class="empty-state-actions">
                @auth
                <a href="{{ route('user.medias.create') }}" class="btn btn-primary">
                    <i class="bi bi-cloud-upload me-2"></i>
                    Uploader un média
                </a>
                @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Se connecter pour uploader
                </a>
                @endauth
            </div>
        </div>
    @endif
</div>

<style>
    /* ===== STYLES GALERIE MÉDIAS AMÉLIORÉE ===== */
    .dashboard-container {
        max-width: 1400px;
        margin: 100px auto 40px;
        padding: 0 2rem;
    }

    /* Header principal avec fond noir */
    .page-header {
        background: linear-gradient(135deg, #1a1d21, #2c3034);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
        border-left: 5px solid #e17000;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        color: white;
    }

    .page-subtitle {
        font-size: 1rem;
        color: #adb5bd;
        margin: 0;
    }

    .text-orange {
        color: #ff8c00 !important;
    }

    /* Bouton créer */
    .create-btn-wrapper {
        flex-shrink: 0;
    }

    .btn-create-content {
        background: linear-gradient(135deg, #0d6efd, #6ea8fe);
        color: white;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
    }

    .btn-create-content:hover {
        background: linear-gradient(135deg, #6ea8fe, #9ec5fe);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(13, 110, 253, 0.4);
        color: white;
    }

    /* Filtres */
    .filter-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        margin-bottom: 2rem;
        overflow: hidden;
    }

    .filter-header {
        background: linear-gradient(135deg, #0d6efd, #6ea8fe);
        color: white;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .filter-icon {
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .filter-title {
        margin: 0;
        font-size: 1.25rem;
        font-weight: 600;
    }

    .filter-body {
        padding: 2rem;
    }

    .filter-group {
        margin-bottom: 1rem;
    }

    .filter-label {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #495057;
        font-size: 0.9rem;
    }

    .filter-select {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e9ecef;
        border-radius: 10px;
        background: white;
        font-size: 0.9rem;
        transition: all 0.3s ease;
    }

    .filter-select:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        outline: none;
    }

    .filter-actions {
        display: flex;
        gap: 1rem;
        margin-top: 1rem;
    }

    .btn-apply-filters {
        background: linear-gradient(135deg, #0d6efd, #6ea8fe);
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .btn-apply-filters:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
    }

    .btn-reset-filters {
        background: #f8f9fa;
        color: #6c757d;
        border: 2px solid #e9ecef;
        padding: 0.75rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .btn-reset-filters:hover {
        background: #e9ecef;
        color: #495057;
    }

    /* Cartes statistiques mini */
    .stat-card-mini {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
        height: 100%;
    }

    .stat-card-mini:hover {
        transform: translateY(-5px);
    }

    .stat-icon-mini {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        flex-shrink: 0;
    }

    .stat-content-mini {
        flex: 1;
    }

    .stat-number-mini {
        font-size: 2rem;
        font-weight: 800;
        margin: 0;
        line-height: 1;
        color: #1a1d21;
    }

    .stat-label-mini {
        color: #6c757d;
        margin: 0.5rem 0 0;
        font-size: 0.9rem;
    }

    /* Grille de médias premium */
    .media-grid-premium {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 1.5rem;
        margin-top: 1rem; /* Espace entre les stats et la grille */
    }

    /* Carte média premium */
    .media-card-premium {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.4s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .media-card-premium:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
    }

    /* Thumbnail avec effet hover */
    .media-thumbnail-premium {
        position: relative;
        height: 200px;
        overflow: hidden;
        background: #f8f9fa;
    }

    .thumbnail-container {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .media-image-premium {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .thumbnail-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.6));
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .thumbnail-container:hover .thumbnail-overlay {
        opacity: 1;
    }

    .thumbnail-container:hover .media-image-premium {
        transform: scale(1.05);
    }

    .overlay-content {
        display: flex;
        gap: 0.8rem;
        transform: translateY(20px);
        transition: transform 0.3s ease;
    }

    .thumbnail-container:hover .overlay-content {
        transform: translateY(0);
    }

    .overlay-btn {
        background: white;
        color: #0d6efd;
        border: none;
        padding: 0.6rem 1.2rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .overlay-btn:hover {
        background: #0d6efd;
        color: white;
        transform: translateY(-2px);
    }

    .overlay-btn.secondary {
        background: #e17000;
        color: white;
    }

    .overlay-btn.secondary:hover {
        background: #ff8c00;
        color: white;
    }

    /* Placeholder pour autres types */
    .media-placeholder-premium {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 2px solid;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.9);
        padding: 2rem;
    }

    .placeholder-icon-premium {
        font-size: 3.5rem;
        margin-bottom: 1rem;
    }

    .placeholder-info {
        text-align: center;
    }

    .placeholder-type {
        font-size: 1.2rem;
        font-weight: 700;
        display: block;
        margin-bottom: 0.5rem;
    }

    .placeholder-size {
        font-size: 0.9rem;
        color: #6c757d;
        background: #f8f9fa;
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
    }

    /* Badges sur l'image */
    .media-badges {
        position: absolute;
        top: 15px;
        left: 15px;
        right: 15px;
        display: flex;
        justify-content: space-between;
        pointer-events: none;
    }

    .type-badge-premium {
        color: white;
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .premium-badge-premium {
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        color: #856404;
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 2px 10px rgba(255, 215, 0, 0.3);
    }

    /* Contenu en bas */
    .media-content-premium {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    /* Header avec titre et métadonnées */
    .content-header {
        margin-bottom: 1rem;
    }

    .media-title-premium {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        line-height: 1.4;
    }

    .media-title-premium a {
        color: #1a1d21;
        text-decoration: none;
        transition: color 0.3s ease;
    }

    .media-title-premium a:hover {
        color: #0d6efd;
    }

    .media-meta-premium {
        display: flex;
        gap: 1rem;
        margin-bottom: 0.5rem;
    }

    .meta-item-premium {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.85rem;
        color: #6c757d;
    }

    .meta-item-premium i {
        font-size: 0.9rem;
    }

    /* Description */
    .media-description-premium {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1.5rem;
        flex: 1;
    }

    /* Footer avec actions */
    .content-footer {
        border-top: 1px solid #e9ecef;
        padding-top: 1rem;
    }

    .price-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .price-tag-premium {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-weight: 700;
        color: #e17000;
        font-size: 1.1rem;
    }

    .price-tag-premium i {
        font-size: 1.2rem;
    }

    .file-info {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.9rem;
        color: #6c757d;
        background: #f8f9fa;
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
    }

    .action-buttons {
        display: flex;
        gap: 0.8rem;
    }

    .view-details-btn {
        flex: 1;
        background: linear-gradient(135deg, #0d6efd, #6ea8fe);
        color: white;
        border: none;
        padding: 0.6rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .view-details-btn:hover {
        background: linear-gradient(135deg, #6ea8fe, #9ec5fe);
        transform: translateY(-2px);
        color: white;
    }

    .quick-action-btn {
        width: 40px;
        height: 40px;
        background: #f8f9fa;
        color: #6c757d;
        border: 1px solid #e9ecef;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .quick-action-btn:hover {
        background: #e9ecef;
        color: #dc3545;
        transform: translateY(-2px);
    }

    /* État vide */
    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
    }

    .empty-state-icon {
        font-size: 4rem;
        color: #0d6efd;
        margin-bottom: 1.5rem;
        opacity: 0.5;
    }

    .empty-state-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }

    .empty-state-text {
        color: #6c757d;
        max-width: 500px;
        margin: 0 auto 2rem;
        line-height: 1.6;
    }

    .empty-state-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    /* Pagination */
    .pagination-wrapper {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.06);
        margin-top: 2rem;
    }

    .pagination-wrapper .pagination {
        justify-content: center;
        margin: 0;
    }

    .pagination-wrapper .page-item .page-link {
        border: 2px solid #e9ecef;
        background: white;
        color: #495057;
        font-weight: 600;
        margin: 0 0.25rem;
        border-radius: 10px;
        transition: all 0.3s ease;
        padding: 0.5rem 0.9rem;
    }

    .pagination-wrapper .page-item .page-link:hover {
        border-color: #0d6efd;
        background: rgba(13, 110, 253, 0.05);
        color: #0d6efd;
    }

    .pagination-wrapper .page-item.active .page-link {
        background: linear-gradient(135deg, #0d6efd, #6ea8fe);
        border-color: #0d6efd;
        color: white;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 0 1rem;
            margin-top: 80px;
        }

        .page-header {
            padding: 1.5rem;
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }

        .filter-body {
            padding: 1.5rem;
        }

        .filter-actions {
            flex-direction: column;
        }

        .stat-card-mini {
            flex-direction: column;
            text-align: center;
            padding: 1rem;
        }

        .stat-icon-mini {
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
        }

        .stat-number-mini {
            font-size: 1.5rem;
        }

        .media-grid-premium {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .media-thumbnail-premium {
            height: 180px;
        }

        .overlay-content {
            flex-direction: column;
            gap: 0.5rem;
        }

        .overlay-btn {
            padding: 0.5rem 1rem;
            font-size: 0.8rem;
        }

        .media-content-premium {
            padding: 1rem;
        }

        .action-buttons {
            flex-direction: column;
        }

        .quick-action-btn {
            width: 100%;
            height: auto;
            padding: 0.5rem;
        }
    }

    @media (max-width: 480px) {
        .page-title {
            font-size: 1.5rem;
        }

        .price-info {
            flex-direction: column;
            gap: 0.5rem;
            align-items: flex-start;
        }

        .media-meta-premium {
            flex-direction: column;
            gap: 0.5rem;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des cartes au scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 100);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        });

        // Observer les cartes média
        document.querySelectorAll('.media-card-premium').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease';
            observer.observe(card);
        });

        // Gestion des boutons favoris
        document.querySelectorAll('.quick-action-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (icon.classList.contains('bi-heart-fill')) {
                    icon.classList.remove('bi-heart-fill');
                    icon.classList.add('bi-heart');
                    this.style.color = '';
                } else {
                    icon.classList.remove('bi-heart');
                    icon.classList.add('bi-heart-fill');
                    this.style.color = '#dc3545';
                }
            });
        });

        // Animation des overlays
        document.querySelectorAll('.thumbnail-container').forEach(container => {
            container.addEventListener('mouseenter', function() {
                const overlay = this.querySelector('.thumbnail-overlay');
                const content = overlay.querySelector('.overlay-content');
                overlay.style.opacity = '1';
                content.style.transform = 'translateY(0)';
            });
            
            container.addEventListener('mouseleave', function() {
                const overlay = this.querySelector('.thumbnail-overlay');
                const content = overlay.querySelector('.overlay-content');
                overlay.style.opacity = '0';
                content.style.transform = 'translateY(20px)';
            });
        });

        // Effet de parallaxe sur les thumbnails
        document.querySelectorAll('.thumbnail-container').forEach(container => {
            container.addEventListener('mousemove', function(e) {
                const img = this.querySelector('.media-image-premium');
                const x = e.clientX - this.getBoundingClientRect().left;
                const y = e.clientY - this.getBoundingClientRect().top;
                
                const moveX = (x / this.offsetWidth - 0.5) * 10;
                const moveY = (y / this.offsetHeight - 0.5) * 10;
                
                img.style.transform = `scale(1.05) translate(${moveX}px, ${moveY}px)`;
            });
            
            container.addEventListener('mouseleave', function() {
                const img = this.querySelector('.media-image-premium');
                img.style.transform = 'scale(1) translate(0, 0)';
            });
        });
    });
</script>
@endsection