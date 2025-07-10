
{{--
    Vista: roles_update.blade.php
    Ubicación: resources/views/Desarrollo/Herramientas/Roles/
    Descripción: Formulario para actualizar un rol existente.
    Incluye validaciones, mensajes de advertencia y estilos personalizados.
    Comentarios agregados para documentar la estructura y funcionalidad de cada bloque.
--}}

@extends('Desarrollo.layout_desarrollo') {{-- Hereda la plantilla base del módulo Desarrollo --}}


@section('template-blank-development') {{-- Sección principal de contenido --}}


@section('button-press')
    {{-- Botón para regresar al listado de roles --}}
    <a href="{{ url('forumRoles') }}" class="btn btn-primary">Listado roles</a>
@endsection


@push('CSS')
    <!-- Estilos y plugins para DataTables y botones principales -->
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <style>
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


@if(session('warningUpdateRole'))
    <!-- Modal de advertencia si no se detectan cambios al actualizar el rol -->
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


<!-- Contenedor principal del formulario de actualización de rol -->
<div class="container-fluid">
    <div class="row">
        <!-- Columna del formulario -->
        <div class="col-md-6">
            <div class="row">
                <!-- Formulario de actualización de rol -->
                <div class="col-md-6">
                    <form action="{{ route('update.roles', $role->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Nombre <span class="text-danger">*</span></label>
                            <input type="text" name="nm-lou" class="form-control @error('nm-lou') form-control-warning @enderror" required value="{{ $role->nombre ?? '¡El nombre existe!' }}">
                            @error('nm-lou')
                                <small class="text-warning">{{ $message }} </small>
                            @else
                                <small class="text-muted">Eje: Contador, Colaborador, Project Manager</small>
                            @enderror
                        </div>
                </div>
                <!-- Campo: Descripción del rol -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Descripción</label>
                        <input type="text" name="dc-ionu" class="form-control @error('dc-ionu') form-control-warning @enderror" value="{{ $role->descripcion ?? 'Agregue descripcion' }}">
                        @error('dc-ionu')
                            <small class="text-warning">{{ $message }} </small>
                        @else
                            <small class="text-muted">Funcionamiento del rol.</small>
                        @enderror
                    </div>
                </div>
                <!-- Botón de envío del formulario -->
                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary col-12 btn-lg" value="Actualizar rol">
                </div>
                </form>
            </div>
        </div>
        <!-- Columna de imagen/logo -->
        <div class="col-md-6" style="background-color: #004EA4;">
            <div class="p-5 text-center">
                <img src="{{ asset('vendors/images/Logo_Himalaya_blanco-10.png') }}" alt="logo_himalaya">
            </div>
        </div>
    </div>
</div>


@push('JS')
    <!-- Scripts principales para la funcionalidad de la vista -->
    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
    <script src="{{ asset('vendors/scripts/process.js') }}"></script>
    <script src="{{ asset('vendors/scripts/layout-settings.js') }}"></script>
    <script>
        // Mostrar modal de advertencia si existe mensaje en sesión
        $(document).ready(function() {
            @if (session('warningUpdateRole'))
                $('#warning-modal-update').modal('show');
            @endif
        });
    </script>
@endpush

@endsection

@endsection
