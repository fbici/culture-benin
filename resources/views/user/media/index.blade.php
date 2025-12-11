@extends('layouts.app')

@section('title', 'Mes Médias - Culture Benin')

@section('content')
<div class="medias-container">
    <!-- En-tête Premium -->
    <div class="page-header-premium">
        <div class="header-gradient"></div>
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="header-content">
                        <div class="header-icon-wrapper">
                            <i class="bi bi-images"></i>
                            <div class="icon-glow"></div>
                        </div>
                        <h1 class="header-title">
                            Gestion des <span class="text-gradient">Médias</span>
                        </h1>
                        <p class="header-subtitle">
                            Gérez et organisez votre collection multimédia. <br>
                            Visualisez vos statistiques et optimisez votre contenu.
                        </p>
                        <div class="header-actions">
                            <a href="{{ route('user.medias.create') }}" class="btn-upload-premium">
                                <i class="bi bi-cloud-arrow-up-fill"></i>
                                <span>Nouveau Média</span>
                                <div class="btn-shine"></div>
                            </a>
                            <a href="{{ route('user.dashboard') }}" class="btn-dashboard-premium">
                                <i class="bi bi-arrow-left-circle-fill"></i>
                                <span>Retour Dashboard</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="header-stats">
                        <div class="stats-grid">
                            <!-- Stat Total -->
                            <div class="stat-card total">
                                <div class="stat-icon">
                                    <i class="bi bi-stack"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number" id="totalCounter">{{ $medias->total() }}</div>
                                    <div class="stat-label">Total Médias</div>
                                </div>
                                <div class="stat-trend">
                                    <i class="bi bi-graph-up-arrow"></i>
                                    <span>+{{ min(12, $medias->total()) }}%</span>
                                </div>
                            </div>
                            
                            <!-- Stat Affichés -->
                            <div class="stat-card displayed">
                                <div class="stat-icon">
                                    <i class="bi bi-eye-fill"></i>
                                </div>
                                <div class="stat-info">
                                    <div class="stat-number" id="displayedCounter">{{ $medias->count() }}</div>
                                    <div class="stat-label">Affichés</div>
                                </div>
                                <div class="stat-progress">
                                    <div class="progress-bar" style="width: {{ $medias->total() > 0 ? ($medias->count() / $medias->total()) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                            
                            <!-- Stat Images -->
                            <div class="stat-card images">
                                <div class="stat-icon">
                                    <i class="bi bi-image-fill"></i>
                                </div>
                                <div class="stat-info">
                                    @php
                                        $imagesCount = $medias->where('typeMedia.nom', 'Image')->count();
                                    @endphp
                                    <div class="stat-number" id="imagesCounter">{{ $imagesCount }}</div>
                                    <div class="stat-label">Images</div>
                                </div>
                                <div class="stat-progress">
                                    <div class="progress-bar" style="width: {{ $medias->count() > 0 ? ($imagesCount / $medias->count()) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                            
                            <!-- Stat Vidéos -->
                            <div class="stat-card videos">
                                <div class="stat-icon">
                                    <i class="bi bi-camera-video-fill"></i>
                                </div>
                                <div class="stat-info">
                                    @php
                                        $videosCount = $medias->where('typeMedia.nom', 'Vidéo')->count();
                                    @endphp
                                    <div class="stat-number" id="videosCounter">{{ $videosCount }}</div>
                                    <div class="stat-label">Vidéos</div>
                                </div>
                                <div class="stat-progress">
                                    <div class="progress-bar" style="width: {{ $medias->count() > 0 ? ($videosCount / $medias->count()) * 100 : 0 }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres Premium -->
    <div class="filters-section-premium">
        <div class="container-fluid">
            <div class="filters-grid">
                <!-- Recherche -->
                <div class="search-container-premium">
                    <i class="bi bi-search search-icon"></i>
                    <input type="text" 
                           class="search-input-premium" 
                           placeholder="Rechercher un média..." 
                           id="searchMedia" 
                           value="{{ request('search') }}"
                           onkeypress="if(event.key === 'Enter') applyFilters()">
                    <button class="search-btn-premium" onclick="applyFilters()">
                        <i class="bi bi-arrow-right"></i>
                    </button>
                </div>
                
                <!-- Filtres Rapides -->
                <div class="quick-filters">
                    <div class="filter-tabs">
                        <button class="filter-tab active" data-filter="">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                            <span>Tous</span>
                        </button>
                        @foreach($typesMedia as $type)
                        <button class="filter-tab" data-filter="{{ $type->id_type_media }}">
                            @php
                                $typeIcons = [
                                    'Image' => 'image-fill',
                                    'Vidéo' => 'camera-video-fill',
                                    'Audio' => 'music-note-beamed',
                                    'PDF' => 'file-earmark-pdf-fill',
                                    'Document' => 'file-earmark-text-fill'
                                ];
                                $typeIcon = $typeIcons[$type->nom] ?? 'file-earmark-fill';
                            @endphp
                            <i class="bi bi-{{ $typeIcon }}"></i>
                            <span>{{ $type->nom }}</span>
                        </button>
                        @endforeach
                        <button class="filter-tab" data-filter="recent">
                            <i class="bi bi-clock-fill"></i>
                            <span>Récents</span>
                        </button>
                    </div>
                </div>
                
                <!-- Options d'affichage -->
                <div class="view-options-premium">
                    <div class="view-switch">
                        <button class="view-btn active" id="viewGridBtn" title="Vue grille">
                            <i class="bi bi-grid-3x3-gap-fill"></i>
                        </button>
                        <button class="view-btn" id="viewListBtn" title="Vue liste">
                            <i class="bi bi-list-ul"></i>
                        </button>
                    </div>
                    <select class="select-premium" id="filterType">
                        <option value="">Trier par</option>
                        <option value="recent" {{ request('sort') == 'recent' ? 'selected' : '' }}>Plus récent</option>
                        <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Plus ancien</option>
                        <option value="downloads" {{ request('sort') == 'downloads' ? 'selected' : '' }}>Téléchargements</option>
                        <option value="name_asc" {{ request('sort') == 'name_asc' ? 'selected' : '' }}>Nom A-Z</option>
                        <option value="name_desc" {{ request('sort') == 'name_desc' ? 'selected' : '' }}>Nom Z-A</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <!-- Vue Grille Premium -->
    <div id="mediaGridView" class="media-grid-premium">
        @forelse($medias as $media)
        <div class="media-card-pro">
            <!-- Header avec badges -->
            <div class="card-header-pro">
                <div class="header-left">
                    @php
                        $mediaType = $media->typeMedia->nom ?? 'Document';
                        $typeColors = [
                            'Image' => '#4361ee',
                            'Vidéo' => '#f72585',
                            'Audio' => '#7209b7',
                            'PDF' => '#f8961e',
                            'Document' => '#43aa8b'
                        ];
                        $typeColor = $typeColors[$mediaType] ?? '#6b7280';
                        $typeBg = $typeColor . '20';
                        $typeIcons = [
                            'Image' => 'image-fill',
                            'Vidéo' => 'camera-video-fill',
                            'Audio' => 'music-note-beamed',
                            'PDF' => 'file-earmark-pdf-fill',
                            'Document' => 'file-earmark-text-fill'
                        ];
                        $typeIcon = $typeIcons[$mediaType] ?? 'file-earmark-fill';
                    @endphp
                    <span class="type-badge-pro" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                        <i class="bi bi-{{ $typeIcon }}"></i>
                        {{ $mediaType }}
                    </span>
                    @if($media->is_premium)
                    <span class="premium-badge-pro">
                        <i class="bi bi-star-fill"></i>
                        Premium
                    </span>
                    @endif
                </div>
                <div class="header-right">
                    @if($media->downloads > 0)
                    <span class="downloads-badge-pro">
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
                                    <a href="{{ route('user.medias.show', $media->id_media) }}" class="overlay-btn-pro view">
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
                    <div class="media-placeholder-pro" style="background: {{ $typeBg }}; border-color: {{ $typeColor }};">
                        <div class="placeholder-icon-pro" style="color: {{ $typeColor }};">
                            <i class="bi bi-{{ $typeIcon }}"></i>
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
                    <div class="media-placeholder-pro" style="background: {{ $typeBg }}; border-color: {{ $typeColor }};">
                        <div class="placeholder-icon-pro" style="color: {{ $typeColor }};">
                            <i class="bi bi-{{ $typeIcon }}"></i>
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
                        <a href="{{ route('user.medias.show', $media->id_media) }}">
                            {{ Str::limit($media->titre ?? 'Sans titre', 45) }}
                        </a>
                    </h3>
                    <p class="media-description-pro">
                        {{ Str::limit(strip_tags($media->description), 100) }}
                    </p>
                </div>

                <!-- Métadonnées -->
                <div class="media-metadata-pro">
                    <div class="metadata-grid-pro">
                        @if($media->resolution)
                        <div class="metadata-item-pro">
                            <div class="metadata-icon" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                <i class="bi bi-aspect-ratio"></i>
                            </div>
                            <span class="metadata-value">{{ $media->resolution }}</span>
                        </div>
                        @endif
                        
                        @if($media->duree_formatee && ($mediaType == 'Vidéo' || $mediaType == 'Audio'))
                        <div class="metadata-item-pro">
                            <div class="metadata-icon" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                <i class="bi bi-clock"></i>
                            </div>
                            <span class="metadata-value">{{ $media->duree_formatee }}</span>
                        </div>
                        @endif
                        
                        @if($media->taille_formatee)
                        <div class="metadata-item-pro">
                            <div class="metadata-icon" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                <i class="bi bi-hdd"></i>
                            </div>
                            <span class="metadata-value">{{ $media->taille_formatee }}</span>
                        </div>
                        @endif
                    </div>
                </div>

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

            <!-- Actions -->
            <div class="card-actions-pro">
                <a href="{{ route('user.medias.show', $media->id_media) }}" class="view-details-btn-pro">
                    <i class="bi bi-info-circle"></i>
                    <span>Détails</span>
                </a>
                <a href="{{ route('user.medias.edit', $media->id_media) }}" class="edit-btn-pro">
                    <i class="bi bi-pencil"></i>
                </a>
                <form action="{{ route('user.medias.destroy', $media->id_media) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn-pro" 
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce média ?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <!-- État vide Premium -->
        <div class="empty-state-premium">
            <div class="empty-state-content">
                <div class="empty-icon-premium">
                    <i class="bi bi-images"></i>
                    <div class="icon-glow-empty"></div>
                </div>
                <h3 class="empty-state-title">Aucun média trouvé</h3>
                <p class="empty-state-text">
                    @if(request()->hasAny(['type', 'search']))
                        Aucun média ne correspond à vos critères de recherche.
                    @else
                        Commencez par uploader votre premier média pour enrichir votre collection.
                    @endif
                </p>
                <div class="empty-state-actions">
                    <a href="{{ route('user.medias.create') }}" class="btn-create-premium">
                        <i class="bi bi-cloud-arrow-up-fill"></i>
                        <span>Uploader un média</span>
                    </a>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Vue Liste (cachée par défaut) -->
    <div id="mediaListView" class="media-list-premium" style="display: none;">
        @forelse($medias as $media)
        <div class="media-item-list-pro">
            <!-- Contenu similaire à la vue grille mais en format liste -->
            <!-- Vous pouvez adapter selon vos besoins -->
        </div>
        @empty
        <!-- Même état vide que ci-dessus -->
        @endforelse
    </div>

    <!-- Pagination Premium -->
    @if($medias->hasPages())
    <div class="pagination-premium">
        <div class="pagination-info">
            <span class="pagination-text">
                Affichage de <strong>{{ $medias->firstItem() }}</strong> à <strong>{{ $medias->lastItem() }}</strong>
                sur <strong>{{ $medias->total() }}</strong> médias
            </span>
        </div>
        <nav class="pagination-nav">
            {{ $medias->links() }}
        </nav>
    </div>
    @endif
