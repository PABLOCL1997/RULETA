@extends('layouts.admin')
@section('contenido')
    <div class="container-fluid px-0" data-layout="container">
        <div class="card-header p-4 border-bottom border-300 bg-soft">
            <div class="row g-3 justify-content-between align-items-end">
                <div class="card shadow-none border border-300 my-4" data-component-card="data-component-card">
                    <main class="main" id="top">


                        <div class="p-4 code-to-copy">
                            <h3 class="text-secondary mb-4">Lista de clientes premiados</h3>
                            <!--<div class="table-responsive">-->
                            <div id="tableExample2"
                                data-list='{"valueNames":["NRO_TICKET","MERCADO","PREMIO","NOMBRES","APELLIDOS","CARNET_IDENTIDAD","TELEFONO", "CIUDAD", "FECHA_NACIMIENTO"],"page":5,"pagination":true}'>
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
                                                <th class="sort border-top ps-3" data-sort="ticket">Nro. Ticket</th>
                                                <th class="sort border-top ps-3" data-sort="mercado">Mercado</th>
                                                <th class="sort border-top ps-3" data-sort="premio">Premio</th>
                                                <th class="sort border-top ps-3" data-sort="nombres">Nombres</th>
                                                <th class="sort border-top ps-3" data-sort="apellidos">Apellidos</th>
                                                <th class="sort border-top ps-3" data-sort="ci">CI</th>
                                                <th class="sort border-top ps-3" data-sort="telefono">Teléfono</th>
                                                <th class="sort border-top ps-3" data-sort="ciudad">Ciudad</th>
                                                <th class="sort border-top ps-3" data-sort="fecha_nacimiento">Fecha
                                                    Nacimiento</th>
                                                <th class="ort border-top ps-3" scope="col">Acciónes</th>
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach ($laDatosView['cliente_premiado'] as $item)
                                                <tr>
                                                    <td class="align-middle ps-3 NRO_TICKET">{{ $item->NRO_TICKET }}</td>
                                                    <td class="align-middle ps-3 MERCADO">{{ $item->MERCADO }}</td>
                                                    <td class="align-middle ps-3 PREMIO">{{ $item->PREMIO }}</td>
                                                    <td class="align-middle ps-3 NOMBRES">{{ $item->NOMBRES }}</td>
                                                    <td class="align-middle ps-3 APELLIDOS">{{ $item->APELLIDOS }}</td>
                                                    <td class="align-middle ps-3 CARNET_IDENTIDAD">
                                                        {{ $item->CARNET_IDENTIDAD }}</td>
                                                    <td class="align-middle ps-3 TELEFONO">{{ $item->TELEFONO }}</td>
                                                    <td class="align-middle ps-3 CIUDAD">{{ $item->CIUDAD }}</td>
                                                    <td class="align-middle ps-3 FECHA_NACIMIENTO">
                                                        {{ $item->FECHA_NACIMIENTO }}</td>
                                                    <td class="align-middle ps-3">
                                                        <!--<a href="" class="btn btn-info" style="background-color: #FFD300;"><i class="fas fa-edit"></i></a>-->
                                                        <a href="{{ URL::action('ClientePremiadoController@edit', $item->ID_CLIENTE_PREMIEADO) }}"
                                                            class="btn btn-info"><i class="fas fa-edit"></i></a>
                                                        <a href="" class="btn btn-danger" data-bs-toggle="modal"
                                                            data-bs-target="#verticallyCentered{{ $item->ID_CLIENTE_PREMIEADO }}"><i
                                                                class="fas fa-ban"></i></a>
                                                    </td>
                                                </tr>
                                                <!-- Modal para anular -->
                                                <!--<form method="POST" action="/cliente_premiado/anular/{{ $item->ID_CLIENTE_PREMIEADO }}">
                                                            @csrf-->
                                                <div class="modal fade"
                                                    id="verticallyCentered{{ $item->ID_CLIENTE_PREMIEADO }}" tabindex="-1"
                                                    aria-labelledby="verticallyCenteredModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="verticallyCenteredModalLabel">
                                                                    Anular Cliente Premiado</h5>
                                                                <button class="btn p-1" type="button"
                                                                    data-bs-dismiss="modal" aria-label="Close">
                                                                    <span class="fas fa-times fs--1"></span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p class="text-700 lh-lg mb-0">¿ Anular el premio de
                                                                    {{ $item->NOMBRES }} {{ $item->APELLIDOS }} con CI
                                                                    {{ $item->CARNET_IDENTIDAD }}, ganador del premio
                                                                    {{ $item->PREMIO }} ? </p>
                                                            </div>
                                                            <div class="modal-footer">

                                                                <!--<a href="{{ URL::action('ClientePremiadoController@destroy', $item->ID_CLIENTE_PREMIEADO) }}"><button class="btn btn-danger" type="button">Anular</button></a>-->
                                                                <a><button class="btn btn-danger"
                                                                        onclick="Anular({{ $item->ID_CLIENTE_PREMIEADO }});"
                                                                        type="button">Anular</button></a>
                                                                <button class="btn btn-outline-danger" id="btnCancelar"
                                                                    type="button"
                                                                    data-bs-dismiss="modal">Cancelar</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--</form>-->
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
                        </div>
                    </main>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function Anular($tnId) {
        $.ajax({
            url: '/cliente_premiado/anular/' + $tnId,
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            data: {
                tnId: $tnId,
            },
            success: function(response) {
                var message = response.message; // Obtén el mensaje de respuesta
                // La solicitud se completó con éxito
                console.log('La solicitud Anular se completó con éxito');
                if (response.error == 0) {
                    window.location.href = '/cliente_premiado';
                } else {
                    alert(response.message);
                    console.log(response.message);
                    document.getElementById('btnCancelar').click();
                }
            },
            error: function(xhr, status, error) {
                // Hubo un error en la solicitud
                console.log('Hubo un error en la solicitud Anular');
                console.error(error);
            }
        });
    }
</script>
