<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $table = 'media';
    protected $primaryKey = 'id_media';
    public $timestamps = true;

    protected $fillable = [
        'id_type_media',
        'Chemin',
        'titre', // NOUVEAU
        'description',
        'id_utilisateur',
        'id_contenu',
        'nom_fichier',
        'statut',
        'downloads',
        'largeur', // NOUVEAU
        'hauteur', // NOUVEAU
        'duree', // NOUVEAU
        'taille_fichier', // NOUVEAU
        'mime_type', // NOUVEAU
        'extension', // NOUVEAU
        'is_premium', // NOUVEAU
        'prix', // NOUVEAU
        'resolution', // NOUVEAU
        'auteur_original', // NOUVEAU
        'copyright', // NOUVEAU
        'tags', // NOUVEAU
        'is_valide', // NOUVEAU
    ];

    protected $casts = [
        'tags' => 'array',
        'is_premium' => 'boolean',
        'is_valide' => 'boolean',
        'prix' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Relations
    public function typeMedia()
    {
        return $this->belongsTo(TypeMedia::class, 'id_type_media', 'id_type');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_contenu');
    }

    // Accessors
    public function getUrlAttribute()
    {
        return Storage::url($this->Chemin);
    }

    public function getAbsolutePathAttribute()
    {
        return storage_path('app/public/' . $this->Chemin);
    }

    public function getTailleFormateeAttribute()
    {
        if (!$this->taille_fichier) return 'N/A';
        
        $bytes = $this->taille_fichier;
        $units = ['B', 'KB', 'MB', 'GB'];
        for ($i = 0; $bytes > 1024; $i++) {
            $bytes /= 1024;
        }
        return round($bytes, 2) . ' ' . $units[$i];
    }

    public function getDureeFormateeAttribute()
    {
        if (!$this->duree) return 'N/A';
        
        $hours = floor($this->duree / 3600);
        $minutes = floor(($this->duree % 3600) / 60);
        $seconds = $this->duree % 60;
        
        if ($hours > 0) {
            return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
        }
        return sprintf('%02d:%02d', $minutes, $seconds);
    }

    public function getResolutionAttribute($value)
    {
        if ($value) return $value;
        
        // Générer automatiquement si vide
        if ($this->largeur && $this->hauteur) {
            return $this->largeur . 'x' . $this->hauteur;
        }
        
        return 'N/A';
    }

        public function getEstImageAttribute()
    {
        return $this->typeMedia && $this->typeMedia->nom === 'Image';
    }


    public function getEstVideoAttribute()
    {
        return $this->typeMedia->nom === 'Vidéo';
    }

    public function getEstAudioAttribute()
    {
        return $this->typeMedia->nom === 'Audio';
    }

    public function getEstDocumentAttribute()
    {
        return $this->typeMedia->nom === 'Document' || $this->typeMedia->nom === 'PDF';
    }

    public function getIconeAttribute()
    {
        return match($this->typeMedia->nom) {
            'Image' => 'bi-image',
            'Vidéo' => 'bi-camera-video',
            'Audio' => 'bi-music-note-beamed',
            'PDF' => 'bi-file-earmark-pdf',
            'Document' => 'bi-file-earmark-text',
            default => 'bi-file-earmark'
        };
    }

    public function getCouleurTypeAttribute()
    {
        return match($this->typeMedia->nom) {
            'Image' => 'success',
            'Vidéo' => 'danger',
            'Audio' => 'warning',
            'PDF' => 'danger',
            'Document' => 'info',
            default => 'secondary'
        };
    }

    // Ou une méthode pour vérifier l'existence du fichier
    public function fileExists()
    {
        if (!$this->Chemin) {
            return false;
        }
        
        return Storage::exists('public/' . $this->Chemin);
    }

    public function analyserFichier()
    {
        $path = $this->getAbsolutePathAttribute();
        
        if (!file_exists($path)) {
            return false;
        }
        
        // Mise à jour des métadonnées
        $this->taille_fichier = filesize($path);
        $this->mime_type = mime_content_type($path);
        $this->extension = pathinfo($path, PATHINFO_EXTENSION);
        
        // Analyse selon le type
        if ($this->est_image) {
            $size = getimagesize($path);
            if ($size) {
                $this->largeur = $size[0];
                $this->hauteur = $size[1];
                $this->resolution = $size[0] . 'x' . $size[1];
            }
        } elseif ($this->est_video || $this->est_audio) {
            // Pour vidéo/audio, vous pouvez utiliser une librairie comme FFmpeg
            // Ici un exemple simple
            $this->duree = 0; // À implémenter avec FFmpeg
        }
        
        return $this->save();
    }
}