@extends('user.layout')

@section('title', 'Culture Benin - Détail du contenu')

@section('content')
<div class="dashboard-container">
    <!-- Header avec fil d'Ariane -->
    <div class="dashboard-header animate-float-in">
        <div class="page-header">
            <div class="page-header-content">
                <div class="page-title-section">
                    <div class="page-title-icon">
                        <i class="bi bi-eye-fill"></i>
                    </div>
                    <div>
                        <h1 class="page-title">Détail du Contenu</h1>
                        <nav aria-label="breadcrumb" class="page-breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('user.dashboard') }}">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('user.contenus.index') }}">Mes Contenus</a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Détail</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div class="page-actions">
                    <span class="content-id">ID: {{ $contenu->id_contenu }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Carte principale du contenu -->
    <div class="row justify-content-center">
        <div class="col-xl-10">
            <div class="content-detail-card animate-float-in delay-1">
                <!-- En-tête de la carte -->
                <div class="content-card-header">
                    <div class="content-header-main">
                        <div class="content-type-badge">
                            <i class="bi bi-tag-fill me-2"></i>
                            {{ $contenu->typeContenu->nom ?? 'Général' }}
                        </div>
                        <h2 class="content-title">{{ $contenu->titre }}</h2>
                        <div class="content-status-wrapper">
                            @php
                                $statusInfo = $statuts[$contenu->statut] ?? $statuts['brouillon'];
                            @endphp
                            <span class="content-status-badge status-{{ $contenu->statut }}">
                                <i class="bi bi-{{ $statusInfo['icon'] ?? 'circle' }} me-1"></i>
                                {{ $statusInfo['label'] }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Corps de la carte -->
                <div class="content-card-body">
                    <!-- Informations de base -->
                    <div class="content-info-grid">
                        <div class="info-section">
                            <div class="info-section-header">
                                <i class="bi bi-info-circle info-section-icon"></i>
                                <h4>Informations générales</h4>
                            </div>
                            <div class="info-items">
                                <div class="info-item">
                                    <span class="info-label">Région</span>
                                    <span class="info-value">{{ $contenu->region->nom_region ?? 'Non spécifiée' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Langue</span>
                                    <span class="info-value">{{ $contenu->langue->nom_langue ?? 'Non spécifiée' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Date de création</span>
                                    <span class="info-value">{{ $contenu->created_at->format('d/m/Y') }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="info-section">
                            <div class="info-section-header">
                                <i class="bi bi-clock-history info-section-icon"></i>
                                <h4>Historique</h4>
                            </div>
                            <div class="info-items">
                                <div class="info-item">
                                    <span class="info-label">Créé le</span>
                                    <span class="info-value">{{ $contenu->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Dernière modification</span>
                                    <span class="info-value">{{ $contenu->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                                @if($contenu->date_validation)
                                <div class="info-item">
                                    <span class="info-label">Publié le</span>
                                    <span class="info-value text-success">{{ $contenu->date_validation->format('d/m/Y H:i') }}</span>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="content-description-section">
                        <div class="description-header">
                            <i class="bi bi-text-paragraph description-icon"></i>
                            <h3>Description</h3>
                        </div>
                        <div class="description-content">
                            <div class="description-text">
                                {!! nl2br(e($contenu->description)) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Contenu texte -->
                    <div class="content-text-section">
                        <div class="text-header">
                            <i class="bi bi-file-text text-icon"></i>
                            <h3>Contenu détaillé</h3>
                        </div>
                        <div class="text-content">
                            <div class="text-content-wrapper">
                                {!! nl2br(e($contenu->texte)) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer de la carte -->
                <div class="content-card-footer">
                    <div class="footer-actions">
                        <a href="{{ route('user.contenus.index') }}" class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>
                            Retour à la liste
                        </a>
                        <div class="action-buttons">
                            <a href="{{ route('user.contenus.edit', $contenu->id_contenu) }}" class="btn btn-primary">
                                <i class="bi bi-pencil-square me-2"></i>
                                Modifier
                            </a>
                            @if($contenu->statut === 'publie')
                            <a href="{{ url('/contenus/' . $contenu->id_contenu) }}" target="_blank" class="btn btn-success">
                                <i class="bi bi-eye me-2"></i>
                                Voir sur le site
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* ===== VARIABLES ===== */
    :root {
        --primary-color: #008000;
        --primary-light: rgba(0, 128, 0, 0.1);
        --secondary-color: #e17000;
        --dark-color: #1a1d21;
        --light-color: #f8f9fa;
        --border-color: #e9ecef;
        --success-color: #198754;
        --warning-color: #ffc107;
        --info-color: #0dcaf0;
        --danger-color: #dc3545;
        --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
        --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.12);
        --shadow-lg: 0 8px 32px rgba(0, 0, 0, 0.16);
        --radius-sm: 8px;
        --radius-md: 12px;
        --radius-lg: 16px;
        --radius-xl: 20px;
        --transition: all 0.3s ease;
    }

    /* ===== STRUCTURE ===== */
    .dashboard-container {
        max-width: 1400px;
        margin: 100px auto 40px;
        padding: 0 1.5rem;
    }

    /* ===== HEADER DE PAGE ===== */
    .page-header {
        background: white;
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        margin-bottom: 2rem;
        border: 1px solid var(--border-color);
    }

    .page-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .page-title-section {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .page-title-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, var(--primary-color), #00a000);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .page-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--dark-color);
        margin: 0 0 0.5rem 0;
    }

    .page-breadcrumb {
        margin: 0;
    }

    .breadcrumb {
        background: transparent;
        padding: 0;
        margin: 0;
        font-size: 0.9rem;
    }

    .breadcrumb-item a {
        color: #6c757d;
        text-decoration: none;
        transition: var(--transition);
    }

    .breadcrumb-item a:hover {
        color: var(--primary-color);
    }

    .breadcrumb-item.active {
        color: var(--dark-color);
        font-weight: 500;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: #adb5bd;
    }

    .page-actions {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .content-id {
        background: var(--light-color);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        color: #6c757d;
        border: 1px solid var(--border-color);
    }

    /* ===== CARTE DE DÉTAIL ===== */
    .content-detail-card {
        background: white;
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-md);
        border: 1px solid var(--border-color);
        transition: var(--transition);
    }

    .content-detail-card:hover {
        box-shadow: var(--shadow-lg);
    }

    /* En-tête de la carte */
    .content-card-header {
        background: linear-gradient(135deg, var(--dark-color) 0%, #2d3436 100%);
        color: white;
        padding: 2.5rem;
        position: relative;
        overflow: hidden;
    }

    .content-card-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(225, 112, 0, 0.1) 0%, transparent 70%);
    }

    .content-header-main {
        position: relative;
        z-index: 1;
    }

    .content-type-badge {
        display: inline-flex;
        align-items: center;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 1rem;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .content-title {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1.3;
        margin: 0 0 1rem 0;
        color: white;
    }

    .content-status-wrapper {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .content-status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.5rem 1.25rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .status-publie {
        background: rgba(25, 135, 84, 0.2);
        color: #20c997;
    }

    .status-en_attente {
        background: rgba(255, 193, 7, 0.2);
        color: #ffda6a;
    }

    .status-brouillon {
        background: rgba(108, 117, 125, 0.2);
        color: #adb5bd;
    }

    .status-rejete {
        background: rgba(220, 53, 69, 0.2);
        color: #f5a8b3;
    }

    /* Corps de la carte */
    .content-card-body {
        padding: 2.5rem;
    }

    /* Grille d'informations */
    .content-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 3rem;
    }

    .info-section {
        background: var(--light-color);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .info-section-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border-color);
    }

    .info-section-icon {
        font-size: 1.5rem;
        color: var(--primary-color);
    }

    .info-section-header h4 {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
        color: var(--dark-color);
    }

    .info-items {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .info-label {
        font-size: 0.9rem;
        font-weight: 500;
        color: #6c757d;
    }

    .info-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--dark-color);
        text-align: right;
    }

    /* Sections de contenu */
    .content-description-section,
    .content-text-section {
        margin-bottom: 3rem;
    }

    .description-header,
    .text-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        margin-bottom: 1.5rem;
    }

    .description-icon,
    .text-icon {
        font-size: 1.5rem;
        color: var(--primary-color);
    }

    .description-header h3,
    .text-header h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
        color: var(--dark-color);
    }

    .description-content,
    .text-content {
        background: var(--light-color);
        border-radius: var(--radius-md);
        padding: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .description-text,
    .text-content-wrapper {
        line-height: 1.8;
        font-size: 1.05rem;
        color: var(--dark-color);
    }

    .description-text p,
    .text-content-wrapper p {
        margin-bottom: 1.5rem;
    }

    .description-text p:last-child,
    .text-content-wrapper p:last-child {
        margin-bottom: 0;
    }

    /* Footer de la carte */
    .content-card-footer {
        padding: 1.5rem 2.5rem;
        background: var(--light-color);
        border-top: 1px solid var(--border-color);
    }

    .footer-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1rem;
    }

    .action-buttons {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        border-radius: var(--radius-md);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: var(--transition);
        border: 2px solid transparent;
    }

    .btn-outline-secondary {
        border-color: #6c757d;
        color: #6c757d;
        background: transparent;
    }

    .btn-outline-secondary:hover {
        background: #6c757d;
        color: white;
        transform: translateY(-2px);
        box-shadow: var(--shadow-sm);
    }

    .btn-primary {
        background: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
    }

    .btn-primary:hover {
        background: #006600;
        border-color: #006600;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 128, 0, 0.2);
    }

    .btn-success {
        background: var(--success-color);
        border-color: var(--success-color);
        color: white;
    }

    .btn-success:hover {
        background: #157347;
        border-color: #157347;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2);
    }

    /* ===== ANIMATIONS ===== */
    @keyframes floatIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-float-in {
        animation: floatIn 0.6s ease forwards;
        opacity: 0;
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }

    /* ===== RESPONSIVE ===== */
    @media (max-width: 1200px) {
        .dashboard-container {
            padding: 0 1rem;
        }
    }

    @media (max-width: 992px) {
        .content-info-grid {
            grid-template-columns: 1fr;
        }
        
        .content-card-header {
            padding: 2rem;
        }
        
        .content-card-body {
            padding: 2rem;
        }
    }

    @media (max-width: 768px) {
        .dashboard-container {
            margin-top: 80px;
        }
        
        .page-header-content {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .page-actions {
            align-self: flex-end;
        }
        
        .content-title {
            font-size: 1.5rem;
        }
        
        .footer-actions {
            flex-direction: column;
            align-items: stretch;
        }
        
        .action-buttons {
            justify-content: center;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .content-card-header {
            padding: 1.5rem;
        }
        
        .content-card-body {
            padding: 1.5rem;
        }
        
        .content-card-footer {
            padding: 1rem 1.5rem;
        }
        
        .content-type-badge {
            font-size: 0.8rem;
        }
        
        .content-status-badge {
            font-size: 0.8rem;
            padding: 0.4rem 1rem;
        }
        
        .info-section {
            padding: 1.25rem;
        }
        
        .description-content,
        .text-content {
            padding: 1.25rem;
        }
    }

    @media (max-width: 480px) {
        .content-info-grid {
            gap: 1rem;
        }
        
        .info-section {
            padding: 1rem;
        }
        
        .description-content,
        .text-content {
            padding: 1rem;
        }
        
        .description-text,
        .text-content-wrapper {
            font-size: 1rem;
        }
    }
</style>

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Animation au scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        });

        // Observer les éléments à animer
        document.querySelectorAll('.animate-float-in').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(el);
        });

        // Effet de survol pour les boutons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });

        // Mise en forme des liens dans le texte
        const textContent = document.querySelector('.text-content-wrapper');
        if (textContent) {
            const links = textContent.querySelectorAll('a');
            links.forEach(link => {
                link.target = '_blank';
                link.rel = 'noopener noreferrer';
                link.classList.add('text-primary', 'fw-medium');
            });
        }
    });
</script>
@endsection