
{{--
    Vista: roles.blade.php
    Ubicación: resources/views/Desarrollo/Herramientas/Roles/
    Descripción: Listado y gestión de roles del sistema.
    Incluye DataTable dinámico, modal de éxito y botón para crear nuevos roles.
    Comentarios agregados para documentar la estructura y funcionalidad de cada bloque.
--}}

@extends('Desarrollo.layout_desarrollo') {{-- Hereda la plantilla base del módulo Desarrollo --}}


@section('template-blank-development') {{-- Sección principal de contenido --}}

    @push('CSS')
        <!-- Estilos y plugins para DataTables -->
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


    @section('button-press')
        {{-- Botón para crear un nuevo rol --}}
        <a href="{{ url('superadmin/createRoles') }}" class="btn btn-primary">Crear rol</a>
    @endsection


    {{-- Nota: ELIMINAR ROLES -> DIRECTOR EJECUTIVO, CUENTAS, CLIENTES --}}


    @if (session('successRoleUpdate'))
        <!-- Modal de éxito al crear o actualizar un rol -->
        <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="text-center modal-body font-18">
                        <h3 class="mb-20">{{ session('successRoleUpdate') }}</h3>
                        <div class="text-center mb-30">
                            <img src="{{ asset('vendors/images/success.png') }}" alt="Éxito">
                        </div>
                        <p>El rol se ha creado exitosamente en el sistema. Ahora puedes asignarlo a los usuarios
                            correspondientes o gestionarlo desde el módulo de configuración. ¡Gracias por usar nuestra
                            plataforma!</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- Tabla dinámica de roles (DataTable) -->
    <table id="data-table-roles" class="table stripe hover nowrap">
        <thead class="text-center">
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <!-- DataTables llenará esto -->
        </tbody>
    </table>


    @push('JS')
        <!-- Scripts y plugins para DataTables y funcionalidad de la tabla -->
        <script src="{{ asset('vendors/scripts/core.js') }}"></script>
        <script src="{{ asset('vendors/scripts/script.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>

        <script>
            // Inicialización de DataTable para la tabla de roles
            $(document).ready(function() {
                $('#data-table-roles').DataTable({
                    ajax: {
                        url: '{{ route('api.roles') }}', // Ruta API para obtener los roles
                        type: 'GET',
                    },
                    columns: [
                        {
                            data: 'nombre' // Nombre del rol
                        },
                        {
                            data: 'descripcion', // Descripción del rol
                            render: function(data) {
                                return data ?? 'Descripcion no asignada.'
                            }
                        },
                        {
                            data: 'estado', // Estado del rol
                            render: function(data) {
                                return data == 1 ?
                                    '<span class="badge badge-success">Rol Disponible </span>' :
                                    '<span class="badge badge-danger"> Rol Inactivo </span>';
                            }
                        },
                        {
                            data: null, // Acciones (editar)
                            orderable: false,
                            render: function(data) {
                                var baseUrl = "{{ url('superadmin/editRoles') }}";
                                return `<a href="${baseUrl}/${data.id}" class="btn btn-primary">Editar rol</a>`;
                            }
                        },
                    ]
                });
            });
        </script>
        <script>
            // Mostrar modal de éxito si existe mensaje en sesión
            $(document).ready(function() {
                @if (session('successRoleUpdate'))
                    $('#success-modal').modal('show');
                @endif
            });
        </script>
        <script src="{{ asset('src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/pdfmake.min.js') }}"></script>
        <script src="{{ asset('src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    @endpush

@endsection
@endsection
