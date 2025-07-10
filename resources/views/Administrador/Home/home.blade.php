
{{--
    Vista: home.blade.php
    Descripción: Página principal del panel de administración. Incluye la carga de estilos y scripts globales.
    No contiene contenido visual propio, solo la estructura base y dependencias.
--}}
@extends('Administrador.layout_admin')

@section('template-blank-admin')

    {{-- Inclusión de estilos globales para el panel de administración --}}
    @push('CSS')
        <link rel="stylesheet" type="text/css" href="{{ url('vendors/styles/core.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ url('vendors/styles/icon-font.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ url('vendors/styles/style.css')}}">
    @endpush

    {{-- Inclusión de scripts globales para el panel de administración --}}
    @push('JS')
        <script src="{{ url('vendors/scripts/core.js')  }}"></script>
        <script src="{{ url('vendors/scripts/script.min.js') }}"></script>
        <script src="{{ url('vendors/scripts/process.js') }}"></script>
        <script src="{{ url('vendors/scripts/layout-settings.js') }}"></script>
    @endpush

    {{-- Esta vista no contiene contenido visual propio, solo estructura base y dependencias --}}

@endsection
