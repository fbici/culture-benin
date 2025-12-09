@extends('layout')

@section('title')
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">
                <i class="bi bi-person-plus me-2"></i>Ajouter un Rôle
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}" class="text-decoration-none">Rôles</a></li>
                <li class="breadcrumb-item active text-culture-green" aria-current="page">Nouveau Rôle</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-culture">
                <h3 class="card-title mb-0 text-white">
                    <i class="bi bi-file-earmark-plus me-2"></i>Formulaire d'ajout
                </h3>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.roles.store') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    
                    <div class="mb-4">
                        <label for="nom_role" class="form-label fw-semibold">
                            Nom du Rôle <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-person-badge-fill text-muted"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('nom_role') is-invalid @enderror" 
                                   id="nom_role" 
                                   name="nom_role" 
                                   value="{{ old('nom_role') }}" 
                                   placeholder="Admin, Editeur, Utilisateur..."
                                   required>
                        </div>
                        @error('nom_role')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                        <div class="form-text text-muted">
                            Le nom du rôle doit être unique (ex: "Administrateur", "Modérateur").
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-danger">
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