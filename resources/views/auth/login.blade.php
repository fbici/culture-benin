<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Culture Benin</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="{{ asset('adminlte/img/logo-culture-benin.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #e17000; /* Orange/Or du drapeau */
            --secondary-color: #008000; /* Vert du drapeau */
            --accent-color: #ffd700; /* Jaune/Or brillant */
            --dark-color: #1a1d21;
            --light-color: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, #e17000 0%, #ff8c00 100%);
            --gradient-benin: linear-gradient(135deg, #008000 0%, #ffd700 50%, #e17000 100%);
            --gradient-header: linear-gradient(135deg, #008751 0%, #fcd116 50%, #e8112d 100%);
            --gradient-gold: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);

            /* Styles spécifiques au Login */
            --primary-light: #fdf6ec;
            --gray-color: #6c757d;
            --border-color: #e2e8f0;
            --shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            --shadow-hover: 0 15px 35px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            color: var(--dark-color);
            overflow-x: hidden;
            line-height: 1.6;
        }

        h1, h2, h3 {
            line-height: 1.2;
        }

        /* ===== HEADER PROFESSIONNEL & RESPONSIVE ===== */
        .main-header {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.08);
            padding: 1rem 0;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .header-scrolled {
            box-shadow: 0 8px 60px rgba(0, 0, 0, 0.12);
            padding: 0.8rem 0;
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .logo-section {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo-wrapper {
            width: 60px;
            height: 60px;
            background: var(--gradient-benin);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 25px rgba(225, 112, 0, 0.3);
            transition: all 0.3s ease;
            padding: 5px;
            position: relative;
            overflow: hidden;
        }

        .logo-wrapper:hover {
            transform: rotate(-5deg) scale(1.05);
        }

        .logo-img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 10px;
            background: white;
        }

        .logo-fallback {
            width: 100%;
            height: 100%;
            display: none;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 10px;
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .brand-text {
            font-size: 1.8rem;
            font-weight: 900;
            background: var(--gradient-benin);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        .brand-tagline {
            font-size: 0.9rem;
            color: #666;
            font-weight: 500;
            margin-top: -2px;
        }

        .nav-main {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .nav-links {
            display: flex;
            gap: 0.5rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-link {
            font-weight: 600;
            color: var(--dark-color);
            text-decoration: none;
            padding: 0.8rem 1.2rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            position: relative;
            font-size: 0.95rem;
            display: block;
        }

        .nav-link:hover {
            color: var(--primary-color);
            background: rgba(225, 112, 0, 0.08);
        }

        .nav-link.active {
            color: var(--primary-color);
            background: rgba(225, 112, 0, 0.1);
        }

        .nav-link.active:after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 3px;
            background: var(--gradient-primary);
            border-radius: 2px;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        /* BOUTONS PROFESSIONNELS */
        .btn-auth {
            padding: 0.7rem 1.5rem;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.9rem;
            border: 2px solid;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
        }

        .btn-login {
            background: transparent;
            color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-login:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(225, 112, 0, 0.3);
        }

        .btn-register {
            background: var(--gradient-primary);
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 15px rgba(225, 112, 0, 0.25);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(225, 112, 0, 0.4);
            color: white;
        }

        .menu-toggle-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.8rem;
            color: var(--dark-color);
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.3s ease;
        }

        .menu-toggle-btn:hover {
            color: var(--primary-color);
        }
        
        /* ===== STYLES DE LA PAGE DE CONNEXION ===== */
        .login-page-wrapper {
            min-height: calc(100vh - 120px);
            padding-top: 100px;
            padding-bottom: 50px;
            background: linear-gradient(135deg, #f5f7fa 0%, #e4edf5 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }

        .login-container {
            background: white;
            border-radius: 16px;
            box-shadow: var(--shadow);
            overflow: hidden;
            max-width: 440px;
            width: 90%;
            position: relative;
            transition: all 0.3s ease;
        }
        
        .login-container:hover {
            box-shadow: var(--shadow-hover);
        }
        
        /* EN-TÊTE AVEC LE MÊME DÉGRADÉ QUE REGISTER */
        .login-header {
            background: var(--gradient-header);
            padding: 40px 30px 30px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .login-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }
        
        /* STYLE DU LOGO COMME DANS VOTRE LOGIN ORIGINAL */
        .logo-container {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--primary-color) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            box-shadow: 0 8px 20px rgba(225, 112, 0, 0.2);
            transition: transform 0.3s ease;
            padding: 2px;
            border: 1px solid white;
        }
        
        .logo-container:hover {
            transform: scale(1.05);
        }
        
        .logo-container img {
            width: 85px;
            height: 85px;
            object-fit: contain;
            border-radius: 50%;
            background: white;
            padding: 2px;
        }
        
        .login-body {
            padding: 40px 30px;
        }
        
        /* ANIMATIONS DES ÉLÉMENTS DU FORMULAIRE */
        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
            animation: fadeInUp 0.5s ease forwards;
            opacity: 0;
            transform: translateY(20px);
        }
        
        .form-group:nth-child(1) { animation-delay: 0.1s; }
        .form-group:nth-child(2) { animation-delay: 0.2s; }
        .form-group:nth-child(3) { animation-delay: 0.3s; }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .form-control {
            border: 1.5px solid var(--border-color);
            border-radius: 10px;
            padding: 14px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: var(--light-color);
            height: 50px;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(225, 112, 0, 0.15);
            background: white;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 10px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .form-label i {
            margin-right: 8px;
            color: var(--primary-color);
        }
        
        .btn-login-main {
            background: linear-gradient(135deg, var(--primary-color) 0%, #c45c00 100%);
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            transition: all 0.3s ease;
            width: 100%;
            height: 52px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            animation: fadeInUp 0.5s ease forwards;
            animation-delay: 0.4s;
            opacity: 0;
            transform: translateY(20px);
        }
        
        .btn-login-main:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(225, 112, 0, 0.3);
            color: white;
        }
        
        .forgot-link {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .forgot-link:hover {
            color: #c45c00;
            text-decoration: underline;
        }
        
        .remember-me {
            font-size: 14px;
            color: var(--gray-color);
        }
        
        .form-check-input:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .alert {
            border-radius: 10px;
            border: none;
            padding: 14px 16px;
            font-size: 14px;
            display: flex;
            align-items: flex-start;
        }
        
        .alert i {
            margin-right: 10px;
            font-size: 16px;
            padding-top: 3px;
        }
        
        .login-footer {
            text-align: center;
            padding: 20px;
            background: var(--light-color);
            border-top: 1px solid var(--border-color);
        }
        
        .back-to-home {
            color: var(--gray-color);
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }
        
        .back-to-home:hover {
            color: var(--primary-color);
        }
        
        .input-group {
            position: relative;
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
            z-index: 5;
        }
        
        .security-badge {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            position: relative;
            z-index: 1;
        }
        
        .admin-title {
            color: white;
            font-weight: 700;
            margin-bottom: 8px;
            font-size: 24px;
            position: relative;
            z-index: 1;
        }
        
        .password-toggle {
            position: absolute;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gray-color);
            cursor: pointer;
            z-index: 5;
        }

        /* ===== FOOTER PROFESSIONNEL ===== */
        .main-footer {
            background: var(--dark-color);
            color: white;
            padding-top: 60px;
            border-top: 5px solid var(--secondary-color);
        }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 3rem;
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 2rem 40px;
        }

        .footer-logo {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .footer-logo-img {
            width: 50px;
            height: 50px;
            background: var(--gradient-benin);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 5px;
            overflow: hidden;
        }

        .footer-logo-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 5px;
            background: white;
        }

        .footer-logo-fallback {
            width: 100%;
            height: 100%;
            display: none;
            align-items: center;
            justify-content: center;
            background: white;
            border-radius: 5px;
            color: var(--primary-color);
            font-size: 1.2rem;
        }

        .footer-brand-text {
            font-size: 1.5rem;
            font-weight: 800;
            background: var(--gradient-gold);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .footer-description {
            font-size: 0.95rem;
            color: #aaa;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .social-links {
            display: flex;
            gap: 1rem;
        }

        .social-link {
            font-size: 1.5rem;
            color: #aaa;
            transition: color 0.3s ease;
        }

        .social-link:hover {
            color: var(--primary-color);
        }

        .footer-heading {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 1.5rem;
            position: relative;
        }

        .footer-heading:after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -5px;
            width: 30px;
            height: 2px;
            background: var(--accent-color);
        }

        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-link {
            color: #aaa;
            text-decoration: none;
            display: block;
            padding: 5px 0;
            transition: color 0.3s ease, transform 0.2s ease;
        }

        .footer-link:hover {
            color: white;
            transform: translateX(5px);
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #aaa;
            margin-bottom: 10px;
        }

        .contact-item i {
            color: var(--primary-color);
        }

        .footer-bottom {
            background: rgba(0, 0, 0, 0.2);
            padding: 15px 2rem;
            text-align: center;
        }

        .footer-bottom-text {
            font-size: 0.85rem;
            color: #888;
            margin: 0;
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 992px) {
            .nav-main {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 82px;
                left: 0;
                width: 100%;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(15px);
                border-top: 1px solid rgba(0, 0, 0, 0.08);
                box-shadow: 0 8px 60px rgba(0, 0, 0, 0.12);
                padding: 2rem 0;
                transition: transform 0.4s ease-out;
                transform: translateX(-100%);
                height: 100vh;
                overflow-y: auto;
            }

            .nav-main.active {
                display: flex;
                transform: translateX(0);
            }

            .nav-links {
                flex-direction: column;
                width: 100%;
                gap: 0;
            }

            .nav-links li {
                width: 100%;
                border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            }

            .nav-link {
                padding: 1rem 2rem;
                border-radius: 0;
                font-size: 1.1rem;
            }

            .nav-link.active:after {
                bottom: auto;
                top: 50%;
                left: 0;
                transform: translateY(-50%);
                width: 5px;
                height: 80%;
                right: auto;
            }

            .header-actions {
                display: none;
                flex-direction: column;
                gap: 1rem;
                padding: 1rem 2rem 0;
                width: 100%;
            }

            .nav-main.active .header-actions {
                display: flex;
            }

            .btn-auth {
                width: 100%;
                justify-content: center;
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }

            .menu-toggle-btn {
                display: block;
            }
            
            .header-container {
                padding: 0 1rem;
            }

            .footer-top {
                grid-template-columns: 1fr 1fr;
                gap: 2rem;
                padding: 0 1rem 40px;
            }
        }

        @media (max-width: 768px) {
            .footer-top {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .login-container {
                width: 95%; 
            }
        }
    </style>
</head>
<body>
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
                    <li><a href="{{ url('/') }}#contenus" class="nav-link">Contenus</a></li>
                    <li><a href="{{ url('/') }}#medias" class="nav-link">Médias</a></li>
                    <li><a href="{{ url('/') }}#regions" class="nav-link">Régions</a></li>
                    <li><a href="{{ url('/') }}#langues" class="nav-link">Langues</a></li>
                    <li><a href="{{ url('/') }}#contact" class="nav-link">Contact</a></li>
                    <li><a href="{{ url('/') }}#apropos" class="nav-link">A propos</a></li>
                </ul>

                <div class="header-actions d-lg-none">
                    <a href="{{ route('login') }}" class="btn-auth btn-login active">
                        <i class="bi bi-box-arrow-in-right"></i>Connexion
                    </a>
                    <a href="{{ route('register') }}" class="btn-auth btn-register">
                        <i class="bi bi-person-plus"></i>Inscription
                    </a>
                </div>
            </nav>

            <div class="header-actions d-none d-lg-flex">
                <a href="{{ route('login') }}" class="btn-auth btn-login active">
                    <i class="bi bi-box-arrow-in-right"></i>Connexion
                </a>
                <a href="{{ route('register') }}" class="btn-auth btn-register">
                    <i class="bi bi-person-plus"></i>Inscription
                </a>
            </div>
        </div>
    </header>

    <main class="login-page-wrapper">
        <div class="login-container">
            <div class="login-header">
                <div class="logo-container">
                    <img src="{{ asset('adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin" class="logo">
                </div>
                <h1 class="admin-title">CONNEXION UTILISATEUR</h1>
                
                <div class="mt-3">
                    <span class="security-badge">
                        <i class="bi bi-shield-lock-fill"></i> Accès Sécurisé
                    </span>
                </div>
            </div>
            
            <div class="login-body">
                @if (session('status'))
                    <div class="alert alert-success mb-4">
                        <i class="bi bi-check-circle-fill"></i>{{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="email" class="form-label">
                            <i class="bi bi-envelope"></i>Adresse Email
                        </label>
                        <div class="input-group">
                            <input type="email" 
                                class="form-control @error('email') is-invalid @enderror" 
                                id="email" 
                                name="email" 
                                value="{{ old('email') }}" 
                                placeholder="votre@email.com"
                                required 
                                autofocus>
                            <i class="bi bi-person input-icon"></i>
                        </div>
                        @error('email')
                            <div class="invalid-feedback d-block mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password" class="form-label">
                            <i class="bi bi-lock"></i>Mot de Passe
                        </label>
                        <div class="input-group">
                            <input type="password" 
                                class="form-control @error('password') is-invalid @enderror" 
                                id="password" 
                                name="password" 
                                placeholder="Votre mot de passe"
                                required>
                            <i class="bi bi-eye password-toggle" id="togglePassword"></i>
                            <i class="bi bi-key input-icon"></i>
                        </div>
                        @error('password')
                            <div class="invalid-feedback d-block mt-2">
                                <i class="bi bi-exclamation-circle me-1"></i>{{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label remember-me" for="remember">
                                Se souvenir de moi
                            </label>
                        </div>
                        
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="forgot-link">
                                <i class="bi bi-question-circle"></i>Mot de passe oublié ?
                            </a>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-login-main mb-4">
                        <i class="bi bi-box-arrow-in-right"></i>Se Connecter
                    </button>

                    @if ($errors->any() && !($errors->has('email') || $errors->has('password')))
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle"></i>
                            Identifiants incorrects. Veuillez réessayer.
                        </div>
                    @endif
                </form>
            </div>
            
            <div class="login-footer">
                <a href="{{ url('/') }}" class="back-to-home">
                    <i class="bi bi-arrow-left-circle"></i>Retour à l'accueil public
                </a>
            </div>
        </div>
    </main>
    <footer class="main-footer">
        <div class="footer-top">
            <div class="footer-brand">
                <div class="footer-logo">
                    <div class="footer-logo-img">
                        <img src="{{ asset('adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="footer-logo-fallback">
                            <i class="bi bi-globe-africa"></i>
                        </div>
                    </div>
                    <div class="footer-brand-text">CULTURE BENIN</div>
                </div>
                <p class="footer-description">
                    Plateforme officielle de préservation et de promotion du patrimoine culturel béninois.
                    Nous œuvrons pour la sauvegarde et la valorisation de notre héritage culturel unique.
                </p>

                <div class="social-links">
                    <a href="#" class="social-link">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="#" class="social-link">
                        <i class="bi bi-linkedin"></i>
                    </a>
                </div>
            </div>

            <div class="footer-nav">
                <h4 class="footer-heading">Navigation</h4>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}#accueil" class="footer-link">Accueil</a></li>
                    <li><a href="{{ url('/') }}#contenus" class="footer-link">Contenus Culturels</a></li>
                    <li><a href="{{ url('/') }}#medias" class="footer-link">Galerie Médias</a></li>
                    <li><a href="{{ url('/') }}#regions" class="footer-link">Régions</a></li>
                    <li><a href="{{ url('/') }}#langues" class="footer-link">Langues Locales</a></li>
                </ul>
            </div>

            <div class="footer-resources">
                <h4 class="footer-heading">Ressources</h4>
                <ul class="footer-links">
                    <li><a href="{{ url('/') }}#apropos" class="footer-link">À Propos</a></li>
                    <li><a href="{{ url('/') }}#contact" class="footer-link">Contact</a></li>
                    <li><a href="#" class="footer-link">FAQ</a></li>
                    <li><a href="#" class="footer-link">Support</a></li>
                    <li><a href="#" class="footer-link">Mentions Légales</a></li>
                </ul>
            </div>

            <div class="footer-contact">
                <h4 class="footer-heading">Contact</h4>
                <div class="contact-item">
                    <i class="bi bi-geo-alt"></i>
                    <span>Porto-Novo, Bénin</span>
                </div>
                <div class="contact-item">
                    <i class="bi bi-envelope"></i>
                    <span>contact@culturebenin.bj</span>
                </div>
                <div class="contact-item">
                    <i class="bi bi-phone"></i>
                    <span>+229 XX XX XX XX</span>
                </div>
                <div class="contact-item">
                    <i class="bi bi-clock"></i>
                    <span>Lun - Ven: 8h - 18h</span>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p class="footer-bottom-text">
                &copy; 2025 Culture Benin. Tous droits réservés. |
                <span style="color: var(--accent-color);">Patrimoine Culturel National</span> |
                Développé avec ❤️ pour le Bénin
            </p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const header = document.getElementById('mainHeader');
            const menuToggle = document.getElementById('menuToggle');
            const mainNav = document.getElementById('mainNav');
            const navLinks = document.querySelectorAll('.nav-link');

            // 1. Animation du header au scroll
            window.addEventListener('scroll', function() {
                if (window.scrollY > 100) {
                    header.classList.add('header-scrolled');
                } else {
                    header.classList.remove('header-scrolled');
                }
            });

            // 2. Gestion du menu mobile (Hamburger)
            menuToggle.addEventListener('click', function() {
                const isExpanded = mainNav.classList.toggle('active');
                menuToggle.querySelector('i').className = isExpanded ? 'bi bi-x-lg' : 'bi bi-list';
                document.body.style.overflow = isExpanded ? 'hidden' : 'auto';
            });

            // Fermer le menu mobile lors du clic sur un lien
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (mainNav.classList.contains('active')) {
                        mainNav.classList.remove('active');
                        menuToggle.querySelector('i').className = 'bi bi-list';
                        document.body.style.overflow = 'auto'; 
                    }
                });
            });

            // 3. Script d'animation de la page de connexion
            const container = document.querySelector('.login-container');
            if(container) {
                 container.style.opacity = '0';
                 container.style.transform = 'translateY(20px)';
                 
                 setTimeout(() => {
                     container.style.transition = 'all 0.5s ease';
                     container.style.opacity = '1';
                     container.style.transform = 'translateY(0)';
                 }, 100);
            }

            // 4. Toggle password visibility
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            
            if (togglePassword && password) {
                togglePassword.addEventListener('click', function() {
                    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                    password.setAttribute('type', type);
                    this.classList.toggle('bi-eye');
                    this.classList.toggle('bi-eye-slash');
                });
            }
        });
    </script>
</body>
</html>