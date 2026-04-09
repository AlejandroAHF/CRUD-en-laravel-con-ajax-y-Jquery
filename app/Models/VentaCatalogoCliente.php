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

    // Relaciones Eloquent

    public function tipoCliente()
    {
        return $this->belongsTo(TipoCliente::class, 'tipo_cliente', 'id');
    }

    public function tipoContribuyente()
    {
        return $this->belongsTo(TipoContribuyentes::class, 'fk_id_tipo_contribuyente', 'id_tipo_contribuyente');
    }

    public function actividadEconomica()
    {
        return $this->belongsTo(ActividadesEconomicas::class, 'cod_actividad_economica', 'id_actividad_economica');
    }

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumentos::class, 'cod_tipo_documento', 'id_tipo_documento');
    }

    public function pais()
    {
        return $this->belongsTo(Pises::class, 'fk_id_pais', 'id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamentos::class, 'cod_departamento', 'id_departamento');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipios::class, 'cod_municipio', 'id_municipio');
    }
}
