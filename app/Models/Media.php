<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $table = 'media';
    protected $primaryKey = 'id_media'; 

    protected $fillable = [
        'id_type_media',
        'Chemin',
        'description',
        'id_utilisateur',
        'id_contenu', // Nouveau champ
        'nom_fichier',
        'statut',
        'downloads',
    ];

    // --- RELATION ---

    // Relation avec le Type de Média (TypeMedia)
    public function typeMedia()
    {
        return $this->belongsTo(TypeMedia::class, 'id_type_media', 'id_type');
    }
    
    // Si la clé primaire est 'id_type_media', utilisez simplement :
    // return $this->belongsTo(TypeMedia::class, 'id_type_media', 'id_type_media');

     public function user()
    {
        return $this->belongsTo(User::class, 'id_auteur');
    }

     // Relation avec le contenu (si applicable)
    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }

    // Méthode pour obtenir l'URL du média
    public function getUrlAttribute()
    {
        return Storage::url($this->Chemin);
    }

    // Vérifier si c'est une image
    public function isImage()
    {
        return $this->typeMedia->nom === 'Image';
    }

     // Accessor pour le chemin absolu
    public function getAbsolutePathAttribute()
    {
        return storage_path('app/public/' . $this->Chemin);
    }

    // Vérifier si le fichier existe
    public function fileExists()
    {
        return Storage::exists('public/' . $this->Chemin);
    }

    // Obtenir l'extension du fichier
    public function getExtensionAttribute()
    {
        return pathinfo($this->Chemin, PATHINFO_EXTENSION);
    }

    // Obtenir la taille du fichier
    public function getFileSizeAttribute()
    {
        if ($this->fileExists()) {
            $bytes = Storage::size('public/' . $this->Chemin);
            $units = ['B', 'KB', 'MB', 'GB'];
            for ($i = 0; $bytes > 1024; $i++) {
                $bytes /= 1024;
            }
            return round($bytes, 2) . ' ' . $units[$i];
        }
        return 'N/A';
    }
}