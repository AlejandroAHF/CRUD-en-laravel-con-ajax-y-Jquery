<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipios extends Model
{
    protected $table = 'venta_mh_municipio';
    protected $primaryKey = 'id_municipio';

    protected $fillable = [
        'municipio'
    ];
}
