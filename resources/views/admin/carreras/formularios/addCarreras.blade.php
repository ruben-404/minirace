@include('layouts.adminHeader')

<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva Carrera</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('guardarCarrera') }}"  enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input id="nombre" type="text" class="form-control input-line" name="nombre" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="descripcion">Descripción</label>
                                    <textarea id="descripcion" class="form-control input-line" name="descripcion" required></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="desnivell">Desnivel</label>
                                    <input id="desnivell" type="number" class="form-control input-line" name="desnivell" required>
                                </div>


                                <div class="form-group">
                                    <label for="maxim_participants">Máximo Participantes</label>
                                    <input id="maxim_participants" type="number" class="form-control input-line" name="maxim_participants" required>
                                </div>

                                <div class="form-group">
                                    <label for="habilitado">Habilitado</label>
                                    <select id="habilitado" class="form-control input-line" name="habilitado" required>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="km">Kilómetros</label>
                                    <input id="km" type="number" class="form-control input-line" name="km" required>
                                </div>
                                <div class="form-group">
                                    <label for="punt_sortida">Punto de Salida</label>
                                    <input id="punt_sortida" type="text" class="form-control input-line" name="punt_sortida" required>
                                </div>

                            </div>

                            <div class="col-md-6">

                                
                                <div class="form-group">
                                    <label for="data">Fecha</label>
                                    <input id="data" type="date" class="form-control input-line" name="data" required>
                                </div>

                                <div class="form-group">
                                    <label for="hora">Hora</label>
                                    <input id="hora" type="time" class="form-control input-line" name="hora" required>
                                </div>

                                <div class="form-group">
                                    <label for="preu_asseguradora">Precio Asseguradora</label>
                                    <input id="preu_asseguradora" type="number" class="form-control input-line" name="preu_asseguradora" required>
                                </div>

                                <div class="form-group">
                                    <label for="preu_patrocinio">Precio Patrocinio</label>
                                    <input id="preu_patrocinio" type="number" class="form-control input-line" name="preu_patrocinio" required>
                                </div>

                                <div class="form-group">
                                    <label for="preu_inscripcio">Precio Inscripción</label>
                                    <input id="preu_inscripcio" type="number" class="form-control input-line" name="preu_inscripcio" required>
                                </div>

                                <div class="form-group">
                                    <label for="imagen_mapa">Imagen Mapa</label>
                                    <input id="imagen_mapa" type="file" class="form-control-file" name="imagen_mapa" required>
                                </div>
                                <div class="form-group">
                                    <label for="cartell_promocio">Cartel de Promoción</label>
                                    <input id="cartell_promocio" type="file" class="form-control-file" name="cartell_promocio" required>
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary submitButton">
                                Guardar Carrera
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>