@extends('layouts.app')
@push('scripts')
	<script src="{{ asset('js/cliente/AgregarCliente.js') }}"></script>
@endpush
@section('title')
    Agregar cliente
@endsection
@section('content')

    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title">Agregar Cliente</h3>
                </div>
                <!--begin::Form-->
                <form action="{{ route('cliente.guardarcliente') }}" method="post" id="submit_cliente">
                    @csrf
                    <div class="card-body">

                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Razón social</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="razon_social" id="razon_social" required/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Nombre comercial/ Cliente</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cliente" id="cliente" required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Grupo</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="grupo" id="grupo"  />
                                </div>
                            </div>
                        </div>

                        <div class="card card-custom gutter-b">
                            <div class="card-header">
                                <div class="card-title">
                                    <h3 class="card-label">
                                        <small>Información Técnica</small>
                                    </h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group row">
                                    <div class="col-lg-4">
                                        <label>Días de Crédito </label>
                                        <div class="input-group">
                                            <input type="number" class="form-control" name="dias_credito" id="dias_credito" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Costo de estadía</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="costo_estadia" id="costo_estadia" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Costo km extraordinario</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="costo_km" id="costo_km" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card card-custom gutter-b">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">
                                                <small>Contacto operativo</small>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row form-group" >
                                            <div class="col-lg-12" id="tblArchivos">
                                                <table class='table table-bordered table-hover' id='tblDocumentos'>
                                                    <thead>
                                                    <tr>
                                                        <th>Nombre contacto</th>
                                                        <th>Email</th>
                                                        <th>Telefono</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id='tbodyDocumentos'>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-lg-12">
                                                <a href="#" class="btn btn-icon btn-outline-success btn-circle btn-sm mr-2 hrefAgregarOtro" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
                                                    <i class="flaticon2-plus"></i>
                                                </a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card card-custom gutter-b">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">
                                                <small>Contacto facturación y cobranza</small>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                      <div class="row form-group" >
                                            <div class="col-lg-12" id="tblArchivos1">
                                                <table class='table table-bordered table-hover' id='tblDocumentos1'>
                                                    <thead>
                                                    <tr>
                                                        <th>Nombre contacto</th>
                                                        <th>Email</th>
                                                        <th>Telefono</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id='tbodyDocumentos1'>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <div class="col-lg-12">
                                                <a href="#" class="btn btn-icon btn-outline-success btn-circle btn-sm mr-2 hrefAgregarOtro1" data-toggle="tooltip" data-theme="dark" title="Agregar archivo">
                                                    <i class="flaticon2-plus"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-12">
                                <label for="observaciones">Observaciones</label>
                                <textarea class="form-control" name="observaciones" id="observaciones" rows="3"></textarea>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <button type="button"  id="btnGuardar" class="btn btn-primary mr-2">Guardar</button>
                                <a href="{{ route('cliente.listadocliente') }}"  class="btn btn-secondary">Cancelar</a>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Card-->



@endsection