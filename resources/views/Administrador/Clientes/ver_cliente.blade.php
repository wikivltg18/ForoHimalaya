
{{-- Vista de detalle de un cliente --}}
@extends('Administrador.layout_admin')


@section('template-blank-admin')

{{-- Estilos personalizados para los botones --}}
@push('CSS')
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


{{-- Botón para crear un nuevo tablero asociado al cliente --}}
@section('button-press')
    <a href="" class="btn btn-primary">Crear tablero</a>
@endsection


<div class="container-fluid">
    <div class="row">
        <!-- Se eliminaron tarjetas relacionadas a servicios y contratos -->
    </div>
</div>


@endsection

