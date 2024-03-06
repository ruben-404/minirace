@include('layouts.adminHeader')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Sponsor</div>

                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('actualizarSponsor', $sponsor->CIF) }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre">Nombre</label>
                                <input id="nombre" type="text" class="form-control" name="nom" value="{{ $sponsor->nom }}" required autofocus>
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección</label>
                                <input id="direccion" type="text" class="form-control" name="direccion" value="{{ $sponsor->adreça }}" required></input>
                            </div>

                            <div class="form-group">
                                    <label for="logo">Editar logo</label>
                                    <input id="logo" type="file" class="form-control-file" name="logo" required>
                            </div>
                            <div class="form-group">
                                <label for="destacado">Destacado</label>
                                <select id="destacado" class="form-control" name="destacado" required>
                                    <option value="1" {{ $sponsor->destacat ? 'selected' : '' }}>Sí</option>
                                    <option value="0" {{ !$sponsor->destacat ? 'selected' : '' }}>No</option>
                                </select>
                            </div>

                            <div class="form-group mb-0">
                                <button type="submit" class="btn btn-primary">
                                    Actualizar Sponsor
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
