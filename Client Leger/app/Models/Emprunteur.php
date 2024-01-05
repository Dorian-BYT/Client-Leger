<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprunteur extends Model
{
    protected $table ='Emprunteur';

    protected $primaryKey = 'idEmprunteur';
    public $timestamps = false;

    public function role()
    {
        return $this->hasOne(Roles::class, 'idRole','idRole');
    }

    public function materiels()
    {
        return $this->belongsToMany(Materiel::class, 'EmpruntMateriel.php', 'idUser', 'idMateriel','dateDebut')
            ->withPivot([ 'dateFin','quantite']);
    }
}
