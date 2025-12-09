@extends('layout')

@section('title')
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">
                <i class="bi bi-pencil-square me-2"></i>Modifier le Type de Contenu
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.type_contenus.index') }}" class="text-decoration-none">Types</a></li>
                <li class="breadcrumb-item active text-culture-green" aria-current="page">Modifier</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-culture">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 text-white">
                        <i class="bi bi-pencil me-2"></i>Modification du Type
                    </h3>
                    <span class="badge bg-light text-dark">
                        ID: {{ $typeContenu->id_type }}
                    </span>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.type_contenus.update', $typeContenu->id_type) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    
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
                                   value="{{ old('nom', $typeContenu->nom) }}" 
                                   required>
                        </div>
                        <small class="form-text text-muted">Slug généré : <code class="text-primary">{{ $typeContenu->slug }}</code></small>
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
                                <i class="{{ old('icone_css', $typeContenu->icone_css) ?: 'bi bi-brush' }} text-muted fs-5 me-1" id="icone-preview"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('icone_css') is-invalid @enderror" 
                                   id="icone_css" 
                                   name="icone_css" 
                                   value="{{ old('icone_css', $typeContenu->icone_css) }}" 
                                   placeholder="Ex: bi bi-file-text">
                        </div>
                        <small class="form-text text-muted">Cette icône s'affichera à côté des contenus de ce type.</small>
                        @error('icone_css')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description (Optionnel)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                 id="description" 
                                 name="description" 
                                 rows="4">{{ old('description', $typeContenu->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('admin.type_contenus.index') }}" class="btn btn-danger">
                            <i class="bi bi-x-circle me-2"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle me-2"></i>Mettre à jour
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

    // Preview de l'icône
    document.getElementById('icone_css').addEventListener('input', function(e) {
        let preview = document.getElementById('icone-preview');
        // Supprime toutes les classes existantes (sauf les classes d'état/taille)
        preview.className = preview.className.split(' ').filter(c => !c.startsWith('bi-')).join(' ');
        
        // Ajoute la nouvelle classe si elle existe
        if (e.target.value) {
            preview.classList.add(e.target.value);
        } else {
            // Remet une icône par défaut si le champ est vide
            preview.classList.add('bi-brush');
        }
    });
</script>
@endpush