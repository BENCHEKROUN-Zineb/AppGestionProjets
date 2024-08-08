<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partenaire extends Model
{
    use HasFactory;

    protected $primaryKey = 'idpa';
    protected $fillable = [
        'nomPa',
        'contactPa',
        'adressePa'
    ];

    public function projets()
    {
        return $this->belongsToMany(Projet::class, 'projet_partenaire', 'idPa', 'idP');
    }
}
