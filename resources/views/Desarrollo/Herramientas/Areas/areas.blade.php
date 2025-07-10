
{{--
    Vista: areas.blade.php
    Ubicación: resources/views/Desarrollo/Herramientas/Areas/
    Descripción: Listado y gestión de áreas del sistema.
    Incluye DataTable dinámico, modales de éxito y botón para crear nuevas áreas.
    Comentarios agregados para documentar la estructura y funcionalidad de cada bloque.
--}}

@extends('Desarrollo.layout_desarrollo') {{-- Hereda la plantilla base del módulo Desarrollo --}}


@section('template-blank-development') {{-- Sección principal de contenido --}}

    @push('CSS')
        <!-- Estilos y plugins para DataTables y botones principales -->
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
    {{-- Botón para crear una nueva área --}}
    <a href="{{ url('superadmin/createArea') }}" class="btn btn-primary">Crear área</a>
@endsection


    @if (session('successArea'))
        <!-- Modal de éxito al crear un área -->
        <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="text-center modal-body font-18">
                        <h3 class="mb-20">{{ session('successArea') }}</h3>
                        <div class="text-center mb-30">
                            <img src="{{ asset('vendors/images/success.png') }}" alt="Éxito">
                        </div>
                        <p class="text-center">
                            El área se ha creado exitosamente en el sistema. Ahora puedes asignarle funciones o gestionarla
                            desde el módulo de configuración. ¡Gracias por usar nuestra plataforma!
                        <p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('successUpdateArea'))
        <!-- Modal de éxito al actualizar un área -->
        <div class="modal fade" id="success-modal-update" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="text-center modal-body font-18">
                        <h3 class="mb-20">{{ session('successUpdateArea') }}</h3>
                        <div class="text-center mb-30">
                            <img src="{{ asset('vendors/images/success.png') }}" alt="Éxito">
                        </div>
                        <p class="text-center">
                            El área se ha actualizado exitosamente en el sistema. Ahora puedes asignarle funciones o
                            gestionarla desde el módulo de configuración. ¡Gracias por usar nuestra plataforma!
                        <p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
    @endif


    <!-- Tabla dinámica de áreas (DataTable) -->
    <table id="data-table-roles" class="table stripe hover nowrap">
        <thead class="text-center">
            <tr>
                <th>Nombre</th>
                <th>Horas consumidas</th>
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
        // Inicialización de DataTable para la tabla de áreas
        $(document).ready(function() {
            $('#data-table-roles').DataTable({
                ajax: {
                    url: '{{ route('areas.date') }}', // Ruta API para obtener las áreas
                    type: 'GET',
                },
                columns: [
                    {
                        data: 'nombre' // Nombre del área
                    },
                    {
                        data: 'horas_consumidas', // Horas consumidas
                        render: function(data) {
                            return data ?? 'Sin horas registradas.';
                        }
                    },
                    {
                        data: 'descripcion', // Descripción del área
                        render: function(data) {
                            return data ?? 'Descripcion no asignada.'
                        }
                    },
                    {
                        data: 'estado', // Estado del área
                        render: function(data, type, row) {
                            return data == 1 ?
                                '<span class="badge badge-success">Área Disponible </span>' :
                                '<span class="badge badge-danger"> Área Inactiva </span>';
                        }
                    },
                    {
                        data: null, // Acciones (editar)
                        orderable: false,
                        render: function(data) {
                            var baseUrl = "{{ url('superadmin/editarArea') }}";
                            return `<a href="${baseUrl}/${data.id}" class="btn btn-primary">Editar área</a>`;
                        }
                    },
                ]
            });
        });
    </script>
    <script>
        // Mostrar modal de éxito al crear un área si existe mensaje en sesión
        $(document).ready(function() {
            @if (session('successArea'))
                $('#success-modal').modal('show');
            @endif
        });
    </script>
    <script>
        // Mostrar modal de éxito al actualizar un área si existe mensaje en sesión
        $(document).ready(function() {
            @if (session('successUpdateArea'))
                $('#success-modal-update').modal('show');
            @endif
        });
    </script>
    {{-- <script src="{{ asset('src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="src/plugins/datatables/js/pdfmake.min.js"></script>
    <script src="src/plugins/datatables/js/vfs_fonts.js"></script> --}}
@endpush

@endsection

@endsection
