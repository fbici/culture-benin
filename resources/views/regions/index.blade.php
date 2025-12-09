@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green"><i class="bi bi-geo-alt-fill me-2"></i>Gestion des Régions</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-decoration-none">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Régions</li>
            </ol>
        </div>
    </div>
@endsection

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
<style>
:root {
    --primary-color: #e17000;
    --secondary-color: #008751;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%) !important;
}

.card {
    border-radius: 12px;
    overflow: hidden;
}

.table-container {
    background: #f8f9fa;
    border-radius: 8px;
    margin: 16px;
}

.table {
    margin-bottom: 0;
    border-radius: 8px;
    overflow: hidden;
}

.table thead th {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    border-bottom: 2px solid #dee2e6;
    font-weight: 600;
    color: #495057;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
    padding: 12px 16px;
}

.table tbody td {
    padding: 16px;
    vertical-align: middle;
    border-color: #f1f3f4;
}

.region-row {
    transition: all 0.3s ease;
    border-left: 3px solid transparent;
}

.region-row:hover {
    background-color: #f8f9fa !important;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    border-left-color: var(--primary-color);
}

.region-icon {
    transition: all 0.3s ease;
}

.region-row:hover .region-icon {
    transform: scale(1.1);
    background: rgba(225, 112, 0, 0.2) !important;
}

.action-btn {
    width: 36px;
    height: 36px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
    border: 1px solid;
}

