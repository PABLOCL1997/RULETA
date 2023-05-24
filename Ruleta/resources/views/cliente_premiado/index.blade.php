@extends('layouts.admin')
@section('contenido') 
    <div class="container-fluid px-0" data-layout="container">
        <div class="card-header p-4 border-bottom border-300 bg-soft">
            <div class="row g-3 justify-content-between align-items-end">
                <div class="card shadow-none border border-300 my-4" data-component-card="data-component-card">
                    <main class="main" id="top">
                        <div class="p-4 code-to-copy">
                            <h3 class="text-secondary mb-4">Lista de Clientes Premiadosss</h3>
                            <!--<div class="table-responsive">-->
                                <div id="tableExample2" data-list='{"valueNames":["NRO_TICKET","MERCADO","PREMIO","NOMBRES","APELLIDOS","CARNET_IDENTIDAD","TELEFONO", "CIUDAD", "FECHA_NACIMIENTO"],"page":5,"pagination":true}'>
                                    <div class="row g-3 justify-content-between mb-4">
                                        <div class="col-auto">
                                          <div class="d-md-flex justify-content-between">
                                            <div><a href="/cliente_premiado/create"><button class="btn btn-success me-4" style="background-color:#006400; color:#ffffff;"><span class="fas fa-plus me-2"></span>NUEVO</button></a>
                                            <button class="btn btn-link text-900 px-0"></button></div>
                                          </div>
                                        </div>
                                        <div class="col-auto">
                                          <div class="d-flex">
                                            <div class="search-box me-2">
                                              <form class="position-relative" data-bs-toggle="search" data-bs-display="static"><input class="form-control search-input search" type="search" placeholder="Buscar..." aria-label="Search" />
                                                <span class="fas fa-search search-box-icon"></span>
                                              </form>
                                            </div>
                                            <!--<div class="flatpickr-input-container me-2"><input class="form-control ps-6 datetimepicker" id="datepicker" type="text" data-options='{"dateFormat":"M j, Y","disableMobile":true,"defaultDate":"Mar 1, 2022"}' /><span class="uil uil-calendar-alt flatpickr-icon text-700"></span></div><button class="btn px-3 btn-phoenix-secondary" type="button" data-bs-toggle="modal" data-bs-target="#filterModal" data-boundary="window" aria-haspopup="true" aria-expanded="false" data-bs-reference="parent"><span class="fa-solid fa-filter text-primary" data-fa-transform="down-3"></span></button>
                                            <div class="modal fade" id="filterModal" tabindex="-1">
                                              <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border">
                                                  <form id="addEventForm" autocomplete="off">
                                                    <div class="modal-header border-200 p-4">
                                                      <h5 class="modal-title text-1000 fs-2 lh-sm">Filter</h5><button class="btn p-1 text-900" type="button" data-bs-dismiss="modal" aria-label="Close"><span class="fas fa-times fs--1"></span></button>
                                                    </div>
                                                    <div class="modal-body pt-4 pb-2 px-4">
                                                      <div class="mb-3"><label class="fw-bold mb-2 text-1000" for="leadStatus">Lead Status</label><select class="form-select" id="leadStatus">
                                                          <option value="newLead" selected="selected">New Lead</option>
                                                          <option value="coldLead">Cold Lead</option>
                                                          <option value="wonLead">Won Lead</option>
                                                          <option value="canceled">Canceled</option>
                                                        </select></div>
                                                      <div class="mb-3"><label class="fw-bold mb-2 text-1000" for="createDate">Create Date</label><select class="form-select" id="createDate">
                                                          <option value="today" selected="selected">Today</option>
                                                          <option value="last7Days">Last 7 Days</option>
                                                          <option value="last30Days">Last 30 Days</option>
                                                          <option value="chooseATimePeriod">Choose a time period</option>
                                                        </select></div>
                                                      <div class="mb-3"><label class="fw-bold mb-2 text-1000" for="designation">Designation</label><select class="form-select" id="designation">
                                                          <option value="VPAccounting" selected="selected">VP Accounting</option>
                                                          <option value="ceo">CEO</option>
                                                          <option value="creativeDirector">Creative Director</option>
                                                          <option value="accountant">Accountant</option>
                                                          <option value="executiveManager">Executive Manager</option>
                                                        </select></div>
                                                    </div>
                                                    <div class="modal-footer d-flex justify-content-end align-items-center px-4 pb-4 border-0 pt-3"><button class="btn btn-sm btn-phoenix-primary px-4 fs--2 my-0" type="submit"> <span class="fas fa-arrows-rotate me-2 fs--2"></span>Reset</button><button class="btn btn-sm btn-primary px-9 fs--2 my-0" type="submit">Done</button></div>
                                                  </form>
                                                </div>
                                              </div>
                                            </div>-->
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
                                                <th class="sort border-top ps-3" data-sort="fecha_nacimiento">Fecha Nacimiento</th>
                                                <th class="ort border-top ps-3" scope="col">Acciónes</th>
                                              </tr>
                                            </thead>
                                            <tbody class="list">
                                                @foreach($laDatosView['cliente_premiado'] as $item)
                                                    <tr>
                                                        <td class="align-middle ps-3 NRO_TICKET">{{ $item->NRO_TICKET }}</td>
                                                        <td class="align-middle ps-3 MERCADO">{{ $item->MERCADO }}</td>
                                                        <td class="align-middle ps-3 PREMIO">{{ $item->PREMIO }}</td>
                                                        <td class="align-middle ps-3 NOMBRES">{{ $item->NOMBRES }}</td>
                                                        <td class="align-middle ps-3 APELLIDOS">{{ $item->APELLIDOS }}</td>
                                                        <td class="align-middle ps-3 CARNET_IDENTIDAD">{{ $item->CARNET_IDENTIDAD }}</td>
                                                        <td class="align-middle ps-3 TELEFONO">{{ $item->TELEFONO }}</td>
                                                        <td class="align-middle ps-3 CIUDAD">{{ $item->CIUDAD }}</td>
                                                        <td class="align-middle ps-3 FECHA_NACIMIENTO">{{ $item->FECHA_NACIMIENTO }}</td>
                                                        <td class="align-middle ps-3">
                                                            <!--<a href="" class="btn btn-info" style="background-color: #FFD300;"><i class="fas fa-edit"></i></a>-->
                                                            <a href="" class="btn btn-info"><i class="fas fa-edit"></i></a>
                                                            <a href="" class="btn btn-danger"><i class="fas fa-trash"></i></a>  
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

@endsection