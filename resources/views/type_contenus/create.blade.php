@extends('layout')

@section('title')
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">
                <i class="bi bi-tag-fill me-2"></i>Ajouter un Type de Contenu
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.type_contenus.index') }}" class="text-decoration-none">Types</a></li>
                <li class="breadcrumb-item active text-culture-green" aria-current="page">Nouveau Type</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-culture">
                <h3 class="card-title mb-0 text-black">
                    <i class="bi bi-file-earmark-plus me-2"></i>Formulaire d'ajout
                </h3>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.type_contenus.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    
                    <div class="mb-4">
                        <label for="nom" class="form-label fw-semibold">
                            Nom du Type <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-folder-symlink-fill text-muted"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('nom') is-invalid @enderror" 
                                   id="nom" 
                                   name="nom" 
                                   value="{{ old('nom') }}" 
                                   placeholder="Ex: Article, Vidéo, Événement, Fiche Technique"
                                   required>
                        </div>
                        @error('nom')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="icone_css" class="form-label fw-semibold">
                            Classe d'Icône CSS (Bootstrap Icons)
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-brush text-muted"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('icone_css') is-invalid @enderror" 
                                   id="icone_css" 
                                   name="icone_css" 
                                   value="{{ old('icone_css') }}" 
                                   placeholder="Ex: bi bi-file-text, bi bi-camera-video">
                        </div>
                        <small class="form-text text-muted">Utilisez une classe Bootstrap Icons pour la représentation visuelle.</small>
                        @error('icone_css')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description (Optionnel)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                 id="description" 
                                 name="description" 
                                 rows="4" 
                                 placeholder="Décrivez l'usage de ce type de contenu...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('admin.type_contenus.index') }}" class="btn btn-danger">
                            <i class="bi bi-x-circle me-2"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle me-2"></i>Enregistrer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    // Validation Bootstrap
    (function () {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
    })()
</script>
@endpush