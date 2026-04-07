<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VentaCatalogoCliente;
use App\Models\Departamentos;
use App\Models\Municipios;
use App\Models\Pises;
use App\Models\TipoCliente;
use App\Models\TipoContribuyentes;
use App\Models\TipoDocumentos;
use App\Models\ActividadesEconomicas;

class VentaCatalogoClienteController extends Controller
{
    public function store(Request $request)
    {
        $cliente = VentaCatalogoCliente::create([
            'tipo_cliente'             => $request->tipoCliente,
            'nombre'                   => $request->nombre,
            'nombre_comercial'         => $request->nombre_comercial,
            'tipo_persona'             => $request->tipopersona,
            'fk_id_tipo_contribuyente' => $request->contribuyentes,
            'cod_actividad_economica'  => $request->actividadeseconomicas,
            'cod_tipo_documento'       => $request->tipodocumento,
            'dui_nit'                  => $request->dui_nit,
            'nrc'                      => $request->nrc,
            'telefono'                 => $request->telefono,
            'correo'                   => $request->correo,
            'direccion'                => $request->direccion,
            'ciudad'                   => $request->ciudad,
            'fk_id_pais'               => $request->paises,
            'cod_departamento'         => $request->departamentos,
            'cod_municipio'            => $request->municipios,
            'descripcion_adicional'    => $request->descripcion_adicional,
        ]);

        return response()->json(['status' => 'ok', 'data' => $cliente]);
    }

    public function update(Request $request, $id)
    {
        $cliente = VentaCatalogoCliente::findOrFail($id);
        
        $cliente->update($request->all());

        return response()->json(['status' => 'ok']);
    }

    public function destroy($id)
    {
        $cliente = VentaCatalogoCliente::findOrFail($id);
        $cliente->delete();
        return response()->json(['status' => 'ok', 'message' => $cliente]);
    }

    public function list() {
        $departamentos = Departamentos::all();
        $municipios = Municipios::all();
        $paises = Pises::all();
        $tiposClientes = TipoCliente::all();
        $tiposContribuyentes = TipoContribuyentes::all();
        $tiposDocumentos = TipoDocumentos::all();
        $actividades = ActividadesEconomicas::all();
        return view('welcome', compact('departamentos','municipios','paises','tiposClientes','tiposContribuyentes','tiposDocumentos','actividades'));
    }

    public function fetchTabla() {
        $clientes = VentaCatalogoCliente::all();
        $output = '';

        foreach ($clientes as $row) {
            $output .= "
            <tr>
                <td>{$row->nombre}</td>
                <td>{$row->nombre_comercial}</td>
                <td>{$row->direccion}</td>
                <td>{$row->dui_nit}</td>
                <td>{$row->nrc}</td>
                <td>{$row->correo}</td>
                <td class='d-flex justify-content-between'>
                    <button class='btn btn-warning edit'
                        data-id='{$row->id_catalogo_cliente}'
                        data-cod-tipo-documento='{$row->cod_tipo_documento}'
                        data-nombre='{$row->nombre}'
                        data-nombre-comercial='{$row->nombre_comercial}'
                        data-telefono='{$row->telefono}'
                        data-direccion='{$row->direccion}'
                        data-ciudad='{$row->ciudad}'
                        data-region='{$row->region}'
                        data-cod-actividad-economica='{$row->cod_actividad_economica}'
                        data-cod-departamento='{$row->cod_departamento}'
                        data-cod-municipio='{$row->cod_municipio}'
                        data-fk-id-tipo-contribuyente='{$row->fk_id_tipo_contribuyente}'
                        data-tipo-persona='{$row->tipo_persona}'
                        data-fk-id-pais='{$row->fk_id_pais}'
                        data-descripcion-adicional='{$row->descripcion_adicional}'
                        data-tipo-cliente='{$row->tipo_cliente}'
                        data-dui-nit='{$row->dui_nit}'
                        data-nrc='{$row->nrc}'
                        data-correo='{$row->correo}'>
                        <img src='https://res.cloudinary.com/dksv7n9bg/image/upload/q_auto/f_auto/v1775525254/lapiz_rqzafk.png'>
                    </button>

                    <button class='btn btn-danger delete'
                        data-id='{$row->id_catalogo_cliente}'>
                        <img src='https://res.cloudinary.com/dksv7n9bg/image/upload/q_auto/f_auto/v1775525254/basura_mj2zzp.png'>
                    </button>
                </td>
            </tr>";
        }
        return $output; 
    }
}
