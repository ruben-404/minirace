@include('layouts.adminHeader')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Nuevo Sponsor</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('guardarSponsor') }}">
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
                                    <label for="direccion">Direccion</label>
                                    <input id="direccion" type="text" class="form-control" name="direccion" required>
                                </div>

                                <div class="form-group">
                                    <label for="logo">Logo del sponsor</label>
                                    <input id="logo" type="file" class="form-control-file" name="logo">
                                </div>

                                <div class="form-group">
                                    <label for="destacado">Destacado?</label>
                                    <select id="destacado" class="form-control" name="destacado" required>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                Guardar Sponsor
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
