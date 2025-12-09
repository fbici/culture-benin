@extends('layout')

@section('title')
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">
                <i class="bi bi-pencil-square me-2"></i>Modifier le Média
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.medias.index') }}" class="text-decoration-none">Médias</a></li>
                <li class="breadcrumb-item active text-culture-green" aria-current="page">Modification</li>
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
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 text-white">
                        <i class="bi bi-file-earmark-image me-2"></i>Modification du Média ID: {{ $media->id_media }}
                    </h3>
                    <span class="badge bg-light text-dark">Type: {{ $media->typeMedia->nom ?? 'Inconnu' }}</span>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.medias.update', $media->id_media) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="id_type_media" class="form-label fw-semibold">Type de Média <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_type_media') is-invalid @enderror" id="id_type_media" name="id_type_media" required>
                                <option value="">Choisir...</option>
                                @foreach($types as $id => $nom)
                                    <option value="{{ $id }}" {{ old('id_type_media', $media->id_type_media) == $id ? 'selected' : '' }}>{{ $nom }}</option>
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
                                   value="{{ old('Chemin', $media->Chemin) }}" 
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
                                  placeholder="Décrivez brièvement le contenu du média pour l'accessibilité.">{{ old('description', $media->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-4">
                        <a href="{{ route('admin.medias.index') }}" class="btn btn-danger">
                            <i class="bi bi-x-circle me-2"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle me-2"></i>Mettre à jour le Média
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection