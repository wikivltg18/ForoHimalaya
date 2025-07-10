
{{--
    Vista: roles_create.blade.php
    Ubicación: resources/views/Desarrollo/Herramientas/Roles/
    Descripción: Formulario para crear un nuevo rol en el sistema.
    Incluye validaciones, estilos personalizados y scripts para la vista.
    Comentarios agregados para documentar la estructura y funcionalidad de cada bloque.
--}}

@extends('Desarrollo.layout_desarrollo') {{-- Hereda la plantilla base del módulo Desarrollo --}}


@section('template-blank-development') {{-- Sección principal de contenido --}}


@section('button-press')
    {{-- Botón para regresar al listado de roles --}}
    <a href="{{ url('superadmin/roles') }}" class="btn btn-primary">Listado de roles</a>
@endsection


@push('CSS')
    <!-- Estilos y plugins para DataTables y botones principales -->
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
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



<!-- Contenedor principal del formulario de creación de rol -->
<div class="container-fluid">
    <div class="row">
        <!-- Columna del formulario -->
        <div class="col-md-6">
            <div class="row">
                <!-- Formulario para crear un nuevo rol -->
                <div class="col-md-6">
                    <form action="{{ route('Roles.store') }}" method="POST">
                         @csrf
                        <div class="form-group">
                            <label for="">Nombre del rol <span class="text-danger">*</span></label>
                            <input type="text" name="nm-lo" class="form-control @error('nm-lo') form-control-warning @enderror" required value="{{ old('nm-lo') }}">
                            @error('nm-lo')
                                <small class="text-warning"">{{ $message }} </small>
                            @else
                                <small class="text-muted">Eje: Contador, Colaborador, Project Manager  </small>
                            @enderror
                        </div>
                </div>
                <!-- Campo: Descripción del rol -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Descripción <span class="text-danger">*</span></label>
                        <input type="text" name="dc-ion" class="form-control @error('dc-ion') form-control-warning @enderror" value="{{ old('dc-ion') }}">
                        @error('dc-ion')
                            <small class="text-warning">{{ $message }} </small>
                        @else
                            <small class="text-muted ">Funcionamiento del rol. </small>
                        @enderror
                    </div>
                </div>
                <!-- Botón de envío del formulario -->
                <div class="col-md-12">
                    <input type="submit" class="btn btn-primary col-12 btn-lg" value="Añadir rol nuevo">
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
    <script src="{{ asset('vendors/scripts/core.js')}}"></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
@endpush

@endsection
@endsection
