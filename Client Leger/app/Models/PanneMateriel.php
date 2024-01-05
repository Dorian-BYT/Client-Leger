<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanneMateriel extends Model
{

    use HasFactory;

    protected $table = 'PanneMateriel';
    protected $primaryKey = 'idPanneMateriel';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'idPanneMateriel','idPanne', 'idMateriel', 'created_at', 'idUser', 'updated_at', 'infos_supplementaires'
    ];

    public function panne()
    {
        return $this->belongsTo(Panne::class, 'idPanne');
    }

    public function materiel()
    {
        return $this->belongsTo(Materiel::class, 'idMateriel');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser');
    }
}
