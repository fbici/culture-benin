@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">Gestion des Types de Contenus</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Types de Contenus</li>
            </ol>
        </div>
    </div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<style>
    .dataTables_wrapper .dataTables_length,
    .dataTables_wrapper .dataTables_filter {
        margin-bottom: 1rem;
    }
    .dataTables_wrapper .dataTables_filter input {
        margin-left: 0.5rem;
    }
</style>
@endsection

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header card-header-custom">
                <div class="d-flex justify-content-between align-items-center">
                    <h3 class="card-title text-black mb-0">Liste des Types de Contenus</h3>
                    <a href="{{ route('admin.type_contenus.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-tag-fill me-1"></i> Nouveau Type
                    </a>
                </div>
            </div>
            
            <div class="card-body">
                
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>{{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="typeContenusTable" class="table table-bordered table-striped table-hover w-100">
                        <thead>
                            <tr>
                                <th style="width: 5%">#</th>
                                <th style="width: 30%">Nom du Type</th>
                                <th style="width: 25%">Slug & Icône</th>
                                <th style="width: 20%">Date Création</th>
                                <th style="width: 20%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($typeContenus as $typeContenu)
                            <tr>
                                <td>{{ $typeContenu->id_type }}</td>
                                
                                <td>
                                    <strong>{{ $typeContenu->nom }}</strong>
                                    <br>
                                    <small class="text-muted fst-italic">{{ Str::limit($typeContenu->description, 50, '...') }}</small>
                                </td>
                                
                                <td>
                                    <span class="badge bg-secondary me-2">{{ $typeContenu->slug }}</span>
                                    @if($typeContenu->icone_css)
                                        <i class="{{ $typeContenu->icone_css }} fs-5 text-primary" title="Icône : {{ $typeContenu->icone_css }}"></i>
                                    @else
                                        <span class="text-muted fst-italic">Sans icône</span>
                                    @endif
                                </td>
                                
                                <td>{{ $typeContenu->created_at->format('d/m/Y H:i') }}</td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('admin.type_contenus.show', $typeContenu->id_type) }}"
                                           class="btn btn-info btn-sm action-btn"
                                           title="Voir">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <a href="{{ route('admin.type_contenus.edit', $typeContenu->id_type) }}"
                                           class="btn btn-warning btn-sm action-btn"
                                           title="Modifier">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('admin.type_contenus.destroy', $typeContenu->id_type) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm action-btn"
                                                    title="Supprimer"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer le type {{ $typeContenu->nom }} ?')">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-folder-fill display-4 d-block mb-3"></i>
                                        Aucun type de contenu enregistré pour le moment.
                                        <br>
                                        <a href="{{ route('admin.type_contenus.create') }}" class="btn btn-primary mt-3">
                                            <i class="bi bi-plus-circle me-1"></i> Ajouter le premier type
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    // Initialiser DataTable
    var table = $('#typeContenusTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
        },
        responsive: true,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tous"]],
        order: [[0, 'desc']],
        columnDefs: [
            {
                targets: [4], // Désactiver le tri sur la colonne Actions
                orderable: false,
                searchable: false
            }
        ],
        initComplete: function() {
            // Personnaliser les labels
            $('.dataTables_length label').contents().filter(function() {
                return this.nodeType === 3;
            }).remove();
            $('.dataTables_length label').prepend('Afficher : ');
            
            $('.dataTables_filter label').contents().filter(function() {
                return this.nodeType === 3;
            }).remove();
            $('.dataTables_filter label').prepend('Rechercher : ');
        }
    });
    
    // Si le tableau est vide, désactiver DataTables
    if (table.data().count() === 0) {
        table.destroy();
        $('#typeContenusTable').dataTable({
            searching: false,
            paging: false,
            info: false
        });
    }
});
</script>
@endsection