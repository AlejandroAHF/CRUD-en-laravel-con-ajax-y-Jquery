<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActividadesEconomicas extends Model
{
    protected $table = 'venta_mh_actividad_economica';
    protected $primaryKey = 'id_actividad_economica';

    protected $fillable = [
        'actividad_economica'
    ];
}