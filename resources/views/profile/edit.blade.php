{{-- resources/views/profile/edit.blade.php --}}
@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 text-primary">
                <i class="bi bi-person-circle me-2"></i>Mon Profil
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i class="bi bi-house-fill me-1"></i>Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profil</li>
            </ol>
        </div>
    </div>
@endsection

@section('styles')
<style>
    /* Styles pour la page de profil */
    .profile-container {
        max-width: 1200px;
        margin: 0 auto;
    }
    
    /* En-tête du profil amélioré */
    .profile-header-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        overflow: hidden;
        margin-bottom: 30px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        position: relative;
    }
    
    .profile-header-content {
        padding: 40px;
        position: relative;
        z-index: 2;
    }
    
    .profile-bg-pattern {
        position: absolute;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23e17000' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        opacity: 0.3;
        z-index: 1;
    }
    
    .profile-avatar-section {
        display: flex;
        align-items: center;
        margin-bottom: 30px;
        gap: 30px;
    }
    
    .profile-avatar {
        width: 160px;
        height: 160px;
        border-radius: 20px;
        border: 5px solid white;
        background: white;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }
    
    .profile-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .profile-info {
        flex: 1;
    }
    
    .profile-name {
        font-size: 2.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 8px;
    }
    
    .profile-email {
        font-size: 1.1rem;
        color: #6c757d;
        margin-bottom: 15px;
    }
    
    .profile-role {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(90deg, #e17000, #ff8c00);
        color: white;
        padding: 8px 20px;
        border-radius: 50px;
        font-weight: 600;
        font-size: 0.95rem;
    }
    
    .profile-role i {
        margin-right: 8px;
    }
    
    .profile-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
        margin-top: 30px;
    }
    
    .stat-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        text-align: center;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border: 2px solid transparent;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #3498db, #2c3e50);
    }
    
    .stat-card:nth-child(2)::before {
        background: linear-gradient(90deg, #2ecc71, #27ae60);
    }
    
    .stat-card:nth-child(3)::before {
        background: linear-gradient(90deg, #f39c12, #e67e22);
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-color: #e9ecef;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: #2c3e50;
        margin-bottom: 5px;
        background: linear-gradient(45deg, #2c3e50, #34495e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    
    .stat-label {
        color: #6c757d;
        font-size: 0.95rem;
        font-weight: 500;
    }
    
    /* Cartes de formulaire */
    .profile-card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        overflow: hidden;
        margin-bottom: 30px;
        background: white;
    }
    
    .profile-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.12);
    }
    
    .profile-card-header {
        background: linear-gradient(90deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 25px 30px;
        border-bottom: 1px solid #e9ecef;
    }
    
    .profile-card-title {
        margin: 0;
        color: #2c3e50;
        font-weight: 600;
        font-size: 1.4rem;
        display: flex;
        align-items: center;
    }
    
    .profile-card-title i {
        font-size: 1.2em;
        margin-right: 12px;
    }
    
    .profile-card-body {
        padding: 35px;
    }
    
    .form-group-profile {
        margin-bottom: 30px;
    }
    
    .form-label-profile {
        font-weight: 600;
        color: #34495e;
        margin-bottom: 10px;
        display: block;
        font-size: 1rem;
    }
    
    .form-control-profile {
        border: 2px solid #e9ecef;
        border-radius: 12px;
        padding: 14px 18px;
        transition: all 0.3s ease;
        width: 100%;
        font-size: 1rem;
        background: white;
    }
    
    .form-control-profile:focus {
        border-color: #e17000;
        box-shadow: 0 0 0 3px rgba(225, 112, 0, 0.1);
        outline: none;
    }
    
    .read-only-field {
        background-color: #f8f9fa;
        padding: 14px 18px;
        border-radius: 12px;
        border: 2px solid #e9ecef;
        color: #6c757d;
        font-size: 1rem;
    }
    
    .btn-profile {
        padding: 14px 35px;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 1rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    
    .btn-profile i {
        font-size: 1.1em;
        margin-right: 8px;
    }
    
    .btn-profile-primary {
        background: linear-gradient(90deg, #e17000, #ff8c00);
        color: white;
        position: relative;
        overflow: hidden;
    }
    
    .btn-profile-primary::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-profile-primary:hover::before {
        left: 100%;
    }
    
    .btn-profile-primary:hover {
        background: linear-gradient(90deg, #ff8c00, #e17000);
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(225, 112, 0, 0.4);
    }
    
    .btn-profile-danger {
        background: linear-gradient(90deg, #e74c3c, #c0392b);
        color: white;
    }
    
    .btn-profile-danger:hover {
        background: linear-gradient(90deg, #c0392b, #e74c3c);
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(231, 76, 60, 0.4);
    }
    
    .avatar-upload {
        position: relative;
        cursor: pointer;
        display: inline-block;
        margin-top: 15px;
    }
    
    .avatar-upload input[type="file"] {
        display: none;
    }
    
    .avatar-upload-label {
        background: #e17000;
        color: white;
        padding: 12px 24px;
        border-radius: 10px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        border: none;
        font-weight: 500;
        font-size: 0.95rem;
    }
    
    .avatar-upload-label:hover {
        background: #ff8c00;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(225, 112, 0, 0.3);
    }
    
    /* Alertes */
    .alert-profile {
        padding: 18px 25px;
        border-radius: 12px;
        margin-bottom: 25px;
        border: 1px solid transparent;
        display: flex;
        align-items: center;
        animation: fadeIn 0.5s ease-out;
    }
    
    .alert-profile-success {
        background: linear-gradient(90deg, #d4edda, #c3e6cb);
        color: #155724;
        border-color: #b1dfbb;
    }
    
    .alert-profile-danger {
        background: linear-gradient(90deg, #f8d7da, #f5c6cb);
        color: #721c24;
        border-color: #f1b0b7;
    }
    
    .alert-profile i {
        font-size: 1.2em;
        margin-right: 12px;
    }
    
    .text-danger-profile {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 8px;
        font-weight: 500;
    }
    
    /* Timeline des activités */
    .activity-timeline {
        position: relative;
        padding-left: 35px;
    }
    
    .activity-timeline::before {
        content: '';
        position: absolute;
        left: 20px;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, #e17000, #008751);
    }
    
    .activity-item {
        position: relative;
        margin-bottom: 25px;
        padding: 25px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        border-left: 4px solid #e17000;
        transition: all 0.3s ease;
    }
    
    .activity-item:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }
    
    .activity-item::before {
        content: '';
        position: absolute;
        left: -32px;
        top: 30px;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: #e17000;
        border: 4px solid white;
        box-shadow: 0 0 0 4px rgba(225, 112, 0, 0.2);
    }
    
    .activity-icon {
        width: 50px;
        height: 50px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        margin-right: 20px;
    }
    
    /* Barre de force du mot de passe */
    .password-strength {
        height: 6px;
        border-radius: 3px;
        margin-top: 8px;
        background: #e9ecef;
        overflow: hidden;
        position: relative;
    }
    
    .password-strength-bar {
        height: 100%;
        width: 0%;
        transition: all 0.4s ease;
        position: absolute;
        left: 0;
        top: 0;
    }
    
    .strength-weak {
        background: linear-gradient(90deg, #e74c3c, #c0392b);
    }
    
    .strength-medium {
        background: linear-gradient(90deg, #f39c12, #e67e22);
    }
    
    .strength-strong {
        background: linear-gradient(90deg, #2ecc71, #27ae60);
    }
    
    /* Modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        align-items: center;
        justify-content: center;
        z-index: 9999;
        animation: fadeIn 0.3s ease-out;
    }
    
    .modal-content {
        background: white;
        border-radius: 20px;
        padding: 40px;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 20px 50px rgba(0,0,0,0.3);
        animation: slideUp 0.4s ease-out;
    }
    
    /* Spinner */
    .spinner-border-profile {
        display: inline-block;
        width: 2.5rem;
        height: 2.5rem;
        border: 0.3em solid currentColor;
        border-right-color: transparent;
        border-radius: 50%;
        animation: spinner-border .75s linear infinite;
    }
    
    /* Toast */
    .toast-profile {
        position: fixed;
        top: 30px;
        right: 30px;
        z-index: 9999;
        padding: 20px 25px;
        border-radius: 12px;
        color: white;
        font-weight: 500;
        animation: slideInRight 0.4s ease-out;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
        min-width: 300px;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255,255,255,0.1);
    }
    
    .toast-success {
        background: linear-gradient(90deg, rgba(46, 204, 113, 0.9), rgba(39, 174, 96, 0.9));
    }
    
    .toast-error {
        background: linear-gradient(90deg, rgba(231, 76, 60, 0.9), rgba(192, 57, 43, 0.9));
    }
    
    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideUp {
        from { transform: translateY(50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    @keyframes slideInRight {
        from { transform: translateX(100%); opacity: 0; }
        to { transform: translateX(0); opacity: 1; }
    }
    
    @keyframes spinner-border {
        to { transform: rotate(360deg); }
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .profile-avatar-section {
            flex-direction: column;
            text-align: center;
            gap: 20px;
        }
        
        .profile-stats {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 768px) {
        .profile-header-content {
            padding: 30px;
        }
        
        .profile-avatar {
            width: 140px;
            height: 140px;
        }
        
        .profile-stats {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        
        .profile-card-body {
            padding: 25px;
        }
        
        .profile-card-header {
            padding: 20px;
        }
    }
</style>
@endsection

@section('content')
<div class="profile-container">
    <!-- Messages d'alerte -->
    @if(session('success'))
    <div class="alert-profile alert-profile-success">
        <i class="bi bi-check-circle-fill"></i>
        {{ session('success') }}
    </div>
    @endif
    
    @if($errors->any())
    <div class="alert-profile alert-profile-danger">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div>
            @foreach($errors->all() as $error)
                <div>{{ $error }}</div>
            @endforeach
        </div>
    </div>
    @endif

    <!-- En-tête du profil -->
    <div class="profile-header-card">
        <div class="profile-bg-pattern"></div>
        <div class="profile-header-content">
            <div class="profile-avatar-section">
                <div class="profile-avatar">
                    @if(auth()->user()->avatar)
                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="{{ auth()->user()->name }}" id="avatarImage">
                    @else
                        <img src="{{ URL::asset('/adminlte/img/user2-160x160.jpg') }}" alt="{{ auth()->user()->name }}" id="avatarImage">
                    @endif
                </div>
                
                <div class="profile-info">
                    <h1 class="profile-name">{{ auth()->user()->name }}</h1>
                    <p class="profile-email">{{ auth()->user()->email }}</p>
                    
                    @if(auth()->user()->role)
                        <span class="profile-role">
                            <i class="bi bi-shield-check"></i>
                            {{ auth()->user()->role->nom_role }}
                        </span>
                    @else
                        <span class="profile-role">
                            <i class="bi bi-person-badge"></i>
                            Utilisateur
                        </span>
                    @endif
                    
                    <div class="avatar-upload mt-3">
                        <input type="file" id="avatarInput" accept="image/*">
                        <label for="avatarInput" class="avatar-upload-label">
                            <i class="bi bi-camera"></i> Changer la photo
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Statistiques -->
            <div class="profile-stats">
                <div class="stat-card">
                    <div class="stat-number">
                        @php
                            $contentCount = \App\Models\Contenu::where('id_auteur', auth()->id())->count();
                        @endphp
                        {{ $contentCount }}
                    </div>
                    <div class="stat-label">Contenus créés</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-number">
                        @php
                            $mediaCount = \App\Models\Media::where('id_utilisateur', auth()->id())->count();
                        @endphp
                        {{ $mediaCount }}
                    </div>
                    <div class="stat-label">Médias uploadés</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-number">
                        @php
                            $commentCount = \App\Models\Commentaire::where('id_utilisateur', auth()->id())->count();
                        @endphp
                        {{ $commentCount }}
                    </div>
                    <div class="stat-label">Commentaires</div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Informations personnelles -->
        <div class="col-lg-6 mb-4">
            <div class="profile-card">
                <div class="profile-card-header">
                    <h3 class="profile-card-title">
                        <i class="bi bi-person-circle"></i>Informations Personnelles
                    </h3>
                </div>
                <div class="profile-card-body">
                    <form method="POST" action="{{ route('profile.update') }}" id="profileForm">
                        @csrf
                        @method('PATCH')
                        
                        <div class="form-group-profile">
                            <label class="form-label-profile">Nom complet</label>
                            <input type="text" name="name" value="{{ old('name', auth()->user()->name) }}" 
                                   class="form-control-profile @error('name') is-invalid @enderror" required>
                            @error('name')
                                <div class="text-danger-profile">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group-profile">
                            <label class="form-label-profile">Email</label>
                            <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" 
                                   class="form-control-profile @error('email') is-invalid @enderror" required>
                            @error('email')
                                <div class="text-danger-profile">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group-profile">
                            <label class="form-label-profile">Date d'inscription</label>
                            <div class="read-only-field">
                                {{ auth()->user()->created_at->format('d/m/Y à H:i') }}
                            </div>
                        </div>
                        
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn-profile btn-profile-primary">
                                <i class="bi bi-check-circle"></i>Enregistrer les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Changer le mot de passe -->
        <div class="col-lg-6 mb-4">
            <div class="profile-card">
                <div class="profile-card-header">
                    <h3 class="profile-card-title">
                        <i class="bi bi-shield-lock"></i>Sécurité du compte
                    </h3>
                </div>
                <div class="profile-card-body">
                    <form method="POST" action="{{ route('password.update') }}" id="passwordForm">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group-profile">
                            <label class="form-label-profile">Mot de passe actuel</label>
                            <input type="password" name="current_password" 
                                   class="form-control-profile @error('current_password') is-invalid @enderror">
                            @error('current_password')
                                <div class="text-danger-profile">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group-profile">
                            <label class="form-label-profile">Nouveau mot de passe</label>
                            <input type="password" name="password" id="password"
                                   class="form-control-profile @error('password') is-invalid @enderror">
                            <div class="password-strength">
                                <div class="password-strength-bar" id="passwordStrengthBar"></div>
                            </div>
                            @error('password')
                                <div class="text-danger-profile">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group-profile">
                            <label class="form-label-profile">Confirmer le mot de passe</label>
                            <input type="password" name="password_confirmation" 
                                   class="form-control-profile">
                        </div>
                        
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn-profile btn-profile-primary">
                                <i class="bi bi-key"></i>Changer le mot de passe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Dernières activités -->
        <div class="col-12">
            <div class="profile-card">
                <div class="profile-card-header">
                    <h3 class="profile-card-title">
                        <i class="bi bi-activity"></i>Activités Récentes
                    </h3>
                </div>
                <div class="profile-card-body">
                    <div class="activity-timeline">
                        @php
                            $activities = collect();
                            
                            // Contenus récents
                            $yourContents = \App\Models\Contenu::where('id_auteur', auth()->id())
                                ->orderBy('created_at', 'desc')
                                ->take(3)
                                ->get()
                                ->map(function($content) {
                                    return [
                                        'type' => 'contenu',
                                        'icon' => 'bi-file-text',
                                        'color' => '#2ecc71',
                                        'title' => 'Contenu créé',
                                        'description' => Illuminate\Support\Str::limit($content->titre, 60),
                                        'time' => $content->created_at->diffForHumans()
                                    ];
                                });
                            
                            // Médias récents
                            $yourMedias = \App\Models\Media::where('id_utilisateur', auth()->id())
                                ->orderBy('created_at', 'desc')
                                ->take(2)
                                ->get()
                                ->map(function($media) {
                                    return [
                                        'type' => 'media',
                                        'icon' => 'bi-image',
                                        'color' => '#f39c12',
                                        'title' => 'Média uploadé',
                                        'description' => Illuminate\Support\Str::limit($media->description, 50),
                                        'time' => $media->created_at->diffForHumans()
                                    ];
                                });
                            
                            $activities = $yourContents->merge($yourMedias)
                                ->sortByDesc(function($item) {
                                    return $item['time'];
                                })
                                ->take(4);
                        @endphp
                        
                        @forelse($activities as $activity)
                        <div class="activity-item">
                            <div class="d-flex align-items-start">
                                <div class="activity-icon" style="background: {{ $activity['color'] }}20; color: {{ $activity['color'] }};">
                                    <i class="bi {{ $activity['icon'] }}"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1 fw-semibold" style="color: #2c3e50;">{{ $activity['title'] }}</h6>
                                    <p class="mb-2" style="color: #34495e;">{{ $activity['description'] }}</p>
                                    <small class="text-muted d-flex align-items-center">
                                        <i class="bi bi-clock me-2"></i>{{ $activity['time'] }}
                                    </small>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-4">
                            <i class="bi bi-inbox display-4 text-muted opacity-50 mb-3"></i>
                            <p class="text-muted mb-0">Aucune activité récente</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Section supprimer le compte -->
        <div class="col-12">
            <div class="profile-card">
                <div class="profile-card-header">
                    <h3 class="profile-card-title">
                        <i class="bi bi-trash"></i>Zone de danger
                    </h3>
                </div>
                <div class="profile-card-body">
                    <p class="text-muted mb-4">
                        <i class="bi bi-exclamation-triangle text-warning me-2"></i>
                        Une fois votre compte supprimé, toutes vos données seront définitivement effacées.
                        Cette action est irréversible.
                    </p>
                    <button type="button" onclick="openDeleteModal()" class="btn-profile btn-profile-danger">
                        <i class="bi bi-trash"></i>Supprimer mon compte
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de suppression -->
<div id="deleteModal" class="modal-overlay">
    <div class="modal-content">
        <div class="text-center mb-4">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                <i class="bi bi-exclamation-triangle-fill text-red-600 text-3xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Supprimer le compte</h3>
            <p class="text-gray-600 mb-6">
                Êtes-vous sûr de vouloir supprimer votre compte ? 
                Cette action est irréversible et supprimera toutes vos données.
            </p>
        </div>
        
        <form method="POST" action="{{ route('profile.destroy') }}" id="deleteForm">
            @csrf
            @method('DELETE')
            
            <div class="mb-5">
                <label class="form-label-profile mb-3">Mot de passe de confirmation</label>
                <input type="password" name="password" 
                       class="form-control-profile" 
                       placeholder="Entrez votre mot de passe pour confirmer" required>
                @error('password')
                    <div class="text-danger-profile">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex gap-3 justify-content-end">
                <button type="button" onclick="closeDeleteModal()" 
                        class="btn-profile" style="background: #6c757d; color: white;">
                    Annuler
                </button>
                <button type="submit" class="btn-profile btn-profile-danger">
                    Supprimer définitivement
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function() {
    // Validation du mot de passe avec barre de force
    $('#password').on('input', function() {
        var password = $(this).val();
        var strengthBar = $('#passwordStrengthBar');
        
        if (password.length === 0) {
            strengthBar.css('width', '0%').removeClass('strength-weak strength-medium strength-strong');
            return;
        }
        
        var strength = 0;
        if (password.length >= 8) strength++;
        if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength++;
        if (password.match(/\d/)) strength++;
        if (password.match(/[^a-zA-Z\d]/)) strength++;
        
        var width = (strength / 4) * 100;
        strengthBar.css('width', width + '%');
        
        strengthBar.removeClass('strength-weak strength-medium strength-strong');
        if (strength <= 1) {
            strengthBar.addClass('strength-weak');
        } else if (strength <= 2) {
            strengthBar.addClass('strength-medium');
        } else {
            strengthBar.addClass('strength-strong');
        }
    });
    
    // Upload d'avatar
    $('#avatarInput').on('change', function() {
        if (this.files && this.files[0]) {
            var formData = new FormData();
            formData.append('avatar', this.files[0]);
            formData.append('_token', '{{ csrf_token() }}');
            
            // Afficher un indicateur de chargement
            var avatarElement = $('.profile-avatar');
            var originalContent = avatarElement.html();
            avatarElement.html('<div class="spinner-border-profile text-primary" style="width: 80px; height: 80px;"></div>');
            
            $.ajax({
                url: '{{ route("profile.avatar.update") }}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        // Mettre à jour l'image de l'avatar
                        avatarElement.html('<img src="' + response.avatar_url + '" alt="{{ auth()->user()->name }}" id="avatarImage">');
                        showToast('Avatar mis à jour avec succès !', 'success');
                    } else {
                        avatarElement.html(originalContent);
                        showToast(response.message || 'Erreur', 'error');
                    }
                },
                error: function(xhr) {
                    avatarElement.html(originalContent);
                    var message = 'Erreur lors du téléchargement';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        message = xhr.responseJSON.message;
                    }
                    showToast(message, 'error');
                }
            });
        }
    });
    
    // Animation des cartes
    $('.profile-card').each(function(index) {
        $(this).css('animation-delay', (index * 0.1) + 's');
    });
    
    // Confirmation avant soumission du formulaire de mot de passe
    $('#passwordForm').on('submit', function(e) {
        if (!confirm('Êtes-vous sûr de vouloir changer votre mot de passe ?')) {
            e.preventDefault();
        }
    });
    
    // Fonctions pour la modal de suppression
    window.openDeleteModal = function() {
        $('#deleteModal').fadeIn(300);
        $('body').css('overflow', 'hidden');
    }
    
    window.closeDeleteModal = function() {
        $('#deleteModal').fadeOut(300);
        $('body').css('overflow', 'auto');
        $('#deleteForm input[name="password"]').val('');
    }
    
    // Fermer la modal en cliquant à l'extérieur
    $(document).on('click', function(e) {
        if ($(e.target).hasClass('modal-overlay')) {
            closeDeleteModal();
        }
    });
    
    // Fonction pour afficher les toasts
    function showToast(message, type) {
        // Supprimer les anciens toasts
        $('.toast-profile').remove();
        
        // Créer un nouveau toast
        var toast = $('<div class="toast-profile toast-' + type + '"></div>');
        toast.html('<div class="d-flex align-items-center"><i class="bi ' + 
                   (type === 'success' ? 'bi-check-circle' : 'bi-exclamation-triangle') + 
                   ' me-3" style="font-size: 1.3em;"></i><span>' + message + '</span></div>');
        
        $('body').append(toast);
        
        // Supprimer après 5 secondes
        setTimeout(function() {
            toast.animate({
                opacity: 0,
                right: '-100%'
            }, 300, function() {
                $(this).remove();
            });
        }, 5000);
    }
    
    // Afficher les messages de session existants
    @if(session('status') === 'profile-updated')
        showToast('Profil mis à jour avec succès !', 'success');
    @endif
    
    @if(session('status') === 'password-updated')
        showToast('Mot de passe mis à jour avec succès !', 'success');
    @endif
});
</script>
@endsection