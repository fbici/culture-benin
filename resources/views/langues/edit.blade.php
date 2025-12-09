@extends('layout')

@section('title')
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">
                <i class="bi bi-pencil-square me-2"></i>Modifier la Langue
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.langues.index') }}" class="text-decoration-none">Langues</a></li>
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
                        <i class="bi bi-pencil me-2"></i>Modification
                    </h3>
                    <span class="badge bg-light text-dark">
                        ID: {{ $langue->id_langue }}
                    </span>
                </div>
            </div>
            
            <div class="card-body p-4">
                <!-- Informations de la langue -->
                <div class="alert alert-info border-0 mb-4">
                    <div class="d-flex">
                        <i class="bi bi-info-circle me-2 fs-5"></i>
                        <div>
                            <h6 class="alert-heading mb-1">Modification de "{{ $langue->nom_langue }}"</h6>
                            <p class="mb-0">Mettez à jour les informations de cette langue.</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.langues.update', $langue->id_langue) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    
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
                                   value="{{ old('code_langue', $langue->code_langue) }}" 
                                   maxlength="3"
                                   required>
                        </div>
                        @error('code_langue')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
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
                                   value="{{ old('nom_langue', $langue->nom_langue) }}" 
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
                                  rows="4">{{ old('description', $langue->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Informations de suivi -->
                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body py-3">
                            <div class="row text-muted small">
                                <div class="col-md-6">
                                    <i class="bi bi-calendar-plus me-1"></i>
                                    Créé le : {{ $langue->created_at->format('d/m/Y à H:i') }}
                                </div>
                                <div class="col-md-6">
                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                    Modifié le : {{ $langue->updated_at->format('d/m/Y à H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons -->
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('admin.langues.index') }}" class="btn btn-danger">
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