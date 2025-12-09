@extends('layout')

@section('title')
    <div class="row">
        <div class="col-sm-6">
            <h3 class="mb-0 text-culture-green">Gestion des Utilisateurs</h3>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page">Utilisateurs</li>
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
                    <h3 class="card-title text-black mb-0">Liste des Utilisateurs</h3>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary btn-sm">
                        <i class="bi bi-person-plus-fill me-1"></i> Nouvel Utilisateur
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
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>{{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <div class="table-responsive">
                    <table id="usersTable" class="table table-bordered table-striped table-hover w-100">
                        <thead>
                            <tr>
                                <th style="width: 5%">ID</th>
                                <th style="width: 25%">Identité</th>
                                <th style="width: 20%">Contact & Rôle</th>
                                <th style="width: 15%">Statut</th>
                                <th style="width: 15%">Inscription</th>
                                <th style="width: 20%" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id_utilisateur }}</td>
                                
                                <td>
                                    <strong>
                                        {{ $user->prenom ?? '' }} {{ $user->nom ?? $user->nom_complet ?? '' }}
                                    </strong>
                                    <br>
                                    <small class="text-muted">
                                        <i class="bi bi-person-vcard me-1"></i>
                                        @if($user->sexe === 'M')
                                            Masculin
                                        @elseif($user->sexe === 'F')
                                            Féminin
                                        @elseif($user->sexe === 'A')
                                            Autre
                                        @else
                                            Non spécifié
                                        @endif
                                    </small>
                                </td>
                                
                                <td>
                                    <i class="bi bi-envelope me-1"></i> {{ $user->email ?? 'N/A' }}
                                    <br>
                                    <span class="badge bg-secondary">
                                        <i class="bi bi-person-badge-fill me-1"></i> {{ $user->role->nom_role ?? 'N/A' }}
                                    </span>
                                </td>
                                
                                <td>
                                    @php
                                        $statut = $user->statut ?? 'inactif';
                                        $badgeClass = match($statut) {
                                            'actif' => 'bg-success',
                                            'inactif' => 'bg-warning text-dark',
                                            'suspendu' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($statut) }}</span>
                                    <br>
                                    <small class="text-muted"><i class="bi bi-translate me-1"></i> {{ $user->langue->nom_langue ?? 'N/A' }}</small>
                                </td>
                                
                                <td>
                                    @php
                                        $dateInscription = $user->date_inscription ?? $user->created_at;
                                    @endphp
                                    @if($dateInscription)
                                        {{ $dateInscription->format('d/m/Y') }}
                                    @else
                                        N/A
                                    @endif
                                    
                                    @if($user->date_naissance)
                                        <br>
                                        <small class="text-muted">
                                            <i class="bi bi-calendar-heart me-1"></i> 
                                            {{ $user->date_naissance->format('d/m/Y') }}
                                        </small>
                                    @endif
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.users.show', $user->id_utilisateur) }}"
                                           class="btn btn-info btn-sm action-btn"
                                           title="Voir">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>

                                        <a href="{{ route('admin.users.edit', $user->id_utilisateur) }}"
                                           class="btn btn-warning btn-sm action-btn"
                                           title="Modifier">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id_utilisateur) }}" 
                                              method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-danger btn-sm action-btn"
                                                    title="Supprimer"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer {{ $user->prenom ?? '' }} {{ $user->nom ?? $user->nom_complet ?? '' }} ?')">
                                                <i class="bi bi-trash-fill"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="bi bi-people display-4 d-block mb-3"></i>
                                        Aucun utilisateur enregistré pour le moment.
                                        <br>
                                        <a href="{{ route('admin.users.create') }}" class="btn btn-primary mt-3">
                                            <i class="bi bi-person-add me-1"></i> Ajouter un utilisateur
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
<!-- Assurez-vous que jQuery est chargé AVANT DataTables -->
@if(!isset($jqueryLoaded) || !$jqueryLoaded)
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
@endif
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
<script>
$(document).ready(function() {
    // Initialiser DataTable
    var table = $('#usersTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json'
        },
        responsive: true,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "Tous"]],
        order: [[0, 'desc']],
        columnDefs: [
            {
                targets: [5], // Désactiver le tri sur la colonne Actions
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
        $('#usersTable').dataTable({
            searching: false,
            paging: false,
            info: false
        });
    }
});
</script>
@endsection