@extends('layouts.app')

@section('title', 'Régions du Bénin - Culture Benin')

@push('styles')
<style>
    /* ===== STYLES SPÉCIFIQUES AUX RÉGIONS ===== */
    :root {
        --region-primary: #008000;
        --region-secondary: #ffd700;
        --region-accent: #e17000;
    }

    /* Correction de l'espacement header */
    .region-page {
        background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f5 100%);
        min-height: calc(100vh - 180px);
        padding-top: 30px;
        padding-bottom: 60px;
    }

    .region-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    /* Hero Section - Réduite */
    .region-hero {
        background: linear-gradient(135deg, 
            rgba(0, 128, 0, 0.95) 0%, 
            rgba(0, 100, 0, 0.9) 100%);
        border-radius: 20px;
        padding: 3rem 2.5rem;
        margin-bottom: 3rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(0, 128, 0, 0.2);
        text-align: center;
    }

    .region-hero::before {
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

    .hero-icon {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin: 0 auto 1.5rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .region-hero h1 {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .region-hero p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 1.5rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    /* Badges */
    .region-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        justify-content: center;
    }

    .region-badge {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: white;
        padding: 0.6rem 1.2rem;
        border-radius: 15px;
        font-size: 0.95rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    /* Statistiques - Compact */
    .stats-wrapper {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin: 2rem 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .stats-wrapper::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, var(--region-primary), var(--region-secondary), var(--region-accent));
    }

    .stats-content {
        display: flex;
        align-items: center;
        gap: 3rem;
        flex-wrap: wrap;
    }

    .stat-visual {
        flex: 0 0 140px;
    }

    .stat-circle {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--region-primary) 0%, #00a000 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        margin: 0 auto;
        box-shadow: 0 15px 30px rgba(0, 128, 0, 0.3);
        position: relative;
        overflow: hidden;
    }

    .stat-circle::before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: radial-gradient(circle at 30% 30%, rgba(255, 255, 255, 0.2) 0%, transparent 50%);
    }

    .stat-circle-number {
        font-size: 2.5rem;
        font-weight: 900;
        line-height: 1;
        position: relative;
        z-index: 1;
    }

    .stat-circle-label {
        font-size: 0.9rem;
        margin-top: 5px;
        color: rgba(255, 255, 255, 0.9);
    }

    .stat-text {
        flex: 1;
        min-width: 300px;
    }

    .stat-text h3 {
        font-size: 1.6rem;
        font-weight: 900;
        margin-bottom: 1rem;
        color: #1a1d21;
    }

    .stat-text p {
        color: #6c757d;
        line-height: 1.6;
        margin: 0;
        font-size: 1.05rem;
    }

    /* Filtres */
    .filter-section {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .search-box {
        position: relative;
    }

    .search-box input {
        width: 100%;
        padding: 1rem 1.5rem 1rem 3.5rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 1rem;
        background: #f8f9fa;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .search-box input:focus {
        border-color: var(--region-primary);
        box-shadow: 0 0 0 3px rgba(0, 128, 0, 0.15);
        background: white;
        outline: none;
    }

    .search-box i {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 1.2rem;
        transition: color 0.3s ease;
    }

    .search-box input:focus + i {
        color: var(--region-primary);
    }

    /* Grille des régions - SIMPLIFIÉE */
    .regions-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .region-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.3s ease;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        position: relative;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .region-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0, 128, 0, 0.15);
    }

    .region-header {
        height: 160px;
        background: linear-gradient(135deg, var(--region-primary) 0%, #00a000 100%);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .region-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: 
            radial-gradient(circle at 70% 30%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 30% 70%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
    }

    .region-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 15px;
        font-size: 0.9rem;
        font-weight: 700;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .region-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .region-title {
        font-size: 1.5rem;
        font-weight: 900;
        margin-bottom: 0.8rem;
        color: #1a1d21;
        position: relative;
        padding-bottom: 0.8rem;
        line-height: 1.3;
    }

    .region-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 40px;
        height: 3px;
        background: linear-gradient(90deg, var(--region-primary), var(--region-secondary));
        border-radius: 2px;
    }

    .region-description {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
        font-size: 0.9rem;
    }

    /* Bouton carte uniquement */
    .region-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }

    .map-btn {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--region-primary);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        background: rgba(0, 128, 0, 0.08);
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .map-btn:hover {
        background: rgba(0, 128, 0, 0.15);
        transform: translateY(-2px);
    }

    /* Carte Google Maps Modal - CORRIGÉE */
    .map-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 10000;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .map-modal-content {
        background: white;
        border-radius: 20px;
        width: 90%;
        max-width: 800px;
        max-height: 80vh;
        overflow: hidden;
        position: relative;
        animation: modalFadeIn 0.3s ease;
    }

    @keyframes modalFadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
    }

    .map-modal-header {
        background: linear-gradient(135deg, var(--region-primary) 0%, #006400 100%);
        color: white;
        padding: 1.5rem 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .close-map {
        background: none;
        border: none;
        color: white;
        font-size: 1.5rem;
        cursor: pointer;
        padding: 0.5rem;
        transition: transform 0.3s ease;
    }

    .close-map:hover {
        transform: rotate(90deg);
    }

    .map-container {
        width: 100%;
        height: 400px;
        position: relative;
    }

    .map-fallback {
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        background: #f8f9fa;
        color: #6c757d;
        padding: 2rem;
        text-align: center;
    }

    /* Bannière informative */
    .info-banner {
        background: linear-gradient(135deg, 
            rgba(255, 215, 0, 0.15) 0%, 
            rgba(225, 112, 0, 0.08) 100%);
        border-radius: 20px;
        padding: 2.5rem;
        margin: 3rem 0;
        border: 2px solid var(--region-accent);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .info-banner h3 {
        font-size: 1.6rem;
        font-weight: 900;
        margin-bottom: 1rem;
    }

    .info-banner p {
        color: #6c757d;
        margin-bottom: 1.5rem;
        line-height: 1.6;
        font-size: 1.05rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Pagination */
    .pagination-region {
        display: flex;
        list-style: none;
        gap: 0.5rem;
        justify-content: center;
        margin: 2rem 0;
        padding: 0;
    }

    .pagination-region .page-item .page-link {
        border: none;
        border-radius: 10px;
        padding: 0.6rem 1rem;
        color: #6c757d;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        background: white;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.05);
    }

    .pagination-region .page-item.active .page-link {
        background: linear-gradient(135deg, var(--region-primary) 0%, #00a000 100%);
        color: white;
        box-shadow: 0 8px 15px rgba(0, 128, 0, 0.2);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .region-container {
            padding: 0 15px;
        }
        
        .region-hero {
            padding: 2.5rem 2rem;
        }
        
        .region-hero h1 {
            font-size: 2rem;
        }
        
        .stats-content {
            flex-direction: column;
            text-align: center;
            gap: 2rem;
        }
        
        .stat-visual {
            flex: 0 0 auto;
        }
        
        .stat-text {
            min-width: 100%;
        }
        
        .regions-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .info-banner {
            padding: 2rem;
            margin: 2rem 0;
        }
    }

    @media (max-width: 576px) {
        .region-hero h1 {
            font-size: 1.8rem;
        }
        
        .region-hero p {
            font-size: 1rem;
        }
        
        .region-badge {
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
        }
        
        .stat-circle {
            width: 120px;
            height: 120px;
        }
        
        .stat-circle-number {
            font-size: 2.2rem;
        }
    }
</style>
@endpush

@section('content')
<div class="region-page">
    <div class="region-container">
        <!-- Hero Section -->
        <div class="region-hero">
            <div class="hero-icon">
                <i class="bi bi-geo-alt"></i>
            </div>
            <h1>
                Découvrez les <span style="color: var(--region-secondary);">Régions</span> du Bénin
            </h1>
            <p>
                Explorez la diversité géographique et culturelle des régions béninoises.
                Chaque région raconte une histoire unique et participe à la richesse patrimoniale nationale.
            </p>
            <div class="region-badges">
                <span class="region-badge">
                    <i class="bi bi-geo"></i>{{ $totalRegions }} Régions
                </span>
                <span class="region-badge">
                    <i class="bi bi-people"></i>{{ number_format($totalPopulation, 0, ',', ' ') }} Habitants
                </span>
                <span class="region-badge">
                    <i class="bi bi-map"></i>{{ number_format($totalArea, 0, ',', ' ') }} km²
                </span>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="stats-wrapper">
            <div class="stats-content">
                <div class="stat-visual">
                    <div class="stat-circle">
                        <div class="stat-circle-number">{{ $totalRegions }}</div>
                        <div class="stat-circle-label">Régions</div>
                    </div>
                </div>
                <div class="stat-text">
                    <h3>Une diversité géographique exceptionnelle</h3>
                    <p>
                        Le Bénin s'étend sur {{ number_format($totalArea, 0, ',', ' ') }} km² avec {{ $totalRegions }} régions 
                        administratives abritant une population de {{ number_format($totalPopulation, 0, ',', ' ') }} habitants.
                    </p>
                </div>
            </div>
        </div>

        <!-- Recherche et filtres -->
        <div class="filter-section">
            <div style="display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end;">
                <div style="flex: 1; min-width: 250px;">
                    <div class="search-box">
                        <i class="bi bi-search"></i>
                        <input type="text" id="searchInput" placeholder="Rechercher une région..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div style="flex: 0 0 180px;">
                    <select class="form-select" id="sortSelect" style="width: 100%; padding: 12px; border-radius: 12px; border: 2px solid #e9ecef; font-weight: 500;">
                        <option value="name_asc">Nom (A-Z)</option>
                        <option value="name_desc">Nom (Z-A)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Liste des régions - SIMPLIFIÉE -->
        <div class="regions-grid">
            @forelse($regions as $region)
            <div class="region-card" 
                 data-name="{{ strtolower($region->nom_region) }}"
                 data-description="{{ strtolower($region->description) }}"
                 data-lat="{{ $region->latitude ?? 9.3077 }}"
                 data-lng="{{ $region->longitude ?? 2.3158 }}"
                 data-region-name="{{ $region->nom_region }}">
                <div class="region-header">
                    <span class="region-badge">
                        {{ $loop->iteration }}
                    </span>
                    <div style="color: white; text-align: center;">
                        <i class="bi bi-geo-alt" style="font-size: 36px; margin-bottom: 10px;"></i>
                        <h4 style="font-weight: 900; font-size: 1.2rem;">{{ $region->nom_region }}</h4>
                    </div>
                </div>
                
                <div class="region-content">
                    <h2 class="region-title">{{ $region->nom_region }}</h2>
                    
                    <p class="region-description">
                        {{ Str::limit($region->description, 100) }}
                    </p>
                    
                    <div class="region-actions">
                        <button class="map-btn" onclick="showRegionOnMap('{{ $region->nom_region }}', {{ $region->latitude ?? 9.3077 }}, {{ $region->longitude ?? 2.3158 }})">
                            <i class="bi bi-map"></i>
                            <span>Voir sur carte</span>
                        </button>
                        <a href="{{ route('region.show', $region->id_region) }}" class="btn-region-details">
                            <i class="bi bi-arrow-right"></i> Explorer
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px 20px;">
                <i class="bi bi-geo-alt" style="font-size: 48px; color: #6c757d; margin-bottom: 15px;"></i>
                <h4 style="color: #6c757d; margin-bottom: 10px; font-size: 1.2rem;">Aucune région disponible</h4>
                <p style="color: #6c757d;">Les régions seront bientôt ajoutées.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($regions->hasPages())
        <div>
            <ul class="pagination-region">
                @if($regions->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="bi bi-chevron-left"></i>
                    </span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $regions->previousPageUrl() }}">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
                @endif

                @foreach($regions->getUrlRange(1, $regions->lastPage()) as $page => $url)
                    @if($page == $regions->currentPage())
                    <li class="page-item active">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    @endif
                @endforeach

                @if($regions->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $regions->nextPageUrl() }}">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
                @else
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="bi bi-chevron-right"></i>
                    </span>
                </li>
                @endif
            </ul>
        </div>
        @endif

        <!-- Bannière informative -->
        <div class="info-banner">
            <h3>Un patrimoine régional unique</h3>
            <p>
                Chaque région du Bénin contribue à la mosaïque culturelle nationale. 
                Des traditions vodoun de l'Atlantique aux royaumes historiques du Nord, 
                explorez la diversité qui fait la force du Bénin.
            </p>
            <a href="{{ route('contenus.index') }}" class="btn-region-primary">
                <i class="bi bi-compass"></i> Explorer les contenus
            </a>
        </div>
    </div>
</div>

<!-- Modal pour la carte - CORRIGÉ -->
<div id="mapModal" class="map-modal">
    <div class="map-modal-content">
        <div class="map-modal-header">
            <h4 id="mapTitle" style="margin: 0; font-weight: 700;">Carte de la région</h4>
            <button class="close-map" onclick="closeMapModal()">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <div class="map-container">
            <div id="regionMap"></div>
            <div id="mapFallback" class="map-fallback" style="display: none;">
                <i class="bi bi-map display-4 mb-3" style="color: #6c757d;"></i>
                <h5>Impossible de charger la carte</h5>
                <p>Veuillez vérifier votre connexion internet ou réessayer plus tard.</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Google Maps API avec callback sécurisé -->
<script>
    let map;
    let marker;
    let mapInitialized = false;
    
    function initMap() {
        try {
            const defaultCenter = { lat: 9.3077, lng: 2.3158 };
            map = new google.maps.Map(document.getElementById('regionMap'), {
                zoom: 8,
                center: defaultCenter,
                styles: [
                    {
                        featureType: 'all',
                        elementType: 'geometry',
                        stylers: [{ color: '#f5f5f5' }]
                    },
                    {
                        featureType: 'all',
                        elementType: 'labels.text.fill',
                        stylers: [{ color: '#008000' }]
                    },
                    {
                        featureType: 'water',
                        elementType: 'geometry',
                        stylers: [{ color: '#c9c9c9' }]
                    }
                ]
            });
            
            mapInitialized = true;
            console.log('Google Maps initialisé avec succès');
        } catch (error) {
            console.error('Erreur lors de l\'initialisation de Google Maps:', error);
            showMapFallback();
        }
    }
    
    function showMapFallback() {
        document.getElementById('regionMap').style.display = 'none';
        document.getElementById('mapFallback').style.display = 'flex';
    }
    
    function showRegionOnMap(regionName, lat, lng) {
        const modal = document.getElementById('mapModal');
        const title = document.getElementById('mapTitle');
        
        title.textContent = `Carte : ${regionName}`;
        
        // Afficher le modal
        modal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        
        // Attendre que le modal soit affiché avant de centrer la carte
        setTimeout(() => {
            if (mapInitialized && map) {
                try {
                    const center = { lat: parseFloat(lat), lng: parseFloat(lng) };
                    map.setCenter(center);
                    map.setZoom(10);
                    
                    // Supprimer l'ancien marqueur
                    if (marker) {
                        marker.setMap(null);
                    }
                    
                    // Ajouter un nouveau marqueur
                    marker = new google.maps.Marker({
                        position: center,
                        map: map,
                        title: regionName,
                        animation: google.maps.Animation.DROP,
                        icon: {
                            url: 'https://maps.google.com/mapfiles/ms/icons/green-dot.png',
                            scaledSize: new google.maps.Size(40, 40)
                        }
                    });
                    
                    // Ajouter une info window
                    const infoWindow = new google.maps.InfoWindow({
                        content: `
                            <div style="padding: 15px; max-width: 250px;">
                                <h4 style="margin: 0 0 10px 0; color: #008000;">${regionName}</h4>
                                <p style="margin: 0; color: #666;">
                                    Cliquez sur "Explorer" pour découvrir cette région
                                </p>
                            </div>
                        `
                    });
                    
                    marker.addListener('click', () => {
                        infoWindow.open(map, marker);
                    });
                    
                    // Ouvrir automatiquement l'info window
                    infoWindow.open(map, marker);
                    
                } catch (error) {
                    console.error('Erreur lors de l\'affichage de la région sur la carte:', error);
                    showMapFallback();
                }
            } else {
                console.error('Google Maps n\'est pas initialisé');
                showMapFallback();
            }
        }, 100);
    }
    
    function closeMapModal() {
        const modal = document.getElementById('mapModal');
        modal.style.display = 'none';
        document.body.style.overflow = 'auto';
        
        // Réinitialiser l'affichage de la carte pour la prochaine ouverture
        document.getElementById('regionMap').style.display = 'block';
        document.getElementById('mapFallback').style.display = 'none';
    }
    
    // Fermer le modal en cliquant à l'extérieur
    document.getElementById('mapModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeMapModal();
        }
    });
    
    // Fermer avec la touche Échap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMapModal();
        }
    });
