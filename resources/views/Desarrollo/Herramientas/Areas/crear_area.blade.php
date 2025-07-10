
{{--
    Vista: crear_area.blade.php
    Ubicación: resources/views/Desarrollo/Herramientas/Areas/
    Descripción: Formulario para crear una nueva área en el sistema.
    Incluye validaciones, estilos personalizados y comentarios para facilitar el mantenimiento.
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


<!-- Contenedor principal del formulario de creación de área -->
<div class="row">
    <div class="col-md-6">
        <div class="row">
            <!-- Formulario para crear una nueva área -->
            <div class="col-md-6">
                <form action="{{ route('store.area') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="area1">Nombre del área <span class="text-danger">*</span></label>
                        <input type="text" id="area1" class="form-control @error('ar-nombre')  form-control-warning  @enderror" name="ar-nombre" required value="{{ old('ar-nombre') }}">
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
                        <input type="text" id="area2" class="form-control @error('ar-nombre')  form-control-warning  @enderror" name="ar-descripcion" value="{{old('ar-descripcion')}}">
                        <small class="text-muted ">
                            @error('ar-descripcion')
                                <small class="text-warning"> {{ $message }} </small>
                            @else
                                <small class="text-muted">Eje: Marketing Digital, Seguridad web</small>
                            @enderror
                        </small>
                    </div>
                </div>
                <!-- Botón de envío del formulario -->
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary col-12 ">Guardar nuevo area</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Columna de imagen/logo -->
    <div class="col-md-6">
        <div class="p-5 text-center"  style="background-color: #004EA4; ">
            <img src="{{ asset('vendors/images/Logo_Himalaya_blanco-10.png') }}" alt="logo_himalaya">
        </div>
    </div>
</div>

@endsection

@endsection

