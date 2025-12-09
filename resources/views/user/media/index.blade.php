@extends('user.layout')

@section('title')
<div class="row align-items-center">
    <div class="col-sm-6">
        <h3 class="mb-0 text-culture-green">
            <i class="bi bi-images me-2"></i>Mes Médias
        </h3>
    </div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end mb-0">
            <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}" class="text-decoration-none">Dashboard</a></li>
            <li class="breadcrumb-item active text-culture-green" aria-current="page">Médias</li>
        </ol>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* ===== STYLES SPÉCIFIQUES À LA GESTION DES MÉDIAS ===== */
    .medias-container {
        max-width: 1400px;
        margin: 120px auto 40px;
        padding: 0 2rem;
    }

    /* Header de la page */
    .page-header-media {
        background: white;
        border-radius: 24px;
        padding: 2.5rem;
        margin-bottom: 3rem;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
        border-left: 6px solid #ffc107;
        position: relative;
        overflow: hidden;
    }

    .page-header-media::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -50%;
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, rgba(255, 193, 7, 0.08) 0%, rgba(255, 215, 0, 0.04) 100%);
        border-radius: 50%;
    }

    .header-icon-media {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #ffc107 0%, #ffda6a 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.2rem;
        color: #1a1d21;
        margin-bottom: 2rem;
        box-shadow: 0 12px 30px rgba(255, 193, 7, 0.3);
        position: relative;
        z-index: 2;
    }

    /* Boutons d'action */
    .btn-upload-media {
        background: linear-gradient(135deg, #ffc107 0%, #ffda6a 100%);
        border: none;
        color: #1a1d21;
        padding: 1rem 2.5rem;
        border-radius: 15px;
        font-weight: 700;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.8rem;
        box-shadow: 0 8px 25px rgba(255, 193, 7, 0.3);
        text-decoration: none;
    }

    .btn-upload-media:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(255, 193, 7, 0.4);
        color: #1a1d21;
    }

    /* Options de vue */
    .view-options {
        background: white;
        border-radius: 15px;
        padding: 1rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .view-btn {
        background: transparent;
        border: none;
        color: #6c757d;
        padding: 0.7rem 1.5rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .view-btn.active {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
        border: 2px solid rgba(255, 193, 7, 0.3);
    }

    /* Grille des médias - Vue Grille */
    .media-grid-view {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 2rem;
        margin-top: 2rem;
    }

    .media-card-grid {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
    }

    .media-card-grid:hover {
        transform: translateY(-10px) scale(1.02);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    .media-preview {
        height: 200px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        position: relative;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .media-type-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 0.4rem 1rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        backdrop-filter: blur(10px);
    }

    .media-icon {
        font-size: 3.5rem;
        color: #adb5bd;
    }

    .media-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .media-card-grid:hover .media-image {
        transform: scale(1.1);
    }

    .media-info {
        padding: 1.5rem;
    }

    .media-title {
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #1a1d21;
        font-size: 1.1rem;
        line-height: 1.4;
    }

    .media-description {
        color: #6c757d;
        font-size: 0.9rem;
        line-height: 1.5;
        margin-bottom: 1rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .media-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.8rem;
        color: #adb5bd;
        border-top: 1px solid #f1f3f4;
        padding-top: 1rem;
        margin-top: 1rem;
    }

    .media-actions {
        position: absolute;
        bottom: 1.5rem;
        right: 1.5rem;
        display: flex;
        gap: 0.5rem;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s ease;
    }

    .media-card-grid:hover .media-actions {
        opacity: 1;
        transform: translateY(0);
    }

    .btn-media-action {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        text-decoration: none;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .btn-view-media { background: linear-gradient(135deg, #0dcaf0 0%, #5ecdf5 100%); }
    .btn-edit-media { background: linear-gradient(135deg, #ffc107 0%, #ffda6a 100%); }
    .btn-delete-media { background: linear-gradient(135deg, #dc3545 0%, #e35d6a 100%); }

    .btn-media-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
    }

    /* Vue Liste */
    .media-list-view {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .media-item-list {
        padding: 1.5rem 2rem;
        border-bottom: 1px solid #f1f3f4;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        gap: 1.5rem;
    }

    .media-item-list:hover {
        background: linear-gradient(90deg, rgba(255, 193, 7, 0.05) 0%, transparent 100%);
        border-left: 4px solid #ffc107;
    }

    .media-item-list:last-child {
        border-bottom: none;
    }

    .media-thumb-list {
        width: 80px;
        height: 80px;
        border-radius: 15px;
        background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        overflow: hidden;
    }

    .media-thumb-list img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .media-info-list {
        flex: 1;
    }

    .media-title-list {
        font-weight: 700;
        margin-bottom: 0.3rem;
        color: #1a1d21;
        font-size: 1.1rem;
    }

    .media-description-list {
        color: #6c757d;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .media-meta-list {
        display: flex;
        gap: 1.5rem;
        font-size: 0.8rem;
        color: #adb5bd;
    }

    .media-actions-list {
        display: flex;
        gap: 0.5rem;
    }

    /* Filtres et recherche */
    .filter-section {
        background: white;
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .search-box-media {
        position: relative;
    }

    .search-box-media input {
        width: 100%;
        padding: 1rem 1.5rem 1rem 3.5rem;
        border: 2px solid #e9ecef;
        border-radius: 15px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }

    .search-box-media input:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 3px rgba(255, 193, 7, 0.2);
        background: white;
    }

    .search-box-media i {
        position: absolute;
        left: 1.2rem;
        top: 50%;
        transform: translateY(-50%);
        color: #adb5bd;
        font-size: 1.2rem;
    }

    .filter-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.8rem;
        margin-top: 1.5rem;
    }

    .filter-tag {
        background: white;
        border: 2px solid #e9ecef;
        color: #495057;
        padding: 0.6rem 1.2rem;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-tag:hover {
        border-color: #ffc107;
        color: #ffc107;
        background: rgba(255, 193, 7, 0.05);
    }

    .filter-tag.active {
        background: linear-gradient(135deg, #ffc107 0%, #ffda6a 100%);
        border-color: #ffc107;
        color: #1a1d21;
    }

    /* État vide */
    .empty-state-media {
        text-align: center;
        padding: 5rem 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border: 2px dashed #e9ecef;
        grid-column: 1 / -1;
    }

    .empty-icon {
        font-size: 5rem;
        color: #e9ecef;
        margin-bottom: 2rem;
    }

    /* Pagination améliorée */
    .pagination-media {
        background: white;
        border-radius: 15px;
        padding: 1.5rem;
        margin-top: 2rem;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .page-link-media {
        border: none;
        background: transparent;
        color: #495057;
        padding: 0.8rem 1.2rem;
        margin: 0 0.2rem;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s ease;
        text-decoration: none;
        display: inline-block;
    }

    .page-link-media:hover {
        background: rgba(255, 193, 7, 0.1);
        color: #ffc107;
    }

    .page-link-media.active {
        background: linear-gradient(135deg, #ffc107 0%, #ffda6a 100%);
        color: #1a1d21;
    }

    /* Statistiques médias */
    .media-stats {
        background: white;
        border-radius: 20px;
        padding: 1.5rem;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 0, 0, 0.05);
        margin-bottom: 2rem;
    }

    .stat-item-media {
        text-align: center;
        padding: 1rem;
    }

    .stat-count-media {
        font-size: 2rem;
        font-weight: 800;
        color: #ffc107;
        margin-bottom: 0.5rem;
    }

    .stat-label-media {
        font-size: 0.9rem;
        color: #6c757d;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Animations */
    @keyframes fadeInMedia {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .animate-fade-in-media {
        animation: fadeInMedia 0.6s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }

    /* Responsive */
    @media (max-width: 1200px) {
        .medias-container {
            padding: 0 1.5rem;
        }
        
        .media-grid-view {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .medias-container {
            margin-top: 100px;
            padding: 0 1rem;
        }
        
        .page-header-media {
            padding: 1.5rem;
        }
        
        .header-icon-media {
            width: 60px;
            height: 60px;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }
        
        .media-grid-view {
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 1rem;
        }
        
        .media-item-list {
            flex-direction: column;
            text-align: center;
            gap: 1rem;
        }
        
        .media-meta-list {
            justify-content: center;
            flex-wrap: wrap;
        }
    }

    @media (max-width: 576px) {
        .media-grid-view {
            grid-template-columns: 1fr;
        }
        
        .btn-upload-media {
            width: 100%;
            justify-content: center;
        }
        
        .view-options {
            flex-direction: column;
            gap: 0.5rem;
        }
        
        .view-btn {
            width: 100%;
            text-align: center;
        }
    }
</style>
@endsection

@section('content')
<div class="medias-container">
    <!-- En-tête de page -->
    <div class="page-header-media animate-fade-in-media">
        <div class="row align-items-center">
            <div class="col-md-8">
                <div class="header-icon-media">
                    <i class="bi bi-images"></i>
                </div>
                <h1 class="fw-bold mb-3" style="font-size: 2.5rem;">
                    Mes <span style="color: #ffc107;">Médias</span>
                </h1>
                <p class="fs-5 text-muted mb-4">
                    Gérez vos images, vidéos et documents multimédias. 
                    <br>Organisez et enrichissez vos contenus culturels.
                </p>
                <div class="d-flex flex-wrap gap-3 align-items-center">
                    <a href="{{ route('user.medias.create') }}" class="btn-upload-media">
                        <i class="bi bi-cloud-arrow-up"></i>
                        Uploader un nouveau média
                    </a>
                    <a href="{{ route('user.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left me-1"></i>
                        Retour au dashboard
                    </a>
                </div>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="media-stats">
                    <div class="row">
                        <div class="col-6">
                            <div class="stat-item-media">
                                <div class="stat-count-media">{{ $medias->total() }}</div>
                                <div class="stat-label-media">Total</div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="stat-item-media">
                                <div class="stat-count-media">{{ $medias->count() }}</div>
                                <div class="stat-label-media">Affichés</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filtres et recherche -->
    <div class="filter-section animate-fade-in-media">
        <div class="row align-items-center">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="search-box-media">
                    <i class="bi bi-search"></i>
                    <input type="text" placeholder="Rechercher un média par titre, description..." 
                           id="searchMedia" value="{{ request('search') }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="view-options d-flex gap-2">
                        <button class="view-btn active" id="viewGrid" title="Vue grille">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </button>
                        <button class="view-btn" id="viewList" title="Vue liste">
                            <i class="bi bi-list-ul"></i>
                        </button>
                    </div>
                    <select class="form-select w-auto" id="filterType" style="border-radius: 12px; border: 2px solid #e9ecef;">
                        <option value="">Tous les types</option>
                        @foreach($typesMedia as $type)
                        <option value="{{ $type->id_type_media }}" {{ request('type') == $type->id_type_media ? 'selected' : '' }}>
                            {{ $type->nom }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        
        <div class="filter-tags mt-3">
            <span class="filter-tag active" data-filter="">Tous</span>
            @foreach($typesMedia as $type)
            <span class="filter-tag" data-filter="{{ $type->id_type_media }}">
                <i class="bi bi-{{ $type->nom == 'image' ? 'image' : 'file-earmark' }}"></i>
                {{ $type->nom }}
            </span>
            @endforeach
            <span class="filter-tag" data-filter="recent">
                <i class="bi bi-clock"></i>Récents
            </span>
        </div>
    </div>

    <!-- Vue Liste (cachée par défaut) -->
<div id="mediaListView" class="media-list-view" style="display: none;">
    @forelse($medias as $media)
    <div class="media-item-list animate-fade-in-media">
        <div class="media-thumb-list">
            @if($media->typeMedia && $media->typeMedia->nom == 'image' && $media->Chemin)
                <img src="{{ asset($media->Chemin) }}" alt="{{ $media->description }}"
                     onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="media-icon" style="display: none;">
                    <i class="bi bi-{{ $media->typeMedia && $media->typeMedia->nom == 'image' ? 'image' : 'file-earmark' }}"></i>
                </div>
            @else
                <div class="media-icon">
                    <i class="bi bi-{{ $media->typeMedia && $media->typeMedia->nom == 'image' ? 'image' : 'file-earmark' }}"></i>
                </div>
            @endif
        </div>
        
        <div class="media-info-list">
            <h4 class="media-title-list">{{ $media->description }}</h4>
            <p class="media-description-list">{{ Str::limit($media->description, 150) }}</p>
            
            <div class="media-meta-list">
                <span>
                    <i class="bi bi-tag me-1"></i>
                    {{ $media->typeMedia->nom ?? 'Non classé' }}
                </span>
                <span>
                    <i class="bi bi-calendar me-1"></i>
                    {{ $media->created_at->format('d/m/Y') }}
                </span>
                <span>
                    <i class="bi bi-clock me-1"></i>
                    {{ $media->created_at->format('H:i') }}
                </span>
            </div>
        </div>
        
        <div class="media-actions-list">
            <a href="{{ asset($media->Chemin) }}" target="_blank" class="btn btn-sm btn-outline-primary" title="Voir">
                <i class="bi bi-eye"></i>
            </a>
            <form action="{{ route('user.medias.destroy', $media->id_media) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-outline-danger" 
                        onclick="return confirm('Supprimer ce média ?')" title="Supprimer">
                    <i class="bi bi-trash"></i>
                </button>
            </form>
        </div>
    </div>
    @empty
    <!-- État vide pour la vue liste -->
    <div class="empty-state-media animate-fade-in-media">
        <div class="empty-icon">
            <i class="bi bi-images"></i>
        </div>
        <h3 class="fw-bold mb-3">Aucun média uploadé</h3>
        <p class="text-muted mb-4">
            Commencez par uploader votre premier média pour enrichir vos contenus culturels.
        </p>
        <a href="{{ route('user.medias.create') }}" class="btn-upload-media">
            <i class="bi bi-cloud-arrow-up me-2"></i>
            Uploader mon premier média
        </a>
    </div>
    @endforelse
</div>

    <!-- Pagination -->
    @if($medias->hasPages())
    <div class="pagination-media animate-fade-in-media">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-muted">
                Affichage de {{ $medias->firstItem() }} à {{ $medias->lastItem() }} sur {{ $medias->total() }} médias
            </div>
            <nav>
                <ul class="pagination mb-0">
                    @if($medias->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link-media">
                            <i class="bi bi-chevron-left"></i>
                        </span>
                    </li>
                    @else
                    <li class="page-item">
                        <a class="page-link-media" href="{{ $medias->previousPageUrl() }}">
                            <i class="bi bi-chevron-left"></i>
                        </a>
                    </li>
                    @endif

                    @foreach(range(1, $medias->lastPage()) as $page)
                        @if($page == $medias->currentPage())
                        <li class="page-item active">
                            <span class="page-link-media">{{ $page }}</span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link-media" href="{{ $medias->url($page) }}">{{ $page }}</a>
                        </li>
                        @endif
                    @endforeach

                    @if($medias->hasMorePages())
                    <li class="page-item">
                        <a class="page-link-media" href="{{ $medias->nextPageUrl() }}">
                            <i class="bi bi-chevron-right"></i>
                        </a>
                    </li>
                    @else
                    <li class="page-item disabled">
                        <span class="page-link-media">
                            <i class="bi bi-chevron-right"></i>
                        </span>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle entre vue grille et liste
        const viewGridBtn = document.getElementById('viewGrid');
        const viewListBtn = document.getElementById('viewList');
        const mediaGridView = document.getElementById('mediaGridView');
        const mediaListView = document.getElementById('mediaListView');

        viewGridBtn.addEventListener('click', function() {
            this.classList.add('active');
            viewListBtn.classList.remove('active');
            mediaGridView.style.display = 'grid';
            mediaListView.style.display = 'none';
        });

        viewListBtn.addEventListener('click', function() {
            this.classList.add('active');
            viewGridBtn.classList.remove('active');
            mediaGridView.style.display = 'none';
            mediaListView.style.display = 'block';
        });

        // Filtrage par type
        const filterType = document.getElementById('filterType');
        const filterTags = document.querySelectorAll('.filter-tag');
        const searchInput = document.getElementById('searchMedia');

        function applyFilters() {
            const type = filterType.value;
            const search = searchInput.value;
            let url = '{{ url()->current() }}?';
            
            if (type) url += `type=${type}&`;
            if (search) url += `search=${encodeURIComponent(search)}&`;
            
            // Supprimer le dernier '&' si présent
            url = url.replace(/&$/, '');
            
            window.location.href = url;
        }

        filterType.addEventListener('change', applyFilters);
        searchInput.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') applyFilters();
        });

        filterTags.forEach(tag => {
            tag.addEventListener('click', function() {
                const filter = this.dataset.filter;
                
                // Mettre à jour l'état actif
                filterTags.forEach(t => t.classList.remove('active'));
                this.classList.add('active');
                
                if (filter) {
                    filterType.value = filter;
                    applyFilters();
                } else {
                    filterType.value = '';
                    applyFilters();
                }
            });
        });

        // Animation au chargement
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fade-in-media');
                }
            });
        }, observerOptions);

        // Observer les cartes médias
        document.querySelectorAll('.media-card-grid, .media-item-list').forEach(el => {
            observer.observe(el);
        });
    });
</script>
@endsection