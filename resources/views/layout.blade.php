<!doctype html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Culture Benin - Administration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    
    <!-- OverlayScrollbars -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="{{ URL::asset('/adminlte/img/logo-culture-benin.png') }}">
    
    <!-- AdminLTE -->
    <link rel="stylesheet" href="{{ URL::asset('/adminlte/css/adminlte.css') }}" />
    
    <!-- DataTables CSS (version stable) -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
    
    <style>
        :root {
            --primary-color: #e17000;
            --secondary-color: #008751;
            --sidebar-bg: #f8f9fa;
            --sidebar-hover: #e9ecef;
            --sidebar-active: #007bff;
        }

        .sidebar-custom {
            background-color: var(--sidebar-bg) !important;
        }
        .sidebar-custom .nav-link {
            color: #495057 !important;
            border-radius: 0.375rem;
            margin: 0.125rem 0.5rem;
            transition: all 0.3s ease;
        }
        .sidebar-custom .nav-link:hover {
            background-color: var(--sidebar-hover);
            color: var(--primary-color) !important;
            transform: translateX(5px);
        }
        .sidebar-custom .nav-link.active {
            background: linear-gradient(135deg, var(--sidebar-active) 0%, #0056b3 100%);
            color: white !important;
            box-shadow: 0 4px 12px rgba(0, 123, 255, 0.3);
        }
        
        /* Styles pour la sidebar brand */
        .sidebar-brand.brand-custom {
            padding: 15px 10px;
            border-bottom: 1px solid #dee2e6;
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
        }

        .brand-custom .brand-link {
            display: flex;
            align-items: center;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .brand-custom .brand-link:hover {
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
        }

        .brand-custom .brand-image {
            width: 40px;
            height: 40px;
            object-fit: contain;
            margin-right: 12px;
            border-radius: 8px;
            background: white;
            padding: 3px;
            transition: all 0.3s ease;
        }

        .brand-custom .brand-link:hover .brand-image {
            opacity: 1;
            transform: scale(1.05);
        }

        .brand-custom .brand-text {
            font-size: 18px;
            font-weight: 700;
            color: white;
            transition: all 0.3s ease;
        }

        .brand-custom .brand-link:hover .brand-text {
            color: #ffd700;
        }

        /* Header amélioré */
        .app-header {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .user-image {
            width: 32px;
            height: 32px;
            object-fit: cover;
        }

        /* Main content */
        .app-content-header {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        /* Footer */
        .app-footer {
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.05);
        }

        /* Nav headers */
        .nav-header {
            color: var(--primary-color) !important;
            font-weight: 600;
            font-size: 0.85rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        /* Icônes des menus */
        .nav-icon {
            font-size: 1.1rem;
            width: 20px;
            text-align: center;
            margin-right: 10px;
        }

        /* Version réduite de la sidebar */
        .sidebar-collapsed .brand-custom .brand-text {
            display: none;
        }

        .sidebar-collapsed .brand-custom .brand-image {
            margin-right: 0;
            width: 35px;
            height: 35px;
        }

        /* Styles pour DataTables */
        .dataTables_wrapper {
            padding: 10px 0;
        }
        .dataTables_length,
        .dataTables_filter {
            margin-bottom: 15px;
        }
        .dataTables_filter input {
            margin-left: 10px;
            padding: 5px 10px;
            border: 1px solid #dee2e6;
            border-radius: 4px;
        }
    </style>
    
    @yield('styles')
</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
        
        <!-- Header -->
        <nav class="app-header navbar navbar-expand bg-white border-bottom">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <span class="nav-link text-dark fw-bold">Tableau de Bord</span>
                    </li>
                </ul>
                
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                            <i class="bi bi-search"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{ URL::asset('/adminlte/img/user2-160x160.jpg') }}" class="user-image rounded-circle shadow" alt="User Image" />
                            <span class="d-none d-md-inline">Admin</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <li class="user-header text-bg-primary">
                                <img src="{{ URL::asset('/adminlte/img/user2-160x160.jpg') }}" class="rounded-circle shadow" alt="User Image" />
                                <p class="mb-0">
                                    Administrateur
                                    <small>Culture Benin</small>
                                </p>
                            </li>
                            <li class="user-footer">
                                <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">
                                    <i class="bi bi-person me-1"></i>Profil
                                </a>
                                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-default btn-flat float-end">
                                        <i class="bi bi-box-arrow-right me-1"></i>Déconnexion
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Sidebar -->
        <aside class="app-sidebar sidebar-custom shadow">
            <div class="sidebar-brand brand-custom">
                <a href="{{ url('/admin') }}" class="brand-link text-white">
                    <img src="{{ URL::asset('/adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin Logo" class="brand-image opacity-75 shadow" />
                    <span class="brand-text fw-bold">CULTURE BENIN</span>
                </a>
            </div>

            <div class="sidebar-wrapper">
                <nav class="mt-2">
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation">
                        <li class="nav-item">
                            <a href="{{ url('/admin') }}" class="nav-link {{ request()->is('admin') || request()->is('admin/dashboard') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-house-door"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        
                        <li class="nav-header mt-3">GESTION DU CONTENU</li>
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.langues.index') }}" class="nav-link {{ request()->is('admin/langues*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-translate"></i>
                                <p>Langues</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.contenus.index') }}" class="nav-link {{ request()->is('admin/contenus*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-file-text"></i>
                                <p>Contenus</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.type_contenus.index') }}" class="nav-link {{ request()->is('admin/type_contenus*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-bookmark"></i>
                                <p>Types de Contenus</p>
                            </a>
                        </li>
                        
                        <li class="nav-header mt-3">GESTION DES MÉDIAS</li>

                        <li class="nav-item">
                            <a href="{{ route('admin.medias.index') }}" class="nav-link {{ request()->is('admin/medias*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-images"></i>
                                <p>Médias</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.type_medias.index') }}" class="nav-link {{ request()->is('admin/type_medias*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-tags"></i>
                                <p>Types de Médias</p>
                            </a>
                        </li>

                        <li class="nav-header mt-3">GESTION DES UTILISATEURS & RÔLES</li>

                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->is('admin/users*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-people"></i>
                                <p>Utilisateurs</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.roles.index') }}" class="nav-link {{ request()->is('admin/roles*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-person-gear"></i>
                                <p>Rôles</p>
                            </a>
                        </li>

                        <li class="nav-header mt-3">AUTRES PARAMÈTRES</li>

                        <li class="nav-item">
                            <a href="{{ route('admin.regions.index') }}" class="nav-link {{ request()->is('admin/regions*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-globe-americas"></i>
                                <p>Régions</p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{ route('admin.commentaires.index') }}" class="nav-link {{ request()->is('admin/commentaires*') ? 'active' : '' }}">
                                <i class="nav-icon bi bi-chat-dots"></i>
                                <p>Commentaires</p>
                            </a>
                        </li>
                    
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="app-main">
            <div class="app-content-header bg-white border-bottom">
                <div class="container-fluid py-3">
                    @yield('title')
                </div>
            </div>

            <div class="app-content">
                <div class="container-fluid py-4">
                    @yield('content')
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="app-footer bg-white border-top">
            <div class="container-fluid py-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <strong class="text-primary">
                            &copy; 2025 Culture Benin - Plateforme de gestion culturelle
                        </strong>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <span class="text-muted">Version 1.0</span>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('/adminlte/js/adminlte.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const sidebarWrapper = document.querySelector('.sidebar-wrapper');
            if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
                OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
                    scrollbars: {
                        theme: 'os-theme-light',
                        autoHide: 'leave',
                        clickScroll: true,
                    },
                });
            }
        });
    </script>

    @yield('scripts')
</body>
</html>