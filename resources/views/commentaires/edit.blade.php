@extends('layout')

@section('title')
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">
                <i class="bi bi-pencil-square me-2"></i>Modifier le Commentaire
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.commentaires.index') }}" class="text-decoration-none">Commentaires</a></li>
                <li class="breadcrumb-item active text-culture-green" aria-current="page">Modification</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <h4 class="alert-heading"><i class="bi bi-exclamation-triangle-fill me-2"></i>Erreur(s) de Validation :</h4>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-culture">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 text-white">
                        <i class="bi bi-chat-square-text me-2"></i>Modification du Commentaire ID: **{{ $commentaire->id_commentaire }}**
                    </h3>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.commentaires.update', $commentaire->id_commentaire) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h5 class="text-primary mb-3"><i class="bi bi-link-45deg me-2"></i>Liens</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="id_utilisateur" class="form-label fw-semibold">Auteur <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_utilisateur') is-invalid @enderror" id="id_utilisateur" name="id_utilisateur" required>
                                <option value="">Choisir l'utilisateur...</option>
                                @foreach($utilisateurs as $id => $nom)
                                    <option value="{{ $id }}" {{ old('id_utilisateur', $commentaire->id_utilisateur) == $id ? 'selected' : '' }}>{{ $nom }}</option>
                                @endforeach
                            </select>
                            @error('id_utilisateur')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="id_contenu" class="form-label fw-semibold">Contenu Commenté <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_contenu') is-invalid @enderror" id="id_contenu" name="id_contenu" required>
                                <option value="">Choisir le contenu...</option>
                                @foreach($contenus as $id => $titre)
                                    <option value="{{ $id }}" {{ old('id_contenu', $commentaire->id_contenu) == $id ? 'selected' : '' }}>{{ Str::limit($titre, 40) }}</option>
                                @endforeach
                            </select>
                            @error('id_contenu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <h5 class="text-primary mt-4 mb-3"><i class="bi bi-star-fill me-2"></i>Note & Date</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="note" class="form-label fw-semibold">Note (1 à 5)</label>
                            <input type="number" class="form-control @error('note') is-invalid @enderror" id="note" name="note" value="{{ old('note', $commentaire->note) }}" min="1" max="5">
                            @error('note')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <label for="date" class="form-label fw-semibold">Date de Publication</label>
                            <input type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date', $commentaire->date?->format('Y-m-d')) }}">
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <h5 class="text-primary mt-4 mb-3"><i class="bi bi-body-text me-2"></i>Commentaire</h5>
                    <div class="mb-4">
                        <label for="texte" class="form-label fw-semibold">Texte du Commentaire <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('texte') is-invalid @enderror" id="texte" name="texte" rows="5" required>{{ old('texte', $commentaire->texte) }}</textarea>
                        @error('texte')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-4">
                        <a href="{{ route('admin.commentaires.index') }}" class="btn btn-danger">
                            <i class="bi bi-x-circle me-2"></i>Annuler
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="bi bi-check-circle me-2"></i>Mettre à jour le Commentaire
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection