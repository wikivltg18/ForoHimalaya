@extends('Administrador.layout_admin')

@section('template-blank-admin')
    <style>
            .steps {
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 20px 0;
            }
            .steps .step {
                background-color: #e9ecef;
                color: #495057;
                padding: 10px 20px;
                border-radius: 5px;         
                max-width: 200px;
            }

            .steps .current .step {
                background-color: #0d6efd;
                color: white;
            }

            .steps .done .step {
                background-color: #0d6efd;
                color: white;
            }
        </style>


    @section('button-press')
        <a href="{{ route('Clientes')}}" class="btn btn-primary">Listado de clientes</a>
    @endsection

    <form action="{{ route('store.cliente') }}" method="POST" enctype="multipart/form-data">
        @csrf {{-- Protección contra CSRF --}}
        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lg_cliente">Logo del cliente</label>
                            <input type="file" name="lg_cliente" id="logo_cliente" class="form-control @error('lg_cliente') form-control-warning @enderror">
                            <small class="text-muted"> Foto de referencia del cliente. </small>
                            @error('lg_cliente')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre_cliente">Nombre del cliente <span class="text-danger">*</span></label>
                            <input type="text" name="nm_cliente" class="form-control @error('nm_cliente') form-control-warning @enderror" required>
                            <small class="text-muted"> Eje: Unicentro, Manitoba, Comfandi. </small>
                            @error('nm_cliente')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email_cliente">Email <span class="text-danger">*</span></label>
                            <input type="email" name="em_cliente" id="email_cliente"
                                class="form-control @error('em_cliente') form-control-warning @enderror" required>
                            <small class="text-muted"> Eje: Manitoba@gmail.com, Comfandi@gmail.com. </small>
                            @error('em_cliente')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono_cliente">Teléfono <span class="text-danger"> * </span></label>
                            <input type="text" name="telefono_cliente" id="telefono_cliente"
                                class="form-control @error('telefono_cliente') form-control-warning @enderror" required>
                            <small class="text-muted"> Telefono de comunicación directo del cliente. </small>

                            @error('telefono_cliente')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="telefono_referencia_cliente">Teléfono referencia <span class="text-danger">
                                    * </span></label>
                            <input type="text" name="telefono_referencia_cliente" id="telefono_referencia_cliente"
                                class="form-control @error('telefono_referencia_cliente') form-control-warning @enderror"
                                required>
                            <small class="text-muted"> Telefono de referencia del cliente. </small>
                            @error('telefono_referencia_cliente')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="sitio_web_cliente">Sitio web <span class="text-danger">*</span></label>
                            <input type="text" name="st_web" class="form-control @error('st_web') form-control-warning @enderror" required>
                            <small class="text-muted"> Url del sitio web del cliente.</small>
                            @error('st_web')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="usuario_id">Director ejecutivo <span class="text-danger"> * </span></label>
                            <select name="usuario_id" id="usuario_id"
                                class="form-control @error('usuario_id') form-control-warning @enderror">
                                <option value="">Seleccione un ejecutivo</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}"> {{ $usuario->nombre }} </option>
                                @endforeach
                            </select>
                            <small class="text-muted"> Elegir el ejecutivo que se encargara del cliente. </small>
                            @error('usuario_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estado">Estado</label>
                            <select name="estado" id="estado" class="form-control" required>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="url_instagram">Link Instagram </label>
                                    <input type="text" name="url_instagram" id="url_instagram"
                                        class="form-control @error('url_instagram') form-control-warning @enderror"
                                        required>
                                    <small class="text-muted"> Eje: https://www.instagram.com </small>
                                    @error('url_instagram')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="url_facebook">Link Facebook </label>
                                    <input type="text" name="url_facebook" id="url_facebook"
                                        class="form-control @error('url_facebook') form-control-warning @enderror"
                                        required>
                                    <small class="text-muted"> Eje: https://www.facebook.com </small>
                                    @error('url_facebook')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="url_youtube">Link Youtube </label>
                                    <input type="text" name="url_youtube" id="url_youtube"
                                        class="form-control @error('url_youtube') form-control-warning @enderror"
                                        required>
                                    <small class="text-muted"> Eje: https://www.youtube.com</small>
                                    @error('url_youtube')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary col-12">Siguiente</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-5 text-center" style="background-color: #004EA4; height: 853px !important; ">
                    <img src="{{ asset('vendors/images/Logo_Himalaya_blanco-10.png') }}" alt="logo_himalaya"
                        class="mt-15">
                </div>
            </div>
        </div>





    {{-- No JS extra necesario, se eliminó la lógica de servicios relacionados y fee --}}
    @endsection
