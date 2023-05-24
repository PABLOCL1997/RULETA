@extends('layouts.admin')
@section('contenido') 
{!! Form::open(array('url'=>'cliente_premiado','method'=>'GET' ,'class'=>'needs-validation','novalidate','autocomplete'=>'off', 'files' => 'true')) !!}
{{ Form::token() }}
    <div class="p-4 code-to-copy">
        <form class="row g-3">
            <div class="col-md-6">
                <label class="form-label" for="inputCity">Ciudad</label>
                <input class="form-control" id="inputCity" type="text" />
              </div>
            <div class="col-md-6">
                <label class="form-label" for="inputEmail4">Nombres</label>
                <input class="form-control" id="inputEmail4" type="email" />
            </div>
            <div class="col-md-6">
                <label class="form-label" for="inputPassword4">Apellidos</label>
                <input class="form-control" id="inputPassword4" type="password" />
            </div>
            <div class="col-12">
                <label class="form-label" for="inputAddress">Cedula de Identidad</label>
                <input class="form-control" id="inputAddress" type="text" placeholder="1234 Main St" />
            </div>
            <div class="col-12">
                <label class="form-label" for="inputAddress2">Telefono</label>
                <input class="form-control" id="inputAddress2" type="text" placeholder="Apartment, studio, or floor" />
            </div>
              
            <div class="col-md-4">
                <label class="form-label" for="inputState">Ciudad</label>
                <select class="form-select" id="inputState">
                  <option selected="selected">Selecciona una opción</option>
                    @foreach($laDatosView['ciudad'] as $item)
                        <option value="{{ $item->Nombre }}">{{ $item->Nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label class="form-label" for="inputZip">Fecha Nacimiento</label>
                <input class="form-control datetimepicker" id="datepicker" type="text" placeholder="dd/mm/yyyy" data-options='{"disableMobile":true,"dateFormat":"d/m/Y"}' />
            </div>
            <div class="col-12">
                <div class="form-check">
                <input class="form-check-input" id="gridCheck" type="checkbox" />
                <label class="form-check-label" for="gridCheck">Check me out</label>
                </div>
            </div>
              <div class="col-12">
                <button class="btn btn-primary" type="submit">Sign in</button>
              </div>
        </form>
    </div>
{!! Form::close() !!}
@endsection