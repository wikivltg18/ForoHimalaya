
{{-- Vista: crearUsuario.blade.php --}}
{{-- Permite al administrador registrar un nuevo usuario en el sistema. --}}

@extends('Administrador.layout_admin')

@section('template-blank-admin')

    {{-- Sección para incluir estilos personalizados --}}
    @push('CSS')
        <style>
            /* Espaciados personalizados */
            .mt-6{
                margin-top: 6rem !important;
            }
            .mt-10{
                margin-top: 10rem !important;
            }
            .mt-13{
                margin-top: 13em !important;
            }
            /* Botón secundario personalizado */
            .btn-secondary {
                background-color: #15baee !important;
                border-color: #15baee !important;
            }

            .btn-secondary:hover {
                background-color: #15baee !important;
            }
        </style>
    @endpush


@section('button-press')
    {{-- Botón para volver al listado de usuarios del equipo --}}
    <a href="{{ url('usuariosEquipo') }}" class="btn btn-secondary"><i class="icon-copy fa fa-plus" aria-hidden="true"></i> Volver</a>
@endsection


{{-- Contenedor principal del formulario de registro de usuario --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            {{-- Formulario para registrar un nuevo usuario --}}
            <form action="{{route('store.crete.user')}}" method="POST">
                <div class="row">
                    @csrf
                    {{-- Campo: Nombres --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nm-user"><span class="text-danger">*</span>Nombres:</label>
                            <input name="nm-user" type="text" class="form-control" required value="{{old('nm-user')}}">
                        </div>
                        @error('nm-user')
                        <div class="alert alert-danger" id="error-alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Campo: Apellidos --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="ap-user"><span class="text-danger">*</span>Apellidos:</label>
                            <input name="ap-user" type="text" class="form-control" required value="{{old('ap-user')}}">
                        </div>
                        @error('ap-user')
                        <div class="alert alert-danger" id="error-alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Campo: Email --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="em-user"><span class="text-danger">*</span>Email:</label>
                            <input name="em-user" type="email" class="form-control" required value="{{old('em-user')}}">
                        </div>
                        @error('em-user')
                        <div class="alert alert-danger" id="error-alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Campo: Contraseña --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="psw-user"><span class="text-danger">*</span>Password:</label>
                            <input name="psw-user" type="password" class="form-control" required >
                        </div>
                        @error('psw-user')
                        <div class="alert alert-danger" id="error-alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Campo: Cargo --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cr-user"><span class="text-danger">*</span>Cargo:</label>
                            <input name="cr-user" type="text" class="form-control" required value="{{old('cr-user')}}">
                        </div>
                        @error('cr-user')
                        <div class="alert alert-danger" id="error-alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Campo: Teléfono --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tf-user"><span class="text-danger">*</span>Telefono:</label>
                            <input name="tf-user" type="text" class="form-control" required value="{{ old('tf-user')}}">
                        </div>
                        @error('tf-user')
                        <div class="alert alert-danger" id="error-alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Campo: Teléfono de referencia --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tfr-user"><span class="text-danger">*</span>Telefono de referencia:</label>
                            <input name="tfr-user" type="text" class="form-control" required value="{{ old('tfr-user')}}">
                        </div>
                        @error('tfr-user')
                        <div class="alert alert-danger" id="error-alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Campo: Horas del mes --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="hr-user"><span class="text-danger">*</span>Horas del mes:</label>
                            <input name="hr-user" type="number" class="form-control" required value="{{old('hr-user')}}">
                        </div>
                        @error('hr-user')
                        <div class="alert alert-danger" id="error-alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Campo: Fecha de nacimiento --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="fh-user"><span class="text-danger">*</span>Fecha de nacimiento:</label>
                            <input name="fh-user" type="date" class="form-control" required value="{{old('fh-user')}}">
                        </div>
                        @error('fh-user')
                        <div class="alert alert-danger" id="error-alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Campo: Rol a asignar --}}
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rl-user"><span class="text-danger">*</span>Rol a asignar:</label>
                            <select name="rl-user" id="" class="form-control">
                                @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ old('rl-user') == $role->id ? 'selected' : '' }}>{{ $role->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('rl-user')
                        <div class="alert alert-danger" id="error-alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Campo: Área a asignar --}}
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="ar-user"><span class="text-danger">*</span>Area a asignar:</label>
                            <select name="ar-user" id="" class="form-control">
                                @foreach ($areas as  $area)
                                <option value="{{ $area->id}}">{{old('ar-user'== $area->id ? 'selected': '')}}{{$area->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('ar-user')
                        <div class="alert alert-danger" id="error-alert">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- Botón para registrar usuario --}}
                    <div class="col-md-12">
                        <input type="submit" class="btn btn-success col-12 btn-lg"  value="Registrar nuevo usuario">
                    </div>
                </div>
            </form>
        </div>
        {{-- Columna lateral con logo --}}
        <div class="col-md-6">
            <div class="text-center" style="background-color: #004EA4; height: 627px;">
                <img class="mt-13" src="{{ asset('vendors/images/Logo_Himalaya_blanco-10.png') }}" alt="logo_himalaya">
            </div>
        </div>
    </div>
</div>

@endsection
