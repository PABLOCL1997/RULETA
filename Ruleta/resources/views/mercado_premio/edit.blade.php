@extends('layouts.admin')
@section('contenido')
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-xl-11 col-lg-12 custom-lg-1440">
            <div class="card mb-2">
                <h4 class="p-3">Editar Mercado Premio</h4>
                <div class="p-3 code-to-copy ">

                    <form class="row g-3" novalidate>
                        <div class="row">
                            <div class="mb-2 col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="inputCity">Nombre</label>
                                <input class="form-control" name="NOMBRE" id="txtNombre" type="text"
                                    placeholder="Nro. Ticket" required value="" />
                                <div class="invalid-feedback">Ingrese el nombre del mercado</div>
                            </div>
                            <div class="mb-2 col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="inputEmail4">Dirección</label>
                                <input class="form-control" name="DIRECCION" id="txtDireccion" type="text"
                                    placeholder="Nombres" required value="" />
                                <div class="invalid-feedback">Ingrese su Dirección</div>
                            </div>
                            <!--<div class="mb-2 col-xl-6 col-lg-6 col-md-6">
                                <label class="form-label" for="inputPassword4">Apellidos</label>
                                <a href="#" class="btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#verticallyCentered">
                                    <i class="fas fa-ban"></i>
                                </a>
                                <div class="invalid-feedback">Ingrese sus Apellidos</div>
                            </div>-->
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-lg-12 col-md-12">
                                <table class="table table-md fs--1 mb-0">
                                    <thead>
                                        <tr>
                                            <th class="sort border-top ps-3">
                                                Premios</th>
                                            <th class="sort border-top ps-3">
                                                Cantidad</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($laDatosView['premio'] as $premio)
                                            @php
                                                $lnValorCantidad = '';
                                                $lcChecket = '';
                                                
                                                // Obtener el valor desde el elemento txtIdMercado utilizando JavaScript
                                                $lnMercado = $laDatosView['id_premio'];
                                                
                                                foreach ($laDatosView['mer_premio'] as $value) {
                                                    if ($value->ID_MERCADO == $lnMercado && $value->ID_PREMIO == $premio->ID_PREMIO) {
                                                        $lcChecket = 'checked';
                                                        $lnValorCantidad = $value->CANTIDAD_MAX_SALIDAS;
                                                    }
                                                }
                                                
                                                if ($premio->PREMIO_CONSUELO == 'SI') {
                                                    $lnValorCantidad = '0';
                                                }
                                            @endphp
                                            <tr>
                                                <td class="align-middle ps-3">
                                                    <input class="form-check-input checkbox-input" id="flexCheckDefault"
                                                        type="checkbox" {{ $lcChecket }} value="{{ $premio->ID_PREMIO }}"
                                                        style="transform: scale(1.4); margin-right: 0.5rem;"
                                                        @if ($premio->PREMIO_CONSUELO == 'SI') disabled @endif />
                                                    <label class="form-check-label ps-1 check-label"
                                                        for="flexCheckDefault">{{ strtoupper($premio->NOMBRE) }}</label>
                                                </td>

                                                <td class="align-middle">
                                                    <input class="form-control cantidad-input" name="" id=""
                                                        type="number" placeholder="Cantidad" required
                                                        value="{{ $lnValorCantidad }}"
                                                        @if ($premio->PREMIO_CONSUELO == 'SI') disabled @endif />
                                                    <span class="error-message" style="display: none; color:red;"></span>
                                                </td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group" id="divGuardar">
                            {{ csrf_field() }}
                            <button class="btn btn-primary" id="txtGuardar" onclick="EnviarDatos();"
                                type="button">Guardar</button>
                            <a href="/mercado_premio"><button class="btn btn-danger" type="button">Volver</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.checkbox-input').change(function() {
            var isChecked = $(this).is(':checked');
            var cantidadInput = $(this).closest('tr').find('.cantidad-input');
            var checkboxValue = $(this).val();
            if (isChecked) {
                cantidadInput.css('display', 'block');
            } else {
                cantidadInput.css('display', 'none');
            }
        });
    });

    /*function ObtenerValores() {
        var valores = [];
        $('input.checkbox-input:checked').each(function() {
            var row = $(this).closest('tr');
            //var checkboxId = row.find('.checkbox-input').val();
            var lnIdPremio = $(this).val();
            var lcNombrePremio = row.find('.check-label').text();
            var lnCantidad = row.find('.cantidad-input').val();
            valores.push({
                ID_PREMIO: lnIdPremio,
                NOMBRE: lcNombrePremio,
                CANTIDAD_MAX: lnCantidad
            });
        });
        return valores;
    }*/
    function ObtenerValores() {
        var valoresSet = new Set();
        var lnIdMercado = <?php echo json_encode($laDatosView['id_premio']); ?>;
        if (lnIdMercado == '' || lnIdMercado == null || lnIdMercado == 0) {
            return 'ID_MERCADO NULL';
        }
        $('input.checkbox-input:checked').each(function() {
            var row = $(this).closest('tr');
            var lnIdPremio = $(this).val();
            var lcNombrePremio = row.find('.check-label').text();
            var lnCantidad = row.find('.cantidad-input').val();


            var valor = {
                ID_MERCADO: lnIdMercado,
                ID_PREMIO: lnIdPremio,
                NOMBRE: lcNombrePremio,
                CANTIDAD_MAX: lnCantidad
            };

            // Convertir el objeto en una cadena para verificar su unicidad
            var valorString = JSON.stringify(valor);

            valoresSet.add(valorString);
        });

        // Convertir el Set en un arreglo
        var valores = Array.from(valoresSet).map(function(valorString) {
            return JSON.parse(valorString);
        });
        //console.log(valores);
        return valores;
    }
    /*function ObtenerValores() {
        var valores = [];

        $('input.checkbox-input').each(function() {
            var row = $(this).closest('tr');
            var lnIdPremio = $(this).val();
            var lcNombrePremio = row.find('.check-label').text();
            var lnCantidad = row.find('.cantidad-input').val();

            // Verificar si el ID_PREMIO ya existe en el arreglo de valores
            var existingValue = valores.find(function(valor) {
                return valor.ID_PREMIO === lnIdPremio;
            });

            if (existingValue) {
                // Actualizar los valores del objeto existente
                existingValue.NOMBRE = lcNombrePremio;
                existingValue.CANTIDAD_MAX = lnCantidad;

                // Verificar si el checkbox está marcado
                if (!$(this).is(':checked')) {
                    // Eliminar el objeto del arreglo si el checkbox está desmarcado
                    valores.splice(valores.indexOf(existingValue), 1);
                }
            } else {
                // Agregar un nuevo objeto al arreglo si el ID_PREMIO no existe
                if ($(this).is(':checked')) {
                    valores.push({
                        ID_PREMIO: lnIdPremio,
                        NOMBRE: lcNombrePremio,
                        CANTIDAD_MAX: lnCantidad
                    });
                }
            }
        });

        return valores;
    }*/
    /*function ObtenerValores() {
        var valores = [];

        $('input.checkbox-input').each(function() {
            var row = $(this).closest('tr');
            var lnIdPremio = $(this).val();
            var lcNombrePremio = row.find('.check-label').text();
            var lnCantidad = row.find('.cantidad-input').val();

            // Verificar si el ID_PREMIO ya existe en el arreglo de valores
            var existingValue = valores.find(function(valor) {
                return valor.ID_PREMIO === lnIdPremio;
            });

            if (existingValue) {
                // Actualizar los valores del objeto existente
                existingValue.NOMBRE = lcNombrePremio;
                existingValue.CANTIDAD_MAX = lnCantidad;

                // Verificar si el checkbox está marcado
                if (!$(this).is(':checked') || lnCantidad === '') {
                    // Eliminar el objeto del arreglo si el checkbox está desmarcado o si lnCantidad está vacío
                    valores.splice(valores.indexOf(existingValue), 1);
                }
            } else {
                // Agregar un nuevo objeto al arreglo si el ID_PREMIO no existe y lnCantidad no está vacío
                if ($(this).is(':checked') && lnCantidad !== '') {
                    valores.push({
                        ID_PREMIO: lnIdPremio,
                        NOMBRE: lcNombrePremio,
                        CANTIDAD_MAX: lnCantidad
                    });
                }
            }
        });

        return valores;
    }*/

    function EnviarDatos() {
        var valores = ObtenerValores();
        console.log(valores);
       // return;
        if (valores == 'ID_MERCADO NULL') {
            $('#txtMensajeError').text('El id mercado es nulo, comunicarse con el administador del sistema');
            $('#liveToast').toast('show');
            return;
        }
        // Obtener los campos de cantidad
        var camposCantidad = document.getElementsByClassName('cantidad-input');
        var mensajesError = document.getElementsByClassName('error-message');
        var checkboxesMarcados = document.getElementsByClassName('checkbox-input');
        // Variable para verificar si todos los campos están llenos
        var todosLlenos = true;
        // Verificar si el checkbox específico está seleccionado
        if ($('#flexCheckDefault:checked').length > 0) {
            // Verificar cada campo de cantidad
            for (var i = 0; i < camposCantidad.length; i++) {
                var campoCantidad = camposCantidad[i];
                var mensajeError = mensajesError[i];
                var checkboxMarcado = checkboxesMarcados[i];


                // Verificar si el campo está visible y está vacío
                if (campoCantidad.style.display !== 'none' && checkboxMarcado && campoCantidad.value === '') {
                    // Verificar si el campo es inválido y tiene un mensaje de validación
                    if (campoCantidad.validity.valueMissing) {
                        var mensaje = campoCantidad.validationMessage;
                        mensajeError.textContent = mensaje;
                        mensajeError.style.display = 'block';
                    }
                    todosLlenos = false; // Al menos un campo está vacío
                } else {
                    // Limpiar y ocultar el mensaje de error si el campo es válido
                    mensajeError.textContent = '';
                    mensajeError.style.display = 'none';
                    //todosLlenos = true;
                }
            }
            // Verificar si todos los campos están llenos
            if (todosLlenos) {

                //console.log(valores);
                $.ajax({
                    url: '/mercado_premio/create',
                    method: 'GET',
                    data: {
                        valores: valores
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Manejar la respuesta del controlador si es necesario
                        console.log(response);
                       // window.location.href = '/mercado_premio';
                    },
                    error: function(xhr, status, error) {
                        // Manejar el error de la solicitud AJAX si es necesario
                        console.error(error);
                    }
                });
            }
        } else {
            // El checkbox no está seleccionado, mostrar mensaje de error o realizar alguna acción
            // Mostrar el toast
            $('#txtMensajeError').text('Debes seleccionar al menos un premio.');
            $('#liveToast').toast('show');
        }
    }

    function DatosModal(ID_MERCADO, NOMBRE) {
        $('#txtNombre').text(NOMBRE);
        $('#txtIdMercado').val(ID_MERCADO);
    }
</script>
