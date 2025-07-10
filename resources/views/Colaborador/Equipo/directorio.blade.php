
{{--
    Vista: directorio.blade.php
    Descripción: Muestra el directorio de usuarios y áreas para el colaborador. Permite filtrar usuarios por nombre y área, crear nuevos usuarios o áreas, y visualizar información de cada usuario.
    Incluye paginación, búsqueda AJAX y estilos personalizados.
--}}
@extends('Colaborador.layout_colaborador')

@section('template-blank-development')


@section('button-press')
    {{-- Botones para crear usuario y crear área --}}
    <a href="" class="rounded btn btn-primary btn-lg">Crear usuario<i class="ml-2 fa fa-plus"></i></a>
    <a href="" class="rounded btn btn-primary btn-lg">Crear Area<i class="ml-2 fa fa-plus"></i></a>
@endsection

@push('CSS')
    {{-- Estilos personalizados para el directorio de usuarios y áreas --}}
    <style>
        .general-container {
            background-color: transparent !important;
            box-shadow: none !important;
            padding: -0px !important;
        }
        .pagination {
            margin-top: 24px;
            justify-content: center;
        }
        .contact-directory-box {
            border-radius: 0px !important;
        }
    </style>
@endpush


{{-- Filtros de búsqueda por usuario y área --}}
<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label for=""><span class="text-danger">* </span>Usuarios</label>
            <input type="search" id="searchUser" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <label for=""><span class="text-danger">* </span>Areas</label>
        <form action="{{ route('Directorio') }}" method="POST">
            @csrf
            <select name="areasFilter" class="form-control" onchange="this.form.submit()">
                <option value="">-- Selecciona un Área --</option>
                @foreach ($areas as $area)
                    <option value="{{ $area->id }}" {{ request('areasFilter') == $area->id ? 'selected' : '' }}>
                        {{ $area->nombre }}
                    </option>
                @endforeach
            </select>
        </form>
    </div>
</div>


{{-- Listado de usuarios en el directorio --}}
<div class="row">
    @foreach ($usuarios as $usuario )
        <div class="mt-4 col-md-4">
            <div class="contact-directory-box">
                <div class="text-center contact-dire-info">
                    {{-- Imagen de perfil del usuario --}}
                    <div class="contact-avatar">
                        <span>
                            @if ($usuario->img_perfil)
                                <img src="{{Storage::url('usuarios/'. $usuario->img_perfil)}}" alt="Imagen de perfil">
                            @else
                                <img src="{{ asset('vendors/images/default.jpg') }}" >
                            @endif
                        </span>
                    </div>
                    {{-- Nombre, apellido y cargo --}}
                    <div class="contact-name">
                        <h4>{{ $usuario->nombre }} <br> {{ $usuario->apellido }}</h4>
                        <p>{{ $usuario->cargo }}</p>
                        <div class="work text-success"><i class="ion-android-person"></i> {{ $usuario->areas->nombre }}</div>
                    </div>
                    {{-- Habilidades del usuario --}}
                    <div class="contact-skill">
                        <span class="badge badge-pill">
                            {!! $usuario->habilidades ?? '<span class="badge badge-pill">Falta por agregar</span>' !!}
                        </span>
                    </div>
                    {{-- Descripción del perfil --}}
                    <div class="profile-sort-desc">
                        {{ $usuario->descripcion ?? "Información faltante en el perfil." }}
                    </div>
                </div>
                {{-- Enlace para ver perfil completo --}}
                <div class="view-contact">
                    <a href="#">Ver perfil</a>
                </div>
            </div>
        </div>
    @endforeach
</div>


{{-- Paginación del listado de usuarios --}}
<div class="text-center">
    {{ $usuarios->links('pagination::bootstrap-4') }}
</div>

@push('JS')
    {{-- Script para búsqueda dinámica de usuarios mediante AJAX --}}
    <script>
        $(document).ready(function() {
            $('#searchUser').on('keyup', function() {
                var query = $(this).val();
                $.ajax({
                    url: "{{ route('Directorio') }}",
                    type: "GET",
                    data: { query: query },
                    success: function(response) {
                        $('.row').html(response.html);
                    },
                    error: function(xhr) {
                        console.log('Error en la búsqueda:', xhr.responseText);
                    }
                });
            });
        });
    </script>
@endpush
@endsection