.action-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.btn-outline-info:hover { background-color: #0dcaf0; color: white; }
.btn-outline-warning:hover { background-color: #ffc107; color: black; }
.btn-outline-danger:hover { background-color: #dc3545; color: white; }

.population-display, .area-display, .date-display {
    display: flex;
    align-items: center;
}

.empty-state {
    padding: 40px 20px;
}

/* Style pour DataTables */
.dataTables_wrapper {
    padding: 0;
}

.dataTables_length,
.dataTables_filter {
    padding: 16px;
    margin-bottom: 0;
}

.dataTables_info {
    padding: 12px 16px;
    background: #f8f9fa;
    border-top: 1px solid #dee2e6;
}

.dataTables_paginate {
    padding: 12px 16px;
    background: #f8f9fa;
    border-top: 1px solid #dee2e6;
}

/* Responsive */
@media (max-width: 768px) {
    .table-responsive {
        border-radius: 8px;
    }
    
    .action-btn {
        width: 32px;
        height: 32px;
    }
    
    .card-header .d-flex {
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }
    
    .card-header .btn {
        align-self: center;
    }
}

/* Animation de chargement */
@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.region-row {
    animation: fadeIn 0.5s ease-out;
}

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
        <div class="card border-0 shadow-lg">
            
            <!-- En-tête amélioré -->
            <div class="card-header  text-black py-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h3 class="card-title mb-0 fw-bold">
                            <i class="bi bi-pin-map me-2"></i>Liste des Régions
                        </h3>
                    </div>
                    <a href="{{ route('admin.regions.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-plus-circle me-1"></i> Nouvelle Région
                    </a>
                </div>
            </div>
            
            <div class="card-body p-0">
                
                <!-- Alertes -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show m-3 mb-0 rounded-3" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                            <div class="flex-grow-1">{{ session('success') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show m-3 mb-0 rounded-3" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
                            <div class="flex-grow-1">{{ session('error') }}</div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    </div>
                @endif

                <!-- Tableau amélioré -->
                <div class="table-container p-3">
                    <table id="regionsTable" class="table table-hover table-striped align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" style="width: 5%">#</th>
                                <th style="width: 25%">Nom & Description</th>
                                <th style="width: 15%">Population</th> 
                                <th style="width: 15%">Superficie</th>
                                <th style="width: 15%">Création</th>
                                <th class="text-center pe-4" style="width: 15%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($regions as $region)
                            <tr class="region-row">
                                <td class="ps-4 fw-semibold text-primary">{{ $region->id_region }}</td>
                                
                                <td>
                                    <div class="d-flex align-items-start">
                                        <div class="region-icon bg-primary bg-opacity-10 rounded-2 p-2 me-3">
                                            <i class="bi bi-geo-alt text-primary"></i>
                                        </div>
                                        <div>
                                            <strong class="d-block text-dark">{{ $region->nom_region }}</strong>
                                            <small class="text-muted">{{ Str::limit($region->description, 35, '...') }}</small>
                                        </div>
                                    </div>
                                </td>
                                
                                <td>
                                    @if($region->population)
                                        <div class="population-display">
                                            <i class="bi bi-people text-success me-1"></i>
                                            <span class="fw-bold text-dark">{{ number_format($region->population, 0, ',', ' ') }}</span>
                                            <small class="text-muted">hab.</small>
                                        </div>
                                    @else
                                        <span class="text-muted fst-italic">
                                            <i class="bi bi-dash-circle me-1"></i>N/A
                                        </span>
                                    @endif
                                </td>
                                
                                <td>
                                    @if($region->superficie)
                                        <div class="area-display">
                                            <i class="bi bi-aspect-ratio text-warning me-1"></i>
                                            <span class="fw-bold text-dark">{{ number_format($region->superficie, 2, ',', ' ') }}</span>
                                            <small class="text-muted">km²</small>
                                        </div>
                                    @else
                                        <span class="text-muted fst-italic">
                                            <i class="bi bi-dash-circle me-1"></i>N/A
                                        </span>
                                    @endif
                                </td>
                                
                                <td>
                                    <div class="date-display">
                                        <i class="bi bi-calendar3 text-info me-1"></i>
                                        <span class="text-dark">{{ $region->created_at->format('d/m/Y') }}</span>
                                    </div>
                                </td>

                                <td class="text-center pe-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <!-- Voir -->
                                        <a href="{{ route('admin.regions.show', $region->id_region) }}"
                                           class="btn btn-outline-info btn-sm action-btn rounded-2"
                                           title="Voir les détails"
                                           data-bs-toggle="tooltip">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <!-- Modifier -->
                                        <a href="{{ route('admin.regions.edit', $region->id_region) }}"
                                           class="btn btn-outline-warning btn-sm action-btn rounded-2"
                                           title="Modifier"
                                           data-bs-toggle="tooltip">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <!-- Supprimer -->
                                        @can('delete')
                                        <form action="{{ route('admin.regions.destroy', $region->id_region) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-outline-danger btn-sm action-btn rounded-2"
                                                    title="Supprimer"
                                                    data-bs-toggle="tooltip"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer la région {{ $region->nom_region }} ? Cette action est irréversible.')">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <div class="empty-state">
                                        <i class="bi bi-globe2 display-1 text-muted opacity-50 mb-3"></i>
                                        <h5 class="text-muted mb-3">Aucune région enregistrée</h5>
                                        <p class="text-muted mb-4">Commencez par ajouter la première région à votre catalogue.</p>
                                        <a href="{{ route('admin.regions.create') }}" class="btn btn-primary btn-lg">
                                            <i class="bi bi-plus-circle me-2"></i> Ajouter la première région
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
<!-- jQuery doit être chargé AVANT DataTables -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    // Cacher le message de chargement et afficher le tableau
    $('#tableLoading').hide();
    $('#regionsTable').show();
    
    // Vérifier si le tableau contient des données
    var hasData = {{ $regions->count() > 0 ? 'true' : 'false' }};
    
    if (hasData) {
        // Initialiser DataTable seulement s'il y a des données
        var table = $('#regionsTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json',
                search: "_INPUT_",
                searchPlaceholder: "Rechercher une région...",
                lengthMenu: "_MENU_",
                info: "Affichage de _START_ à _END_ sur _TOTAL_ régions",
                infoEmpty: "Aucune région à afficher",
                infoFiltered: "(filtré à partir de _MAX_ régions totales)",
                paginate: {
                    first: "Premier",
                    last: "Dernier",
                    next: "Suivant",
                    previous: "Précédent"
                }
            },
            responsive: true,
            pageLength: 4, // 4 lignes par page comme demandé
            lengthMenu: [[4, 10, 25, 50, 100, -1], [4, 10, 25, 50, 100, "Tous"]],
            order: [[0, 'asc']],
            columnDefs: [
                {
                    targets: [5], // Désactiver le tri sur la colonne Actions
                    orderable: false,
                    searchable: false
                },
                {
                    targets: [0], // Colonne ID
                    className: 'dt-body-center'
                }
            ],
            // Personnaliser l'affichage
            initComplete: function(settings, json) {
                // Personnaliser les labels
                $('.dataTables_length label').html('Afficher : ' + $('.dataTables_length select'));
                $('.dataTables_filter label').html('Rechercher : ' + $('.dataTables_filter input'));
                
                // Ajouter des classes Bootstrap aux contrôles
                $('.dataTables_length select').addClass('form-select form-select-sm');
                $('.dataTables_filter input').addClass('form-control form-control-sm');
                
                // Personnaliser la pagination
                $('.dataTables_paginate .pagination').addClass('pagination-sm');
            },
            // Callback après dessin du tableau
            drawCallback: function(settings) {
                // Mettre à jour les tooltips
                $('[data-bs-toggle="tooltip"]').tooltip();
            }
        });
        
        // Activer les tooltips Bootstrap
        $('[data-bs-toggle="tooltip"]').tooltip();
        
        // Exposer la table globalement si nécessaire
        window.regionsTable = table;
        
    } else {
        // S'il n'y a pas de données, masquer le tableau DataTables
        $('#regionsTable').removeClass('dataTable');
        $('#noDataRow').show();
    }
    
    // Gérer le redimensionnement de la fenêtre
    $(window).on('resize', function() {
        if ($.fn.DataTable.isDataTable('#regionsTable')) {
            $('#regionsTable').DataTable().columns.adjust().responsive.recalc();
        }
    });
});
</script>
@endsection