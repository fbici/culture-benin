@extends('layouts.app')

@section('title', 'Langues du Bénin - Culture Benin')

@push('styles')
<style>
    /* ===== STYLES SPÉCIFIQUES AUX LANGUES ===== */
    :root {
        --langue-primary: #6f42c1;
        --langue-secondary: #20c997;
        --langue-accent: #e83e8c;
    }

    /* Correction de l'espacement header */
    .langue-page {
        background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f5 100%);
        min-height: calc(100vh - 180px);
        padding-top: 30px;
        padding-bottom: 60px;
    }

    .langue-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    /* Hero Section - Réduite */
    .langue-hero {
        background: linear-gradient(135deg, 
            rgba(111, 66, 193, 0.95) 0%, 
            rgba(86, 61, 124, 0.9) 100%);
        border-radius: 20px;
        padding: 3rem 2.5rem;
        margin-bottom: 3rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 15px 30px rgba(111, 66, 193, 0.2);
    }

    .langue-hero::before {
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

    .hero-icon-langue {
        width: 80px;
        height: 80px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .langue-hero h1 {
        font-size: 2.5rem;
        font-weight: 900;
        margin-bottom: 1rem;
        line-height: 1.2;
    }

    .langue-hero p {
        font-size: 1.1rem;
        opacity: 0.9;
        margin-bottom: 1.5rem;
        max-width: 800px;
        line-height: 1.6;
    }

    /* Badges */
    .langue-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
    }

    .langue-badge {
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
    .stats-langue {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        margin: 2rem 0;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .stats-langue::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, 
            var(--langue-primary) 0%, 
            var(--langue-secondary) 50%, 
            var(--langue-accent) 100%);
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
        background: linear-gradient(135deg, var(--langue-primary) 0%, #8a63d2 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: white;
        margin: 0 auto;
        box-shadow: 0 15px 30px rgba(111, 66, 193, 0.3);
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
    .filter-langue {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .search-langue {
        position: relative;
    }

    .search-langue input {
        width: 100%;
        padding: 1rem 1.5rem 1rem 3.5rem;
        border: 2px solid #e9ecef;
        border-radius: 12px;
        font-size: 1rem;
        background: #f8f9fa;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .search-langue input:focus {
        border-color: var(--langue-primary);
        box-shadow: 0 0 0 3px rgba(111, 66, 193, 0.15);
        background: white;
        outline: none;
    }

    .search-langue i {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 1.2rem;
        transition: color 0.3s ease;
    }

    .search-langue input:focus + i {
        color: var(--langue-primary);
    }

    /* Navigation alphabétique */
    .alphabet-nav {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.06);
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        justify-content: center;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .alphabet-letter {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 10px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        color: #6c757d;
        font-weight: 700;
        text-decoration: none;
        transition: all 0.3s ease;
        font-size: 1rem;
        border: 1px solid transparent;
    }

    .alphabet-letter:hover,
    .alphabet-letter.active {
        background: linear-gradient(135deg, var(--langue-primary) 0%, #8a63d2 100%);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 15px rgba(111, 66, 193, 0.2);
    }

    /* Grille des langues - Texte réduit */
    .langue-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .langue-card {
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

    .langue-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(111, 66, 193, 0.15);
    }

    .langue-header {
        height: 180px;
        background: linear-gradient(135deg, var(--langue-primary) 0%, #8a63d2 100%);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .langue-header::before {
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

    .langue-code {
        position: absolute;
        top: 1.2rem;
        right: 1.2rem;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 15px;
        font-size: 1rem;
        font-weight: 700;
        border: 2px solid rgba(255, 255, 255, 0.3);
    }

    .langue-content {
        padding: 2rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .langue-title {
        font-size: 1.6rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
        color: #1a1d21;
        position: relative;
        padding-bottom: 0.8rem;
        line-height: 1.3;
    }

    .langue-title::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, var(--langue-primary), var(--langue-secondary));
        border-radius: 2px;
    }

    .langue-description {
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex-grow: 1;
        font-size: 0.95rem;
    }

    /* Bannière linguistique */
    .linguistique-banner {
        background: linear-gradient(135deg, 
            rgba(32, 201, 151, 0.15) 0%, 
            rgba(111, 66, 193, 0.08) 100%);
        border-radius: 20px;
        padding: 3rem;
        margin: 3rem 0;
        border: 2px solid var(--langue-secondary);
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .linguistique-banner h3 {
        font-size: 1.8rem;
        font-weight: 900;
        margin-bottom: 1rem;
    }

    .linguistique-banner p {
        color: #6c757d;
        margin-bottom: 1.5rem;
        line-height: 1.6;
        font-size: 1.05rem;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Cartes d'information */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .info-card {
        background: white;
        border-radius: 15px;
        padding: 2rem;
        height: 100%;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .info-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    /* Pagination */
    .pagination-langue {
        display: flex;
        list-style: none;
        gap: 0.5rem;
        justify-content: center;
        margin: 2rem 0;
        padding: 0;
    }

    .pagination-langue .page-item .page-link {
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

    .pagination-langue .page-item.active .page-link {
        background: linear-gradient(135deg, var(--langue-primary) 0%, #8a63d2 100%);
        color: white;
        box-shadow: 0 8px 15px rgba(111, 66, 193, 0.2);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .langue-container {
            padding: 0 15px;
        }
        
        .langue-hero {
            padding: 2.5rem 2rem;
            text-align: center;
        }
        
        .hero-icon-langue {
            margin-left: auto;
            margin-right: auto;
        }
        
        .langue-hero h1 {
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
        
        .langue-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .alphabet-nav {
            padding: 1rem;
            gap: 0.4rem;
        }
        
        .alphabet-letter {
            width: 35px;
            height: 35px;
            font-size: 0.9rem;
        }
        
        .linguistique-banner {
            padding: 2rem;
            margin: 2rem 0;
        }
        
        .info-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
    }

    @media (max-width: 576px) {
        .langue-hero h1 {
            font-size: 1.8rem;
        }
        
        .langue-hero p {
            font-size: 1rem;
        }
        
        .langue-badge {
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
<div class="langue-page">
    <div class="langue-container">
        <!-- Hero Section -->
        <div class="langue-hero">
            <div class="hero-icon-langue">
                <i class="bi bi-translate"></i>
            </div>
            <h1>
                <span style="color: var(--langue-secondary);">Langues</span> du Bénin
            </h1>
            <p>
                Découvrez la richesse linguistique du Bénin, un patrimoine culturel vivant 
                où se côtoient langues nationales, locales et internationales.
            </p>
            <div class="langue-badges">
                <span class="langue-badge">
                    <i class="bi bi-mic"></i>{{ $totalLangues }} Langues
                </span>
                <span class="langue-badge">
                    <i class="bi bi-globe"></i>Diversité
                </span>
                <span class="langue-badge">
                    <i class="bi trans"></i>Patrimoine
                </span>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="stats-langue">
            <div class="stats-content">
                <div class="stat-visual">
                    <div class="stat-circle">
                        <div class="stat-circle-number">{{ $totalLangues }}</div>
                        <div class="stat-circle-label">Langues</div>
                    </div>
                </div>
                <div class="stat-text">
                    <h3>Un trésor linguistique unique</h3>
                    <p>
                        Le Bénin compte officiellement {{ $totalLangues }} langues parlées sur son territoire, 
                        dont le français comme langue officielle. Cette diversité témoigne 
                        de la richesse culturelle et historique du pays.
                    </p>
                </div>
            </div>
        </div>

        <!-- Navigation alphabétique -->
        <div class="alphabet-nav">
            @foreach(range('A', 'Z') as $letter)
            <a href="#letter-{{ $letter }}" class="alphabet-letter">
                {{ $letter }}
            </a>
            @endforeach
        </div>

        <!-- Recherche et filtres -->
        <div class="filter-langue">
            <div style="display: flex; flex-wrap: wrap; gap: 15px; align-items: flex-end;">
                <div style="flex: 1; min-width: 250px;">
                    <div class="search-langue">
                        <i class="bi bi-search"></i>
                        <input type="text" id="searchLangue" placeholder="Rechercher une langue..." 
                               value="{{ request('search') }}">
                    </div>
                </div>
                <div style="flex: 0 0 180px;">
                    <select class="form-select" id="sortLangue" style="width: 100%; padding: 12px; border-radius: 12px; border: 2px solid #e9ecef; font-weight: 500;">
                        <option value="name_asc">Nom (A-Z)</option>
                        <option value="name_desc">Nom (Z-A)</option>
                        <option value="code_asc">Code (A-Z)</option>
                        <option value="code_desc">Code (Z-A)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Grille des langues -->
        <div class="langue-grid">
            @forelse($langues as $langue)
            <div class="langue-card" 
                 data-letter="{{ strtoupper(substr($langue->nom_langue, 0, 1)) }}"
                 data-name="{{ strtolower($langue->nom_langue) }}"
                 data-code="{{ strtolower($langue->code_langue) }}">
                <div class="langue-header">
                    <span class="langue-code">{{ $langue->code_langue }}</span>
                    <div style="color: white; text-align: center;">
                        <i class="bi bi-chat-square-text" style="font-size: 36px; margin-bottom: 10px;"></i>
                        <h4 style="font-weight: 900; font-size: 1.2rem;">{{ $langue->nom_langue }}</h4>
                    </div>
                </div>
                
                <div class="langue-content">
                    <h2 class="langue-title">{{ $langue->nom_langue }}</h2>
                    
                    <div style="color: #6c757d; margin-bottom: 15px; display: flex; align-items: center; gap: 0.5rem;">
                        <i class="bi bi-tag"></i>
                        <span>Code : {{ $langue->code_langue }}</span>
                    </div>
                    
                    <p class="langue-description">
                        {{ Str::limit($langue->description, 120) }}
                    </p>
                    
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto; padding-top: 15px; border-top: 1px solid #e9ecef;">
                        <small style="color: #6c757d; font-size: 0.85rem;">
                            <i class="bi bi-calendar"></i> {{ $langue->created_at->diffForHumans() }}
                        </small>
                        <a href="{{ route('langue.show', $langue->id_langue) }}" class="btn-langue-details">
                            <i class="bi bi-info-circle"></i> Détails
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px 20px;">
                <i class="bi bi-translate" style="font-size: 48px; color: #6c757d; margin-bottom: 15px;"></i>
                <h4 style="color: #6c757d; margin-bottom: 10px; font-size: 1.2rem;">Aucune langue disponible</h4>
                <p style="color: #6c757d;">Les langues seront bientôt ajoutées.</p>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if($langues->hasPages())
        <div>
            <ul class="pagination-langue">
                @if($langues->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">
                        <i class="bi bi-chevron-left"></i>
                    </span>
                </li>
                @else
                <li class="page-item">
                    <a class="page-link" href="{{ $langues->previousPageUrl() }}">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
                @endif

                @foreach($langues->getUrlRange(1, $langues->lastPage()) as $page => $url)
                    @if($page == $langues->currentPage())
                    <li class="page-item active">
                        <span class="page-link">{{ $page }}</span>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                    @endif
                @endforeach

                @if($langues->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $langues->nextPageUrl() }}">
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

        <!-- Bannière linguistique -->
        <div class="linguistique-banner">
            <h3>Préservation du patrimoine linguistique</h3>
            <p>
                Chaque langue est un trésor culturel qui raconte l'histoire d'un peuple. 
                Notre mission est de documenter, préserver et promouvoir toutes les langues du Bénin.
            </p>
            <a href="{{ route('contenus.index') }}" class="btn-langue-primary">
                <i class="bi bi-book"></i> Découvrir les contenus
            </a>
        </div>

        <!-- Section informations -->
        <div class="info-grid">
            <div class="info-card">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.2rem;">
                    <div style="background: rgba(111, 66, 193, 0.1); padding: 0.8rem; border-radius: 12px;">
                        <i class="bi bi-info-circle" style="font-size: 1.5rem; color: var(--langue-primary);"></i>
                    </div>
                    <div>
                        <h5 style="font-weight: 900; margin-bottom: 0.2rem;">Langues nationales</h5>
                        <p style="color: #6c757d; font-size: 0.85rem; margin: 0;">Reconnues officiellement</p>
                    </div>
                </div>
                <p style="color: #6c757d; line-height: 1.6; font-size: 0.95rem;">
                    Le Bénin reconnaît plusieurs langues nationales dont le Fon, le Yoruba, 
                    le Bariba et le Dendi, parlées par différentes communautés.
                </p>
            </div>
            
            <div class="info-card">
                <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 1.2rem;">
                    <div style="background: rgba(32, 201, 151, 0.1); padding: 0.8rem; border-radius: 12px;">
                        <i class="bi bi-translate" style="font-size: 1.5rem; color: var(--langue-secondary);"></i>
                    </div>
                    <div>
                        <h5 style="font-weight: 900; margin-bottom: 0.2rem;">Langue officielle</h5>
                        <p style="color: #6c757d; font-size: 0.85rem; margin: 0;">Administration et éducation</p>
                    </div>
                </div>
                <p style="color: #6c757d; line-height: 1.6; font-size: 0.95rem;">
                    Le français est la langue officielle du Bénin, utilisée dans l'administration, 
                    l'éducation et les médias, en cohabitation avec les langues locales.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Ajouter le style pour les boutons
    document.head.insertAdjacentHTML('beforeend', `
        <style>
            .btn-langue-details {
                background: var(--langue-primary);
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
            
            .btn-langue-details:hover {
                background: #5a32a3;
                transform: translateY(-2px);
                color: white;
            }
            
            .btn-langue-primary {
                background: var(--langue-secondary);
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
            
            .btn-langue-primary:hover {
                background: #1aa179;
                transform: translateY(-2px);
                color: white;
            }
        </style>
    `);
    
    document.addEventListener('DOMContentLoaded', function() {
        // Gestion de la recherche
        const searchInput = document.getElementById('searchLangue');
        const sortSelect = document.getElementById('sortLangue');
        const langueCards = document.querySelectorAll('.langue-card');
        const alphabetLetters = document.querySelectorAll('.alphabet-letter');
        
        // Recherche en temps réel
        searchInput.addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase().trim();
            
            langueCards.forEach(card => {
                const name = card.dataset.name;
                const code = card.dataset.code;
                const title = card.querySelector('.langue-title').textContent.toLowerCase();
                
                const matches = name.includes(searchTerm) || 
                              code.includes(searchTerm) || 
                              title.includes(searchTerm);
                
                card.style.display = matches ? 'flex' : 'none';
            });
            
            updateAlphabetNavigation();
        });
        
        // Tri
        sortSelect.addEventListener('change', function() {
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.set('sort', this.value);
            window.location.href = currentUrl.toString();
        });
        
        // Navigation alphabétique
        function updateAlphabetNavigation() {
            alphabetLetters.forEach(letter => {
                const letterChar = letter.textContent;
                const hasVisibleCards = Array.from(langueCards).some(card => {
                    return card.style.display !== 'none' && card.dataset.letter === letterChar;
                });
                
                letter.classList.toggle('active', hasVisibleCards);
            });
        }
        
        alphabetLetters.forEach(letter => {
            letter.addEventListener('click', function(e) {
                e.preventDefault();
                const letterChar = this.textContent;
                
                langueCards.forEach(card => {
                    card.style.display = card.dataset.letter === letterChar ? 'flex' : 'none';
                });
                
                alphabetLetters.forEach(l => l.classList.remove('active'));
                this.classList.add('active');
            });
        });
        
        updateAlphabetNavigation();
    });
</script>
@endpush