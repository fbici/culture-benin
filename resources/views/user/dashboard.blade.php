@extends('layouts.app')


@section('title', 'Culture Benin - Accueil')

@section('content')
<div class="dashboard-container">
    <!-- Message de bienvenue HERO -->
    <div class="welcome-hero animate-float-in">
        <div class="row align-items-center">
            <div class="col-lg-9">
                <div class="welcome-icon-container">
                    <i class="bi bi-emoji-heart-eyes"></i>
                </div>
                <h1 class="fw-bold mb-3" style="font-size: 2.5rem;">
                    Bon retour, <span style="color: #e17000;">{{ auth()->user()->prenom }}</span> !
                </h1>
                <p class="fs-5 text-muted mb-4">
                    Vous êtes connecté à votre espace personnel Culture Benin. 
                    <br>Contribuez à la préservation du riche patrimoine culturel béninois.
                </p>
                <div class="d-flex align-items-center gap-3">
                    <span class="text-muted">
                        <i class="bi bi-calendar-check me-1"></i>
                        {{ now()->translatedFormat('l d F Y') }}
                    </span>
                    <span class="text-muted">•</span>
                    <span class="text-muted">
                        <i class="bi bi-clock me-1"></i>
                        {{ now()->format('H:i') }}
                    </span>
                </div>
            </div>
            <div class="col-lg-3 text-lg-end">
                <div class="d-inline-block p-4 rounded-3" style="background: linear-gradient(135deg, rgba(0, 128, 0, 0.1) 0%, rgba(255, 215, 0, 0.05) 100%);">
                    <i class="bi bi-globe-africa display-4" style="color: #008000;"></i>
                </div>
            </div>
        </div>
    </div>


    <!-- Cartes Statistiques -->
    <div class="row mb-5">
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stat-card-premium animate-float-in delay-1">
                <div class="stat-card-content">
                    <div class="stat-icon-premium stat-icon-contenus">
                        <i class="bi bi-journal-richtext"></i>
                    </div>
                    <div class="stat-number-premium">{{ $stats['contenus'] ?? 0 }}</div>
                    <h4 class="fw-bold mb-3">Contenus Culturels</h4>
                    <p class="text-muted mb-4">
                        Articles, documents et ressources partagés pour préserver le patrimoine.
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('user.contenus.index') }}" class="btn btn-outline-success px-4">
                            <i class="bi bi-arrow-right me-2"></i>Gérer
                        </a>
                        <span class="stat-trend">
                            <i class="bi bi-graph-up"></i> Vos contributions
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stat-card-premium animate-float-in delay-2">
                <div class="stat-card-content">
                    <div class="stat-icon-premium stat-icon-medias">
                        <i class="bi bi-images"></i>
                    </div>
                    <div class="stat-number-premium">{{ $stats['medias'] ?? 0 }}</div>
                    <h4 class="fw-bold mb-3">Médias Numériques</h4>
                    <p class="text-muted mb-4">
                        Images, vidéos et documents multimédias enrichissant notre patrimoine.
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('user.medias.index') }}" class="btn btn-outline-warning px-4">
                            <i class="bi bi-arrow-right me-2"></i>Gérer
                        </a>
                        <span class="stat-trend" style="background: rgba(255, 193, 7, 0.1); color: #ffc107;">
                            <i class="bi bi-upload"></i> Partager
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 mb-4">
            <div class="stat-card-premium animate-float-in delay-3">
                <div class="stat-card-content">
                    <div class="stat-icon-premium stat-icon-commentaires">
                        <i class="bi bi-chat-square-text"></i>
                    </div>
                    <div class="stat-number-premium">{{ $stats['commentaires'] ?? 0 }}</div>
                    <h4 class="fw-bold mb-3">Contributions</h4>
                    <p class="text-muted mb-4">
                        Commentaires et échanges avec la communauté culturelle.
                    </p>
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="#" class="btn btn-outline-info px-4">
                            <i class="bi bi-arrow-right me-2"></i>Voir
                        </a>
                        <span class="stat-trend" style="background: rgba(13, 202, 240, 0.1); color: #0dcaf0;">
                            <i class="bi bi-chat"></i> Échanger
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Colonne principale -->
        <div class="col-lg-8">
            <!-- Contenus Récents -->
            <div class="recent-section-pro mb-4 animate-float-in delay-1">
                <div class="section-header-pro">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="section-title-pro">
                            <i class="bi bi-clock-history me-2"></i>Vos Contenus Récents
                        </h3>
                        <a href="{{ route('user.contenus.index') }}" class="btn-view-all-pro">
                            <i class="bi bi-list me-1"></i>Tous les contenus
                        </a>
                    </div>
                </div>
                <div class="recent-content-body">
                    @php
                        $contenusLimites = $contenusRecents->take(5);
                    @endphp
                    @forelse($contenusLimites as $contenu)
                    <a href="{{ route('user.contenus.show', $contenu->id_contenu) }}" class="content-item-pro">
                        <div class="row align-items-center">
                            <div class="col-md-8">
                                <span class="content-type-badge">
                                    <i class="bi bi-tag me-1"></i>
                                    {{ $contenu->typeContenu->nom ?? 'Général' }}
                                </span>
                                <h5 class="fw-bold mb-1">{{ $contenu->titre }}</h5>
                                <p class="text-muted mb-0 small">
                                    {{ Str::limit($contenu->description, 80) }}
                                </p>
                                <div class="mt-2 d-flex align-items-center gap-3">
                                    <small class="text-muted">
                                        <i class="bi bi-calendar me-1"></i>
                                        {{ $contenu->created_at->format('d/m/Y') }}
                                    </small>
                                    <small class="text-muted">
                                        <i class="bi bi-geo-alt me-1"></i>
                                        {{ $contenu->region->nom_region ?? 'Bénin' }}
                                    </small>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <span class="content-status-badge status-{{ $contenu->statut }}">
                                    {{ $contenu->statut }}
                                </span>
                            </div>
                        </div>
                    </a>
                    @empty
                    <div class="content-item-pro text-center py-5">
                        <i class="bi bi-file-earmark-text display-4 text-muted mb-3 opacity-50"></i>
                        <h4 class="text-muted mb-2">Aucun contenu pour le moment</h4>
                        <p class="text-muted mb-4">Commencez par créer votre premier contenu culturel</p>
                        <a href="{{ route('user.contenus.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle me-2"></i>Créer un contenu
                        </a>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Actions Rapides -->
            <h3 class="fw-bold mb-4 animate-float-in delay-2">
                <i class="bi bi-lightning-charge-fill me-2" style="color: #e17000;"></i>
                Actions Rapides
            </h3>
            
            <div class="row g-4 mb-5">
                <div class="col-md-6">
                    <div class="action-card-pro animate-float-in delay-2">
                        <div class="p-4">
                            <div class="action-icon-pro action-icon-create">
                                <i class="bi bi-file-earmark-plus"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Nouveau Contenu</h4>
                            <p class="text-muted mb-4">
                                Partagez vos connaissances sur la culture béninoise avec un nouvel article.
                            </p>
                            <a href="{{ route('user.contenus.create') }}" class="btn-action-pro btn-action-success w-100">
                                <i class="bi bi-plus-circle me-2"></i>Créer maintenant
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="action-card-pro animate-float-in delay-3">
                        <div class="p-4">
                            <div class="action-icon-pro action-icon-upload">
                                <i class="bi bi-cloud-arrow-up"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Uploader Média</h4>
                            <p class="text-muted mb-4">
                                Ajoutez des images, vidéos ou documents pour enrichir les contenus.
                            </p>
                            <a href="{{ route('user.medias.create') }}" class="btn-action-pro btn-action-warning w-100">
                                <i class="bi bi-upload me-2"></i>Uploader
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="action-card-pro animate-float-in delay-3">
                        <div class="p-4">
                            <div class="action-icon-pro action-icon-explore">
                                <i class="bi bi-compass"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Explorer</h4>
                            <p class="text-muted mb-4">
                                Découvrez les contenus culturels publiés par la communauté.
                            </p>
                            <a href="{{ url('/') }}" class="btn-action-pro w-100" style="border-color: #0dcaf0; color: #0dcaf0; background: rgba(13, 202, 240, 0.1);">
                                <i class="bi bi-globe me-2"></i>Visiter le site
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="action-card-pro animate-float-in delay-4">
                        <div class="p-4">
                            <div class="action-icon-pro action-icon-settings">
                                <i class="bi bi-gear"></i>
                            </div>
                            <h4 class="fw-bold mb-3">Paramètres</h4>
                            <p class="text-muted mb-4">
                                Gérez vos préférences et paramètres de compte.
                            </p>
                            <a href="{{ route('user.profile.edit') }}" class="btn-action-pro w-100" style="border-color: #6f42c1; color: #6f42c1; background: rgba(111, 66, 193, 0.1);">
                                <i class="bi bi-person-gear me-2"></i>Mon compte
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar droite -->
        <div class="col-lg-4">
            <div class="guide-sidebar animate-float-in delay-4">
                <div class="guide-header">
                    <div class="guide-icon-header">
                        <i class="bi bi-info-square"></i>
                    </div>
                    <div>
                        <h3 class="fw-bold mb-0">Guide</h3>
                        <p class="text-muted small">Comment contribuer efficacement</p>
                    </div>
                </div>

                <div class="guide-step-pro">
                    <div class="step-number-pro">1</div>
                    <div class="step-content">
                        <h6>Créez du contenu qualitatif</h6>
                        <p class="text-muted small mb-0">
                            Partagez des informations précises et documentées sur la culture béninoise.
                        </p>
                    </div>
                </div>

                <div class="guide-step-pro">
                    <div class="step-number-pro">2</div>
                    <div class="step-content">
                        <h6>Illustrez avec des médias</h6>
                        <p class="text-muted small mb-0">
                            Ajoutez des images et vidéos pertinentes pour enrichir vos contenus.
                        </p>
                    </div>
                </div>

                <div class="guide-step-pro">
                    <div class="step-number-pro">3</div>
                    <div class="step-content">
                        <h6>Interagissez avec la communauté</h6>
                        <p class="text-muted small mb-0">
                            Commentez, discutez et échangez avec les autres passionnés.
                        </p>
                    </div>
                </div>

                <div class="guide-step-pro">
                    <div class="step-number-pro">4</div>
                    <div class="step-content">
                        <h6>Respectez les guidelines</h6>
                        <p class="text-muted small mb-0">
                            Assurez-vous que vos contributions respectent les règles de la plateforme.
                        </p>
                    </div>
                </div>

                <div class="guide-step-pro">
                    <div class="step-number-pro">5</div>
                    <div class="step-content">
                        <h6>Partagez la culture</h6>
                        <p class="text-muted small mb-0">
                            Faites connaître le patrimoine béninois au plus grand nombre.
                        </p>
                    </div>
                </div>

                <div class="encouragement-banner">
                    <div class="text-center">
                        <i class="bi bi-star-fill fs-1 mb-3 d-block" style="color: #ffd700;"></i>
                        <h6 class="fw-bold mb-2">Vous contribuez à préserver notre héritage !</h6>
                        <p class="text-muted small mb-0">
                            Chaque contenu partagé est une pierre ajoutée à l'édifice de notre patrimoine culturel.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* ===== STYLES SPÉCIFIQUES AU DASHBOARD ===== */
    .dashboard-container {
        max-width: 1400px;
        margin: 120px auto 40px;
        padding: 0 2rem;
    }

    /* Message de bienvenue STYLE PREMIUM */
    .welcome-hero {
        background: white;
        border-radius: 24px;
        padding: 3rem;
        margin-bottom: 3rem;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        border-left: 6px solid #e17000;
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    }

    .welcome-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, rgba(225, 112, 0, 0.08) 0%, rgba(255, 215, 0, 0.04) 100%);
        border-radius: 50%;
    }

    .welcome-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -30%;
        width: 200px;
        height: 200px;
        background: linear-gradient(135deg, rgba(0, 128, 0, 0.06) 0%, rgba(255, 215, 0, 0.03) 100%);
        border-radius: 50%;
    }

    .welcome-icon-container {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #e17000 0%, #ff8c00 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        color: white;
        margin-bottom: 2rem;
        box-shadow: 0 12px 30px rgba(225, 112, 0, 0.3);
        position: relative;
        z-index: 2;
    }

    /* Cartes statistiques ULTRA PREMIUM */
    .stat-card-premium {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        position: relative;
        background: white;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .stat-card-premium:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
    }

    .stat-card-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 5px;
        background: linear-gradient(90deg, #008751 0%, #fcd116 50%, #e8112d 100%);
    }

    .stat-card-content {
        padding: 2.5rem;
        position: relative;
        z-index: 2;
    }

    .stat-icon-premium {
        width: 80px;
        height: 80px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 2rem;
        font-size: 2rem;
        color: white;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        position: relative;
        overflow: hidden;
    }

    .stat-icon-premium::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, transparent 100%);
    }

    .stat-icon-contenus { 
        background: linear-gradient(135deg, #198754 0%, #20c997 100%); 
    }
    .stat-icon-medias { 
        background: linear-gradient(135deg, #ffc107 0%, #ffda6a 100%); 
    }
    .stat-icon-commentaires { 
        background: linear-gradient(135deg, #0dcaf0 0%, #5ecdf5 100%); 
    }

    .stat-number-premium {
        font-size: 3.5rem;
        font-weight: 900;
        line-height: 1;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #1a1d21 0%, #495057 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
    }

    .stat-trend {
        display: inline-flex;
        align-items: center;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        background: rgba(25, 135, 84, 0.1);
        color: #198754;
    }

    .stat-trend i {
        margin-right: 0.3rem;
    }

    /* Section contenus récents STYLE PRO */
    .recent-section-pro {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .section-header-pro {
        background: linear-gradient(135deg, #008000 0%, #00a000 100%);
        color: white;
        padding: 2rem;
        position: relative;
        overflow: hidden;
    }

    .section-header-pro::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(30%, -30%);
    }

    .section-title-pro {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }

    .content-item-pro {
        padding: 1.75rem 2rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
        display: block;
        text-decoration: none;
        color: inherit;
        position: relative;
    }

    .content-item-pro:hover {
        background: linear-gradient(90deg, rgba(0, 128, 0, 0.03) 0%, transparent 100%);
        transform: translateX(15px);
        border-left: 4px solid #e17000;
    }

    .content-item-pro:last-child {
        border-bottom: none;
    }

    .content-type-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        background: rgba(0, 128, 0, 0.1);
        color: #008000;
        margin-bottom: 0.5rem;
    }

    .content-status-badge {
        position: absolute;
        top: 1.75rem;
        right: 2rem;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .status-publié { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
    .status-en_attente { background: #fff3cd; color: #856404; border: 1px solid #ffeaa7; }
    .status-brouillon { background: #e2e3e5; color: #383d41; border: 1px solid #d6d8db; }
    .status-rejeté { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

    /* Actions rapides CARDS PRO */
    .action-card-pro {
        border: none;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        background: white;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .action-card-pro:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    .action-card-pro::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #008751 0%, #fcd116 50%, #e8112d 100%);
    }

    .action-icon-pro {
        width: 70px;
        height: 70px;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        margin-bottom: 1.5rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        position: relative;
        overflow: hidden;
    }

    .action-icon-pro::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2) 0%, transparent 100%);
    }

    .action-icon-create { background: linear-gradient(135deg, #198754 0%, #20c997 100%); }
    .action-icon-upload { background: linear-gradient(135deg, #ffc107 0%, #ffda6a 100%); }
    .action-icon-explore { background: linear-gradient(135deg, #0dcaf0 0%, #5ecdf5 100%); }
    .action-icon-settings { background: linear-gradient(135deg, #6f42c1 0%, #a370f7 100%); }

    .btn-action-pro {
        border: 2px solid;
        border-radius: 12px;
        padding: 0.9rem 1.5rem;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        text-decoration: none;
        position: relative;
        overflow: hidden;
    }

    .btn-action-pro::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn-action-pro:hover::before {
        left: 100%;
    }

    .btn-action-success { 
        border-color: #198754 !important; 
        color: #198754 !important; 
        background: rgba(25, 135, 84, 0.1);
    }
    .btn-action-success:hover { 
        background: #198754 !important; 
        color: white !important; 
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(25, 135, 84, 0.3);
    }

    .btn-action-warning { 
        border-color: #ffc107 !important; 
        color: #ffc107 !important; 
        background: rgba(255, 193, 7, 0.1);
    }
    .btn-action-warning:hover { 
        background: #ffc107 !important; 
        color: #1a1d21 !important; 
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 193, 7, 0.3);
    }

    /* Guide sidebar STYLE PREMIUM */
    .guide-sidebar {
        background: white;
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(0, 0, 0, 0.05);
        height: 100%;
        position: relative;
        overflow: hidden;
    }

    .guide-sidebar::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, rgba(225, 112, 0, 0.05) 0%, rgba(255, 215, 0, 0.02) 100%);
        border-radius: 0 24px 0 100px;
    }

    .guide-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2.5rem;
    }

    .guide-icon-header {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #e17000 0%, #ff8c00 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        box-shadow: 0 8px 20px rgba(225, 112, 0, 0.3);
    }

    .guide-step-pro {
        display: flex;
        align-items: flex-start;
        gap: 1.2rem;
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .guide-step-pro:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }

    .step-number-pro {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #e17000 0%, #ff8c00 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 800;
        font-size: 1rem;
        flex-shrink: 0;
        box-shadow: 0 8px 20px rgba(225, 112, 0, 0.3);
        position: relative;
        z-index: 1;
    }

    /* Bannière encouragement */
    .encouragement-banner {
        background: linear-gradient(135deg, rgba(255, 215, 0, 0.15) 0%, rgba(225, 112, 0, 0.08) 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-top: 2rem;
        border: 2px dashed #ffd700;
        position: relative;
        overflow: hidden;
    }

    .encouragement-banner::before {
        content: '';
        position: absolute;
        top: -20px;
        right: -20px;
        width: 100px;
        height: 100px;
        background: rgba(255, 215, 0, 0.1);
        border-radius: 50%;
    }

    /* Boutons améliorés */
    .btn-view-all-pro {
        background: transparent;
        border: 2px solid white;
        color: white;
        padding: 0.7rem 1.8rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        text-decoration: none;
    }

    .btn-view-all-pro:hover {
        background: white;
        color: #008000;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(255, 255, 255, 0.2);
    }

    /* Animations */
    @keyframes floatIn {
        from {
            opacity: 0;
            transform: translateY(30px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .animate-float-in {
        animation: floatIn 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }

    /* Responsive */
    @media (max-width: 1200px) {
        .dashboard-container {
            padding: 0 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            margin-top: 100px;
            padding: 0 1rem;
        }
        
        .welcome-hero {
            padding: 2rem;
        }
        
        .stat-card-premium {
            margin-bottom: 1.5rem;
        }
        
        .stat-number-premium {
            font-size: 2.8rem;
        }
        
        .content-item-pro {
            padding: 1.5rem;
        }
        
        .content-status-badge {
            position: static;
            margin-top: 0.5rem;
            display: inline-block;
        }
    }

    @media (max-width: 576px) {
        .welcome-icon-container {
            width: 60px;
            height: 60px;
            font-size: 1.8rem;
        }
        
        .stat-number-premium {
            font-size: 2.5rem;
        }
        
        .section-header-pro {
            padding: 1.5rem;
        }
        
        .guide-sidebar {
            padding: 1.5rem;
        }
    }
</style>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation au scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-float-in');
                }
            });
        }, observerOptions);

        // Observer les éléments à animer
        document.querySelectorAll('.stat-card-premium, .recent-section-pro, .action-card-pro, .guide-sidebar').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endsection