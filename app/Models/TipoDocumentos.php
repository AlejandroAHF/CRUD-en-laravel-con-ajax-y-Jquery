<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumentos extends Model
{
    protected $table = 'venta_mh_tipo_documento';
    protected $primaryKey = 'id_tipo_documento';

    protected $fillable = [
        'tipo_documento'
    ];
}
