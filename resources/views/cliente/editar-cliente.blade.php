@extends('layouts.app')
@push('scripts')
	<script src="{{ asset('js/cliente/EditarCliente.js') }}"></script>
@endpush
@section('title')
    Editar cliente
@endsection
@section('content')

    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title">Editar Cliente</h3>
                </div>

                <input type="hidden" id="documentoEliminarOperativo" value="{{ route('cliente.eliminarcontactooperativo') }}">
                <input type="hidden" id="documentoEliminarFacturacion" value="{{ route('cliente.eliminarcontactofacturacion') }}">
                <!--begin::Form-->
                <form action="{{ route('cliente.updatecliente') }}" method="post" id="submit_cliente">
                    @csrf
                    <div class="card-body">
                        <input type="hidden" name="cliente_id" value="{{ $data->id }}">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Razón social</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="razon_social" value="{{ $data->razon_social }}" id="razon_social" required/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Nombre comercial/ Cliente</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="cliente" id="cliente" value="{{ $data->nombre_cliente }}" required/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Grupo</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" name="grupo" id="grupo" value="{{ $data->grupo }}" />
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
                                            <input type="number" class="form-control" name="dias_credito" id="dias_credito" value="{{ $data->dias_credito }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Costo de estadía</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="costo_estadia" id="costo_estadia" value="{{ $data->costo_estadia }}"/>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Costo km extraordinario</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="costo_km" id="costo_km" value="{{ $data->costo_km }}"/>
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
                                        <table class="table table-hover mb-6 table-responsive-sm" id="tblDocumentos">
                                            <thead>
                                            <tr>
                                                <th scope="col">Nombre contacto</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Telefono</th>
                                                <th scope="col">Opción</th>
                                            </tr>
                                            </thead>
                                            <tbody id='tbodyDocumentos'>
                                                @foreach($cliente_operativo as $documento)
                                                    <tr id="trDocumento{{ $documento->id }}">
                                                        <td>{{ $documento->nombre_operativo }}</td>
                                                        <td>{{ $documento->email_operativo }}</td>
                                                        <td>{{ $documento->telefono_operativo }}</td>
                                                        <td>
                                                            <a href='#' class='btn btn-clean btn-icon btn-outline-success mt-1 hrefEliminarDocumento' data-id='{{ $documento->id }}' data-documento='{{ $documento->nombre_operativo }}'  data-toggle='tooltip' data-theme='dark' title='Eliminar'>
                                                                <i class='flaticon-delete'></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

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
                                        <table class="table table-hover mb-6 table-responsive-sm" id="tblDocumentos1">
                                            <thead>
                                            <tr>
                                                <th scope="col">Nombre contacto</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Telefono</th>
                                                <th scope="col">Opción</th>
                                            </tr>
                                            </thead>
                                            <tbody id='tbodyDocumentos1'>
                                                @foreach($cliente_fac as $documento)
                                                    <tr id="trDocumento{{ $documento->id }}">
                                                        <td>{{ $documento->nombre_contacto }}</td>
                                                        <td>{{ $documento->email_contacto }}</td>
                                                        <td>{{ $documento->telefono_contacto }}</td>
                                                        <td>
                                                            <a href='#' class='btn btn-clean btn-icon btn-outline-success mt-1 hrefEliminarDocumento1' data-id='{{ $documento->id }}' data-documento='{{ $documento->nombre_operativo }}'  data-toggle='tooltip' data-theme='dark' title='Eliminar'>
                                                                <i class='flaticon-delete'></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

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