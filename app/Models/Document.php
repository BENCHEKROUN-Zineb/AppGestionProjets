<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $primaryKey = 'idD';
    protected $fillable = ['nomD', 'typeD', 'idP', 'file_path'];

    public function projet()
    {
        return $this->belongsTo(Projet::class, 'idP');
    }
}
