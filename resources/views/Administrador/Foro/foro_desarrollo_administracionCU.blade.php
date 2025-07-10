
{{--
    Vista: foro_desarrollo_administracionCU.blade.php
    Descripción: Muestra el foro de desarrollo para el área de Administración CU, permitiendo filtrar, buscar y visualizar tareas asociadas a OTs.
    Incluye filtros por estado, mes, año, búsqueda y cantidad de registros, así como una tabla de tareas y scripts de DataTables.
--}}
@extends('Administrador.layout_admin')

@section('template-blank-admin')
    {{-- Estilos y dependencias para DataTables y personalización visual --}}
    @push('CSS')
        <link rel="stylesheet" type="text/css" href="{{ url('src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
        <style>
            /* Botón de búsqueda personalizado */
            .button-search {
                background-color: #15BAEE;
                border-color: #15BAEE;
                color: #fff;
                margin-top: 2.0rem;
            }
            /* Línea vertical divisoria */
            .vertical-line {
                width: 1px;
                height: 100px;
                background-color: #ccc;
                margin: 0 20px;
            }
            /* Flechas de ordenamiento en la tabla */
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
            .input-buttom { margin-top: 2.0rem; }
            .button-weight { padding }
            /* Clase personalizada para padding horizontal de 7 */
        </style>
    @endpush



    {{-- Filtros y acciones principales del foro de administración CU --}}
    <div class="p-2 pb-20">
        <div class="container-fluid">
            <div class="row">
                {{-- Filtro por estado --}}
                <div class="pb-3 col-md-4">
                    <label for="filter-mes">Estados</label>
                    <input type="search" name="" id="" class="form-control" placeholder="Cambiar estado">
                </div>
                <div class="vertical-line"></div>
                {{-- Espacio en blanco para conservar el diseño --}}
                <div class="pb-3 col-md-4">
                    {{-- Espacio en blanco para conservar el espacio --}}
                </div>
                <div class="vertical-line"></div>
                {{-- Botón para crear nueva tarea --}}
                <div class="pb-3 col-md-3">
                    <a href="" class="btn btn-success input-buttom col-12">Crear tarea</a>
                </div>
                {{-- Filtros adicionales: mes, año, búsqueda y cantidad de registros --}}
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
                            <select name="" id=""class="form-control">
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


    {{-- Tabla de tareas de administración CU --}}
    <table class="table data-table stripe hover nowrap">
        <thead class="text-center" style="color:white; background-color: #002E60">
            <tr>
                <th class="table-plus datatable-nosort">OT</th>
                <th>Cliente</th>
                <th>Requerimiento</th>
                <th>Prioridad</th>
                <th>Fecha de solicitud</th>
                <th>Fecha de entrega cuentas</th>
                <th class="datatable-nosort">Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- Itera sobre las tareas de administración CU y muestra cada fila (actualmente datos de ejemplo) --}}
            <tr class="text-center">
                <td class="table-plus">Andrea J. Cagle</td>
                <td>20</td>
                <td>Gemini</td>
                <td>2829 Trainer Avenue Peoria, IL 61602 </td>
                <td>29-03-2018</td>
                <td>29-03-2018</td>
                <td>
                    <a class="dropdown-item" href="#"><i class="dw dw-eye btn btn-primary col-12 rounded-pill"></i>
                    </a>
                </td>
            </tr>
            <tr class="text-center">
                <td class="table-plus">Andrea J. Cagle</td>
                <td>20</td>
                <td>Gemini</td>
                <td>2829 Trainer Avenue Peoria, IL 61602 </td>
                <td>29-03-2018</td>
                <td>29-03-2018</td>
                <td>
                    <a class="dropdown-item" href="#"><i class="dw dw-eye btn btn-primary col-12 rounded-pill"></i>
                    </a>
                </td>
            </tr>
            <tr class="text-center">
                <td class="table-plus">Andrea J. Cagle</td>
                <td>20</td>
                <td>Gemini</td>
                <td>2829 Trainer Avenue Peoria, IL 61602 </td>
                <td>29-03-2018</td>
                <td>29-03-2018</td>
                <td>
                    <a class="dropdown-item" href="#"><i class="dw dw-eye btn btn-primary col-12 rounded-pill"></i>
                    </a>
                </td>
            </tr>
            <tr class="text-center">
                <td class="table-plus">Andrea J. Cagle</td>
                <td>20</td>
                <td>Gemini</td>
                <td>2829 Trainer Avenue Peoria, IL 61602 </td>
                <td>29-03-2018</td>
                <td>29-03-2018</td>
                <td>
                    <a class="dropdown-item" href="#"><i class="dw dw-eye btn btn-primary col-12 rounded-pill"></i>
                    </a>
                </td>
            </tr>
            <tr class="text-center">
                <td class="table-plus">Andrea J. Cagle</td>
                <td>20</td>
                <td>Gemini</td>
                <td>2829 Trainer Avenue Peoria, IL 61602 </td>
                <td>29-03-2018</td>
                <td>29-03-2018</td>
                <td>
                    <a class="dropdown-item" href="#"><i class="dw dw-eye btn btn-primary col-12 rounded-pill"></i>
                    </a>
                </td>
            </tr>
            <tr class="text-center">
                <td class="table-plus">Andrea J. Cagle</td>
                <td>20</td>
                <td>Gemini</td>
                <td>2829 Trainer Avenue Peoria, IL 61602 </td>
                <td>29-03-2018</td>
                <td>29-03-2018</td>
                <td>
                    <a class="dropdown-item" href="#"><i class="dw dw-eye btn btn-primary col-12 rounded-pill"></i>
                    </a>
                </td>
            </tr>
            <tr class="text-center">
                <td class="table-plus">Andrea J. Cagle</td>
                <td>20</td>
                <td>Gemini</td>
                <td>2829 Trainer Avenue Peoria, IL 61602 </td>
                <td>29-03-2018</td>
                <td>29-03-2018</td>
                <td>
                    <a class="dropdown-item" href="#"><i class="dw dw-eye btn btn-primary col-12 rounded-pill"></i>
                    </a>
                </td>
            </tr>
            <tr class="text-center">
                <td class="table-plus">Andrea J. Cagle</td>
                <td>20</td>
                <td>Gemini</td>
                <td>2829 Trainer Avenue Peoria, IL 61602 </td>
                <td>29-03-2018</td>
                <td>29-03-2018</td>
                <td>
                    <a class="dropdown-item" href="#"><i class="dw dw-eye btn btn-primary col-12 rounded-pill"></i>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>
    </div>
    {{-- Scripts para DataTables y configuración de la tabla --}}
    @push('JS')
        <script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
        <script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
        <script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
        <script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
        <script src="vendors/scripts/datatable-setting.js"></script>
    @endpush

{{-- Fin de la vista foro_desarrollo_administracionCU.blade.php --}}
@endsection
