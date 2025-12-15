@extends('layouts.app')

@section('title', $region->nom_region . ' - Régions du Bénin')

@push('styles')
<style>
    /* ===== STYLES SPÉCIFIQUES À LA PAGE RÉGION ===== */
    :root {
        --region-primary: #008000;
        --region-secondary: #ffd700;
        --region-accent: #e17000;
    }

    /* Correction de l'espacement header */
    .region-detail-page {
        background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f5 100%);
        min-height: 100vh;
    }

    .region-detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 100px 20px 60px;
    }

    /* Header de la région */
    .region-detail-header {
        background: linear-gradient(135deg, var(--region-primary) 0%, #006400 100%);
        border-radius: 24px;
        padding: 4rem;
        margin-bottom: 3rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 128, 0, 0.2);
    }

    .region-detail-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
    }

    .region-header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 3rem;
        flex-wrap: wrap;
    }

    .region-icon-large {
        width: 140px;
        height: 140px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        border: 3px solid rgba(255, 255, 255, 0.3);
        flex-shrink: 0;
    }

    .region-header-text {
        flex: 1;
        min-width: 300px;
    }

    .region-header-text h1 {
        font-size: 3.5rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .region-header-text .localisation {
        font-size: 1.3rem;
        opacity: 0.9;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Statistiques de la région */
    .region-stats-detail {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .region-stat-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        text-align: center;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .region-stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 50px rgba(0, 128, 0, 0.15);
    }

    .region-stat-number {
        font-size: 1.8rem;
        font-weight: 900;
        color: var(--region-primary);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .region-stat-label {
        color: #6c757d;
        font-size: 1.1rem;
        font-weight: 600;
    }

    .region-stat-desc {
        color: #8a8a8a;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }

    /* Sections de contenu */
    .region-section {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        margin-bottom: 3rem;
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .section-title {
        font-size: 2.2rem;
        font-weight: 900;
        color: #1a1d21;
        margin-bottom: 2rem;
        position: relative;
        padding-bottom: 1rem;
    }

    .section-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 4px;
        background: linear-gradient(90deg, var(--region-primary), var(--region-secondary));
        border-radius: 2px;
    }

    /* Description */
    .region-description-detail {
        font-size: 1.2rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 2rem;
    }

    /* Caractéristiques */
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .feature-item {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 1.5rem;
        border-left: 4px solid var(--region-primary);
    }

    .feature-icon {
        font-size: 2rem;
        color: var(--region-primary);
        margin-bottom: 1rem;
    }

    .feature-title {
        font-weight: 700;
        color: #1a1d21;
        margin-bottom: 0.5rem;
    }

    .feature-text {
        color: #6c757d;
        line-height: 1.6;
    }

    /* Contenus associés */
    .contenus-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }

    .contenu-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 2rem;
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .contenu-card:hover {
        background: white;
        transform: translateY(-5px);
        box-shadow: 0 20px 45px rgba(0, 0, 0, 0.1);
        border-color: var(--region-primary);
    }

    .contenu-title {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1a1d21;
        margin-bottom: 0.8rem;
        line-height: 1.3;
    }

    .contenu-description {
        font-size: 1rem;
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        flex-grow: 1;
    }

    .contenu-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.9rem;
        color: #777;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }

    .no-contenus {
        text-align: center;
        padding: 3rem;
        color: #6c757d;
    }

    .no-contenus i {
        font-size: 3.5rem;
        margin-bottom: 1.5rem;
        color: var(--region-primary);
    }

    /* Ajouter des images dans la galerie */
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-top: 2rem;
    }

    /* Remplacer les divs vides par des images */
    .gallery-item {
        border-radius: 15px;
        overflow: hidden;
        height: 200px;
        position: relative;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        transition: transform 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    }

    /* Ajouter un overlay pour améliorer la lisibilité */
    .gallery-item::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
            180deg, 
            rgba(0, 0, 0, 0.3) 0%, 
            rgba(0, 0, 0, 0.7) 100%
        );
        opacity: 0.7;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover::after {
        opacity: 0.4;
    }

    /* Remplacer les icônes par du texte descriptif */
    .gallery-item::before {
        content: attr(data-title);
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0, 128, 0, 0.9);
        color: white;
        padding: 0.8rem;
        font-size: 0.9rem;
        font-weight: 600;
        text-align: center;
        z-index: 2;
        transform: translateY(100%);
        transition: transform 0.3s ease;
    }

    .gallery-item:hover::before {
        transform: translateY(0);
    }

    .gallery-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 128, 0, 0.3);
    }

    /* Supprimer les icônes */
    .gallery-item i {
        display: none;
    }

    /* Actions */
    .region-actions {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
        margin-top: 4rem;
        padding-top: 3rem;
        border-top: 1px solid #e9ecef;
    }

    .btn-region {
        padding: 0.9rem 1rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        font-size: 1rem;
    }

    .btn-back {
        background: #6c757d;
        color: white;
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.2);
    }

    .btn-back:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(108, 117, 125, 0.3);
    }

    .btn-explore {
        background: linear-gradient(135deg, var(--region-primary) 0%, #00a000 100%);
        color: white;
        box-shadow: 0 8px 20px rgba(0, 128, 0, 0.3);
    }

    .btn-explore:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(0, 128, 0, 0.4);
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .region-detail-container {
            padding: 90px 15px 40px;
        }
        
        .region-detail-header {
            padding: 3rem;
        }
        
        .region-icon-large {
            width: 120px;
            height: 120px;
            font-size: 3.5rem;
        }
        
        .region-header-text h1 {
            font-size: 2.8rem;
        }
        
        .region-section {
            padding: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .region-detail-header {
            padding: 2.5rem;
            text-align: center;
        }
        
        .region-header-content {
            flex-direction: column;
            text-align: center;
            gap: 2rem;
        }
        
        .region-header-text h1 {
            font-size: 2.2rem;
        }
        
        .region-stats-detail {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .contenus-grid, .gallery-grid {
            grid-template-columns: 1fr;
        }
        
        .region-section {
            padding: 2rem;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
        
        .region-actions {
            flex-direction: column;
        }
        
        .btn-region {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .region-detail-header {
            padding: 2rem;
        }
        
        .region-header-text h1 {
            font-size: 1.8rem;
        }
        
        .region-icon-large {
            width: 100px;
            height: 100px;
            font-size: 3rem;
        }
        
        .region-stats-detail {
            grid-template-columns: 1fr;
        }
        
        .region-stat-card {
            padding: 2rem;
        }
        
        .gallery-item {
            height: 180px;
        }
    }
</style>
@endpush

@section('content')
<div class="region-detail-page">
    <div class="region-detail-container">
        <!-- Header de la région -->
        <div class="region-detail-header">
            <div class="region-header-content">
                <div class="region-icon-large">
                    <i class="bi bi-geo-alt"></i>
                </div>
                <div class="region-header-text">
                    <h1>{{ $region->nom_region }}</h1>
                    <div class="localisation">
                        <i class="bi bi-geo"></i>
                        {{ $region->localisation }}
                    </div>
                    @if($region->chef_lieu)
                    <div class="localisation">
                        <i class="bi bi-building"></i>
                        Chef-lieu : {{ $region->chef_lieu }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Statistiques de la région -->
        <div class="region-stats-detail">
            <div class="region-stat-card">
                <div class="region-stat-number">{{ number_format($region->population, 0, ',', ' ') }}</div>
                <div class="region-stat-label">Population</div>
                <div class="region-stat-desc">Nombre d'habitants</div>
            </div>
            <div class="region-stat-card">
                <div class="region-stat-number">{{ number_format($region->superficie, 0, ',', ' ') }} km²</div>
                <div class="region-stat-label">Superficie</div>
                <div class="region-stat-desc">Surface totale</div>
            </div>
            <div class="region-stat-card">
                <div class="region-stat-number">
                    @php
                        $density = $region->population > 0 && $region->superficie > 0 
                            ? round($region->population / $region->superficie, 1)
                            : 0;
                    @endphp
                    {{ $density }} hab/km²
                </div>
                <div class="region-stat-label">Densité</div>
                <div class="region-stat-desc">Habitants par km²</div>
            </div>
            <div class="region-stat-card">
                <div class="region-stat-number">{{ $contenus->count() }}</div>
                <div class="region-stat-label">Contenus</div>
                <div class="region-stat-desc">Ressources culturelles</div>
            </div>
        </div>

        <!-- Section Description -->
        <div class="region-section">
            <h2 class="section-title">À propos de cette région</h2>
            <div class="region-description-detail">
                @if($region->description)
                    {!! nl2br(e($region->description)) !!}
                @else
                    <p class="text-muted fs-5">Aucune description disponible pour cette région.</p>
                @endif
            </div>
            
            <!-- Caractéristiques -->
            <div class="features-grid">
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-tree"></i>
                    </div>
                    <h4 class="feature-title">Géographie</h4>
                    <p class="feature-text">
                        Située à {{ $region->localisation }}, cette région offre des paysages 
                        variés et un écosystème unique au Bénin.
                    </p>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <h4 class="feature-title">Démographie</h4>
                    <p class="feature-text">
                        Avec {{ number_format($region->population, 0, ',', ' ') }} habitants, 
                        c'est l'une des régions les plus dynamiques du pays.
                    </p>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">
                        <i class="bi bi-camera"></i>
                    </div>
                    <h4 class="feature-title">Patrimoine</h4>
                    <p class="feature-text">
                        Riche en traditions et sites historiques, cette région 
                        préserve un patrimoine culturel exceptionnel.
                    </p>
                </div>
            </div>
        </div>

        <!-- Section Contenus associés -->
        <div class="region-section">
            <h2 class="section-title">Contenus de cette région</h2>
            
            @if($contenus->count() > 0)
                <div class="contenus-grid">
                    @foreach($contenus as $contenu)
                    <div class="contenu-card">
                        <h3 class="contenu-title">{{ $contenu->titre }}</h3>
                        <p class="contenu-description">
                            {{ Str::limit($contenu->description, 150) }}
                        </p>
                        <div class="contenu-meta">
                            <span>
                                <i class="bi bi-calendar"></i>
                                {{ $contenu->created_at->format('d/m/Y') }}
                            </span>
                            <span>
                                <i class="bi bi-tag"></i>
                                {{ $contenu->type_contenu }}
                            </span>
                        </div>
                        <a href="{{ route('contenus.show', $contenu->id_contenu) }}" 
                           style="display: inline-block; margin-top: 1.5rem; color: var(--region-primary); font-weight: 600; text-decoration: none; display: flex; align-items: center; gap: 0.5rem;">
                            <i class="bi bi-arrow-right"></i> Lire la suite
                        </a>
                    </div>
                    @endforeach
                </div>
                
                @if($contenus->count() >= 6)
                <div style="text-align: center; margin-top: 3rem;">
                    <a href="{{ route('contenus.index') }}?region={{ $region->id_region }}" 
                       class="btn-region btn-explore">
                        <i class="bi bi-list"></i> Voir tous les contenus
                    </a>
                </div>
                @endif
            @else
                <div class="no-contenus">
                    <i class="bi bi-file-earmark-text"></i>
                    <h4>Aucun contenu disponible</h4>
                    <p>Aucun contenu n'a été publié dans cette région pour le moment.</p>
                    <a href="{{ route('contenus.index') }}" class="btn-region btn-explore" style="margin-top: 1.5rem;">
                        <i class=""></i> Explorer les contenus
                    </a>
                </div>
            @endif
        </div>

        <!-- Section Galerie -->
        <div class="region-section">
            <h2 class="section-title">Galerie</h2>
            <p style="color: #6c757d; margin-bottom: 2rem;">
                Découvrez les sites emblématiques et paysages de la région {{ $region->nom_region }}.
            </p>
            
            <div class="gallery-grid">
                <div class="gallery-item" 
                    data-title="Port de Cotonou" 
                    style="background-image: url('https://images.unsplash.com/photo-1569428034239-f9565e32e224?q=80&w=2079&auto=format&fit=crop');">
                </div>
                <div class="gallery-item" 
                    data-title="Palais Royal d'Abomey" 
                    style="background-image: url('https://images.unsplash.com/photo-1562979314-bee7453e911c?q=80&w=1974&auto=format&fit=crop');">
                </div>
                <div class="gallery-item" 
                    data-title="Village sur pilotis de Ganvié" 
                    style="background-image: url('https://images.unsplash.com/photo-1551632811-561732d1e306?q=80&w=2070&auto=format&fit=crop');">
                </div>
                <div class="gallery-item" 
                    data-title="Marché Dantokpa" 
                    style="background-image: url('https://images.unsplash.com/photo-1511895426328-dc8714191300?q=80&w=2070&auto=format&fit=crop');">
                </div>
                <div class="gallery-item" 
                    data-title="Parc National de la Pendjari" 
                    style="background-image: url('https://images.unsplash.com/photo-1544551763-46a013bb70d5?q=80&w=2070&auto=format&fit=crop');">
                </div>
                <div class="gallery-item" 
                    data-title="Plage de Ouidah" 
                    style="background-image: url('https://images.unsplash.com/photo-1507525428034-b723cf961d3e?q=80&w=2073&auto=format&fit=crop');">
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 2rem;">
                <a href="{{ route('media.index') }}?region={{ $region->id_region }}" class="btn-region btn-explore">
                    <i class="bi bi-collection"></i> Voir la galerie complète
                </a>
            </div>
        </div> 

        <!-- Actions -->
        <div class="region-actions">
            <a href="{{ route('region.index') }}" class="btn-region btn-back">
                <i class="bi bi-arrow-left"></i> Retour aux régions
            </a>
            
            @auth
            <a href="{{ route('contenus.create') }}?region={{ $region->id_region }}" class="btn-region btn-explore">
                <i class="bi bi-plus-circle"></i> Contribuer un contenu
            </a>
            @else
            <a href="{{ route('login') }}" class="btn-region btn-explore">
                <i class="bi bi-pencil"></i> Se connecter pour contribuer
            </a>
            @endauth
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation des statistiques
        const statNumbers = document.querySelectorAll('.region-stat-number');
        
        statNumbers.forEach(stat => {
            const text = stat.textContent.trim();
            // Vérifier si c'est un nombre (pas de km² ou hab/km²)
            if (!isNaN(parseFloat(text.replace(/[^\d.-]/g, '')))) {
                const value = parseFloat(text.replace(/[^\d.-]/g, ''));
                let current = 0;
                const increment = value / 60;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= value) {
                        stat.textContent = text; // Remettre le texte original
                        clearInterval(timer);
                    } else {
                        stat.textContent = Math.floor(current).toLocaleString();
                    }
                }, 30);
            }
        });
        
        // Hover effect pour les cartes
        const contenuCards = document.querySelectorAll('.contenu-card');
        contenuCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
        
        // Animation galerie
        const galleryItems = document.querySelectorAll('.gallery-item');
        galleryItems.forEach((item, index) => {
            item.style.animationDelay = `${index * 0.1}s`;
            item.classList.add('animate-float-in');
        });
    });
</script>
@endpush