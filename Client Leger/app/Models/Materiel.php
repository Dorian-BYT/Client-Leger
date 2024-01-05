<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materiel extends Model
{
    protected $table ='Materiel';

    protected $primaryKey = 'idMateriel';
    public $timestamps = false;

    protected $fillable = ['idMateriel', 'libelle', 'description', 'quantite'];

    public function emprunts()
    {
        return $this->hasMany(EmpruntMateriel::class, 'idMateriel');
    }

    public function pannes()
    {
        return $this->hasMany(PanneMateriel::class, 'idMateriel');
    }
}
