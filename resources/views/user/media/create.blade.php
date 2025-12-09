@extends('layouts.app')

@section('title', 'Uploader un média - Culture Benin')

@push('styles')
<style>
    :root {
        --primary: #e17000;
        --secondary: #008751;
        --accent: #ffd700;
        --light: #f8f9fa;
        --dark: #1a1d21;
        --gray: #6c757d;
        --border: #e9ecef;
        --shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        --radius: 16px;
        --error: #dc3545;
        --success: #28a745;
    }

    .upload-media-page {
        min-height: calc(100vh - 180px);
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 40px 0;
    }

    /* Page Header */
    .upload-header {
        background: white;
        border-radius: var(--radius);
        padding: 2.5rem;
        margin-bottom: 2.5rem;
        box-shadow: var(--shadow);
        border-left: 5px solid var(--secondary);
    }

    .upload-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .upload-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--dark);
        margin: 0 0 0.5rem 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .upload-subtitle {
        color: var(--gray);
        font-size: 1.1rem;
        margin: 0;
    }

    .btn-back {
        background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
        color: white;
        padding: 0.875rem 1.75rem;
        border-radius: 10px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
    }

    .btn-back:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(108, 117, 125, 0.3);
        color: white;
    }

    /* Form Container */
    .upload-form-container {
        background: white;
        border-radius: var(--radius);
        padding: 2.5rem;
        box-shadow: var(--shadow);
        margin-bottom: 2rem;
    }

    /* Form Groups */
    .form-group-media {
        margin-bottom: 2rem;
    }

    .form-label-media {
        display: block;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .required {
        color: var(--error);
        margin-left: 2px;
    }

    /* Upload Zone */
    .upload-zone {
        border: 3px dashed var(--border);
        border-radius: 12px;
        padding: 4rem 2rem;
        text-align: center;
        background: #f8f9fa;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .upload-zone:hover {
        border-color: var(--primary);
        background: rgba(225, 112, 0, 0.05);
        transform: translateY(-3px);
    }

    .upload-zone.dragover {
        border-color: var(--secondary);
        background: rgba(0, 135, 81, 0.1);
        animation: pulse 1.5s infinite;
    }

    @keyframes pulse {
        0% { box-shadow: 0 0 0 0 rgba(0, 135, 81, 0.2); }
        70% { box-shadow: 0 0 0 15px rgba(0, 135, 81, 0); }
        100% { box-shadow: 0 0 0 0 rgba(0, 135, 81, 0); }
    }

    .upload-icon {
        font-size: 4rem;
        color: var(--gray);
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }

    .upload-zone:hover .upload-icon {
        color: var(--primary);
        transform: scale(1.1);
    }

    .upload-text {
        font-size: 1.3rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.5rem;
    }

    .upload-hint {
        color: var(--gray);
        margin-bottom: 1.5rem;
        font-size: 0.95rem;
    }

    .btn-browse {
        background: linear-gradient(135deg, var(--primary) 0%, #d15c00 100%);
        color: white;
        border: none;
        padding: 1rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        box-shadow: 0 6px 20px rgba(225, 112, 0, 0.25);
    }

    .btn-browse:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(225, 112, 0, 0.35);
    }

    .upload-info {
        margin-top: 1.5rem;
        padding: 1rem;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid var(--border);
    }

    .info-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 0.75rem;
    }

    .info-list li {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--gray);
        font-size: 0.9rem;
    }

    .info-list li i {
        color: var(--primary);
    }

    /* File Preview */
    .file-preview {
        margin-top: 2rem;
    }

    .preview-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid var(--border);
    }

    .preview-title {
        font-weight: 700;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .file-details {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1.5rem;
        background: #f8f9fa;
        border-radius: 12px;
        margin-bottom: 1.5rem;
    }

    .file-icon-large {
        font-size: 3rem;
        color: var(--primary);
        flex-shrink: 0;
    }

    .file-info {
        flex: 1;
    }

    .file-name {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.25rem;
        word-break: break-all;
    }

    .file-meta {
        display: flex;
        gap: 1.5rem;
        color: var(--gray);
        font-size: 0.9rem;
    }

    .btn-remove {
        background: transparent;
        border: 2px solid var(--error);
        color: var(--error);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-remove:hover {
        background: var(--error);
        color: white;
        transform: translateY(-2px);
    }

    /* Media Preview */
    .media-preview {
        border: 2px solid var(--border);
        border-radius: 12px;
        overflow: hidden;
        margin-top: 1rem;
        background: black;
    }

    .media-preview img,
    .media-preview video {
        width: 100%;
        max-height: 400px;
        object-fit: contain;
        display: block;
    }

    .audio-preview {
        padding: 2rem;
        background: linear-gradient(135deg, var(--primary) 0%, #d15c00 100%);
        text-align: center;
    }

    .audio-preview i {
        font-size: 4rem;
        color: white;
        margin-bottom: 1rem;
    }

    .audio-preview p {
        color: white;
        font-weight: 600;
        margin: 0;
    }

    .document-preview {
        padding: 2rem;
        background: #f8f9fa;
        text-align: center;
        border: 2px dashed var(--border);
    }

    .document-preview i {
        font-size: 4rem;
        color: var(--primary);
        margin-bottom: 1rem;
    }

    /* Form Controls */
    .form-control-media,
    .form-select-media,
    .form-textarea-media {
        width: 100%;
        padding: 1rem 1.2rem;
        border: 2px solid var(--border);
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        color: var(--dark);
    }

    .form-control-media:focus,
    .form-select-media:focus,
    .form-textarea-media:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(225, 112, 0, 0.1);
    }

    .form-textarea-media {
        min-height: 120px;
        resize: vertical;
    }

    .form-select-media {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16'%3e%3cpath fill='none' stroke='%236c757d' stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='m2 5 6 6 6-6'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 1rem center;
        background-size: 16px 12px;
        padding-right: 2.5rem;
    }

    /* Error States */
    .form-control-media.is-invalid,
    .form-select-media.is-invalid,
    .form-textarea-media.is-invalid {
        border-color: var(--error);
    }

    .invalid-feedback {
        display: block;
        color: var(--error);
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    /* Form Actions */
    .form-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 2rem;
        margin-top: 2rem;
        border-top: 2px solid var(--border);
    }

    .btn-submit {
        background: linear-gradient(135deg, var(--secondary) 0%, #006642 100%);
        color: white;
        border: none;
        padding: 1rem 2.5rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 1.1rem;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        box-shadow: 0 8px 25px rgba(0, 135, 81, 0.3);
    }

    .btn-submit:hover:not(:disabled) {
        transform: translateY(-3px);
        box-shadow: 0 15px 40px rgba(0, 135, 81, 0.4);
    }

    .btn-submit:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }

    .btn-cancel {
        background: transparent;
        border: 2px solid var(--gray);
        color: var(--gray);
        padding: 0.875rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-cancel:hover {
        background: var(--gray);
        color: white;
        border-color: var(--gray);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .upload-header,
        .upload-form-container {
            padding: 2rem;
        }
        
        .upload-title {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 768px) {
        .upload-media-page {
            padding: 30px 0;
        }
        
        .upload-header {
            padding: 1.5rem;
        }
        
        .upload-header-content {
            flex-direction: column;
            text-align: center;
        }
        
        .upload-title {
            font-size: 1.5rem;
        }
        
        .upload-form-container {
            padding: 1.5rem;
        }
        
        .upload-zone {
            padding: 3rem 1.5rem;
        }
        
        .info-list {
            grid-template-columns: 1fr;
        }
        
        .file-details {
            flex-direction: column;
            text-align: center;
        }
        
        .file-meta {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .form-actions {
            flex-direction: column;
            gap: 1rem;
        }
        
        .btn-cancel,
        .btn-submit {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 576px) {
        .upload-title {
            font-size: 1.3rem;
        }
        
        .upload-zone {
            padding: 2.5rem 1rem;
        }
        
        .upload-text {
            font-size: 1.1rem;
        }
        
        .btn-browse {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="upload-media-page">
    <div class="container">
        <!-- Page Header -->
        <div class="upload-header">
            <div class="upload-header-content">
                <div>
                    <h1 class="upload-title">
                        <i class="bi bi-cloud-arrow-up"></i>
                        Uploader un média
                    </h1>
                    <p class="upload-subtitle">
                        Partagez des images, vidéos, audio ou documents pour enrichir notre patrimoine culturel
                    </p>
                </div>
                <a href="{{ route('user.medias.index') }}" class="btn-back">
                    <i class="bi bi-arrow-left"></i>
                    Retour aux médias
                </a>
            </div>
        </div>

        <!-- Form Container -->
        <div class="upload-form-container">
            @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <div class="d-flex align-items-center">
                    <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                    <div>
                        <strong>Des erreurs sont présentes dans le formulaire :</strong>
                        <ul class="mb-0 mt-1">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <form action="{{ route('user.medias.store') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf

                <!-- Upload Zone -->
                <div class="form-group-media">
                    <label class="form-label-media">
                        <i class="bi bi-file-earmark-arrow-up"></i>
                        Sélectionnez votre fichier
                        <span class="required">*</span>
                    </label>
                    
                    <div class="upload-zone" id="uploadZone">
                        <i class="bi bi-cloud-upload upload-icon"></i>
                        <h3 class="upload-text">Glissez-déposez votre fichier</h3>
                        <p class="upload-hint">ou cliquez pour parcourir vos fichiers</p>
                        
                        <input type="file" 
                            id="fichier" 
                            name="fichier" 
                            class="d-none" 
                            accept="image/*,video/*,audio/*,.pdf,.doc,.docx,.txt,.csv,.xlsx,.pptx,.zip"
                            required>
                        
                        <button type="button" class="btn-browse" onclick="document.getElementById('fichier').click()">
                            <i class="bi bi-folder2-open"></i>
                            Parcourir les fichiers
                        </button>
                    </div>
                    
                    <div class="upload-info">
                        <ul class="info-list">
                            <li>
                                <i class="bi bi-check-circle"></i>
                                Formats supportés : JPG, PNG, GIF, WebP, MP4, AVI, MOV, MP3, WAV, PDF, DOC, DOCX
                            </li>
                            <li>
                                <i class="bi bi-check-circle"></i>
                                Taille maximum : 50MB par fichier
                            </li>
                            <li>
                                <i class="bi bi-check-circle"></i>
                                Résolution recommandée : 1920x1080px minimum pour les images
                            </li>
                            <li>
                                <i class="bi bi-check-circle"></i>
                                Durée recommandée : 5 minutes maximum pour les vidéos
                            </li>
                        </ul>
                    </div>
                    
                    <!-- File Preview -->
                    <div class="file-preview" id="filePreview" style="display: none;">
                        <div class="preview-header">
                            <h4 class="preview-title">
                                <i class="bi bi-file-earmark-check"></i>
                                Fichier sélectionné
                            </h4>
                            <button type="button" class="btn-remove" onclick="removeFile()">
                                <i class="bi bi-trash"></i>
                                Supprimer
                            </button>
                        </div>
                        
                        <div class="file-details">
                            <div id="fileIcon" class="file-icon-large">
                                <i class="bi bi-file-earmark"></i>
                            </div>
                            <div class="file-info">
                                <div id="fileName" class="file-name"></div>
                                <div id="fileMeta" class="file-meta"></div>
                            </div>
                        </div>
                        
                        <div id="mediaPreview"></div>
                    </div>
                </div>

                <!-- Media Information -->
                <div class="row g-4">
                    <!-- Titre -->
                    <div class="col-md-6">
                        <div class="form-group-media">
                            <label for="titre" class="form-label-media">
                                <i class="bi bi-type"></i>
                                Titre du média
                                <span class="required">*</span>
                            </label>
                            <input type="text" 
                                class="form-control-media @error('titre') is-invalid @enderror" 
                                id="titre" 
                                name="titre" 
                                value="{{ old('titre') }}" 
                                placeholder="Ex: Danse traditionnelle à Cotonou"
                                required>
                            @error('titre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <!-- Type de média -->
                    <!-- Type de média -->
                    <div class="col-md-6">
                        <div class="form-group-media">
                            <label for="id_type_media" class="form-label-media">
                                <i class="bi bi-tag"></i>
                                Type de média
                                <span class="required">*</span>
                            </label>
                            <select class="form-select-media @error('id_type_media') is-invalid @enderror" 
                                id="id_type_media" 
                                name="id_type_media" 
                                required>
                                <option value="">Sélectionnez un type</option>
                                @foreach($types as $type)
                                    <!-- CORRECTION: utiliser $type->id_type (pas id_type_media) -->
                                    <option value="{{ $type->id_type }}" {{ old('id_type_media') == $type->id_type ? 'selected' : '' }}>
                                        {{ $type->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_type_media')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                                        <!-- Contenu associé -->
                    <div class="col-md-6">
                        <div class="form-group-media">
                            <label for="id_contenu" class="form-label-media">
                                <i class="bi bi-link-45deg"></i>
                                Contenu associé (optionnel)
                            </label>
                            <select class="form-select-media @error('id_contenu') is-invalid @enderror" 
                                id="id_contenu" 
                                name="id_contenu">
                                <option value="">Sélectionnez un contenu (optionnel)</option>
                                @foreach($contenus as $id => $titre)
                                    <option value="{{ $id }}" {{ old('id_contenu') == $id ? 'selected' : '' }}>
                                        {{ $titre }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_contenu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted mt-2">
                                <i class="bi bi-info-circle"></i>
                                Liez ce média à un de vos contenus existants pour l'enrichir
                            </div>
                        </div>
                    </div>
                    
                    <!-- Description -->
                    <div class="col-12">
                        <div class="form-group-media">
                            <label for="description" class="form-label-media">
                                <i class="bi bi-card-text"></i>
                                Description
                                <span class="required">*</span>
                            </label>
                            <textarea class="form-textarea-media @error('description') is-invalid @enderror" 
                                id="description" 
                                name="description" 
                                rows="4" 
                                placeholder="Décrivez votre média en détail (contexte, lieu, date, signification culturelle, etc.)"
                                required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text text-muted mt-2">
                                <i class="bi bi-info-circle"></i>
                                Une bonne description permet une meilleure indexation et recherche
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Actions -->
                <div class="form-actions">
                    <button type="button" class="btn-cancel" onclick="window.location.href='{{ route('user.medias.index') }}'">
                        <i class="bi bi-x-circle"></i>
                        Annuler
                    </button>
                    
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <i class="bi bi-cloud-arrow-up"></i>
                        Uploader le média
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const uploadZone = document.getElementById('uploadZone');
    const fileInput = document.getElementById('fichier');
    const filePreview = document.getElementById('filePreview');
    const fileName = document.getElementById('fileName');
    const fileMeta = document.getElementById('fileMeta');
    const fileIcon = document.getElementById('fileIcon');
    const mediaPreview = document.getElementById('mediaPreview');
    const submitBtn = document.getElementById('submitBtn');
    const titreInput = document.getElementById('titre');
    const descriptionInput = document.getElementById('description');
    
    let selectedFile = null;

    // Drag & Drop Events
    uploadZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        uploadZone.classList.add('dragover');
    });

    uploadZone.addEventListener('dragleave', () => {
        uploadZone.classList.remove('dragover');
    });

    uploadZone.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadZone.classList.remove('dragover');
        
        if (e.dataTransfer.files.length > 0) {
            handleFile(e.dataTransfer.files[0]);
        }
    });

    // File Selection Event
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length > 0) {
            handleFile(e.target.files[0]);
        }
    });

    // Click on Upload Zone
    uploadZone.addEventListener('click', (e) => {
        if (e.target !== fileInput) {
            fileInput.click();
        }
    });

    function handleFile(file) {
        // File Size Validation
        if (file.size > 50 * 1024 * 1024) {
            showNotification('Le fichier dépasse la taille maximale de 50MB', 'error');
            return;
        }

        selectedFile = file;
        updateFilePreview(file);
        
        // Auto-fill title if empty
        if (!titreInput.value.trim()) {
            const nameWithoutExt = file.name.replace(/\.[^/.]+$/, "");
            titreInput.value = nameWithoutExt.replace(/[-_]/g, ' ').replace(/\b\w/g, l => l.toUpperCase());
        }
        
        // Auto-fill description suggestion
        if (!descriptionInput.value.trim()) {
            const fileType = getFileType(file.type);
            descriptionInput.placeholder = `Description de ce ${fileType}...`;
        }
    }

    function updateFilePreview(file) {
        // Show preview section
        filePreview.style.display = 'block';
        
        // Update file info
        fileName.textContent = file.name;
        
        const fileSize = formatFileSize(file.size);
        const fileType = getFileType(file.type);
        fileMeta.innerHTML = `
            <span><i class="bi bi-file-earmark"></i> ${fileType}</span>
            <span><i class="bi bi-hdd"></i> ${fileSize}</span>
            <span><i class="bi bi-calendar"></i> ${new Date(file.lastModified).toLocaleDateString()}</span>
        `;
        
        // Update icon based on file type
        updateFileIcon(file.type);
        
        // Generate preview based on file type
        generateMediaPreview(file);
        
        // Scroll to preview smoothly
        filePreview.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function updateFileIcon(mimeType) {
        const iconClass = getFileIconClass(mimeType);
        fileIcon.innerHTML = `<i class="bi ${iconClass}"></i>`;
    }

    function getFileIconClass(mimeType) {
        if (mimeType.startsWith('image/')) return 'bi-file-earmark-image text-success';
        if (mimeType.startsWith('video/')) return 'bi-file-earmark-play text-danger';
        if (mimeType.startsWith('audio/')) return 'bi-file-earmark-music text-warning';
        if (mimeType === 'application/pdf') return 'bi-file-earmark-pdf text-danger';
        if (mimeType.includes('word') || mimeType.includes('document')) return 'bi-file-earmark-word text-primary';
        if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return 'bi-file-earmark-excel text-success';
        if (mimeType.includes('powerpoint') || mimeType.includes('presentation')) return 'bi-file-earmark-ppt text-danger';
        if (mimeType.includes('zip') || mimeType.includes('compressed')) return 'bi-file-earmark-zip text-secondary';
        return 'bi-file-earmark text-primary';
    }

    function getFileType(mimeType) {
        if (mimeType.startsWith('image/')) return 'image';
        if (mimeType.startsWith('video/')) return 'vidéo';
        if (mimeType.startsWith('audio/')) return 'audio';
        if (mimeType === 'application/pdf') return 'document PDF';
        if (mimeType.includes('word') || mimeType.includes('document')) return 'document Word';
        if (mimeType.includes('excel') || mimeType.includes('spreadsheet')) return 'feuille de calcul';
        if (mimeType.includes('powerpoint') || mimeType.includes('presentation')) return 'présentation';
        if (mimeType.includes('zip') || mimeType.includes('compressed')) return 'archive compressée';
        return 'document';
    }

    function generateMediaPreview(file) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            let previewHTML = '';
            
            if (file.type.startsWith('image/')) {
                previewHTML = `
                    <div class="media-preview">
                        <img src="${e.target.result}" alt="Preview" onload="this.style.opacity='1'">
                    </div>
                `;
            } else if (file.type.startsWith('video/')) {
                previewHTML = `
                    <div class="media-preview">
                        <video controls style="opacity: 0; transition: opacity 0.3s;" onloadeddata="this.style.opacity='1'">
                            <source src="${e.target.result}" type="${file.type}">
                            Votre navigateur ne supporte pas la vidéo.
                        </video>
                    </div>
                `;
            } else if (file.type.startsWith('audio/')) {
                previewHTML = `
                    <div class="audio-preview">
                        <i class="bi bi-music-note-beamed"></i>
                        <p>Fichier audio : ${file.name}</p>
                        <audio controls class="w-100 mt-3">
                            <source src="${e.target.result}" type="${file.type}">
                            Votre navigateur ne supporte pas l'audio.
                        </audio>
                    </div>
                `;
            } else if (file.type === 'application/pdf') {
                previewHTML = `
                    <div class="document-preview">
                        <i class="bi bi-file-earmark-pdf"></i>
                        <p class="fw-bold">Document PDF</p>
                        <p class="text-muted">${file.name}</p>
                    </div>
                `;
            } else {
                previewHTML = `
                    <div class="document-preview">
                        <i class="${getFileIconClass(file.type)}" style="font-size: 4rem;"></i>
                        <p class="fw-bold">${getFileType(file.type).toUpperCase()}</p>
                        <p class="text-muted">${file.name}</p>
                    </div>
                `;
            }
            
            mediaPreview.innerHTML = previewHTML;
        };
        
        reader.readAsDataURL(file);
    }

    function formatFileSize(bytes) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
    }

    // Remove File
    window.removeFile = function() {
        selectedFile = null;
        fileInput.value = '';
        filePreview.style.display = 'none';
        mediaPreview.innerHTML = '';
    };

    // Form Submission
    document.getElementById('uploadForm').addEventListener('submit', function(e) {
        if (!selectedFile) {
            e.preventDefault();
            showNotification('Veuillez sélectionner un fichier à uploader', 'error');
            return;
        }
        
        // Disable submit button
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
            Upload en cours...
        `;
    });

    // Notification System
    function showNotification(message, type = 'info') {
        // Remove existing notifications
        const existing = document.querySelector('.notification-toast');
        if (existing) existing.remove();
        
        const toast = document.createElement('div');
        toast.className = `notification-toast alert alert-${type === 'error' ? 'danger' : 'success'} fade show`;
        toast.innerHTML = `
            <div class="d-flex align-items-center">
                <i class="bi ${type === 'error' ? 'bi-exclamation-triangle-fill' : 'bi-check-circle-fill'} me-2"></i>
                <div>${message}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        toast.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
            min-width: 300px;
            max-width: 400px;
            animation: slideInRight 0.3s ease-out;
        `;
        
        document.body.appendChild(toast);
        
        // Auto-remove after 5 seconds
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 5000);
    }

    // Add animation style
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    `;
    document.head.appendChild(style);
});
</script>
@endpush