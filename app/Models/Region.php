<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $table = 'regions';
    protected $primaryKey = 'id_region'; 

    protected $fillable = [
        'nom_region',
        'description',
        'population',    
        'superficie',    
        'localisation', 
        'statut' 
    ];

    // Relation avec les contenus
    public function contenus()
    {
        return $this->hasMany(Contenu::class, 'id_region', 'id_region');
    }
}