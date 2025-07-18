
{{-- Vista: foro_traficotareas.blade.php --}}
{{-- Muestra el listado y filtros de tareas de tráfico en el foro administrativo. --}}

@extends('Administrador.layout_admin')

@section('template-blank-admin')
    @push('CSS')
    <link rel="stylesheet" type="text/css" href="{{ url('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <style>
        /* Botón de búsqueda personalizado */
        .button-search {
            background-color: #15BAEE;
            border-color: #15BAEE;
            color: #484444;
            margin-top: 2.0rem;
        }

        /* Línea vertical divisoria entre filtros */
        .vertical-line {
            width: 1px;
            height: 100px;
            background-color: #ccc;
            margin: 0 20px;
        }

        /* Estilos para agrandar y cambiar el color de las flechas en la tabla con clase .data-table */
        .data-table thead .sorting:before,
        .data-table thead .sorting:after,
        .data-table thead .sorting_asc:before,
        .data-table thead .sorting_asc:after,
        .data-table thead .sorting_desc:before,
        .data-table thead .sorting_desc:after {
            font-size: 18px !important;
            color: white !important;
            opacity: 1;
        }

        .input-buttom {
            margin-top: 2.0rem;
        }

        .button-weight {
            /* Clase personalizada para padding horizontal de 7 */
            /* Agrega aquí el padding si es necesario */
        }
    </style>
    @endpush


    {{-- Filtros y acciones principales de la vista de tráfico de tareas --}}
    <div class="p-2 pb-20">
        <div class="container-fluid">
            <div class="row">
                <div class="pb-3 col-md-4">
                    <label for="filter-mes">Estados</label>
                    <input type="search" name="" id="" class="form-control" placeholder="Cambiar estado">
                </div>

                <div class="vertical-line"></div>
                <div class="pb-3 col-md-4">
                    {{-- Espacio en blanco para conservar el espacio --}}
                </div>
                <div class="vertical-line"></div>

                <div class="pb-3 col-md-3">
                    <a href="" class="btn btn-success input-buttom col-12 btn-lg">Crear tarea</a>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2">
                            <label for="filter-mes">Mes</label>
                            <select id="filter-mes" class="form-control">
                                <option value="">Selecciomne</option>
                                <option value="01">Enero</option>
                                <option value="02">Febrero</option>
                                <option value="03">Marzo</option>
                                <option value="04">Abril</option>
                                <option value="05">Mayo</option>
                                <option value="06">Junio</option>
                                <option value="07">Julio</option>
                                <option value="08">Agosto</option>
                                <option value="09">Septiembre</option>
                                <option value="10">Octubre</option>
                                <option value="11">Noviembre</option>
                                <option value="12">Diciembre</option>
                                <!-- Agrega los demás meses -->
                            </select>
                        </div>
                        <div class="col-md-1">
                            <label for="">Año</label>
                            <select name="" id="" class="form-control">
                                <option value="">Seleccion..</option>
                                <option value="">2020</option>
                                <option value="">2023</option>
                                <option value="">2024</option>
                                <option value="">2025</option>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <a href="" class="btn btn-primary button-search"
                                style="background-color:#15BAEE; border-color: #15BAEE">Buscar</a>
                        </div>
                        <div class="vertical-line"></div>
                        <div class="col-md-4">
                            <label for="">Buscar: </label>
                            <input type="search" class="form-control">
                        </div>
                        <div class="vertical-line"></div>
                        <div class="col-md-3 input-buttom">
                            <div class="row">
                                <spam class="px-2 mt-2">Mostrar</spam>
                                <select name="" id="" class="form-control col-3">
                                    <option value="">10</option>
                                    <option value="1">25</option>
                                    <option value="2">50</option>
                                    <option value="3">100</option>
                                </select>
                                <span class="px-2 mt-2">registros</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabla de tráfico de tareas --}}
    <table class="table data-table stripe hover">
        <thead class="text-center" style="color:white; background-color: #002E60">
            <tr>
                <th class="table-plus datatable-nosort">OT</th>
                <th>Cliente</th>
                <th>Ejecutivo</th>
                <th>Área</th>
                <th>Fecha de solicitud</th>
                <th>Requerimiento</th>
                <th>Fecha entrega área</th>
                <th>Estado</th>
                <th class="datatable-nosort">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($traficos as $trafico )
            <tr>
                {{-- Referencia de la OT --}}
                <td>{{ $trafico->ots->referencia }}</td>
                {{-- Nombre del cliente --}}
                <td>{{ $trafico->ots->clientes->nombre }}</td>
                {{-- Nombre del ejecutivo --}}
                <td>{{ $trafico->ots->users->nombre }}</td>
                {{-- Área asignada --}}
                <td>{{ $trafico->areas->nombre }}</td>
                {{-- Fecha de solicitud --}}
                <td>{{ $trafico->created_at }}</td>
                {{-- Nombre del requerimiento --}}
                <td>{{ $trafico->ots->nombre }}</td>
                {{-- Fecha de entrega del área --}}
                <td>{{ $trafico-> fecha_entrega_area ?? 'No se encontro ninguna fecha'}}</td>
                {{-- Estado de la tarea --}}
                <td>
                    @switch($trafico->estados->id)
                    @case(1)
                    <span class="badge badge-success"> {{ $trafico->estados->nombre }}</span>
                    @break
                    @case(2)
                    <span class="badge badge-primary"> {{ $trafico->estados->nombre }}</span>
                    @break
                    @case(3)
                    <span class="badge badge-info"> {{ $trafico->estados->nombre }}</span>
                    @break
                    @case(4)
                    <span class="badge badge-warning"> {{ $trafico->estados->nombre }}</span>
                    @break
                    @case(5)
                    <span class="badge badge-warning"> {{ $trafico->estados->nombre }}</span>
                    @break
                    @case(6)
                    <span class="badge badge-info"> {{ $trafico->estados->nombre }}</span>
                    @break
                    @case(7)
                    <span class="badge badge-warning"> {{ $trafico->estados->nombre }}</span>
                    @break
                    @default
                    <span class="badge badge-info">No se ha encontrado ningun estado</span>
                    @endswitch
                <td>
                    <a class="btn btn-primary col-12"  href=""><i class="icon-copy fa fa-eye"></i></a>
                </td>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
</div>

    @push('JS')
    {{-- Scripts de DataTables para la tabla de tráfico de tareas --}}
    <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
    <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
    <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
    <script src="vendors/scripts/datatable-setting.js"></script>
    </body>
    @endpush

@endsection
