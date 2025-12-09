@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0">Détails de la Langue</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.langues.index') }}">Langues</a></li>
                <li class="breadcrumb-item active" aria-current="page">Détails</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')

<style>
    .info-card {
        border-radius: 12px;
        padding: 22px;
        background: #f8f9fa;
        border: 1px solid #e3e3e3;
        margin-bottom: 25px;
    }
</style>

<div class="row justify-content-center">
    <div class="col-lg-8">

        <div class="card">
            <div class="card-header card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-white mb-0">
                        <i class="bi bi-info-circle me-2"></i>Détails de la Langue
                    </h3>
                    <span class="badge bg-light text-dark">
                        ID: {{ $langue->id_langue }}
                    </span>
                </div>
            </div>
            
            <div class="card-body">

                <div class="text-center mb-4">
                    <div class="display-4 text-primary mb-2">
                        <i class="bi bi-translate"></i>
                    </div>

                    <h2>{{ $langue->nom_langue }}</h2>

                    <span class="badge bg-primary fs-6">
                        {{ strtoupper($langue->code_langue) }}
                    </span>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="info-card">
                            <h5 class="text-primary mb-3">
                                <i class="bi bi-info-circle me-2"></i>Informations Générales
                            </h5>

                            <p class="mb-2">
                                <strong>Code :</strong>
                                <span class="ms-2 fw-semibold">{{ strtoupper($langue->code_langue) }}</span>
                            </p>

                            <p class="mb-2">
                                <strong>Nom complet :</strong>
                                <span class="ms-2 fw-semibold">{{ $langue->nom_langue }}</span>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="info-card">
                            <h5 class="text-primary mb-3">
                                <i class="bi bi-clock me-2"></i>Dates
                            </h5>

                            <p class="mb-2">
                                <strong>Créée le :</strong>
                                <span class="ms-2 text-muted">
                                    {{ $langue->created_at->format('d/m/Y H:i') }}
                                </span>
                            </p>

                            <p class="mb-2">
                                <strong>Modifiée le :</strong>
                                <span class="ms-2 text-muted">
                                    {{ $langue->updated_at->format('d/m/Y H:i') }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="info-card">
                    <h5 class="text-primary mb-3">
                        <i class="bi bi-card-text me-2"></i>Description
                    </h5>

                    @if($langue->description)
                        <p class="ms-1">{{ $langue->description }}</p>
                    @else
                        <p class="text-muted fst-italic ms-1">Aucune description disponible.</p>
                    @endif
                </div>

                <div class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                    <a href="{{ route('admin.langues.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-2"></i>Retour
                    </a>

                    <div class="btn-group">
                        <a href="{{ route('admin.langues.edit', $langue->id_langue) }}" class="btn btn-warning">
                            <i class="bi bi-pencil-square me-2"></i>Modifier
                        </a>

                        <a href="{{ route('admin.langues.create') }}" class="btn btn-success">
                            <i class="bi bi-plus-circle me-2"></i>Nouvelle Langue
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
