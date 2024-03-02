@include('layouts.adminHeader')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Aseguradora</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('actualizarAsseguradora', $asseguradora->CIF) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" type="text" class="form-control" name="nom" value="{{ $asseguradora->nom }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{ $asseguradora->adreça }}" required></input>
                            </div>

                            <div class="form-group">
                                <label for="precio">Precio</label>
                                <input id="precio" type="number" class="form-control" name="precio" value="{{ $asseguradora->preuCursa }}" required>
                            </div>
                            <div class="form-group">
                                    <label for="logo">Editar logo</label>
                                    <input id="logo" type="file" class="form-control-file" name="logo" required>
                            </div>
                        <div class="form-group">
                            <label for="habilitado">Habilitado</label>
                            <select id="habilitado" class="form-control" name="habilitado" required>
                                <option value="1" {{ $asseguradora->habilitado ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ !$asseguradora->habilitado ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                Actualizar Aseguradora
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
