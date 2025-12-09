<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Espace Membre - Culture Benin')</title>
    
    <!-- Bootstrap 5.3 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Logo -->
    <link rel="icon" type="image/png" href="{{ asset('adminlte/img/logo-culture-benin.png') }}">
    <!-- Police Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        /* Variables globales */
        :root {
            --primary-orange: #e17000;
            --primary-green: #008000;
            --accent-gold: #ffd700;
            --dark-color: #1a1d21;
            --light-color: #f8f9fa;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
            padding-top: 0;
            color: var(--dark-color);
        }
        
        /* Header utilisateur */
        .user-header {
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
        }
        
        .header-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        
        .logo-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
        }
        
        .logo-img {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            object-fit: cover;
        }
        
        .brand-text {
            font-size: 1.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #008000 0%, #ffd700 50%, #e17000 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        
        /* Menu utilisateur avec dropdown */
        .user-menu {
            display: flex;
            align-items: center;
            gap: 2rem;
        }
        
        .nav-user-links {
            display: flex;
            gap: 1rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }
        
        .nav-user-links a {
            color: var(--dark-color);
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .nav-user-links a:hover {
            background: rgba(225, 112, 0, 0.1);
            color: var(--primary-orange);
        }
        
        /* Avatar utilisateur avec dropdown */
        .user-avatar-dropdown {
            position: relative;
        }
        
        .avatar-btn {
            background: none;
            border: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 10px;
            transition: all 0.3s ease;
        }
        
        .avatar-btn:hover {
            background: rgba(0, 0, 0, 0.05);
        }
        
        .user-avatar-circle {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, var(--primary-orange) 0%, #ff8c00 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
        }
        
        .user-name-short {
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        /* Dropdown menu */
        .dropdown-menu-user {
            position: absolute;
            top: 100%;
            right: 0;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            min-width: 250px;
            padding: 1rem 0;
            display: none;
            z-index: 1001;
            border: 1px solid rgba(0, 0, 0, 0.08);
        }
        
        .dropdown-menu-user.show {
            display: block;
        }
        
        .user-info-card {
            padding: 1rem;
            text-align: center;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1);
            margin-bottom: 0.5rem;
        }
        
        .user-info-avatar {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, var(--primary-orange) 0%, #ff8c00 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            font-weight: 700;
            margin: 0 auto 1rem;
        }
        
        .dropdown-item-user {
            display: flex;
            align-items: center;
            gap: 0.8rem;
            padding: 0.8rem 1.5rem;
            color: var(--dark-color);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .dropdown-item-user:hover {
            background: rgba(225, 112, 0, 0.1);
            color: var(--primary-orange);
        }
        
        .dropdown-divider {
            height: 1px;
            background: rgba(0, 0, 0, 0.1);
            margin: 0.5rem 0;
        }
        
        /* Contenu principal */
        .main-content {
            max-width: 1400px;
            margin: 100px auto 40px;
            padding: 0 2rem;
        }
        
        /* Footer */
        .user-footer {
            background: var(--dark-color);
            color: white;
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
        }
        
        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .header-content {
                padding: 0 1rem;
            }
            
            .nav-user-links {
                display: none;
            }
            
            .main-content {
                padding: 0 1rem;
                margin-top: 80px;
            }
        }
    </style>
    
    @yield('styles')
</head>
<body>
    <!-- Header Utilisateur -->
    <header class="user-header">
        <div class="header-content">
            <!-- Logo et marque -->
            <a href="{{ route('user.dashboard') }}" class="logo-brand">
                <img src="{{ asset('adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin" class="logo-img">
                <div class="brand-text">CULTURE BENIN</div>
            </a>
            
            <!-- Menu utilisateur -->
            <div class="user-menu">
                <ul class="nav-user-links d-none d-md-flex">
                    <li><a href="{{ route('user.dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ route('user.contenus.index') }}">Contenus</a></li>
                    <li><a href="{{ route('user.medias.index') }}">Médias</a></li>
                    <li><a href="{{ url('/') }}">Site Public</a></li>
                </ul>
                
                <!-- Avatar avec dropdown -->
                <div class="user-avatar-dropdown">
                    <button class="avatar-btn" id="userMenuBtn">
                        <div class="user-avatar-circle">
                            {{ strtoupper(substr(auth()->user()->prenom, 0, 1)) }}{{ strtoupper(substr(auth()->user()->nom, 0, 1)) }}
                        </div>
                        <span class="user-name-short d-none d-md-inline">{{ auth()->user()->prenom }}</span>
                        <i class="bi bi-chevron-down"></i>
                    </button>
                    
                    <div class="dropdown-menu-user" id="userDropdown">
                        <div class="user-info-card">
                            <div class="user-info-avatar">
                                {{ strtoupper(substr(auth()->user()->prenom, 0, 1)) }}{{ strtoupper(substr(auth()->user()->nom, 0, 1)) }}
                            </div>
                            <h6 class="mb-1">{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</h6>
                            <small class="text-muted">{{ auth()->user()->email }}</small>
                            <div class="mt-2">
                                <span class="badge bg-success">Membre</span>
                            </div>
                        </div>
                        
                        <a href="{{ route('user.dashboard') }}" class="dropdown-item-user">
                            <i class="bi bi-speedometer2"></i>
                            <span>Tableau de Bord</span>
                        </a>
                        
                        <a href="{{ route('user.profile.edit') }}" class="dropdown-item-user">
                            <i class="bi bi-person"></i>
                            <span>Mon Profil</span>
                        </a>
                        
                        <a href="{{ route('user.contenus.index') }}" class="dropdown-item-user">
                            <i class="bi bi-file-text"></i>
                            <span>Mes Contenus</span>
                        </a>
                        
                        <a href="{{ route('user.medias.index') }}" class="dropdown-item-user">
                            <i class="bi bi-images"></i>
                            <span>Mes Médias</span>
                        </a>
                        
                        <div class="dropdown-divider"></div>
                        
                        <a href="{{ route('logout') }}" 
                           class="dropdown-item-user text-danger"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Déconnexion</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Contenu principal -->
    <main class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="user-footer">
        <div class="footer-content">
            <div class="row">
                <div class="col-md-6">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <img src="{{ asset('adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin" style="width: 40px; height: 40px; border-radius: 8px;">
                        <span class="fs-5 fw-bold" style="color: var(--accent-gold);">CULTURE BENIN</span>
                    </div>
                    <p class="text-muted mb-0">
                        Plateforme de préservation et promotion du patrimoine culturel béninois.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <p class="text-muted mb-0">
                        &copy; {{ date('Y') }} Culture Benin. Tous droits réservés.
                    </p>
                    <p class="text-muted small">
                        Développé avec ❤️ pour le Bénin
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion du dropdown utilisateur
            const userMenuBtn = document.getElementById('userMenuBtn');
            const userDropdown = document.getElementById('userDropdown');
            
            if (userMenuBtn && userDropdown) {
                userMenuBtn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userDropdown.classList.toggle('show');
                });
                
                // Fermer le dropdown en cliquant ailleurs
                document.addEventListener('click', function(e) {
                    if (!userDropdown.contains(e.target) && !userMenuBtn.contains(e.target)) {
                        userDropdown.classList.remove('show');
                    }
                });
            }
        });
    </script>
    
    @yield('scripts')
</body>
</html>