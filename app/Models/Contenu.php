<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenu extends Model
{
    use HasFactory;

    protected $table = 'contenus';
    protected $primaryKey = 'id_contenu'; 

    protected $fillable = [
        'titre',
        'id_type_contenu',
        'id_auteur',
        'id_region',
        'id_langue',
        'id_parent',
        'id_moderateur',
        'texte',
        'date_creation',
        'statut',
        'date_validation',
        'views',
    ];

    protected $casts = [
        'date_creation' => 'date',
        'date_validation' => 'datetime',
    ];
    
    // --- RELATIONS ---

    // 1. Relation avec le Type de Contenu (ex: Article, Video)
    public function typeContenu()
    {
       return $this->belongsTo(TypeContenu::class, 'id_type_contenu', 'id_type');
    }

    // 2. Relation avec l'Auteur (Utilisateur)
    public function auteur()
    {
        return $this->belongsTo(User::class, 'id_auteur', 'id_utilisateur');
    }

    // 3. Relation avec la Région
    public function region()
    {
        return $this->belongsTo(Region::class, 'id_region', 'id_region');
    }

    // 4. Relation avec la Langue
    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue', 'id_langue');
    }
    
    // 5. Relation avec le Modérateur (Utilisateur)
    public function moderateur()
    {
        return $this->belongsTo(User::class, 'id_moderateur', 'id_utilisateur');
    }
    
    // 6. Relation Parent (pour la hiérarchie ou les traductions)
    public function parent()
    {
        return $this->belongsTo(Contenu::class, 'id_parent', 'id_contenu');
    }
    
    // 7. Relation Enfants (pour récupérer les éléments liés à ce parent)
    public function enfants()
    {
        return $this->hasMany(Contenu::class, 'id_parent', 'id_contenu');
    }

    // Nouvelle relation avec les médias
    public function medias()
    {
        return $this->hasMany(Media::class, 'id_contenu');
    }

    // Récupérer l'image principale (première image associée)
    public function getImagePrincipaleAttribute()
    {
        return $this->medias()
            ->whereHas('typeMedia', function($query) {
                $query->where('nom', 'Image');
            })
            ->first();
    }

    // Récupérer toutes les images associées
    public function getImagesAttribute()
    {
        return $this->medias()
            ->whereHas('typeMedia', function($query) {
                $query->where('nom', 'Image');
            })
            ->get();
    }

    // Récupérer le média vidéo associé
    public function getVideoAttribute()
    {
        return $this->medias()
            ->whereHas('typeMedia', function($query) {
                $query->where('nom', 'Vidéo');
            })
            ->first();
    }
}