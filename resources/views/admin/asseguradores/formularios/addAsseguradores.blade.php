@include('layouts.adminHeader')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nueva Aseguradora</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('guardarAseguradora') }}">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="cif">CIF</label>
                                    <input id="cif" type="text" class="form-control" name="cif" required></input>
                                </div>
                                <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input id="nombre" type="text" class="form-control" name="nombre" required autofocus>
                                </div>

                                <div class="form-group">
                                    <label for="direccion">Adreça</label>
                                    <input id="direccion" type="text" class="form-control" name="direccion" required>
                                </div>
                                <div class="form-group">
                                    <label for="precio">Precio</label>
                                    <input id="precio" type="number" class="form-control" name="precio" required>
                                </div>

                                <div class="form-group">
                                    <label for="logo">Logo de la aseguradora</label>
                                    <input id="logo" type="file" class="form-control-file" name="logo">
                                </div>

                                <div class="form-group">
                                    <label for="habilitado">Habilitado</label>
                                    <select id="habilitado" class="form-control" name="habilitado" required>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                Guardar Aseguradora
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
