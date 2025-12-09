<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Culture Benin</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/png" href="{{ URL::asset('/adminlte/img/logo-culture-benin.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #e17000; /* Orange/Or du drapeau */
            --secondary-color: #008000; /* Vert du drapeau (Utilisé dans le Footer) */
            --accent-color: #ffd700; /* Jaune/Or brillant */
            --dark-color: #1a1d21;
            --light-color: #f8f9fa;
            --gradient-primary: linear-gradient(135deg, #e17000 0%, #ff8c00 100%);
            --gradient-benin: linear-gradient(135deg, #008000 0%, #ffd700 50%, #e17000 100%);
            --gradient-header: linear-gradient(135deg, #008751 0%, #fcd116 50%, #e8112d 100%);
            --gradient-gold: linear-gradient(135deg, #ffd700 0%, #ffed4e 100%);
            --gradient-form: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            --shadow-soft: 0 4px 20px rgba(0, 0, 0, 0.08);
            --shadow-medium: 0 8px 30px rgba(0, 0, 0, 0.12);
            --shadow-strong: 0 15px 50px rgba(0, 0, 0, 0.15);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        /* Réinitialisation du Body pour le layout full-page (Important) */
        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff; /* Fond blanc par défaut */
            color: var(--dark-color);
            overflow-x: hidden;
            line-height: 1.6;
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
            box-shadow: var(--shadow-medium);
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

        /* Menu de navigation principal */
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
        
        .nav-link.active[href="#register"] {
             /* Pas de marqueur actif pour la page de formulaire */
             background: transparent;
             color: var(--dark-color);
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        /* BOUTONS AUTH */
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

        .btn-register {
            background: var(--gradient-primary);
            color: white;
            border-color: transparent;
            box-shadow: 0 4px 15px rgba(225, 112, 0, 0.25);
        }

        .menu-toggle-btn {
            display: none; /* Masqué par défaut sur desktop */
            background: none;
            border: none;
            font-size: 1.8rem;
            color: var(--dark-color);
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.3s ease;
        }
        /* ===== FIN HEADER STYLES ===== */


        /* ===== CONTENU PRINCIPAL & FORMULAIRE ===== */
        .form-section {
            padding: 100px 0; /* Espace pour le header et le footer */
            min-height: calc(100vh - 100px); /* Assure une hauteur minimale */
            background: var(--gradient-form);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .register-container {
            background: white;
            border-radius: 20px;
            box-shadow: var(--shadow-strong);
            overflow: hidden;
            max-width: 520px; /* Légèrement augmenté */
            width: 100%;
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .register-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.15);
        }
        
        .register-header {
            background: var(--gradient-header);
            padding: 40px 30px 30px;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }
        
        .register-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path d="M0,0 L100,0 L100,100 Z" fill="rgba(255,255,255,0.1)"/></svg>');
            background-size: cover;
        }
        
        /* STYLE DU LOGO COMME DANS VOTRE LOGIN */
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
        
        .register-body {
            padding: 40px 30px;
        }
        
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
        .form-group:nth-child(4) { animation-delay: 0.4s; }
        .form-group:nth-child(5) { animation-delay: 0.5s; }
        
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 8px;
            font-size: 14px;
            display: flex;
            align-items: center;
        }
        
        .form-label i {
            margin-right: 8px;
            color: var(--primary-color);
        }
        
        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 14px 16px;
            font-size: 15px;
            transition: all 0.3s ease;
            background: #f8f9fa;
            height: 52px;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(225, 112, 0, 0.15);
            background: white;
        }
        
        /* BOUTONS AMÉLIORÉS */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            margin-top: 2rem;
            gap: 15px;
            animation: fadeInUp 0.5s ease forwards;
            animation-delay: 0.6s;
            opacity: 0;
            transform: translateY(20px);
        }
        
        .btn-login-link {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            border-radius: 12px;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            text-decoration: none;
            flex: 1;
            white-space: nowrap;
        }
        
        .btn-login-link:hover {
            background: rgba(225, 112, 0, 0.08);
            transform: translateY(-2px);
        }
        
        .btn-register-form {
            background: var(--gradient-primary);
            border: none;
            border-radius: 12px;
            padding: 14px 20px;
            font-weight: 600;
            font-size: 16px;
            color: white;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            position: relative;
            overflow: hidden;
            flex: 2;
            box-shadow: 0 4px 15px rgba(225, 112, 0, 0.3);
        }
        
        .btn-register-form::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }
        
        .btn-register-form:hover::before {
            left: 100%;
        }
        
        .btn-register-form:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(225, 112, 0, 0.4);
        }
        
        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            z-index: 5;
        }
        
        .password-toggle {
            position: absolute;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
            cursor: pointer;
            z-index: 5;
            transition: color 0.3s ease;
        }
        
        .password-toggle:hover {
            color: var(--primary-color);
        }
        
        .error-message {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        
        .register-footer {
            text-align: center;
            padding: 20px;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }
        
        .back-to-home {
            color: #6c757d;
            text-decoration: none;
            font-size: 14px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 8px 16px;
            border-radius: 8px;
        }
        
        .back-to-home:hover {
            color: var(--primary-color);
            background: rgba(225, 112, 0, 0.08);
        }
        /* ===== FIN STYLES FORMULAIRE ===== */
        
        /* ===== FOOTER PROFESSIONNEL & RESPONSIVE ===== */
        .main-footer {
            background: var(--dark-color);
            color: white;
            padding-top: 60px;
            border-top: 5px solid var(--secondary-color);
            position: relative;
        }
        
        .main-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--accent-color), transparent);
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
            padding: 5px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .footer-logo-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            border-radius: 5px;
            background: white;
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
        
        .footer-heading {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--accent-color);
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 2px;
            background: var(--primary-color);
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
            padding: 8px 0;
            transition: color 0.3s ease, transform 0.2s ease;
            position: relative;
            padding-left: 0;
        }
        
        .footer-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }
        
        .footer-link:hover {
            color: white;
            transform: translateX(5px);
        }
        
        .footer-link:hover::before {
            width: 10px;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: #aaa;
            margin-bottom: 15px;
            transition: color 0.3s ease;
        }
        
        .contact-item:hover {
            color: white;
        }
        
        .contact-item i {
            color: var(--primary-color);
            width: 20px;
        }

        .footer-bottom {
            background: rgba(0, 0, 0, 0.2);
            padding: 20px 2rem;
            text-align: center;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .footer-bottom-text {
            margin: 0;
            color: #aaa;
            font-size: 0.9rem;
        }
        
        /* Styles pour les icônes de réseaux sociaux */
        .social-links {
            display: flex;
            gap: 12px;
            margin-top: 20px;
        }
        
        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: #aaa;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1.2rem;
        }
        
        .social-link:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(225, 112, 0, 0.4);
        }
        /* ===== FIN STYLES FOOTER ===== */
        
        /* ===== RESPONSIVE STYLES ===== */
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
                box-shadow: var(--shadow-medium);
                transform: translateX(-100%);
            }

            .nav-main.active {
                display: flex;
                transform: translateX(0);
            }
            
            .nav-links {
                flex-direction: column;
                width: 100%;
            }
            
            .header-actions {
                display: none;
            }

            .nav-main.active .header-actions {
                display: flex;
                flex-direction: column;
            }

            .menu-toggle-btn {
                display: block;
            }

            .footer-top {
                grid-template-columns: 1fr 1fr;
            }
            
            .register-container {
                margin: 0 15px;
            }
            
            .form-actions {
                flex-direction: column;
            }
            
            .btn-login-link, .btn-register-form {
                width: 100%;
            }
        }

        @media (max-width: 768px) {
            .footer-top {
                grid-template-columns: 1fr;
            }
            
            .form-section {
                padding: 80px 0;
            }
            
            .register-body {
                padding: 30px 20px;
            }
            
            .register-header {
                padding: 30px 20px 25px;
            }
        }
        
        @media (max-width: 576px) {
            .header-container {
                padding: 0 1rem;
            }
            
            .footer-top {
                padding: 0 1rem 40px;
            }
            
            .footer-bottom {
                padding: 15px 1rem;
            }
            
            .logo-container {
                width: 90px;
                height: 90px;
            }
            
            .logo-container img {
                width: 75px;
                height: 75px;
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
                        <img src="{{ URL::asset('/adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin" class="logo-img" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
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
                    <li><a href="#contenus" class="nav-link">Contenus</a></li>
                    <li><a href="#medias" class="nav-link">Médias</a></li>
                    <li><a href="#regions" class="nav-link">Régions</a></li>
                    <li><a href="#langues" class="nav-link">Langues</a></li>
                    <li><a href="#contact" class="nav-link">Contact</a></li>
                    <li><a href="#apropos" class="nav-link">A propos</a></li>
                </ul>

                <div class="header-actions d-lg-none">
                    <a href="{{ route('login') }}" class="btn-auth btn-login">
                        <i class="bi bi-box-arrow-in-right"></i>Connexion
                    </a>
                    <a href="{{ route('register') }}" class="btn-auth btn-register">
                        <i class="bi bi-person-plus"></i>Inscription
                    </a>
                </div>
            </nav>

            <div class="header-actions d-none d-lg-flex">
                <a href="{{ route('login') }}" class="btn-auth btn-login">
                    <i class="bi bi-box-arrow-in-right"></i>Connexion
                </a>
                <a href="{{ route('register') }}" class="btn-auth btn-register">
                    <i class="bi bi-person-plus"></i>Inscription
                </a>
            </div>
        </div>
    </header>
    
<section class="form-section">
        <div class="register-container">
            <div class="register-header">
                <div class="logo-container">
                    <img src="{{ URL::asset('/adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin" class="logo" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                    <i class="bi bi-globe-africa" style="color: var(--primary-color); font-size: 2.5rem; display: none;"></i>
                </div>
                <h4 class="fw-bold mb-2">CULTURE BENIN</h4>
                <p class="mb-0 opacity-75">Créer votre compte</p>
            </div>
            
            <div class="register-body">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <i class="bi bi-exclamation-triangle"></i>
                Veuillez corriger les erreurs ci-dessous.
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="prenom" class="form-label">
                        <i class="bi bi-person"></i>Prénom
                    </label>
                    <div class="position-relative">
                        <input type="text" 
                            id="prenom" 
                            class="form-control" 
                            name="prenom" 
                            value="{{ old('prenom') }}" 
                            placeholder="Votre prénom"
                            required 
                            autofocus 
                            autocomplete="given-name">
                    </div>
                    @error('prenom')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nom" class="form-label">
                        <i class="bi bi-person"></i>Nom
                    </label>
                    <div class="position-relative">
                        <input type="text" 
                            id="nom" 
                            class="form-control" 
                            name="nom" 
                            value="{{ old('nom') }}" 
                            placeholder="Votre nom"
                            required 
                            autocomplete="family-name">
                    </div>
                    @error('nom')
                        <div class="error-message">
                            <i class="bi bi-exclamation-circle"></i>{{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>
        
        <div class="form-group">
            <label for="email" class="form-label">
                <i class="bi bi-envelope"></i>Adresse email
            </label>
            <div class="position-relative">
                <input type="email" 
                    id="email" 
                    class="form-control" 
                    name="email" 
                    value="{{ old('email') }}" 
                    placeholder="votre@email.com"
                    required 
                    autocomplete="email">
                <i class="bi bi-envelope input-icon"></i>
            </div>
            @error('email')
                <div class="error-message">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="form-label">
                <i class="bi bi-lock"></i>Mot de passe
            </label>
            <div class="position-relative">
                <input type="password" 
                    id="password" 
                    class="form-control" 
                    name="password" 
                    placeholder="Créez un mot de passe sécurisé"
                    required 
                    autocomplete="new-password">
                <i class="bi bi-eye password-toggle" id="togglePassword"></i>
                <i class="bi bi-key input-icon"></i>
            </div>
            @error('password')
                <div class="error-message">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password_confirmation" class="form-label">
                <i class="bi bi-lock-fill"></i>Confirmer le mot de passe
            </label>
            <div class="position-relative">
                <input type="password" 
                    id="password_confirmation" 
                    class="form-control" 
                    name="password_confirmation" 
                    placeholder="Confirmez votre mot de passe"
                    required 
                    autocomplete="new-password">
                <i class="bi bi-eye password-toggle" id="togglePasswordConfirmation"></i>
                <i class="bi bi-shield-check input-icon"></i>
            </div>
        </div>

        <!-- BOUTONS AMÉLIORÉS -->
        <div class="form-actions">
            <a href="{{ route('login') }}" class="btn-login-link">
                <i class="bi bi-arrow-left"></i>Déjà inscrit ?
            </a>
            
            <button type="submit" class="btn-register-form">
                <i class="bi bi-person-plus"></i>Créer le compte
            </button>
        </div>
    </form>
</div>

            <div class="register-footer">
                <a href="{{ route('accueil') }}" class="back-to-home">
                    <i class="bi bi-arrow-left"></i>Retour à l'accueil
                </a>
            </div>
        </div>
    </section>
    
<footer class="main-footer">
        <div class="footer-top">
            <div class="footer-brand">
                <div class="footer-logo">
                    <div class="footer-logo-img">
                        <img src="{{ URL::asset('/adminlte/img/logo-culture-benin.png') }}" alt="Culture Benin" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="logo-fallback" style="display: none;">
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
                    <a href="#" class="social-link" aria-label="Facebook">
                        <i class="bi bi-facebook"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Twitter">
                        <i class="bi bi-twitter"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="Instagram">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="YouTube">
                        <i class="bi bi-youtube"></i>
                    </a>
                    <a href="#" class="social-link" aria-label="LinkedIn">
                        <i class="bi bi-linkedin"></i>
                    </a>
                </div>
            </div>

            <div class="footer-nav">
                <h4 class="footer-heading">Navigation</h4>
                <ul class="footer-links">
                    <li><a href="#accueil" class="footer-link">Accueil</a></li>
                    <li><a href="#contenus" class="footer-link">Contenus Culturels</a></li>
                    <li><a href="#medias" class="footer-link">Galerie Médias</a></li>
                    <li><a href="#regions" class="footer-link">Régions</a></li>
                    <li><a href="#langues" class="footer-link">Langues Locales</a></li>
                </ul>
            </div>

            <div class="footer-resources">
                <h4 class="footer-heading">Ressources</h4>
                <ul class="footer-links">
                    <li><a href="#apropos" class="footer-link">À Propos</a></li>
                    <li><a href="#contact" class="footer-link">Contact</a></li>
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

            // 3. Toggle password visibility
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');
            const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
            const passwordConfirmation = document.querySelector('#password_confirmation');
            
            function setupPasswordToggle(toggleEl, inputEl) {
                if (toggleEl && inputEl) {
                    toggleEl.addEventListener('click', function() {
                        const type = inputEl.getAttribute('type') === 'password' ? 'text' : 'password';
                        inputEl.setAttribute('type', type);
                        this.classList.toggle('bi-eye');
                        this.classList.toggle('bi-eye-slash');
                    });
                }
            }

            setupPasswordToggle(togglePassword, password);
            setupPasswordToggle(togglePasswordConfirmation, passwordConfirmation);

            // 4. Défilement fluide ajusté pour le header fixe
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href');
                    const target = document.querySelector(targetId);
                    
                    if (target) {
                        const headerHeight = document.getElementById('mainHeader').offsetHeight;
                        const targetPosition = target.offsetTop - headerHeight + 1;

                        window.scrollTo({
                            top: targetPosition,
                            behavior: 'smooth'
                        });
                    }
                });
            });

        });
    </script>
</body>
</html>