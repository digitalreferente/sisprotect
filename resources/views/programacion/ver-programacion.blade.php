@extends('layouts.app')
@push('scripts')
	<script src="{{ asset('js/programacion/EditarProgramacion.js') }}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
@endpush
@section('title')
    Programacion
@endsection
@section('content')

<style type="text/css">
    .oculto{
        display: none;
    }
</style>
    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-header">
                    <h3 class="card-title">Programación </h3>
                    <div class="card-toolbar">
                        <span style="font-size: 15px; font-weight: bold; color:red;">Estatus: {{ $programacion->programacionEstatus->estatus_programacion }}</span>
                    </div>
                </div>

                <input type="hidden" id="documentoEliminarPath" value="{{ route('programacion.eliminarcustodioprogramacion') }}">
                <!--begin::Form-->
{{--                 <form action="{{ route('programacion.modificarprogramacion') }}" method="post" id="submit_programacion" enctype="multipart/form-data">
                    @csrf --}}

                    <input type='hidden' id='url_tarifario' value='{{ route('programacion.obtenertarifas') }}'>
                    <input type='hidden' id='tipoArchivo' value='{{ $cadenaTipoDocumento }}'>
                    <input type="hidden" name="id_programacion" value="{{ $id_programacion }}">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-lg-12">
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Cliente</label>
                                            @foreach($cliente as $tp)
                                                @if($programacion->cliente_id == $tp->id)
                                                    <p>{{ $tp->nombre_cliente }} / {{ $tp->razon_social }}</p>
                                                @endif
                                            @endforeach

                                    </div>
                                    <div class="col-lg-6">
                                        <label>Fecha y hora de servicio</label>
                                        <div class="input-group">
                                            <p> {{ date('d/m/Y H:i:s', strtotime($programacion->fecha_servicio))}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Tipo de servicio</label>
                                        @if($programacion->tipo_servicio == 0)
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input type="radio" {{($programacion->tipo_servicio == 0) ? 'checked' : ''}} name="tipo_servicio" value="0" />
                                                    <span></span>
                                                    Foraneo
                                                </label>
                                            </div>
                                        @else
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input type="radio" {{($programacion->tipo_servicio == 1) ? 'checked' : ''}} name="tipo_servicio" value="1" />
                                                    <span></span>
                                                    Local
                                                </label>
                                            </div>
                                        @endif

                                    </div>


                                    <div class="col-lg-6">
                                        <label>Tarifario.</label>
                                            @foreach($tarifario as $tp)
                                                @if($programacion->tarifario_id == $tp->id)
                                                    <p>Origen: {{ $tp->origen }} - Destino: {{ $tp->destino }}</p>
                                                @endif
                                            @endforeach
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Domicilio origen</label>
                                        <div class="input-group">
                                            <p>{{ $programacion->dom_origen }}</p>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Domicilio destino </label>
                                        <div class="input-group">
                                            <p>{{ $programacion->dom_destino }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-6">
                                        <label>Custodio</label>
                                            @foreach($custodio as $tp)
                                                @if($programacion->custodio_id == $tp->id)
                                                    <p>{{ $tp->nombre_custodio }} {{ $tp->ap_paterno }} {{ $tp->ap_materno }}</p>
                                                @endif
                                            @endforeach
                                    </div>

                                    <div class="col-lg-6">
                                        <label>Acompañantes</label>
                                        @if($programacion->acompanantes == 0)
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input type="radio" {{($programacion->acompanantes == 0) ? 'checked' : ''}} name="op_custodios" id="op_c_uno" value="0" />
                                                    <span></span>
                                                    Si
                                                </label>
                                            </div>
                                        @else
                                            <div class="radio-inline">
                                                <label class="radio">
                                                    <input type="radio" {{($programacion->acompanantes == 1) ? 'checked' : ''}} name="op_custodios" id="op_c_dos" value="1" />
                                                    <span></span>
                                                    No
                                                </label>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                                <div class="card card-custom gutter-b {{($programacion->acompanantes == 1) ? 'oculto' : ''}}" id="div_custodios" style="background-color:  #f1f1f1;"  >
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">
                                                Acompañantes
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row form-group" >
                                            <div class="col-lg-12" id="tblArchivos">
                                                <table class='table table-bordered table-hover' id='tblDocumentos'>
                                                    <thead>
                                                    <tr>
                                                        <th>Custodio</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody id='tbodyDocumentos'>
                                                        @foreach($acompanantes_pro as $documento)
                                                            <tr id="trDocumento{{ $documento->id }}">
                                                                <td>{{ $documento->custodio->nombre_custodio}} {{ $documento->custodio->ap_paterno}} {{ $documento->custodio->ap_materno}}</td>

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
                                       <p> {{ $programacion->observaciones }}</p>
                                    </div>
                                </div>
                            </div>

                        </div>





                    </div>
                    <div class="card-footer">
                        <div class="row">
                            <div class="col-lg-6">
                                {{-- <button type="button"  id="btnGuardar" class="btn btn-primary mr-2">Guardar</button> --}}
                                <a href="{{ route('programacion.listadoprogramacion') }}"  class="btn btn-secondary">Regresar</a>
                            </div>
                        </div>
                    </div>
                {{-- </form> --}}
                <!--end::Form-->
            </div>
            <!--end::Card-->
        </div>
    </div>
    <!--end::Card-->



@endsection