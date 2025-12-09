@extends('layout')

@section('title')
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">
                <i class="bi bi-pencil-square me-2"></i>Modifier le Contenu
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.contenus.index') }}" class="text-decoration-none">Contenus</a></li>
                <li class="breadcrumb-item active text-culture-green" aria-current="page">Modification</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill me-2"></i>Erreur(s) de Validation :</h4>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-culture">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 text-white">
                        <i class="bi bi-pencil me-2"></i>Modification du Contenu : **{{ Str::limit($contenu->titre, 50) }}**
                    </h3>
                    <span class="badge bg-light text-dark">ID: {{ $contenu->id_contenu }}</span>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.contenus.update', $contenu->id_contenu) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h5 class="text-primary mb-3"><i class="bi bi-card-heading me-2"></i>Identification</h5>
                    <div class="row">
                        <div class="col-12 mb-4">
                            <label for="titre" class="form-label fw-semibold">Titre <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('titre') is-invalid @enderror" id="titre" name="titre" value="{{ old('titre', $contenu->titre) }}" required>
                            @error('titre')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <h5 class="text-primary mt-4 mb-3"><i class="bi bi-columns-gap me-2"></i>Classification</h5>
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <label for="id_type_contenu" class="form-label fw-semibold">Type <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_type_contenu') is-invalid @enderror" id="id_type_contenu" name="id_type_contenu" required>
                                <option value="">Choisir...</option>
                                @foreach($types as $id => $nom)
                                    <option value="{{ $id }}" {{ old('id_type_contenu', $contenu->id_type_contenu) == $id ? 'selected' : '' }}>{{ $nom }}</option>
                                @endforeach
                            </select>
                            @error('id_type_contenu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-4">
                            <label for="id_region" class="form-label fw-semibold">Région <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_region') is-invalid @enderror" id="id_region" name="id_region" required>
                                <option value="">Choisir...</option>
                                @foreach($regions as $id => $nom)
                                    <option value="{{ $id }}" {{ old('id_region', $contenu->id_region) == $id ? 'selected' : '' }}>{{ $nom }}</option>
                                @endforeach
                            </select>
                            @error('id_region')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-4">
                            <label for="id_langue" class="form-label fw-semibold">Langue <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_langue') is-invalid @enderror" id="id_langue" name="id_langue" required>
                                <option value="">Choisir...</option>
                                @foreach($langues as $id => $nom)
                                    <option value="{{ $id }}" {{ old('id_langue', $contenu->id_langue) == $id ? 'selected' : '' }}>{{ $nom }}</option>
                                @endforeach
                            </select>
                            @error('id_langue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-3 mb-4">
                            <label for="id_parent" class="form-label fw-semibold">Contenu Parent</label>
                            <select class="form-select @error('id_parent') is-invalid @enderror" id="id_parent" name="id_parent">
                                <option value="">Aucun parent</option>
                                @foreach($parents as $id => $titre)
                                    <option value="{{ $id }}" {{ old('id_parent', $contenu->id_parent) == $id ? 'selected' : '' }}>{{ Str::limit($titre, 40) }}</option>
                                @endforeach
                            </select>
                            @error('id_parent')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <h5 class="text-primary mt-4 mb-3"><i class="bi bi-person-fill-gear me-2"></i>Workflow & Dates</h5>
                    <div class="row">
                        <div class="col-md-3 mb-4">
                            <label for="id_auteur" class="form-label fw-semibold">Auteur <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_auteur') is-invalid @enderror" id="id_auteur" name="id_auteur" required>
                                <option value="">Choisir...</option>
                                @foreach($auteurs as $id => $nom)
                                    <option value="{{ $id }}" {{ old('id_auteur', $contenu->id_auteur) == $id ? 'selected' : '' }}>{{ $nom }}</option>
                                @endforeach
                            </select>
                            @error('id_auteur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-3 mb-4">
                            <label for="id_moderateur" class="form-label fw-semibold">Modérateur</label>
                            <select class="form-select @error('id_moderateur') is-invalid @enderror" id="id_moderateur" name="id_moderateur">
                                <option value="">Non modéré</option>
                                @foreach($auteurs as $id => $nom) 
                                    <option value="{{ $id }}" {{ old('id_moderateur', $contenu->id_moderateur) == $id ? 'selected' : '' }}>{{ $nom }}</option>
                                @endforeach
                            </select>
                            @error('id_moderateur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-4">
                            <label for="statut" class="form-label fw-semibold">Statut <span class="text-danger">*</span></label>
                            <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" required>
                                <option value="">Choisir...</option>
                                @foreach($statuts as $key => $info)
                                    <option value="{{ $key }}" {{ old('statut', $contenu->statut) == $key ? 'selected' : '' }}>{{ $info['label'] }}</option>
                                @endforeach
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-3 mb-4">
                            <label for="date_creation" class="form-label fw-semibold">Date de Création</label>
                            <input type="date" class="form-control @error('date_creation') is-invalid @enderror" id="date_creation" name="date_creation" value="{{ old('date_creation', $contenu->date_creation?->format('Y-m-d')) }}">
                            @error('date_creation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <input type="hidden" name="date_validation" value="{{ old('date_validation', $contenu->date_validation?->format('Y-m-d H:i:s')) }}">

                    </div>
                    
                    <h5 class="text-primary mt-4 mb-3"><i class="bi bi-body-text me-2"></i>Corps du Contenu</h5>
                    <div class="mb-4">
                        <label for="texte" class="form-label fw-semibold">Contenu Textuel/HTML <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('texte') is-invalid @enderror" id="texte" name="texte" rows="10" required>{{ old('texte', $contenu->texte) }}</textarea>
                        @error('texte')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-4">
                        <a href="{{ route('admin.contenus.index') }}" class="btn btn-danger">
                            <i class="bi bi-x-circle me-2"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle me-2"></i>Mettre à jour le Contenu
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection