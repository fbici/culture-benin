@extends('layouts.app')

@section('title', $contenu->titre . ' - Culture Benin')

@section('content')
<div class="contenu-show-premium">
    <!-- Navigation améliorée -->
    <nav class="breadcrumb-premium mb-5">
        <div class="container">
            <ol class="breadcrumb-inner">
                <li class="breadcrumb-item">
                    <a href="{{ route('contenus.index') }}" class="breadcrumb-link">
                        <i class="bi bi-arrow-left me-2"></i>
                        Retour aux contenus
                    </a>
                </li>
                <li class="breadcrumb-item">
                    <span class="breadcrumb-current">
                        <i class="bi bi-journal-text me-2"></i>
                        {{ Str::limit($contenu->titre, 40) }}
                    </span>
                </li>
            </ol>
        </div>
    </nav>

    <div class="container">
        <div class="row g-5">
            <!-- Colonne principale -->
            <div class="col-lg-8">
                <!-- Header Premium -->
                <div class="contenu-header-premium mb-5">
                    <div class="header-badges-premium mb-4">
                        @php
                            $typeColors = [
                                'Article' => '#4361ee',
                                'Vidéo' => '#f72585',
                                'Audio' => '#7209b7',
                                'Image' => '#4cc9f0',
                                'Document' => '#f8961e',
                                'Livre' => '#43aa8b'
                            ];
                            
                            $typeColor = $typeColors[$contenu->typeContenu->nom_type ?? 'Article'] ?? '#4361ee';
                        @endphp
                        
                        <span class="badge-type-premium" style="--type-color: {{ $typeColor }}">
                            <i class="bi bi-tag-fill me-2"></i>
                            {{ $contenu->typeContenu->nom_type ?? 'Article' }}
                        </span>
                        
                        <span class="badge-region-premium">
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            {{ $contenu->region->nom_region ?? 'Bénin' }}
                        </span>
                        
                        <span class="badge-langue-premium">
                            <i class="bi bi-translate me-2"></i>
                            {{ $contenu->langue->nom_langue ?? 'Français' }}
                        </span>
                    </div>
                    
                    <h1 class="contenu-title-premium">
                        {{ $contenu->titre }}
                        <div class="title-decoration"></div>
                    </h1>
                    
                    <!-- Métadonnées Premium -->
                    <div class="metadata-premium-grid">
                        <div class="metadata-card-premium">
                            <div class="metadata-icon-premium author">
                                <i class="bi bi-person-circle-fill"></i>
                            </div>
                            <div class="metadata-content-premium">
                                <div class="metadata-label-premium">Auteur</div>
                                <div class="metadata-value-premium">
                                    {{ $contenu->auteur->prenom ?? 'Anonyme' }} {{ $contenu->auteur->nom ?? '' }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="metadata-card-premium">
                            <div class="metadata-icon-premium date">
                                <i class="bi bi-calendar2-check-fill"></i>
                            </div>
                            <div class="metadata-content-premium">
                                <div class="metadata-label-premium">Publié le</div>
                                <div class="metadata-value-premium">
                                    {{ $contenu->created_at->format('d/m/Y') }}
                                    <small class="text-muted">à {{ $contenu->created_at->format('H:i') }}</small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="metadata-card-premium">
                            <div class="metadata-icon-premium views">
                                <i class="bi bi-eye-fill"></i>
                            </div>
                            <div class="metadata-content-premium">
                                <div class="metadata-label-premium">Vues</div>
                                <div class="metadata-value-premium">
                                    <span class="views-count">{{ $contenu->views ?? 0 }}</span>
                                    <small class="views-trend text-success">
                                        <i class="bi bi-arrow-up-right"></i> +12%
                                    </small>
                                </div>
                            </div>
                        </div>
                        
                        <div class="metadata-card-premium">
                            <div class="metadata-icon-premium status">
                                @php
                                    $statusConfig = [
                                        'publié' => ['icon' => 'bi-check-circle-fill', 'color' => '#10b981'],
                                        'en_attente' => ['icon' => 'bi-clock-fill', 'color' => '#f59e0b'],
                                        'brouillon' => ['icon' => 'bi-pencil-fill', 'color' => '#6b7280']
                                    ];
                                    $status = $statusConfig[$contenu->statut] ?? $statusConfig['publié'];
                                @endphp
                                <i class="bi {{ $status['icon'] }}"></i>
                            </div>
                            <div class="metadata-content-premium">
                                <div class="metadata-label-premium">Statut</div>
                                <div class="metadata-value-premium">
                                    <span class="status-badge" style="background: {{ $status['color'] }}20; color: {{ $status['color'] }};">
                                        {{ ucfirst($contenu->statut) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contenu Principal -->
                <div class="contenu-body-premium">
                    <!-- Aperçu Gratuit -->
                    <div class="preview-section-premium">
                        <div class="section-header-premium">
                            <h3>
                                <i class="bi bi-eye-fill me-2"></i>
                                Aperçu gratuit
                                <span class="section-badge">Premier 500 mots</span>
                            </h3>
                        </div>
                        
                        <div class="preview-content-premium">
                            @php
                                $texte_complet = strip_tags($contenu->texte);
                                $preview_length = 500;
                                $texte_preview = Str::limit($texte_complet, $preview_length);
                            @endphp
                            
                            {!! nl2br(e($texte_preview)) !!}
                            
                            <div class="preview-stats">
                                <span class="stat-item">
                                    <i class="bi bi-text-left"></i>
                                    {{ Str::wordCount($texte_preview) }} mots
                                </span>
                                <span class="stat-item">
                                    <i class="bi bi-clock"></i>
                                    ~{{ ceil(Str::wordCount($texte_preview) / 200) }} min
                                </span>
                            </div>
                        </div>
                    </div>

                    @if(strlen($texte_complet) > $preview_length)
                        <!-- Section Verrouillée -->
                        <div class="locked-section-premium">
                            <div class="locked-header">
                                <div class="lock-icon-premium">
                                    <i class="bi bi-lock-fill"></i>
                                    <div class="lock-shine"></div>
                                </div>
                                <h4>Contenu Premium</h4>
                                <p class="locked-subtitle">
                                    Débloquez la suite pour découvrir toute la richesse de ce contenu
                                </p>
                            </div>
                            
                            @auth
                                @if(!$hasAccess)
                                    <!-- Box Paiement Premium -->
                                    <div class="payment-box-premium">
                                        <div class="pricing-card-premium">
                                            <div class="pricing-header">
                                                <div class="price-display-premium">
                                                    <span class="price-amount">100</span>
                                                    <span class="price-currency">FCFA</span>
                                                </div>
                                                <div class="pricing-badge">
                                                    <i class="bi bi-lightning-fill"></i>
                                                    Accès instantané
                                                </div>
                                            </div>
                                            
                                            <div class="pricing-features">
                                                <h5>Ce que vous obtenez :</h5>
                                                <ul class="features-list">
                                                    <li>
                                                        <i class="bi bi-check-circle-fill text-success"></i>
                                                        <span>Accès complet au contenu</span>
                                                    </li>
                                                    <li>
                                                        <i class="bi bi-check-circle-fill text-success"></i>
                                                        <span>Accès à vie au contenu</span>
                                                    </li>
                                                    <li>
                                                        <i class="bi bi-check-circle-fill text-success"></i>
                                                        <span>Téléchargement PDF</span>
                                                    </li>
                                                    <li>
                                                        <i class="bi bi-check-circle-fill text-success"></i>
                                                        <span>Support premium</span>
                                                    </li>
                                                </ul>
                                            </div>
                                            
                                            <button class="btn-pay-premium" id="payButton">
                                                <i class="bi bi-credit-card-fill me-2"></i>
                                                Déverrouiller maintenant
                                                <div class="btn-sparkle"></div>
                                            </button>
                                            
                                            <div class="security-premium">
                                                <i class="bi bi-shield-check"></i>
                                                <span>Paiement 100% sécurisé via FEDAPAY</span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <!-- Contenu Déverrouillé -->
                                    <div class="unlocked-section-premium">
                                        <div class="unlocked-header">
                                            <div class="access-badge-premium">
                                                <i class="bi bi-unlock-fill me-2"></i>
                                                Contenu déverrouillé
                                                <div class="badge-glow"></div>
                                            </div>
                                            <p class="access-message">
                                                Vous avez accès à l'intégralité de ce contenu premium
                                            </p>
                                        </div>
                                        
                                        <div class="content-divider">
                                            <span class="divider-text">Suite du contenu</span>
                                        </div>
                                        
                                        <div class="full-content-premium">
                                            {!! nl2br(e(Str::substr($texte_complet, $preview_length))) !!}
                                        </div>
                                    </div>
                                @endif
                            @else
                                <!-- Requête d'authentification -->
                                <div class="auth-required-premium">
                                    <div class="auth-card">
                                        <i class="bi bi-person-check-fill auth-icon"></i>
                                        <h5>Accès réservé</h5>
                                        <p>Connectez-vous pour accéder à ce contenu premium</p>
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
                    @else
                        <!-- Contenu Complet (si pas de verrouillage) -->
                        <div class="full-content-premium">
                            {!! nl2br(e($texte_complet)) !!}
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Sidebar Premium -->
            <div class="col-lg-4">
                <!-- Carte Auteur Premium -->
                <div class="sidebar-card-premium mb-4">
                    <div class="card-header-premium">
                        <h4>
                            <i class="bi bi-person-badge-fill me-2"></i>
                            L'Auteur
                        </h4>
                    </div>
                    <div class="author-card-premium">
                        <div class="author-avatar-premium">
                            {{ strtoupper(substr($contenu->auteur->prenom ?? 'A', 0, 1)) }}{{ strtoupper(substr($contenu->auteur->nom ?? '', 0, 1)) }}
                            <div class="avatar-status"></div>
                        </div>
                        <div class="author-info-premium">
                            <h5>{{ $contenu->auteur->prenom ?? 'Anonyme' }} {{ $contenu->auteur->nom ?? '' }}</h5>
                            <p class="author-title">Contributeur Culture Benin</p>
                            <div class="author-rating">
                                <div class="stars">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-half"></i>
                                </div>
                                <span class="rating-text">4.5/5</span>
                            </div>
                        </div>
                        <div class="author-stats-premium">
                            @php
                                $typeContenu = $contenu->typeContenu->nom_type ?? 'Article';
                                $countMethod = strtolower($typeContenu) . '_count';
                                $count = $contenu->auteur->{$countMethod} ?? $contenu->auteur->contenus_count ?? 0;
                            @endphp
                            <div class="stat-item-premium">
                                <div class="stat-number">{{ $count }}</div>
                                <div class="stat-label">{{ $typeContenu }}s publiés</div>
                            </div>
                            <div class="stat-divider"></div>
                            <div class="stat-item-premium">
                                <div class="stat-number">{{ rand(100, 1000) }}</div>
                                <div class="stat-label">Lecteurs</div>
                            </div>
                        </div>
                        <button class="btn-follow-author">
                            <i class="bi bi-plus-circle me-2"></i>
                            Suivre l'auteur
                        </button>
                    </div>
                </div>
                
                <!-- Actions Premium -->
                <div class="sidebar-card-premium mb-4">
                    <div class="card-header-premium">
                        <h4>
                            <i class="bi bi-lightning-charge-fill me-2"></i>
                            Actions
                        </h4>
                    </div>
                    <div class="actions-grid-premium">
                        <button class="action-btn-premium print" onclick="window.print()">
                            <div class="action-icon">
                                <i class="bi bi-printer-fill"></i>
                            </div>
                            <span>Imprimer</span>
                        </button>
                        
                        <button class="action-btn-premium share" onclick="shareContent()">
                            <div class="action-icon">
                                <i class="bi bi-share-fill"></i>
                            </div>
                            <span>Partager</span>
                        </button>
                        
                        <button class="action-btn-premium bookmark" onclick="addToBookmarks()">
                            <div class="action-icon">
                                <i class="bi bi-bookmark-fill"></i>
                            </div>
                            <span>Sauvegarder</span>
                        </button>
                        
                        <button class="action-btn-premium download">
                            <div class="action-icon">
                                <i class="bi bi-download"></i>
                            </div>
                            <span>Télécharger</span>
                        </button>
                    </div>
                </div>
                
                <!-- Métriques Premium -->
                <div class="sidebar-card-premium">
                    <div class="card-header-premium">
                        <h4>
                            <i class="bi bi-graph-up-arrow me-2"></i>
                            Métriques
                        </h4>
                    </div>
                    <div class="metrics-grid-premium">
                        <div class="metric-item-premium">
                            <div class="metric-icon complexity">
                                <i class="bi bi-bar-chart-fill"></i>
                            </div>
                            <div class="metric-content">
                                <div class="metric-label">Complexité</div>
                                <div class="metric-value">Moyenne</div>
                                <div class="progress-metric">
                                    <div class="progress-bar" style="width: 65%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="metric-item-premium">
                            <div class="metric-icon time">
                                <i class="bi bi-clock-history"></i>
                            </div>
                            <div class="metric-content">
                                <div class="metric-label">Temps de lecture</div>
                                <div class="metric-value">{{ ceil(strlen(strip_tags($contenu->texte)) / 1200) }} min</div>
                                <div class="progress-metric">
                                    <div class="progress-bar" style="width: 75%"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="metric-item-premium">
                            <div class="metric-icon engagement">
                                <i class="bi bi-heart-fill"></i>
                            </div>
                            <div class="metric-content">
                                <div class="metric-label">Engagement</div>
                                <div class="metric-value">Élevé</div>
                                <div class="progress-metric">
                                    <div class="progress-bar" style="width: 85%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Suggestions Premium -->
                <div class="sidebar-card-premium mt-4">
                    <div class="card-header-premium">
                        <h4>
                            <i class="bi bi-stars me-2"></i>
                            Suggestions
                        </h4>
                    </div>
                    <div class="suggestions-premium">
                        <div class="suggestion-item">
                            <div class="suggestion-badge">Populaire</div>
                            <h6>Artisanat béninois traditionnel</h6>
                            <p class="small text-muted">Culture • 5 min de lecture</p>
                        </div>
                        <div class="suggestion-item">
                            <div class="suggestion-badge new">Nouveau</div>
                            <h6>Musique traditionnelle Fon</h6>
                            <p class="small text-muted">Audio • 8 min d'écoute</p>
                        </div>
                        <div class="suggestion-item">
                            <div class="suggestion-badge trending">Tendance</div>
                            <h6>Histoire du royaume de Dahomey</h6>
                            <p class="small text-muted">Documentaire • 12 min</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@auth
<script>
document.addEventListener('DOMContentLoaded', function() {
    const payButton = document.getElementById('payButton');
    
    if (payButton) {
        payButton.addEventListener('click', function() {
            // Afficher le loader
            const originalText = payButton.innerHTML;
            payButton.innerHTML = '<i class="bi bi-hourglass-split me-2"></i> Traitement...';
            payButton.disabled = true;
            
            // Envoyer la requête
            // Dans show.blade.php (contenu)
            // Dans show.blade.php (contenu)
            // Récupérer le token CSRF depuis la meta tag
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{ route("contenu.payment.initiate") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    contenu_id: {{ $contenu->id_contenu }}
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.payment_url) {
                    window.location.href = data.payment_url;
                } else {
                    alert(data.message || 'Erreur lors de l\'initialisation du paiement');
                    payButton.innerHTML = originalText;
                    payButton.disabled = false;
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur réseau est survenue');
                payButton.innerHTML = originalText;
                payButton.disabled = false;
            });
        });
    }
    
    // Animation du compteur de vues
    const viewsCount = document.querySelector('.views-count');
    if (viewsCount) {
        let currentViews = parseInt(viewsCount.textContent);
        const increment = Math.ceil(currentViews * 0.1);
        let animatedValue = currentViews - increment;
        
        const timer = setInterval(() => {
            animatedValue += Math.ceil(increment / 20);
            if (animatedValue >= currentViews) {
                viewsCount.textContent = currentViews;
                clearInterval(timer);
            } else {
                viewsCount.textContent = animatedValue;
            }
        }, 50);
    }
});

// Fonctions utilitaires
function shareContent() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $contenu->titre }}',
            text: 'Découvrez ce contenu premium sur Culture Benin',
            url: window.location.href,
        });
    } else {
        navigator.clipboard.writeText(window.location.href)
            .then(() => showNotification('Lien copié dans le presse-papier !'))
            .catch(() => showNotification('Impossible de copier le lien'));
    }
}

