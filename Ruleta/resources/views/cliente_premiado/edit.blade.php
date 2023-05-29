@extends('layouts.admin')
@section('contenido')
    {!! Form::model($laDatosView, [
        'method' => 'PATCH',
        'route' => ['cliente_premiado.cliente_premiado.update', $laDatosView['cliente_premiado']->ID_CLIENTE_PREMIEADO],
    ]) !!}
    {{ Form::token() }}
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-xl-11 col-lg-12 custom-lg-1440">
            <div class="card mb-2">
                <h4 class="p-3">Editar Cliente Premiado</h4>
                <div class="p-3 code-to-copy ">
                    <form class="row g-3" novalidate>
                        <div class="row">
                            <div class="mb-2 col-xl-3 col-lg-6 col-md-6" style="display: none;">
                                <label class="form-label" for="inputCity">ID</label>
                                <input class="form-control" name="ID_CLIENTE_PREMIEADO" id="txtId" type="text"
                                    placeholder="Nro. Ticket" required
                                    value="{{ $laDatosView['cliente_premiado']->ID_CLIENTE_PREMIEADO }}" />
                                <div class="invalid-feedback">ID Vacio</div>
                            </div>
                            <div class="mb-2 col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="inputCity">Nro. Ticket</label>
                                <input class="form-control" name="NRO_TICKET" id="txtNroTicket" type="text"
                                    placeholder="Nro. Ticket" required
                                    value="{{ $laDatosView['cliente_premiado']->NRO_TICKET }}" />
                                <div class="invalid-feedback">Ingrese el numero de ticket</div>
                            </div>
                            <div class="mb-2 col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="inputEmail4">Nombres</label>
                                <input class="form-control" name="NOMBRES" id="txtNombres" type="text"
                                    placeholder="Nombres" required
                                    value="{{ $laDatosView['cliente_premiado']->NOMBRES }}" />
                                <div class="invalid-feedback">Ingrese su nombre</div>
                            </div>
                            <div class="mb-2 col-xl-6 col-lg-6 col-md-6">
                                <label class="form-label" for="inputPassword4">Apellidos</label>
                                <input class="form-control" name="APELLIDOS" id="txtApellidos" required type="text"
                                    placeholder="Apellidos" value="{{ $laDatosView['cliente_premiado']->APELLIDOS }}" />
                                <div class="invalid-feedback">Ingrese sus Apellidos</div>
                            </div>
                            <div class="mb-2 col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="inputAddress">Cedula de Identidad</label>
                                <input class="form-control" name="CARNET_IDENTIDAD" id="txtCI" type="text"
                                    placeholder="Cedula de Identidad" required
                                    value="{{ $laDatosView['cliente_premiado']->CARNET_IDENTIDAD }}" />
                                <div class="invalid-feedback">Ingrese Cedula de Identidad</div>
                            </div>
                            <div class="mb-2 col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="validationCustom02">Telefono</span></label>
                                <input type="number" class="form-control" name="TELEFONO" id="txtTelefono"
                                    placeholder="Telefono" required
                                    value="{{ $laDatosView['cliente_premiado']->TELEFONO }}">
                                <div class="invalid-feedback">Ingrese su telefono</div>
                            </div>


                            <div class="mb-2 col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="inputZip">Fecha Nacimiento</label>
                                <input class="form-control datetimepicker" name="FECHA_NACIMIENTO" id="dtFechaNac"
                                    type="date" required
                                    value="{{ $laDatosView['cliente_premiado']->FECHA_NACIMIENTO }}" />
                                <div id="smsFecha" class="invalid-feedback">Selecciona una fecha</div>
                            </div>
                            @php
                                if (count($laDatosView['premio']) > 1) {
                                    $estado = '';
                                } else {
                                    $estado = 'disabled';
                                }
                                
                            @endphp
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="inputState">Premio</label>
                                <select class="form-select" name="ID_PREMIO" id="cbPremio" data-choices="data-choices"
                                    data-options='{"removeItemButton":true,"placeholder":true,}' required
                                    aria-label="select example" {{ $estado }}>
                                    @if (count($laDatosView['premio']) > 1)
                                        <option selected="selected"
                                            value="{{ $laDatosView['cliente_premiado']->ID_PREMIO }}">
                                            {{ $laDatosView['nombre_premio']->NOMBRE }}</option>
                                    @endif
                                    @foreach ($laDatosView['premio'] as $item)
                                        @if ($item->ID_PREMIO != $laDatosView['cliente_premiado']->ID_PREMIO)
                                            <option value="{{ $item->ID_PREMIO }}">{{ $item->NOMBRE }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div id="smsPremio"
                                    style="width: 100%; margin-top: -20px; padding-bottom: 20px; font-size: .875em; color: #f06548;"
                                    class="invalid-feedback">
                                    Selecciona un premio
                                </div>
                            </div>
                        </div>
                        <div class="form-group" id="divGuardar">
                            {{ csrf_field() }}
                            <button class="btn btn-primary" id="txtGuardar" onclick="validarPremio();"
                                type="submit">Guardar</button>
                            <a href="/cliente_premiado"><button class="btn btn-danger">Volver</button></a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    <script>
        window.onload = function() {

        };

        function validarPremio() {
            document.getElementById('cbPremio').disabled = false;
            const select = document.getElementById('cbPremio');
            if (select.value === '') {
                // Si no se seleccionó una opción válida, mostrar un mensaje de error
                document.getElementById("smsPremio").style.display = "block";
            } else {
                // Si se seleccionó una opción válida, borrar cualquier mensaje de error existente
                document.getElementById("smsPremio").style.display = "none";
            }
            if (document.getElementById('dtFechaNac').value === '') {
                // Si no se seleccionó una fecha válida, mostrar un mensaje de error
                document.getElementById("smsFecha").style.display = "block";
            } else {
                // Si se seleccionó una opción válida, borrar cualquier mensaje de error existente
                document.getElementById("smsFecha").style.display = "none";
            }
        }
    </script>
@endsection
