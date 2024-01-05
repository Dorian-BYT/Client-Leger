<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table ='Roles';

    protected $primaryKey = 'idRole';
    public $timestamps = false;
}
