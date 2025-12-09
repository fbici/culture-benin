@extends('layouts.app')

@section('title', 'À Propos - Culture Benin')

@push('styles')
<style>
    /* ===== STYLES POUR LA PAGE À PROPOS ===== */
    :root {
        --about-primary: #e17000;
        --about-secondary: #008000;
        --about-accent: #ffd700;
    }

    .about-page {
        background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f5 100%);
        min-height: calc(100vh - 180px);
        padding-top: 30px;
        padding-bottom: 60px;
    }

    .about-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
    }

    /* Hero Section */
    .about-hero {
        background: linear-gradient(135deg, 
            rgba(225, 112, 0, 0.95) 0%, 
            rgba(193, 96, 0, 0.9) 100%);
        border-radius: 20px;
        padding: 5rem 3rem;
        margin-bottom: 3rem;
        color: white;
        position: relative;
        overflow: hidden;
        text-align: center;
    }

    .about-hero::before {
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

    /* Remplacer dans les styles de la page À Propos */
    .about-icon {
        width: 120px;
        height: 120px;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        display: flex !important;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        margin: 0 auto 2rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
        position: relative;
    }

    /* Ajouter cette règle supplémentaire */
    .about-icon i {
        display: block !important;
        opacity: 1 !important;
        z-index: 2;
    }


    .about-hero h1 {
        font-size: 3.5rem;
        font-weight: 900;
        margin-bottom: 1.5rem;
        line-height: 1.2;
    }

    .about-hero p {
        font-size: 1.3rem;
        opacity: 0.9;
        max-width: 900px;
        margin: 0 auto;
        line-height: 1.7;
    }

    /* Sections */
    .about-section {
        background: white;
        border-radius: 20px;
        padding: 3.5rem;
        margin-bottom: 2.5rem;
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
        background: linear-gradient(90deg, var(--about-primary), var(--about-secondary));
        border-radius: 2px;
    }

    .section-subtitle {
        font-size: 1.4rem;
        font-weight: 700;
        color: var(--about-primary);
        margin: 2rem 0 1rem;
    }

    /* Mission */
    .mission-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2.5rem;
        margin-top: 2rem;
    }

    .mission-card {
        background: #f8f9fa;
        border-radius: 18px;
        padding: 2.5rem;
        text-align: center;
        transition: all 0.4s ease;
        border: 2px solid transparent;
        height: 100%;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .mission-card:hover {
        transform: translateY(-10px);
        background: white;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
        border-color: var(--about-primary);
    }

    .mission-icon {
        font-size: 3rem;
        color: var(--about-primary);
        margin-bottom: 1.5rem;
        background: rgba(225, 112, 0, 0.1);
        padding: 1.5rem;
        border-radius: 20px;
    }

    .mission-card h3 {
        font-size: 1.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        color: #1a1d21;
    }

    .mission-card p {
        color: #6c757d;
        line-height: 1.7;
        margin: 0;
        flex-grow: 1;
    }

    /* Notre Histoire */
    .timeline {
        position: relative;
        max-width: 800px;
        margin: 3rem auto 0;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        width: 3px;
        height: 100%;
        background: var(--about-primary);
    }

    .timeline-item {
        margin-bottom: 3rem;
        position: relative;
    }

    .timeline-year {
        position: absolute;
        left: 50%;
        transform: translateX(-50%);
        background: var(--about-primary);
        color: white;
        padding: 0.8rem 1.5rem;
        border-radius: 25px;
        font-weight: 700;
        z-index: 1;
        box-shadow: 0 5px 15px rgba(225, 112, 0, 0.3);
    }

    .timeline-content {
        background: #f8f9fa;
        padding: 2rem;
        border-radius: 15px;
        margin-top: 3rem;
        border-left: 4px solid var(--about-primary);
    }

    /* Nos Domaines */
    .domaines-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .domaine-card {
        background: linear-gradient(135deg, rgba(225, 112, 0, 0.05) 0%, rgba(0, 128, 0, 0.05) 100%);
        border-radius: 15px;
        padding: 2rem;
        border: 1px solid rgba(225, 112, 0, 0.1);
        transition: transform 0.3s ease;
    }

    .domaine-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    }

    .domaine-icon {
        font-size: 2.5rem;
        color: var(--about-primary);
        margin-bottom: 1rem;
    }

    .domaine-card h4 {
        font-size: 1.3rem;
        font-weight: 800;
        margin-bottom: 0.8rem;
        color: #1a1d21;
    }

    .domaine-card ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .domaine-card li {
        padding: 0.5rem 0;
        color: #6c757d;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .domaine-card li i {
        color: var(--about-secondary);
        font-size: 0.9rem;
    }

    /* Valeurs */
    .values-list {
        list-style: none;
        padding: 0;
        max-width: 800px;
        margin: 2rem auto 0;
    }

    .value-item {
        display: flex;
        align-items: flex-start;
        gap: 2rem;
        margin-bottom: 2.5rem;
        padding: 2rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #f1f3f5 100%);
        border-radius: 15px;
        border-left: 5px solid var(--about-primary);
        transition: transform 0.3s ease;
    }

    .value-item:hover {
        transform: translateX(10px);
    }

    .value-icon {
        font-size: 2.5rem;
        color: var(--about-primary);
        flex-shrink: 0;
        background: rgba(225, 112, 0, 0.1);
        padding: 1rem;
        border-radius: 15px;
    }

    .value-content h3 {
        font-size: 1.4rem;
        font-weight: 800;
        margin-bottom: 0.8rem;
        color: #1a1d21;
    }

    .value-content p {
        color: #6c757d;
        line-height: 1.7;
        margin: 0;
    }

    /* Statistiques */
    .stats-about {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 2rem;
        margin-top: 3rem;
    }

    .stat-about {
        text-align: center;
        background: linear-gradient(135deg, var(--about-primary) 0%, var(--about-accent) 100%);
        color: white;
        padding: 2.5rem 1.5rem;
        border-radius: 20px;
        box-shadow: 0 15px 30px rgba(225, 112, 0, 0.3);
        transition: transform 0.3s ease;
    }

    .stat-about:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(225, 112, 0, 0.4);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 900;
        margin-bottom: 0.5rem;
        line-height: 1;
    }

    .stat-label {
        font-size: 1.1rem;
        opacity: 0.9;
    }

    /* Équipe */
    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 2.5rem;
        margin-top: 2rem;
    }

    .team-member {
        text-align: center;
        background: #f8f9fa;
        border-radius: 20px;
        padding: 2.5rem 2rem;
        transition: all 0.4s ease;
        border: 2px solid transparent;
    }

    .team-member:hover {
        transform: translateY(-10px);
        background: white;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
        border-color: var(--about-secondary);
    }

    .member-avatar {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--about-primary) 0%, var(--about-accent) 100%);
        margin: 0 auto 1.5rem;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 3.5rem;
        box-shadow: 0 10px 25px rgba(225, 112, 0, 0.3);
    }

    .member-name {
        font-size: 1.4rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
        color: #1a1d21;
    }

    .member-role {
        color: var(--about-primary);
        font-weight: 600;
        margin-bottom: 1rem;
        font-size: 1.1rem;
    }

    .member-desc {
        color: #6c757d;
        line-height: 1.6;
        font-size: 0.95rem;
    }

    /* CTA */
    .cta-section {
        background: linear-gradient(135deg, 
            rgba(0, 128, 0, 0.1) 0%, 
            rgba(225, 112, 0, 0.08) 100%);
        border-radius: 25px;
        padding: 5rem 4rem;
        text-align: center;
        margin-top: 4rem;
        border: 3px solid var(--about-secondary);
        position: relative;
        overflow: hidden;
    }

    .cta-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        right: -50%;
        bottom: -50%;
        background: radial-gradient(circle at 50% 50%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        animation: rotate 20s linear infinite;
    }

    @keyframes rotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .cta-title {
        font-size: 2.8rem;
        font-weight: 900;
        margin-bottom: 1.5rem;
        color: #1a1d21;
        position: relative;
        z-index: 1;
    }

    .cta-text {
        font-size: 1.3rem;
        color: #555;
        margin-bottom: 2.5rem;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.7;
        position: relative;
        z-index: 1;
    }

    .cta-buttons {
        display: flex;
        gap: 1.5rem;
        justify-content: center;
        flex-wrap: wrap;
        position: relative;
        z-index: 1;
    }

    .btn-cta {
        padding: 1.2rem 2.5rem;
        border-radius: 15px;
        font-weight: 700;
        font-size: 1.1rem;
        text-decoration: none;
        transition: all 0.4s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        border: 2px solid transparent;
    }

    .btn-cta-primary {
        background: linear-gradient(135deg, var(--about-primary) 0%, #d15c00 100%);
        color: white;
        box-shadow: 0 10px 25px rgba(225, 112, 0, 0.3);
    }

    .btn-cta-primary:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(225, 112, 0, 0.4);
        color: white;
    }

    .btn-cta-secondary {
        background: transparent;
        color: var(--about-secondary);
        border-color: var(--about-secondary);
    }

    .btn-cta-secondary:hover {
        background: var(--about-secondary);
        color: white;
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 128, 0, 0.3);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .about-container {
            padding: 0 1.5rem;
        }
        
        .about-hero {
            padding: 4rem 2.5rem;
        }
        
        .about-hero h1 {
            font-size: 2.8rem;
        }
        
        .about-section {
            padding: 3rem;
        }
        
        .section-title {
            font-size: 2rem;
        }
        
        .timeline::before {
            left: 30px;
        }
        
        .timeline-year {
            left: 30px;
            transform: none;
        }
        
        .timeline-content {
            margin-left: 80px;
        }
    }

    @media (max-width: 768px) {
        .about-container {
            padding: 0 1rem;
        }
        
        .about-hero {
            padding: 3rem 2rem;
        }
        
        .about-hero h1 {
            font-size: 2.2rem;
        }
        
        .about-hero p {
            font-size: 1.1rem;
        }
        
        .about-icon {
            width: 100px;
            height: 100px;
            font-size: 3rem;
        }
        
        .about-section {
            padding: 2.5rem;
        }
        
        .section-title {
            font-size: 1.8rem;
        }
        
        .mission-grid, .domaines-grid, .team-grid {
            grid-template-columns: 1fr;
            gap: 2rem;
        }
        
        .cta-section {
            padding: 4rem 2rem;
        }
        
        .cta-title {
            font-size: 2.2rem;
        }
        
        .cta-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .btn-cta {
            width: 100%;
            max-width: 300px;
            justify-content: center;
        }
        
        .value-item {
            flex-direction: column;
            text-align: center;
            align-items: center;
        }
        
        .value-icon {
            margin: 0 auto;
        }
    }

    @media (max-width: 576px) {
        .about-hero h1 {
            font-size: 1.9rem;
        }
        
        .stats-about {
            grid-template-columns: 1fr;
        }
        
        .stat-number {
            font-size: 2.5rem;
        }
    }
