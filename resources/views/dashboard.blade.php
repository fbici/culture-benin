@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 text-primary">
                <i class="bi bi-speedometer2 me-2"></i>Tableau de Bord Administration
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item active" aria-current="page">
                    <i class="bi bi-house-fill me-1"></i>Tableau de Bord
                </li>
            </ol>
        </div>
    </div>
@endsection

@section('styles')
<style>
    /* Styles personnalisés pour le dashboard */
    .stat-card {
        border: none;
        border-radius: 15px;
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        z-index: 2;
    }
    
    .stat-card-primary::before { background: linear-gradient(90deg, #3498db, #2c3e50); }
    .stat-card-success::before { background: linear-gradient(90deg, #2ecc71, #27ae60); }
    .stat-card-warning::before { background: linear-gradient(90deg, #f39c12, #e67e22); }
    .stat-card-danger::before { background: linear-gradient(90deg, #e74c3c, #c0392b); }
    .stat-card-info::before { background: linear-gradient(90deg, #1abc9c, #16a085); }
    .stat-card-secondary::before { background: linear-gradient(90deg, #95a5a6, #7f8c8d); }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        transition: all 0.3s ease;
    }
    
    .stat-card:hover .stat-icon {
        transform: scale(1.1) rotate(5deg);
    }
    
    .stat-number {
        font-size: 2.2rem;
        font-weight: 700;
        background: linear-gradient(45deg, #2c3e50, #34495e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-trend {
        font-size: 0.85rem;
        padding: 3px 10px;
        border-radius: 20px;
        font-weight: 500;
    }
    
    .activity-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    
    .activity-item {
        padding: 15px;
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
        margin-bottom: 5px;
        border-radius: 8px;
    }
    
    .activity-item:hover {
        background-color: #f8f9fa;
        transform: translateX(5px);
        border-left-color: #3498db;
    }
    
    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }
    
    .quick-action-card {
        border: none;
        border-radius: 15px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    }
    
    .quick-action-btn {
        border: none;
        border-radius: 10px;
        padding: 20px;
        transition: all 0.3s ease;
        background: white;
        text-align: left;
        position: relative;
        overflow: hidden;
    }
    
    .quick-action-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .quick-action-btn:hover::before {
        left: 100%;
    }
    
    .quick-action-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    
    .welcome-card {
        border: none;
        border-radius: 15px;
        background: linear-gradient(135deg, #e17000 0%, #008751 100%);
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .welcome-card::before {
        content: '';
        position: absolute;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        top: -50%;
        left: -50%;
        animation: pulse 6s infinite alternate;
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }
    
    .welcome-icon {
        font-size: 3.5rem;
        opacity: 0.8;
        margin-bottom: 20px;
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    .stats-list-item {
        padding: 12px 0;
        border-bottom: 1px solid #f1f3f4;
        transition: all 0.3s ease;
    }
    
    .stats-list-item:hover {
        background-color: #f8f9fa;
        padding-left: 10px;
    }
    
    .stats-list-item:last-child {
        border-bottom: none;
    }
    
    .stats-badge {
        min-width: 40px;
        height: 40px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }
    
    .quick-link-btn {
        border-radius: 10px;
        padding: 12px 20px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        text-align: left;
    }
    
    .quick-link-btn:hover {
        border-color: #e17000;
        background-color: rgba(225, 112, 0, 0.05);
        transform: translateX(5px);
    }
    
    /* Animations d'entrée */
    .fade-in {
        animation: fadeIn 0.5s ease-out;
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .stat-number {
            font-size: 1.8rem;
        }
        
        .quick-action-btn {
            padding: 15px;
        }
        
        .welcome-icon {
            font-size: 2.5rem;
        }
    }
</style>
@endsection

@section('content')
@php
    // Statistiques dynamiques
    $stats = [
        'langues' => \App\Models\Langue::count(),
        'contenus' => \App\Models\Contenu::count(),
        'medias' => \App\Models\Media::count(),
        'users' => \App\Models\User::count(),
        'regions' => \App\Models\Region::count(),
        'commentaires' => \App\Models\Commentaire::count(),
    ];

    // Activités récentes mélangées - SEULEMENT 4 DERNIÈRES
    $activitesRecentes = collect();
    
    // Langues récentes (sans relation user)
    $languesRecentes = \App\Models\Langue::orderBy('created_at', 'desc')
        ->take(2)
        ->get()
        ->map(function($langue) {
            return [
                'type' => 'langue',
                'icone' => 'bi-translate',
                'couleur' => 'primary',
                'description' => 'Nouvelle langue ajoutée : ' . $langue->nom_langue,
                'date' => $langue->created_at,
                'auteur' => 'Système'
            ];
        });

    // Contenus récents (sans relation user)
    $contenusRecents = \App\Models\Contenu::orderBy('created_at', 'desc')
        ->take(2)
        ->get()
        ->map(function($contenu) {
            return [
                'type' => 'contenu',
                'icone' => 'bi-file-text',
                'couleur' => 'success',
                'description' => 'Nouveau contenu : ' . Str::limit($contenu->titre, 40),
                'date' => $contenu->created_at,
                'auteur' => 'Système'
            ];
        });

    // Médias récents (sans relation user)
    $mediasRecents = \App\Models\Media::orderBy('created_at', 'desc')
        ->take(2)
        ->get()
        ->map(function($media) {
            return [
                'type' => 'media',
                'icone' => 'bi-image',
                'couleur' => 'warning',
                'description' => 'Média uploadé : ' . Str::limit($media->description, 30),
                'date' => $media->created_at,
                'auteur' => 'Système'
            ];
        });

    // Utilisateurs récents
    $usersRecents = \App\Models\User::orderBy('created_at', 'desc')
        ->take(2)
        ->get()
        ->map(function($user) {
            return [
                'type' => 'utilisateur',
                'icone' => 'bi-person',
                'couleur' => 'info',
                'description' => 'Nouvel utilisateur : ' . $user->prenom . ' ' . $user->nom,
                'date' => $user->created_at,
                'auteur' => 'Système'
            ];
        });

    // Fusionner et trier toutes les activités - PRENDRE SEULEMENT 4
    $activitesRecentes = $languesRecentes
        ->merge($contenusRecents)
        ->merge($mediasRecents)
        ->merge($usersRecents)
        ->sortByDesc('date')
        ->take(4); // CHANGÉ DE 8 À 4

    // Statistiques d'évolution (comparaison avec le mois dernier)
    $moisDernier = now()->subMonth();
    $statsEvolution = [
        'langues' => \App\Models\Langue::where('created_at', '>=', $moisDernier)->count(),
        'contenus' => \App\Models\Contenu::where('created_at', '>=', $moisDernier)->count(),
        'medias' => \App\Models\Media::where('created_at', '>=', $moisDernier)->count(),
        'users' => \App\Models\User::where('created_at', '>=', $moisDernier)->count(),
    ];
@endphp

<!-- Cartes Statistiques Améliorées -->
<div class="row mb-4 fade-in">
    <div class="col-xl-3 col-md-6 mb-4" style="animation-delay: 0.1s">
        <div class="card stat-card stat-card-primary shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2 fw-semibold">
                            <i class="bi bi-translate me-1"></i>Langues
                        </h6>
                        <div class="stat-number mb-1">{{ $stats['langues'] }}</div>
                        <div class="d-flex align-items-center">
                            @if($statsEvolution['langues'] > 0)
                                <span class="stat-trend bg-success bg-opacity-10 text-success me-2">
                                    <i class="bi bi-arrow-up me-1"></i>+{{ $statsEvolution['langues'] }}
                                </span>
                            @endif
                            <small class="text-muted">ce mois</small>
                        </div>
                    </div>
                    <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-translate"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0 pt-0">
                <a href="{{ route('admin.langues.index') }}" class="text-decoration-none text-primary fw-semibold small">
                    Voir détails <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4" style="animation-delay: 0.2s">
        <div class="card stat-card stat-card-success shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2 fw-semibold">
                            <i class="bi bi-file-text me-1"></i>Contenus
                        </h6>
                        <div class="stat-number mb-1">{{ $stats['contenus'] }}</div>
                        <div class="d-flex align-items-center">
                            @if($statsEvolution['contenus'] > 0)
                                <span class="stat-trend bg-success bg-opacity-10 text-success me-2">
                                    <i class="bi bi-arrow-up me-1"></i>+{{ $statsEvolution['contenus'] }}
                                </span>
                            @endif
                            <small class="text-muted">ce mois</small>
                        </div>
                    </div>
                    <div class="stat-icon bg-success bg-opacity-10 text-success">
                        <i class="bi bi-file-text"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0 pt-0">
                <a href="{{ route('admin.contenus.index') }}" class="text-decoration-none text-success fw-semibold small">
                    Voir détails <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4" style="animation-delay: 0.3s">
        <div class="card stat-card stat-card-warning shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2 fw-semibold">
                            <i class="bi bi-images me-1"></i>Médias
                        </h6>
                        <div class="stat-number mb-1">{{ $stats['medias'] }}</div>
                        <div class="d-flex align-items-center">
                            @if($statsEvolution['medias'] > 0)
                                <span class="stat-trend bg-success bg-opacity-10 text-success me-2">
                                    <i class="bi bi-arrow-up me-1"></i>+{{ $statsEvolution['medias'] }}
                                </span>
                            @endif
                            <small class="text-muted">ce mois</small>
                        </div>
                    </div>
                    <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                        <i class="bi bi-images"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0 pt-0">
                <a href="{{ route('admin.medias.index') }}" class="text-decoration-none text-warning fw-semibold small">
                    Voir détails <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4" style="animation-delay: 0.4s">
        <div class="card stat-card stat-card-danger shadow">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-uppercase text-muted mb-2 fw-semibold">
                            <i class="bi bi-people me-1"></i>Utilisateurs
                        </h6>
                        <div class="stat-number mb-1">{{ $stats['users'] }}</div>
                        <div class="d-flex align-items-center">
                            @if($statsEvolution['users'] > 0)
                                <span class="stat-trend bg-success bg-opacity-10 text-success me-2">
                                    <i class="bi bi-arrow-up me-1"></i>+{{ $statsEvolution['users'] }}
                                </span>
                            @endif
                            <small class="text-muted">ce mois</small>
                        </div>
                    </div>
                    <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent border-top-0 pt-0">
                <a href="{{ route('admin.users.index') }}" class="text-decoration-none text-danger fw-semibold small">
                    Voir détails <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Contenu Principal -->
<div class="row fade-in" style="animation-delay: 0.5s">
    <div class="col-lg-8">
        <!-- Activité Récente Dynamique - SEULEMENT 4 DERNIÈRES -->
        <div class="card activity-card shadow mb-4">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h5 class="m-0 fw-bold text-primary">
                    <i class="bi bi-clock-history me-2"></i>Activité Récente
                </h5>
                <span class="badge bg-primary rounded-pill">{{ $activitesRecentes->count() }} activités</span>
            </div>
            <div class="card-body p-3">
                <div class="activity-list">
                    @forelse($activitesRecentes as $activite)
                    <div class="activity-item">
                        <div class="d-flex align-items-center">
                            <div class="activity-icon bg-{{ $activite['couleur'] }} bg-opacity-10 text-{{ $activite['couleur'] }} me-3">
                                <i class="bi {{ $activite['icone'] }}"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-1 fw-semibold">{{ $activite['description'] }}</h6>
                                <small class="text-muted d-flex align-items-center">
                                    <i class="bi bi-calendar3 me-1"></i>
                                    {{ $activite['date']->format('d/m/Y à H:i') }}
                                </small>
                            </div>
                            <span class="badge bg-{{ $activite['couleur'] }} bg-opacity-10 text-{{ $activite['couleur'] }}">
                                {{ ucfirst($activite['type']) }}
                            </span>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-4 text-muted opacity-50 mb-3"></i>
                        <p class="text-muted mb-0">Aucune activité récente</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Actions Rapides -->
        <div class="card shadow">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-primary">
                    <i class="bi bi-lightning me-2"></i>Actions Rapides
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <a href="{{ url('/admin/langues/create') }}" class="btn btn-outline-primary w-100 text-start p-3">
                            <i class="bi bi-plus-circle me-2"></i>
                            <div>
                                <strong>Ajouter une Langue</strong>
                                <br>
                                <small class="text-muted">Nouvelle langue</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('/admin/contenus/create') }}" class="btn btn-outline-success w-100 text-start p-3">
                            <i class="bi bi-file-plus me-2"></i>
                            <div>
                                <strong>Créer un Contenu</strong>
                                <br>
                                <small class="text-muted">Nouveau contenu culturel</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('/admin/medias/create') }}" class="btn btn-outline-warning w-100 text-start p-3">
                            <i class="bi bi-upload me-2"></i>
                            <div>
                                <strong>Uploader un Média</strong>
                                <br>
                                <small class="text-muted">Image, vidéo ou audio</small>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ url('/admin/users/create') }}" class="btn btn-outline-info w-100 text-start p-3">
                            <i class="bi bi-person-plus me-2"></i>
                            <div>
                                <strong>Ajouter un Utilisateur</strong>
                                <br>
                                <small class="text-muted">Nouvel utilisateur</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Carte de Bienvenue Personnalisée -->
        <div class="card welcome-card shadow mb-4">
            <div class="card-body text-center p-4">
                <div class="welcome-icon">
                    <i class="bi bi-globe-americas"></i>
                </div>
                <h4 class="fw-bold mb-2">Bienvenue {{ auth()->user()->prenom ?? 'Administrateur' }} !</h4>
                <p class="mb-3 opacity-90">Plateforme de gestion du patrimoine culturel béninois</p>
                <div class="d-flex justify-content-center align-items-center">
                    <i class="bi bi-calendar3 me-2"></i>
                    <span class="opacity-90">{{ now()->translatedFormat('l d F Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Statistiques Détaillées -->
        <div class="card shadow mb-4">
            <div class="card-header bg-white py-3">
                <h5 class="m-0 fw-bold text-primary">
                    <i class="bi bi-graph-up me-2"></i>Statistiques Globales
                </h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="stats-list-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-primary bg-opacity-10 text-primary me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-translate"></i>
                            </div>
                            <span>Langues actives</span>
                        </div>
                        <span class="stats-badge bg-primary bg-opacity-10 text-primary">{{ $stats['langues'] }}</span>
                    </div>
                    <div class="stats-list-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-success bg-opacity-10 text-success me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-file-text"></i>
                            </div>
                            <span>Contenus publiés</span>
                        </div>
                        <span class="stats-badge bg-success bg-opacity-10 text-success">{{ $stats['contenus'] }}</span>
                    </div>
                    <div class="stats-list-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-warning bg-opacity-10 text-warning me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-images"></i>
                            </div>
                            <span>Médias uploadés</span>
                        </div>
                        <span class="stats-badge bg-warning bg-opacity-10 text-warning">{{ $stats['medias'] }}</span>
                    </div>
                    <div class="stats-list-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-danger bg-opacity-10 text-danger me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-people"></i>
                            </div>
                            <span>Utilisateurs actifs</span>
                        </div>
                        <span class="stats-badge bg-danger bg-opacity-10 text-danger">{{ $stats['users'] }}</span>
                    </div>
                    <div class="stats-list-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-info bg-opacity-10 text-info me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-geo-alt"></i>
                            </div>
                            <span>Régions couvertes</span>
                        </div>
                        <span class="stats-badge bg-info bg-opacity-10 text-info">{{ $stats['regions'] }}</span>
                    </div>
                    <div class="stats-list-item d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="stat-icon bg-secondary bg-opacity-10 text-secondary me-3" style="width: 40px; height: 40px;">
                                <i class="bi bi-chat-dots"></i>
                            </div>
                            <span>Commentaires</span>
                        </div>
                        <span class="stats-badge bg-secondary bg-opacity-10 text-secondary">{{ $stats['commentaires'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Animation pour les éléments
    $('.fade-in').each(function(index) {
        $(this).css('animation-delay', (index * 0.1) + 's');
    });
    
    // Animation hover pour les cartes stats
    $('.stat-card').on('mouseenter', function() {
        $(this).find('.stat-icon').css('transform', 'scale(1.1) rotate(5deg)');
    }).on('mouseleave', function() {
        $(this).find('.stat-icon').css('transform', 'scale(1) rotate(0)');
    });
    
    // Animation pour les boutons d'actions rapides
    $('.quick-action-btn').on('mouseenter', function() {
        $(this).css({
            'transform': 'translateY(-3px)',
            'box-shadow': '0 5px 15px rgba(0,0,0,0.1)'
        });
    }).on('mouseleave', function() {
        $(this).css({
            'transform': 'translateY(0)',
            'box-shadow': 'none'
        });
    });
});
</script>
@endsection