</div>

<style>
    /* ===== STYLES GÉNÉRAUX ===== */
    .medias-container {
        max-width: 1400px;
        margin: 100px auto 40px;
        padding: 0 2rem;
    }

    /* ===== HEADER PREMIUM ===== */
    .page-header-premium {
        background: linear-gradient(135deg, #1a1d21, #2c3034);
        border-radius: 24px;
        padding: 3rem;
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.2),
            0 0 0 1px rgba(255, 255, 255, 0.1);
    }

    .header-gradient {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    }

    .header-content {
        position: relative;
        z-index: 2;
    }

    .header-icon-wrapper {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #ffc107, #ffda6a);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        color: #1a1d21;
        margin-bottom: 2rem;
        box-shadow: 0 15px 40px rgba(255, 193, 7, 0.3);
        position: relative;
    }

    .icon-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100px;
        height: 100px;
        background: radial-gradient(circle, rgba(255, 193, 7, 0.4) 0%, transparent 70%);
        border-radius: 50%;
        animation: pulseGlow 2s infinite;
    }

    .header-title {
        font-size: 3rem;
        font-weight: 900;
        color: white;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .text-gradient {
        background: linear-gradient(135deg, #ffc107, #ffda6a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .header-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.8);
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .header-actions {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .btn-upload-premium {
        background: linear-gradient(135deg, #4361ee, #7209b7);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 15px;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 30px rgba(67, 97, 238, 0.4);
        position: relative;
        overflow: hidden;
    }

    .btn-upload-premium:hover {
        background: linear-gradient(135deg, #7209b7, #4361ee);
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(67, 97, 238, 0.6);
        color: white;
    }

    .btn-shine {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .btn-upload-premium:hover .btn-shine {
        left: 100%;
    }

    .btn-dashboard-premium {
        background: rgba(255, 255, 255, 0.1);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.2);
        padding: 1rem 2rem;
        border-radius: 15px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .btn-dashboard-premium:hover {
        background: rgba(255, 255, 255, 0.2);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
        color: white;
    }

    /* ===== STATISTIQUES PREMIUM ===== */
    .header-stats {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 20px;
        padding: 1.5rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.5rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }

    .stat-card:hover {
        background: rgba(255, 255, 255, 0.12);
        transform: translateY(-3px);
        border-color: rgba(255, 255, 255, 0.1);
    }

    .stat-card.total {
        border-top: 4px solid #ffc107;
    }

    .stat-card.displayed {
        border-top: 4px solid #4361ee;
    }

    .stat-card.images {
        border-top: 4px solid #f72585;
    }

    .stat-card.videos {
        border-top: 4px solid #7209b7;
    }

    .stat-icon {
        font-size: 1.5rem;
        margin-bottom: 1rem;
        display: inline-block;
        padding: 0.8rem;
        border-radius: 12px;
        background: rgba(255, 255, 255, 0.1);
    }

    .stat-card.total .stat-icon { color: #ffc107; }
    .stat-card.displayed .stat-icon { color: #4361ee; }
    .stat-card.images .stat-icon { color: #f72585; }
    .stat-card.videos .stat-icon { color: #7209b7; }

    .stat-info {
        margin-bottom: 1rem;
    }

    .stat-number {
        font-size: 2.2rem;
        font-weight: 900;
        color: white;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .stat-label {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.7);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-trend {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        font-weight: 700;
        color: #10b981;
    }

    .stat-progress {
        height: 4px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 2px;
        overflow: hidden;
        margin-top: 0.5rem;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #ffc107, #ffda6a);
        border-radius: 2px;
        transition: width 1s ease-out;
    }

    .stat-card.displayed .progress-bar { background: linear-gradient(90deg, #4361ee, #7209b7); }
    .stat-card.images .progress-bar { background: linear-gradient(90deg, #f72585, #b5179e); }
    .stat-card.videos .progress-bar { background: linear-gradient(90deg, #7209b7, #560bad); }

    /* ===== FILTRES PREMIUM ===== */
    .filters-section-premium {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 3rem;
        box-shadow: 
            0 15px 50px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .filters-grid {
        display: grid;
        grid-template-columns: 2fr 3fr 1fr;
        gap: 2rem;
        align-items: center;
    }

    .search-container-premium {
        position: relative;
    }

    .search-input-premium {
        width: 100%;
        padding: 1rem 1.5rem 1rem 3.5rem;
        border: 2px solid #e9ecef;
        border-radius: 15px;
        font-size: 1rem;
        font-weight: 500;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .search-input-premium:focus {
        border-color: #4361ee;
        background: white;
        box-shadow: 
            0 0 0 4px rgba(67, 97, 238, 0.1),
            0 8px 25px rgba(67, 97, 238, 0.15);
        outline: none;
    }

    .search-icon {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6c757d;
        font-size: 1.2rem;
        pointer-events: none;
    }

    .search-btn-premium {
        position: absolute;
        right: 0.5rem;
        top: 50%;
        transform: translateY(-50%);
        background: linear-gradient(135deg, #4361ee, #7209b7);
        color: white;
        border: none;
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .search-btn-premium:hover {
        background: linear-gradient(135deg, #7209b7, #4361ee);
        transform: translateY(-50%) scale(1.1);
    }

    .quick-filters {
        overflow-x: auto;
        padding-bottom: 0.5rem;
    }

    .filter-tabs {
        display: flex;
        gap: 0.8rem;
        white-space: nowrap;
    }

    .filter-tab {
        background: white;
        border: 2px solid #e9ecef;
        color: #6c757d;
        padding: 0.8rem 1.2rem;
        border-radius: 15px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
        white-space: nowrap;
    }

    .filter-tab:hover {
        border-color: #4361ee;
        color: #4361ee;
        background: rgba(67, 97, 238, 0.05);
    }

    .filter-tab.active {
        background: linear-gradient(135deg, #4361ee, #7209b7);
        border-color: #4361ee;
        color: white;
        box-shadow: 0 5px 20px rgba(67, 97, 238, 0.3);
    }

    .view-options-premium {
        display: flex;
        gap: 1rem;
        align-items: center;
        justify-content: flex-end;
    }

    .view-switch {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 0.5rem;
        display: flex;
        gap: 0.5rem;
    }

    .view-btn {
        background: transparent;
        border: none;
        color: #6c757d;
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.2rem;
    }

    .view-btn:hover {
        background: rgba(67, 97, 238, 0.1);
        color: #4361ee;
    }

    .view-btn.active {
        background: linear-gradient(135deg, #4361ee, #7209b7);
        color: white;
        box-shadow: 0 4px 15px rgba(67, 97, 238, 0.3);
    }

    .select-premium {
        background: #f8f9fa;
        border: 2px solid #e9ecef;
        color: #495057;
        padding: 0.8rem 1.2rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        min-width: 160px;
    }

    .select-premium:focus {
        border-color: #4361ee;
        box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.1);
        outline: none;
    }

    /* ===== GRID MÉDIAS PRO ===== */
    .media-grid-premium {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
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
        gap: 0.5rem;
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
        gap: 0.5rem;
        box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
        letter-spacing: 0.5px;
    }

    .downloads-badge-pro {
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
        gap: 0.5rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.95rem;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
        position: relative;
        overflow: hidden;
    }

    .view-details-btn-pro:hover {
        background: linear-gradient(135deg, #7209b7, #4361ee);
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(67, 97, 238, 0.4);
        color: white;
    }

    .edit-btn-pro,
    .delete-btn-pro {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 1.2rem;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .edit-btn-pro {
        background: linear-gradient(135deg, #ffc107, #ffda6a);
        color: #1a1d21;
        text-decoration: none;
    }

    .delete-btn-pro {
        background: linear-gradient(135deg, #dc3545, #e35d6a);
        color: white;
    }

    .edit-btn-pro:hover {
        background: linear-gradient(135deg, #ffda6a, #ffc107);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3);
    }

    .delete-btn-pro:hover {
        background: linear-gradient(135deg, #e35d6a, #dc3545);
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(220, 53, 69, 0.3);
    }

    /* ===== ÉTAT VIDE PREMIUM ===== */
    .empty-state-premium {
        background: white;
        border-radius: 24px;
        padding: 5rem 2rem;
        text-align: center;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        border: 2px dashed #e9ecef;
        grid-column: 1 / -1;
        margin: 2rem 0;
    }

    .empty-state-content {
        max-width: 500px;
        margin: 0 auto;
    }

    .empty-icon-premium {
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

    .empty-state-title {
        font-size: 2.2rem;
        font-weight: 900;
        margin-bottom: 1rem;
        color: #1a1d21;
        background: linear-gradient(135deg, #1a1d21, #2c3034);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-state-text {
        color: #6c757d;
        font-size: 1.1rem;
        line-height: 1.7;
        margin-bottom: 2.5rem;
    }

    .empty-state-actions {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-create-premium {
        background: linear-gradient(135deg, #4361ee, #7209b7);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 1rem;
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
    }

    .btn-create-premium:hover {
        background: linear-gradient(135deg, #7209b7, #4361ee);
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(67, 97, 238, 0.4);
        color: white;
    }

    /* ===== PAGINATION PREMIUM ===== */
    .pagination-premium {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-top: 3rem;
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        border: 1px solid rgba(0, 0, 0, 0.05);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .pagination-info {
        color: #6c757d;
        font-size: 0.95rem;
        font-weight: 600;
    }

    .pagination-text strong {
        color: #1a1d21;
        font-weight: 800;
    }

    .pagination-nav .pagination {
        margin: 0;
    }

    .pagination-nav .page-item .page-link {
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

    .pagination-nav .page-item .page-link:hover {
        border-color: #4361ee;
        background: #4361ee;
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(67, 97, 238, 0.3);
    }

    .pagination-nav .page-item.active .page-link {
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

    @keyframes counterUp {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1200px) {
        .medias-container {
            padding: 0 1.5rem;
        }
        
        .filters-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .media-grid-premium {
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        }
    }

    @media (max-width: 992px) {
        .medias-container {
            margin-top: 90px;
        }
        
        .page-header-premium {
            padding: 2rem;
        }
        
        .header-title {
            font-size: 2.5rem;
        }
        
        .header-stats {
            margin-top: 2rem;
        }
        
        .header-actions {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .media-grid-premium {
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .medias-container {
            margin-top: 80px;
            padding: 0 1rem;
        }
        
        .page-header-premium {
            padding: 1.5rem;
            text-align: center;
        }
        
        .header-title {
            font-size: 2rem;
        }
        
        .header-icon-wrapper {
            margin: 0 auto 1.5rem;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .media-grid-premium {
            grid-template-columns: 1fr;
            gap: 1rem;
        }
        
        .content-footer-pro {
            flex-direction: column;
            gap: 1rem;
            align-items: flex-start;
        }
        
        .pagination-premium {
            flex-direction: column;
            gap: 1.5rem;
            text-align: center;
        }
    }

    @media (max-width: 576px) {
        .header-title {
            font-size: 1.8rem;
        }
        
        .btn-upload-premium,
        .btn-dashboard-premium {
            width: 100%;
            justify-content: center;
        }
        
        .filter-tabs {
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .view-options-premium {
            flex-direction: column;
            gap: 1rem;
        }
        
        .select-premium {
            width: 100%;
        }
        
        .metadata-grid-pro {
            grid-template-columns: 1fr;
        }
        
        .card-actions-pro {
            flex-direction: column;
        }
        
        .edit-btn-pro,
        .delete-btn-pro {
            width: 100%;
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
                } else {
                    element.style.animation = 'counterUp 0.5s ease-out';
                }
            };
            window.requestAnimationFrame(step);
        }

        // Animer les compteurs de statistiques
        const totalCounter = document.getElementById('totalCounter');
        if (totalCounter) {
            const total = parseInt(totalCounter.textContent.replace(/,/g, '')) || 0;
            animateCounter(totalCounter, 0, total, 1500);
        }

        const displayedCounter = document.getElementById('displayedCounter');
        if (displayedCounter) {
            const displayed = parseInt(displayedCounter.textContent.replace(/,/g, '')) || 0;
            setTimeout(() => animateCounter(displayedCounter, 0, displayed, 1200), 300);
        }

        const imagesCounter = document.getElementById('imagesCounter');
        if (imagesCounter) {
            const images = parseInt(imagesCounter.textContent.replace(/,/g, '')) || 0;
            setTimeout(() => animateCounter(imagesCounter, 0, images, 1200), 600);
        }

        const videosCounter = document.getElementById('videosCounter');
        if (videosCounter) {
            const videos = parseInt(videosCounter.textContent.replace(/,/g, '')) || 0;
            setTimeout(() => animateCounter(videosCounter, 0, videos, 1200), 900);
        }

        // Toggle entre vue grille et liste
        const viewGridBtn = document.getElementById('viewGridBtn');
        const viewListBtn = document.getElementById('viewListBtn');
        const mediaGridView = document.getElementById('mediaGridView');
        const mediaListView = document.getElementById('mediaListView');

        if (viewGridBtn && viewListBtn) {
            viewGridBtn.addEventListener('click', function() {
                this.classList.add('active');
                viewListBtn.classList.remove('active');
                mediaGridView.style.display = 'grid';
                mediaListView.style.display = 'none';
            });

            viewListBtn.addEventListener('click', function() {
                this.classList.add('active');
                viewGridBtn.classList.remove('active');
                mediaGridView.style.display = 'none';
                mediaListView.style.display = 'block';
            });
        }

        // Filtrage
        const filterTabs = document.querySelectorAll('.filter-tab');
        const filterType = document.getElementById('filterType');
        const searchInput = document.getElementById('searchMedia');

        function applyFilters() {
            const type = filterType ? filterType.value : '';
            const search = searchInput ? searchInput.value : '';
            let url = '{{ url()->current() }}?';
            
            if (type) url += `type=${type}&`;
            if (search) url += `search=${encodeURIComponent(search)}&`;
            
            // Supprimer le dernier '&' si présent
            url = url.replace(/&$/, '');
            
            window.location.href = url;
        }

        if (filterTabs) {
            filterTabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    const filter = this.dataset.filter;
                    
                    // Mettre à jour l'état actif
                    filterTabs.forEach(t => t.classList.remove('active'));
                    this.classList.add('active');
                    
                    if (filterType) {
                        filterType.value = filter;
                        applyFilters();
                    }
                });
            });
        }

        if (filterType) {
            filterType.addEventListener('change', applyFilters);
        }

        if (searchInput) {
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') applyFilters();
            });
        }

        // Animation des cartes au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observer les cartes média
        document.querySelectorAll('.media-card-pro').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            observer.observe(card);
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

        // Confirmation de suppression
        document.querySelectorAll('.delete-btn-pro').forEach(btn => {
            btn.addEventListener('click', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer ce média ?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection