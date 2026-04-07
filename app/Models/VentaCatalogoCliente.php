<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VentaCatalogoCliente extends Model
{
    protected $table = 'venta_catalogo_cliente';
    protected $primaryKey = 'id_catalogo_cliente';

    protected $fillable = [
        'tipo_cliente',
        'nombre', 
        'nombre_comercial', 
        'tipo_persona',
        'fk_id_tipo_contribuyente', 
        'cod_actividad_economica', 
        'cod_tipo_documento', 
        'dui_nit', 
        'nrc', 
        'telefono', 
        'correo', 
        'direccion', 
        'ciudad', 
        'fk_id_pais', 
        'cod_departamento', 
        'cod_municipio', 
        'descripcion_adicional'
    ];
}
