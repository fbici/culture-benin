<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'utilisateurs';
    protected $primaryKey = 'id_utilisateur'; 

    protected $fillable = [
        'nom',
        'prenom',
        'email',
        'mot_de_passe', 
        'id_role',
        'sexe',
        'id_langue',
        'date_inscription',
        'date_naissance',
        'statut',
        'avatar',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ];

    protected $hidden = [
        'mot_de_passe',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'mot_de_passe' => 'hashed',
        'date_naissance' => 'date',
        'date_inscription' => 'date',
        'two_factor_confirmed_at' => 'datetime',
    ];

    // =========================================================
    // AUTHENTIFICATION
    // =========================================================

    public function getAuthPassword()
    {
        return $this->mot_de_passe;
    }

    public function getAuthIdentifierName()
    {
        return 'id_utilisateur';
    }

    // =========================================================
    // 2FA
    // =========================================================

    public function hasTwoFactorEnabled(): bool
    {
        return !is_null($this->two_factor_secret) && !is_null($this->two_factor_confirmed_at);
    }

    public function hasTwoFactorPending(): bool
    {
        return !is_null($this->two_factor_secret) && is_null($this->two_factor_confirmed_at);
    }

    // =========================================================
    // RÔLES ET AUTORISATIONS
    // =========================================================

    public function isAdmin(): bool
    {
        return $this->role && strtolower($this->role->nom_role) === 'admin';  
    }

    public function isManager(): bool
    {
        return $this->role && strtolower($this->role->nom_role) === 'manager';
    }

    public function isManagerOrAdmin(): bool
    {
        return $this->isAdmin() || $this->isManager();
    }

    // =========================================================
    // RELATIONS
    // =========================================================

    /**
     * Relation avec le rôle
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role', 'id_role');
    }

    /**
     * Relation avec la langue
     */
    public function langue()
    {
        return $this->belongsTo(Langue::class, 'id_langue', 'id_langue');
    }

    /**
     * Relation avec les contenus créés
     */
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_auteur', 'id_utilisateur');
    }

    /**
     * Relation avec les médias créés
     */
    public function medias()
    {
        return $this->hasMany(Media::class, 'id_utilisateur', 'id_utilisateur');
    }

    /**
     * Relation avec les achats
     */
    public function achats()
    {
        return $this->hasMany(Achat::class, 'id_utilisateur', 'id_utilisateur');
    }

    /**
     * Relation avec les commentaires
     */
    public function commentaires()
    {
        return $this->hasMany(Commentaire::class, 'id_utilisateur', 'id_utilisateur');
    }

    /**
     * Relation avec les évaluations
     */
    public function evaluations()
    {
        return $this->hasMany(Evaluation::class, 'id_utilisateur', 'id_utilisateur');
    }

    /**
     * Relation avec les achats de contenus (si vous avez une logique spécifique)
     */
    public function achatContenus()
    {
        return $this->hasMany(Achat::class, 'id_utilisateur', 'id_utilisateur')
            ->where('type_item', 'contenu');
    }

    /**
     * Relation avec les achats de médias
     */
    public function achatMedias()
    {
        return $this->hasMany(Achat::class, 'id_utilisateur', 'id_utilisateur')
            ->where('type_item', 'media');
    }

    // =========================================================
    // SCOPES UTILES
    // =========================================================

    /**
     * Scope pour les utilisateurs actifs
     */
    public function scopeActive($query)
    {
        return $query->where('statut', 'actif');
    }

    /**
     * Scope pour les administrateurs
     */
    public function scopeAdmins($query)
    {
        return $query->whereHas('role', function($q) {
            $q->where('nom_role', 'admin');
        });
    }

    /**
     * Scope pour les contributeurs (non-admin)
     */
    public function scopeContributors($query)
    {
        return $query->whereHas('role', function($q) {
            $q->where('nom_role', '!=', 'admin');
        });
    }

    // =========================================================
    // MÉTHODES D'AIDE
    // =========================================================

    /**
     * Récupère le nom complet
     */
    public function getFullNameAttribute()
    {
        return trim($this->prenom . ' ' . $this->nom);
    }

    /**
     * Vérifie si l'utilisateur a acheté un contenu spécifique
     */
    public function hasPurchasedContent($contenuId)
    {
        return $this->achats()
            ->where('type_item', 'contenu')
            ->where('id_item', $contenuId)
            ->where('statut', 'complété')
            ->exists();
    }

    /**
     * Vérifie si l'utilisateur a acheté un média spécifique
     */
    public function hasPurchasedMedia($mediaId)
    {
        return $this->achats()
            ->where('type_item', 'media')
            ->where('id_item', $mediaId)
            ->where('statut', 'complété')
            ->exists();
    }


    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && Storage::exists('public/' . $this->avatar)) {
            return Storage::url($this->avatar);
        }
        return null;
    }
}