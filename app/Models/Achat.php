<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    protected $table = 'achats';
    protected $primaryKey = 'id_achat';
    public $timestamps = true;

    protected $fillable = [
        'id_utilisateur',
        'type_item', // 'contenu' ou 'media'
        'id_item',
        'montant',
        'devise',
        'statut',
        'reference_paiement',
        'transaction_id',
        'date_paiement',
    ];

    protected $casts = [
        'date_paiement' => 'datetime',
        'montant' => 'decimal:2',
    ];

    public function utilisateur()
    {
        return $this->belongsTo(User::class, 'id_utilisateur');
    }

    public function contenu()
    {
        return $this->belongsTo(Contenu::class, 'id_item')->where('type_item', 'contenu');
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'id_item')->where('type_item', 'media');
    }

    // Vérifier si un achat est valide
    public function estValide()
    {
        return $this->statut === 'complété' && $this->date_paiement;
    }
}