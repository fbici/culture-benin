@extends('layouts.app')

@section('title', 'Mon Profil - Culture Benin')

@section('content')
<div class="profile-container">
    <!-- Header de la page -->
    <div class="profile-header mb-5">
        <h1 class="profile-title">
            <i class="bi bi-person-circle text-primary me-3"></i>
            Mon Compte
        </h1>
        <p class="profile-subtitle">
            Gérez vos informations personnelles, votre sécurité et votre activité
        </p>
    </div>

    <div class="row">
        <!-- Colonne gauche - Avatar et navigation -->
        <div class="col-lg-3">
            <!-- Carte Avatar -->
            <div class="profile-avatar-card mb-4">
                <div class="avatar-container">
                    @if($user->avatar && Storage::exists('public/' . $user->avatar))
                        <img src="{{ Storage::url($user->avatar) }}" 
                             alt="{{ $user->prenom }}" 
                             class="profile-avatar-img">
                    @else
                        <div class="avatar-placeholder">
                            <span class="avatar-initials">
                                {{ strtoupper(substr($user->prenom, 0, 1)) }}{{ strtoupper(substr($user->nom, 0, 1)) }}
                            </span>
                        </div>
                    @endif
                    
                    <!-- Form pour changer l'avatar -->
                    <form action="{{ route('user.profile.avatar.update') }}" 
                          method="POST" 
                          enctype="multipart/form-data"
                          class="avatar-form">
                        @csrf
                        <input type="file" 
                               name="avatar" 
                               id="avatarInput" 
                               accept="image/*"
                               class="d-none">
                        <label for="avatarInput" class="avatar-upload-label">
                            <i class="bi bi-camera-fill"></i>
                            <span>Changer la photo</span>
                        </label>
                    </form>
                </div>
                
                <div class="avatar-info mt-4 text-center">
                    <h4 class="fw-bold mb-1">{{ $user->prenom }} {{ $user->nom }}</h4>
                    <p class="text-muted mb-2">
                        <i class="bi bi-envelope me-1"></i>{{ $user->email }}
                    </p>
                    <div class="member-since">
                        <i class="bi bi-calendar-check me-1"></i>
                        Membre depuis {{ $user->created_at->format('d/m/Y') }}
                    </div>
                </div>
            </div>

            <!-- Navigation verticale -->
            <div class="profile-nav-card">
                <div class="nav-section">
                    <h6 class="nav-section-title">
                        <i class="bi bi-person me-2"></i>Mon compte
                    </h6>
                    <div class="nav-links_tu">
                        <a href="#informations" 
                           class="nav-link active" 
                           onclick="showSection('informations')">
                            <i class="bi bi-person-badge me-2"></i>
                            Informations personnelles
                        </a>
                        <a href="#securite" 
                           class="nav-link" 
                           onclick="showSection('securite')">
                            <i class="bi bi-shield-lock me-2"></i>
                            Sécurité & Mot de passe
                        </a>
                    </div>
                </div>
                
                <div class="nav-section">
                    <h6 class="nav-section-title">
                        <i class="bi bi-activity me-2"></i>Activité
                    </h6>
                    <div class="nav-links">
                        <a href="#activite" 
                           class="nav-link" 
                           onclick="showSection('activite')">
                            <i class="bi bi-clock-history me-2"></i>
                            Historique d'activité
                        </a>
                        <a href="#statistiques" 
                           class="nav-link" 
                           onclick="showSection('statistiques')">
                            <i class="bi bi-bar-chart me-2"></i>
                            Mes statistiques
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Colonne droite - Contenu -->
        <div class="col-lg-9">
            <!-- Messages d'alerte -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger mb-4">
                    <i class="bi bi-exclamation-triangle-fill me-2"></i>
                    <strong>Veuillez corriger les erreurs suivantes :</strong>
                    <ul class="mb-0 mt-2">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Section 1: Informations personnelles (Visible par défaut) -->
            <div class="profile-section-card active" id="informations-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="bi bi-person-badge text-primary me-2"></i>
                        Informations personnelles
                    </h3>
                    <p class="section-subtitle">
                        Mettez à jour vos informations de contact et votre profil
                    </p>
                </div>
                
                <form method="POST" action="{{ route('user.profile.update') }}" class="mt-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="prenom" class="form-label fw-semibold">
                                <i class="bi bi-person me-1"></i>Prénom
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('prenom') is-invalid @enderror" 
                                   id="prenom" 
                                   name="prenom" 
                                   value="{{ old('prenom', $user->prenom) }}" 
                                   required>
                            @error('prenom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6">
                            <label for="nom" class="form-label fw-semibold">
                                <i class="bi bi-person me-1"></i>Nom
                            </label>
                            <input type="text" 
                                   class="form-control form-control-lg @error('nom') is-invalid @enderror" 
                                   id="nom" 
                                   name="nom" 
                                   value="{{ old('nom', $user->nom) }}" 
                                   required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <label for="email" class="form-label fw-semibold">
                            <i class="bi bi-envelope me-1"></i>Adresse email
                        </label>
                        <input type="email" 
                               class="form-control form-control-lg @error('email') is-invalid @enderror" 
                               id="email" 
                               name="email" 
                               value="{{ old('email', $user->email) }}" 
                               required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="section-footer mt-4">
                        <button type="submit" class="btn btn-primary btn-lg px-4">
                            <i class="bi bi-save me-2"></i>
                            Enregistrer les modifications
                        </button>
                        <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary btn-lg">
                            <i class="bi bi-arrow-left me-2"></i>
                            Retour au tableau de bord
                        </a>
                    </div>
                </form>
            </div>

            <!-- Section 2: Sécurité et mot de passe -->
            <div class="profile-section-card" id="securite-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="bi bi-shield-lock text-warning me-2"></i>
                        Sécurité & Mot de passe
                    </h3>
                    <p class="section-subtitle">
                        Changez votre mot de passe pour sécuriser votre compte
                    </p>
                </div>
                
                <form method="POST" action="{{ route('user.profile.password.update') }}" class="mt-4">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="current_password" class="form-label fw-semibold">
                            <i class="bi bi-lock me-1"></i>Mot de passe actuel
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control form-control-lg @error('current_password') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password" 
                                   required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')">
                                <i class="bi bi-eye"></i>
                            </button>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="new_password" class="form-label fw-semibold">
                            <i class="bi bi-key me-1"></i>Nouveau mot de passe
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control form-control-lg @error('new_password') is-invalid @enderror" 
                                   id="new_password" 
                                   name="new_password" 
                                   required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password')">
                                <i class="bi bi-eye"></i>
                            </button>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Minimum 8 caractères avec majuscules, minuscules et chiffres
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="new_password_confirmation" class="form-label fw-semibold">
                            <i class="bi bi-key-fill me-1"></i>Confirmer le mot de passe
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                   class="form-control form-control-lg" 
                                   id="new_password_confirmation" 
                                   name="new_password_confirmation" 
                                   required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('new_password_confirmation')">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="section-footer mt-4">
                        <button type="submit" class="btn btn-warning btn-lg px-4">
                            <i class="bi bi-shield-check me-2"></i>
                            Mettre à jour le mot de passe
                        </button>
                    </div>
                </form>
            </div>

            <!-- Section 3: Historique d'activité -->
            <div class="profile-section-card" id="activite-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="bi bi-clock-history text-info me-2"></i>
                        Historique d'activité
                    </h3>
                    <p class="section-subtitle">
                        Vos dernières actions sur la plateforme
                    </p>
                </div>
                
                @if($user->contenus->count() > 0 || $user->medias->count() > 0)
                    <div class="activity-timeline">
                        <!-- Contenus créés -->
                        @foreach($user->contenus->take(10)->sortByDesc('created_at') as $contenu)
                        <div class="activity-item">
                            <div class="activity-icon bg-primary">
                                <i class="bi bi-file-text"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="mb-1">Vous avez créé un contenu</h6>
                                <p class="mb-1 fw-semibold">{{ $contenu->titre }}</p>
                                <p class="text-muted mb-2">{{ Str::limit(strip_tags($contenu->texte), 100) }}</p>
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $contenu->created_at->format('d/m/Y à H:i') }}
                                </small>
                            </div>
                        </div>
                        @endforeach
                        
                        <!-- Médias uploadés -->
                        @foreach($user->medias->take(10)->sortByDesc('created_at') as $media)
                        <div class="activity-item">
                            <div class="activity-icon bg-success">
                                <i class="bi bi-image"></i>
                            </div>
                            <div class="activity-content">
                                <h6 class="mb-1">Vous avez uploadé un média</h6>
                                <p class="mb-1 fw-semibold">{{ $media->description }}</p>
                                <p class="text-muted mb-2">Type : {{ $media->typeMedia->nom ?? 'Inconnu' }}</p>
                                <small class="text-muted">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $media->created_at->format('d/m/Y à H:i') }}
                                </small>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    @if($user->contenus->count() == 0 && $user->medias->count() == 0)
                    <div class="empty-state text-center py-5">
                        <i class="bi bi-clock display-4 text-muted opacity-50 mb-3"></i>
                        <h5 class="fw-semibold mb-2">Aucune activité récente</h5>
                        <p class="text-muted mb-4">Commencez à créer du contenu pour voir votre activité ici</p>
                        <a href="{{ route('user.contenus.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            Créer un contenu
                        </a>
                    </div>
                    @endif
                @else
                    <div class="empty-state text-center py-5">
                        <i class="bi bi-clock display-4 text-muted opacity-50 mb-3"></i>
                        <h5 class="fw-semibold mb-2">Aucune activité récente</h5>
                        <p class="text-muted mb-4">Commencez à créer du contenu pour voir votre activité ici</p>
                        <a href="{{ route('user.contenus.create') }}" class="btn btn-primary">
                            <i class="bi bi-plus-circle me-2"></i>
                            Créer un contenu
                        </a>
                    </div>
                @endif
            </div>

            <!-- Section 4: Statistiques -->
            <div class="profile-section-card" id="statistiques-section">
                <div class="section-header">
                    <h3 class="section-title">
                        <i class="bi bi-bar-chart text-success me-2"></i>
                        Mes statistiques
                    </h3>
                    <p class="section-subtitle">
                        Aperçu de votre activité sur la plateforme
                    </p>
                </div>
                
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon bg-primary">
                                <i class="bi bi-file-text"></i>
                            </div>
                            <div class="stat-content">
                                <h4 class="stat-number">{{ $user->contenus->count() ?? 0 }}</h4>
                                <p class="stat-label">Contenus créés</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="stat-card">
                            <div class="stat-icon bg-success">
                                <i class="bi bi-images"></i>
                            </div>
                            <div class="stat-content">
                                <h4 class="stat-number">{{ $user->medias->count() ?? 0 }}</h4>
                                <p class="stat-label">Médias uploadés</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4">
                    <h5 class="fw-semibold mb-3">Détails par type</h5>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="detail-item">
                                <span class="detail-label">Contenus publiés :</span>
                                <span class="detail-value">{{ $user->contenus->where('statut', 'publié')->count() }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Contenus en attente :</span>
                                <span class="detail-value">{{ $user->contenus->where('statut', 'en_attente')->count() }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="detail-item">
                                <span class="detail-label">Médias images :</span>
                                <span class="detail-value">{{ $user->medias->where('typeMedia.nom', 'Image')->count() }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Médias vidéos :</span>
                                <span class="detail-value">{{ $user->medias->where('typeMedia.nom', 'Vidéo')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styles principaux */
    .profile-container {
        max-width: 1400px;
        margin: 100px auto 40px;
        padding: 0 1.5rem;
    }

    .profile-header {
        margin-bottom: 2rem;
    }

    .profile-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: #1a1d21;
        margin-bottom: 0.5rem;
    }

    .profile-subtitle {
        font-size: 1.1rem;
        color: #6c757d;
        margin: 0;
    }

    /* Carte Avatar */
    .profile-avatar-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        text-align: center;
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .avatar-container {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto;
    }

    .profile-avatar-img {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid white;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .avatar-placeholder {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, #e17000 0%, #ff8c00 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        border: 4px solid white;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .avatar-initials {
        font-size: 3rem;
        font-weight: 800;
        color: white;
    }

    .avatar-upload-label {
        position: absolute;
        bottom: 10px;
        right: 10px;
        background: #0d6efd;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 25px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        font-weight: 600;
        transition: all 0.3s ease;
        border: 3px solid white;
        box-shadow: 0 4px 15px rgba(13, 110, 253, 0.3);
    }

    .avatar-upload-label:hover {
        background: #0b5ed7;
        transform: translateY(-2px);
    }

    .member-since {
        background: #f8f9fa;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        color: #6c757d;
        display: inline-block;
    }

    /* Navigation*/
    .profile-nav-card {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .nav-section {
        margin-bottom: 1.5rem;
    }

    .nav-section:last-child {
        margin-bottom: 0;
    }

    .nav-section-title {
        font-size: 1rem;
        font-weight: 700;
        color: #495057;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #f8f9fa;
    }

    .nav-links_tu {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .nav-link {
        padding: 0.8rem 1rem;
        border-radius: 10px;
        color: #495057;
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        display: flex;
        align-items: center;
    }

    .nav-link:hover,
    .nav-link.active {
        background: linear-gradient(135deg, rgba(225, 112, 0, 0.1) 0%, rgba(255, 140, 0, 0.1) 100%);
        color: #e17000;
        border-color: #e17000;
        transform: translateX(5px);
    }

    /* Sections de contenu */
    .profile-section-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        margin-bottom: 1.5rem;
        display: none;
        animation: fadeIn 0.5s ease;
    }

    .profile-section-card.active {
        display: block;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .section-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 2px solid #f8f9fa;
    }

    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1a1d21;
        margin-bottom: 0.5rem;
    }

    .section-subtitle {
        color: #6c757d;
        margin: 0;
        font-size: 1rem;
    }

    .section-footer {
        padding-top: 1.5rem;
        border-top: 2px solid #f8f9fa;
        display: flex;
        gap: 1rem;
    }

    /* Activity Timeline */
    .activity-timeline {
        position: relative;
        padding-left: 40px;
    }

    .activity-timeline::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, #0d6efd, #20c997);
        border-radius: 3px;
    }

    .activity-item {
        position: relative;
        margin-bottom: 2rem;
        display: flex;
        gap: 1rem;
    }

    .activity-icon {
        position: absolute;
        left: -40px;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1rem;
        z-index: 2;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }

    .activity-content {
        flex: 1;
        background: #f8f9fa;
        padding: 1.5rem;
        border-radius: 12px;
        border-left: 4px solid #0d6efd;
    }

    /* Stat Cards */
    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }

    .stat-content {
        flex: 1;
    }

    .stat-number {
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0;
        line-height: 1;
        color: #1a1d21;
    }

    .stat-label {
        color: #6c757d;
        margin: 0.5rem 0 0;
        font-size: 0.9rem;
    }

    /* Detail Items */
    .detail-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.8rem 0;
        border-bottom: 1px solid #f1f3f5;
    }

    .detail-item:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: #495057;
        font-weight: 500;
    }

    .detail-value {
        font-weight: 700;
        color: #e17000;
        font-size: 1.1rem;
    }

    /* Empty State */
    .empty-state {
        padding: 3rem 2rem;
    }

    /* Form Styles */
    .form-control-lg {
        padding: 0.8rem 1rem;
        font-size: 1rem;
        border: 2px solid #e9ecef;
        transition: all 0.3s ease;
    }

    .form-control-lg:focus {
        border-color: #e17000;
        box-shadow: 0 0 0 3px rgba(225, 112, 0, 0.15);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-container {
            padding: 0 1rem;
            margin-top: 80px;
        }

        .profile-title {
            font-size: 1.8rem;
        }

        .avatar-container {
            width: 120px;
            height: 120px;
        }

        .avatar-initials {
            font-size: 2.5rem;
        }

        .activity-timeline {
            padding-left: 30px;
        }

        .activity-icon {
            left: -30px;
            width: 30px;
            height: 30px;
            font-size: 0.9rem;
        }

        .stat-card {
            flex-direction: column;
            text-align: center;
            padding: 1rem;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            font-size: 1.2rem;
        }

        .stat-number {
            font-size: 1.8rem;
        }

        .section-footer {
            flex-direction: column;
        }
    }

    @media (max-width: 576px) {
        .profile-avatar-card,
        .profile-nav-card,
        .profile-section-card {
            padding: 1.5rem;
        }

        .section-title {
            font-size: 1.3rem;
        }
    }
</style>

<script>
    // Fonction pour afficher/masquer les sections
    function showSection(sectionId) {
        // Masquer toutes les sections
        document.querySelectorAll('.profile-section-card').forEach(section => {
            section.classList.remove('active');
        });
        
        // Afficher la section sélectionnée
        const targetSection = document.getElementById(sectionId + '-section');
        if (targetSection) {
            targetSection.classList.add('active');
        }
        
        // Mettre à jour la navigation active
        document.querySelectorAll('.nav-link').forEach(link => {
            link.classList.remove('active');
            if (link.getAttribute('href') === '#' + sectionId) {
                link.classList.add('active');
            }
        });
        
        // Mettre à jour l'URL sans recharger la page
        history.pushState(null, null, '#' + sectionId);
        
        // Scroll vers le haut de la section
        window.scrollTo({
            top: targetSection.offsetTop - 120,
            behavior: 'smooth'
        });
    }

    // Fonction pour basculer la visibilité du mot de passe
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const button = input.nextElementSibling;
        const icon = button.querySelector('i');
        
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }

    // Auto-submit du formulaire d'avatar
    document.getElementById('avatarInput')?.addEventListener('change', function() {
        this.closest('form').submit();
    });

    // Gérer le hash de l'URL au chargement
    document.addEventListener('DOMContentLoaded', function() {
        // Vérifier si un hash est présent dans l'URL
        const hash = window.location.hash.substring(1);
        if (hash && ['informations', 'securite', 'activite', 'statistiques'].includes(hash)) {
            showSection(hash);
        }
        
        // Gérer le clic sur les liens de navigation
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetSection = this.getAttribute('href').substring(1);
                showSection(targetSection);
            });
        });
    });
</script>
@endsection