</style>
@endpush

@section('content')
<div class="about-page" id="apropos">
    <div class="about-container">
        <!-- Hero Section -->
        <div class="about-hero">
            <div class="about-icon">
                <i class="fas fa-globe-africa"></i>
            </div>
            <h1>Culture Benin</h1>
            <p>
                La plateforme numérique de référence pour la préservation et la valorisation 
                du patrimoine culturel béninois. Depuis 2025, nous nous engageons à documenter, 
                protéger et promouvoir la richesse culturelle du Bénin pour les générations actuelles et futures.
            </p>
        </div>

        <!-- Notre Mission -->
        <div class="about-section">
            <h2 class="section-title">Notre Mission</h2>
            <p style="font-size: 1.2rem; line-height: 1.8; color: #555; margin-bottom: 2rem;">
                Culture Benin a pour vocation de sauvegarder la mémoire culturelle du Bénin 
                en créant une encyclopédie numérique accessible à tous. Nous œuvrons à 
                préserver l'authenticité de notre patrimoine tout en l'adaptant aux réalités du monde numérique.
            </p>
            
            <div class="mission-grid">
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="bi bi-archive"></i>
                    </div>
                    <h3>Documenter</h3>
                    <p>
                        Collecter, numériser et archiver systématiquement les éléments 
                        du patrimoine culturel béninois avant qu'ils ne disparaissent.
                    </p>
                </div>
                
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h3>Préserver</h3>
                    <p>
                        Protéger les traditions, langues, arts et savoirs ancestraux 
                        contre l'oubli et la standardisation culturelle.
                    </p>
                </div>
                
                <div class="mission-card">
                    <div class="mission-icon">
                        <i class="bi bi-megaphone"></i>
                    </div>
                    <h3>Valoriser</h3>
                    <p>
                        Faire connaître et apprécier la culture béninoise à travers 
                        le monde, en mettant en lumière sa diversité et sa singularité.
                    </p>
                </div>
            </div>
        </div>

        <!-- Notre Histoire -->
        <div class="about-section">
            <h2 class="section-title">Notre Histoire</h2>
            
            <div class="timeline">
                <div class="timeline-item">
                    <div class="timeline-year">2025</div>
                    <div class="timeline-content">
                        <h3 style="margin-bottom: 1rem; color: var(--about-primary);">Fondation</h3>
                        <p style="color: #6c757d; line-height: 1.7;">
                            Naissance de Culture Benin suite au constat de la nécessité urgente 
                            de préserver le patrimoine culturel face à la mondialisation. 
                            Une équipe de jeunes passionnés se rassemble pour créer la première 
                            plateforme numérique exhaustive dédiée à la culture béninoise.
                        </p>
                    </div>
                </div>
                
                <div class="timeline-item">
                    <div class="timeline-year">2026</div>
                    <div class="timeline-content">
                        <h3 style="margin-bottom: 1rem; color: var(--about-primary);">Expansion</h3>
                        <p style="color: #6c757d; line-height: 1.7;">
                            Lancement des premières collaborations avec les institutions culturelles, 
                            universités et communautés locales. Mise en place d'un réseau de 
                            contributeurs bénévoles à travers les 12 départements du Bénin.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Nos Domaines d'Action -->
        <div class="about-section">
            <h2 class="section-title">Nos Domaines d'Action</h2>
            <p style="font-size: 1.2rem; color: #555; margin-bottom: 2rem;">
                Culture Benin couvre l'ensemble du spectre culturel béninois à travers 
                plusieurs axes thématiques interconnectés :
            </p>
            
            <div class="domaines-grid">
                <div class="domaine-card">
                    <div class="domaine-icon">
                        <i class="bi bi-book"></i>
                    </div>
                    <h4>Patrimoine Immatériel</h4>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> Traditions orales et contes</li>
                        <li><i class="bi bi-check-circle"></i> Musiques et danses traditionnelles</li>
                        <li><i class="bi bi-check-circle"></i> Savoirs artisanaux et techniques</li>
                        <li><i class="bi bi-check-circle"></i> Pratiques rituelles et cérémonielles</li>
                    </ul>
                </div>
                
                <div class="domaine-card">
                    <div class="domaine-icon">
                        <i class="bi bi-egg-fried"></i>
                    </div>
                    <h4>Arts Culinaires</h4>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> Recettes traditionnelles</li>
                        <li><i class="bi bi-check-circle"></i> Techniques de préparation</li>
                        <li><i class="bi bi-check-circle"></i> Plats régionaux spécifiques</li>
                        <li><i class="bi bi-check-circle"></i> Valeurs nutritionnelles</li>
                    </ul>
                </div>
                
                <div class="domaine-card">
                    <div class="domaine-icon">
                        <i class="bi bi-mic"></i>
                    </div>
                    <h4>Linguistique</h4>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> Langues nationales et locales</li>
                        <li><i class="bi bi-check-circle"></i> Dialectes et variations régionales</li>
                        <li><i class="bi bi-check-circle"></i> Expressions idiomatiques</li>
                        <li><i class="bi bi-check-circle"></i> Proverbes et sagesses populaires</li>
                    </ul>
                </div>
                
                <div class="domaine-card">
                    <div class="domaine-icon">
                        <i class="bi bi-brush"></i>
                    </div>
                    <h4>Arts Visuels</h4>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> Sculptures et statuaires</li>
                        <li><i class="bi bi-check-circle"></i> Peintures corporelles</li>
                        <li><i class="bi bi-check-circle"></i> Architecture traditionnelle</li>
                        <li><i class="bi bi-check-circle"></i> Textiles et tissages</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Nos Valeurs -->
        <div class="about-section">
            <h2 class="section-title">Nos Valeurs Fondamentales</h2>
            
            <ul class="values-list">
                <li class="value-item">
                    <div class="value-icon">
                        <i class="bi bi-heart"></i>
                    </div>
                    <div class="value-content">
                        <h3>Authenticité</h3>
                        <p>
                            Nous nous engageons à présenter une représentation fidèle, 
                            précise et respectueuse de la culture béninoise, sans 
                            folklorisation ni adaptation réductrice.
                        </p>
                    </div>
                </li>
                
                <li class="value-item">
                    <div class="value-icon">
                        <i class="bi bi-people"></i>
                    </div>
                    <div class="value-content">
                        <h3>Inclusion</h3>
                        <p>
                            Toutes les communautés, toutes les régions et toutes les 
                            expressions culturelles du Bénin ont leur place dans notre projet. 
                            Nous valorisons la diversité comme une force.
                        </p>
                    </div>
                </li>
                
                <li class="value-item">
                    <div class="value-icon">
                        <i class="bi bi-lightbulb"></i>
                    </div>
                    <div class="value-content">
                        <h3>Innovation</h3>
                        <p>
                            Nous utilisons la technologie comme outil de préservation 
                            et de transmission, rendant la culture accessible et attractive 
                            pour les nouvelles générations.
                        </p>
                    </div>
                </li>
                
                <li class="value-item">
                    <div class="value-icon">
                        <i class="bi bi-share"></i>
                    </div>
                    <div class="value-content">
                        <h3>Partage</h3>
                        <p>
                            Notre mission est de partager la richesse culturelle béninoise 
                            avec le monde entier, dans un esprit d'ouverture et de générosité.
                        </p>
                    </div>
                </li>
            </ul>
        </div>

        <!-- Notre Impact -->
        <div class="about-section">
            <h2 class="section-title">Notre Impact</h2>
            
            <div class="stats-about">
                <div class="stat-about">
                    <div class="stat-number">750+</div>
                    <div class="stat-label">Contenus culturels</div>
                </div>
                
                <div class="stat-about">
                    <div class="stat-number">12</div>
                    <div class="stat-label">Régions couvertes</div>
                </div>
                
                <div class="stat-about">
                    <div class="stat-number">58</div>
                    <div class="stat-label">Langues documentées</div>
                </div>
                
                <div class="stat-about">
                    <div class="stat-number">15K+</div>
                    <div class="stat-label">Visiteurs mensuels</div>
                </div>
            </div>
        </div>

        <!-- Notre Équipe -->
        <div class="about-section">
            <h2 class="section-title">Notre Équipe</h2>
            <p style="font-size: 1.2rem; color: #555; margin-bottom: 2rem;">
                Une équipe pluridisciplinaire passionnée par la culture béninoise, 
                composée d'experts, de chercheurs et de technologues dévoués.
            </p>
            
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="member-name">Dr. Koffi Adékpété</div>
                    <div class="member-role">Anthropologue Culturel</div>
                    <p class="member-desc">
                        Expert en traditions orales et patrimoine immatériel, 
                        ancien chercheur à l'Université d'Abomey-Calavi.
                    </p>
                </div>
                
                <div class="team-member">
                    <div class="member-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="member-name">Amina Salami</div>
                    <div class="member-role">Linguiste</div>
                    <p class="member-desc">
                        Spécialiste des langues béninoises, travaille sur la 
                        préservation des langues en voie de disparition.
                    </p>
                </div>
                
                <div class="team-member">
                    <div class="member-avatar">
                        <i class="bi bi-person"></i>
                    </div>
                    <div class="member-name">Jean Kodjo</div>
                    <div class="member-role">Technologue Numérique</div>
                    <p class="member-desc">
                        Architecte de la plateforme, passionné par l'intersection 
                        entre technologie et préservation culturelle.
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="cta-section">
            <h2 class="cta-title">Rejoignez Notre Mission</h2>
            <p class="cta-text">
                Ensemble, préservons et valorisons le riche patrimoine culturel du Bénin 
                pour les générations présentes et futures. Que vous soyez passionné, 
                chercheur, étudiant ou simplement curieux, il y a une place pour vous 
                dans cette aventure culturelle.
            </p>
            <div class="cta-buttons">
                <a href="{{ route('contenus.index') }}" class="btn-cta btn-cta-primary">
                    <i class="bi bi-compass me-2"></i>Explorer la Culture
                </a>
                <a href="{{ route('contact') }}" class="btn-cta btn-cta-secondary">
                    <i class="bi bi-envelope me-2"></i>Nous Contacter
                </a>
            </div>
        </div>
    </div>
</div>
@endsection