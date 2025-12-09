<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey = 'id_role'; 

    protected $fillable = [
        'nom_role',
    ];

    // Relation: Un rôle peut être attribué à plusieurs utilisateurs.
    public function utilisateurs()
    {
        return $this->hasMany(Utilisateur::class, 'id_role');
    }
}