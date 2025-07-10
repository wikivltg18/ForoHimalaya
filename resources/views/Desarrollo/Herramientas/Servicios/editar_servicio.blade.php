
{{--
    Vista: editar_servicio.blade.php
    Ubicación: resources/views/Desarrollo/Herramientas/Servicios/
    Descripción: Formulario para editar un servicio existente.
    Incluye validaciones, mensajes de advertencia, estilos personalizados y scripts para componentes avanzados.
    Comentarios agregados para documentar la estructura y funcionalidad de cada bloque.
--}}

@extends('Desarrollo.layout_desarrollo') {{-- Hereda la plantilla base del módulo Desarrollo --}}


@section('template-blank-development') {{-- Sección principal de contenido --}}
    @push('CSS')
        <!-- Estilos y plugins para componentes avanzados del formulario -->
        <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/switchery/switchery.min.css') }}">
        <!-- bootstrap-tagsinput css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.css')}}">
        <!-- bootstrap-touchspin css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">
        <style>
            /* Estilos personalizados para el botón principal */
            .btn-primary {
                background-color: #15baee !important;
                border-color: #15baee !important;
                color: white !important;
                font-weight: bolder !important;
            }
            .btn-primary:hover {
                background-color: #004EA4 !important;
                border-color: #004EA4 !important;
            }
        </style>
    @endpush

    @section('button-press')
        {{-- Botón para regresar al listado de servicios --}}
        <a href="{{ url('superadmin/servicios')}}" class="btn btn-primary"> Listado de servicios </a>
    @endsection

    @if(session('warningServicio'))
        <!-- Modal de advertencia si no se detectan cambios al actualizar el servicio -->
        <div class="modal fade" id="warning-modal-update" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm modal-dialog-centered">
                <div class="modal-content bg-warning">
                    <div class="text-center modal-body">
                        <h3 class="mb-15"><i class="fa fa-exclamation-triangle"></i> Advertencia</h3>
                        <p class="text-center">
                            No se detectaron modificaciones.
                        </p>
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Ok</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <!-- Columna del formulario de edición -->
        <div class="col-md-6">
            <!-- Formulario para editar el servicio -->
            <form action="{{ route('actualizar.servicio', $servicio->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <!-- Campo: Nombre del servicio -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Nombre del servicio <span class="text-danger">*</span></label>
                            <input type="text" name="sr-nombre" class="form-control @error('sr-nombre') form-control-warning @enderror " required value="{{ $servicio->nombre }}">
                            @error('sr-nombre')
                                <small class="text-warning">{{ $message }} </small>
                            @else
                                <small>Eje: Publicidad Digital, Desarrollo Móvil, Base de Datos.</small>
                            @enderror
                        </div>
                    </div>
                    <!-- Campo: Descripción del servicio -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="">Descripcion</label>
                            <input type="text" name="sr-descripcion"
                                class="form-control @error('sr-descripcion') form-control-warning @enderror " value="{{ $servicio->descripcion }}">
                            @error('sr-descripcion')
                                <small class="text-warning">{{ $message }} </small>
                            @else
                                <small>Eje: Publicidad Digital, Desarrollo Móvil, Base de Datos.</small>
                            @enderror
                        </div>
                    </div>
                    {{--
                    <!-- Campo: Fases del servicio (ejemplo, actualmente comentado) -->
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Fases del servicio <span class="text-danger">*</span></label>
                            <input type="text" value="Amsterdam,Washington,Sydney,Beijing" name="" data-role="tagsinput">
                            <small class="text-muted">Servicios de ejemplo, eliminarlos cuando este en proceso de creación dando click en "X". </small>
                        </div>
                    </div>
                    --}}
                    <!-- Botón de envío del formulario -->
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-primary col-12" value="Actualizar servicio">
                    </div>
                </div>
            </form>
        </div>
        <!-- Columna de imagen/logo -->
        <div class="col-md-6" style="background-color: #004EA4;">
            <div class="p-5 text-center">
                <img src="{{ asset('vendors/images/Logo_Himalaya_blanco-10.png') }}" alt="logo_himalaya">
            </div>
        </div>
    </div>

    @push('JS')
        <!-- Scripts y plugins para componentes avanzados y validaciones -->
        <script src="{{ asset('vendors/scripts/core.js') }}"></script>
        <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
        <script>
            // Mostrar modal de advertencia si existe mensaje en sesión
            $(document).ready(function(){
                @if(session('warningServicio'))
                    $('#warning-modal-update').modal('show');
                @endif
            });
        </script>
        <script src="{{ asset('src/plugins/switchery/switchery.min.js') }}"></script>
        <!-- bootstrap-tagsinput js -->
        <script src="{{ asset('src/plugins/bootstrap-tagsinput/bootstrap-tagsinput.js') }}"></script>
        <!-- bootstrap-touchspin js -->
        <script src=" {{ asset('src/plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
        <script src="{{ asset('vendors/scripts/advanced-components.js') }}"></script>
    @endpush

@endsection
