
{{--
    Vista: usuarios.blade.php
    Descripción: Listado de usuarios del equipo colaborador. Permite registrar, editar y visualizar usuarios, mostrando información relevante en una tabla dinámica con DataTables.
    Incluye estilos personalizados, modales de éxito y scripts para la gestión de usuarios.
--}}
@extends('Colaborador.layout_colaborador')

@section('template-blank-development')
@push('CSS')
    {{-- Hojas de estilo y estilos personalizados para la tabla de usuarios --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/core.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/icon-font.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('vendors/styles/style.css') }}">
    <style>
        .btn-secondary {
            background-color: #15baee !important;
            border-color: #15baee !important;
        }
        .btn-secondary:hover {
            background-color: #15baee !important;
        }
        .color-header-table {
            background-color: #004EA4 !important;
            color: #fff !important;
        }
        .dw {
            color: white !important;
        }
        .table-plus::before {
            color: #ffff !important;
            font-size: medium !important;
        }
        .table-plus::after {
            color: #ffff !important;
            font-size: medium !important;
        }
    </style>
@endpush

@section('button-press')
    {{-- Botón para registrar un nuevo usuario --}}
    <a href="{{ url('createUser') }}" class="btn btn-secondary"><i class="icon-copy fa fa-plus" aria-hidden="true"></i>
        Registrar nuevo usuario</a>
@endsection


{{-- Modal de éxito al crear usuario --}}
@if (session('userSuccess'))
<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="text-center modal-body font-18">
                <h3 class="mb-20">{{ session('userSuccess') }}</h3>
                <div class="text-center mb-30">
                    <img src="{{ asset('vendors/images/success.png') }}" alt="Éxito">
                </div>
                <p class="text-center">El usuario se ha creado exitosamente en el sistema. Ahora puedes
                    asignarle un rol o gestionarlo desde el módulo de configuración. ¡Gracias por usar nuestra
                    plataforma!
                </p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>
@endif


{{-- Modal de éxito al actualizar usuario --}}
@if (session('updateSuccess'))
    <script>
        $(document).ready(function() {
            @if ('updateSuccess')
                $('#update-success-modal').modal('show');
            @endif
        });
    </script>
    <div class="modal fade" id="update-success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="text-center modal-body font-18">
                    <h3 class="mb-20">{{ session('updateSuccess') }}</h3>
                    <div class="text-center mb-30">
                        <img src="{{ asset('vendors/images/success.png') }}" alt="Éxito">
                    </div>
                    <p class="text-center">El usuario se ha actualizado exitosamente en el sistema. Puedes verificar los
                        cambios realizados o gestionarlo desde el módulo de configuración. ¡Gracias por usar nuestra
                        plataforma!</p>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
@endif


{{-- Tabla dinámica de usuarios con DataTables --}}
<div class="pb-20">
    <table class="table data-table-usuario stripe hover">
        <thead>
            <tr class="color-header-table">
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Cargo</th>
                <th>Teléfono</th>
                <th>Número de referencia</th>
                <th>Rol</th>
                <th>Area</th>
                <th>Estado</th>
                <th>Edicion</th>
            </tr>
        </thead>
        <tbody>
            {{--
                Las filas se llenan dinámicamente mediante AJAX con DataTables.
                Código comentado de ejemplo para renderizado manual:
                @foreach ($usuarios as $usuario)
                ...
                @endforeach
            --}}
        </tbody>
    </table>
</div>
</div>
@push('JS')
    {{-- Script para inicializar DataTables y gestionar la tabla de usuarios --}}
    <script>
        $(document).ready(function(){
            $('.data-table-usuario').DataTable({
                ajax: "{{ route('api.user') }}",
                columns: [
                    {data: 'nombre'},
                    {data: 'apellido'},
                    {data: 'email'},
                    {data: 'cargo'},
                    {data: 'telefono'},
                    {data: 'numero_referencia'},
                    {data: 'roles.nombre'},
                    {data: 'areas.nombre'},
                    {data: 'estados', render: function(data) {
                            return data
                                ? '<span class="badge badge-success rounded-pill">Activo</span>'
                                : '<span class="badge badge-danger rounded-pill">Inactivo</span>';
                        }
                    },
                    {data: 'id', render: function(data){
                        return `<a href="/editUser/${data}" class="text-white btn btn-primary col-12 rounded-pill"><i class="dw dw-edit2"></i></a>`;
                    }
                }
                ],
                responsive: true,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json"
                }
            })
        });
    </script>
    {{-- Script para mostrar modal de éxito al actualizar usuario --}}
    <script>
        $(document).ready(function() {
            @if ('updateSuccess')
                $('#update-success-modal').modal('show');
            @endif
        });
    </script>
    {{-- Scripts de DataTables --}}
    <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    {{-- Script para mostrar modal de éxito al crear usuario --}}
    <script>
        $(document).ready(function() {
            $('#success-modal').modal('show');
        });
    </script>
@endpush
@endsection
