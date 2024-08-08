<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $primaryKey = 'idS';

    protected $fillable = [
        'nomS',
        'descriptionS',
        'idD'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class, 'idD', 'idD');
    }

    // Service.php

    public function projets()
    {
        return $this->hasMany(Projet::class, 'idS', 'idS');
    }

}
