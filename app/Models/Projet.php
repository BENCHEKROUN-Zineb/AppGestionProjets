<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projet extends Model
{
    use HasFactory;

    protected $primaryKey = 'idP';

    protected $fillable = [
        'nomP',
        'descriptionP',
        'idS',

    ];

    public function service()
    {
        return $this->belongsTo(Service::class, 'idS', 'idS');
    }

    public function partenaires()
    {
        return $this->belongsToMany(Partenaire::class, 'projets_partenaires', 'idP', 'idpa');
    }

    public function documents()
    {
        return $this->hasMany(Document::class, 'idP');
    }
}
