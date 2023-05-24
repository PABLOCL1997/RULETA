@extends('layouts.admin')
@section('contenido') 
<style>
    @media (max-width: 1439.98px) {
        .custom-lg-1440 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
</style>
{!! Form::open(array('url'=>'cliente_premiado','method'=>'POST' ,'class'=>'needs-validation','novalidate','autocomplete'=>'off', 'files' => 'true')) !!}
{{ Form::token() }}
    <div class="row d-flex justify-content-center align-items-center">
        <div class="col-xl-9 col-lg-12 custom-lg-1440">
                <div class="card mb-3">
                    <h4 class="p-3">Nuevo Cliente Premiado</h4>
                    <div class="p-3 code-to-copy ">
                        <form class="row g-3" novalidate>
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <label class="form-label" for="inputCity">Nro. Ticket</label>
                                    <input class="form-control" name="NRO_TICKET" id="txtNroTicket" type="text" placeholder="Nro. Ticket" required value="aaaaa"/>
                                    <div class="invalid-feedback">Ingrese el numero de ticket</div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <label class="form-label" for="inputEmail4">Nombres</label>
                                    <input class="form-control" name="NOMBRES" id="txtNombres" type="text" placeholder="Nombres" required value="aaaaa"/>
                                    <div class="invalid-feedback">Ingrese su nombre</div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <label class="form-label" for="inputPassword4">Apellidos</label>
                                    <input class="form-control" name="APELLIDOS" id="txtApellidos" required type="text" placeholder="Apellidos"  value="aaaaa"/>
                                    <div class="invalid-feedback">Ingrese sus Apellidos</div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <label class="form-label" for="inputAddress">Cedula de Identidad</label>
                                    <input class="form-control" name="CARNET_IDENTIDAD" id="txtCI" type="text" placeholder="Cedula de Identidad" required value="aaaaa"/>
                                    <div class="invalid-feedback">Ingrese Cedula de Identidad</div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <label class="form-label" for="validationCustom02">Telefono</span></label>
                                    <input type="number" class="form-control" name="TELEFONO" id="txtTelefono" placeholder="Telefono" required value="4545">
                                    <div class="invalid-feedback">Ingrese su telefono</div>
                                </div>
                                  
                                
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <label class="form-label" for="inputZip">Fecha Nacimiento</label>
                                    <input class="form-control datetimepicker" name="FECHA_NACIMIENTO" id="dtFechaNac" type="text" placeholder="dd/mm/yyyy" required data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' />
                                    <div class="invalid-feedback">Selecciona una fecha</div>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <label class="form-label" for="inputState">Ciudad</label>
                                    <select class="form-select" name="CIUDAD" id="cbCiudad" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}' required>
                                        <option selected="selected" value="">Selecciona una opción</option>
                                        @foreach($laDatosView['ciudad'] as $item)
                                            <option value="{{ $item->NOMBRE }}">{{ $item->NOMBRE }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Selecciona una ciudad</div>
                                </div>
                                              
                                <div class="col-xl-3 col-lg-6 col-md-6">
                                    <label class="form-label" for="inputState">Premio</label>
                                    <select class="form-select" name="PREMIO" id="cbPremio" data-choices="data-choices" data-options='{"removeItemButton":true,"placeholder":true}' required>
                                        <option selected="selected" value="">Selecciona una opción</option>
                                        @foreach($laDatosView['premio'] as $item)
                                            <option value="{{ $item->ID_PREMIO }}">{{ $item->NOMBRE }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">Selecciona un premio</div>
                                </div>
                            </div>
                            <!--<button type="submit" style="background-color:#ed1c24; color:#ffffff; text-transform:uppercase;" class="btn btn-primary">
                                <div class="d-flex align-items-center">
                                <i class="fas fa-save me-2"></i>
                                <span>Guardar</span>
                                </div>
                            </button>-->
                            <div class="form-group" id="divGuardar">
                                {{csrf_field()}}
                                <button class="btn btn-primary" id="txtGuardar" type="submit">Guardar</button>
                                <button class="btn btn-danger" type="reset">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
        </div>
    </div>
{!! Form::close() !!}
@endsection