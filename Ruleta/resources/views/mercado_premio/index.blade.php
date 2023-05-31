@extends('layouts.admin')
@section('contenido')
    <div class="container-fluid px-0" data-layout="container">
        <div class="card-header p-4 border-bottom border-300 bg-soft">
            <div class="row g-3 justify-content-between align-items-end">
                <div class="card shadow-none border border-300 my-4" data-component-card="data-component-card">
                    <main class="main" id="top">
                        <div class="p-4 code-to-copy">
                            <h3 class="text-secondary mb-4">Administración de Mercados</h3>
                            <!--<div class="table-responsive">-->
                            <div id="tableExample2"
                                data-list='{"valueNames":["NRO_TICKET","MERCADO","PREMIO","NOMBRES"],"page":5,"pagination":true}'>
                                <div class="row g-3 justify-content-between mb-4">
                                    <div class="col-auto">
                                        <div class="d-md-flex justify-content-between">
                                            <div><a href="/cliente_premiado/create"><button class="btn btn-success me-4"
                                                        style="background-color:#006400; color:#ffffff;"><span
                                                            class="fas fa-plus me-2"></span>NUEVO</button></a>
                                                <button class="btn btn-link text-900 px-0"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="d-flex">
                                            <div class="search-box me-2">
                                                <form class="position-relative" data-bs-toggle="search"
                                                    data-bs-display="static"><input class="form-control search-input search"
                                                        type="search" placeholder="Buscar..." aria-label="Search" />
                                                    <span class="fas fa-search search-box-icon"></span>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive scrollbar mx-n1 px-1 border-top">
                                    <table class="table table-striped table-sm fs--1 mb-0">
                                        <thead>
                                            <tr>
                                                <th class="sort border-top ps-3" data-sort="ticket">Nombre</th>
                                                <th class="sort border-top ps-3" data-sort="premio">Departamento</th>
                                                <th class="sort border-top ps-3" data-sort="mercado">Dirección</th>
                                                <th class="sort border-top ps-3" data-sort="premio">Estado</th>
                                                <th class="ort border-top ps-3" scope="col">Acciónes</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach ($laDatosView['mercado_premio'] as $item)
                                                <tr>
                                                    <form class="row g-3" id="myForm">
                                                        <td colspan="5">
                                                            <!-- Colspan para que ocupe todas las columnas -->
                                                            <div class="modal fade"
                                                                id="verticallyCentered{{ $item->ID_MERCADO }}"
                                                                tabindex="-1"
                                                                aria-labelledby="verticallyCenteredModalLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                    <!-- Pone el modal al centro-->
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="verticallyCenteredModalLabel">Premios
                                                                                por
                                                                                mercado - {{ $item->NOMBRE }}</h5>
                                                                            <button class="btn p-1" type="button"
                                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                                <span class="fas fa-times fs--1"></span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div
                                                                                class="table-responsive scrollbar mx-n1 px-1 border-top">
                                                                                <!-- Envuelve la tabla en un contenedor responsive -->
                                                                                <table class="table table-md fs--1 mb-0">
                                                                                    <thead>
                                                                                        <tr>
                                                                                            <th
                                                                                                class="sort border-top ps-3">
                                                                                                Premios</th>
                                                                                            <th
                                                                                                class="sort border-top ps-3">
                                                                                                Cantidad</th>
                                                                                            <!--<th class="sort border-top ps-3"
                                                                                                                                                                            style="text-align: center;">
                                                                                                                                                                            ¿Premio Consuelo?</th>-->
                                                                                        </tr>
                                                                                    </thead>
                                                                                    <tbody>
                                                                                        @foreach ($laDatosView['premio'] as $premio)
                                                                                            <!--<tr>
                                                                                                            <td class="align-middle ps-3">
                                                                                                                <input
                                                                                                                    class="form-check-input custom-checkbox"
                                                                                                                    id="flexCheckDefault"
                                                                                                                    type="checkbox"
                                                                                                                    value=""
                                                                                                                    style="transform: scale(1.4); margin-right: 0.5rem;" />
                                                                                                                <label
                                                                                                                    class="form-check-label ps-1"
                                                                                                                    for="flexCheckDefault">{{ strtoupper($premio->NOMBRE) }}</label>
                                                                                                            </td>
                                                                                                            <td class="align-middle"><input
                                                                                                                    class="form-control"
                                                                                                                    name=""
                                                                                                                    id=""
                                                                                                                    type="number"
                                                                                                                    placeholder="Cantidad"
                                                                                                                    required
                                                                                                                    value="" /></td>
                                                                                                            <td class="align-middle"
                                                                                                                style="text-align: center;">
                                                                                                                <input
                                                                                                                    class="form-check-input custom-checkbox"
                                                                                                                    id="flexRadioDefault2"
                                                                                                                    type="radio"
                                                                                                                    name="flexRadioDefault"
                                                                                                                    checked=""
                                                                                                                    style="transform: scale(1.4); margin-right: 0.5rem;" />
                                                                                                            </td>
                                                                                                        </tr>-->
                                                                                            @php
                                                                                                $lnValorCantidad = '';
                                                                                                $isChecked = '';
                                                                                                if ($premio->PREMIO_CONSUELO == 'SI') {
                                                                                                    $lnValorCantidad = '0';
                                                                                                    $isChecked = 'checked';
                                                                                                }
                                                                                                if ($premio->PREMIO_CONSUELO == 'NO') {
                                                                                                    $isChecked = 'checked';
                                                                                                }
                                                                                            @endphp
                                                                                            <tr>
                                                                                                <td
                                                                                                    class="align-middle ps-3">
                                                                                                    <input
                                                                                                        class="form-check-input checkbox-input"
                                                                                                        id="flexCheckDefault"
                                                                                                        type="checkbox"
                                                                                                        {{ $isChecked }}
                                                                                                        value="{{ $premio->ID_PREMIO }}"
                                                                                                        style="transform: scale(1.4); margin-right: 0.5rem;"
                                                                                                        @if ($premio->PREMIO_CONSUELO == 'SI') disabled @endif />
                                                                                                    <label
                                                                                                        class="form-check-label ps-1 check-label"
                                                                                                        for="flexCheckDefault">{{ strtoupper($premio->NOMBRE) }}</label>
                                                                                                </td>

                                                                                                <td class="align-middle">
                                                                                                    <input
                                                                                                        class="form-control cantidad-input"
                                                                                                        name=""
                                                                                                        id=""
                                                                                                        type="number"
                                                                                                        placeholder="Cantidad"
                                                                                                        required
                                                                                                        value="{{ $lnValorCantidad }}"
                                                                                                        @if ($premio->PREMIO_CONSUELO == 'SI') disabled @endif />
                                                                                                    <span
                                                                                                        class="error-message"
                                                                                                        style="display: none; color:red;"></span>
                                                                                                </td>
                                                                                            </tr>
                                                                                        @endforeach

                                                                                    </tbody>
                                                                                </table>
                                                                            </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <a><button class="btn btn-danger"
                                                                                    onclick="EnviarDatos();"
                                                                                    type="button">Aceptar</button></a>
                                                                            <button class="btn btn-outline-danger"
                                                                                id="btnCancelar" type="button"
                                                                                data-bs-dismiss="modal">Cancelar</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </form>

                                                </tr>
                                                <tr>
                                                    <td class="align-middle ps-3 NRO_TICKET">{{ $item->NOMBRE }}</td>
                                                    <td class="align-middle ps-3 MERCADO">{{ $item->CIUDAD }}</td>
                                                    <td class="align-middle ps-3 PREMIO">{{ $item->DIRECCION }}</td>
                                                    @if ($item->ESTADO == 'H')
                                                        <td class="align-middle ps-3 NOMBRES">Habilitado</td>
                                                    @else
                                                        <td class="align-middle ps-3 NOMBRES">Inactivo</td>
                                                    @endif
                                                    <td class="align-middle ps-3">
                                                        <a href="{{ URL::action('ClientePremiadoController@edit', $item->ID_MERCADO) }}"
                                                            class="btn btn-info"><i class="fas fa-edit"></i></a>
                                                        <a href="" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#verticallyCentered{{ $item->ID_MERCADO }}"><i
                                                                class="fas fa-ban"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>

                                <div id="alertMessage" class="alert alert-outline-danger alert-dismissible fade show"
                                    role="alert" style="display: none;">
                                    <strong>¡Atención!</strong> <span id="alertText"></span>
                                    <button class="btn-close" type="button" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>



                                <div class="row align-items-center justify-content-end py-4 pe-0 fs--1">
                                    <div class="col-auto d-flex">
                                        <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900"
                                            data-list-info="data-list-info"></p><a class="fw-semi-bold" href="#!"
                                            data-list-view="*">Todos<span class="fas fa-angle-right ms-1"
                                                data-fa-transform="down-1"></span></a><a class="fw-semi-bold d-none"
                                            href="#!" data-list-view="less">Menos<span
                                                class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                                    </div>
                                    <div class="col-auto d-flex"><button class="page-link"
                                            data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                                        <ul class="mb-0 pagination"></ul><button class="page-link pe-0"
                                            data-list-pagination="next"><span
                                                class="fas fa-chevron-right"></span></button>
                                    </div>
                                </div>
                            </div>
                            <!--</div>-->
                            <div class="position-fixed top-0 start-50 translate-middle-x p-3 toast-container"
                                style="z-index: 1050; left: 50%; transform: translateX(-50%);">
                                <div class="toast fade" id="liveToast" role="alert" aria-live="assertive"
                                    aria-atomic="true" style="border-color: red;">
                                    <div class="toast-header">
                                        <strong class="me-auto" style="color: red;">Mensaje</strong>
                                        <!--<small class="text-800">11 mins ago</small>
                                                        <button class="btn ms-2 p-0" type="button"
                                                            data-bs-dismiss="toast" aria-label="Close"><span
                                                                class="uil uil-times fs-1"></span></button>-->
                                    </div>
                                    <div class="toast-body" style="color: red;">Debes seleccionar al menos un premio.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </main>
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
        var values = ObtenerValores();
        console.log(values);
        // Obtener los campos de cantidad
        var camposCantidad = document.getElementsByClassName('cantidad-input');
        var mensajesError = document.getElementsByClassName('error-message');
        var checkboxesMarcados = document.getElementsByClassName('checkbox-input');
        // Variable para verificar si todos los campos están llenos
        var todosLlenos = true;
        
        // Verificar si el checkbox específico está seleccionado
        //if ($('#flexCheckDefault:checked').length > 0) {
        if (values.length > 0) {
            // Verificar cada campo de cantidad
            for (var i = 0; i < camposCantidad.length; i++) {
                var campoCantidad = camposCantidad[i];
                var mensajeError = mensajesError[i];
                var checkboxMarcado = checkboxesMarcados[i];
                console.log(campoCantidad.value);

                // Verificar si el campo está visible y está vacío
                //if (campoCantidad.style.display !== 'none' && checkboxMarcado && campoCantidad.value === '') {
                if (campoCantidad.style.display !== 'none' && checkboxMarcado  && campoCantidad.value === '') {
                    // Verificar si el campo es inválido y tiene un mensaje de validación
                    if (campoCantidad.validity.valueMissing) {
                        var mensaje = campoCantidad.validationMessage;
                        mensajeError.textContent = mensaje;
                        mensajeError.style.display = 'block';
                    }
                    todosLlenos = false; // Al menos un campo está vacío
                    console.log('sii');
                } else {
                    // Limpiar y ocultar el mensaje de error si el campo es válido
                    mensajeError.textContent = '';
                    mensajeError.style.display = 'none';
                    console.log('noo');
                    todosLlenos = true;
                }
            }
            // Verificar si todos los campos están llenos
            if (todosLlenos) {
                var valores = ObtenerValores();
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
            $('#liveToast').toast('show');
        }
    }
</script>
