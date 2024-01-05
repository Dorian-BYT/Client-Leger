<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panne extends Model
{
    protected $table = 'Panne';
    protected $primaryKey = 'idPanne';
    public $timestamps = false;

    public function pannes()
    {
        return $this->hasMany(PanneMateriel::class, 'idPanne');
    }


}
