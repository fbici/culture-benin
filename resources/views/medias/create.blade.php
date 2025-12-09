@extends('layout')

@section('title')
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">
                <i class="bi bi-upload me-2"></i>Ajouter un Nouveau Média
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.medias.index') }}" class="text-decoration-none">Médias</a></li>
                <li class="breadcrumb-item active text-culture-green" aria-current="page">Création</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        @if ($errors->any())
            <div class="alert alert-danger">
                Veuillez corriger les erreurs ci-dessous.
            </div>
        @endif
        
        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-culture">
                <h3 class="card-title mb-0 text-white">
                    <i class="bi bi-file-earmark-image me-2"></i>Formulaire d'ajout de Média
                </h3>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.medias.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="id_type_media" class="form-label fw-semibold">Type de Média <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_type_media') is-invalid @enderror" id="id_type_media" name="id_type_media" required>
                                <option value="">Choisir...</option>
                                @foreach($types as $id => $nom)
                                    <option value="{{ $id }}" {{ old('id_type_media') == $id ? 'selected' : '' }}>{{ $nom }}</option>
                                @endforeach
                            </select>
                            @error('id_type_media')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="Chemin" class="form-label fw-semibold">Chemin du Fichier (ou URL) <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('Chemin') is-invalid @enderror" 
                                   id="Chemin" 
                                   name="Chemin" 
                                   value="{{ old('Chemin') }}" 
                                   placeholder="Ex: /uploads/image-001.jpg"
                                   required>
                            @error('Chemin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-4">
                        <label for="description" class="form-label fw-semibold">Description / Texte Alternatif</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="3" 
                                  placeholder="Décrivez brièvement le contenu du média pour l'accessibilité.">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-4">
                        <a href="{{ route('admin.medias.index') }}" class="btn btn-danger">
                            <i class="bi bi-x-circle me-2"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle me-2"></i>Enregistrer le Média
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection