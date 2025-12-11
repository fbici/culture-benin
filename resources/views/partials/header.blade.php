<header class="main-header" id="mainHeader">
    <div class="header-container">
        <div class="logo-section">
            <div class="logo-wrapper">
                <a href="{{ url('/') }}" class="brand-link text-white">
                    <img src="{{ asset('adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin" class="logo-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                </a>
                <div class="logo-fallback">
                    <i class="bi bi-globe-africa"></i>
                </div>
            </div>
            <div>
                <div class="brand-text">CULTURE BENIN</div>
                <div class="brand-tagline">Patrimoine Culturel National</div>
            </div>
        </div>

        <button class="menu-toggle-btn" id="menuToggle">
            <i class="bi bi-list"></i>
        </button>

        <nav class="nav-main" id="mainNav">
            <ul class="nav-links">
                <li><a href="{{ route('contenus.index') }}" class="nav-link {{ request()->routeIs('contenus.*') ? 'active' : '' }}">Contenus</a></li>
                <li><a href="{{ route('media.index') }}" class="nav-link {{ request()->routeIs('medias.*') ? 'active' : '' }}">Médias</a></li>
                <li><a href="{{ route('region.index') }}" class="nav-link ">Régions</a></li>
                <li><a href="{{ route('langue.index') }}" class="nav-link">Langues</a></li>
                <li><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                <li><a href="{{ route('about') }}" class="nav-link">A propos</a></li>
            </ul>

            <!-- Version mobile pour utilisateur connecté -->
            <div class="header-actions d-lg-none">
                @auth
                <a href="{{ url('/user/dashboard') }}" class="btn-auth btn-dashboard">
                    <i class="bi bi-speedometer2"></i>Tableau de Bord
                </a>
                <a href="{{ route('logout') }}" 
                   class="btn-auth btn-logout"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i>Déconnexion
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                @else
                <a href="{{ route('login') }}" class="btn-auth btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>Connexion
                </a>
                <a href="{{ route('register') }}" class="btn-auth btn-register">
                    <i class="bi bi-person-plus"></i>Inscription
                </a>
                @endauth
            </div>
        </nav>

        <!-- Version desktop pour utilisateur connecté -->
        <div class="header-actions d-none d-lg-flex">
            @auth
            <a href="{{ url('/user/dashboard') }}" class="btn-auth btn-dashboard">
                <i class="bi bi-speedometer2"></i>Tableau de Bord
            </a>
            <a href="{{ route('logout') }}" 
               class="btn-auth btn-logout"
               onclick="event.preventDefault(); document.getElementById('logout-form-desktop').submit();">
                <i class="bi bi-box-arrow-right"></i>Déconnexion
            </a>
            <form id="logout-form-desktop" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            @else
            <a href="{{ route('login') }}" class="btn-auth btn-login">
                <i class="bi bi-box-arrow-in-right"></i>Connexion
            </a>
            <a href="{{ route('register') }}" class="btn-auth btn-register">
                <i class="bi bi-person-plus"></i>Inscription
            </a>
            @endauth
        </div>
    </div>
</header>