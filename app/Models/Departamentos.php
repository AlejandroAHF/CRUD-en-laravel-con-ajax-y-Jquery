<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamentos extends Model
{
    protected $table = 'venta_mh_departamento';
    protected $primaryKey = 'id_departamento';

    protected $fillable = [
        'departamento'
    ];
}
