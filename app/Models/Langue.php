<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Langue extends Model
{
    use HasFactory;

    protected $table = 'langues';
    protected $primaryKey = 'id_langue';

    protected $fillable = [
        'code_langue',
        'nom_langue',
        'description',
        'statut'
    ];

    // Relation avec les contenus
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_langue', 'id_langue');
    }
    
}
