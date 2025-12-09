@extends('layouts.app')

@section('title', 'Culture Benin - Accueil')

@section('content')
    <section class="hero-section" id="accueil">
        <!-- Carrousel de 4 images locales avec effet zoom out -->
        <div class="carousel-container">
            <div class="carousel-slider">
                <!-- Image 1 : Ganvié - Venise de l'Afrique -->
                <div class="carousel-slide active">
                    <img src="{{ asset('images/culture-benin-1.jpg') }}" 
                         alt="Ganvié - La Venise de l'Afrique" 
                         class="carousel-img"
                         loading="eager">
                    <div class="carousel-caption">
                        <h3>La Porte du Nom Retoure</h3>
                        
                    </div>
                    <div class="carousel-overlay"></div>
                </div>
                
                <!-- Image 2 : Palais royaux d'Abomey -->
                <div class="carousel-slide">
                    <img src="{{ asset('images/culture-benin-2.jpg') }}" 
                         alt="Palais royaux d'Abomey" 
                         class="carousel-img"
                         loading="eager">
                    <div class="carousel-caption">
                        <h3>Palais des Congrès</h3>
                        
                    </div>
                    <div class="carousel-overlay"></div>
                </div>
                
                <!-- Image 3 : Fête du Vodun -->
                <div class="carousel-slide">
                    <img src="{{ asset('images/culture-benin-3.jpg') }}" 
                         alt="Fête du Vodun" 
                         class="carousel-img"
                         loading="lazy">
                    <div class="carousel-caption">
                        <h3>La Route des Pêches</h3>
                        
                    </div>
                    <div class="carousel-overlay"></div>
                </div>

                <!-- Image 4 : Fête du Vodun -->
                <div class="carousel-slide">
                    <img src="https://images.unsplash.com/photo-1518991669955-9c7e78ec80d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80" 
                         alt="Fête du Vodun" 
                         class="carousel-img"
                         loading="lazy">
                    <div class="carousel-overlay"></div>
                </div>
                
                <!-- Image cinq : Artisanat béninois -->
                <div class="carousel-slide">
                    <img src="{{ asset('images/culture-benin-4.jpg') }}" 
                         alt="Artisanat béninois" 
                         class="carousel-img"
                         loading="lazy">
                    <div class="carousel-caption">
                        <h3>Plage Fidjrossè</h3>
                        
                    </div>
                    <div class="carousel-overlay"></div>
                </div>
            </div>
            
            <!-- Contrôles du carrousel -->
            <div class="carousel-controls">
                <button class="carousel-btn prev-btn" aria-label="Image précédente">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="carousel-btn next-btn" aria-label="Image suivante">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>
        </div>

        <div class="hero-content">
            <h1 class="hero-title">
                Découvrez la Richesse<br>
                <span class="hero-accent">Culturelle du Bénin</span>
            </h1>
            <p class="hero-subtitle">
                Explorez le patrimoine exceptionnel du Bénin à travers ses traditions ancestrales,
                ses langues locales, ses arts vivants et son héritage historique unique.
                Une immersion totale dans l'âme de la nation.
            </p>
            <a href="#contenus" class="btn-hero">
                <i class="bi bi-compass me-2"></i>Commencer l'Exploration
            </a>
        </div>
    </section>

    <section class="stats-section">
        <div class="stats-container">
            <h2 class="section-title">Notre Patrimoine en Chiffres</h2>
            <p class="section-subtitle">
                Découvrez l'étendue de notre collection culturelle à travers ces chiffres significatifs
            </p>

            <div class="stats-grid-premium">
                <div class="stat-card-premium">
                    <div class="stat-icon-wrapper" style="background: linear-gradient(135deg, #e17000, #ff8c00);">
                        <i class="bi bi-journal-richtext stat-icon-premium"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number-premium" data-count="{{ \App\Models\Contenu::count() }}">0</div>
                        <div class="stat-label-premium">Contenus Culturels</div>
                        <div class="stat-description">Articles, documents et ressources</div>
                    </div>
                </div>
                <div class="stat-card-premium">
                    <div class="stat-icon-wrapper" style="background: linear-gradient(135deg, #0d6efd, #6ea8fe);">
                        <i class="bi bi-images stat-icon-premium"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number-premium" data-count="{{ \App\Models\Media::count() }}">0</div>
                        <div class="stat-label-premium">Médias Numériques</div>
                        <div class="stat-description">Images, vidéos et documents</div>
                    </div>
                </div>
                <div class="stat-card-premium">
                    <div class="stat-icon-wrapper" style="background: linear-gradient(135deg, #198754, #20c997);">
                        <i class="bi bi-translate stat-icon-premium"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number-premium" data-count="{{ \App\Models\Langue::count() }}">0</div>
                        <div class="stat-label-premium">Langues Locales</div>
                        <div class="stat-description">Dialectes et langues préservées</div>
                    </div>
                </div>
                <div class="stat-card-premium">
                    <div class="stat-icon-wrapper" style="background: linear-gradient(135deg, #6f42c1, #a370f7);">
                        <i class="bi bi-geo-alt stat-icon-premium"></i>
                    </div>
                    <div class="stat-content">
                        <div class="stat-number-premium" data-count="{{ \App\Models\Region::count() }}">0</div>
                        <div class="stat-label-premium">Régions Couvertes</div>
                        <div class="stat-description">Tout le territoire béninois</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contenus" class="section-padding recent-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title-dark">Contenus Récents</h2>
                <p class="section-subtitle-dark">
                    Découvrez les derniers articles et documents culturels ajoutés à notre plateforme
                </p>
                <a href="{{ route('contenus.index') }}" class="section-view-all">
                    Voir tous les contenus <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

            <div class="content-preview-grid-premium">
                @php
                    $contenusRecents = \App\Models\Contenu::with(['typeContenu', 'region', 'langue', 'auteur'])
                        ->where('statut', 'publié')
                        ->orderBy('created_at', 'desc')
                        ->take(4)
                        ->get();
                @endphp

                @forelse($contenusRecents as $contenu)
                    @php
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
                        $regionColor = $regionColors[$contenu->region->nom_region ?? ''] ?? '#0d6efd';
                    @endphp
                
                <div class="preview-card-premium">
                    <!-- Header coloré -->
                    <div class="preview-header" style="background: {{ $regionColor }};">
                        <div class="header-overlay-light"></div>
                        <div class="header-content">
                            <div class="type-badge">
                                <i class="bi bi-tag-fill me-1"></i>
                                {{ $contenu->typeContenu->nom ?? 'Article' }}
                            </div>
                            <h3 class="preview-title">{{ Str::limit($contenu->titre, 50) }}</h3>
                        </div>
                    </div>

                    <!-- Corps de la carte -->
                    <div class="preview-body">
                        <p class="preview-text">
                            {{ Str::limit(strip_tags($contenu->texte), 120) }}
                        </p>
                        
                        <div class="preview-meta-grid">
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div class="meta-content">
                                    <div class="meta-label">Auteur</div>
                                    <div class="meta-value">{{ $contenu->auteur->prenom ?? 'Anonyme' }}</div>
                                </div>
                            </div>
                            
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="bi bi-geo-alt-fill"></i>
                                </div>
                                <div class="meta-content">
                                    <div class="meta-label">Région</div>
                                    <div class="meta-value">{{ $contenu->region->nom_region ?? 'Bénin' }}</div>
                                </div>
                            </div>
                            
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="bi bi-calendar-event"></i>
                                </div>
                                <div class="meta-content">
                                    <div class="meta-label">Date</div>
                                    <div class="meta-value">{{ $contenu->created_at->format('d/m/Y') }}</div>
                                </div>
                            </div>
                            
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="bi bi-chat-left-text"></i>
                                </div>
                                <div class="meta-content">
                                    <div class="meta-label">Langue</div>
                                    <div class="meta-value">{{ $contenu->langue->nom_langue ?? 'Français' }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer avec bouton -->
                    <div class="preview-footer">
                        <a href="{{ route('contenus.show', $contenu->id_contenu) }}" class="preview-btn">
                            <i class="bi bi-eye me-2"></i>
                            Lire l'article
                        </a>
                        <span class="time-ago">
                            <i class="bi bi-clock-history me-1"></i>
                            {{ $contenu->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
                @empty
                <div class="preview-card-premium empty">
                    <div class="preview-header" style="background: #6c757d;">
                        <div class="header-content text-center">
                            <i class="bi bi-journal-text" style="font-size: 2rem; margin-bottom: 1rem;"></i>
                            <h3 class="preview-title">Aucun contenu récent</h3>
                        </div>
                    </div>
                    <div class="preview-body text-center">
                        <p class="preview-text">De nouveaux contenus seront bientôt publiés</p>
                        <a href="{{ route('user.contenus.create') }}" class="preview-btn">
                            <i class="bi bi-plus-circle me-2"></i>
                            Créer un contenu
                        </a>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <section id="medias" class="section-padding media-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title-dark">Médias Récents</h2>
                <p class="section-subtitle-dark">
                    Explorez notre dernière collection d'images et vidéos culturelles
                </p>
                <a href="{{ route('medias.index') }}" class="section-view-all">
                    Voir tous les médias <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>

            <div class="media-grid-premium">
                @php
                    $mediasRecents = \App\Models\Media::with(['typeMedia', 'user'])
                        ->orderBy('created_at', 'desc')
                        ->take(4)
                        ->get();
                @endphp

                @forelse($mediasRecents as $media)
                    @php
                        $mediaType = $media->typeMedia->nom ?? 'Document';
                        $typeColors = [
                            'Image' => '#0d6efd',
                            'Vidéo' => '#198754',
                            'Audio' => '#6f42c1',
                            'PDF' => '#dc3545',
                            'Document' => '#6c757d'
                        ];
                        $typeIcons = [
                            'Image' => 'bi-image',
                            'Vidéo' => 'bi-camera-video',
                            'Audio' => 'bi-music-note-beamed',
                            'PDF' => 'bi-file-earmark-pdf',
                            'Document' => 'bi-file-earmark-text'
                        ];
                        $typeColor = $typeColors[$mediaType] ?? '#6c757d';
                        $typeIcon = $typeIcons[$mediaType] ?? 'bi-file-earmark';
                    @endphp
                
                <div class="media-card-premium">
                    <!-- Thumbnail -->
                    <div class="media-thumbnail-premium">
                        @if($mediaType == 'Image' && Storage::exists($media->Chemin))
                            <div class="thumbnail-container">
                                <img src="{{ Storage::url($media->Chemin) }}" 
                                    alt="{{ $media->description }}"
                                    class="media-image"
                                    loading="lazy">
                                <div class="thumbnail-overlay">
                                    <a href="{{ route('medias.show', $media->id_media) }}" class="overlay-btn">
                                        <i class="bi bi-eye-fill"></i>
                                    </a>
                                </div>
                            </div>
                        @else
                            <div class="media-placeholder" style="border-color: {{ $typeColor }};">
                                <div class="placeholder-icon" style="color: {{ $typeColor }};">
                                    <i class="bi {{ $typeIcon }}"></i>
                                </div>
                                <div class="placeholder-text">{{ $mediaType }}</div>
                            </div>
                        @endif
                        
                        <!-- Badges -->
                        <div class="media-badges">
                            <span class="type-badge" style="background: {{ $typeColor }};">
                                <i class="bi {{ $typeIcon }} me-1"></i>
                                {{ $mediaType }}
                            </span>
                            <span class="premium-badge">
                                <i class="bi bi-star-fill me-1"></i>
                                Premium
                            </span>
                        </div>
                    </div>

                    <!-- Contenu -->
                    <div class="media-content-premium">
                        <h4 class="media-title">
                            <a href="{{ route('medias.show', $media->id_media) }}">
                                {{ Str::limit($media->description, 40) }}
                            </a>
                        </h4>
                        
                        <div class="media-meta-grid">
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="bi bi-calendar3"></i>
                                </div>
                                <div class="meta-content">
                                    <div class="meta-label">Ajouté</div>
                                    <div class="meta-value">{{ $media->created_at->format('d/m/Y') }}</div>
                                </div>
                            </div>
                            
                            <div class="meta-item">
                                <div class="meta-icon">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div class="meta-content">
                                    <div class="meta-label">Par</div>
                                    <div class="meta-value">{{ $media->user->prenom ?? 'Anonyme' }}</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="media-footer">
                            <div class="price-tag">
                                <i class="bi bi-coin"></i>
                                <span></span>
                            </div>
                            <a href="{{ route('medias.show', $media->id_media) }}" class="media-btn">
                                <i class="bi bi-eye me-2"></i>
                                Voir
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="media-card-premium empty">
                    <div class="media-thumbnail-premium">
                        <div class="media-placeholder" style="border-color: #6c757d;">
                            <div class="placeholder-icon" style="color: #6c757d;">
                                <i class="bi bi-images"></i>
                            </div>
                            <div class="placeholder-text">Aucun média</div>
                        </div>
                    </div>
                    <div class="media-content-premium text-center">
                        <h4 class="media-title">Galerie vide</h4>
                        <p class="media-description">Notre galerie sera bientôt enrichie</p>
                        <a href="{{ route('user.medias.create') }}" class="media-btn">
                            <i class="bi bi-cloud-upload me-2"></i>
                            Uploader un média
                        </a>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        /* ===== CORRECTIONS GÉNÉRALES ===== */
        * {
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        /* ===== CARROUSEL AMÉLIORÉ ===== */
        .carousel-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .carousel-slider {
            width: 100%;
            height: 100%;
            position: relative;
        }

        .carousel-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .carousel-slide.active {
            opacity: 1;
        }

        .carousel-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            animation: zoomOut 15s ease-in-out infinite;
            filter: brightness(0.9);
        }

        @keyframes zoomOut {
            0% {
                transform: scale(1.05);
            }
            100% {
                transform: scale(1);
            }
        }

        .carousel-caption {
            position: absolute;
            bottom: 120px;
            left: 0;
            width: 100%;
            text-align: center;
            z-index: 10;
            color: white;
            padding: 0 2rem;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease 0.3s;
        }

        .carousel-slide.active .carousel-caption {
            opacity: 1;
            transform: translateY(0);
        }

        .carousel-caption h3 {
            font-size: 2.2rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }

        .carousel-caption p {
            font-size: 1.2rem;
            font-weight: 400;
            max-width: 600px;
            margin: 0 auto;
            text-shadow: 0 1px 5px rgba(0, 0, 0, 0.4);
            opacity: 0.9;
        }

        .carousel-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.4));
        }

        .carousel-controls {
            position: absolute;
            bottom: 40px;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 3rem;
            z-index: 10;
        }

        .carousel-btn {
            background: rgba(255, 255, 255, 0.25);
            border: 2px solid rgba(255, 255, 255, 0.4);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            font-weight: 600;
            outline: none;
        }

        .carousel-btn:hover {
            background: rgba(255, 255, 255, 0.4);
            transform: scale(1.1);
            box-shadow: 0 4px 20px rgba(255, 255, 255, 0.3);
        }

        .carousel-btn:focus {
            box-shadow: 0 0 0 3px rgba(255, 140, 0, 0.5);
        }

        /* ===== HERO SECTION AMÉLIORÉE ===== */
        .hero-section {
            position: relative;
            height: 100vh;
            min-height: 600px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            overflow: hidden;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            max-width: 800px;
            padding: 0 2rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            letter-spacing: -0.5px;
            text-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
        }

        .hero-accent {
            color: #ffa94d;
            background: linear-gradient(45deg, #ff8c00, #ffd700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: none;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            margin-bottom: 2.5rem;
            line-height: 1.6;
            opacity: 0.95;
            font-weight: 400;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .btn-hero {
            display: inline-flex;
            align-items: center;
            background: linear-gradient(135deg, #e17000, #ff8c00);
            color: white;
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 700;
            text-decoration: none;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(225, 112, 0, 0.4);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .btn-hero:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(225, 112, 0, 0.5);
            color: white;
        }

        /* ===== STATISTIQUES PREMIUM ===== */
        .stats-section {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: white;
            padding: 6rem 0;
            position: relative;
            overflow: hidden;
        }

        .stats-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff10" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>');
            background-size: cover;
            opacity: 0.1;
        }

        .stats-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
            text-align: center;
            position: relative;
            z-index: 1;
        }

        .section-title {
            font-size: 2.75rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: white;
            letter-spacing: -0.5px;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .section-subtitle {
            font-size: 1.2rem;
            color: #cbd5e1;
            margin-bottom: 4rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
            font-weight: 400;
        }

        /* Grille de statistiques premium */
        .stats-grid-premium {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .stat-card-premium {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .stat-card-premium::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        }

        .stat-card-premium:hover {
            transform: translateY(-10px);
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.2);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
        }

        .stat-icon-wrapper {
            width: 80px;
            height: 80px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        }

        .stat-icon-premium {
            font-size: 2.2rem;
            color: white;
        }

        .stat-content {
            flex: 1;
        }

        .stat-number-premium {
            font-size: 3rem;
            font-weight: 900;
            margin-bottom: 0.5rem;
            color: white;
            line-height: 1;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }

        .stat-label-premium {
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: white;
            letter-spacing: 0.5px;
        }

        .stat-description {
            font-size: 0.9rem;
            color: #cbd5e1;
            opacity: 0.8;
        }

        /* ===== SECTION HEADER AMÉLIORÉ ===== */
        .section-header {
            margin-bottom: 3rem;
            text-align: center;
            position: relative;
        }

        .section-title-dark {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: #1a1d21;
            letter-spacing: -0.5px;
            position: relative;
            display: inline-block;
        }

        .section-title-dark::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #e17000, #ff8c00);
            border-radius: 2px;
        }

        .section-subtitle-dark {
            font-size: 1.1rem;
            color: #6c757d;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.6;
            font-weight: 400;
        }

        .section-view-all {
            display: inline-flex;
            align-items: center;
            color: #0d6efd;
            font-weight: 700;
            text-decoration: none;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            font-size: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            background: rgba(13, 110, 253, 0.1);
        }

        .section-view-all:hover {
            color: white;
            background: #0d6efd;
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
        }

        /* ===== CONTENUS RÉCENTS AMÉLIORÉS ===== */
        .content-preview-grid-premium {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }

        .preview-card-premium {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .preview-card-premium:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .preview-card-premium.empty {
            background: #f8f9fa;
        }

        .preview-header {
            position: relative;
            padding: 2rem;
            color: white;
            min-height: 140px;
        }

        .header-overlay-light {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0,0,0,0.3), rgba(0,0,0,0.1));
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        .type-badge {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            margin-bottom: 1rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-shadow: 0 1px 2px rgba(0,0,0,0.2);
        }

        .preview-title {
            font-size: 1.3rem;
            font-weight: 800;
            margin: 0;
            color: white;
            line-height: 1.4;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .preview-body {
            padding: 2rem;
            flex: 1;
        }

        .preview-text {
            color: #495057;
            margin-bottom: 1.5rem;
            line-height: 1.6;
            font-size: 1rem;
            font-weight: 400;
        }

        .preview-meta-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .meta-item {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .meta-icon {
            width: 40px;
            height: 40px;
            background: #f8f9fa;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #e17000;
            font-size: 1.1rem;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }

        .meta-content {
            flex: 1;
            min-width: 0;
        }

        .meta-label {
            font-size: 0.8rem;
            color: #6c757d;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.2rem;
        }

        .meta-value {
            font-size: 0.95rem;
            color: #1a1d21;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .preview-footer {
            padding: 1.5rem 2rem;
            background: #f8f9fa;
            border-top: 1px solid rgba(0, 0, 0, 0.08);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .preview-btn {
            background: linear-gradient(135deg, #e17000, #ff8c00);
            color: white;
            border: none;
            padding: 0.7rem 1.5rem;
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            box-shadow: 0 4px 15px rgba(225, 112, 0, 0.2);
        }

        .preview-btn:hover {
            background: linear-gradient(135deg, #ff8c00, #ffa040);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(225, 112, 0, 0.3);
            color: white;
        }

        .time-ago {
            font-size: 0.85rem;
            color: #6c757d;
            display: flex;
            align-items: center;
            font-weight: 500;
        }

        /* ===== MÉDIAS RÉCENTS AMÉLIORÉS ===== */
        .media-grid-premium {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
        }

        .media-card-premium {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            border: 1px solid rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .media-card-premium:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .media-card-premium.empty {
            background: #f8f9fa;
        }

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

        .media-image {
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
            background: rgba(0, 0, 0, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .thumbnail-container:hover .thumbnail-overlay {
            opacity: 1;
        }

        .thumbnail-container:hover .media-image {
            transform: scale(1.05);
        }

        .overlay-btn {
            width: 60px;
            height: 60px;
            background: white;
            color: #0d6efd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .overlay-btn:hover {
            background: #0d6efd;
            color: white;
            transform: scale(1.1);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
        }

        .media-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            border: 3px solid;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.95);
        }

        .placeholder-icon {
            font-size: 3.5rem;
            margin-bottom: 1rem;
        }

        .placeholder-text {
            font-size: 1.2rem;
            font-weight: 700;
        }

        .media-badges {
            position: absolute;
            top: 20px;
            left: 20px;
            right: 20px;
            display: flex;
            justify-content: space-between;
            pointer-events: none;
        }

        .media-badges .type-badge {
            background: rgba(0, 0, 0, 0.7);
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 700;
            backdrop-filter: blur(10px);
        }

        .premium-badge {
            background: linear-gradient(135deg, #ffd700, #ffed4e);
            color: #856404;
            padding: 0.4rem 1rem;
            border-radius: 20px;
            font-size: 0.85rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            box-shadow: 0 4px 15px rgba(255, 215, 0, 0.3);
            text-shadow: 0 1px 2px rgba(0,0,0,0.1);
        }

        .media-content-premium {
            padding: 2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .media-title {
            font-size: 1.2rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.4;
            color: #1a1d21;
        }

        .media-title a {
            color: #1a1d21;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .media-title a:hover {
            color: #0d6efd;
        }

        .media-meta-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .media-footer {
            margin-top: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .price-tag {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 800;
            color: #e17000;
            font-size: 1.1rem;
            background: rgba(225, 112, 0, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 10px;
        }

        .price-tag i {
            font-size: 1.2rem;
        }

        .media-btn {
            background: linear-gradient(135deg, #0d6efd, #6ea8fe);
            color: white;
            border: none;
            padding: 0.6rem 1.2rem;
            border-radius: 10px;
            font-weight: 700;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            transition: all 0.3s ease;
            font-size: 0.95rem;
            box-shadow: 0 4px 15px rgba(13, 110, 253, 0.2);
        }

        .media-btn:hover {
            background: linear-gradient(135deg, #6ea8fe, #9ec5fe);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(13, 110, 253, 0.3);
            color: white;
        }

        /* ===== SECTIONS ===== */
        .section-padding {
            padding: 6rem 0;
        }

        .recent-section {
            background: #ffffff;
        }

        .media-section {
            background: #f8f9fa;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1200px) {
            .hero-title {
                font-size: 3rem;
            }
            
            .stats-grid-premium {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .carousel-caption h3 {
                font-size: 1.8rem;
            }
            
            .carousel-caption p {
                font-size: 1rem;
            }
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: 500px;
            }

            .hero-title {
                font-size: 2.2rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
                padding: 0 1rem;
            }

            .btn-hero {
                padding: 0.9rem 2rem;
                font-size: 1rem;
            }

            .section-title,
            .section-title-dark {
                font-size: 2rem;
            }

            .section-subtitle,
            .section-subtitle-dark {
                font-size: 1rem;
            }

            .carousel-controls {
                bottom: 30px;
                padding: 0 2rem;
            }

            .carousel-btn {
                width: 50px;
                height: 50px;
                font-size: 1.5rem;
            }

            .carousel-caption {
                bottom: 100px;
            }
            
            .carousel-caption h3 {
                font-size: 1.5rem;
            }
            
            .carousel-caption p {
                font-size: 0.9rem;
                max-width: 90%;
            }

            .stats-grid-premium {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .stat-card-premium {
                padding: 1.5rem;
            }

            .stat-icon-wrapper {
                width: 70px;
                height: 70px;
            }

            .stat-icon-premium {
                font-size: 1.8rem;
            }

            .stat-number-premium {
                font-size: 2.5rem;
            }

            .content-preview-grid-premium,
            .media-grid-premium {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .preview-meta-grid,
            .media-meta-grid {
                grid-template-columns: 1fr;
                gap: 0.8rem;
            }

            .section-padding {
                padding: 4rem 0;
            }
        }

        @media (max-width: 480px) {
            .hero-title {
                font-size: 1.8rem;
            }

            .hero-subtitle {
                font-size: 1rem;
            }

            .stats-grid-premium {
                gap: 1rem;
            }

            .stat-card-premium {
                padding: 1.25rem;
            }

            .stat-number-premium {
                font-size: 2rem;
            }

            .section-title,
            .section-title-dark {
                font-size: 1.8rem;
            }

            .carousel-controls {
                bottom: 20px;
                padding: 0 1.5rem;
            }

            .carousel-btn {
                width: 45px;
                height: 45px;
                font-size: 1.3rem;
            }
            
            .carousel-caption {
                bottom: 90px;
                padding: 0 1rem;
            }
            
            .carousel-caption h3 {
                font-size: 1.2rem;
            }
            
            .carousel-caption p {
                font-size: 0.8rem;
            }

            .section-padding {
                padding: 3rem 0;
            }

            .container {
                padding: 0 1rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ===== CARROUSEL AUTO (5 secondes) =====
            let currentSlide = 0;
            const slides = document.querySelectorAll('.carousel-slide');
            const totalSlides = slides.length;
            let slideInterval;

            function goToSlide(n) {
                slides[currentSlide].classList.remove('active');
                currentSlide = (n + totalSlides) % totalSlides;
                slides[currentSlide].classList.add('active');
            }

            function nextSlide() {
                goToSlide(currentSlide + 1);
            }

            function startAutoSlide() {
                slideInterval = setInterval(nextSlide, 5000); // 5 secondes
            }

            // Démarrer le carrousel auto
            startAutoSlide();

            // Contrôles boutons
            document.querySelector('.next-btn').addEventListener('click', function() {
                clearInterval(slideInterval);
                nextSlide();
                setTimeout(startAutoSlide, 5000);
            });

            document.querySelector('.prev-btn').addEventListener('click', function() {
                clearInterval(slideInterval);
                goToSlide(currentSlide - 1);
                setTimeout(startAutoSlide, 5000);
            });

            // Navigation clavier
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft') {
                    clearInterval(slideInterval);
                    goToSlide(currentSlide - 1);
                    setTimeout(startAutoSlide, 5000);
                } else if (e.key === 'ArrowRight') {
                    clearInterval(slideInterval);
                    nextSlide();
                    setTimeout(startAutoSlide, 5000);
                }
            });

            // Navigation tactile (swipe)
            const carousel = document.querySelector('.carousel-slider');
            let touchStartX = 0;
            let touchEndX = 0;

            carousel.addEventListener('touchstart', function(e) {
                touchStartX = e.changedTouches[0].screenX;
                clearInterval(slideInterval);
            });

            carousel.addEventListener('touchend', function(e) {
                touchEndX = e.changedTouches[0].screenX;
                handleSwipe();
                setTimeout(startAutoSlide, 5000);
            });

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = touchStartX - touchEndX;
                
                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0) {
                        // Swipe gauche -> image suivante
                        nextSlide();
                    } else {
                        // Swipe droite -> image précédente
                        goToSlide(currentSlide - 1);
                    }
                }
            }

            // Pause auto-slide au survol
            carousel.addEventListener('mouseenter', () => {
                clearInterval(slideInterval);
            });

            carousel.addEventListener('mouseleave', () => {
                startAutoSlide();
            });

            // ===== PRÉCHARGEMENT DES IMAGES LOCALES =====
            const imageSources = [
                "{{ asset('images/culture-benin-1.jpg') }}",
                "{{ asset('images/culture-benin-2.jpg') }}",
                "{{ asset('images/culture-benin-3.jpg') }}",
                "{{ asset('https://images.unsplash.com/photo-1518991669955-9c7e78ec80d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80') }}",
                "{{ asset('images/culture-benin-4.jpg') }}",
                
            ];

            // Précharger les images
            function preloadImages() {
                imageSources.forEach(src => {
                    const img = new Image();
                    img.src = src;
                });
            }

            // Précharger au chargement
            preloadImages();

            // ===== ANIMATION DES CHIFFRES =====
            function animateCounter(element) {
                const target = parseInt(element.dataset.count);
                if (target === 0) {
                    element.textContent = '0';
                    return;
                }
                
                const duration = 1500;
                const step = target / (duration / 16);
                let current = 0;
                
                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        element.textContent = target.toLocaleString();
                        clearInterval(timer);
                    } else {
                        element.textContent = Math.floor(current).toLocaleString();
                    }
                }, 16);
            }

            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counters = entry.target.querySelectorAll('.stat-number-premium');
                        counters.forEach((counter, index) => {
                            setTimeout(() => {
                                animateCounter(counter);
                            }, index * 200);
                        });
                        statsObserver.unobserve(entry.target);
                    }
                });
            }, { 
                threshold: 0.3,
                rootMargin: '50px'
            });

            statsObserver.observe(document.querySelector('.stats-section'));

            // ===== ANIMATION DES CARTES =====
            const cardObserver = new IntersectionObserver((entries) => {
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

            // Observer les cartes de contenu
            document.querySelectorAll('.preview-card-premium').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                cardObserver.observe(card);
            });

            // Observer les cartes média
            document.querySelectorAll('.media-card-premium').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                cardObserver.observe(card);
            });

            // Observer les cartes de statistiques
            document.querySelectorAll('.stat-card-premium').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
                cardObserver.observe(card);
            });

            // ===== EFFET PARALLAXE AMÉLIORÉ =====
            document.querySelectorAll('.thumbnail-container').forEach(container => {
                container.addEventListener('mousemove', function(e) {
                    const img = this.querySelector('.media-image');
                    if (!img) return;
                    
                    const x = e.clientX - this.getBoundingClientRect().left;
                    const y = e.clientY - this.getBoundingClientRect().top;
                    
                    const moveX = (x / this.offsetWidth - 0.5) * 15;
                    const moveY = (y / this.offsetHeight - 0.5) * 15;
                    
                    img.style.transform = `scale(1.05) translate(${moveX}px, ${moveY}px)`;
                });
                
                container.addEventListener('mouseleave', function() {
                    const img = this.querySelector('.media-image');
                    if (img) {
                        img.style.transform = 'scale(1) translate(0, 0)';
                    }
                });
            });

            // ===== SMOOTH SCROLL =====
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 80,
                            behavior: 'smooth'
                        });
                    }
                });
            });
        });
    </script>
@endsection