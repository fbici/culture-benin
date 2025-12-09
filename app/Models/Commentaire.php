<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commentaire extends Model
{
    use HasFactory;

    protected $table = 'commentaires';
    protected $primaryKey = 'id_commentaire'; 

    protected $fillable = [
        'texte',
        'date',
        'note',
        'id_utilisateur',
        'id_contenu',
    ];

    protected $casts = [
        'date' => 'datetime',
        'note' => 'integer',
    ];
    
    // Si 'date' n'est pas remplie, nous laisserons 'created_at' gérer la date.
    
    // --- RELATIONS ---

    // 1. Relation avec l'Utilisateur (Auteur du commentaire)
    public function utilisateur()
    {
        // Supposons que la clé primaire de 'utilisateurs' est 'id_utilisateur'
        return $this->belongsTo(User::class, 'id_utilisateur', 'id_utilisateur');
    }

    // 2. Relation avec le Contenu commenté
    public function contenu()
    {
        // Supposons que la clé primaire de 'contenus' est 'id_contenu'
        return $this->belongsTo(Contenu::class, 'id_contenu', 'id_contenu');
    }
}