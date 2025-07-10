
{{--
    Vista: editar_area.blade.php
    Ubicación: resources/views/Desarrollo/Herramientas/Areas/
    Descripción: Formulario para editar un área existente.
    Incluye validaciones, mensajes de advertencia, estilos personalizados y scripts para la vista.
    Comentarios agregados para documentar la estructura y funcionalidad de cada bloque.
--}}

@extends('Desarrollo.layout_desarrollo') {{-- Hereda la plantilla base del módulo Desarrollo --}}


@section('template-blank-development') {{-- Sección principal de contenido --}}


@section('button-press')
    {{-- Botón para regresar al listado de áreas --}}
    <a href="{{ url('superadmin/Areas') }}" class="btn btn-primary">Listado de áreas</a>
@endsection


@push('CSS')
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


@if(session('warningUpdateArea'))
    <!-- Modal de advertencia si no se detectan cambios al actualizar el área -->
    <div class="modal fade" id="warning-modal-update" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content bg-warning">
                <div class="text-center modal-body">
                    <h3 class="mb-15"><i class="fa fa-exclamation-triangle"></i> Advertencia</h3>
                    <p class="text-center">
                        No se detectaron modificaciones.
                    <p>
                    <button type="button" class="btn btn-dark" data-dismiss="modal">Ok</button>
                </div>
            </div>
        </div>
    </div>
@endif



<!-- Contenedor principal del formulario de edición de área -->
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <!-- Formulario para editar el área -->
            <div class="col-md-6">
                <form action="{{ route('actualizar.area', ['id' => $area->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="area1">Nombre del área <span class="text-danger">*</span></label>
                        <input type="text" id="area1" class="form-control @error('ar-nombre') form-control-warning @enderror"  name="ar-nombre" required value='{{ $area->nombre }}'>
                        <small class="text-muted ">
                            @error('ar-nombre')
                                <small class="text-warning"> {{ $message }} </small>
                            @else
                                <small class="text-muted">Eje: Marketing Digital, Seguridad web</small>
                            @enderror
                        </small>
                    </div>
                </div>
                <!-- Campo: Descripción del área -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="area2">Descripcion del área <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('ar-description') form-control-warning @enderror" name="ar-descripcion" value='{{ $area->descripcion ?? 'Descripcion no asignada.' }}''>
                        <small class="text-muted">
                            @error('ar-descripcion')
                            <small class="text-warning"> {{ $message }} </small>
                            @else
                            <small class="text-muted">Eje: Funcionamiento del área.</small>
                            @enderror
                        </small>
                    </div>
                </div>
                <!-- Botón de envío del formulario -->
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary col-12 ">Actualizar área</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Columna de imagen/logo -->
    <div class="col-md-6">
        <div class="p-5 text-center"  style="background-color: #004EA4; ">
            <img src="{{ asset('vendors/images/Logo_Himalaya_blanco-10.png') }}" alt="logo_himalaya">
        </div>
    </div>
</div>



@push('JS')
    <!-- Scripts principales para la funcionalidad de la vista -->
    <script src="{{ asset('vendors/scripts/core.js') }}"></script>
    <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
    <script>
        // Mostrar modal de advertencia si existe mensaje en sesión
        $(document).ready(function(){
            @if(session('warningUpdateArea'))
                $('#warning-modal-update').modal('show')
            @endif
        })
    </script>
@endpush

@endsection

@endsection

