@extends('layouts.app')

@section('title', $langue->nom_langue . ' - Langues du Bénin')

@push('styles')
<style>
    /* ===== STYLES SPÉCIFIQUES À LA PAGE LANGUE ===== */
    :root {
        --langue-primary: #6f42c1;
        --langue-secondary: #20c997;
        --langue-accent: #e83e8c;
    }

    .langue-detail-page {
        background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f5 100%);
        min-height: 100vh;
    }

    .langue-detail-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 100px 20px 60px;
    }

    /* Header de la langue */
    .langue-detail-header {
        background: linear-gradient(135deg, var(--langue-primary) 0%, #8a63d2 100%);
        border-radius: 24px;
        padding: 4rem;
        margin-bottom: 3rem;
        color: white;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(111, 66, 193, 0.2);
    }

    .langue-detail-header::before {
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

    .langue-header-content {
        position: relative;
        z-index: 1;
        display: flex;
        align-items: center;
        gap: 3rem;
        flex-wrap: wrap;
    }

    .langue-icon-large {
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        border: 3px solid rgba(255, 255, 255, 0.3);
        flex-shrink: 0;
    }

    .langue-header-text {
        flex: 1;
        min-width: 300px;
    }

    .langue-header-text h1 {
        font-size: 3.5rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
        line-height: 1.2;
    }

    .langue-header-text .code {
        font-size: 1.5rem;
        opacity: 0.9;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    /* Statistiques de la langue */
    .langue-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .langue-stat-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        text-align: center;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        transition: transform 0.3s ease;
    }

    .langue-stat-card:hover {
        transform: translateY(-5px);
    }

    .langue-stat-number {
        font-size: 2.5rem;
        font-weight: 900;
        color: var(--langue-primary);
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .langue-stat-label {
        color: #6c757d;
        font-size: 1rem;
        font-weight: 500;
    }

    /* Sections de contenu */
    .langue-section {
        background: white;
        border-radius: 20px;
        padding: 3rem;
        margin-bottom: 3rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    }

    .section-title {
        font-size: 2rem;
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
        width: 60px;
        height: 4px;
        background: linear-gradient(90deg, var(--langue-primary), var(--langue-secondary));
        border-radius: 2px;
    }

    /* Description */
    .langue-description {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #555;
        margin-bottom: 2rem;
    }

    /* Contenus associés */
    .contenus-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 2rem;
    }

    .contenu-card {
        background: #f8f9fa;
        border-radius: 15px;
        padding: 1.5rem;
        transition: all 0.3s ease;
        border: 1px solid #e9ecef;
    }

    .contenu-card:hover {
        background: white;
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        border-color: var(--langue-primary);
    }

    .contenu-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #1a1d21;
        margin-bottom: 0.5rem;
    }

    .contenu-description {
        font-size: 0.95rem;
        color: #6c757d;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .contenu-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.85rem;
        color: #777;
    }

    .no-contenus {
        text-align: center;
        padding: 3rem;
        color: #6c757d;
    }

    .no-contenus i {
        font-size: 3rem;
        margin-bottom: 1rem;
    }

    /* Actions */
    .langue-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 3rem;
    }

    .btn-langue {
        padding: 1rem 2rem;
        border-radius: 12px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-back {
        background: #6c757d;
        color: white;
    }

    .btn-back:hover {
        background: #5a6268;
        color: white;
        transform: translateY(-2px);
    }

    .btn-contribute {
        background: linear-gradient(135deg, var(--langue-primary) 0%, #8a63d2 100%);
        color: white;
        box-shadow: 0 8px 20px rgba(111, 66, 193, 0.3);
    }

    .btn-contribute:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 30px rgba(111, 66, 193, 0.4);
        color: white;
    }

    /* Responsive Design */
    @media (max-width: 992px) {
        .langue-detail-container {
            padding: 90px 15px 40px;
        }
        
        .langue-detail-header {
            padding: 3rem;
        }
        
        .langue-icon-large {
            width: 100px;
            height: 100px;
            font-size: 3rem;
        }
        
        .langue-header-text h1 {
            font-size: 2.8rem;
        }
        
        .langue-section {
            padding: 2.5rem;
        }
    }

    @media (max-width: 768px) {
        .langue-detail-header {
            padding: 2.5rem;
            text-align: center;
        }
        
        .langue-header-content {
            flex-direction: column;
            text-align: center;
            gap: 2rem;
        }
        
        .langue-header-text h1 {
            font-size: 2.2rem;
        }
        
        .langue-stats {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .contenus-grid {
            grid-template-columns: 1fr;
        }
        
        .langue-section {
            padding: 2rem;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 576px) {
        .langue-detail-header {
            padding: 2rem;
        }
        
        .langue-header-text h1 {
            font-size: 1.8rem;
        }
        
        .langue-icon-large {
            width: 80px;
            height: 80px;
            font-size: 2.5rem;
        }
        
        .langue-stats {
            grid-template-columns: 1fr;
        }
        
        .langue-stat-card {
            padding: 1.5rem;
        }
        
        .btn-langue {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="langue-detail-page">
    <div class="langue-detail-container">
        <!-- Header de la langue -->
        <div class="langue-detail-header">
            <div class="langue-header-content">
                <div class="langue-icon-large">
                    <i class="bi bi-translate"></i>
                </div>
                <div class="langue-header-text">
                    <h1>{{ $langue->nom_langue }}</h1>
                    <div class="code">
                        <i class="bi bi-tag"></i>
                        Code : {{ $langue->code_langue }}
                    </div>
                    <p style="font-size: 1.1rem; opacity: 0.9; max-width: 800px;">
                        {{ $langue->description }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Statistiques de la langue -->
        <div class="langue-stats">
            <div class="langue-stat-card">
                <div class="langue-stat-number">{{ $contenus->count() }}</div>
                <div class="langue-stat-label">Contenus associés</div>
            </div>
            <div class="langue-stat-card">
                <div class="langue-stat-number">
                    @if($langue->statut === 'nationale')
                        Nationale
                    @elseif($langue->statut === 'officielle')
                        Officielle
                    @else
                        Locale
                    @endif
                </div>
                <div class="langue-stat-label">Statut</div>
            </div>
            <div class="langue-stat-card">
                <div class="langue-stat-number">
                    {{ $langue->created_at->format('Y') }}
                </div>
                <div class="langue-stat-label">Ajoutée en</div>
            </div>
        </div>

        <!-- Section Description -->
        <div class="langue-section">
            <h2 class="section-title">À propos de cette langue</h2>
            <div class="langue-description">
                @if($langue->description)
                    {!! nl2br(e($langue->description)) !!}
                @else
                    <p class="text-muted">Aucune description disponible pour cette langue.</p>
                @endif
            </div>
            
            <!-- Informations supplémentaires -->
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 15px; margin-top: 2rem;">
                <h4 style="font-weight: 700; margin-bottom: 1rem; color: #1a1d21;">
                    <i class="bi bi-info-circle" style="color: var(--langue-primary); margin-right: 0.5rem;"></i>
                    Informations techniques
                </h4>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem;">
                    <div>
                        <strong>Code ISO :</strong>
                        <span style="color: #6c757d;">{{ $langue->code_langue }}</span>
                    </div>
                    <div>
                        <strong>Statut :</strong>
                        <span style="color: #6c757d;">
                            @if($langue->statut === 'nationale')
                                Langue nationale
                            @elseif($langue->statut === 'officielle')
                                Langue officielle
                            @else
                                Langue locale
                            @endif
                        </span>
                    </div>
                    <div>
                        <strong>Date d'ajout :</strong>
                        <span style="color: #6c757d;">{{ $langue->created_at->format('d/m/Y') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Section Contenus associés -->
        <div class="langue-section">
            <h2 class="section-title">Contenus dans cette langue</h2>
            
            @if($contenus->count() > 0)
                <div class="contenus-grid">
                    @foreach($contenus as $contenu)
                    <div class="contenu-card">
                        <h3 class="contenu-title">{{ $contenu->titre }}</h3>
                        <p class="contenu-description">
                            {{ Str::limit($contenu->description, 100) }}
                        </p>
                        <div class="contenu-meta">
                            <span>
                                <i class="bi bi-calendar"></i>
                                {{ $contenu->created_at->format('d/m/Y') }}
                            </span>
                            <span>
                                <i class="bi bi-eye"></i>
                                {{ $contenu->type_contenu }}
                            </span>
                        </div>
                        <a href="{{ route('contenus.show', $contenu->id_contenu) }}" 
                           style="display: inline-block; margin-top: 1rem; color: var(--langue-primary); font-weight: 600; text-decoration: none;">
                            <i class="bi bi-arrow-right"></i> Lire la suite
                        </a>
                    </div>
                    @endforeach
                </div>
                
                @if($contenus->count() >= 6)
                <div style="text-align: center; margin-top: 2rem;">
                    <a href="{{ route('contenus.index') }}?langue={{ $langue->id_langue }}" 
                       class="btn-langue btn-contribute" style="padding: 0.8rem 1.5rem;">
                        <i class="bi bi-list"></i> Voir tous les contenus
                    </a>
                </div>
                @endif
            @else
                <div class="no-contenus">
                    <i class="bi bi-file-earmark-text"></i>
                    <h4>Aucun contenu disponible</h4>
                    <p>Aucun contenu n'a été publié dans cette langue pour le moment.</p>
                    <a href="{{ route('contenus.index') }}" class="btn-langue btn-contribute" style="margin-top: 1rem;">
                        <i class="bi bi-search"></i> Explorer les contenus
                    </a>
                </div>
            @endif
        </div>

        <!-- Actions -->
        <div class="langue-actions">
            <a href="{{ route('langue.index') }}" class="btn-langue btn-back">
                <i class="bi bi-arrow-left"></i> Retour aux langues
            </a>
            
            <!-- Si vous avez une fonctionnalité de contribution -->
            @auth
            <a href="{{ route('contenus.create') }}?langue={{ $langue->id_langue }}" class="btn-langue btn-contribute">
                <i class="bi bi-plus-circle"></i> Contribuer un contenu
            </a>
            @else
            <a href="{{ route('login') }}" class="btn-langue btn-contribute">
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
        const statNumbers = document.querySelectorAll('.langue-stat-number');
        
        statNumbers.forEach(stat => {
            if (!stat.textContent.includes('/') && !isNaN(parseInt(stat.textContent))) {
                const target = parseInt(stat.textContent);
                let current = 0;
                const increment = target / 50;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        stat.textContent = target;
                        clearInterval(timer);
                    } else {
                        stat.textContent = Math.floor(current);
                    }
                }, 30);
            }
        });
        
        // Hover effect pour les cartes de contenu
        const contenuCards = document.querySelectorAll('.contenu-card');
        contenuCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
@endpush