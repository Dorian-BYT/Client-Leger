<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpruntMateriel extends Model
{
    protected $table = 'empruntMateriel';
    protected $primaryKey = 'idEmpruntMateriel';

    public $timestamps = true;

    protected $fillable = [
        'idEmpruntMateriel', 'idUser', 'idMateriel', 'dateDebut', 'dateFin', 'quantite', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }

    public function materiel()
    {
        return $this->belongsTo(Materiel::class, 'idMateriel');
    }

}