function addToBookmarks() {
    fetch('{{ route("contenus.bookmark", $contenu->id_contenu) }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Article ajouté à vos favoris !');
        }
    });
}

function showNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification-premium';
    notification.innerHTML = `
        <i class="bi bi-check-circle-fill"></i>
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
</script>
@endauth

<style>
    /* ===== STYLES PREMIUM POUR SHOW CONTENU ===== */
    .contenu-show-premium {
        min-height: 100vh;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 100px 0 60px;
    }
    
    /* Navigation Premium */
    .breadcrumb-premium {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        padding: 1rem 0;
        margin-bottom: 3rem;
        box-shadow: 0 4px 20px rgba(30, 60, 114, 0.2);
    }
    
    .breadcrumb-inner {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin: 0;
        padding: 0;
        list-style: none;
    }
    
    .breadcrumb-link {
        color: rgba(255, 255, 255, 0.9);
        text-decoration: none;
        display: flex;
        align-items: center;
        font-weight: 600;
        padding: 0.5rem 1rem;
        border-radius: 8px;
        background: rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
    }
    
    .breadcrumb-link:hover {
        background: rgba(255, 255, 255, 0.2);
        color: white;
        transform: translateX(-5px);
    }
    
    .breadcrumb-current {
        color: white;
        font-weight: 600;
        display: flex;
        align-items: center;
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 8px;
    }
    
    /* Header Premium */
    .contenu-header-premium {
        background: white;
        border-radius: 24px;
        padding: 2.5rem;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        margin-bottom: 3rem;
        position: relative;
        overflow: hidden;
    }
    
    .header-badges-premium {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .badge-type-premium,
    .badge-region-premium,
    .badge-langue-premium {
        padding: 0.5rem 1.2rem;
        border-radius: 25px;
        font-weight: 700;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        position: relative;
        overflow: hidden;
    }
    
    .badge-type-premium {
        background: var(--type-color, #4361ee);
        color: white;
    }
    
    .badge-region-premium {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
    }
    
    .badge-langue-premium {
        background: linear-gradient(135deg, #8b5cf6, #a78bfa);
        color: white;
    }
    
    .contenu-title-premium {
        font-size: 2.8rem;
        font-weight: 900;
        color: #1a202c;
        margin-bottom: 2rem;
        line-height: 1.2;
        position: relative;
        padding-bottom: 1.5rem;
    }
    
    .title-decoration {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100px;
        height: 4px;
        background: linear-gradient(90deg, #ff8c00, #ff6b35);
        border-radius: 2px;
    }
    
    /* Métadonnées Grid Premium */
    .metadata-premium-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
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
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .metadata-card-premium:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        border-color: rgba(255, 140, 0, 0.2);
    }
    
    .metadata-icon-premium {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
    }
    
    .metadata-icon-premium.author { background: linear-gradient(135deg, #3b82f6, #60a5fa); }
    .metadata-icon-premium.date { background: linear-gradient(135deg, #10b981, #34d399); }
    .metadata-icon-premium.views { background: linear-gradient(135deg, #f59e0b, #fbbf24); }
    .metadata-icon-premium.status { background: linear-gradient(135deg, #8b5cf6, #a78bfa); }
    
    .metadata-content-premium {
        flex: 1;
    }
    
    .metadata-label-premium {
        font-size: 0.8rem;
        color: #6b7280;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.3rem;
    }
    
    .metadata-value-premium {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
    }
    
    .views-count {
        font-size: 1.5rem;
        color: #f59e0b;
    }
    
    .views-trend {
        font-size: 0.85rem;
        margin-left: 0.5rem;
    }
    
    .status-badge {
        display: inline-block;
        padding: 0.3rem 0.8rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
    }
    
    /* Contenu Principal Premium */
    .contenu-body-premium {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
    }
    
    .preview-section-premium {
        padding: 2.5rem;
    }
    
    .section-header-premium {
        border-bottom: 2px solid #e5e7eb;
        padding-bottom: 1.5rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 1rem;
    }
    
    .section-header-premium h3 {
        color: #1f2937;
        font-weight: 800;
        margin: 0;
        display: flex;
        align-items: center;
    }
    
    .section-badge {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
        padding: 0.3rem 0.8rem;
        border-radius: 15px;
        font-size: 0.8rem;
        font-weight: 700;
        margin-left: 1rem;
    }
    
    .preview-content-premium {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #374151;
        margin-bottom: 2rem;
    }
    
    .preview-content-premium p {
        margin-bottom: 1.5rem;
    }
    
    .preview-stats {
        display: flex;
        gap: 2rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-weight: 600;
    }
    
    /* Section Verrouillée Premium */
    .locked-section-premium {
        background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
        border-top: 2px solid #f59e0b;
        padding: 3rem 2.5rem;
        position: relative;
    }
    
    .locked-header {
        text-align: center;
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
        animation: lockPulse 2s infinite;
    }
    
    @keyframes lockPulse {
        0% { transform: translate(-50%, -50%) scale(1); opacity: 0.4; }
        50% { transform: translate(-50%, -50%) scale(1.2); opacity: 0.6; }
        100% { transform: translate(-50%, -50%) scale(1); opacity: 0.4; }
    }
    
    .locked-header h4 {
        font-size: 1.8rem;
        font-weight: 900;
        color: #92400e;
        margin-bottom: 0.5rem;
    }
    
    .locked-subtitle {
        color: #b45309;
        font-size: 1.1rem;
        margin-bottom: 0;
    }
    
    /* Box Paiement Premium */
    .payment-box-premium {
        max-width: 400px;
        margin: 0 auto;
    }
    
    .pricing-card-premium {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.15),
            0 0 0 1px rgba(0, 0, 0, 0.05);
        border: 2px solid #f59e0b;
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
    
    .pricing-badge {
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
    
    .btn-pay-premium:hover .btn-sparkle {
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
    
    /* Section Déverrouillée Premium */
    .unlocked-section-premium {
        padding: 2rem;
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border-radius: 20px;
        border: 2px solid #10b981;
    }
    
    .unlocked-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    
    .access-badge-premium {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        padding: 0.8rem 1.5rem;
        border-radius: 25px;
        font-weight: 800;
        font-size: 1.1rem;
        display: inline-flex;
        align-items: center;
        margin-bottom: 1rem;
        position: relative;
        overflow: hidden;
    }
    
    .badge-glow {
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.6s;
    }
    
    .access-badge-premium:hover .badge-glow {
        left: 100%;
    }
    
    .access-message {
        color: #065f46;
        font-size: 1.1rem;
        margin-bottom: 0;
    }
    
    .content-divider {
        text-align: center;
        margin: 2rem 0;
        position: relative;
    }
    
    .content-divider::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, transparent, #10b981, transparent);
    }
    
    .divider-text {
        background: white;
        padding: 0 1.5rem;
        color: #10b981;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        position: relative;
        font-size: 0.9rem;
    }
    
    .full-content-premium {
        font-size: 1.15rem;
        line-height: 1.8;
        color: #1f2937;
        padding: 1rem 0;
    }
    
    .full-content-premium p {
        margin-bottom: 1.5rem;
    }
    
    /* Authentification Requise Premium */
    .auth-required-premium {
        max-width: 400px;
        margin: 0 auto;
    }
    
    .auth-card {
        background: white;
        border-radius: 20px;
        padding: 2.5rem;
        text-align: center;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.1),
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
    
    /* Sidebar Premium */
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
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        font-weight: 800;
        margin: 0 auto 1.5rem;
        position: relative;
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.3);
    }
    
    .avatar-status {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 20px;
        height: 20px;
        background: #10b981;
        border: 3px solid white;
        border-radius: 50%;
    }
    
    .author-info-premium h5 {
        font-size: 1.3rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }
    
    .author-title {
        color: #6b7280;
        margin-bottom: 1rem;
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
        font-size: 1rem;
    }
    
    .rating-text {
        color: #6b7280;
        font-weight: 700;
        font-size: 0.9rem;
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
        font-size: 1.8rem;
        font-weight: 900;
        color: #3b82f6;
        line-height: 1;
    }
    
    .stat-label {
        font-size: 0.85rem;
        color: #6b7280;
        margin-top: 0.25rem;
    }
    
    .stat-divider {
        width: 1px;
        height: 40px;
        background: #e5e7eb;
    }
    
    .btn-follow-author {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        border: none;
        padding: 0.8rem 1.5rem;
        border-radius: 12px;
        font-weight: 700;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }
    
    .btn-follow-author:hover {
        background: linear-gradient(135deg, #34d399, #10b981);
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(16, 185, 129, 0.3);
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
        border-color: #3b82f6;
    }
    
    .action-btn-premium.print:hover { border-color: #f59e0b; }
    .action-btn-premium.share:hover { border-color: #8b5cf6; }
    .action-btn-premium.bookmark:hover { border-color: #ef4444; }
    .action-btn-premium.download:hover { border-color: #10b981; }
    
    .action-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
    }
    
    .action-btn-premium.print .action-icon { background: linear-gradient(135deg, #f59e0b, #fbbf24); }
    .action-btn-premium.share .action-icon { background: linear-gradient(135deg, #8b5cf6, #a78bfa); }
    .action-btn-premium.bookmark .action-icon { background: linear-gradient(135deg, #ef4444, #f87171); }
    .action-btn-premium.download .action-icon { background: linear-gradient(135deg, #10b981, #34d399); }
    
    .action-btn-premium span {
        font-weight: 700;
        color: #374151;
        font-size: 0.9rem;
    }
    
    /* Métriques Premium */
    .metrics-grid-premium {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .metric-item-premium {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        transition: all 0.3s ease;
    }
    
    .metric-item-premium:hover {
        background: white;
        border-color: #3b82f6;
        transform: translateX(5px);
    }
    
    .metric-icon {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: white;
        flex-shrink: 0;
    }
    
    .metric-icon.complexity { background: linear-gradient(135deg, #8b5cf6, #a78bfa); }
    .metric-icon.time { background: linear-gradient(135deg, #f59e0b, #fbbf24); }
    .metric-icon.engagement { background: linear-gradient(135deg, #ef4444, #f87171); }
    
    .metric-content {
        flex: 1;
    }
    
    .metric-label {
        font-size: 0.8rem;
        color: #6b7280;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.25rem;
    }
    
    .metric-value {
        font-size: 1rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }
    
    .progress-metric {
        height: 4px;
        background: #e5e7eb;
        border-radius: 2px;
        overflow: hidden;
    }
    
    .progress-bar {
        height: 100%;
        background: linear-gradient(90deg, var(--gradient-start, #3b82f6), var(--gradient-end, #60a5fa));
        border-radius: 2px;
    }
    
    /* Suggestions Premium */
    .suggestions-premium {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }
    
    .suggestion-item {
        padding: 1rem;
        background: #f9fafb;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
        position: relative;
        transition: all 0.3s ease;
    }
    
    .suggestion-item:hover {
        background: white;
        border-color: #3b82f6;
        transform: translateX(5px);
    }
    
    .suggestion-badge {
        position: absolute;
        top: -8px;
        right: 10px;
        background: #3b82f6;
        color: white;
        padding: 0.2rem 0.6rem;
        border-radius: 10px;
        font-size: 0.7rem;
        font-weight: 700;
    }
    
    .suggestion-badge.new { background: #10b981; }
    .suggestion-badge.trending { background: #ef4444; }
    
    .suggestion-item h6 {
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }
    
    /* Notification */
    .notification-premium {
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
        border-left: 4px solid #10b981;
    }
    
    .notification-premium.show {
        transform: translateX(0);
        opacity: 1;
    }
    
    .notification-premium i {
        color: #10b981;
        font-size: 1.2rem;
    }
    
    .notification-premium span {
        font-weight: 600;
        color: #1f2937;
    }
    
    /* Responsive */
    @media (max-width: 1200px) {
        .contenu-title-premium {
            font-size: 2.4rem;
        }
        
        .metadata-premium-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 992px) {
        .contenu-show-premium {
            padding: 90px 0 40px;
        }
        
        .contenu-title-premium {
            font-size: 2rem;
        }
        
        .metadata-premium-grid {
            grid-template-columns: 1fr;
        }
        
        .actions-grid-premium {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .contenu-show-premium {
            padding: 80px 0 30px;
        }
        
        .contenu-header-premium {
            padding: 1.5rem;
        }
        
        .contenu-title-premium {
            font-size: 1.7rem;
        }
        
        .preview-section-premium {
            padding: 1.5rem;
        }
        
        .locked-section-premium {
            padding: 2rem 1.5rem;
        }
        
        .auth-actions {
            flex-direction: column;
        }
        
        .price-amount {
            font-size: 3rem;
        }
        
        .pricing-card-premium {
            padding: 1.5rem;
        }
    }
    
    @media (max-width: 576px) {
        .contenu-title-premium {
            font-size: 1.5rem;
        }
        
        .header-badges-premium {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .badge-type-premium,
        .badge-region-premium,
        .badge-langue-premium {
            width: fit-content;
        }
        
        .preview-stats {
            flex-direction: column;
            gap: 1rem;
        }
        
        .author-stats-premium {
            flex-direction: column;
            gap: 1rem;
        }
        
        .stat-divider {
            width: 100%;
            height: 1px;
        }
    }
</style>
@endsection