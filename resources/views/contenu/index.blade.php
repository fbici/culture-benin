@extends('layouts.app')

@section('title', 'Contenus Culturels - Culture Benin')

@section('content')
<div class="dashboard-container">

    <!-- Header principal AMÉLIORÉ -->
    <div class="page-header premium-header mb-6">
        <div class="header-background"></div>
        <div class="header-content-wrapper">
            <div class="header-main">
                <div class="header-icon-wrapper">
                    <i class="bi bi-journal-richtext text-orange"></i>
                    <div class="icon-glow"></div>
                </div>
                <div class="header-text-wrapper">
                    <h1 class="page-title premium-title">
                        Contenus Culturels
                    </h1>
                    <p class="page-subtitle premium-subtitle">
                        Explorez notre riche collection de contenus sur le patrimoine culturel béninois
                    </p>
                </div>
            </div>
            @auth
            <div class="create-btn-wrapper premium">
                <a href="{{ route('user.contenus.create') }}" class="btn-create-content premium-btn">
                    <i class="bi bi-plus-circle-fill me-2"></i>
                    <span class="d-none d-md-inline">Créer un contenu</span>
                    <span class="d-md-none">Créer</span>
                    <div class="btn-hover-effect"></div>
                </a>
            </div>
            @endauth
        </div>
        <div class="header-wave">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35,6.36,119.13-6.25,37.73-12.56,74.29-35.79,111-52.34,43.75-20.29,87.93-40.76,131.08-60.27,43.15-19.51,86.3-39,129.45-58.48,43.15-19.49,86.3-38.98,129.45-58.46V0Z" opacity=".5" fill="currentColor"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <!-- Filtres améliorés avec style premium -->
    <div class="filter-card premium-filters mb-6">
        <div class="filter-header premium">
            <div class="filter-icon-wrapper">
                <i class="bi bi-funnel-fill"></i>
                <div class="filter-icon-glow"></div>
            </div>
            <div class="filter-title-wrapper">
                <h5 class="filter-title">Filtrer les contenus</h5>
                <p class="filter-subtitle">Affinez votre recherche selon vos critères</p>
            </div>
        </div>
        <div class="filter-body premium">
            <form action="{{ route('contenus.index') }}" method="GET" class="row g-4">
                <div class="col-xl-3 col-md-6">
                    <div class="filter-group premium">
                        <label class="filter-label premium">
                            <i class="bi bi-tag-fill me-2"></i>
                            Type de contenu
                        </label>
                        <div class="select-wrapper">
                            <select name="type" class="filter-select premium">
                                <option value="">Tous les types</option>
                                @foreach($types as $type)
                                    <option value="{{ $type->id_type_contenu }}" {{ request('type') == $type->id_type_contenu ? 'selected' : '' }}>
                                        {{ $type->nom_type }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="bi bi-chevron-down select-arrow"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="filter-group premium">
                        <label class="filter-label premium">
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            Région
                        </label>
                        <div class="select-wrapper">
                            <select name="region" class="filter-select premium">
                                <option value="">Toutes les régions</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id_region }}" {{ request('region') == $region->id_region ? 'selected' : '' }}>
                                        {{ $region->nom_region }}
                                    </option>
                                @endforeach
                            </select>
                            <i class="bi bi-chevron-down select-arrow"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="filter-group premium">
                        <label class="filter-label premium">
                            <i class="bi bi-chat-left-text-fill me-2"></i>
                            Langue
                        </label>
                        <div class="select-wrapper">
                            <select name="langue" class="filter-select premium">
                                <option value="">Toutes les langues</option>
                                @foreach($langues as $langue)
                                    <option value="{{ $langue->id_langue }}" {{ request('langue') == $langue->id_langue ? 'selected' : '' }}>
                                        {{ $langue->nom_langue }} ({{ $langue->code_langue }})
                                    </option>
                                @endforeach
                            </select>
                            <i class="bi bi-chevron-down select-arrow"></i>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="filter-group premium">
                        <label class="filter-label premium">
                            <i class="bi bi-file-earmark-text-fill me-2"></i>
                            Statut
                        </label>
                        <div class="select-wrapper">
                            <select name="statut" class="filter-select premium">
                                <option value="">Tous les statuts</option>
                                <option value="publié" {{ request('statut') == 'publié' ? 'selected' : '' }}>Publié</option>
                                <option value="en_attente" {{ request('statut') == 'en_attente' ? 'selected' : '' }}>En attente</option>
                                <option value="brouillon" {{ request('brouillon') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                            </select>
                            <i class="bi bi-chevron-down select-arrow"></i>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="filter-actions premium">
                        <button type="submit" class="btn-apply-filters premium">
                            <i class="bi bi-funnel-fill me-2"></i>
                            Appliquer les filtres
                            <div class="btn-sparkle"></div>
                        </button>
                        <a href="{{ route('contenus.index') }}" class="btn-reset-filters premium">
                            <i class="bi bi-x-circle-fill me-2"></i>
                            Réinitialiser
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Statistiques avec design amélioré -->
    <div class="stats-section mb-6">
        <div class="stats-title">
            <i class="bi bi-bar-chart-fill me-2"></i>
            <h4>Aperçu des contenus</h4>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card-mini premium">
                    <div class="stat-icon-mini premium" style="background: linear-gradient(135deg, #198754, #20c997);">
                        <i class="bi bi-journal-text"></i>
                        <div class="icon-pulse"></div>
                    </div>
                    <div class="stat-content-mini">
                        <h4 class="stat-number-mini">{{ $contenus->total() }}</h4>
                        <p class="stat-label-mini">Contenus au total</p>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card-mini premium">
                    <div class="stat-icon-mini premium" style="background: linear-gradient(135deg, #0d6efd, #6ea8fe);">
                        <i class="bi bi-check-circle-fill"></i>
                        <div class="icon-pulse"></div>
                    </div>
                    <div class="stat-content-mini">
                        @php
                            $publiés = $contenus->where('statut', 'publie')->count();
                        @endphp
                        <h4 class="stat-number-mini">{{ $publiés }}</h4>
                        <p class="stat-label-mini">Contenus publiés</p>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: {{ $contenus->total() > 0 ? ($publiés / $contenus->total()) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card-mini premium">
                    <div class="stat-icon-mini premium" style="background: linear-gradient(135deg, #ffc107, #ffda6a);">
                        <i class="bi bi-clock-history"></i>
                        <div class="icon-pulse"></div>
                    </div>
                    <div class="stat-content-mini">
                        @php
                            $enAttente = $contenus->where('statut', 'en_attente')->count();
                        @endphp
                        <h4 class="stat-number-mini">{{ $enAttente }}</h4>
                        <p class="stat-label-mini">En attente</p>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: {{ $contenus->total() > 0 ? ($enAttente / $contenus->total()) * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card-mini premium">
                    <div class="stat-icon-mini premium" style="background: linear-gradient(135deg, #6f42c1, #a370f7);">
                        <i class="bi bi-people-fill"></i>
                        <div class="icon-pulse"></div>
                    </div>
                    <div class="stat-content-mini">
                        @php
                            $auteurs = $contenus->unique('id_auteur')->count();
                        @endphp
                        <h4 class="stat-number-mini">{{ $auteurs }}</h4>
                        <p class="stat-label-mini">Auteurs différents</p>
                        <div class="stat-progress">
                            <div class="progress-bar" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Liste des contenus avec design premium -->
    @if($contenus->count() > 0)
        <div class="content-grid premium">
            @foreach($contenus as $contenu)
                @php
                    $colorIndex = $contenu->id_contenu % 6;
                    $headerColors = [
                        'linear-gradient(135deg, #e17000, #ff8c00, #ffa94d)',
                        'linear-gradient(135deg, #008000, #00a000, #20c997)',
                        'linear-gradient(135deg, #0d6efd, #6ea8fe, #9ec5fe)',
                        'linear-gradient(135deg, #6f42c1, #a370f7, #c29ffa)',
                        'linear-gradient(135deg, #dc3545, #e6858f, #f1b0b7)',
                        'linear-gradient(135deg, #17a2b8, #5dc6d4, #8fd9e8)'
                    ];
                    
                    $regionColors = [
                        'Atacora' => '#e17000',
                        'Donga' => '#008000',
                        'Borgou' => '#0d6efd',
                        'Alibori' => '#6f42c1',
                        'Collines' => '#dc3545',
                        'Zou' => '#17a2b8',
                        'Plateau' => '#20c997',
                        'Ouémé' => '#ffc107',
                        'Atlantique' => '#fd7e14',
                        'Littoral' => '#6f42c1',
                        'Mono' => '#e83e8c',
                        'Couffo' => '#6610f2'
                    ];
                    
                    $headerColor = $regionColors[$contenu->region->nom_region ?? ''] ?? $headerColors[$colorIndex];
                    
                    $typeIcons = [
                        'Article' => 'bi-journal-text',
                        'Vidéo' => 'bi-camera-video-fill',
                        'Audio' => 'bi-mic-fill',
                        'Image' => 'bi-image-fill',
                        'Document' => 'bi-file-earmark-text-fill',
                        'Livre' => 'bi-book-fill'
                    ];
                    
                    $typeIcon = $typeIcons[$contenu->typeContenu->nom_type ?? 'Article'] ?? 'bi-journal-text';
                @endphp
            
            <div class="content-card premium">
                <!-- EN-TÊTE COLORÉE AMÉLIORÉE -->
                <div class="content-card-header premium" style="background: {{ $headerColor }};">
                    <div class="header-shine"></div>
                    <div class="header-content premium">
                        <div class="header-icon premium">
                            <i class="bi {{ $typeIcon }}"></i>
                            <div class="icon-halo"></div>
                        </div>
                        <div class="header-text premium">
                            <h3 class="content-title premium">{{ $contenu->titre }}</h3>
                            <div class="header-subtitle premium">
                                <span class="header-badge premium">
                                    <i class="bi bi-tag-fill me-1"></i>
                                    {{ $contenu->typeContenu->nom_type ?? 'Article' }}
                                </span>
                                @if($contenu->region->nom_region ?? false)
                                <span class="header-badge region-badge premium">
                                    <i class="bi bi-geo-alt-fill me-1"></i>
                                    {{ $contenu->region->nom_region }}
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="header-corner">
                        <div class="corner-ribbon"></div>
                    </div>
                </div>

                <!-- Corps de la carte amélioré -->
                <div class="content-card-body premium">
                    <div class="content-excerpt premium">
                        <div class="excerpt-icon">
                            <i class="bi bi-quote"></i>
                        </div>
                        {{ Str::limit(strip_tags($contenu->texte), 120) }}
                    </div>

                    <!-- MÉTADONNÉES AVEC DESIGN PREMIUM -->
                    <div class="metadata-grid premium">
                        <div class="metadata-item premium">
                            <div class="metadata-icon premium">
                                <i class="bi bi-person-circle"></i>
                                <div class="icon-dot"></div>
                            </div>
                            <div class="metadata-content premium">
                                <div class="metadata-label premium">Auteur</div>
                                <div class="metadata-value premium"> {{ $contenu->auteur->nom ?? '' }}</div>
                            </div>
                        </div>
                        
                        <div class="metadata-item premium">
                            <div class="metadata-icon premium">
                                <i class="bi bi-chat-left-text-fill"></i>
                                <div class="icon-dot"></div>
                            </div>
                            <div class="metadata-content premium">
                                <div class="metadata-label premium">Langue</div>
                                <div class="metadata-value premium">{{ $contenu->langue->nom_langue ?? 'Non spécifiée' }}</div>
                            </div>
                        </div>
                        
                        <div class="metadata-item premium">
                            <div class="metadata-icon premium">
                                <i class="bi bi-calendar-event-fill"></i>
                                <div class="icon-dot"></div>
                            </div>
                            <div class="metadata-content premium">
                                <div class="metadata-label premium">Date</div>
                                <div class="metadata-value premium">{{ $contenu->date_creation ? $contenu->date_creation->format('d/m/Y') : $contenu->created_at->format('d/m/Y') }}</div>
                            </div>
                        </div>
                        
                        <div class="metadata-item premium">
                            <div class="metadata-icon premium">
                                <i class="bi bi-eye-fill"></i>
                                <div class="icon-dot"></div>
                            </div>
                            <div class="metadata-content premium">
                                <div class="metadata-label premium">Statut</div>
                                <div class="metadata-value status-badge status-{{ $contenu->statut }} premium">
                                    <i class="bi bi-circle-fill me-1"></i>
                                    {{ $contenu->statut }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Actions améliorées -->
                    <div class="content-actions premium">
                        <a href="{{ route('contenus.show', $contenu->id_contenu) }}" class="btn-view-content premium">
                            <i class="bi bi-eye-fill me-1"></i>
                            Voir le contenu
                            <div class="btn-arrow">
                                <i class="bi bi-arrow-right"></i>
                            </div>
                        </a>
                        
                        @auth
                            @if(auth()->id() == $contenu->id_auteur)
                            <div class="dropdown premium">
                                <button class="btn-action-dropdown premium" data-bs-toggle="dropdown">
                                    <i class="bi bi-three-dots-vertical"></i>
                                    <div class="dropdown-dots">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </button>
                                <ul class="dropdown-menu premium">
                                    <li>
                                        <a href="{{ route('user.contenus.edit', $contenu->id_contenu) }}" class="dropdown-item premium">
                                            <i class="bi bi-pencil-fill me-2"></i>Modifier
                                        </a>
                                    </li>
                                    <li>
                                        <form action="{{ route('user.contenus.destroy', $contenu->id_contenu) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger premium" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contenu ?')">
                                                <i class="bi bi-trash-fill me-2"></i>Supprimer
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        @endauth
                    </div>
                </div>

                <!-- Footer amélioré -->
                <div class="content-card-footer premium">
                    <div class="footer-left">
                        <span class="update-time premium">
                            <i class="bi bi-clock-history me-1"></i>
                            {{ $contenu->updated_at->diffForHumans() }}
                        </span>
                    </div>
                    @if($contenu->id_moderateur)
                    <div class="footer-right">
                        <span class="moderated-badge premium">
                            <i class="bi bi-shield-check me-1"></i>
                            Modéré
                        </span>
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination premium -->
        <div class="pagination-wrapper premium mt-6">
            {{ $contenus->links() }}
        </div>
    @else
        <!-- État vide premium -->
        <div class="empty-state premium">
            <div class="empty-state-container">
                <div class="empty-state-icon premium">
                    <i class="bi bi-journal-x"></i>
                    <div class="icon-ripple"></div>
                </div>
                <h3 class="empty-state-title premium">Aucun contenu trouvé</h3>
                <p class="empty-state-text premium">
                    @if(request()->hasAny(['type', 'region', 'langue', 'statut']))
                        Aucun contenu ne correspond à vos critères de recherche.
                    @else
                        Soyez le premier à créer un contenu et à enrichir notre collection culturelle !
                    @endif
                </p>
                <div class="empty-state-actions premium">
                    @if(request()->hasAny(['type', 'region', 'langue', 'statut']))
                        <a href="{{ route('contenus.index') }}" class="btn btn-outline-premium">
                            <i class="bi bi-x-circle-fill me-2"></i>
                            Réinitialiser les filtres
                        </a>
                    @endif
                    @auth
                    <a href="{{ route('user.contenus.create') }}" class="btn btn-premium">
                        <i class="bi bi-plus-circle-fill me-2"></i>
                        Créer un contenu
                    </a>
                    @endauth
                </div>
            </div>
            <div class="empty-state-wave">
                <svg viewBox="0 0 500 150" preserveAspectRatio="none">
                    <path d="M0.00,49.98 C149.99,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: #f8f9fa;"></path>
                </svg>
            </div>
        </div>
    @endif
</div>

<style>
    /* ===== STYLES GÉNÉRAUX AMÉLIORÉS ===== */
    .dashboard-container {
        max-width: 1400px;
        margin: 100px auto 60px;
        padding: 0 2rem;
        position: relative;
    }

    /* Animation d'entrée */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .dashboard-container > * {
        animation: fadeInUp 0.6s ease-out;
    }

    /* ===== HEADER PRINCIPAL PREMIUM ===== */
    .page-header.premium-header {
        background: linear-gradient(135deg, #1a237e 0%, #283593 50%, #3949ab 100%);
        border-radius: 24px;
        padding: 2.5rem 2.5rem 4rem;
        box-shadow: 0 20px 60px rgba(26, 35, 126, 0.25);
        position: relative;
        overflow: hidden;
        margin-bottom: 3rem;
        border: none;
        border-left: 0;
    }

    .header-background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
        z-index: 1;
    }

    .header-content-wrapper {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .header-main {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        flex: 1;
    }

    .header-icon-wrapper {
        position: relative;
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .header-icon-wrapper .bi {
        font-size: 2rem;
        color: white;
        z-index: 2;
    }

    .icon-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        background: radial-gradient(circle, rgba(225, 112, 0, 0.4) 0%, transparent 70%);
        border-radius: 50%;
        z-index: 1;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0% { transform: translate(-50%, -50%) scale(1); opacity: 0.4; }
        50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.6; }
        100% { transform: translate(-50%, -50%) scale(1); opacity: 0.4; }
    }

    .header-text-wrapper {
        flex: 1;
    }

    .page-title.premium-title {
        font-size: 2.4rem;
        font-weight: 900;
        color: white;
        margin-bottom: 0.8rem;
        line-height: 1.2;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .page-subtitle.premium-subtitle {
        font-size: 1.1rem;
        color: rgba(1, 1, 1, 0.9);
        margin: 0;
        line-height: 1.5;
        max-width: 600px;
        font-weight: 900;
    }

    .header-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 120px;
        color: #f8f9fa;
        z-index: 1;
    }

    .header-wave svg {
        width: 100%;
        height: 100%;
        fill: currentColor;
    }

    /* Bouton créer premium */
    .create-btn-wrapper.premium {
        flex-shrink: 0;
    }

    .btn-create-content.premium-btn {
        background: linear-gradient(135deg, #ff6b35 0%, #ff8c00 100%);
        color: white;
        border: none;
        padding: 1rem 1.8rem;
        border-radius: 15px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 
            0 10px 30px rgba(255, 107, 53, 0.3),
            0 0 0 1px rgba(255, 255, 255, 0.1) inset;
        font-size: 1rem;
        position: relative;
        overflow: hidden;
    }

    .btn-create-content.premium-btn:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 
            0 15px 40px rgba(255, 107, 53, 0.4),
            0 0 0 1px rgba(255, 255, 255, 0.2) inset;
        color: white;
    }

    .btn-hover-effect {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn-create-content.premium-btn:hover .btn-hover-effect {
        left: 100%;
    }

    /* ===== FILTRES PREMIUM ===== */
    .filter-card.premium-filters {
        background: white;
        border-radius: 24px;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        overflow: hidden;
        margin-bottom: 3rem;
        border: none;
    }

    .filter-header.premium {
        background: linear-gradient(135deg, #00897b 0%, #00695c 100%);
        color: white;
        padding: 1.8rem 2.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .filter-icon-wrapper {
        position: relative;
        width: 50px;
        height: 50px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(5px);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
    }

    .filter-icon-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 60px;
        height: 60px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.2) 0%, transparent 70%);
        border-radius: 50%;
    }

    .filter-title-wrapper {
        flex: 1;
    }

    .filter-title {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 700;
    }

    .filter-subtitle {
        margin: 0.3rem 0 0;
        font-size: 0.9rem;
        opacity: 0.9;
    }

    .filter-body.premium {
        padding: 2.5rem;
    }

    .filter-group.premium {
        margin-bottom: 1rem;
    }

    .filter-label.premium {
        display: flex;
        align-items: center;
        margin-bottom: 0.8rem;
        font-weight: 700;
        color: #2d3748;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .select-wrapper {
        position: relative;
    }

    .filter-select.premium {
        width: 100%;
        padding: 0.9rem 1.2rem 0.9rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        background: white;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 0.95rem;
        appearance: none;
        cursor: pointer;
        background-image: none;
    }

    .filter-select.premium:focus {
        border-color: #00897b;
        box-shadow: 
            0 0 0 4px rgba(0, 137, 123, 0.1),
            0 4px 20px rgba(0, 137, 123, 0.1);
        outline: none;
        transform: translateY(-2px);
    }

    .select-arrow {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #718096;
        pointer-events: none;
        font-size: 0.9rem;
    }

    .filter-actions.premium {
        display: flex;
        gap: 1.2rem;
        margin-top: 2rem;
    }

    .btn-apply-filters.premium {
        background: linear-gradient(135deg, #00897b 0%, #00695c 100%);
        color: white;
        border: none;
        padding: 0.9rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        font-size: 1rem;
        position: relative;
        overflow: hidden;
    }

    .btn-apply-filters.premium:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(0, 137, 123, 0.3);
    }

    .btn-sparkle {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.8) 0%, transparent 70%);
        opacity: 0;
        transition: opacity 0.3s;
    }

    .btn-apply-filters.premium:hover .btn-sparkle {
        opacity: 1;
        animation: sparkle 0.6s ease-out;
    }

    @keyframes sparkle {
        0% { transform: translate(-50%, -50%) scale(0); opacity: 0; }
        50% { transform: translate(-50%, -50%) scale(1.5); opacity: 0.8; }
        100% { transform: translate(-50%, -50%) scale(2); opacity: 0; }
    }

    .btn-reset-filters.premium {
        background: white;
        color: #4a5568;
        border: 2px solid #e2e8f0;
        padding: 0.9rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        font-size: 1rem;
    }

    .btn-reset-filters.premium:hover {
        background: #f7fafc;
        color: #2d3748;
        border-color: #cbd5e0;
        transform: translateY(-2px);
    }

    /* ===== STATISTIQUES PREMIUM ===== */
    .stats-section {
        margin-bottom: 3rem;
    }

    .stats-title {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-left: 1rem;
        border-left: 4px solid #00897b;
    }

    .stats-title h4 {
        margin: 0;
        font-weight: 700;
        color: #2d3748;
        font-size: 1.3rem;
    }

    .stats-title .bi {
        color: #00897b;
        font-size: 1.5rem;
    }

    .stat-card-mini.premium {
        background: white;
        border-radius: 20px;
        padding: 1.8rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 
            0 15px 40px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        border: none;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .stat-card-mini.premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
    }

    .stat-card-mini.premium:hover {
        transform: translateY(-8px);
        box-shadow: 
            0 25px 60px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(0, 0, 0, 0.03);
    }

    .stat-icon-mini.premium {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        flex-shrink: 0;
        position: relative;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .icon-pulse {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        border-radius: 16px;
        background: inherit;
        opacity: 0.5;
        animation: statPulse 2s infinite;
    }

    @keyframes statPulse {
        0% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
        50% { transform: translate(-50%, -50%) scale(1.1); opacity: 0.3; }
        100% { transform: translate(-50%, -50%) scale(1); opacity: 0.5; }
    }

    .stat-content-mini {
        flex: 1;
    }

    .stat-number-mini {
        font-size: 2.2rem;
        font-weight: 900;
        margin: 0;
        line-height: 1;
        color: #1a202c;
        background: linear-gradient(135deg, #2d3748, #4a5568);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .stat-label-mini {
        color: #718096;
        margin: 0.5rem 0 0;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-progress {
        margin-top: 1rem;
        height: 4px;
        background: #e2e8f0;
        border-radius: 2px;
        overflow: hidden;
    }

    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--gradient-start), var(--gradient-end));
        border-radius: 2px;
        transition: width 1s ease-out;
    }

    /* ===== GRILLE DE CONTENUS PREMIUM ===== */
    .content-grid.premium {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 2rem;
    }

    /* Carte de contenu premium */
    .content-card.premium {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 
            0 15px 40px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        border: none;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
    }

    .content-card.premium:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 
            0 30px 80px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(0, 0, 0, 0.03);
    }

    /* EN-TÊTE COLORÉE PREMIUM */
    .content-card-header.premium {
        position: relative;
        padding: 2rem;
        min-height: 160px;
        color: white;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .header-shine {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.6s;
    }

    .content-card.premium:hover .header-shine {
        left: 100%;
    }

    .header-content.premium {
        position: relative;
        z-index: 2;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        width: 100%;
    }

    .header-icon.premium {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        flex-shrink: 0;
        border: 2px solid rgba(255, 255, 255, 0.3);
        position: relative;
    }

    .icon-halo {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 90px;
        height: 90px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
        border-radius: 18px;
    }

    .header-text.premium {
        flex: 1;
    }

    .content-title.premium {
        font-size: 1.4rem;
        font-weight: 800;
        margin-bottom: 1rem;
        color: white;
        line-height: 1.4;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    }

    .header-subtitle.premium {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
        align-items: center;
    }

    .header-badge.premium {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 0.5rem 1rem;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .header-badge.premium:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: translateY(-2px);
    }

    .region-badge.premium {
        background: rgba(0, 0, 0, 0.3);
    }

    .header-corner {
        position: absolute;
        top: 0;
        right: 0;
        width: 60px;
        height: 60px;
        overflow: hidden;
    }

    .corner-ribbon {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 80px;
        height: 80px;
        background: rgba(0, 0, 0, 0.1);
        transform: rotate(45deg);
    }

    .content-card-body.premium {
        padding: 2rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        background: white;
    }

    .content-excerpt.premium {
        color: #4a5568;
        margin-bottom: 2rem;
        line-height: 1.7;
        font-size: 1rem;
        flex: 1;
        position: relative;
        padding-left: 2rem;
    }

    .excerpt-icon {
        position: absolute;
        left: 0;
        top: 0;
        color: #e2e8f0;
        font-size: 1.2rem;
    }

    /* GRID DE MÉTADONNÉES PREMIUM */
    .metadata-grid.premium {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.2rem;
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 16px;
        border: 1px solid #e2e8f0;
    }

    .metadata-item.premium {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .metadata-icon.premium {
        width: 45px;
        height: 45px;
        background: white;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ff8c00;
        font-size: 1.2rem;
        flex-shrink: 0;
        box-shadow: 
            0 4px 15px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        position: relative;
        border: 1px solid #f1f5f9;
    }

    .icon-dot {
        position: absolute;
        top: -2px;
        right: -2px;
        width: 8px;
        height: 8px;
        background: #ff8c00;
        border-radius: 50%;
        border: 2px solid white;
    }

    .metadata-content.premium {
        flex: 1;
        min-width: 0;
    }

    .metadata-label.premium {
        font-size: 0.8rem;
        color: #718096;
        font-weight: 700;
        margin-bottom: 0.3rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .metadata-value.premium {
        font-size: 0.95rem;
        color: #2d3748;
        font-weight: 600;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .status-badge.premium {
        display: inline-flex;
        align-items: center;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .status-publié { 
        background: linear-gradient(135deg, #c6f6d5, #9ae6b4);
        color: #22543d;
    }
    .status-en_attente { 
        background: linear-gradient(135deg, #fed7d7, #feb2b2);
        color: #742a2a;
    }
    .status-brouillon { 
        background: linear-gradient(135deg, #e2e8f0, #cbd5e0);
        color: #2d3748;
    }

    .content-actions.premium {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1rem;
        margin-top: auto;
    }

    .btn-view-content.premium {
        background: linear-gradient(135deg, #ff8c00, #ff6b35);
        color: white;
        border: none;
        padding: 0.9rem 1.8rem;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        flex: 1;
        justify-content: center;
        font-size: 0.95rem;
        position: relative;
        overflow: hidden;
    }

    .btn-view-content.premium:hover {
        background: linear-gradient(135deg, #ff6b35, #ff8c00);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(255, 107, 53, 0.3);
    }

    .btn-arrow {
        margin-left: 0.5rem;
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s ease;
    }

    .btn-view-content.premium:hover .btn-arrow {
        opacity: 1;
        transform: translateX(0);
    }

    .btn-action-dropdown.premium {
        background: white;
        border: 2px solid #e2e8f0;
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #718096;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .btn-action-dropdown.premium:hover {
        background: #f7fafc;
        border-color: #ff8c00;
        color: #ff8c00;
        transform: scale(1.1);
    }

    .dropdown-dots {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .dropdown-dots span {
        width: 4px;
        height: 4px;
        background: currentColor;
        border-radius: 50%;
    }

    .dropdown-menu.premium {
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.15);
        padding: 0.5rem;
        min-width: 200px;
    }

    .dropdown-item.premium {
        padding: 0.8rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.2s ease;
    }

    .dropdown-item.premium:hover {
        background: #f7fafc;
        transform: translateX(5px);
    }

    .content-card-footer.premium {
        padding: 1.5rem 2rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .update-time.premium {
        font-size: 0.85rem;
        color: #718096;
        display: flex;
        align-items: center;
        font-weight: 500;
    }

    .moderated-badge.premium {
        background: linear-gradient(135deg, #17a2b8, #5dc6d4);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(23, 162, 184, 0.2);
    }

    /* ===== ÉTAT VIDE PREMIUM ===== */
    .empty-state.premium {
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 24px;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        position: relative;
        overflow: hidden;
        margin: 3rem 0;
    }

    .empty-state-container {
        position: relative;
        z-index: 2;
    }

    .empty-state-icon.premium {
        font-size: 5rem;
        color: #e2e8f0;
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }

    .icon-ripple {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 100px;
        height: 100px;
        border: 2px solid #e2e8f0;
        border-radius: 50%;
        animation: ripple 2s infinite;
    }

    @keyframes ripple {
        0% { transform: translate(-50%, -50%) scale(0.8); opacity: 1; }
        100% { transform: translate(-50%, -50%) scale(1.5); opacity: 0; }
    }

    .empty-state-title.premium {
        font-size: 2rem;
        font-weight: 900;
        color: #2d3748;
        margin-bottom: 1rem;
        background: linear-gradient(135deg, #2d3748, #4a5568);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .empty-state-text.premium {
        color: #718096;
        max-width: 500px;
        margin: 0 auto 2rem;
        line-height: 1.6;
        font-size: 1.05rem;
    }

    .empty-state-actions.premium {
        display: flex;
        gap: 1.2rem;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn-outline-premium {
        border: 2px solid #e2e8f0;
        background: white;
        color: #4a5568;
        padding: 0.9rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .btn-outline-premium:hover {
        border-color: #cbd5e0;
        background: #f7fafc;
        color: #2d3748;
        transform: translateY(-2px);
    }

    .btn-premium {
        background: linear-gradient(135deg, #ff8c00, #ff6b35);
        color: white;
        border: none;
        padding: 0.9rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }

    .btn-premium:hover {
        background: linear-gradient(135deg, #ff6b35, #ff8c00);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(255, 107, 53, 0.3);
    }

    .empty-state-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 100px;
        z-index: 1;
    }

    /* ===== PAGINATION PREMIUM ===== */
    .pagination-wrapper.premium {
        background: white;
        border-radius: 20px;
        padding: 1.8rem;
        box-shadow: 
            0 15px 40px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        margin-top: 3rem;
    }

    .pagination-wrapper.premium .pagination {
        justify-content: center;
        margin: 0;
    }

    .pagination-wrapper.premium .page-item .page-link {
        border: 2px solid #e2e8f0;
        background: white;
        color: #4a5568;
        font-weight: 700;
        margin: 0 0.3rem;
        border-radius: 12px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 0.7rem 1.2rem;
        font-size: 0.95rem;
        min-width: 45px;
        text-align: center;
    }

    .pagination-wrapper.premium .page-item .page-link:hover {
        border-color: #ff8c00;
        background: rgba(255, 140, 0, 0.05);
        color: #ff8c00;
        transform: translateY(-3px);
    }

    .pagination-wrapper.premium .page-item.active .page-link {
        background: linear-gradient(135deg, #ff8c00, #ff6b35);
        border-color: #ff8c00;
        color: white;
        box-shadow: 0 8px 25px rgba(255, 140, 0, 0.2);
    }

    .pagination-wrapper.premium .page-item.disabled .page-link {
        background: #f8f9fa;
        color: #adb5bd;
        opacity: 0.6;
        border-color: #e9ecef;
    }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1200px) {
        .content-grid.premium {
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        }
    }

    @media (max-width: 992px) {
        .dashboard-container {
            padding: 0 1.5rem;
            margin-top: 90px;
        }
        
        .page-header.premium-header {
            padding: 2rem 1.5rem 3.5rem;
        }
        
        .page-title.premium-title {
            font-size: 2rem;
        }
        
        .header-content-wrapper {
            flex-direction: column;
            text-align: center;
            gap: 1.5rem;
        }
        
        .header-main {
            flex-direction: column;
            text-align: center;
        }
        
        .header-icon-wrapper {
            width: 60px;
            height: 60px;
        }
        
        .header-icon-wrapper .bi {
            font-size: 1.7rem;
        }
        
        .metadata-grid.premium {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            padding: 0 1rem;
            margin-top: 80px;
        }
        
        .page-header.premium-header {
            padding: 1.5rem 1rem 3rem;
            border-radius: 20px;
        }
        
        .page-title.premium-title {
            font-size: 1.7rem;
        }
        
        .filter-body.premium {
            padding: 1.5rem;
        }
        
        .filter-actions.premium {
            flex-direction: column;
        }
        
        .stat-card-mini.premium {
            flex-direction: column;
            text-align: center;
            padding: 1.5rem;
        }
        
        .stat-icon-mini.premium {
            width: 60px;
            height: 60px;
            font-size: 1.5rem;
        }
        
        .stat-number-mini {
            font-size: 1.8rem;
        }
        
        .content-grid.premium {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .content-card-header.premium {
            min-height: 140px;
            padding: 1.5rem;
        }
        
        .header-icon.premium {
            width: 60px;
            height: 60px;
            font-size: 1.8rem;
        }
        
        .content-title.premium {
            font-size: 1.2rem;
        }
        
        .empty-state-actions.premium {
            flex-direction: column;
            align-items: center;
        }
    }

    @media (max-width: 480px) {
        .page-title.premium-title {
            font-size: 1.5rem;
        }
        
        .header-subtitle.premium {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .content-card-footer.premium {
            flex-direction: column;
            gap: 1rem;
            text-align: center;
        }
        
        .content-actions.premium {
            flex-direction: column;
        }
        
        .btn-view-content.premium {
            width: 100%;
        }
        
        .filter-select.premium {
            font-size: 0.9rem;
            padding: 0.8rem;
        }
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des cartes au scroll
    const cards = document.querySelectorAll('.content-card.premium');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0) scale(1)';
                }, index * 100);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    });

    cards.forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px) scale(0.95)';
        card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
        observer.observe(card);
    });

    // Animation des statistiques
    const statNumbers = document.querySelectorAll('.stat-number-mini');
    statNumbers.forEach(stat => {
        const finalValue = parseInt(stat.textContent);
        let currentValue = 0;
        const increment = finalValue / 50;
        const timer = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                stat.textContent = finalValue;
                clearInterval(timer);
            } else {
                stat.textContent = Math.floor(currentValue);
            }
        }, 30);
    });

    // Effet de parallaxe sur l'en-tête
    const header = document.querySelector('.page-header.premium-header');
    if (header) {
        window.addEventListener('scroll', function() {
            const scrolled = window.pageYOffset;
            const rate = scrolled * -0.3;
            header.style.transform = `translateY(${rate}px)`;
        });
    }

    // Animation des sélecteurs
    const selects = document.querySelectorAll('.filter-select.premium');
    selects.forEach(select => {
        select.addEventListener('focus', function() {
            this.parentElement.style.transform = 'translateY(-3px)';
        });
        
        select.addEventListener('blur', function() {
            this.parentElement.style.transform = 'translateY(0)';
        });
    });

    // Effet de glow sur les boutons
    const buttons = document.querySelectorAll('.btn-create-content.premium-btn, .btn-apply-filters.premium');
    buttons.forEach(button => {
        button.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;
            
            this.style.setProperty('--mouse-x', `${x}px`);
            this.style.setProperty('--mouse-y', `${y}px`);
        });
    });

    // Confirmation améliorée pour la suppression
    const deleteForms = document.querySelectorAll('form[action*="destroy"]');
    deleteForms.forEach(form => {
        const deleteButton = form.querySelector('button[type="submit"]');
        if (deleteButton) {
            deleteButton.addEventListener('click', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir supprimer ce contenu ? Cette action est irréversible.')) {
                    e.preventDefault();
                }
            });
        }
    });

    // Effet de scroll progressif
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const maxScroll = document.body.scrollHeight - window.innerHeight;
        const scrollPercent = scrolled / maxScroll;
        
        // Effet sur la pagination
        const pagination = document.querySelector('.pagination-wrapper.premium');
        if (pagination) {
            if (scrollPercent > 0.9) {
                pagination.style.opacity = '0.7';
                pagination.style.transform = 'translateY(10px)';
            } else {
                pagination.style.opacity = '1';
                pagination.style.transform = 'translateY(0)';
            }
        }
    });
});
</script>
@endsection