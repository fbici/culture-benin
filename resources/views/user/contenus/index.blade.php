@extends('layouts.app')

@section('title', 'Mes Contenus - Culture Benin')

@push('styles')
<style>
    :root {
        --primary: #e17000;
        --secondary: #008751;
        --accent: #ffd700;
        --light: #f8f9fa;
        --dark: #1a1d21;
        --gray: #6c757d;
        --border: #e9ecef;
        --shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        --radius: 12px;
    }

    .user-content-page {
        min-height: calc(100vh - 180px);
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        padding: 40px 0;
    }

    /* Page Header */
    .user-page-header {
        background: white;
        border-radius: var(--radius);
        padding: 2.5rem;
        margin-bottom: 2.5rem;
        box-shadow: var(--shadow);
        border-left: 5px solid var(--secondary);
    }

    .page-header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 1.5rem;
    }

    .page-title {
        font-size: 2.2rem;
        font-weight: 800;
        color: var(--dark);
        margin: 0;
    }

    .page-subtitle {
        color: var(--gray);
        font-size: 1.1rem;
        margin-top: 0.5rem;
    }

    .btn-create {
        background: linear-gradient(135deg, var(--secondary) 0%, #006642 100%);
        color: white;
        padding: 1rem 2rem;
        border-radius: 10px;
        font-weight: 600;
        font-size: 1.1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
        border: none;
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 135, 81, 0.3);
        color: white;
    }

    /* Stats Cards */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius);
        padding: 2rem;
        text-align: center;
        box-shadow: var(--shadow);
        transition: transform 0.3s ease;
        border-top: 4px solid;
    }

    .stat-card:hover {
        transform: translateY(-5px);
    }

    .stat-card.published { border-color: var(--secondary); }
    .stat-card.pending { border-color: #ffc107; }
    .stat-card.draft { border-color: var(--gray); }
    .stat-card.total { border-color: var(--primary); }

    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        line-height: 1;
        margin-bottom: 0.5rem;
    }

    .published .stat-number { color: var(--secondary); }
    .pending .stat-number { color: #ffc107; }
    .draft .stat-number { color: var(--gray); }
    .total .stat-number { color: var(--primary); }

    .stat-label {
        color: var(--gray);
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 0.9rem;
    }

    /* Content Table */
    .content-table-wrapper {
        background: white;
        border-radius: var(--radius);
        overflow: hidden;
        box-shadow: var(--shadow);
        margin-bottom: 2.5rem;
    }

    .table-header {
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--border);
    }

    .table-title {
        margin: 0;
        font-weight: 700;
        color: var(--dark);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .table-content {
        padding: 0;
    }

    .table {
        margin: 0;
        border-collapse: separate;
        border-spacing: 0;
    }

    .table thead th {
        background: #f8f9fa;
        border-bottom: 2px solid var(--border);
        font-weight: 600;
        color: var(--dark);
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        padding: 1.25rem 1.5rem;
        white-space: nowrap;
    }

    .table tbody tr {
        transition: all 0.3s ease;
    }

    .table tbody tr:hover {
        background-color: #f8f9fa;
    }

    .table tbody td {
        padding: 1.5rem;
        vertical-align: middle;
        border-bottom: 1px solid var(--border);
    }

    .content-info {
        max-width: 350px;
    }

    .content-title {
        font-weight: 600;
        color: var(--dark);
        margin-bottom: 0.25rem;
        line-height: 1.4;
    }

    .content-region {
        color: var(--secondary);
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .content-type {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: rgba(225, 112, 0, 0.1);
        color: var(--primary);
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .content-status {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: inline-block;
    }

    .status-published {
        background: rgba(0, 135, 81, 0.1);
        color: var(--secondary);
    }

    .status-pending {
        background: rgba(255, 193, 7, 0.1);
        color: #d4a000;
    }

    .status-draft {
        background: rgba(108, 117, 125, 0.1);
        color: var(--gray);
    }

    .content-date {
        color: var(--gray);
        font-size: 0.95rem;
        white-space: nowrap;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .action-btn {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: all 0.3s ease;
        border: 1px solid;
    }

    .btn-view {
        background: rgba(13, 202, 240, 0.1);
        border-color: rgba(13, 202, 240, 0.2);
        color: #0dcaf0;
    }

    .btn-view:hover {
        background: #0dcaf0;
        color: white;
        transform: translateY(-2px);
    }

    .btn-edit {
        background: rgba(255, 193, 7, 0.1);
        border-color: rgba(255, 193, 7, 0.2);
        color: #ffc107;
    }

    .btn-edit:hover {
        background: #ffc107;
        color: black;
        transform: translateY(-2px);
    }

    .btn-delete {
        background: rgba(220, 53, 69, 0.1);
        border-color: rgba(220, 53, 69, 0.2);
        color: #dc3545;
    }

    .btn-delete:hover {
        background: #dc3545;
        color: white;
        transform: translateY(-2px);
    }

    /* Empty State */
    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-state-icon {
        font-size: 4rem;
        color: #dee2e6;
        margin-bottom: 1.5rem;
    }

    .empty-state-title {
        color: var(--dark);
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .empty-state-text {
        color: var(--gray);
        margin-bottom: 2rem;
        max-width: 500px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    /* Pagination */
    .pagination-wrapper {
        background: white;
        border-radius: var(--radius);
        padding: 1.5rem;
        box-shadow: var(--shadow);
    }

    .pagination {
        margin: 0;
        justify-content: center;
    }

    .page-link {
        border: none;
        color: var(--gray);
        padding: 0.75rem 1.25rem;
        margin: 0 0.25rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .page-link:hover {
        background: var(--primary);
        color: white;
    }

    .page-item.active .page-link {
        background: var(--secondary);
        color: white;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .user-page-header {
            padding: 2rem;
        }
        
        .page-title {
            font-size: 1.8rem;
        }
        
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        
        .table-content {
            overflow-x: auto;
        }
        
        .table {
            min-width: 800px;
        }
    }

    @media (max-width: 768px) {
        .user-content-page {
            padding: 30px 0;
        }
        
        .user-page-header {
            padding: 1.5rem;
            text-align: center;
        }
        
        .page-header-content {
            flex-direction: column;
            text-align: center;
        }
        
        .page-title {
            font-size: 1.5rem;
        }
        
        .stats-grid {
            grid-template-columns: 1fr;
        }
        
        .action-buttons {
            flex-wrap: wrap;
            justify-content: center;
        }
        
        .action-btn {
            width: 36px;
            height: 36px;
        }
    }

    @media (max-width: 576px) {
        .page-title {
            font-size: 1.3rem;
        }
        
        .btn-create {
            width: 100%;
            justify-content: center;
        }
        
        .stat-card {
            padding: 1.5rem;
        }
        
        .stat-number {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
<div class="user-content-page">
    <div class="container">
        <!-- Page Header -->
        <div class="user-page-header">
            <div class="page-header-content">
                <div>
                    <h1 class="page-title">
                        <i class="bi bi-file-text me-2"></i>Mes Contenus
                    </h1>
                    <p class="page-subtitle">
                        Gérez tous vos contenus culturels en un seul endroit
                    </p>
                </div>
                <a href="{{ route('user.contenus.create') }}" class="btn btn-create">
                    <i class="bi bi-plus-circle"></i>
                    Nouveau Contenu
                </a>
            </div>
        </div>

        <!-- Statistics -->
        <div class="stats-grid">
            <div class="stat-card published">
                <div class="stat-number">{{ $contenus->where('statut', 'publie')->count() }}</div>
                <div class="stat-label">Publiés</div>
            </div>
            
            <div class="stat-card pending">
                <div class="stat-number">{{ $contenus->where('statut', 'en_attente')->count() }}</div>
                <div class="stat-label">En attente</div>
            </div>
            
            <div class="stat-card draft">
                <div class="stat-number">{{ $contenus->where('statut', 'brouillon')->count() }}</div>
                <div class="stat-label">Brouillons</div>
            </div>
            
            <div class="stat-card total">
                <div class="stat-number">{{ $contenus->total() }}</div>
                <div class="stat-label">Total</div>
            </div>
        </div>

        <!-- Content Table -->
        <div class="content-table-wrapper">
            <div class="table-header">
                <h3 class="table-title">
                    <i class="bi bi-list-task me-2"></i>
                    Liste de vos contenus
                </h3>
            </div>
            
            <div class="table-content">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Titre & Région</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contenus as $contenu)
                        <tr>
                            <td class="content-info">
                                <div class="content-title">
                                    {{ Str::limit($contenu->titre, 50) }}
                                </div>
                                <div class="content-region">
                                    <i class="bi bi-geo-alt"></i>
                                    {{ $contenu->region->nom_region ?? 'Non spécifié' }}
                                </div>
                            </td>
                            
                            <td>
                                <span class="content-type">
                                    {{ $contenu->typeContenu->nom ?? 'N/A' }}
                                </span>
                            </td>
                            
                            <td>
                                @php
                                    $statusClass = match($contenu->statut) {
                                        'publie' => 'status-published',
                                        'en_attente' => 'status-pending',
                                        default => 'status-draft'
                                    };
                                @endphp
                                <span class="content-status {{ $statusClass }}">
                                    @if($contenu->statut == 'publie')
                                        Publié
                                    @elseif($contenu->statut == 'en_attente')
                                        En attente
                                    @else
                                        Brouillon
                                    @endif
                                </span>
                            </td>
                            
                            <td class="content-date">
                                {{ $contenu->created_at->format('d/m/Y') }}
                            </td>
                            
                            <td class="text-center">
                                <div class="action-buttons">
                                    <a href="{{ route('user.contenus.show', $contenu->id_contenu) }}" 
                                       class="action-btn btn-view" 
                                       title="Voir le contenu"
                                       data-bs-toggle="tooltip">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    
                                    <a href="{{ route('user.contenus.edit', $contenu->id_contenu) }}" 
                                       class="action-btn btn-edit" 
                                       title="Modifier"
                                       data-bs-toggle="tooltip">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    
                                    <form action="{{ route('user.contenus.destroy', $contenu->id_contenu) }}" 
                                          method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="action-btn btn-delete" 
                                                title="Supprimer"
                                                data-bs-toggle="tooltip"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce contenu ? Cette action est irréversible.')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <i class="bi bi-file-earmark-text empty-state-icon"></i>
                                    <h4 class="empty-state-title">Aucun contenu créé</h4>
                                    <p class="empty-state-text">
                                        Vous n'avez pas encore créé de contenu. Commencez par partager 
                                        votre première contribution culturelle avec la communauté.
                                    </p>
                                    <a href="{{ route('user.contenus.create') }}" class="btn btn-success btn-lg px-4">
                                        <i class="bi bi-plus-circle me-2"></i>
                                        Créer votre premier contenu
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        @if($contenus->hasPages())
        <div class="pagination-wrapper">
            {{ $contenus->links() }}
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialiser les tooltips Bootstrap
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => {
        new bootstrap.Tooltip(tooltip);
    });
    
    // Animation des statistiques
    const statCards = document.querySelectorAll('.stat-card');
    statCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate__animated', 'animate__fadeInUp');
    });
    
    // Animation des lignes du tableau
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach((row, index) => {
        row.style.animationDelay = `${index * 0.05}s`;
        row.classList.add('animate__animated', 'animate__fadeIn');
    });
});
</script>
@endpush