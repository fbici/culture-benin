@extends('layouts.app')

@section('title', $media->titre . ' - Culture Benin')

@section('content')
<div class="media-detail-premium">
    <!-- Navigation Premium -->
    <div class="media-navigation-premium mb-5">
        <div class="container">
            <div class="navigation-inner">
                <a href="{{ route('media.index') }}" class="nav-back-btn">
                    <i class="bi bi-arrow-left me-2"></i>
                    Retour à la galerie
                </a>
                <div class="nav-path">
                    <span class="path-segment">
                        <i class="bi bi-folder2 me-1"></i>
                        Galerie
                    </span>
                    <i class="bi bi-chevron-right path-divider"></i>
                    <span class="path-current">
                        <i class="bi bi-file-earmark-fill me-1"></i>
                        {{ Str::limit($media->titre, 25) }}
                    </span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row g-5">
            <!-- Colonne principale -->
            <div class="col-lg-8">
                <!-- Header Premium -->
                <div class="media-header-premium mb-5">
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
                    @endphp
                    
                    <div class="header-badges-premium">
                        <span class="type-badge-premium" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                            <i class="bi bi-tag-fill me-2"></i>
                            {{ $mediaType }}
                        </span>
                        @if($media->is_premium)
                        <span class="premium-badge-premium">
                            <i class="bi bi-star-fill me-2"></i>
                            Premium
                        </span>
                        @endif
                        @if($media->downloads > 100)
                        <span class="trending-badge-premium">
                            <i class="bi bi-fire me-2"></i>
                            Tendance
                        </span>
                        @endif
                    </div>
                    
                    <h1 class="media-title-premium">
                        {{ $media->titre }}
                        <div class="title-underline" style="background: linear-gradient(90deg, {{ $typeColor }}, transparent);"></div>
                    </h1>
                    
                    <!-- Métadonnées Premium -->
                    <div class="metadata-grid-premium">
                        <div class="metadata-card-premium">
                            <div class="metadata-icon" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                <i class="bi bi-calendar2-check-fill"></i>
                            </div>
                            <div class="metadata-content">
                                <div class="metadata-label">Ajouté le</div>
                                <div class="metadata-value">
                                    {{ $media->created_at->format('d/m/Y') }}
                                    <small>à {{ $media->created_at->format('H:i') }}</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="metadata-card-premium">
                            <div class="metadata-icon" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                <i class="bi bi-download-fill"></i>
                            </div>
                            <div class="metadata-content">
                                <div class="metadata-label">Téléchargements</div>
                                <div class="metadata-value">
                                    <span class="download-count">{{ $media->downloads ?? 0 }}</span>
                                    <small class="download-trend text-success">
                                        <i class="bi bi-arrow-up-right"></i> +{{ min(100, $media->downloads) }}%
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        @if($media->taille_fichier)
                        <div class="metadata-card-premium">
                            <div class="metadata-icon" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                <i class="bi bi-hdd-fill"></i>
                            </div>
                            <div class="metadata-content">
                                <div class="metadata-label">Taille</div>
                                <div class="metadata-value">
                                    {{ $media->taille_formatee }}
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if($media->resolution)
                        <div class="metadata-card-premium">
                            <div class="metadata-icon" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                <i class="bi bi-aspect-ratio-fill"></i>
                            </div>
                            <div class="metadata-content">
                                <div class="metadata-label">Résolution</div>
                                <div class="metadata-value">
                                    {{ $media->resolution }}
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if($media->duree_formatee && $media->duree_formatee != 'N/A')
                        <div class="metadata-card-premium">
                            <div class="metadata-icon" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                <i class="bi bi-clock-fill"></i>
                            </div>
                            <div class="metadata-content">
                                <div class="metadata-label">Durée</div>
                                <div class="metadata-value">
                                    {{ $media->duree_formatee }}
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @if($media->extension)
                        <div class="metadata-card-premium">
                            <div class="metadata-icon" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                @php
                                    $typeIcons = [
                                        'Image' => 'bi-image-fill',
                                        'Vidéo' => 'bi-camera-video-fill',
                                        'Audio' => 'bi-music-note-beamed',
                                        'PDF' => 'bi-file-earmark-pdf-fill',
                                        'Document' => 'bi-file-earmark-text-fill'
                                    ];
                                    $typeIcon = $typeIcons[$mediaType] ?? 'bi-file-earmark-fill';
                                @endphp
                                <i class="bi {{ $typeIcon }}"></i>
                            </div>
                            <div class="metadata-content">
                                <div class="metadata-label">Format</div>
                                <div class="metadata-value">
                                    {{ strtoupper($media->extension) }}
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    
                    <!-- Description -->
                    @if($media->description)
                    <div class="media-description-detailed mt-4">
                        <h4 class="description-title">
                            <i class="bi bi-card-text me-2"></i>
                            Description
                        </h4>
                        <div class="description-content">
                            {!! nl2br(e($media->description)) !!}
                        </div>
                    </div>
                    @endif
                    
                    <!-- Tags -->
                    @if($media->tags && count($media->tags) > 0)
                    <div class="media-tags-detailed mt-4">
                        <h4 class="tags-title">
                            <i class="bi bi-tags me-2"></i>
                            Mots-clés
                        </h4>
                        <div class="tags-container">
                            @foreach($media->tags as $tag)
                                <span class="tag-detailed" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                    {{ trim($tag) }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                    
                    <!-- Copyright & Auteur -->
                    @if($media->copyright || $media->auteur_original)
                    <div class="copyright-info mt-4">
                        <h4 class="copyright-title">
                            <i class="bi bi-info-circle me-2"></i>
                            Informations légales
                        </h4>
                        <div class="copyright-content">
                            @if($media->auteur_original)
                            <div class="copyright-item">
                                <i class="bi bi-person-fill me-2"></i>
                                <strong>Auteur original :</strong> {{ $media->auteur_original }}
                            </div>
                            @endif
                            @if($media->copyright)
                            <div class="copyright-item">
                                <i class="bi bi-c-circle-fill me-2"></i>
                                <strong>Copyright :</strong> {{ $media->copyright }}
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Aperçu Premium -->
                <div class="preview-section-premium mb-5">
                    <div class="section-header-premium">
                        <div class="section-title">
                            @php
                                $previewIcons = [
                                    'Image' => 'bi-image-fill',
                                    'Vidéo' => 'bi-play-btn-fill',
                                    'Audio' => 'bi-music-note-beamed',
                                    'PDF' => 'bi-file-earmark-pdf-fill',
                                    'Document' => 'bi-file-earmark-text-fill'
                                ];
                                $previewIcon = $previewIcons[$mediaType] ?? 'bi-file-earmark-fill';
                            @endphp
                            <i class="bi {{ $previewIcon }} me-2"></i>
                            <h3>Prévisualisation</h3>
                        </div>
                        @if(!$media->is_premium)
                        <div class="section-badge-free">
                            <i class="bi bi-unlock-fill me-1"></i>
                            Accès gratuit
                        </div>
                        @endif
                    </div>
                    
                    <div class="preview-container-premium">
                            @if($mediaType == 'Image' && $media->Chemin)
                            @php
                                $imageUrl = asset('storage/' . $media->Chemin);
                                // Vérifier si le fichier existe
                                $storagePath = 'public/' . $media->Chemin;
                                $fileExists = Storage::exists($storagePath);
                            @endphp
                            @if($fileExists)
                            <div class="image-preview-wrapper">
                                <img src="{{ $imageUrl }}" 
                                    alt="{{ $media->titre }}"
                                    class="media-preview-image"
                                    loading="lazy"
                                    onerror="this.onerror=null; this.src='/images/placeholder-image.png'; this.alt='Image non disponible';">
                                <div class="image-overlay-premium">
                                    <button class="overlay-btn-fullscreen" onclick="openFullscreen()">
                                        <i class="bi bi-arrows-fullscreen"></i>
                                    </button>
                                    <div class="image-info">
                                        @if($media->resolution)
                                        <span class="resolution-badge">{{ $media->resolution }}</span>
                                        @endif
                                        @if($media->taille_formatee)
                                        <span class="size-badge">{{ $media->taille_formatee }}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="preview-fallback-premium">
                                <div class="fallback-icon" style="color: {{ $typeColor }};">
                                    <i class="bi bi-image-fill"></i>
                                </div>
                                <h4>Image non disponible</h4>
                                <p class="text-muted">L'image n'a pas pu être chargée</p>
                            </div>
                            @endif
                        @elseif($media->est_video)
                            <div class="video-preview-premium">
                                <div class="video-placeholder">
                                    <div class="placeholder-icon" style="color: {{ $typeColor }};">
                                        <i class="bi bi-camera-video-fill"></i>
                                    </div>
                                    <h4>Contenu vidéo</h4>
                                    <p class="text-muted">Téléchargez pour visualiser la vidéo complète</p>
                                    @if($media->duree_formatee && $media->duree_formatee != 'N/A')
                                    <div class="video-stats">
                                        <span class="stat-item">
                                            <i class="bi bi-clock"></i>
                                            {{ $media->duree_formatee }}
                                        </span>
                                        @if($media->taille_formatee)
                                        <span class="stat-item">
                                            <i class="bi bi-hdd"></i>
                                            {{ $media->taille_formatee }}
                                        </span>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @elseif($media->est_audio)
                            <div class="audio-preview-premium">
                                <div class="audio-player-simulated">
                                    <div class="player-header">
                                        <div class="track-info">
                                            <div class="track-cover" style="background: {{ $typeBg }};">
                                                <i class="bi bi-music-note-beamed"></i>
                                            </div>
                                            <div class="track-details">
                                                <h5>{{ $media->titre }}</h5>
                                                <p>{{ Str::limit($media->description, 50) }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="player-controls">
                                        <div class="progress-simulated">
                                            <div class="progress-bar" style="width: 45%"></div>
                                        </div>
                                        <div class="time-display">
                                            <span>0:00</span>
                                            @if($media->duree_formatee && $media->duree_formatee != 'N/A')
                                            <span>{{ $media->duree_formatee }}</span>
                                            @else
                                            <span>--:--</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="document-preview-premium">
                                <div class="document-placeholder">
                                    <div class="placeholder-icon" style="color: {{ $typeColor }};">
                                        <i class="bi bi-file-earmark-text-fill"></i>
                                    </div>
                                    <h4>Document {{ $media->extension ? strtoupper($media->extension) : '' }}</h4>
                                    <p class="text-muted">Téléchargez pour consulter le contenu complet</p>
                                    <div class="document-info">
                                        @if($media->extension)
                                        <span class="info-item">
                                            <i class="bi bi-file-text"></i>
                                            {{ strtoupper($media->extension) }}
                                        </span>
                                        @endif
                                        @if($media->taille_formatee)
                                        <span class="info-item">
                                            <i class="bi bi-file-earmark"></i>
                                            {{ $media->taille_formatee }}
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Section Téléchargement Premium -->
                <div class="download-section-premium">
                    <div class="section-header-premium">
                        <div class="section-title">
                            <i class="bi bi-cloud-arrow-down-fill me-2"></i>
                            <h3>Accès et Téléchargement</h3>
                        </div>
                    </div>
                    
                    <div class="download-content-premium">
                        @php
                            // Logique pour vérifier si l'utilisateur a accès au média
                            $canDownload = !$media->is_premium || 
                                         (auth()->check() && (auth()->user()->hasPurchasedMedia($media->id_media) || 
                                                              auth()->user()->is_admin));
                        @endphp
                        
                        @if($canDownload)
                            <!-- Accès accordé -->
                            <div class="access-granted">
                                <div class="access-header">
                                    <div class="access-icon">
                                        <i class="bi bi-unlock-fill"></i>
                                        <div class="access-glow"></div>
                                    </div>
                                    <h4>Accès accordé</h4>
                                    <p>Vous avez accès à ce média</p>
                                </div>
                                
                                <div class="download-actions-premium">
                                    <a href="{{ route('medias.download', $media->id_media) }}" 
                                       class="btn-download-premium">
                                        <i class="bi bi-download-fill me-2"></i>
                                        Télécharger maintenant
                                        <div class="btn-sparkle"></div>
                                    </a>
                                    
                                    @if($media->is_premium && auth()->check() && auth()->user()->hasPurchasedMedia($media->id_media))
                                    <div class="access-features">
                                        <div class="feature-item">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                            <span>Accès à vie</span>
                                        </div>
                                        <div class="feature-item">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                            <span>Téléchargements illimités</span>
                                        </div>
                                        <div class="feature-item">
                                            <i class="bi bi-check-circle-fill text-success"></i>
                                            <span>Support inclus</span>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        @else
                            <!-- Paiement requis -->
                            <div class="payment-required-premium">
                                <div class="payment-header-premium">
                                    <div class="lock-icon-premium">
                                        <i class="bi bi-lock-fill"></i>
                                        <div class="lock-shine"></div>
                                    </div>
                                    <h4>Contenu Premium</h4>
                                    <p>Débloquez l'accès complet à ce média</p>
                                </div>
                                
                                <div class="pricing-card-premium">
                                    <div class="pricing-header">
                                        <div class="price-display-premium">
                                            <span class="price-amount">{{ number_format($media->prix, 0, ',', ' ') }}</span>
                                            <span class="price-currency">FCFA</span>
                                        </div>
                                        <div class="price-badge">
                                            <i class="bi bi-lightning-fill"></i>
                                            Accès instantané
                                        </div>
                                    </div>
                                    
                                    <div class="pricing-features">
                                        <h5>Ce que vous obtenez :</h5>
                                        <ul class="features-list">
                                            <li>
                                                <i class="bi bi-check-circle-fill text-success"></i>
                                                <span>Accès complet au média</span>
                                            </li>
                                            <li>
                                                <i class="bi bi-check-circle-fill text-success"></i>
                                                <span>Téléchargement illimité</span>
                                            </li>
                                            <li>
                                                <i class="bi bi-check-circle-fill text-success"></i>
                                                <span>Accès à vie</span>
                                            </li>
                                            <li>
                                                <i class="bi bi-check-circle-fill text-success"></i>
                                                <span>Support technique</span>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    @auth
                                        <button class="btn-pay-premium" id="payMediaButton" data-price="{{ $media->prix }}">
                                            <i class="bi bi-credit-card-fill me-2"></i>
                                            Acheter maintenant
                                            <div class="btn-sparkle"></div>
                                        </button>
                                        
                                        <div class="security-premium">
                                            <i class="bi bi-shield-check"></i>
                                            <span>Paiement 100% sécurisé</span>
                                        </div>
                                    @else
                                        <div class="auth-required-premium">
                                            <div class="auth-card">
                                                <i class="bi bi-person-check-fill auth-icon"></i>
                                                <h5>Connexion requise</h5>
                                                <p>Connectez-vous pour acheter ce média</p>
                                                <div class="auth-actions">
                                                    <a href="{{ route('login') }}" class="btn-auth-login">
                                                        <i class="bi bi-box-arrow-in-right me-2"></i>
                                                        Se connecter
                                                    </a>
                                                    <a href="{{ route('register') }}" class="btn-auth-register">
                                                        <i class="bi bi-person-plus-fill me-2"></i>
                                                        S'inscrire
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endauth
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Sidebar Premium -->
            <div class="col-lg-4">
                <!-- Carte Auteur -->
                <div class="sidebar-card-premium mb-4">
                    <div class="card-header-premium">
                        <h4>
                            <i class="bi bi-person-badge-fill me-2"></i>
                            Contributeur
                        </h4>
                    </div>
                    <div class="author-card-premium">
                        <div class="author-avatar-premium">
                            {{ strtoupper(substr($media->user->prenom ?? 'C', 0, 1)) }}
                            <div class="avatar-status"></div>
                        </div>
                        <div class="author-info-premium">
                            <h5>{{ $media->user->prenom ?? 'Anonyme' }} {{ $media->user->nom ?? '' }}</h5>
                            <p class="author-title">Contributeur Culture Benin</p>
                            <div class="author-rating">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="rating-text">4.7/5</span>
                            </div>
                        </div>
                        <div class="author-stats-premium">
                            <div class="stat-item-premium">
                                <div class="stat-number">{{ $media->user->medias_count ?? rand(5, 50) }}</div>
                                <div class="stat-label">Médias</div>
                            </div>
                            <div class="stat-divider"></div>
                            <div class="stat-item-premium">
                                <div class="stat-number">{{ $media->user->total_downloads ?? rand(100, 5000) }}</div>
                                <div class="stat-label">Téléchargements</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Actions Premium -->
                <div class="sidebar-card-premium mb-4">
                    <div class="card-header-premium">
                        <h4>
                            <i class="bi bi-lightning-charge-fill me-2"></i>
                            Actions Rapides
                        </h4>
                    </div>
                    <div class="actions-grid-premium">
                        <button class="action-btn-premium print" onclick="window.print()">
                            <div class="action-icon">
                                <i class="bi bi-printer-fill"></i>
                            </div>
                            <span>Imprimer</span>
                        </button>
                        
                        <button class="action-btn-premium share" onclick="shareMedia()">
                            <div class="action-icon">
                                <i class="bi bi-share-fill"></i>
                            </div>
                            <span>Partager</span>
                        </button>
                        
                        <button class="action-btn-premium favorite" onclick="addToFavorites()">
                            <div class="action-icon">
                                <i class="bi bi-heart-fill"></i>
                            </div>
                            <span>Favoris</span>
                        </button>
                        
                       
                    </div>
                </div>
                
                <!-- Informations Techniques Premium -->
                <div class="sidebar-card-premium mb-4">
                    <div class="card-header-premium">
                        <h4>
                            <i class="bi bi-gear-fill me-2"></i>
                            Informations Techniques
                        </h4>
                    </div>
                    <div class="tech-info-premium">
                        @if($media->extension)
                        <div class="tech-item-premium">
                            <div class="tech-icon" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                <i class="bi bi-filetype-{{ strtolower($media->extension) }}"></i>
                            </div>
                            <div class="tech-content">
                                <div class="tech-label">Format</div>
                                <div class="tech-value">{{ strtoupper($media->extension) }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($media->resolution)
                        <div class="tech-item-premium">
                            <div class="tech-icon" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                <i class="bi bi-aspect-ratio"></i>
                            </div>
                            <div class="tech-content">
                                <div class="tech-label">Résolution</div>
                                <div class="tech-value">{{ $media->resolution }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($media->taille_fichier)
                        <div class="tech-item-premium">
                            <div class="tech-icon" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                <i class="bi bi-hdd"></i>
                            </div>
                            <div class="tech-content">
                                <div class="tech-label">Taille</div>
                                <div class="tech-value">{{ $media->taille_formatee }}</div>
                            </div>
                        </div>
                        @endif
                        
                        @if($media->mime_type)
                        <div class="tech-item-premium">
                            <div class="tech-icon" style="background: {{ $typeBg }}; color: {{ $typeColor }};">
                                <i class="bi bi-file-earmark"></i>
                            </div>
                            <div class="tech-content">
                                <div class="tech-label">Type MIME</div>
                                <div class="tech-value">{{ $media->mime_type }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                
                <!-- Médias Similaires Premium -->
                @if($similarMedias && $similarMedias->count() > 0)
                <div class="sidebar-card-premium">
                    <div class="card-header-premium">
                        <h4>
                            <i class="bi bi-collection-play-fill me-2"></i>
                            Médias Similaires
                        </h4>
                    </div>
                    <div class="similar-media-premium">
                        @foreach($similarMedias->take(3) as $similar)
                        @php
                            $similarType = $similar->typeMedia->nom ?? 'Document';
                            $similarTypeColor = $typeColors[$similarType] ?? '#6b7280';
                            $similarTypeBg = $similarTypeColor . '20';
                        @endphp
                        <div class="similar-item-premium">
                            <div class="similar-thumbnail-premium">
                                @if($similarType == 'Image' && Storage::exists('public/' . $similar->Chemin))
                                <img src="{{ Storage::url($similar->Chemin) }}" 
                                     alt="{{ $similar->titre }}"
                                     class="similar-img">
                                @else
                                <div class="similar-placeholder" style="background: {{ $similarTypeBg }}; color: {{ $similarTypeColor }};">
                                    @php
                                        $similarIcon = $typeIcons[$similarType] ?? 'bi-file-earmark-fill';
                                    @endphp
                                    <i class="bi {{ $similarIcon }}"></i>
                                </div>
                                @endif
                            </div>
                            <div class="similar-content-premium">
                                <h6 class="similar-title">
                                    <a href="{{ route('media.show', $similar->id_media) }}">
                                        {{ Str::limit($similar->titre, 40) }}
                                    </a>
                                </h6>
                                <div class="similar-meta">
                                    <span class="similar-type" style="color: {{ $similarTypeColor }};">{{ $similarType }}</span>
                                    @if($similar->is_premium && $similar->prix)
                                    <span class="similar-price">
                                        <i class="bi bi-coin"></i> {{ number_format($similar->prix, 0, ',', ' ') }} FCFA
                                    </span>
                                    @else
                                    <span class="similar-free">Gratuit</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal Fullscreen pour images -->
<div class="modal fade" id="imageFullscreenModal" tabindex="-1">
    <div class="modal-dialog modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $media->titre }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @if($media->est_image && Storage::exists('public/' . $media->Chemin))
                <img src="{{ Storage::url($media->Chemin) }}" 
                    alt="{{ $media->titre }}"
                    class="img-fluid"
                    style="max-height: 85vh; width: auto; display: block; margin: 0 auto;">
                @endif
            </div>
        </div>
    </div>
</div>

<style>
    /* ===== STYLES PAGE MÉDIA PREMIUM ===== */
    .media-detail-premium {
        min-height: 100vh;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 100px 0 60px;
    }
    
    /* ===== NAVIGATION PREMIUM ===== */
    .media-navigation-premium {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        padding: 1rem 0;
        margin-bottom: 3rem;
        box-shadow: 0 4px 20px rgba(30, 60, 114, 0.2);
    }
    
    .navigation-inner {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .nav-back-btn {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
    }
    
    .nav-back-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        transform: translateX(-5px);
    }
    
    .nav-path {
        display: flex;
        align-items: center;
        color: white;
        font-weight: 500;
    }
    
    .path-segment {
        display: flex;
        align-items: center;
        padding: 0.3rem 0.8rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 6px;
    }
    
    .path-divider {
        margin: 0 0.5rem;
        opacity: 0.5;
    }
    
    .path-current {
        color: white;
        font-weight: 600;
        display: flex;
        align-items: center;
        padding: 0.3rem 0.8rem;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 6px;
    }
    
    /* ===== HEADER PREMIUM ===== */
    .media-header-premium {
        background: white;
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        margin-bottom: 3rem;
    }
    
    .header-badges-premium {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .type-badge-premium,
    .premium-badge-premium,
    .trending-badge-premium {
        padding: 0.6rem 1.2rem;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }
    
    .premium-badge-premium {
        background: linear-gradient(135deg, #ffd700, #ffed4e);
        color: #856404;
    }
    
    .trending-badge-premium {
        background: linear-gradient(135deg, #f72585, #e0247e);
        color: white;
    }
    
    .media-title-premium {
        font-size: 2.5rem;
        font-weight: 900;
        color: #1a202c;
        margin-bottom: 2rem;
        line-height: 1.2;
        position: relative;
        padding-bottom: 1.5rem;
    }
    
    .title-underline {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, var(--type-color, #4361ee), transparent);
        border-radius: 2px;
    }
    
    .metadata-grid-premium {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }
    
    .metadata-card-premium {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.2rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 16px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }
    
    .metadata-card-premium:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }
    
    .metadata-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    
    .metadata-content {
        flex: 1;
    }
    
    .metadata-label {
        font-size: 0.8rem;
        color: #6b7280;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
    }
    
    .metadata-value {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
    }
    
    .metadata-value small {
        font-size: 0.85rem;
        font-weight: 500;
        color: #6b7280;
        margin-left: 0.5rem;
    }
    
    .download-count {
        font-size: 1.5rem;
        color: #f59e0b;
    }
    
    .download-trend {
        font-size: 0.85rem;
        margin-left: 0.5rem;
    }
    
    /* ===== APERÇU PREMIUM ===== */
    .preview-section-premium {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        margin-bottom: 3rem;
    }
    
    .section-header-premium {
        background: linear-gradient(135deg, #4a6fa5 0%, #3a5988 100%);
        color: white;
        padding: 1.5rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .section-title {
        display: flex;
        align-items: center;
    }
    
    .section-title h3 {
        margin: 0;
        font-size: 1.3rem;
        font-weight: 700;
    }
    
    .section-badge-free {
        background: white;
        color: #10b981;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
    }
    
    .preview-container-premium {
        padding: 2rem;
    }
    
    /* Image Preview */
    .image-preview-wrapper {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        background: #f8f9fa;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .media-preview-image {
        max-height: 100%;
        max-width: 100%;
        object-fit: contain;
        transition: transform 0.3s ease;
    }
    
    .image-preview-wrapper:hover .media-preview-image {
        transform: scale(1.02);
    }
    
    .image-overlay-premium {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(to bottom, rgba(0,0,0,0.1), transparent 30%, transparent 70%, rgba(0,0,0,0.1));
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .image-preview-wrapper:hover .image-overlay-premium {
        opacity: 1;
    }
    
    .overlay-btn-fullscreen {
        width: 50px;
        height: 50px;
        background: white;
        border-radius: 50%;
        border: none;
        color: #4a6fa5;
        font-size: 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
    
    .overlay-btn-fullscreen:hover {
        background: #4a6fa5;
        color: white;
        transform: scale(1.1);
    }
    
    .image-info {
        display: flex;
        gap: 0.8rem;
    }
    
    .resolution-badge,
    .size-badge {
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        backdrop-filter: blur(10px);
    }
    
    /* Fallback Styles */
    .preview-fallback-premium,
    .video-preview-premium,
    .audio-preview-premium,
    .document-preview-premium {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        padding: 3rem 2rem;
        text-align: center;
        background: #f8f9fa;
        border-radius: 16px;
        border: 2px dashed #e2e8f0;
    }
    
    .fallback-icon,
    .placeholder-icon {
        font-size: 4rem;
        margin-bottom: 1.5rem;
    }
    
    .video-preview-premium h4,
    .document-preview-premium h4 {
        color: #1f2937;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .video-stats,
    .document-info {
        display: flex;
        gap: 1.5rem;
        margin-top: 1.5rem;
    }
    
    .stat-item,
    .info-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-weight: 500;
    }
    
    /* Audio Player Simulated */
    .audio-player-simulated {
        background: white;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
        margin: 0 auto;
    }
    
    .player-header {
        background: linear-gradient(135deg, #7209b7, #6509a4);
        color: white;
        padding: 1.5rem;
    }
    
    .track-info {
        display: flex;
        align-items: center;
        gap: 1rem;
    }
    
    .track-cover {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
    }
    
    .track-details h5 {
        margin: 0 0 0.25rem;
        font-size: 1.2rem;
    }
    
    .track-details p {
        margin: 0;
        opacity: 0.9;
        font-size: 0.9rem;
    }
    
    .player-controls {
        padding: 1.5rem;
    }
    
    .progress-simulated {
        height: 6px;
        background: #e2e8f0;
        border-radius: 3px;
        overflow: hidden;
        margin-bottom: 0.5rem;
    }
    
    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, #7209b7, #a370f7);
        border-radius: 3px;
    }
    
    .time-display {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        color: #6b7280;
        font-weight: 500;
    }
    
    /* ===== SECTION TÉLÉCHARGEMENT PREMIUM ===== */
    .download-section-premium {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
    }
    
    .download-content-premium {
        padding: 2rem;
    }
    
    /* Accès accordé */
    .access-granted {
        text-align: center;
    }
    
    .access-header {
        margin-bottom: 2rem;
    }
    
    .access-icon {
        font-size: 4rem;
        color: #10b981;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
    }
    
    .access-glow {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        background: radial-gradient(circle, rgba(16, 185, 129, 0.4) 0%, transparent 70%);
        border-radius: 50%;
        animation: pulseGlow 2s infinite;
    }
    
    .access-header h4 {
        color: #065f46;
        font-weight: 900;
        margin-bottom: 0.5rem;
    }
    
    .access-header p {
        color: #6b7280;
        font-size: 1.1rem;
    }
    
    .btn-download-premium {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        border: none;
        padding: 1.2rem 2.5rem;
        border-radius: 15px;
        font-weight: 800;
        font-size: 1.1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        width: 100%;
        max-width: 400px;
    }
    
    .btn-download-premium:hover {
        background: linear-gradient(135deg, #34d399, #10b981);
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(16, 185, 129, 0.4);
        color: white;
    }
    
    .access-features {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        max-width: 500px;
        margin: 0 auto;
    }
    
    /* Paiement requis */
    .payment-required-premium {
        text-align: center;
    }
    
    .payment-header-premium {
        margin-bottom: 2rem;
    }
    
    .lock-icon-premium {
        font-size: 4rem;
        color: #f59e0b;
        margin-bottom: 1.5rem;
        position: relative;
        display: inline-block;
    }
    
    .lock-shine {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 80px;
        height: 80px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.4) 0%, transparent 70%);
        border-radius: 50%;
        animation: pulseGlow 2s infinite;
    }
    
    .payment-header-premium h4 {
        font-size: 1.8rem;
        font-weight: 900;
        color: #92400e;
        margin-bottom: 0.5rem;
    }
    
    .payment-header-premium p {
        color: #b45309;
        font-size: 1.1rem;
    }
    
    .pricing-card-premium {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(0, 0, 0, 0.05);
        border: 2px solid #f59e0b;
        max-width: 400px;
        margin: 0 auto;
    }
    
    .pricing-header {
        text-align: center;
        margin-bottom: 2rem;
        position: relative;
    }
    
    .price-display-premium {
        margin-bottom: 1rem;
    }
    
    .price-amount {
        font-size: 4rem;
        font-weight: 900;
        color: #92400e;
        line-height: 1;
    }
    
    .price-currency {
        font-size: 2rem;
        font-weight: 700;
        color: #92400e;
        margin-left: 0.5rem;
    }
    
    .price-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        padding: 0.5rem 1.2rem;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.9rem;
    }
    
    .pricing-features {
        margin-bottom: 2rem;
        text-align: left;
    }
    
    .pricing-features h5 {
        color: #1f2937;
        font-weight: 700;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }
    
    .features-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .features-list li {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.8rem 0;
        border-bottom: 1px solid #f3f4f6;
    }
    
    .features-list li:last-child {
        border-bottom: none;
    }
    
    .features-list li span {
        color: #4b5563;
        font-weight: 600;
    }
    
    .btn-pay-premium {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
        color: white;
        border: none;
        padding: 1.2rem 2rem;
        border-radius: 15px;
        font-weight: 800;
        font-size: 1.1rem;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .btn-pay-premium:hover {
        background: linear-gradient(135deg, #d97706 0%, #b45309 100%);
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(245, 158, 11, 0.4);
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
    
    .btn-pay-premium:hover .btn-sparkle,
    .btn-download-premium:hover .btn-sparkle {
        opacity: 1;
        animation: sparkle 0.6s ease-out;
    }
    
    .security-premium {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        color: #6b7280;
        font-size: 0.9rem;
        font-weight: 600;
    }
    
    .security-premium i {
        color: #10b981;
        font-size: 1.1rem;
    }
    
    /* Authentification requise */
    .auth-required-premium {
        margin-top: 1.5rem;
    }
    
    .auth-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        box-shadow: 
            0 10px 30px rgba(0, 0, 0, 0.1),
            0 0 0 1px rgba(0, 0, 0, 0.05);
        border: 2px solid #3b82f6;
    }
    
    .auth-icon {
        font-size: 3rem;
        color: #3b82f6;
        margin-bottom: 1.5rem;
    }
    
    .auth-card h5 {
        color: #1e40af;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }
    
    .auth-card p {
        color: #4b5563;
        margin-bottom: 1.5rem;
    }
    
    .auth-actions {
        display: flex;
        gap: 1rem;
        justify-content: center;
    }
    
    .btn-auth-login {
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        color: white;
        padding: 0.8rem 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .btn-auth-login:hover {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        color: white;
        transform: translateY(-3px);
    }
    
    .btn-auth-register {
        background: white;
        color: #3b82f6;
        border: 2px solid #3b82f6;
        padding: 0.8rem 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
    }
    
    .btn-auth-register:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-3px);
    }
    
    /* ===== SIDEBAR PREMIUM ===== */
    .sidebar-card-premium {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 
            0 15px 40px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    
    .card-header-premium {
        border-bottom: 2px solid #f3f4f6;
        padding-bottom: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .card-header-premium h4 {
        color: #1f2937;
        font-weight: 800;
        font-size: 1.2rem;
        margin: 0;
        display: flex;
        align-items: center;
    }
    
    /* Carte Auteur Premium */
    .author-card-premium {
        text-align: center;
    }
    
    .author-avatar-premium {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        font-weight: 800;
        margin: 0 auto 1.5rem;
        position: relative;
    }
    
    .avatar-status {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 16px;
        height: 16px;
        background: #10b981;
        border: 3px solid white;
        border-radius: 50%;
    }
    
    .author-info-premium h5 {
        font-size: 1.2rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }
    
    .author-title {
        color: #6b7280;
        margin-bottom: 1rem;
        font-size: 0.9rem;
    }
    
    .author-rating {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .stars {
        color: #f59e0b;
        font-size: 0.9rem;
    }
    
    .rating-text {
        color: #6b7280;
        font-weight: 700;
        font-size: 0.85rem;
    }
    
    .author-stats-premium {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 12px;
    }
    
    .stat-item-premium {
        text-align: center;
    }
    
    .stat-number {
        font-size: 1.5rem;
        font-weight: 900;
        color: #3b82f6;
        line-height: 1;
    }
    
    .stat-label {
        font-size: 0.8rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }
    
    .stat-divider {
        width: 1px;
        height: 30px;
        background: #e5e7eb;
    }
    
    /* Actions Premium */
    .actions-grid-premium {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .action-btn-premium {
        background: white;
        border: 2px solid #e5e7eb;
        padding: 1rem;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
    }
    
    .action-btn-premium:hover {
        transform: translateY(-5px);
    }
    
    .action-btn-premium.print:hover { border-color: #f59e0b; }
    .action-btn-premium.share:hover { border-color: #8b5cf6; }
    .action-btn-premium.favorite:hover { border-color: #ef4444; }
    .action-btn-premium.report:hover { border-color: #10b981; }
    
    .action-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
    }
    
    .action-btn-premium.print .action-icon { background: linear-gradient(135deg, #f59e0b, #fbbf24); }
    .action-btn-premium.share .action-icon { background: linear-gradient(135deg, #8b5cf6, #a78bfa); }
    .action-btn-premium.favorite .action-icon { background: linear-gradient(135deg, #ef4444, #f87171); }
    .action-btn-premium.report .action-icon { background: linear-gradient(135deg, #10b981, #34d399); }
    
    .action-btn-premium span {
        font-weight: 700;
        color: #374151;
        font-size: 0.85rem;
    }
    
    /* Informations Techniques Premium */
    .tech-info-premium {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .tech-item-premium {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .tech-item-premium:hover {
        background: white;
        border-color: #3b82f6;
        transform: translateX(5px);
    }
    
    .tech-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    
    .tech-content {
        flex: 1;
    }
    
    .tech-label {
        font-size: 0.75rem;
        color: #6b7280;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }
    
    .tech-value {
        font-size: 0.95rem;
        font-weight: 700;
        color: #1f2937;
    }
    
    /* Médias Similaires Premium */
    .similar-media-premium {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .similar-item-premium {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .similar-item-premium:hover {
        background: white;
        border-color: #3b82f6;
        transform: translateX(5px);
    }
    
    .similar-thumbnail-premium {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        overflow: hidden;
        flex-shrink: 0;
        background: white;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .similar-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .similar-placeholder {
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .similar-content-premium {
        flex: 1;
        min-width: 0;
    }
    
    .similar-title {
        font-size: 0.9rem;
        font-weight: 700;
        margin: 0 0 0.5rem;
        line-height: 1.3;
    }
    
    .similar-title a {
        color: #1f2937;
        text-decoration: none;
    }
    
    .similar-title a:hover {
        color: #3b82f6;
    }
    
    .similar-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .similar-type {
        font-size: 0.75rem;
        font-weight: 700;
        background: rgba(0, 0, 0, 0.05);
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
    }
    
    .similar-price {
        font-size: 0.8rem;
        font-weight: 700;
        color: #f59e0b;
        display: flex;
        align-items: center;
        gap: 0.3rem;
    }
    
    /* ===== ANIMATIONS ===== */
    @keyframes pulseGlow {
        0% { transform: translate(-50%, -50%) scale(1); opacity: 0.4; }
        50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.6; }
        100% { transform: translate(-50%, -50%) scale(1); opacity: 0.4; }
    }
    
    @keyframes sparkle {
        0% { transform: translate(-50%, -50%) scale(0); opacity: 0; }
        50% { transform: translate(-50%, -50%) scale(1.5); opacity: 0.8; }
        100% { transform: translate(-50%, -50%) scale(2); opacity: 0; }
    }
    
    /* ===== RESPONSIVE ===== */
    @media (max-width: 1200px) {
        .media-title-premium {
            font-size: 2.2rem;
        }
        
        .metadata-grid-premium {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 992px) {
        .media-detail-premium {
            padding: 90px 0 40px;
        }
        
        .media-title-premium {
            font-size: 2rem;
        }
        
        .navigation-inner {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .nav-path {
            width: 100%;
            justify-content: center;
        }
    }
    
    @media (max-width: 768px) {
        .media-detail-premium {
            padding: 80px 0 30px;
        }
        
        .media-header-premium {
            padding: 1.5rem;
        }
        
        .media-title-premium {
            font-size: 1.7rem;
        }
        
        .metadata-grid-premium {
            grid-template-columns: 1fr;
        }
        
        .section-header-premium {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .auth-actions {
            flex-direction: column;
        }
        
        .actions-grid-premium {
            grid-template-columns: 1fr;
        }
        
        .image-preview-wrapper {
            height: 300px;
        }
    }
    
    @media (max-width: 576px) {
        .media-title-premium {
            font-size: 1.5rem;
        }
        
        .header-badges-premium {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .type-badge-premium,
        .premium-badge-premium,
        .trending-badge-premium {
            width: fit-content;
        }
        
        .price-amount {
            font-size: 3rem;
        }
        
        .author-stats-premium {
            flex-direction: column;
            gap: 1rem;
        }
        
        .stat-divider {
            width: 100%;
            height: 1px;
        }
        
        .video-stats,
        .document-info {
            flex-direction: column;
            gap: 0.5rem;
        }
    }

    /* Description détaillée */
    .media-description-detailed {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 1.5rem;
    }
    
    .description-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #495057;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }
    
    .description-content {
        color: #6c757d;
        line-height: 1.6;
        font-size: 0.95rem;
    }
    
    /* Tags détaillés */
    .media-tags-detailed {
        margin-top: 1.5rem;
    }
    
    .tags-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #495057;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }
    
    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
    }
    
    .tag-detailed {
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
    }
    
    /* Copyright */
    .copyright-info {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 1.5rem;
        margin-top: 1.5rem;
    }
    
    .copyright-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #495057;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
    }
    
    .copyright-content {
        color: #6c757d;
        font-size: 0.9rem;
    }
    
    .copyright-item {
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
    }
    
    .copyright-item:last-child {
        margin-bottom: 0;
    }
    
    /* Médias similaires */
    .similar-free {
        font-size: 0.8rem;
        font-weight: 600;
        color: #198754;
        background: rgba(25, 135, 84, 0.1);
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
    }
    
    /* Métadonnées grid améliorée */
    .metadata-grid-premium {
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    }
    
    /* Section premium badge */
    .section-badge-free {
        background: white;
        color: #10b981;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
    }
    
    /* Bouton modifier */
    .action-btn-premium.edit .action-icon {
        background: linear-gradient(135deg, #0d6efd, #6ea8fe);
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animation des métadonnées
    const metadataCards = document.querySelectorAll('.metadata-card-premium');
    metadataCards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s ease';
        
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Animation du compteur de téléchargements
    const downloadCount = document.querySelector('.download-count');
    if (downloadCount) {
        const finalValue = parseInt(downloadCount.textContent);
        let currentValue = finalValue * 0.7;
        const increment = (finalValue - currentValue) / 30;
        
        const timer = setInterval(() => {
            currentValue += increment;
            if (currentValue >= finalValue) {
                downloadCount.textContent = finalValue;
                clearInterval(timer);
            } else {
                downloadCount.textContent = Math.floor(currentValue);
            }
        }, 50);
    }

    // Gestion du bouton de paiement
    const payButton = document.getElementById('payMediaButton');
    if (payButton) {
        payButton.addEventListener('click', function() {
            const originalText = payButton.innerHTML;
            const price = this.getAttribute('data-price');
            
            payButton.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Traitement...';
            payButton.disabled = true;
            
            // Simuler un traitement
            setTimeout(() => {
                // Dans show.blade.php (média)
                fetch('{{ route("media.payment.initiate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        media_id: {{ $media->id_media }}
                    })
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Erreur réseau');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success && data.payment_url) {
                        window.location.href = data.payment_url;
                    } else {
                        showNotification(data.message || 'Erreur lors du paiement', 'error');
                        payButton.innerHTML = originalText;
                        payButton.disabled = false;
                    }
                })
                .catch(error => {
                    console.error('Erreur:', error);
                    showNotification('Erreur réseau. Veuillez réessayer.', 'error');
                    payButton.innerHTML = originalText;
                    payButton.disabled = false;
                });
            }, 1000);
        });
    }

    // Bouton plein écran pour images
    function openFullscreen() {
        const modal = new bootstrap.Modal(document.getElementById('imageFullscreenModal'));
        modal.show();
    }

    // Gestion des favoris
    const favoriteBtn = document.querySelector('.action-btn-premium.favorite');
    if (favoriteBtn) {
        favoriteBtn.addEventListener('click', function() {
            const icon = this.querySelector('.action-icon i');
            if (icon.classList.contains('bi-heart-fill')) {
                icon.classList.remove('bi-heart-fill');
                icon.classList.add('bi-heart');
                showNotification('Retiré des favoris');
            } else {
                icon.classList.remove('bi-heart');
                icon.classList.add('bi-heart-fill');
                showNotification('Ajouté aux favoris');
            }
        });
    }

    // Fonction de partage
    window.shareMedia = function() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $media->description }}',
                text: 'Découvrez ce média premium sur Culture Benin',
                url: window.location.href,
            });
        } else {
            navigator.clipboard.writeText(window.location.href)
                .then(() => showNotification('Lien copié dans le presse-papier !'))
                .catch(() => showNotification('Impossible de copier le lien'));
        }
    }

    // Fonction d'ajout aux favoris
    window.addToFavorites = function() {
        if (favoriteBtn) {
            favoriteBtn.click();
        }
    }

    // Notification
    function showNotification(message, type = 'success') {
        const notification = document.createElement('div');
        notification.className = 'media-notification ' + type;
        notification.innerHTML = `
            <i class="bi ${type === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-circle-fill'}"></i>
            <span>${message}</span>
        `;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.classList.add('show');
        }, 10);
        
        setTimeout(() => {
            notification.classList.remove('show');
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    }
});

// Styles pour la notification
const notificationStyle = document.createElement('style');
notificationStyle.textContent = `
    .media-notification {
        position: fixed;
        top: 20px;
        right: 20px;
        background: white;
        padding: 1rem 1.5rem;
        border-radius: 12px;
        box-shadow: 
            0 10px 40px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(0, 0, 0, 0.05);
        display: flex;
        align-items: center;
        gap: 0.8rem;
        z-index: 9999;
        transform: translateX(100%);
        opacity: 0;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .media-notification.success {
        border-left: 4px solid #10b981;
    }
    
    .media-notification.error {
        border-left: 4px solid #ef4444;
    }
    
    .media-notification.show {
        transform: translateX(0);
        opacity: 1;
    }
    
    .media-notification i {
        font-size: 1.2rem;
    }
    
    .media-notification.success i {
        color: #10b981;
    }
    
    .media-notification.error i {
        color: #ef4444;
    }
    
    .media-notification span {
        font-weight: 600;
        color: #1f2937;
    }
`;
document.head.appendChild(notificationStyle);
</script>
@endsection