<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeContenu extends Model
{
    use HasFactory;

    protected $table = 'type_contenus';
    // ALIGNEMENT : Utiliser la clé primaire réelle
    protected $primaryKey = 'id_type'; 

    protected $fillable = [
        // ALIGNEMENT : Utiliser le nom de colonne réel
        'nom', 
        // Les champs suivants DOIVENT être ajoutés à la table (via migration)
        'slug',           
        'description',    
        'icone_css',      
    ];
}