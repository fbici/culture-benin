@extends('user.layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 text-culture-green">
            <i class="bi bi-eye-fill me-2"></i>Détail du Contenu
        </h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.contenus.index') }}" class="text-decoration-none">Mes Contenus</a></li>
            <li class="breadcrumb-item active text-culture-green" aria-current="page">Détail</li>
        </ol>
    </div>
</div>
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm">
            <div class="card-header card-header-culture">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0 text-white">
                        <i class="bi bi-file-earmark-text me-2"></i>{{ $contenu->titre }}
                    </h3>
                    <span class="badge bg-light text-dark">ID: {{ $contenu->id_contenu }}</span>
                </div>
            </div>
            
            <div class="card-body p-4">
                <!-- En-tête -->
                <div class="text-center mb-4 border-bottom pb-3">
                    <h2 class="h4 mb-3">{{ $contenu->titre }}</h2>
                    @php
                        $statusInfo = $statuts[$contenu->statut] ?? $statuts['brouillon'];
                    @endphp
                    <span class="badge fs-6 {{ $statusInfo['badge'] }}">{{ $statusInfo['label'] }}</span>
                </div>

                <!-- Informations -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="text-primary mb-3"><i class="bi bi-tags me-2"></i>Classification</h5>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold">Type :</span>
                                <span>{{ $contenu->typeContenu->nom ?? 'N/A' }}</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold">Région :</span>
                                <span>{{ $contenu->region->nom_region ?? 'N/A' }}</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold">Langue :</span>
                                <span>{{ $contenu->langue->nom_langue ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h5 class="text-primary mb-3"><i class="bi bi-calendar me-2"></i>Dates</h5>
                        <div class="list-group list-group-flush">
                            <div class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold">Créé le :</span>
                                <span>{{ $contenu->created_at->format('d/m/Y H:i') }}</span>
                            </div>
                            <div class="list-group-item d-flex justify-content-between">
                                <span class="fw-semibold">Dernière MAJ :</span>
                                <span>{{ $contenu->updated_at->format('d/m/Y H:i') }}</span>
                            </div>
                            @if($contenu->date_validation)
                                <div class="list-group-item d-flex justify-content-between">
                                    <span class="fw-semibold">Publié le :</span>
                                    <span class="text-success">{{ $contenu->date_validation->format('d/m/Y H:i') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contenu -->
                <h5 class="text-primary mb-3"><i class="bi bi-text-paragraph me-2"></i>Contenu</h5>
                <div class="p-3 bg-light border rounded mb-4">
                    <div class="content-text">
                        {!! nl2br(e($contenu->texte)) !!}
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-flex justify-content-between align-items-center border-top pt-3">
                    <a href="{{ route('user.contenus.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Retour à la liste
                    </a>
                    <div class="btn-group">
                        <a href="{{ route('user.contenus.edit', $contenu->id_contenu) }}" class="btn btn-warning">
                            <i class="bi bi-pencil me-2"></i>Modifier
                        </a>
                        @if($contenu->statut === 'publie')
                            <a href="{{ url('/contenus/' . $contenu->id_contenu) }}" target="_blank" class="btn btn-success">
                                <i class="bi bi-eye me-2"></i>Voir sur le site
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.content-text {
    line-height: 1.8;
    font-size: 1.05rem;
}

.content-text p {
    margin-bottom: 1rem;
}

.list-group-item {
    border: none;
    padding: 0.75rem 0;
}
</style>
@endsection