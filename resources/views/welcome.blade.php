<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>CRUD Laravel AJAX</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<div class="d-flex justify-content-between">
    <h2>Clientes</h2>
    <button class="btn btn-primary mb-3" id="addBtn">
        <img src="https://res.cloudinary.com/dksv7n9bg/image/upload/q_auto/f_auto/v1775525254/agregar_hnlhou.png" alt="Agregar">
    </button>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Razon Social</th>
            <th>Nombre Comercial</th>
            <th>Direccion</th>
            <th>N Documento</th>
            <th>NRC</th>
            <th>Correo</th>
            <th>Accion</th>
        </tr>
    </thead>
    <tbody id="tabla"></tbody>
</table>

<!-- MODAL -->
<div class="modal fade" id="modalUser">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-header">
        <h5>Cliente</h5>
      </div>

      <div class="modal-body">

        <input type="hidden" id="id_catalogo_cliente">
        <select id="tipoCliente" class="form-control mb-2">
          <option value="">Tipo Cliente</option>
          @foreach ($tiposClientes as $row)
          <option value="{{ $row->id }}">{{ $row->nombre }}</option>
          @endforeach
        </select>

        <!-- DATOS PRINCIPALES -->
        <div class="row">
          <div class="col-md-6">
            <input type="text" id="nombre" class="form-control mb-2" placeholder="Razon social/Nombre de cliente">
          </div>
          <div class="col-md-6">
            <input type="text" id="nombre_comercial" class="form-control mb-2" placeholder="Nombre Comercial">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <select id="tipopersona" class="form-control mb-2">
              <option value="">Tipo Persona</option>
              <option value="1">Natural</option>
              <option value="2">Juridico</option>
            </select>
          </div>
          <div class="col-md-6">
            <select id="contribuyentes" class="form-control mb-2">
              <option value="">Tipo Contribuyentes</option>
              @foreach ($tiposContribuyentes as $row)
                <option value="{{ $row->id_tipo_contribuyente }}">{{ $row->tipo_contribuyente }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <select id="actividadeseconomicas" class="form-control mb-2">
              <option value="">Actividades Economicas</option>
              @foreach ($actividades as $row)
                <option value="{{ $row->id_actividad_economica }}">{{ $row->actividad_economica }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <!-- DOCUMENTOS -->
        <div class="row">
          <div class="col-md-4">
            <select id="tipodocumento" class="form-control mb-2">
              <option value="">Tipo Documentos</option>
              @foreach ($tiposDocumentos as $row)
                <option value="{{ $row->id_tipo_documento }}">{{ $row->tipo_documento }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-4">
            <input type="text" id="dui_nit" class="form-control mb-2" placeholder="DUI / NIT">
          </div>
          <div class="col-md-4">
            <input type="text" id="nrc" class="form-control mb-2" placeholder="NRC">
          </div>
        </div>

        <!-- CONTACTO -->
        <div class="row">
          <div class="col-md-6">
            <input type="text" id="telefono" class="form-control mb-2" placeholder="Teléfono">
          </div>
          <div class="col-md-6">
            <input type="email" id="correo" class="form-control mb-2" placeholder="Correo">
          </div>
        </div>

        <!-- UBICACIÓN -->
        <div class="row">
          <div class="col-md-6">
            <input type="text" id="direccion" class="form-control mb-2" placeholder="Dirección">
          </div>
          <div class="col-md-6">
            <input type="text" id="ciudad" class="form-control mb-2" placeholder="Ciudad">
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <select id="paises" class="form-control mb-2">
              <option value="">Paises</option>
              @foreach ($paises as $row)
                <option value="{{ $row->id }}">{{ $row->nombre }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="row">
          <div class="col-md-6">
            <select id="departamentos" class="form-control mb-2">
              <option value="">Departamentos</option>
              @foreach ($departamentos as $row)
                <option value="{{ $row->id_departamento }}">{{ $row->departamento }}</option>
              @endforeach
            </select>
          </div>
          <div class="col-md-6">
            <select id="municipios" class="form-control mb-2">
              <option value="">Municipios</option>
              @foreach ($municipios as $row)
                <option value="{{ $row->id_municipio }}">{{ $row->municipio }}</option>
              @endforeach
            </select>
          </div>
        </div>

        <!-- EXTRA -->
        <textarea id="descripcion_adicional" class="form-control" placeholder="Descripción adicional"></textarea>

      </div>

      <div class="modal-footer">
        <button class="btn btn-success" id="save">Guardar</button>
        <button class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>


<!-- Toast de notificación -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999">
  <div id="toastNoti" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body" id="toastMsg">
        Operación realizada correctamente
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>

<!-- Modal de confirmación para eliminar -->
<div class="modal fade" id="modalConfirmDelete" tabindex="-1" aria-labelledby="modalConfirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalConfirmDeleteLabel">Confirmar eliminación</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        ¿Está seguro que desea eliminar este registro?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btnConfirmDelete">Eliminar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
let modal = new bootstrap.Modal(document.getElementById('modalUser'));

// Configuración global de AJAX para incluir el Token CSRF de Laravel
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function cargarDatos() {
    $.get("{{ route('clientes.fetch') }}", function(data) {
        $("#tabla").html(data);
    });
}

$(document).ready(function() {
  cargarDatos();
});

// Abrir modal
$("#addBtn").click(function() {
  $("#id_catalogo_cliente").val("");
  const todos = [
    '#tipodocumento', '#dui_nit', '#nrc', '#nombre', '#nombre_comercial', '#telefono', '#correo',
    '#actividadeseconomicas', '#contribuyentes', '#tipopersona', '#departamentos', '#municipios',
    '#descripcion_adicional', '#direccion', '#ciudad', '#paises'
  ];

  todos.forEach(function(id) {
    $(id).val("");
  });
  modal.show();
});

// Mostrar/ocultar campos según tipoCliente
  $(document).ready(function() {
    function mostrarCamposPorTipoCliente(valor) {
      // IDs de todos los campos posibles
      const todos = [
        '#tipodocumento', '#dui_nit', '#nrc', '#nombre', '#nombre_comercial', '#telefono', '#correo',
        '#actividadeseconomicas', '#contribuyentes', '#tipopersona', '#departamentos', '#municipios',
        '#descripcion_adicional', '#direccion', '#ciudad', '#paises'
      ];
      // Definir los campos a mostrar por tipo
      let mostrar = [];
      if (valor == '1') {
        mostrar = ['#tipodocumento', '#dui_nit', '#nombre', '#nombre_comercial', '#correo', '#direccion'];
      } else if (valor == '2') {
        mostrar = ['#tipodocumento','#dui_nit','#nrc','#nombre','#nombre_comercial','#telefono','#correo','#actividadeseconomicas','#contribuyentes','#tipopersona','#departamentos','#municipios','#descripcion_adicional'];
      } else if (valor == '3') {
        mostrar = ['#tipodocumento', '#dui_nit', '#nombre', '#nombre_comercial', '#telefono', '#correo', '#paises', '#descripcion_adicional', '#direccion', '#ciudad'];
      } else if (valor == '4') {
        mostrar = ['#tipodocumento', '#dui_nit', '#nombre', '#telefono', '#correo', '#departamentos', '#municipios', '#descripcion_adicional', '#direccion', '#ciudad'];
      }
      // Ocultar todos
      todos.forEach(function(id) {
        $(id).closest('.row, .col-md-4, .col-md-6, .col-md-12').hide();
        $(id).hide();
      });
      // Mostrar los requeridos
      mostrar.forEach(function(id) {
        $(id).closest('.row, .col-md-4, .col-md-6, .col-md-12').show();
        $(id).show();
      });
    }

    // Evento change
    $('#tipoCliente').on('change', function() {
      mostrarCamposPorTipoCliente($(this).val());
    });

    // Inicializar al abrir modal (por si ya hay valor)
    $('#modalUser').on('shown.bs.modal', function() {
      mostrarCamposPorTipoCliente($('#tipoCliente').val());
    });
  });

// --- GUARDAR (INSERT / UPDATE) ---
$("#save").click(function() {
    let id = $("#id_catalogo_cliente").val();
    let url = id ? `/clientes/${id}` : "/clientes";
    let metodo = id ? "PUT" : "POST";

    let datos = {
      id: id,
      tipoCliente: $("#tipoCliente").val(),
      nombre: $("#nombre").val(),
      nombre_comercial: $("#nombre_comercial").val(),
      tipopersona: $("#tipopersona").val(),
      contribuyentes: $("#contribuyentes").val(),
      actividadeseconomicas: $("#actividadeseconomicas").val(),
      tipodocumento: $("#tipodocumento").val(),
      dui_nit: $("#dui_nit").val(),
      nrc: $("#nrc").val(),
      telefono: $("#telefono").val(),
      correo: $("#correo").val(),
      direccion: $("#direccion").val(),
      ciudad: $("#ciudad").val(),
      paises: $("#paises").val(),
      departamentos: $("#departamentos").val(),
      municipios: $("#municipios").val(),
      descripcion_adicional: $("#descripcion_adicional").val(),
      _method: metodo // Laravel reconoce esto para simular PUT
    };

    $.post(url, datos, function(response) {
        if(response.status === 'ok') {
            modal.hide();
            cargarDatos();
            mostrarToast('Operación exitosa');
        }
    }).fail(function(err) {
        console.error("Error en la validación", err.responseJSON);
    });
});

// Editar
$(document).on("click", ".edit", function() {
    // Llenar todos los campos del formulario con los datos del botón editar
    $("#id_catalogo_cliente").val($(this).data("id"));
    $("#tipoCliente").val($(this).data("tipo-cliente"));
    $("#nombre").val($(this).data("nombre"));
    $("#nombre_comercial").val($(this).data("nombre-comercial"));
    $("#tipopersona").val($(this).data("tipo-persona"));
    $("#contribuyentes").val($(this).data("fk-id-tipo-contribuyente"));
    $("#actividadeseconomicas").val($(this).data("cod-actividad-economica"));
    $("#tipodocumento").val($(this).data("cod-tipo-documento"));
    $("#dui_nit").val($(this).data("dui-nit"));
    $("#nrc").val($(this).data("nrc"));
    $("#telefono").val($(this).data("telefono"));
    $("#correo").val($(this).data("correo"));
    $("#direccion").val($(this).data("direccion"));
    $("#ciudad").val($(this).data("ciudad"));
    $("#paises").val($(this).data("fk-id-pais"));
    $("#departamentos").val($(this).data("cod-departamento"));
    $("#municipios").val($(this).data("cod-municipio"));
    $("#descripcion_adicional").val($(this).data("descripcion-adicional"));
    // Mostrar el modal
    modal.show();
    // Disparar el evento change para mostrar los campos correctos
    $("#tipoCliente").trigger('change');
});

// Eliminar con modal de confirmación
let idEliminar = null;
$(document).on("click", ".delete", function() {
  idEliminar = $(this).data("id");
  var modalDelete = new bootstrap.Modal(document.getElementById('modalConfirmDelete'));
  modalDelete.show();
});

$('#btnConfirmDelete').click(function() {
    if (idEliminar) {
        $.ajax({
            url: `/clientes/${idEliminar}`,
            type: 'DELETE',
            success: function(result) {
                cargarDatos();
                mostrarToast('Registro eliminado');
                bootstrap.Modal.getInstance(document.getElementById('modalConfirmDelete')).hide();
            }
        });
    }
});

// Función para mostrar toast
function mostrarToast(mensaje) {
  $('#toastMsg').text(mensaje);
  var toast = new bootstrap.Toast(document.getElementById('toastNoti'));
  toast.show();
}
</script>
</body>
</html>