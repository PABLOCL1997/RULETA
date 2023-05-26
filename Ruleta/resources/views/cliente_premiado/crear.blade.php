@extends('layouts.admin')
@section('contenido')
    {!! Form::open([
        'url' => 'cliente_premiado',
        'method' => 'POST',
        'class' => 'needs-validation',
        'novalidate',
        'autocomplete' => 'off',
        'files' => 'true',
    ]) !!}
    {{ Form::token() }}
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-xl-11 col-lg-12 custom-lg-1440">
            <div class="card mb-3">
                <h4 class="p-3">Nuevo Cliente Premiado</h4>
                <div class="p-3 code-to-copy ">
                    <form class="row g-3" novalidate>
                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="inputCity">Nro. Ticket</label>
                                <input class="form-control" name="NRO_TICKET" id="txtNroTicket" type="text"
                                    placeholder="Nro. Ticket" required value="" />
                                <div class="invalid-feedback">Ingrese el numero de ticket</div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="inputEmail4">Nombres</label>
                                <input class="form-control" name="NOMBRES" id="txtNombres" type="text"
                                    placeholder="Nombres" required value="" />
                                <div class="invalid-feedback">Ingrese su nombre</div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <label class="form-label" for="inputPassword4">Apellidos</label>
                                <input class="form-control" name="APELLIDOS" id="txtApellidos" required type="text"
                                    placeholder="Apellidos" value="" />
                                <div class="invalid-feedback">Ingrese sus Apellidos</div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="inputAddress">Cedula de Identidad</label>
                                <input class="form-control" name="CARNET_IDENTIDAD" id="txtCI" type="text"
                                    placeholder="Cedula de Identidad" required value="" />
                                <div class="invalid-feedback">Ingrese Cedula de Identidad</div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="validationCustom02">Telefono</span></label>
                                <input type="number" class="form-control" name="TELEFONO" id="txtTelefono"
                                    placeholder="Telefono" required value="">
                                <div class="invalid-feedback">Ingrese su telefono</div>
                            </div>


                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="inputZip">Fecha Nacimiento</label>
                                <input class="form-control datetimepicker" name="FECHA_NACIMIENTO" id="dtFechaNac"
                                    type="date" placeholder="dd/mm/yyyy" required
                                    data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' />
                                <div class="invalid-feedback">Selecciona una fecha</div>
                            </div>

                            <div class="col-xl-3 col-lg-6 col-md-6">
                                <label class="form-label" for="inputState">Premio</label>
                                <select class="form-select" name="ID_PREMIO" id="cbPremio" data-choices="data-choices"
                                    data-options='{"removeItemButton":true,"placeholder":true}' required
                                    aria-label="select example">
                                    @if (count($laDatosView['premio']) > 1)
                                        <option selected="selected" value="">Selecciona una opción</option>
                                    @endif
                                    <!--<option selected="selected" value="">Selecciona una opción</option>-->
                                    @foreach ($laDatosView['premio'] as $item)
                                        <option value="{{ $item->ID_PREMIO }}">{{ $item->NOMBRE }}</option>
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
                            <button class="btn btn-danger" type="reset">Cancelar</button>
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
            const select = document.getElementById('cbPremio');
            if (select.value === '') {
                // Si no se seleccionó una opción válida, mostrar un mensaje de error
                document.getElementById("smsPremio").style.display = "block";
            } else {
                // Si se seleccionó una opción válida, borrar cualquier mensaje de error existente
                document.getElementById("smsPremio").style.display = "none";
            }
        }
    </script>
@endsection
