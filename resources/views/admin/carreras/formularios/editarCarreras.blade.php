@include('layouts.adminHeader')
<script src="{{ asset('js/carrerasEditar.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Carrera</div>

                <div class="card-body">
                    @if ($errors->any())
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    @endif
             
                    <form method="POST" action="{{ route('actualizarCarrera', $carrera->idCarrera) }}"  enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" type="text" class="form-control input-line" name="nom" value="{{ $carrera->nom }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción</label>
                                <textarea id="descripcion" class="form-control input-line" name="descripció" required>{{ $carrera->descripció }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="desnivell">Desnivel</label>
                                <input id="desnivell" type="number" class="form-control input-line" name="desnivell" value="{{ $carrera->desnivell }}" required>
                            </div>

                            <div class="form-group">
                                <label for="maxim_participants">Máximo Participantes</label>
                                <input id="maxim_participants" type="number" class="form-control input-line" name="maximParticipants" value="{{ $carrera->maximParticipants }}" required>
                            </div>
                    

                        <div class="form-group">
                            <label for="habilitado">Habilitado</label>
                            <select id="habilitado" class="form-control input-line" name="habilitado" required>
                                <option value="1" {{ $carrera->habilitado ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ !$carrera->habilitado ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="km">Kilómetros</label>
                            <input id="km" type="number" class="form-control input-line" name="km" value="{{ $carrera->km }}" required>
                        </div>
                        <div class="form-group">
                            <label for="punt_sortida">Punto de Salida</label>
                            <input id="punt_sortida" type="text" class="form-control input-line" name="puntSortida" value="{{ $carrera->puntSortida }}" required>
                        </div>

                        </div>
                        
                        <div class="col-md-6">

                        <div class="form-group">
                            <label for="data">Fecha</label>
                            <input id="data" type="date" class="form-control input-line" name="data" value="{{ $carrera->data }}" required>
                        </div>

                        <div class="form-group">
                            <label for="hora">Hora</label>
                            <input id="hora" type="time" class="form-control input-line" name="hora" value="{{ old('hora', date('H:i', strtotime($carrera->hora))) }}" required>
                        </div>

                        <div class="form-group">
                            <label for="preu_asseguradora">Precio Aseguradora</label>
                            <input id="preu_asseguradora" type="number" class="form-control input-line" name="preuAsseguradora" value="{{ $carrera->preuAsseguradora }}" required>
                        </div>

                        <div class="form-group">
                            <label for="preu_patrocinio">Precio Patrocinio</label>
                            <input id="preu_patrocinio" type="number" class="form-control input-line" name="preuPatrocini" value="{{ $carrera->preuPatrocini }}" required>
                        </div>

                        <div class="form-group">
                            <label for="preu_inscripcio">Precio Inscripción</label>
                            <input id="preu_inscripcio" type="number" class="form-control input-line" name="preuInscripció" value="{{ $carrera->preuInscripció }}" required>
                        </div>

                        <div class="form-group">
                                <label for="imagen_mapa">Imagen Mapa</label>
                                <input id="imagen_mapa" type="file" class="form-control-file" name="imatgeMapa" value="{{ $carrera->imatgeMapa }}">
                        </div>

                        <div class="form-group">
                            <label for="cartell_promocio">Cartel de Promoción</label>
                            <input id="cartell_promocio" type="file" class="form-control-file" name="cartellPromoció" value="{{ $carrera->cartellPromoció }}">
                        </div>
                        @if(strtotime($carrera->data) < strtotime(now()))
                            <div class="col-md-6">
                                <!-- Área de arrastrar y soltar imágenes -->
                                <div id="dropzone" class="dropzone border border-primary rounded p-4 text-center">
                                    Arrastra y suelta tus imágenes aquí
                                </div>
                                <!-- Contador de imágenes -->
                                <div class="mt-3">
                                    <p id="imageCount">Número de imágenes: 0</p>
                                </div>
                            </div>
                        @else
                            <p>La fecha de la carrera aún no ha pasado. No se pueden subir imágenes.</p>
                        @endif
                        
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary submitButton">
                                Actualizar Carrera
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>