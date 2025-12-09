@extends('layout')

@section('title')
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">
                <i class="bi bi-pencil-square me-2"></i>Modifier le Rôle
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.roles.index') }}" class="text-decoration-none">Rôles</a></li>
                <li class="breadcrumb-item active text-culture-green" aria-current="page">Modifier</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-culture">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 text-white">
                        <i class="bi bi-pencil me-2"></i>Modification du Rôle
                    </h3>
                    <span class="badge bg-light text-dark">
                        ID: {{ $role->id_role }}
                    </span>
                </div>
            </div>
            
            <div class="card-body p-4">
                <div class="alert alert-info border-0 mb-4">
                    <div class="d-flex">
                        <i class="bi bi-info-circle me-2 fs-5"></i>
                        <div>
                            <h6 class="alert-heading mb-1">Modification de "{{ $role->nom_role }}"</h6>
                            <p class="mb-0">Mettez à jour le nom de ce rôle.</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.roles.update', $role->id_role) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    
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
                                   value="{{ old('nom_role', $role->nom_role) }}" 
                                   required>
                        </div>
                        @error('nom_role')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body py-3">
                            <div class="row text-muted small">
                                <div class="col-md-6">
                                    <i class="bi bi-calendar-plus me-1"></i>
                                    Créé le : {{ $role->created_at->format('d/m/Y à H:i') }}
                                </div>
                                <div class="col-md-6">
                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                    Modifié le : {{ $role->updated_at->format('d/m/Y à H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('admin.roles.index') }}" class="btn btn-danger">
                            <i class="bi bi-x-circle me-2"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-success px-4">
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
</script>
@endpush