</script>

<!-- Chargement conditionnel de l'API Google Maps -->
<script>
    function loadGoogleMapsAPI() {
        // Vérifier si l'API est déjà chargée
        if (typeof google !== 'undefined' && google.maps) {
            initMap();
            return;
        }
        
        const script = document.createElement('script');
        script.src = 'https://maps.googleapis.com/maps/api/js?key={{ config('services.google.maps_api_key', 'AIzaSyDmock-key-for-development') }}&callback=initMap&libraries=places';
        script.async = true;
        script.defer = true;
        script.onerror = function() {
            console.error('Erreur de chargement de l\'API Google Maps');
            showMapFallback();
        };
        document.head.appendChild(script);
    }
    
    // Charger l'API après le chargement de la page
    document.addEventListener('DOMContentLoaded', function() {
        // Styles pour les boutons
        const style = document.createElement('style');
        style.textContent = `
            .btn-region-details {
                background: var(--region-primary);
                color: white;
                padding: 0.4rem 1rem;
                border-radius: 8px;
                text-decoration: none;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                gap: 0.3rem;
                font-size: 0.9rem;
                transition: all 0.3s ease;
            }
            
            .btn-region-details:hover {
                background: #006400;
                transform: translateY(-2px);
                color: white;
            }
            
            .btn-region-primary {
                background: var(--region-accent);
                color: white;
                padding: 0.8rem 1.5rem;
                border-radius: 12px;
                text-decoration: none;
                font-weight: 600;
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                transition: all 0.3s ease;
            }
            
            .btn-region-primary:hover {
                background: #d15c00;
                transform: translateY(-2px);
                color: white;
            }
        `;
        document.head.appendChild(style);
        
        // Gestion de la recherche
        const searchInput = document.getElementById('searchInput');
        const sortSelect = document.getElementById('sortSelect');
        const regionCards = document.querySelectorAll('.region-card');
        
        // Recherche en temps réel
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            regionCards.forEach(card => {
                const name = card.dataset.name;
                const description = card.dataset.description;
                
                const matches = name.includes(searchTerm) || 
                              description.includes(searchTerm);
                
                card.style.display = matches ? 'flex' : 'none';
            });
        });
        
        // Tri - redirection avec paramètre
        sortSelect.addEventListener('change', function() {
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('sort', this.value);
            window.location.href = currentUrl.toString();
        });
        
        // Charger Google Maps API seulement quand nécessaire
        const mapButtons = document.querySelectorAll('.map-btn');
        mapButtons.forEach(button => {
            button.addEventListener('click', function() {
                loadGoogleMapsAPI();
            });
        });
    });
</script>
@endpush