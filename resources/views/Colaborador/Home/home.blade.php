
{{--
    Vista: home.blade.php
    Descripción: Página principal del panel de Colaborador.
    Incluye los estilos y scripts base del dashboard.
    Estructura:
      - Extiende la plantilla principal de Colaborador
      - Pila de estilos CSS
      - Pila de scripts JS
--}}

@extends('Colaborador.layout_colaborador')


{{-- Sección principal de contenido (puede ser utilizada para desarrollo o contenido dinámico) --}}
@section('template-blank-development')


    {{-- Pila de estilos CSS necesarios para el dashboard de Colaborador --}}
    @push('CSS')
        <link rel="stylesheet" type="text/css" href="{{ url('vendors/styles/core.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ url('vendors/styles/icon-font.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ url('vendors/styles/style.css')}}">
    @endpush






    {{-- Pila de scripts JS necesarios para la funcionalidad del dashboard --}}
    @push('JS')
        <script src="{{ url('vendors/scripts/core.js')  }}"></script>
        <script src="{{ url('vendors/scripts/script.min.js') }}"></script>
        <script src="{{ url('vendors/scripts/process.js') }}"></script>
        <script src="{{ url('vendors/scripts/layout-settings.js') }}"></script>
    @endpush

{{-- Fin de la sección principal --}}
@endsection
