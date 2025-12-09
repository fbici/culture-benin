@extends('layout')

@section('title')
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">
                <i class="bi bi-pencil-square me-2"></i>Modifier la Région
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.regions.index') }}" class="text-decoration-none">Régions</a></li>
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
                        ID: {{ $region->id_region }}
                    </span>
                </div>
            </div>
            
            <div class="card-body p-4">
                <div class="alert alert-info border-0 mb-4">
                    <div class="d-flex">
                        <i class="bi bi-info-circle me-2 fs-5"></i>
                        <div>
                            <h6 class="alert-heading mb-1">Modification de "{{ $region->nom_region }}"</h6>
                            <p class="mb-0">Mettez à jour le nom et la description de cette région.</p>
                        </div>
                    </div>
                </div>

                <form action="{{ route('admin.regions.update', $region->id_region) }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label for="nom_region" class="form-label fw-semibold">
                            Nom de la Région <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-geo-alt-fill text-muted"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('nom_region') is-invalid @enderror" 
                                   id="nom_region" 
                                   name="nom_region" 
                                   value="{{ old('nom_region', $region->nom_region) }}" 
                                   required>
                        </div>
                        @error('nom_region')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    

                    <h5 class="mt-4 mb-3 text-culture-green border-bottom pb-1">Statistiques Clés</h5>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="population" class="form-label fw-semibold">Population (Nombre d'habitants)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-people-fill text-muted"></i>
                                </span>
                                <input type="number" 
                                       class="form-control @error('population') is-invalid @enderror" 
                                       id="population" 
                                       name="population" 
                                       value="{{ old('population', $region->population ) }}" 
                                       min="0"
                                       placeholder="Ex: 1500000">
                            </div>
                            @error('population')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="superficie" class="form-label fw-semibold">Superficie (en Km²)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0">
                                    <i class="bi bi-rulers text-muted"></i>
                                </span>
                                <input type="number" 
                                       step="0.01"
                                       class="form-control @error('superficie') is-invalid @enderror" 
                                       id="superficie" 
                                       name="superficie" 
                                       value="{{ old('superficie', $region->superficie ) }}" 
                                       min="0"
                                       placeholder="Ex: 5678.90">
                            </div>
                            @error('superficie')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="localisation" class="form-label fw-semibold">Localisation (Coordonnées ou Centre)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">
                                <i class="bi bi-geo-alt text-muted"></i>
                            </span>
                            <input type="text" 
                                   class="form-control @error('localisation') is-invalid @enderror" 
                                   id="localisation" 
                                   name="localisation" 
                                   value="{{ old('localisation', $region->localisation ) }}" 
                                   placeholder="Ex: 9.6000, 2.3000 (Lat, Lon)">
                        </div>
                        @error('localisation')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    


                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description (Optionnel)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                 id="description" 
                                 name="description" 
                                 rows="4">{{ old('description', $region->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="card bg-light border-0 mb-4">
                        <div class="card-body py-3">
                            <div class="row text-muted small">
                                <div class="col-md-6">
                                    <i class="bi bi-calendar-plus me-1"></i>
                                    Créé le : {{ $region->created_at->format('d/m/Y à H:i') }}
                                </div>
                                <div class="col-md-6">
                                    <i class="bi bi-arrow-clockwise me-1"></i>
                                    Modifié le : {{ $region->updated_at->format('d/m/Y à H:i') }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('admin.regions.index') }}" class="btn btn-danger">
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
</script>
@endpush