<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Division extends Model
{
    use HasFactory;

    protected $fillable = ['nomD'];

    protected $primaryKey = 'idD';

    // Division.php

    public function services()
    {
        return $this->hasMany(Service::class, 'idD', 'idD');
    }

}
