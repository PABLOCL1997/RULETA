@extends('layouts.admin')
@section('contenido')
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-xl-11 col-lg-12 custom-lg-1440">
            <div class="card mb-2">
                <h4 class="p-3">Editar Mercado Premio</h4>
                <div class="p-3 code-to-copy ">

                    <form class="row g-3" novalidate>
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <label class="mb-1 form-label" for="inputState">Ciudad</label>
                                <select class="mb-1 form-select" name="ID_CIUDAD" id="cbCiudad" data-choices="data-choices"
                                    data-options='{"removeItemButton":true,"placeholder":true,}' required
                                    aria-label="select example">
                                    <option selected="selected" value="">Selecciona una opción</option>
                                    @foreach ($laDatosView['ciudad'] as $item)
                                        <option value="{{ $item->ID_CIUDAD }}">{{ $item->NOMBRE }}</option>
                                    @endforeach
                                </select>
                                <div id="smsCiudad" style="margin-top: -20px;" class="invalid-feedback">
                                    Selecciona un premio
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <label class="mb-1 form-label" for="inputCity">Nombre Mercado</label>
                                <input class="mb-3 form-control" name="NOMBRE" id="txtNombre" type="text"
                                    placeholder="Nombre Mercado" required value="" />
                                <div class="invalid-feedback">Ingrese el nombre del mercado</div>
                            </div>
                            <div class="col-xl-6 col-lg-12 col-md-12">
                                <label class="mb-1 form-label" for="inputEmail4">Dirección</label>
                                <textarea class="mb-3 form-control" name="DIRECCION" id="txtDireccion" placeholder="Dirección" rows="1"> </textarea>
                                <div class="invalid-feedback">Ingrese su Dirección</div>
                            </div>

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
                                                
                                                foreach ($laDatosView['mer_premio'] as $value) {
                                                    $lcChecket = 'checked';
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
            <!--</div>-->
            <!--</div>-->
            <div class="position-fixed top-0 start-50 translate-middle-x p-3 toast-container"
                style="z-index: 1050; left: 50%; transform: translateX(-50%);">
                <div class="toast fade" id="liveToast" role="alert" aria-live="assertive" aria-atomic="true"
                    style="border-color: red;">
                    <div class="toast-header">
                        <strong class="me-auto" style="color: red;">Mensaje</strong>
                        <button class="btn ms-2 p-0" type="button" data-bs-dismiss="toast" aria-label="Close"><span
                                class="uil uil-times fs-1" style="color: red;"></span></button>
                    </div>
                    <div class="toast-body" style="color: red;"><span id="txtMensajeError"></span>
                    </div>
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

    function validarPremio() {
        document.getElementById('smsCiudad').disabled = false;
        const select = document.getElementById('smsCiudad');
        if (select.value === '') {
            // Si no se seleccionó una opción válida, mostrar un mensaje de error
            document.getElementById("smsCiudad").style.display = "block";
        } else {
            // Si se seleccionó una opción válida, borrar cualquier mensaje de error existente
            document.getElementById("smsCiudad").style.display = "none";
        }
    }

    function ObtenerValoresMercado() {
    var valoresSet = new Set();
    var lnIdCiudad = $('#cbCiudad').val();
    var lcNombre = $('#txtNombre').val();
    var lcDireccion = $('#txtDireccion').val();

    if (lnIdCiudad == '' || lnIdCiudad == null || lnIdCiudad == 0) {
        console.log('ID Ciudad Vacio');
        return 'ID_CIUDAD NULL';
    }

    if (lcNombre == '' || lcNombre == null || lcNombre == 0) {
        console.log('Nombre Mercado Vacio');
        return 'NOMBRE_MERCADO NULL';
    }

    if (lcDireccion == '' || lcDireccion == null || lcDireccion == 0) {
        console.log('Direccion Vacio');
        return 'DIRECCION NULL';
    }

    var valor = {
        ID_CIUDAD: lnIdCiudad,
        NOMBRE_MERCADO: lcNombre,
        DIRECCION: lcDireccion
    };

    // Convertir el objeto en una cadena para verificar su unicidad
    var valorString = JSON.stringify(valor);

    // Vaciar el conjunto valoresSet creando uno nuevo
    valoresSet = new Set();

    valoresSet.add(valorString);

    // Convertir el Set en un arreglo
    var valores = Array.from(valoresSet).map(function(valorString) {
        return JSON.parse(valorString);
    });

    //console.log(valores);
    return valores;
}



    function ObtenerValores() {
        var valoresSet = new Set();

        $('input.checkbox-input:checked').each(function() {
            var row = $(this).closest('tr');
            var lnIdPremio = $(this).val();
            var lcNombrePremio = row.find('.check-label').text();
            var lnCantidad = row.find('.cantidad-input').val();


            var valor = {
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

    function EnviarDatos() {
        var valoresMercado = ObtenerValoresMercado();
        
        if (valoresMercado == 'ID_CIUDAD NULL') {
            $('#txtMensajeError').text('Seleccione una ciudad');
            $('#liveToast').toast('show');
            return;
        }
        if (valoresMercado == 'NOMBRE_MERCADO NULL') {
            $('#txtMensajeError').text('Ingrese el nombre del mercado');
            $('#liveToast').toast('show');
            return;
        }
        if (valoresMercado == 'DIRECCION NULL') {
            $('#txtMensajeError').text('Ingrese una direccion');
            $('#liveToast').toast('show');
            return;
        }
        console.log("Obtuvo los datos del Mercado");
        //return;
        var valores = ObtenerValores();

        console.log(valores);


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
                console.log(valores);
                //console.log(valores);
                $.ajax({
                    url: '/mercado_premio',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        valores: valores,
                        valoresMercado: valoresMercado
                    },
                    dataType: 'json',
                    success: function(response) {
                        // Manejar la respuesta del controlador si es necesario
                        console.log(response);
                        // window.location.href = '/mercado_premio';
                    },
                    error: function(xhr, status, error) {
                        // Manejar el error de la solicitud AJAX si es necesario
                        console.error(xhr.responseText);
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
