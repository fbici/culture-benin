@extends('layouts.app')

@section('title', 'Créer un contenu - Culture Benin')

@section('content')
<div class="creation-container-premium">
    <!-- Navigation Hero -->
    <div class="creation-hero-section mb-6">
        <div class="hero-background"></div>
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <div class="row align-items-center">
                <div class="col-lg-8">
                    <div class="hero-icon-wrapper">
                        <i class="bi bi-journal-plus"></i>
                        <div class="icon-glow"></div>
                    </div>
                    <h1 class="hero-title">Créer un contenu</h1>
                    <p class="hero-subtitle">
                        Partagez votre savoir et contribuez à la richesse culturelle du Bénin
                    </p>
                </div>
                <div class="col-lg-4 text-end">
                    <a href="{{ route('user.contenus.index') }}" class="btn-hero-back">
                        <i class="bi bi-arrow-left-circle me-2"></i>
                        Retour aux contenus
                    </a>
                </div>
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" fill="currentColor"></path>
                <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35,6.36,119.13-6.25,37.73-12.56,74.29-35.79,111-52.34,43.75-20.29,87.93-40.76,131.08-60.27,43.15-19.51,86.3-39,129.45-58.48,43.15-19.49,86.3-38.98,129.45-58.46V0Z" opacity=".5" fill="currentColor"></path>
                <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>

    <!-- Formulaire Premium -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <!-- Guide de création -->
                <div class="creation-guide-card mb-5">
                    <div class="guide-header">
                        <i class="bi bi-lightbulb-fill guide-icon"></i>
                        <h4>Guide de création</h4>
                    </div>
                    <div class="guide-content">
                        <div class="guide-steps">
                            <div class="step-item active">
                                <div class="step-number">1</div>
                                <div class="step-content">
                                    <h6>Informations de base</h6>
                                    <p>Renseignez le titre et les catégories</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">2</div>
                                <div class="step-content">
                                    <h6>Contenu détaillé</h6>
                                    <p>Rédigez le contenu principal</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">3</div>
                                <div class="step-content">
                                    <h6>Médias associés</h6>
                                    <p>Ajoutez des illustrations</p>
                                </div>
                            </div>
                            <div class="step-item">
                                <div class="step-number">4</div>
                                <div class="step-content">
                                    <h6>Publication</h6>
                                    <p>Finalisez et publiez</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Formulaire Principal -->
                <div class="creation-form-premium">
                    @if ($errors->any())
                    <div class="alert-error-premium mb-4">
                        <div class="alert-icon">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                        </div>
                        <div class="alert-content">
                            <h5>Des erreurs sont présentes</h5>
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @endif
                    
                    <form action="{{ route('user.contenus.store') }}" method="POST" enctype="multipart/form-data" id="creationForm">
                        @csrf
                        
                        <!-- Étape 1: Informations de base -->
                        <div class="form-step active" id="step1">
                            <div class="step-header">
                                <div class="step-icon">
                                    <i class="bi bi-info-circle-fill"></i>
                                </div>
                                <div class="step-title">
                                    <h3>Informations de base</h3>
                                    <p>Définissez les informations principales de votre contenu</p>
                                </div>
                            </div>
                            
                            <div class="step-content">
                                <div class="row g-4">
                                    <!-- Titre -->
                                    <div class="col-12">
                                        <div class="form-group-premium">
                                            <label class="form-label-premium">
                                                <i class="bi bi-type form-icon"></i>
                                                Titre du contenu
                                                <span class="required-star">*</span>
                                            </label>
                                            <div class="input-wrapper">
                                                <input type="text" 
                                                    class="form-input-premium @error('titre') is-invalid @enderror" 
                                                    id="titre" 
                                                    name="titre" 
                                                    value="{{ old('titre') }}" 
                                                    placeholder="Donnez un titre accrocheur à votre contenu"
                                                    required
                                                    data-next-step="step2">
                                                <div class="input-focus-border"></div>
                                            </div>
                                            @error('titre')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                            <div class="form-hint">
                                                <i class="bi bi-info-circle"></i>
                                                Un bon titre attire l'attention et résume le contenu
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <!-- Catégories -->
                                    <div class="col-md-4">
                                        <div class="form-group-premium">
                                            <label class="form-label-premium">
                                                <i class="bi bi-tag-fill form-icon"></i>
                                                Type de contenu
                                                <span class="required-star">*</span>
                                            </label>
                                            <div class="select-wrapper">
                                                <select class="form-select-premium @error('id_type') is-invalid @enderror" 
                                                    id="id_type" 
                                                    name="id_type_contenu" 
                                                    required>
                                                    <option value="">Choisir un type</option>
                                                    @foreach($types as $type)
                                                        <option value="{{ $type->id_type }}" {{ old('id_type') == $type->id_type ? 'selected' : '' }}>
                                                            {{ $type->nom }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <i class="bi bi-chevron-down select-arrow"></i>
                                            </div>
                                            @error('id_type')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group-premium">
                                            <label class="form-label-premium">
                                                <i class="bi bi-geo-alt-fill form-icon"></i>
                                                Région
                                                <span class="required-star">*</span>
                                            </label>
                                            <div class="select-wrapper">
                                                <select class="form-select-premium @error('id_region') is-invalid @enderror" 
                                                    id="id_region" 
                                                    name="id_region" 
                                                    required>
                                                    <option value="">Choisir une région</option>
                                                    @foreach($regions as $region)
                                                        <option value="{{ $region->id_region }}" {{ old('id_region') == $region->id_region ? 'selected' : '' }}>
                                                            {{ $region->nom_region }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <i class="bi bi-chevron-down select-arrow"></i>
                                            </div>
                                            @error('id_region')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group-premium">
                                            <label class="form-label-premium">
                                                <i class="bi bi-translate form-icon"></i>
                                                Langue
                                                <span class="required-star">*</span>
                                            </label>
                                            <div class="select-wrapper">
                                                <select class="form-select-premium @error('id_langue') is-invalid @enderror" 
                                                    id="id_langue" 
                                                    name="id_langue" 
                                                    required>
                                                    <option value="">Choisir une langue</option>
                                                    @foreach($langues as $langue)
                                                        <option value="{{ $langue->id_langue }}" {{ old('id_langue') == $langue->id_langue ? 'selected' : '' }}>
                                                            {{ $langue->nom_langue }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <i class="bi bi-chevron-down select-arrow"></i>
                                            </div>
                                            @error('id_langue')
                                                <div class="form-error">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <!-- Après le champ langue, ajoutez : -->
<div class="col-12 mt-3">
    <div class="form-group-premium">
        <label class="form-label-premium">
            <i class="bi bi-shield-check form-icon"></i>
            Statut du contenu
            <span class="required-star">*</span>
        </label>
        <div class="select-wrapper">
            <select class="form-select-premium @error('statut') is-invalid @enderror" 
                id="statut" 
                name="statut" 
                required>
                <option value="">Choisir un statut</option>
                <option value="brouillon" {{ old('statut') == 'brouillon' ? 'selected' : '' }}>Brouillon</option>
                <option value="en_attente" {{ old('statut') == 'en_attente' ? 'selected' : '' }}>En attente de validation</option>
                <option value="publie" {{ old('statut') == 'publie' ? 'selected' : '' }}>Publié</option>
            </select>
            <i class="bi bi-chevron-down select-arrow"></i>
        </div>
        @error('statut')
            <div class="form-error">{{ $message }}</div>
        @enderror
        <div class="form-hint">
            <i class="bi bi-info-circle"></i>
            "Brouillon" pour continuer plus tard, "En attente" pour soumettre à la modération
        </div>
    </div>
</div>
                                </div>
                            </div>
                            
                            <div class="step-actions">
                                <button type="button" class="btn-step-next" onclick="nextStep('step2')">
                                    Suivant
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Étape 2: Contenu détaillé -->
                        <div class="form-step" id="step2">
                            <div class="step-header">
                                <div class="step-icon">
                                    <i class="bi bi-file-text-fill"></i>
                                </div>
                                <div class="step-title">
                                    <h3>Contenu détaillé</h3>
                                    <p>Rédigez le contenu principal avec soin</p>
                                </div>
                            </div>
                            
                            <div class="step-content">
                                <div class="form-group-premium">
                                    <label class="form-label-premium">
                                        <i class="bi bi-pencil-fill form-icon"></i>
                                        Contenu
                                        <span class="required-star">*</span>
                                    </label>
                                    
                                    <!-- Barre d'outils éditeur -->
                                    <div class="editor-toolbar-premium">
                                        <div class="toolbar-group">
                                            <button type="button" class="toolbar-btn" data-command="bold" title="Gras">
                                                <i class="bi bi-type-bold"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="italic" title="Italique">
                                                <i class="bi bi-type-italic"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="underline" title="Souligné">
                                                <i class="bi bi-type-underline"></i>
                                            </button>
                                        </div>
                                        <div class="toolbar-group">
                                            <button type="button" class="toolbar-btn" data-command="insertUnorderedList" title="Liste à puces">
                                                <i class="bi bi-list-ul"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="insertOrderedList" title="Liste numérotée">
                                                <i class="bi bi-list-ol"></i>
                                            </button>
                                        </div>
                                        <div class="toolbar-group">
                                            <select class="heading-select" onchange="formatHeading(this.value)">
                                                <option value="">Titre...</option>
                                                <option value="h1">Titre 1</option>
                                                <option value="h2">Titre 2</option>
                                                <option value="h3">Titre 3</option>
                                            </select>
                                        </div>
                                        <div class="toolbar-group">
                                            <button type="button" class="toolbar-btn" data-command="createLink" title="Lien">
                                                <i class="bi bi-link"></i>
                                            </button>
                                            <button type="button" class="toolbar-btn" data-command="unlink" title="Supprimer lien">
                                                <i class="bi bi-link-45deg"></i>
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <!-- Éditeur -->
                                    <div class="editor-wrapper">
                                        <div class="editor-content" 
                                             id="editor" 
                                             contenteditable="true"
                                             data-placeholder="Commencez à rédiger votre contenu ici...">
                                            {!! old('texte') !!}
                                        </div>
                                        <textarea class="d-none" 
                                            id="texte" 
                                            name="texte" 
                                            required>{{ old('texte') }}</textarea>
                                    </div>
                                    
                                    <!-- Statistiques -->
                                    <div class="editor-stats">
                                        <div class="stat-item">
                                            <i class="bi bi-text-left"></i>
                                            <span id="wordCount">0</span> mots
                                        </div>
                                        <div class="stat-item">
                                            <i class="bi bi-clock"></i>
                                            <span id="readTime">0</span> min de lecture
                                        </div>
                                        <div class="stat-item">
                                            <i class="bi bi-hash"></i>
                                            <span id="charCount">0</span> caractères
                                        </div>
                                    </div>
                                    
                                    @error('texte')
                                        <div class="form-error">{{ $message }}</div>
                                    @enderror
                                    
                                    <div class="form-hint">
                                        <i class="bi bi-lightbulb"></i>
                                        Utilisez des titres, des listes et des images pour rendre votre contenu plus attrayant
                                    </div>
                                </div>
                            </div>
                            
                            <div class="step-actions">
                                <button type="button" class="btn-step-prev" onclick="prevStep('step1')">
                                    <i class="bi bi-arrow-left me-2"></i>
                                    Précédent
                                </button>
                                <button type="button" class="btn-step-next" onclick="nextStep('step3')">
                                    Suivant
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Étape 3: Médias associés -->
                        <div class="form-step" id="step3">
                            <div class="step-header">
                                <div class="step-icon">
                                    <i class="bi bi-images"></i>
                                </div>
                                <div class="step-title">
                                    <h3>Médias associés</h3>
                                    <p>Illustrez votre contenu avec des images et vidéos</p>
                                </div>
                            </div>
                            
                            <div class="step-content">
                                <!-- Section pour différents types de médias -->
                                <div class="media-sections">
                                    <!-- Image Principale -->
                                    <div class="media-section mb-4">
                                        <div class="section-header mb-3">
                                            <h5 class="fw-bold">
                                                <i class="bi bi-image-fill me-2 text-primary"></i>
                                                Image Principale
                                                <small class="text-muted fs-6">(Recommandée)</small>
                                            </h5>
                                            <p class="text-muted mb-0">L'image qui sera affichée en entête de votre contenu</p>
                                        </div>
                                        
                                        <div class="upload-zone-simple" id="imagePrincipaleZone">
                                            <div class="upload-icon">
                                                <i class="bi bi-cloud-arrow-up fs-1"></i>
                                            </div>
                                            <p class="mb-2">Cliquez pour sélectionner une image</p>
                                            <input type="file" 
                                                class="d-none" 
                                                id="image_principale" 
                                                name="image_principale" 
                                                accept="image/*"
                                                onchange="previewSingleFile(this, 'imagePrincipalePreview')">
                                            <button type="button" class="btn btn-outline-primary btn-sm" onclick="document.getElementById('image_principale').click()">
                                                <i class="bi bi-upload me-2"></i>Choisir une image
                                            </button>
                                            <p class="upload-info mt-2">
                                                <small><i class="bi bi-info-circle me-1"></i>Formats: JPG, PNG, GIF - Max: 2MB</small>
                                            </p>
                                        </div>
                                        
                                        <div id="imagePrincipalePreview" class="media-preview-single mt-3"></div>
                                    </div>
                                    
                                    <!-- Images Supplémentaires -->
                                    <div class="media-section mb-4">
                                        <div class="section-header mb-3">
                                            <h5 class="fw-bold">
                                                <i class="bi bi-images me-2 text-success"></i>
                                                Images Supplémentaires
                                            </h5>
                                            <p class="text-muted mb-0">Ajoutez d'autres images à votre contenu</p>
                                        </div>
                                        
                                        <div class="upload-zone-simple" id="imagesZone">
                                            <div class="upload-icon">
                                                <i class="bi bi-cloud-arrow-up-fill fs-1"></i>
                                            </div>
                                            <p class="mb-2">Glissez-déposez ou cliquez pour sélectionner</p>
                                            <input type="file" 
                                                class="d-none" 
                                                id="images" 
                                                name="images[]" 
                                                multiple 
                                                accept="image/*"
                                                onchange="previewMultipleFiles(this, 'imagesPreview')">
                                            <button type="button" class="btn btn-outline-success btn-sm" onclick="document.getElementById('images').click()">
                                                <i class="bi bi-plus-circle me-2"></i>Sélectionner plusieurs images
                                            </button>
                                            <p class="upload-info mt-2">
                                                <small><i class="bi bi-info-circle me-1"></i>Vous pouvez sélectionner plusieurs images à la fois</small>
                                            </p>
                                        </div>
                                        
                                        <div id="imagesPreview" class="media-preview-grid mt-3"></div>
                                    </div>
                                    
                                    <!-- Vidéo -->
                                    <div class="media-section mb-4">
                                        <div class="section-header mb-3">
                                            <h5 class="fw-bold">
                                                <i class="bi bi-camera-video-fill me-2 text-danger"></i>
                                                Vidéo
                                            </h5>
                                            <p class="text-muted mb-0">Ajoutez une vidéo à votre contenu</p>
                                        </div>
                                        
                                        <div class="upload-zone-simple" id="videoZone">
                                            <div class="upload-icon">
                                                <i class="bi bi-file-earmark-play fs-1"></i>
                                            </div>
                                            <p class="mb-2">Sélectionnez une vidéo</p>
                                            <input type="file" 
                                                class="d-none" 
                                                id="video" 
                                                name="video" 
                                                accept="video/*"
                                                onchange="previewSingleFile(this, 'videoPreview')">
                                            <button type="button" class="btn btn-outline-danger btn-sm" onclick="document.getElementById('video').click()">
                                                <i class="bi bi-upload me-2"></i>Choisir une vidéo
                                            </button>
                                            <p class="upload-info mt-2">
                                                <small><i class="bi bi-info-circle me-1"></i>Formats: MP4, AVI, MOV - Max: 5MB</small>
                                            </p>
                                        </div>
                                        
                                        <div id="videoPreview" class="media-preview-single mt-3"></div>
                                    </div>
                                    
                                    <!-- Audio -->
                                    <div class="media-section mb-4">
                                        <div class="section-header mb-3">
                                            <h5 class="fw-bold">
                                                <i class="bi bi-music-note-beamed me-2 text-warning"></i>
                                                Audio
                                            </h5>
                                            <p class="text-muted mb-0">Ajoutez un fichier audio</p>
                                        </div>
                                        
                                        <div class="upload-zone-simple" id="audioZone">
                                            <div class="upload-icon">
                                                <i class="bi bi-file-earmark-music fs-1"></i>
                                            </div>
                                            <p class="mb-2">Sélectionnez un fichier audio</p>
                                            <input type="file" 
                                                class="d-none" 
                                                id="audio" 
                                                name="audio" 
                                                accept="audio/*"
                                                onchange="previewSingleFile(this, 'audioPreview')">
                                            <button type="button" class="btn btn-outline-warning btn-sm" onclick="document.getElementById('audio').click()">
                                                <i class="bi bi-upload me-2"></i>Choisir un audio
                                            </button>
                                            <p class="upload-info mt-2">
                                                <small><i class="bi bi-info-circle me-1"></i>Formats: MP3, WAV - Max: 5MB</small>
                                            </p>
                                        </div>
                                        
                                        <div id="audioPreview" class="media-preview-single mt-3"></div>
                                    </div>
                                    
                                    <!-- Document -->
                                    <div class="media-section">
                                        <div class="section-header mb-3">
                                            <h5 class="fw-bold">
                                                <i class="bi bi-file-earmark-text-fill me-2 text-info"></i>
                                                Document
                                            </h5>
                                            <p class="text-muted mb-0">Ajoutez un document complémentaire</p>
                                        </div>
                                        
                                        <div class="upload-zone-simple" id="documentZone">
                                            <div class="upload-icon">
                                                <i class="bi bi-file-earmark-text fs-1"></i>
                                            </div>
                                            <p class="mb-2">Sélectionnez un document</p>
                                            <input type="file" 
                                                class="d-none" 
                                                id="document" 
                                                name="document" 
                                                accept=".pdf,.doc,.docx"
                                                onchange="previewSingleFile(this, 'documentPreview')">
                                            <button type="button" class="btn btn-outline-info btn-sm" onclick="document.getElementById('document').click()">
                                                <i class="bi bi-upload me-2"></i>Choisir un document
                                            </button>
                                            <p class="upload-info mt-2">
                                                <small><i class="bi bi-info-circle me-1"></i>Formats: PDF, DOC, DOCX - Max: 5MB</small>
                                            </p>
                                        </div>
                                        
                                        <div id="documentPreview" class="media-preview-single mt-3"></div>
                                    </div>
                                </div>
                                
                                <!-- Media Guidelines -->
                                <div class="guidelines-card mt-4">
                                    <div class="guidelines-header">
                                        <i class="bi bi-check-circle-fill"></i>
                                        <h5>Recommandations pour les médias</h5>
                                    </div>
                                    <ul class="guidelines-list">
                                        <li>
                                            <i class="bi bi-check text-success"></i>
                                            Images principale: 1200x630px (ratio 16:9)
                                        </li>
                                        <li>
                                            <i class="bi bi-check text-success"></i>
                                            Compressez les images pour un chargement rapide
                                        </li>
                                        <li>
                                            <i class="bi bi-check text-success"></i>
                                            Respectez les droits d'auteur et créditez les sources
                                        </li>
                                        <li>
                                            <i class="bi bi-check text-success"></i>
                                            Les vidéos doivent être de bonne qualité mais légères
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="step-actions">
                                <button type="button" class="btn-step-prev" onclick="prevStep('step2')">
                                    <i class="bi bi-arrow-left me-2"></i>
                                    Précédent
                                </button>
                                <button type="button" class="btn-step-next" onclick="nextStep('step4')">
                                    Suivant
                                    <i class="bi bi-arrow-right ms-2"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Étape 4: Finalisation -->
                        <div class="form-step" id="step4">
                            <div class="step-header">
                                <div class="step-icon">
                                    <i class="bi bi-send-check-fill"></i>
                                </div>
                                <div class="step-title">
                                    <h3>Finalisation</h3>
                                    <p>Revisez et publiez votre contenu</p>
                                </div>
                            </div>
                            
                            <div class="step-content">
                                <!-- Récapitulatif -->
                                <div class="summary-card mb-4">
                                    <div class="summary-header">
                                        <i class="bi bi-clipboard-check"></i>
                                        <h5>Récapitulatif</h5>
                                    </div>
                                    <div class="summary-content">
                                        <div class="summary-item">
                                            <span class="summary-label">Titre :</span>
                                            <span id="summaryTitle" class="summary-value">-</span>
                                        </div>
                                        <div class="summary-item">
                                            <span class="summary-label">Type :</span>
                                            <span id="summaryType" class="summary-value">-</span>
                                        </div>
                                        <div class="summary-item">
                                            <span class="summary-label">Région :</span>
                                            <span id="summaryRegion" class="summary-value">-</span>
                                        </div>
                                        <div class="summary-item">
                                            <span class="summary-label">Langue :</span>
                                            <span id="summaryLangue" class="summary-value">-</span>
                                        </div>
                                        <div class="summary-item">
                                            <span class="summary-label">Longueur :</span>
                                            <span id="summaryLength" class="summary-value">-</span>
                                        </div>
                                        <div class="summary-item">
                                            <span class="summary-label">Médias :</span>
                                            <span id="summaryMedias" class="summary-value">-</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Options de publication -->
                                <div class="publication-options">
                                    <h5 class="mb-3">Options de publication</h5>
                                    <div class="options-grid">
                                        <div class="option-card" data-action="draft">
                                            <div class="option-icon">
                                                <i class="bi bi-save"></i>
                                            </div>
                                            <div class="option-content">
                                                <h6>Enregistrer comme brouillon</h6>
                                                <p>Conservez votre travail pour continuer plus tard</p>
                                            </div>
                                            <div class="option-selector">
                                                <div class="selector-dot"></div>
                                            </div>
                                        </div>
                                        <div class="option-card" data-action="publish">
                                            <div class="option-icon">
                                                <i class="bi bi-send-check"></i>
                                            </div>
                                            <div class="option-content">
                                                <h6>Publier maintenant</h6>
                                                <p>Soumettez votre contenu pour publication immédiate</p>
                                            </div>
                                            <div class="option-selector">
                                                <div class="selector-dot"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="action" id="selectedAction" value="draft">
                                </div>
                                
                                <!-- Confirmation -->
                                <div class="confirmation-card mt-4">
                                    <div class="confirmation-header">
                                        <i class="bi bi-shield-check"></i>
                                        <h5>Confirmation</h5>
                                    </div>
                                    <div class="confirmation-content">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="termsCheck" required>
                                            <label class="form-check-label" for="termsCheck">
                                                Je certifie que ce contenu est original et respecte les 
                                                <a href="#" class="text-primary">conditions d'utilisation</a>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="step-actions">
                                <button type="button" class="btn-step-prev" onclick="prevStep('step3')">
                                    <i class="bi bi-arrow-left me-2"></i>
                                    Précédent
                                </button>
                                <button type="submit" class="btn-submit-premium" id="submitBtn" disabled>
                                    <i class="bi bi-send-check me-2"></i>
                                    <span id="submitText">Enregistrer comme brouillon</span>
                                    <div class="btn-sparkle"></div>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* ===== STYLES PAGE CRÉATION PREMIUM ===== */
    .creation-container-premium {
        min-height: 100vh;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding-bottom: 60px;
    }
    
    /* ===== HERO SECTION ===== */
    .creation-hero-section {
        background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
        border-radius: 0 0 30px 30px;
        padding: 4rem 0 6rem;
        position: relative;
        overflow: hidden;
        margin-bottom: 3rem;
        box-shadow: 0 20px 60px rgba(30, 60, 114, 0.2);
    }
    
    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 600"><pattern id="pattern" x="0" y="0" width="60" height="60" patternUnits="userSpaceOnUse"><circle cx="30" cy="30" r="1" fill="rgba(255,255,255,0.1)"/></pattern><rect x="0" y="0" width="100%" height="100%" fill="url(%23pattern)"/></svg>');
        opacity: 0.1;
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(0,0,0,0.3) 0%, transparent 100%);
    }
    
    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 2rem;
    }
    
    .hero-icon-wrapper {
        width: 70px;
        height: 70px;
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }
    
    .hero-icon-wrapper i {
        font-size: 2.2rem;
        color: white;
    }
    
    .icon-glow {
        position: absolute;
        width: 80px;
        height: 80px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.4) 0%, transparent 70%);
        border-radius: 50%;
        animation: pulseGlow 2s infinite;
    }
    
    @keyframes pulseGlow {
        0% { transform: scale(1); opacity: 0.4; }
        50% { transform: scale(1.1); opacity: 0.6; }
        100% { transform: scale(1); opacity: 0.4; }
    }
    
    .hero-title {
        font-size: 3rem;
        font-weight: 900;
        color: white;
        margin-bottom: 1rem;
        line-height: 1.2;
    }
    
    .hero-subtitle {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 600px;
        margin-bottom: 2rem;
        line-height: 1.6;
    }
    
    .btn-hero-back {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        border: 1px solid rgba(255, 255, 255, 0.3);
        padding: 1rem 2rem;
        border-radius: 15px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }
    
    .btn-hero-back:hover {
        background: rgba(255, 255, 255, 0.25);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 10px 30px rgba(255, 255, 255, 0.2);
    }
    
    .hero-wave {
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        height: 120px;
        color: #f8f9fa;
        z-index: 1;
    }
    
    .hero-wave svg {
        width: 100%;
        height: 100%;
        fill: currentColor;
    }
    
    /* ===== GUIDE DE CRÉATION ===== */
    .creation-guide-card {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 
            0 15px 40px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        margin-bottom: 2rem;
    }
    
    .guide-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .guide-icon {
        font-size: 1.8rem;
        color: #f59e0b;
    }
    
    .guide-header h4 {
        margin: 0;
        font-weight: 800;
        color: #1f2937;
    }
    
    .guide-steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }
    
    .step-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.2rem;
        background: #f9fafb;
        border-radius: 12px;
        border: 2px solid #e5e7eb;
        transition: all 0.3s ease;
        opacity: 0.6;
    }
    
    .step-item.active {
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        border-color: #3b82f6;
        opacity: 1;
    }
    
    .step-item.active .step-number,
    .step-item.active .step-content h6,
    .step-item.active .step-content p {
        color: white;
    }
    
    .step-number {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 900;
        color: #3b82f6;
        font-size: 1.2rem;
        flex-shrink: 0;
    }
    
    .step-item.active .step-number {
        background: rgba(255, 255, 255, 0.2);
        color: white;
    }
    
    .step-content h6 {
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 0.25rem;
    }
    
    .step-content p {
        font-size: 0.85rem;
        color: #6b7280;
        margin: 0;
    }
    
    /* ===== FORMULAIRE PREMIUM ===== */
    .creation-form-premium {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 
            0 20px 60px rgba(0, 0, 0, 0.08),
            0 0 0 1px rgba(0, 0, 0, 0.02);
        margin-bottom: 3rem;
    }
    
    /* Alertes d'erreur */
    .alert-error-premium {
        background: linear-gradient(135deg, #fef2f2, #fee2e2);
        border: 2px solid #fca5a5;
        border-radius: 16px;
        padding: 1.5rem;
        display: flex;
        gap: 1rem;
        margin: 2rem;
    }
    
    .alert-icon {
        color: #dc2626;
        font-size: 1.5rem;
        flex-shrink: 0;
    }
    
    .alert-content h5 {
        color: #991b1b;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }
    
    .alert-content ul {
        color: #7f1d1d;
        padding-left: 1.2rem;
        margin-bottom: 0;
    }
    
    /* Étapes du formulaire */
    .form-step {
        display: none;
        padding: 2.5rem;
    }
    
    .form-step.active {
        display: block;
    }
    
    .step-header {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 2px solid #f3f4f6;
    }
    
    .step-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        color: white;
        flex-shrink: 0;
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }
    
    .step-title h3 {
        font-size: 1.8rem;
        font-weight: 900;
        color: #1f2937;
        margin: 0 0 0.5rem;
    }
    
    .step-title p {
        color: #6b7280;
        margin: 0;
        font-size: 1.05rem;
    }
    
    /* Groupes de formulaire */
    .form-group-premium {
        margin-bottom: 1.8rem;
    }
    
    .form-label-premium {
        display: flex;
        align-items: center;
        margin-bottom: 0.8rem;
        font-weight: 700;
        color: #374151;
        font-size: 1rem;
    }
    
    .form-icon {
        margin-right: 0.5rem;
        color: #3b82f6;
        font-size: 1.1rem;
    }
    
    .required-star {
        color: #ef4444;
        margin-left: 0.25rem;
    }
    
    .input-wrapper {
        position: relative;
    }
    
    .form-input-premium,
    .form-select-premium {
        width: 100%;
        padding: 1rem 1.2rem;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        background: white;
        font-size: 1rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        color: #1f2937;
    }
    
    .form-input-premium:focus,
    .form-select-premium:focus {
        border-color: #3b82f6;
        box-shadow: 
            0 0 0 4px rgba(59, 130, 246, 0.1),
            0 4px 20px rgba(59, 130, 246, 0.1);
        outline: none;
    }
    
    .input-focus-border {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        border: 2px solid transparent;
        border-radius: 12px;
        pointer-events: none;
        transition: all 0.3s ease;
    }
    
    .form-input-premium:focus ~ .input-focus-border {
        border-color: #3b82f6;
        transform: scale(1.02);
    }
    
    .select-wrapper {
        position: relative;
    }
    
    .select-arrow {
        position: absolute;
        right: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: #9ca3af;
        pointer-events: none;
        font-size: 0.9rem;
    }
    
    .form-error {
        color: #dc2626;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        font-weight: 500;
    }
    
    .form-hint {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-size: 0.9rem;
        margin-top: 0.5rem;
    }
    
    /* Éditeur */
    .editor-toolbar-premium {
        background: #f9fafb;
        border: 2px solid #e5e7eb;
        border-bottom: none;
        border-radius: 12px 12px 0 0;
        padding: 1rem;
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        align-items: center;
    }
    
    .toolbar-group {
        display: flex;
        gap: 0.25rem;
        padding-right: 1rem;
        border-right: 1px solid #e5e7eb;
    }
    
    .toolbar-group:last-child {
        border-right: none;
        padding-right: 0;
    }
    
    .toolbar-btn {
        width: 36px;
        height: 36px;
        background: white;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        color: #4b5563;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .toolbar-btn:hover {
        background: #f3f4f6;
        border-color: #d1d5db;
        color: #374151;
    }
    
    .toolbar-btn.active {
        background: #3b82f6;
        border-color: #3b82f6;
        color: white;
    }
    
    .heading-select {
        padding: 0.4rem 0.8rem;
        border: 1px solid #e5e7eb;
        border-radius: 8px;
        background: white;
        color: #4b5563;
        font-size: 0.9rem;
        cursor: pointer;
    }
    
    .editor-wrapper {
        border: 2px solid #e5e7eb;
        border-top: none;
        border-radius: 0 0 12px 12px;
        min-height: 300px;
        background: white;
    }
    
    .editor-content {
        min-height: 300px;
        padding: 1.5rem;
        outline: none;
        color: #1f2937;
        line-height: 1.6;
    }
    
    .editor-content:empty:before {
        content: attr(data-placeholder);
        color: #9ca3af;
        pointer-events: none;
    }
    
    .editor-stats {
        display: flex;
        gap: 2rem;
        margin-top: 1rem;
        padding: 1rem;
        background: #f9fafb;
        border-radius: 12px;
        border: 1px solid #e5e7eb;
    }
    
    .stat-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-weight: 500;
    }
    
    .stat-item i {
        color: #3b82f6;
    }
    
    /* Zone d'upload */
    .upload-zone-premium {
        border: 3px dashed #d1d5db;
        border-radius: 20px;
        padding: 3rem 2rem;
        text-align: center;
        background: #f9fafb;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    
    .upload-zone-premium:hover,
    .upload-zone-premium.dragover {
        border-color: #3b82f6;
        background: #eff6ff;
        transform: translateY(-5px);
    }
    
    .upload-icon {
        font-size: 3.5rem;
        color: #9ca3af;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    
    .upload-zone-premium:hover .upload-icon {
        color: #3b82f6;
        transform: scale(1.1);
    }
    
    .upload-zone-premium h4 {
        color: #1f2937;
        margin-bottom: 0.5rem;
        font-weight: 700;
    }
    
    .btn-browse {
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        color: white;
        border: none;
        padding: 0.8rem 1.8rem;
        border-radius: 10px;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        margin-top: 0.5rem;
    }
    
    .btn-browse:hover {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }
    
    .upload-info {
        font-size: 0.9rem;
        color: #6b7280;
        margin-top: 1rem;
    }
    
    /* Prévisualisation des médias */
    .media-preview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
    }
    
    .media-preview-item {
        position: relative;
        border-radius: 12px;
        overflow: hidden;
        background: white;
        border: 2px solid #e5e7eb;
    }
    
    .media-preview-item img {
        width: 100%;
        height: 120px;
        object-fit: cover;
    }
    
    .media-preview-info {
        padding: 0.75rem;
        background: white;
    }
    
    .media-preview-name {
        font-size: 0.85rem;
        font-weight: 600;
        color: #1f2937;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        margin-bottom: 0.25rem;
    }
    
    .media-preview-size {
        font-size: 0.75rem;
        color: #6b7280;
    }
    
    .media-preview-remove {
        position: absolute;
        top: 5px;
        right: 5px;
        width: 28px;
        height: 28px;
        background: rgba(239, 68, 68, 0.9);
        border: none;
        border-radius: 50%;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.8rem;
        transition: all 0.2s ease;
    }
    
    .media-preview-remove:hover {
        background: #dc2626;
        transform: scale(1.1);
    }
    
    /* Cartes de recommandations */
    .guidelines-card,
    .summary-card,
    .confirmation-card {
        background: #f9fafb;
        border-radius: 16px;
        padding: 1.5rem;
        border: 1px solid #e5e7eb;
    }
    
    .guidelines-header,
    .summary-header,
    .confirmation-header {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        margin-bottom: 1rem;
    }
    
    .guidelines-header i,
    .confirmation-header i {
        color: #10b981;
        font-size: 1.3rem;
    }
    
    .summary-header i {
        color: #3b82f6;
        font-size: 1.3rem;
    }
    
    .guidelines-header h5,
    .summary-header h5,
    .confirmation-header h5 {
        margin: 0;
        font-weight: 700;
        color: #1f2937;
    }
    
    .guidelines-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .guidelines-list li {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        padding: 0.5rem 0;
        color: #4b5563;
        font-size: 0.95rem;
    }
    
    /* Récapitulatif */
    .summary-content {
        display: flex;
        flex-direction: column;
        gap: 0.8rem;
    }
    
    .summary-item {
        display: flex;
        justify-content: space-between;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
    }
    
    .summary-item:last-child {
        border-bottom: none;
    }
    
    .summary-label {
        font-weight: 600;
        color: #6b7280;
    }
    
    .summary-value {
        font-weight: 700;
        color: #1f2937;
        text-align: right;
        max-width: 60%;
        word-break: break-word;
    }
    
    /* Options de publication */
    .publication-options h5 {
        color: #1f2937;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }
    
    .options-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }
    
    .option-card {
        background: white;
        border: 2px solid #e5e7eb;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        gap: 1rem;
        align-items: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    
    .option-card:hover {
        border-color: #d1d5db;
        transform: translateY(-3px);
    }
    
    .option-card.selected {
        border-color: #3b82f6;
        background: #eff6ff;
    }
    
    .option-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #f3f4f6, #e5e7eb);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #6b7280;
        flex-shrink: 0;
    }
    
    .option-card.selected .option-icon {
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        color: white;
    }
    
    .option-content {
        flex: 1;
    }
    
    .option-content h6 {
        font-size: 1rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 0.25rem;
    }
    
    .option-content p {
        font-size: 0.85rem;
        color: #6b7280;
        margin: 0;
    }
    
    .option-selector {
        width: 24px;
        height: 24px;
        border: 2px solid #d1d5db;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .selector-dot {
        width: 12px;
        height: 12px;
        background: #3b82f6;
        border-radius: 50%;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .option-card.selected .selector-dot {
        opacity: 1;
    }
    
    /* Confirmation */
    .confirmation-content {
        padding: 1rem;
        background: white;
        border-radius: 10px;
        border: 1px solid #e5e7eb;
    }
    
    /* Boutons de navigation */
    .step-actions {
        display: flex;
        justify-content: space-between;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 2px solid #f3f4f6;
    }
    
    .btn-step-prev,
    .btn-step-next {
        padding: 0.9rem 2rem;
        border-radius: 12px;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s ease;
        border: 2px solid;
    }
    
    .btn-step-prev {
        background: white;
        color: #6b7280;
        border-color: #e5e7eb;
    }
    
    .btn-step-prev:hover {
        background: #f9fafb;
        color: #374151;
        border-color: #d1d5db;
        transform: translateX(-5px);
    }
    
    .btn-step-next {
        background: linear-gradient(135deg, #3b82f6, #60a5fa);
        color: white;
        border-color: #3b82f6;
    }
    
    .btn-step-next:hover {
        background: linear-gradient(135deg, #2563eb, #3b82f6);
        transform: translateX(5px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
    }
    
    .btn-submit-premium {
        background: linear-gradient(135deg, #10b981, #34d399);
        color: white;
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 12px;
        font-weight: 800;
        display: inline-flex;
        align-items: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }
    
    .btn-submit-premium:hover:not(:disabled) {
        background: linear-gradient(135deg, #34d399, #10b981);
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(16, 185, 129, 0.4);
    }
    
    .btn-submit-premium:disabled {
        opacity: 0.6;
        cursor: not-allowed;
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
    
    .btn-submit-premium:hover:not(:disabled) .btn-sparkle {
        opacity: 1;
        animation: sparkle 0.6s ease-out;
    }
    
    @keyframes sparkle {
        0% { transform: translate(-50%, -50%) scale(0); opacity: 0; }
        50% { transform: translate(-50%, -50%) scale(1.5); opacity: 0.8; }
        100% { transform: translate(-50%, -50%) scale(2); opacity: 0; }
    }
    
    /* ===== RESPONSIVE ===== */
    @media (max-width: 1200px) {
        .hero-title {
            font-size: 2.5rem;
        }
        
        .guide-steps {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 992px) {
        .creation-hero-section {
            padding: 3rem 0 5rem;
        }
        
        .hero-title {
            font-size: 2.2rem;
        }
        
        .hero-content {
            padding: 0 1.5rem;
        }
        
        .form-step {
            padding: 2rem;
        }
        
        .options-grid {
            grid-template-columns: 1fr;
        }
    }
    
    @media (max-width: 768px) {
        .creation-hero-section {
            padding: 2.5rem 0 4rem;
        }
        
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-subtitle {
            font-size: 1.1rem;
        }
        
        .btn-hero-back {
            width: 100%;
            justify-content: center;
            margin-top: 1rem;
        }
        
        .guide-steps {
            grid-template-columns: 1fr;
        }
        
        .step-header {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }
        
        .step-title h3 {
            font-size: 1.6rem;
        }
        
        .form-step {
            padding: 1.5rem;
        }
        
        .step-actions {
            flex-direction: column;
            gap: 1rem;
        }
        
        .btn-step-prev,
        .btn-step-next {
            width: 100%;
            justify-content: center;
        }
        
        .media-preview-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }
    
    @media (max-width: 576px) {
        .hero-title {
            font-size: 1.8rem;
        }
        
        .editor-toolbar-premium {
            flex-direction: column;
            align-items: flex-start;
        }
        
        .toolbar-group {
            border-right: none;
            border-bottom: 1px solid #e5e7eb;
            padding-right: 0;
            padding-bottom: 0.5rem;
            width: 100%;
        }
        
        .toolbar-group:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }
        
        .media-preview-grid {
            grid-template-columns: 1fr;
        }
        
        .summary-item {
            flex-direction: column;
            gap: 0.25rem;
        }
        
        .summary-value {
            text-align: left;
            max-width: 100%;
        }
    }

    /* Styles pour les zones d'upload simples */
.upload-zone-simple {
    border: 2px dashed #d1d5db;
    border-radius: 12px;
    padding: 2rem;
    text-align: center;
    background: #f9fafb;
    transition: all 0.3s ease;
    cursor: pointer;
}

.upload-zone-simple:hover {
    border-color: #3b82f6;
    background: #eff6ff;
}

.media-sections {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.media-section {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 1.5rem;
}

.section-header h5 {
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
}

/* Prévisualisation */
.media-preview-single {
    min-height: 60px;
}

.media-preview-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
    gap: 1rem;
}

.preview-item {
    position: relative;
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
    transition: transform 0.2s ease;
}

.preview-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.preview-img {
    width: 100%;
    height: 100px;
    object-fit: cover;
}

.preview-placeholder {
    width: 100%;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.preview-info {
    padding: 0.75rem;
}

.preview-name {
    font-size: 0.85rem;
    font-weight: 600;
    color: #1f2937;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 0.25rem;
}

.preview-size,
.preview-type {
    font-size: 0.75rem;
    color: #6b7280;
}

.preview-remove {
    position: absolute;
    top: 5px;
    right: 5px;
    width: 24px;
    height: 24px;
    background: rgba(239, 68, 68, 0.9);
    border: none;
    border-radius: 50%;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    font-size: 0.7rem;
    transition: all 0.2s ease;
}

.preview-remove:hover {
    background: #dc2626;
    transform: scale(1.1);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des étapes
    let currentStep = 1;
    const totalSteps = 4;
    
    window.nextStep = function(nextStepId) {
        // Valider l'étape actuelle
        if (!validateCurrentStep()) {
            return;
        }
        
        // Masquer l'étape actuelle
        document.getElementById(`step${currentStep}`).classList.remove('active');
        document.querySelectorAll('.step-item')[currentStep - 1].classList.remove('active');
        
        // Afficher la prochaine étape
        currentStep++;
        document.getElementById(nextStepId).classList.add('active');
        document.querySelectorAll('.step-item')[currentStep - 1].classList.add('active');
        
        // Mettre à jour le récapitulatif
        updateSummary();
        
        // Scroll vers le haut
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };
    
    window.prevStep = function(prevStepId) {
        // Masquer l'étape actuelle
        document.getElementById(`step${currentStep}`).classList.remove('active');
        document.querySelectorAll('.step-item')[currentStep - 1].classList.remove('active');
        
        // Afficher l'étape précédente
        currentStep--;
        document.getElementById(prevStepId).classList.add('active');
        document.querySelectorAll('.step-item')[currentStep - 1].classList.add('active');
        
        // Scroll vers le haut
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };
    
    function validateCurrentStep() {
        const currentStepElement = document.getElementById(`step${currentStep}`);
        const inputs = currentStepElement.querySelectorAll('[required]');
        
        for (let input of inputs) {
            if (!input.value.trim()) {
                input.focus();
                showValidationError('Veuillez remplir tous les champs obligatoires');
                return false;
            }
        }
        
        return true;
    }
    
    // Gestion de l'éditeur
    const editor = document.getElementById('editor');
    const textarea = document.getElementById('texte');
    const charCount = document.getElementById('charCount');
    const wordCount = document.getElementById('wordCount');
    const readTime = document.getElementById('readTime');
    
    // Synchroniser l'éditeur avec le textarea
    editor.addEventListener('input', function() {
        textarea.value = this.innerHTML;
        updateStats();
    });
    
    // Barre d'outils de l'éditeur
    document.querySelectorAll('.toolbar-btn[data-command]').forEach(btn => {
        btn.addEventListener('click', function() {
            const command = this.getAttribute('data-command');
            document.execCommand(command, false, null);
            editor.focus();
        });
    });
    
    // Formatage des titres
    window.formatHeading = function(heading) {
        if (!heading) return;
        document.execCommand('formatBlock', false, heading);
        editor.focus();
    };
    
    // Mise à jour des statistiques
    function updateStats() {
        const text = textarea.value;
        const charLength = text.length;
        const words = text.trim().split(/\s+/).filter(word => word.length > 0).length;
        const readingTime = Math.ceil(words / 200);
        
        charCount.textContent = charLength.toLocaleString();
        wordCount.textContent = words.toLocaleString();
        readTime.textContent = readingTime;
    }
    
    // Initialiser les stats
    updateStats();
    
    // Zone d'upload drag & drop
    const uploadZone = document.getElementById('uploadZone');
    const fileInput = document.getElementById('medias');
    const mediaPreview = document.getElementById('mediaPreview');
    
    uploadZone.addEventListener('dragover', function(e) {
        e.preventDefault();
        this.classList.add('dragover');
    });
    
    uploadZone.addEventListener('dragleave', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
    });
    
    uploadZone.addEventListener('drop', function(e) {
        e.preventDefault();
        this.classList.remove('dragover');
        
        if (e.dataTransfer.files.length) {
            fileInput.files = e.dataTransfer.files;
            handleFileSelection();
        }
    });
    
    fileInput.addEventListener('change', handleFileSelection);
    
    function handleFileSelection() {
        mediaPreview.innerHTML = '';
        
        Array.from(fileInput.files).forEach((file, index) => {
            const reader = new FileReader();
            
            reader.onload = function(e) {
                const previewItem = document.createElement('div');
                previewItem.className = 'media-preview-item';
                
                let content = '';
                if (file.type.startsWith('image/')) {
                    content = `
                        <img src="${e.target.result}" alt="${file.name}">
                        <div class="media-preview-info">
                            <div class="media-preview-name">${file.name}</div>
                            <div class="media-preview-size">${formatFileSize(file.size)}</div>
                        </div>
                    `;
                } else if (file.type.startsWith('video/')) {
                    content = `
                        <div style="background: #3b82f6; height: 120px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-camera-video" style="font-size: 2rem; color: white;"></i>
                        </div>
                        <div class="media-preview-info">
                            <div class="media-preview-name">${file.name}</div>
                            <div class="media-preview-size">${formatFileSize(file.size)}</div>
                        </div>
                    `;
                } else if (file.type.startsWith('audio/')) {
                    content = `
                        <div style="background: #10b981; height: 120px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-music-note-beamed" style="font-size: 2rem; color: white;"></i>
                        </div>
                        <div class="media-preview-info">
                            <div class="media-preview-name">${file.name}</div>
                            <div class="media-preview-size">${formatFileSize(file.size)}</div>
                        </div>
                    `;
                } else {
                    content = `
                        <div style="background: #6b7280; height: 120px; display: flex; align-items: center; justify-content: center;">
                            <i class="bi bi-file-earmark" style="font-size: 2rem; color: white;"></i>
                        </div>
                        <div class="media-preview-info">
                            <div class="media-preview-name">${file.name}</div>
                            <div class="media-preview-size">${formatFileSize(file.size)}</div>
                        </div>
                    `;
                }
                
                content += `
                    <button type="button" class="media-preview-remove" onclick="removeFile(${index})">
                        <i class="bi bi-x"></i>
                    </button>
                `;
                
                previewItem.innerHTML = content;
                mediaPreview.appendChild(previewItem);
            };
            
            reader.readAsDataURL(file);
        });
        
        updateSummary();
    }
    
    window.removeFile = function(index) {
        const dt = new DataTransfer();
        const files = Array.from(fileInput.files);
        
        files.forEach((file, i) => {
            if (i !== index) {
                dt.items.add(file);
            }
        });
        
        fileInput.files = dt.files;
        handleFileSelection();
    };
    
    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }
    
    // Options de publication
    document.querySelectorAll('.option-card').forEach(card => {
        card.addEventListener('click', function() {
            document.querySelectorAll('.option-card').forEach(c => {
                c.classList.remove('selected');
            });
            this.classList.add('selected');
            
            const action = this.getAttribute('data-action');
            document.getElementById('selectedAction').value = action;
            
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            
            if (action === 'draft') {
                submitText.textContent = 'Enregistrer comme brouillon';
            } else {
                submitText.textContent = 'Publier maintenant';
            }
        });
    });
    
    // Sélectionner brouillon par défaut
    document.querySelector('.option-card[data-action="draft"]').classList.add('selected');
    
    // Validation du formulaire
    const termsCheck = document.getElementById('termsCheck');
    const submitBtn = document.getElementById('submitBtn');
    
    termsCheck.addEventListener('change', function() {
        submitBtn.disabled = !this.checked;
    });
    
    // Mise à jour du récapitulatif
    function updateSummary() {
        document.getElementById('summaryTitle').textContent = 
            document.getElementById('titre').value || '-';
        
        const typeSelect = document.getElementById('id_type_contenu');
        document.getElementById('summaryType').textContent = 
            typeSelect.options[typeSelect.selectedIndex]?.text || '-';
        
        const regionSelect = document.getElementById('id_region');
        document.getElementById('summaryRegion').textContent = 
            regionSelect.options[regionSelect.selectedIndex]?.text || '-';
        
        const langueSelect = document.getElementById('id_langue');
        document.getElementById('summaryLangue').textContent = 
            langueSelect.options[langueSelect.selectedIndex]?.text || '-';
        
        document.getElementById('summaryLength').textContent = 
            `${wordCount.textContent} mots (${readTime.textContent} min)`;
        
        const fileCount = fileInput.files.length;
        document.getElementById('summaryMedias').textContent = 
            fileCount > 0 ? `${fileCount} fichier(s)` : 'Aucun';
    }
    
    // Écouter les changements pour le récapitulatif
    document.getElementById('titre').addEventListener('input', updateSummary);
    document.getElementById('id_type_contenu').addEventListener('change', updateSummary);
    document.getElementById('id_region').addEventListener('change', updateSummary);
    document.getElementById('id_langue').addEventListener('change', updateSummary);
    editor.addEventListener('input', updateSummary);
    
    // Notification de validation
    function showValidationError(message) {
        const notification = document.createElement('div');
        notification.className = 'validation-notification';
        notification.innerHTML = `
            <i class="bi bi-exclamation-triangle-fill"></i>
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
    
    // Styles pour la notification
    const notificationStyle = document.createElement('style');
    notificationStyle.textContent = `
        .validation-notification {
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
            border-left: 4px solid #f59e0b;
        }
        
        .validation-notification.show {
            transform: translateX(0);
            opacity: 1;
        }
        
        .validation-notification i {
            color: #f59e0b;
            font-size: 1.2rem;
        }
        
        .validation-notification span {
            font-weight: 600;
            color: #1f2937;
        }
    `;
    document.head.appendChild(notificationStyle);
    
    // Initialiser le récapitulatif
    updateSummary();

    // Fonctions pour la prévisualisation des médias
    function previewSingleFile(input, previewId) {
        const previewContainer = document.getElementById(previewId);
        previewContainer.innerHTML = '';
        
        if (input.files && input.files[0]) {
            const file = input.files[0];
            const reader = new FileReader();
            
            reader.onload = function(e) {
                let content = '';
                
                if (file.type.startsWith('image/')) {
                    content = `
                        <div class="preview-item">
                            <img src="${e.target.result}" alt="${file.name}" class="preview-img">
                            <div class="preview-info">
                                <div class="preview-name">${file.name}</div>
                                <div class="preview-size">${formatFileSize(file.size)}</div>
                            </div>
                            <button type="button" class="preview-remove" onclick="removeFile('${input.id}')">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    `;
                } else if (file.type.startsWith('video/')) {
                    content = `
                        <div class="preview-item">
                            <div class="preview-placeholder bg-danger">
                                <i class="bi bi-camera-video fs-2 text-white"></i>
                            </div>
                            <div class="preview-info">
                                <div class="preview-name">${file.name}</div>
                                <div class="preview-size">${formatFileSize(file.size)}</div>
                                <div class="preview-type">Vidéo</div>
                            </div>
                            <button type="button" class="preview-remove" onclick="removeFile('${input.id}')">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    `;
                } else if (file.type.startsWith('audio/')) {
                    content = `
                        <div class="preview-item">
                            <div class="preview-placeholder bg-warning">
                                <i class="bi bi-music-note-beamed fs-2 text-white"></i>
                            </div>
                            <div class="preview-info">
                                <div class="preview-name">${file.name}</div>
                                <div class="preview-size">${formatFileSize(file.size)}</div>
                                <div class="preview-type">Audio</div>
                            </div>
                            <button type="button" class="preview-remove" onclick="removeFile('${input.id}')">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    `;
                } else {
                    content = `
                        <div class="preview-item">
                            <div class="preview-placeholder bg-info">
                                <i class="bi bi-file-earmark-text fs-2 text-white"></i>
                            </div>
                            <div class="preview-info">
                                <div class="preview-name">${file.name}</div>
                                <div class="preview-size">${formatFileSize(file.size)}</div>
                                <div class="preview-type">Document</div>
                            </div>
                            <button type="button" class="preview-remove" onclick="removeFile('${input.id}')">
                                <i class="bi bi-x"></i>
                            </button>
                        </div>
                    `;
                }
                
                previewContainer.innerHTML = content;
            };
            
            reader.readAsDataURL(file);
        }
        
        updateSummary();
    }

    function previewMultipleFiles(input, previewId) {
        const previewContainer = document.getElementById(previewId);
        previewContainer.innerHTML = '';
        
        if (input.files && input.files.length > 0) {
            for (let i = 0; i < input.files.length; i++) {
                const file = input.files[i];
                const reader = new FileReader();
                
                reader.onload = (function(file, index) {
                    return function(e) {
                        const previewItem = document.createElement('div');
                        previewItem.className = 'preview-item';
                        previewItem.innerHTML = `
                            <img src="${e.target.result}" alt="${file.name}" class="preview-img">
                            <div class="preview-info">
                                <div class="preview-name">${file.name}</div>
                                <div class="preview-size">${formatFileSize(file.size)}</div>
                            </div>
                            <button type="button" class="preview-remove" onclick="removeMultipleFile(${index})">
                                <i class="bi bi-x"></i>
                            </button>
                        `;
                        previewContainer.appendChild(previewItem);
                    };
                })(file, i);
                
                reader.readAsDataURL(file);
            }
        }
        
        updateSummary();
    }

    function removeFile(inputId) {
        const input = document.getElementById(inputId);
        input.value = '';
        const previewContainer = document.getElementById(inputId + 'Preview');
        previewContainer.innerHTML = '';
        updateSummary();
    }

    function removeMultipleFile(index) {
        const input = document.getElementById('images');
        const dt = new DataTransfer();
        const files = Array.from(input.files);
        
        files.forEach((file, i) => {
            if (i !== index) {
                dt.items.add(file);
            }
        });
        
        input.files = dt.files;
        previewMultipleFiles(input, 'imagesPreview');
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Ajoutez aussi cette fonction pour mettre à jour le récapitulatif des médias
    function getMediaCount() {
        let count = 0;
        
        // Image principale
        if (document.getElementById('image_principale').files.length > 0) count++;
        
        // Images multiples
        count += document.getElementById('images').files.length;
        
        // Vidéo
        if (document.getElementById('video').files.length > 0) count++;
        
        // Audio
        if (document.getElementById('audio').files.length > 0) count++;
        
        // Document
        if (document.getElementById('document').files.length > 0) count++;
        
        return count;
    }

    // Modifiez la fonction updateSummary pour inclure les médias
    function updateSummary() {
        // ... (votre code existant pour les autres champs) ...
        
        const mediaCount = getMediaCount();
        document.getElementById('summaryMedias').textContent = 
            mediaCount > 0 ? `${mediaCount} média(s)` : 'Aucun média';
    }
});
</script>
@endsection