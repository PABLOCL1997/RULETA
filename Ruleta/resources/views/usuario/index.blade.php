@extends('layouts.admin')
@section('contenido') 
    <div class="container-fluid px-0" data-layout="container">
        <div class="card-header p-4 border-bottom border-300 bg-soft">
            <div class="row g-3 justify-content-between align-items-end">
                <div class="card shadow-none border border-300 my-4" data-component-card="data-component-card">
                    <main class="main" id="top">
                        <div class="p-4 code-to-copy">
                            <h3 class="text-secondary mb-4">Usuarios</h3>
                            <!--<div class="table-responsive">-->
                                <div id="tableExample2" data-list='{"valueNames":["ID","NAME","EMAIL","NOMBRES","APELLIDOS","ESTADO","MERCADO", "ROL", "FECHA_CREADO"],"page":5,"pagination":true}'>
                                    <div class="row g-3 justify-content-between mb-4">
                                        <div class="col-auto">
                                          <div class="d-md-flex justify-content-between">
                                            <div>
                                            <button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="modal" data-bs-target="#filterModal" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fas fa-user-plus text-dark" data-fa-transform="down-3"></span> NUEVO</button>
                                          </div>
                                          </div>
                                        </div>
                                        <div class="col-auto">
                                          <div class="d-flex">
                                            <div class="search-box me-2">
                                              <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input class="form-control search-input search" type="search" placeholder="Buscar..." aria-label="Search" />
                                                <span class="fas fa-search search-box-icon"></span>
                                              </form>
                                            </div>
                                            
                                            <div class="modal fade" id="filterModal" tabindex="-1">
                                              <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border">
                                                  <form id="addEventForm" autocomplete="off" action="{{ url('/submit-form') }}" method="POST">
                                                    <div class="modal-header border-200 p-4">
                                                      <h5 class="modal-title text-1000 fs-2 lh-sm">Nuevo usuario</h5><button class="btn p-1 text-900" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
                                                    </div>
                                                    <div class="modal-body pt-4 pb-2 px-4 text-uppercase">
                                                      <div id="alertaUser" ></div>
                                                      <div class="mb-3 text-uppercase">
                                                        <label class="fw-bold mb-2 text-1000" for="leadStatus">Roles</label>
                                                        <select class="form-select text-uppercase" id="roles">
                                                          <option selected="selected" disabled>Seleccionar</option>
                                                          @foreach($DatosView['roles'] as $item)
                                                          <option value="{{ $item->id_rol }}">{{ $item->nombre }}</option>
                                                          @endforeach
                                                        </select>
                                                      </div>
                                                      <div class="mb-3 text-uppercase">
                                                        <label class="fw-bold mb-2 text-1000" for="leadStatus">Mercado</label>
                                                        <select class="form-select text-uppercase" id="mercado">
                                                          <option selected="selected" disabled>Seleccionar</option>
                                                          @foreach($DatosView['mercado'] as $item)
                                                          <option value="{{ $item->ID_MERCADO }}">{{ $item->NOMBRE }}</option>
                                                          @endforeach
                                                        </select>
                                                      </div>
                                                      <div class="mb-3">
                                                        <label class="fw-bold mb-2 text-1000" for="createDate">Nombres</label>
                                                        <input type="text" class="form-control" placeholder="Nombres" id="nombres" name="nombres"/>
                                                      </div>
                                                      <div class="mb-3">
                                                        <label class="fw-bold mb-2 text-1000" for="designation">Apellidos</label>
                                                        <input type="text" class="form-control" placeholder="Apellidos" id="apellidos" name="apellidos"/>
                                                      </div>
                                                      <div class="mb-3">
                                                        <label class="fw-bold mb-2 text-1000" for="leadOwner">Email</label>
                                                        <input type="email" class="form-control" placeholder="Email" id="email" name="email"/>
                                                      </div>

                                                    </div>
                                                      <div class="modal-footer d-flex justify-content-end align-items-center px-4 pb-4 border-0 pt-3">
                                                        <button class="btn btn-sm btn-phoenix-primary px-4 fs--2 my-0" type="submit"> <span class="fas fa-arrows-rotate me-2 fs--2"></span>Reset</button>
                                                        <button class="btn btn-sm btn-primary px-9 fs--2 my-0" type="submit">Registrar nuevo</button>
                                                      </div>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>
                                            
                                          </div>
                                        </div>
                                    </div>
                                    <div class="table-responsive scrollbar mx-n1 px-1 border-top">
                                        <table class="table table-striped table-sm fs--1 mb-0">
                                            <thead>
                                              <tr>
                                                <th class="sort border-top ps-3" data-sort="ticket">Nro.</th>
                                                <th class="sort border-top ps-3" data-sort="name">Usuario</th>
                                                <th class="sort border-top ps-3" data-sort="email">Email</th>
                                                <th class="sort border-top ps-3" data-sort="nombres">Nombres</th>
                                                <th class="sort border-top ps-3" data-sort="apellidos">Apellidos</th>
                                                <th class="sort border-top ps-3" data-sort="estado">Estado</th>
                                                <th class="sort border-top ps-3" data-sort="mercado">Mercado</th>
                                                <th class="sort border-top ps-3" data-sort="rol">Rol</th>
                                                <th class="sort border-top ps-3" data-sort="fecha_creado">Fecha registro</th>
                                                <th class="ort border-top ps-3" scope="col">Acciónes</th>
                                              </tr>
                                            </thead>
                                            <tbody class="list">
                                                @foreach($DatosView['usuarios'] as $item)
                                                    <tr>
                                                        <td class="align-middle ps-3 ID">{{ $item->id }}</td>
                                                        <td class="align-middle ps-3 NAME">{{ $item->name }}</td>
                                                        <td class="align-middle ps-3 EMAIL"><a href="mailto:{{ $item->email }}" target="_blank">{{ $item->email }}</a></td>

                                                        <td class="align-middle ps-3 NOMBRES">{{ $item->nombres }}</td>
                                                        <td class="align-middle ps-3 APELLIDOS">{{ $item->apellidos }}</td>
                                                        <td class="align-middle ps-3 ESTADO">
                                                        @if ($item->estado_usuario == 'activo')
                                                        <span class="badge badge-phoenix fs--2 badge-phoenix-success"><span class="badge-label">{{ $item->estado_usuario }}</span><span class="ms-1" data-feather="package" style="height:12.8px;width:12.8px;"></span></span>
                                                        @else
                                                        <span class="badge badge-phoenix fs--2 badge-phoenix-danger"><span class="badge-label">{{ $item->estado_usuario }}</span><span class="ms-1" data-feather="package" style="height:12.8px;width:12.8px;"></span></span>
                                                        @endif
                                                        </td>
                                                        <td class="align-middle ps-3 MERCADO"><span class="badge badge-phoenix fs--2 badge-phoenix-info"><span class="badge-label">{{ $item->NOMBRE }}</span><span class="ms-1" data-feather="info" style="height:12.8px;width:12.8px;"></span></span></td>
                                                        <td class="align-middle ps-3 ROL">{{ $item->nombre_rol }}</td>
                                                        <td class="align-middle ps-3 FECHA_CREADO"><span class="badge badge-phoenix fs--2 badge-phoenix-primary"><span class="badge-label">{{ $item->created_at }}</span><span class="ms-1" data-feather="package" style="height:12.8px;width:12.8px;"></span></span></td>
                                                        <td class="align-middle ps-3">
                                                            <!--<a href="" class="btn btn-info" style="background-color: #FFD300;"><i class="fas fa-edit"></i></a>-->
                                                            <!-- <a href="" class="btn btn-info"><i class="fas fa-edit"></i></a> -->
                                                            <!-- <a href="" class="btn btn-danger"><i class="fas fa-trash"></i></a>   -->
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row align-items-center justify-content-end py-4 pe-0 fs--1">
                                        <div class="col-auto d-flex">
                                          <p class="mb-0 d-none d-sm-block me-3 fw-semi-bold text-900" data-list-info="data-list-info"></p><a class="fw-semi-bold" href="#!" data-list-view="*">Todos<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a><a class="fw-semi-bold d-none" href="#!" data-list-view="less">Menos<span class="fas fa-angle-right ms-1" data-fa-transform="down-1"></span></a>
                                        </div>
                                        <div class="col-auto d-flex"><button class="page-link" data-list-pagination="prev"><span class="fas fa-chevron-left"></span></button>
                                          <ul class="mb-0 pagination"></ul><button class="page-link pe-0" data-list-pagination="next"><span class="fas fa-chevron-right"></span></button>
                                        </div>
                                    </div>
                                </div>
                            <!--</div>-->
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
                    }, 1500);
                } else if (response.status == 'error') {
                  setTimeout(function() {
                    $('#alertaUser').empty();
                  }, 1500);
                }

            },
            error: function(response) {
                console.log(response);
            }
        });
    });

    </script>

@endsection