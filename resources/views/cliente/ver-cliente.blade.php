@extends('layouts.app')
@push('scripts')
	<script src="{{ asset('js/cliente/EditarCliente.js') }}"></script>
@endpush
@section('title')
    Ver cliente
@endsection
@section('content')

    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title"> Cliente</h3>
                </div>

                <input type="hidden" id="documentoEliminarOperativo" value="{{ route('cliente.eliminarcontactooperativo') }}">
                <input type="hidden" id="documentoEliminarFacturacion" value="{{ route('cliente.eliminarcontactofacturacion') }}">
                <!--begin::Form-->

                    <div class="card-body">
                        <input type="hidden" name="cliente_id" value="{{ $data->id }}">
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Razón social</label>
                                <div class="input-group">
                                    <p>{{ $data->razon_social }}</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <label>Nombre comercial/ Cliente</label>
                                <div class="input-group">
                                    <p>{{ $data->nombre_cliente }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-lg-6">
                                <label>Grupo</label>
                                <div class="input-group">
                                    <p>{{ $data->grupo }}</p>
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
                                            <p>{{ $data->dias_credito }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Costo de estadía</label>
                                        <div class="input-group">
                                            <p>{{ $data->costo_estadia }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <label>Costo km extraordinario</label>
                                        <div class="input-group">
                                            <p>{{ $data->costo_km }}</p>
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
                                            </tr>
                                            </thead>
                                            <tbody id='tbodyDocumentos'>
                                                @foreach($cliente_operativo as $documento)
                                                    <tr id="trDocumento{{ $documento->id }}">
                                                        <td>{{ $documento->nombre_operativo }}</td>
                                                        <td>{{ $documento->email_operativo }}</td>
                                                        <td>{{ $documento->telefono_operativo }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>



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
                                            </tr>
                                            </thead>
                                            <tbody id='tbodyDocumentos1'>
                                                @foreach($cliente_fac as $documento)
                                                    <tr id="trDocumento{{ $documento->id }}">
                                                        <td>{{ $documento->nombre_contacto }}</td>
                                                        <td>{{ $documento->email_contacto }}</td>
                                                        <td>{{ $documento->telefono_contacto }}</td>

                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <div class="col-lg-12">
                                <label for="observaciones">Observaciones</label>
                                <p><p>{{ $data->observaciones }}</p></p>
                            </div>
                        </div>


                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                <a href="{{ route('cliente.listadocliente') }}"  class="btn btn-secondary">Regresar</a>
                            </div>
                        </div>
                    </div>

                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Card-->



@endsection