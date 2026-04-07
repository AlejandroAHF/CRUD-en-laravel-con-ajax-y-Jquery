<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoContribuyentes extends Model
{
    protected $table = 'venta_mh_tipo_contribuyente';
    protected $primaryKey = 'id_tipo_contribuyente';

    protected $fillable = [
        'tipo_contribuyente'
    ];
}
