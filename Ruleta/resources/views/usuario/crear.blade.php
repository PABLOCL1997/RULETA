@extends('layouts.admin')
@section('contenido') 
    <div class="container-fluid px-0" data-layout="container">
        <div class="card-header p-4 border-bottom border-300 bg-soft">
            <div class="row g-3 justify-content-between align-items-end">
                <div class="card shadow-none border border-300 my-4" data-component-card="data-component-card">
                    <main class="main" id="top">
                        <div class="p-4 code-to-copy">
                            <h3 class="text-secondary mb-4">Crear nuevo usuario</h3>
                            
                                <div>
                                    <div class="row g-3 justify-content-between mb-4">
                                        <div class="col-auto">
                                          <div class="d-md-flex justify-content-between">
                                          <a href="/usuario"><button class="btn  btn-phoenix-secondary" type="button" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-user-plus text-dark" data-fa-transform="down-3"></span> Volver</button></a>
                                          </div>
                                        </div>
                                            <div class="border p-3">

                                                <form id="addEventForm" autocomplete="off" action="{{ url('/submit-form') }}" method="POST">
                                                    <div class="row text-uppercase">
                                                      <div id="alertaUser" ></div>
                                                      <div class="col-xl-6 col-lg-6 col-md-6 mb-3">
                                                          <label class="fw-bold mb-2 text-1000" for="leadStatus">Roles</label>
                                                        <select class="form-select text-uppercase" id="roles">
                                                            <option selected="selected" disabled>Seleccionar</option>
                                                          @foreach($DatosView['roles'] as $item)
                                                          <option value="{{ $item->id_rol }}">{{ $item->nombre }}</option>
                                                          @endforeach
                                                        </select>
                                                      </div>
                                                      <div class="col-xl-6 col-lg-6 col-md-6 mb-3">
                                                          <label class="fw-bold mb-2 text-1000" for="leadStatus">Mercado</label>
                                                        <select class="form-select text-uppercase" id="mercado">
                                                            <option selected="selected" disabled>Seleccionar</option>
                                                            @foreach($DatosView['mercado'] as $item)
                                                          <option value="{{ $item->ID_MERCADO }}">{{ $item->NOMBRE }}</option>
                                                          @endforeach
                                                        </select>
                                                    </div>
                                                      <div class="col-xl-6 col-lg-6 col-md-6 mb-3">
                                                        <label class="fw-bold mb-2 text-1000" for="createDate">Nombres</label>
                                                        <input type="text" class="form-control" placeholder="NOMBRES" id="nombres" name="nombres"/>
                                                      </div>
                                                      <div class="col-xl-6 col-lg-6 col-md-6 mb-3">
                                                          <label class="fw-bold mb-2 text-1000" for="designation">Apellidos</label>
                                                        <input type="text" class="form-control" placeholder="APELLIDOS" id="apellidos" name="apellidos"/>
                                                      </div>
                                                      <div class="col-xl-6 col-lg-6 col-md-6 mb-3">
                                                        <label class="fw-bold mb-2 text-1000" for="leadOwner">Email</label>
                                                        <input type="email" class="form-control" placeholder="EMAIL" id="email" name="email"/>
                                                    </div>
                                                </div>
                                                
                                                      <div class="modal-footer d-flex justify-content-end align-items-center">
                                                        <button class="btn btn-sm btn-primary" type="submit"> + Registrar nuevo</button>
                                                      </div>
                                                  </form>
                                                </div>
                                            
                                    </div>
                                </div>
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>

    <script>
      document.getElementById('addEventForm').addEventListener('submit', function(event) {
        event.preventDefault(); 

        var roles = document.getElementById('roles').value;
        var nombres = document.getElementById('nombres').value;
        var apellidos = document.getElementById('apellidos').value;
        var email = document.getElementById('email').value;
        var mercado = document.getElementById('mercado').value;

        // Obtener el primer nombre
        var primerNombre = nombres.split(' ')[0];

        var data = {
            roles: roles,
            name: primerNombre,
            nombres: nombres,
            apellidos: apellidos,
            email: email,
            mercado: mercado
        };
       
        $.ajax({
            url: '/submit-form',
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            // dataType: 'json',
            data: data,
            success: function(response) {
                console.log(response);
                html = response.message;
                // $('#filterModal').modal('hide');
                $('#alertaUser').prepend(html);
                // ocultar alertaUser despues de 5 segundos
                if (response.status == 'success') {
                  setTimeout(function() {
                      $('#filterModal').modal('hide');
                      return window.location.href = '/usuario';
                    }, 1500);
                } else if (response.status == 'error') {
                  setTimeout(function() {
                    $('#alertaUser').empty();
                  }, 2500);
                }

            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    </script>

@endsection