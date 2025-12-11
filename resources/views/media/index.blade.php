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
            <form action="{{ route('media.index') }}" method="GET" class="row g-4">
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
                            placeholder="Rechercher par titre, description ou tags..."
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
                            <option value="premium" {{ request('sort') == 'premium' ? 'selected' : '' }}>Premium</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <div class="filter-actions">
                        <button type="submit" class="btn-apply-filters">
                            <i class="bi bi-funnel-fill me-2"></i>
                            Appliquer les filtres
                        </button>
                        <a href="{{ route('media.index') }}" class="btn-reset-filters">
                            <i class="bi bi-x-circle me-2"></i>
                            Réinitialiser
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistiques Premium -->
    <div class="stats-grid-premium mb-5">
        <!-- Carte Totale -->
        <div class="stat-card-premium total">
            <div class="stat-gradient"></div>
            <div class="stat-content">
                <div class="stat-icon-wrapper">
                    <i class="bi bi-images"></i>
                    <div class="icon-glow"></div>
                </div>
                <div class="stat-info">
                    <div class="stat-number" id="total-counter">{{ $medias->total() }}</div>
                    <div class="stat-label">Médias Totaux</div>
                </div>
                <div class="stat-trend">
                    <i class="bi bi-graph-up-arrow"></i>
                    <span>+{{ min(15, $medias->total()) }}%</span>
                </div>
            </div>
        </div>

        <!-- Carte Images -->
        <div class="stat-card-premium images">
            @php
                $images = $medias->where('typeMedia.nom', 'Image')->count();
            @endphp
            <div class="stat-gradient"></div>
            <div class="stat-content">
                <div class="stat-icon-wrapper">
                    <i class="bi bi-image"></i>
                    <div class="icon-glow"></div>
                </div>
                <div class="stat-info">
                    <div class="stat-number" id="images-counter">{{ $images }}</div>
                    <div class="stat-label">Images</div>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar" style="width: {{ $medias->count() > 0 ? ($images / $medias->count()) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Carte Vidéos -->
        <div class="stat-card-premium videos">
            @php
                $videos = $medias->where('typeMedia.nom', 'Vidéo')->count();
            @endphp
            <div class="stat-gradient"></div>
            <div class="stat-content">
                <div class="stat-icon-wrapper">
                    <i class="bi bi-camera-video"></i>
                    <div class="icon-glow"></div>
                </div>
                <div class="stat-info">
                    <div class="stat-number" id="videos-counter">{{ $videos }}</div>
                    <div class="stat-label">Vidéos</div>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar" style="width: {{ $medias->count() > 0 ? ($videos / $medias->count()) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>

        <!-- Carte Audios -->
        <div class="stat-card-premium audios">
            @php
                $audios = $medias->where('typeMedia.nom', 'Audio')->count();
            @endphp
            <div class="stat-gradient"></div>
            <div class="stat-content">
                <div class="stat-icon-wrapper">
                    <i class="bi bi-music-note-beamed"></i>
                    <div class="icon-glow"></div>
                </div>
                <div class="stat-info">
                    <div class="stat-number" id="audios-counter">{{ $audios }}</div>
                    <div class="stat-label">Audios</div>
                </div>
                <div class="stat-progress">
                    <div class="progress-bar" style="width: {{ $medias->count() > 0 ? ($audios / $medias->count()) * 100 : 0 }}%"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Grille de médias premium améliorée -->
    @if($medias->count() > 0)
        <div class="media-grid-premium-pro">
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
                        'Image' => '#4361ee',
                        'Vidéo' => '#f72585',
                        'Audio' => '#7209b7',
                        'PDF' => '#f8961e',
                        'Document' => '#43aa8b'
                    ];
                    $typeColor = $typeColors[$mediaType] ?? '#6b7280';
                    $typeBg = $typeColor . '20';
                    $typeLight = $typeColor . '10';
                @endphp
            
            <div class="media-card-pro">
                <!-- Header avec badges -->
                <div class="card-header-pro">
                    <div class="header-left">
                        <span class="type-badge-pro" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                            <i class="bi {{ $typeIcon }} me-1"></i>
                            {{ $mediaType }}
                        </span>
                        @if($media->is_premium)
                        <span class="premium-badge-pro">
                            <i class="bi bi-star-fill me-1"></i>
                            Premium
                        </span>
                        @endif
                    </div>
                    <div class="header-right">
                        @if($media->downloads > 0)
                        <span class="downloads-badge">
                            <i class="bi bi-download"></i>
                            {{ $media->downloads }}
                        </span>
                        @endif
                    </div>
                </div>

                <!-- Thumbnail avec effet hover -->
                <div class="media-thumbnail-pro">
                    @if($mediaType == 'Image' && $media->Chemin)
                    @php
                        $imageUrl = asset('storage/' . $media->Chemin);
                        $storagePath = 'public/' . $media->Chemin;
                        $fileExists = Storage::exists($storagePath);
                    @endphp
                    @if($fileExists)
                        <div class="thumbnail-wrapper-pro">
                            <div class="thumbnail-container-pro">
                                <img src="{{ $imageUrl }}" 
                                    alt="{{ $media->titre }}"
                                    class="media-image-pro"
                                    loading="lazy"
                                    onerror="this.onerror=null; this.parentElement.innerHTML='<div class=\"media-placeholder-pro\"><div class=\"placeholder-icon-pro\"><i class=\"bi bi-image\"></i></div><div class=\"placeholder-info\"><span class=\"placeholder-type\">Image</span></div></div>';">
                                <div class="thumbnail-overlay-pro">
                                    <div class="overlay-content-pro">
                                        <a href="{{ route('media.show', $media->id_media) }}" class="overlay-btn-pro view">
                                            <i class="bi bi-eye-fill"></i>
                                            <span>Voir</span>
                                        </a>
                                        <a href="{{ Storage::url($media->Chemin) }}" 
                                        target="_blank"
                                        class="overlay-btn-pro download"
                                        download>
                                            <i class="bi bi-download"></i>
                                            <span>Télécharger</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="thumbnail-shine"></div>
                        </div>
                    @else
                        <div class="media-placeholder-pro" style="background: {{ $typeLight }}; border-color: {{ $typeColor }};">
                            <div class="placeholder-icon-pro" style="color: {{ $typeColor }};">
                                <i class="bi {{ $typeIcon }}"></i>
                            </div>
                            <div class="placeholder-info">
                                <span class="placeholder-type" style="color: {{ $typeColor }};">{{ $mediaType }}</span>
                                @if($media->taille_formatee)
                                <span class="placeholder-size">{{ $media->taille_formatee }}</span>
                                @endif
                            </div>
                        </div>
                    @endif
                @else
                        <div class="media-placeholder-pro" style="background: {{ $typeLight }}; border-color: {{ $typeColor }};">
                            <div class="placeholder-icon-pro" style="color: {{ $typeColor }};">
                                <i class="bi {{ $typeIcon }}"></i>
                            </div>
                            <div class="placeholder-info">
                                <span class="placeholder-type" style="color: {{ $typeColor }};">{{ $mediaType }}</span>
                                @if($media->taille_formatee)
                                <span class="placeholder-size">{{ $media->taille_formatee }}</span>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Contenu principal -->
                <div class="media-content-pro">
                    <div class="content-header-pro">
                        <h3 class="media-title-pro">
                            <a href="{{ route('media.show', $media->id_media) }}">
                                {{ Str::limit($media->titre, 45) }}
                            </a>
                        </h3>
                        <p class="media-description-pro">
                            {{ Str::limit(strip_tags($media->description), 100) }}
                        </p>
                    </div>

                    
                        

                    <!-- Tags -->
                    @if($media->tags && count($media->tags) > 0)
                    <div class="media-tags-pro">
                        @foreach(array_slice($media->tags, 0, 2) as $tag)
                            <span class="tag-badge-pro" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                {{ trim($tag) }}
                            </span>
                        @endforeach
                        @if(count($media->tags) > 2)
                            <span class="more-tags-pro">+{{ count($media->tags) - 2 }}</span>
                        @endif
                    </div>
                    @endif

                    <!-- Footer -->
                    <div class="content-footer-pro">
                        <div class="footer-left">
                            <div class="author-info">
                                <div class="author-avatar" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                    {{ strtoupper(substr($media->user->prenom ?? 'A', 0, 1)) }}
                                </div>
                                <div class="author-details">
                                    <span class="author-name">{{ $media->user->prenom ?? 'Anonyme' }}</span>
                                    <span class="post-date">{{ $media->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="footer-right">
                            @if($media->is_premium && $media->prix)
                            <div class="price-tag-pro">
                                <i class="bi bi-coin"></i>
                                <span>{{ number_format($media->prix, 0, ',', ' ') }} FCFA</span>
                            </div>
                            @else
                            <div class="free-tag-pro">
                                <i class="bi bi-unlock"></i>
                                <span>Gratuit</span>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="card-actions-pro">
                    <a href="{{ route('media.show', $media->id_media) }}" class="view-details-btn-pro">
                        <i class="bi bi-info-circle me-2"></i>
                        Voir les détails
                    </a>
                    @auth
                    <button class="quick-action-btn-pro favorite-btn" data-media-id="{{ $media->id_media }}" title="Ajouter aux favoris">
                        <i class="bi bi-heart"></i>
                    </button>
                    @endauth
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
        <div class="empty-state-pro">
            <div class="empty-state-content">
                <div class="empty-state-icon-pro">
                    <i class="bi bi-images"></i>
                    <div class="icon-glow-empty"></div>
                </div>
                <h3 class="empty-state-title-pro">Aucun média trouvé</h3>
                <p class="empty-state-text-pro">
                    @if(request()->hasAny(['type', 'search']))
                        Aucun média ne correspond à vos critères de recherche.
                    @else
                        La galerie est actuellement vide. Soyez le premier à partager du contenu!
                    @endif
                </p>
                <div class="empty-state-actions-pro">
                    @auth
                    <a href="{{ route('user.medias.create') }}" class="btn-create-pro">
                        <i class="bi bi-cloud-upload me-2"></i>
                        Uploader un média
                    </a>
                    @else
                    <a href="{{ route('login') }}" class="btn-login-pro">
                        <i class="bi bi-box-arrow-in-right me-2"></i>
                        Se connecter pour uploader
                    </a>
                    @endauth
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    /* ===== STYLES GÉNÉRAUX ===== */
    .dashboard-container {
        max-width: 1400px;
        margin: 100px auto 40px;
        padding: 0 2rem;
    }

    /* ===== HEADER PRINCIPAL ===== */
    .page-header {
        background: linear-gradient(135deg, #1a1d21, #2c3034);
        border-radius: 24px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        color: white;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.2),
            0 0 0 1px rgba(255, 255, 255, 0.1);
        border-left: 6px solid #e17000;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    }

    .page-title {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
        color: white;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        background: linear-gradient(135deg, #fff 0%, #ff8c00 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .page-subtitle {
        font-size: 1.1rem;
        color: #adb5bd;
        margin: 0;
        font-weight: 400;
    }

    .create-btn-wrapper {
        flex-shrink: 0;
    }

    .btn-create-content {
        background: linear-gradient(135deg, #0d6efd, #6ea8fe);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 15px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 
            0 10px 30px rgba(13, 110, 253, 0.4),
            0 0 0 1px rgba(255, 255, 255, 0.1);
        position: relative;
        overflow: hidden;
    }

    .btn-create-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .btn-create-content:hover {
        background: linear-gradient(135deg, #6ea8fe, #9ec5fe);
        transform: translateY(-3px) scale(1.05);
        box-shadow: 
            0 15px 40px rgba(13, 110, 253, 0.6),
            0 0 0 1px rgba(255, 255, 255, 0.2);
    }

    .btn-create-content:hover::before {
        left: 100%;
    }

    /* ===== STATISTIQUES PREMIUM ===== */
    .stats-grid-premium {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card-premium {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        position: relative;
        overflow: hidden;
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .stat-card-premium:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 
            0 25px 60px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(0, 0, 0, 0.03);
    }

    .stat-card-premium.total {
        background: linear-gradient(135deg, #1a1d21, #2c3034);
        color: white;
    }

    .stat-card-premium.images {
        border-top: 4px solid #4361ee;
    }

    .stat-card-premium.videos {
        border-top: 4px solid #f72585;
    }

    .stat-card-premium.audios {
        border-top: 4px solid #7209b7;
    }

    .stat-gradient {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, 
            var(--stat-color, #4361ee) 0%,
            var(--stat-color, #4361ee) 50%,
            transparent 100%);
    }

    .stat-card-premium.total .stat-gradient {
        background: linear-gradient(90deg, #e17000 0%, #ff8c00 100%);
    }

    .stat-card-premium.images .stat-gradient {
        --stat-color: #4361ee;
    }

    .stat-card-premium.videos .stat-gradient {
        --stat-color: #f72585;
    }

    .stat-card-premium.audios .stat-gradient {
        --stat-color: #7209b7;
    }

    .stat-content {
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .stat-icon-wrapper {
        position: relative;
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        color: white;
        flex-shrink: 0;
    }

    .stat-card-premium.total .stat-icon-wrapper {
        background: linear-gradient(135deg, #e17000, #ff8c00);
    }

    .stat-card-premium.images .stat-icon-wrapper {
        background: linear-gradient(135deg, #4361ee, #7209b7);
    }

    .stat-card-premium.videos .stat-icon-wrapper {
        background: linear-gradient(135deg, #f72585, #b5179e);
    }

    .stat-card-premium.audios .stat-icon-wrapper {
        background: linear-gradient(135deg, #7209b7, #560bad);
    }

    .icon-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        background: radial-gradient(circle, 
            rgba(var(--stat-rgb, 67, 97, 238), 0.3) 0%, 
            transparent 70%);
        border-radius: 50%;
        animation: pulseGlow 2s infinite;
    }

    .stat-card-premium.total .icon-glow {
        background: radial-gradient(circle, rgba(225, 112, 0, 0.3) 0%, transparent 70%);
    }

    .stat-info {
        flex: 1;
    }

    .stat-number {
        font-size: 2.8rem;
        font-weight: 900;
        line-height: 1;
        margin-bottom: 0.5rem;
        color: inherit;
    }

    .stat-card-premium:not(.total) .stat-number {
        color: #1a1d21;
    }

    .stat-label {
        font-size: 0.95rem;
        font-weight: 600;
        color: inherit;
        opacity: 0.8;
    }

    .stat-card-premium:not(.total) .stat-label {
        color: #6c757d;
    }

    .stat-trend {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        font-weight: 700;
        color: #10b981;
        background: rgba(16, 185, 129, 0.1);
        padding: 0.5rem 0.8rem;
        border-radius: 20px;
    }

    .stat-progress {
        height: 4px;
        background: rgba(0, 0, 0, 0.05);
        border-radius: 2px;
        overflow: hidden;
        margin-top: 1rem;
    }

    .progress-bar {
        height: 100%;
        background: var(--stat-color, #4361ee);
        border-radius: 2px;
        transition: width 1s ease-out;
    }

    /* ===== FILTRES ===== */
    .filter-card {
        background: white;
        border-radius: 24px;
        box-shadow: 
            0 15px 50px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        margin-bottom: 3rem;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .filter-header {
        background: linear-gradient(135deg, #1a1d21, #2c3034);
        color: white;
        padding: 1.8rem 2rem;
        display: flex;
        align-items: center;
        gap: 1.2rem;
        position: relative;
        overflow: hidden;
    }

    .filter-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    }

    .filter-icon {
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        color: white;
    }

    .filter-title {
        margin: 0;
        font-size: 1.4rem;
        font-weight: 700;
    }

    .filter-body {
        padding: 2.5rem;
    }

    .filter-group {
        margin-bottom: 1.5rem;
    }

    .filter-label {
        display: flex;
        align-items: center;
        margin-bottom: 0.8rem;
        font-weight: 700;
        color: #495057;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .filter-select {
        width: 100%;
        padding: 1rem 1.2rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        background: white;
        font-size: 1rem;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .filter-select:focus {
        border-color: #4361ee;
        box-shadow: 
            0 0 0 4px rgba(67, 97, 238, 0.1),
            0 4px 20px rgba(67, 97, 238, 0.15);
        outline: none;
        transform: translateY(-2px);
    }

    .filter-actions {
        display: flex;
        gap: 1.2rem;
        margin-top: 2rem;
    }

    .btn-apply-filters {
        background: linear-gradient(135deg, #4361ee, #7209b7);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
        position: relative;
        overflow: hidden;
    }

    .btn-apply-filters::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .btn-apply-filters:hover {
        background: linear-gradient(135deg, #7209b7, #4361ee);
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(67, 97, 238, 0.4);
    }

    .btn-apply-filters:hover::before {
        left: 100%;
    }

    .btn-reset-filters {
        background: white;
        color: #6c757d;
        border: 2px solid #e9ecef;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .btn-reset-filters:hover {
        background: #f8f9fa;
        color: #4361ee;
        border-color: #4361ee;
        transform: translateY(-2px);
    }

    /* ===== GRID MÉDIAS PRO ===== */
    .media-grid-premium-pro {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
        margin-top: 1rem;
    }

    .media-card-pro {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 
            0 15px 50px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
    }

    .media-card-pro:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 
            0 30px 80px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(0, 0, 0, 0.03);
    }

    /* Header */
    .card-header-pro {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.2rem 1.5rem;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
    }

    .header-left {
        display: flex;
        gap: 0.8rem;
        flex-wrap: wrap;
    }

    .type-badge-pro {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        letter-spacing: 0.5px;
        text-transform: uppercase;
    }

    .premium-badge-pro {
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        color: #856404;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        letter-spacing: 0.5px;
    }

    .downloads-badge {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        font-size: 0.9rem;
        font-weight: 700;
        color: #6c757d;
        background: white;
        padding: 0.4rem 0.8rem;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    /* Thumbnail */
    .media-thumbnail-pro {
        position: relative;
        height: 220px;
        overflow: hidden;
        background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    }

    .thumbnail-wrapper-pro {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .thumbnail-container-pro {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .media-image-pro {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .thumbnail-container-pro:hover .media-image-pro {
        transform: scale(1.1);
    }

    .thumbnail-overlay-pro {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, 
            rgba(0,0,0,0.3) 0%,
            transparent 30%,
            transparent 70%,
            rgba(0,0,0,0.3) 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        backdrop-filter: blur(5px);
    }

    .thumbnail-container-pro:hover .thumbnail-overlay-pro {
        opacity: 1;
    }

    .overlay-content-pro {
        display: flex;
        gap: 1rem;
        transform: translateY(30px);
        transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .thumbnail-container-pro:hover .overlay-content-pro {
        transform: translateY(0);
    }

    .overlay-btn-pro {
        background: white;
        color: #1a1d21;
        border: none;
        padding: 0.8rem 1.2rem;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        font-size: 0.9rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        min-width: 120px;
        justify-content: center;
    }

    .overlay-btn-pro.view {
        background: linear-gradient(135deg, #4361ee, #7209b7);
        color: white;
    }

    .overlay-btn-pro.download {
        background: linear-gradient(135deg, #e17000, #ff8c00);
        color: white;
    }

    .overlay-btn-pro:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.3);
    }

    .thumbnail-shine {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, 
            transparent, 
            rgba(255, 255, 255, 0.4), 
            transparent);
        transition: left 0.8s;
    }

    .thumbnail-container-pro:hover .thumbnail-shine {
        left: 100%;
    }

    /* Placeholder */
    .media-placeholder-pro {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border: 2px dashed;
        border-radius: 16px;
        padding: 2rem;
        transition: all 0.3s ease;
    }

    .placeholder-icon-pro {
        font-size: 4rem;
        margin-bottom: 1.5rem;
        transition: transform 0.3s ease;
    }

    .media-placeholder-pro:hover .placeholder-icon-pro {
        transform: scale(1.1);
    }

    .placeholder-type {
        font-size: 1.3rem;
        font-weight: 800;
        display: block;
        margin-bottom: 0.5rem;
    }

    .placeholder-size {
        font-size: 0.9rem;
        color: #6c757d;
        background: white;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
    }

    /* Contenu */
    .media-content-pro {
        padding: 1.8rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .content-header-pro {
        margin-bottom: 1.5rem;
    }

    .media-title-pro {
        font-size: 1.3rem;
        font-weight: 900;
        margin-bottom: 0.8rem;
        line-height: 1.3;
    }

    .media-title-pro a {
        color: #1a1d21;
        text-decoration: none;
        transition: color 0.3s ease;
        background: linear-gradient(135deg, #1a1d21, #2c3034);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .media-title-pro a:hover {
        background: linear-gradient(135deg, #4361ee, #7209b7);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .media-description-pro {
        color: #6c757d;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 0;
    }

    /* Métadonnées */
    .media-metadata-pro {
        margin: 1.5rem 0;
    }

    .metadata-grid-pro {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 1rem;
    }

    .metadata-item-pro {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.8rem;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-radius: 12px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .metadata-item-pro:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .metadata-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .metadata-value {
        font-size: 0.9rem;
        font-weight: 700;
        color: #1a1d21;
    }

    /* Tags */
    .media-tags-pro {
        display: flex;
        flex-wrap: wrap;
        gap: 0.6rem;
        margin-bottom: 1.5rem;
    }

    .tag-badge-pro {
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        letter-spacing: 0.3px;
        text-transform: uppercase;
    }

    .more-tags-pro {
        font-size: 0.8rem;
        color: #6c757d;
        align-self: center;
        font-weight: 700;
        background: #f8f9fa;
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
    }

    /* Footer */
    .content-footer-pro {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(0, 0, 0, 0.08);
        margin-top: auto;
    }

    .author-info {
        display: flex;
        align-items: center;
        gap: 0.8rem;
    }

    .author-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 1.1rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .author-details {
        display: flex;
        flex-direction: column;
    }

    .author-name {
        font-size: 0.9rem;
        font-weight: 800;
        color: #1a1d21;
    }

    .post-date {
        font-size: 0.8rem;
        color: #6c757d;
        font-weight: 600;
    }

    .price-tag-pro {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 900;
        color: #e17000;
        font-size: 1.1rem;
        background: linear-gradient(135deg, #fff3cd, #ffeaa7);
        padding: 0.6rem 1.2rem;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(225, 112, 0, 0.2);
    }

    .free-tag-pro {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-weight: 800;
        color: #198754;
        font-size: 0.95rem;
        background: linear-gradient(135deg, #d4edda, #c3e6cb);
        padding: 0.6rem 1.2rem;
        border-radius: 20px;
        box-shadow: 0 4px 15px rgba(25, 135, 84, 0.2);
    }

    /* Actions */
    .card-actions-pro {
        display: flex;
        gap: 1rem;
        padding: 1.5rem;
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-top: 1px solid rgba(0, 0, 0, 0.05);
    }

    .view-details-btn-pro {
        flex: 1;
        background: linear-gradient(135deg, #4361ee, #7209b7);
        color: white;
        border: none;
        padding: 1rem;
        border-radius: 12px;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.95rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
        position: relative;
        overflow: hidden;
    }

    .view-details-btn-pro::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .view-details-btn-pro:hover {
        background: linear-gradient(135deg, #7209b7, #4361ee);
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(67, 97, 238, 0.4);
        color: white;
    }

    .view-details-btn-pro:hover::before {
        left: 100%;
    }

    .quick-action-btn-pro {
        width: 50px;
        height: 50px;
        background: white;
        color: #6c757d;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .quick-action-btn-pro:hover {
        background: #4361ee;
        color: white;
        border-color: #4361ee;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
    }

    .favorite-btn.active {
        color: #dc3545;
        background: rgba(220, 53, 69, 0.1);
        border-color: #dc3545;
    }

    /* État vide */
    .empty-state-pro {
        text-align: center;
        padding: 5rem 2rem;
        background: white;
        border-radius: 30px;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        margin: 3rem 0;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .empty-state-content {
        max-width: 500px;
        margin: 0 auto;
    }

    .empty-state-icon-pro {
        font-size: 5rem;
        color: #4361ee;
        margin-bottom: 2rem;
        position: relative;
        display: inline-block;
    }

    .icon-glow-empty {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 120px;
        height: 120px;
        background: radial-gradient(circle, rgba(67, 97, 238, 0.2) 0%, transparent 70%);
        border-radius: 50%;
        animation: pulseGlow 2s infinite;
    }

    .empty-state-title-pro {
        font-size: 2.2rem;
        font-weight: 900;
        margin-bottom: 1rem;
        color: #1a1d21;
        background: linear-gradient(135deg, #1a1d21, #2c3034);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-state-text-pro {
        color: #6c757d;
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 2.5rem;
    }

    .empty-state-actions-pro {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-create-pro {
        background: linear-gradient(135deg, #4361ee, #7209b7);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 1rem;
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
    }

    .btn-create-pro:hover {
        background: linear-gradient(135deg, #7209b7, #4361ee);
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(67, 97, 238, 0.4);
        color: white;
    }

    .btn-login-pro {
        background: white;
        color: #4361ee;
        border: 2px solid #4361ee;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .btn-login-pro:hover {
        background: #4361ee;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
    }

    /* Pagination */
    .pagination-wrapper {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        margin-top: 3rem;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .pagination-wrapper .pagination {
        justify-content: center;
        margin: 0;
    }

    .pagination-wrapper .page-item .page-link {
        border: 2px solid #e9ecef;
        background: white;
        color: #495057;
        font-weight: 800;
        margin: 0 0.4rem;
        border-radius: 12px;
        transition: all 0.3s ease;
        padding: 0.8rem 1.2rem;
        min-width: 45px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .pagination-wrapper .page-item .page-link:hover {
        border-color: #4361ee;
        background: #4361ee;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
    }

    .pagination-wrapper .page-item.active .page-link {
        background: linear-gradient(135deg, #4361ee, #7209b7);
        border-color: #4361ee;
        color: white;
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
    }

    /* ===== ANIMATIONS ===== */
    @keyframes pulseGlow {
        0% { transform: translate(-50%, -50%) scale(1); opacity: 0.3; }
        50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.5; }
        100% { transform: translate(-50%, -50%) scale(1); opacity: 0.3; }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1200px) {
        .dashboard-container {
            max-width: 100%;
            padding: 0 1.5rem;
        }
        
        .media-grid-premium-pro {
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        }
    }

    @media (max-width: 992px) {
        .dashboard-container {
            margin-top: 90px;
            padding: 0 1rem;
        }
        
        .page-title {
            font-size: 2rem;
        }
        
        .stats-grid-premium {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .media-grid-premium-pro {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            margin-top: 80px;
        }
        
        .page-header {
            padding: 1.5rem;
            flex-direction: column;
            text-align: center;
            gap: 1.5rem;
        }
        
        .page-title {
            font-size: 1.8rem;
        }
        
        .stats-grid-premium {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .filter-body {
            padding: 1.5rem;
        }
        
        .filter-actions {
            flex-direction: column;
        }
        
        .media-grid-premium-pro {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .media-thumbnail-pro {
            height: 200px;
        }
        
        .overlay-content-pro {
            flex-direction: column;
            gap: 0.8rem;
        }
        
        .overlay-btn-pro {
            min-width: 140px;
        }
        
        .card-actions-pro {
            flex-direction: column;
        }
        
        .quick-action-btn-pro {
            width: 100%;
            height: 50px;
        }
    }

    @media (max-width: 480px) {
        .dashboard-container {
            padding: 0 0.8rem;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .page-subtitle {
            font-size: 0.9rem;
        }
        
        .btn-create-content {
            width: 100%;
            justify-content: center;
        }
        
        .filter-header {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }
        
        .metadata-grid-pro {
            grid-template-columns: 1fr;
        }
        
        .content-footer-pro {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
        
        .empty-state-title-pro {
            font-size: 1.8rem;
        }
        
        .empty-state-actions-pro {
            flex-direction: column;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des compteurs
        function animateCounter(element, start, end, duration) {
            let startTime = null;
            const step = (timestamp) => {
                if (!startTime) startTime = timestamp;
                const progress = Math.min((timestamp - startTime) / duration, 1);
                const value = Math.floor(progress * (end - start) + start);
                element.textContent = value.toLocaleString();
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }

        // Animer les compteurs de statistiques
        const totalCounter = document.getElementById('total-counter');
        if (totalCounter) {
            const total = parseInt(totalCounter.textContent.replace(/,/g, ''));
            animateCounter(totalCounter, 0, total, 1500);
        }

        const imagesCounter = document.getElementById('images-counter');
        if (imagesCounter) {
            const images = parseInt(imagesCounter.textContent.replace(/,/g, ''));
            setTimeout(() => animateCounter(imagesCounter, 0, images, 1200), 300);
        }

        const videosCounter = document.getElementById('videos-counter');
        if (videosCounter) {
            const videos = parseInt(videosCounter.textContent.replace(/,/g, ''));
            setTimeout(() => animateCounter(videosCounter, 0, videos, 1200), 600);
        }

        const audiosCounter = document.getElementById('audios-counter');
        if (audiosCounter) {
            const audios = parseInt(audiosCounter.textContent.replace(/,/g, ''));
            setTimeout(() => animateCounter(audiosCounter, 0, audios, 1200), 900);
        }

        // Animation des cartes au scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 150);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        });

        // Observer les cartes média
        document.querySelectorAll('.media-card-pro').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            observer.observe(card);
        });

        // Observer les cartes statistiques
        document.querySelectorAll('.stat-card-premium').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            card.style.transition = 'all 0.5s ease';
            observer.observe(card);
        });

        // Gestion des boutons favoris
        document.querySelectorAll('.favorite-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                const mediaId = this.getAttribute('data-media-id');
                const icon = this.querySelector('i');
                const isActive = this.classList.contains('active');
                
                // Animation du cœur
                if (isActive) {
                    this.classList.remove('active');
                    icon.classList.remove('bi-heart-fill');
                    icon.classList.add('bi-heart');
                    this.style.transform = 'scale(0.9)';
                    setTimeout(() => this.style.transform = '', 300);
                } else {
                    this.classList.add('active');
                    icon.classList.remove('bi-heart');
                    icon.classList.add('bi-heart-fill');
                    this.style.transform = 'scale(1.1)';
                    setTimeout(() => this.style.transform = '', 300);
                }
                
                // Envoyer la requête AJAX
                fetch('/api/media/' + mediaId + '/favorite', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify({
                        favorite: !isActive
                    })
                })
                .then(response => response.json())
                .then(data => {
                    showNotification(data.message, data.success ? 'success' : 'error');
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    // Revertir le changement visuel en cas d'erreur
                    if (isActive) {
                        this.classList.add('active');
                        icon.classList.remove('bi-heart');
                        icon.classList.add('bi-heart-fill');
                    } else {
                        this.classList.remove('active');
                        icon.classList.remove('bi-heart-fill');
                        icon.classList.add('bi-heart');
                    }
                    showNotification('Erreur lors de l\'ajout aux favoris', 'error');
                });
            });
        });

        // Animation des hover sur les cartes
        document.querySelectorAll('.media-card-pro').forEach(card => {
            card.addEventListener('mouseenter', function() {
                const shine = this.querySelector('.thumbnail-shine');
                if (shine) {
                    shine.style.left = '-100%';
                    setTimeout(() => {
                        shine.style.transition = 'none';
                        shine.style.left = '-100%';
                        setTimeout(() => {
                            shine.style.transition = 'left 0.8s';
                        }, 10);
                    }, 800);
                }
            });
        });

        // Effet de parallaxe sur les thumbnails
        document.querySelectorAll('.thumbnail-container-pro').forEach(container => {
            container.addEventListener('mousemove', function(e) {
                const img = this.querySelector('.media-image-pro');
                const x = e.clientX - this.getBoundingClientRect().left;
                const y = e.clientY - this.getBoundingClientRect().top;
                
                const moveX = (x / this.offsetWidth - 0.5) * 15;
                const moveY = (y / this.offsetHeight - 0.5) * 15;
                
                img.style.transform = `scale(1.1) translate(${moveX}px, ${moveY}px)`;
            });
            
            container.addEventListener('mouseleave', function() {
                const img = this.querySelector('.media-image-pro');
                img.style.transform = 'scale(1) translate(0, 0)';
            });
        });

        // Fonction de notification
        function showNotification(message, type = 'success') {
            const notification = document.createElement('div');
            notification.className = `notification-pro ${type}`;
            notification.innerHTML = `
                <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill'}"></i>
                <span>${message}</span>
            `;
            document.body.appendChild(notification);
            
            setTimeout(() => notification.classList.add('show'), 10);
            setTimeout(() => {
                notification.classList.remove('show');
                setTimeout(() => notification.remove(), 300);
            }, 3000);
        }

        // Styles pour les notifications
        const style = document.createElement('style');
        style.textContent = `
            .notification-pro {
                position: fixed;
                top: 30px;
                right: 30px;
                background: white;
                padding: 1.2rem 1.8rem;
                border-radius: 15px;
                box-shadow: 
                    0 15px 40px rgba(0, 0, 0, 0.15),
                    0 0 0 1px rgba(0, 0, 0, 0.05);
                display: flex;
                align-items: center;
                gap: 1rem;
                z-index: 9999;
                transform: translateX(100%) scale(0.9);
                opacity: 0;
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(0, 0, 0, 0.05);
            }
            
            .notification-pro.show {
                transform: translateX(0) scale(1);
                opacity: 1;
            }
            
            .notification-pro.success {
                border-left: 5px solid #10b981;
                background: linear-gradient(135deg, #ffffff, #f8fdf9);
            }
            
            .notification-pro.error {
                border-left: 5px solid #ef4444;
                background: linear-gradient(135deg, #ffffff, #fdf8f8);
            }
            
            .notification-pro i {
                font-size: 1.4rem;
            }
            
            .notification-pro.success i {
                color: #10b981;
            }
            
            .notification-pro.error i {
                color: #ef4444;
            }
            
            .notification-pro span {
                font-weight: 700;
                color: #1f2937;
                font-size: 0.95rem;
            }
        `;
        document.head.appendChild(style);
    });
</script>
@endsection