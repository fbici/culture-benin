@extends('layout')

@section('title')
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">
                <i class="bi bi-plus-circle me-2"></i>Ajouter une Langue
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.langues.index') }}" class="text-decoration-none">Langues</a></li>
                <li class="breadcrumb-item active text-culture-green" aria-current="page">Nouvelle Langue</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-culture">
                <h3 class="card-title mb-0 text-white">
                    <i class="bi bi-file-earmark-plus me-2"></i>Formulaire d'ajout
                </h3>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.langues.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    
                    <!-- Code Langue -->
                    <div class="mb-4">
                        <label for="code_langue" class="form-label fw-semibold">
                            Code de la langue <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-code-slash text-muted"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('code_langue') is-invalid @enderror" 
                                   id="code_langue" 
                                   name="code_langue" 
                                   value="{{ old('code_langue') }}" 
                                   placeholder="fr, en, yo, fon..."
                                   maxlength="3"
                                   required>
                        </div>
                        @error('code_langue')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-muted">
                            Code ISO à 2 ou 3 caractères (ex: fr, en, es, de, yo, fon)
                        </div>
                    </div>

                    <!-- Nom Langue -->
                    <div class="mb-4">
                        <label for="nom_langue" class="form-label fw-semibold">
                            Nom de la langue <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-translate text-muted"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('nom_langue') is-invalid @enderror" 
                                   id="nom_langue" 
                                   name="nom_langue" 
                                   value="{{ old('nom_langue') }}" 
                                   placeholder="Français, English, Yoruba, Fon..."
                                   required>
                        </div>
                        @error('nom_langue')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Description optionnelle de la langue...">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Boutons -->
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('admin.langues.index') }}" class="btn btn-danger">
                            <i class="bi bi-x-circle me-2"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-success px-4">
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