@extends('layout')

@section('title')
    <div class="row align-items-center">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">
                <i class="bi bi-person-gear me-2"></i>Modifier l'Utilisateur : {{ $user->nom_complet }}
            </h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}" class="text-decoration-none">Utilisateurs</a></li>
                <li class="breadcrumb-item active text-culture-green" aria-current="page">Modification</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
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
                        <i class="bi bi-pencil me-2"></i>Modification des informations
                    </h3>
                    <span class="badge bg-light text-dark">ID: {{ $user->id_utilisateur }}</span>
                </div>
            </div>
            
            <div class="card-body p-4">
                <form action="{{ route('admin.users.update', $user->id_utilisateur) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h5 class="text-primary mb-3"><i class="bi bi-person-vcard me-2"></i>Identité et Contact</h5>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="nom" class="form-label fw-semibold">Nom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" id="nom" name="nom" value="{{ old('nom', $user->nom) }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="prenom" class="form-label fw-semibold">Prénom <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom', $user->prenom) }}" required>
                            @error('prenom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <h5 class="text-primary mt-4 mb-3"><i class="bi bi-lock-fill me-2"></i>Mise à jour du Mot de Passe (Optionnel)</h5>
                    <p class="text-muted small">Remplissez ces champs uniquement si vous souhaitez changer le mot de passe.</p>
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="mot_de_passe" class="form-label fw-semibold">Nouveau Mot de Passe</label>
                            <input type="password" class="form-control @error('mot_de_passe') is-invalid @enderror" id="mot_de_passe" name="mot_de_passe">
                            @error('mot_de_passe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="mot_de_passe_confirmation" class="form-label fw-semibold">Confirmer Nouveau Mot de Passe</label>
                            <input type="password" class="form-control" id="mot_de_passe_confirmation" name="mot_de_passe_confirmation">
                        </div>
                    </div>

                    <h5 class="text-primary mt-4 mb-3"><i class="bi bi-gear-fill me-2"></i>Détails et Préférences</h5>
                    <div class="row">
                        <div class="col-md-4 mb-4">
                            <label for="id_role" class="form-label fw-semibold">Rôle <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_role') is-invalid @enderror" id="id_role" name="id_role" required>
                                <option value="">Choisir un rôle...</option>
                                @foreach($roles as $id => $nom)
                                    <option value="{{ $id }}" {{ old('id_role', $user->id_role) == $id ? 'selected' : '' }}>{{ $nom }}</option>
                                @endforeach
                            </select>
                            @error('id_role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="id_langue" class="form-label fw-semibold">Langue Préférée <span class="text-danger">*</span></label>
                            <select class="form-select @error('id_langue') is-invalid @enderror" id="id_langue" name="id_langue" required>
                                <option value="">Choisir une langue...</option>
                                @foreach($langues as $id => $nom)
                                    <option value="{{ $id }}" {{ old('id_langue', $user->id_langue) == $id ? 'selected' : '' }}>{{ $nom }}</option>
                                @endforeach
                            </select>
                            @error('id_langue')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-4">
                            <label for="statut" class="form-label fw-semibold">Statut <span class="text-danger">*</span></label>
                            <select class="form-select @error('statut') is-invalid @enderror" id="statut" name="statut" required>
                                <option value="">Choisir un statut...</option>
                                @foreach($statuts as $key => $value)
                                    <option value="{{ $key }}" {{ old('statut', $user->statut) == $key ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                            @error('statut')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <label for="sexe" class="form-label fw-semibold">Sexe <span class="text-danger">*</span></label>
                            <select class="form-select @error('sexe') is-invalid @enderror" id="sexe" name="sexe" required>
                                <option value="">Choisir...</option>
                                <option value="M" {{ old('sexe', $user->sexe) == 'M' ? 'selected' : '' }}>Masculin</option>
                                <option value="F" {{ old('sexe', $user->sexe) == 'F' ? 'selected' : '' }}>Féminin</option>
                                <option value="A" {{ old('sexe', $user->sexe) == 'A' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('sexe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-4">
                            <label for="date_naissance" class="form-label fw-semibold">Date de Naissance</label>
                            <input type="date" class="form-control @error('date_naissance') is-invalid @enderror" id="date_naissance" name="date_naissance" value="{{ old('date_naissance', $user->date_naissance?->format('Y-m-d')) }}">
                            @error('date_naissance')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-3">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-danger">
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