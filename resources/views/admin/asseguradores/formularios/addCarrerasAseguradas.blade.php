@include('layouts.adminHeader')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Carreras disponibles para asegurar de {{ $cif }}</div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('guardarCarreraAsegurada')}}">
                        @csrf
                        <div class="form-group mb-0">
                            @foreach ($Carreras as $carrera)
                                <div>
                                    <input type="checkbox" name="carreras[]" value="{{ $carrera->idCarrera }}">
                                    <label>{{ $carrera->nom }} -- {{ $carrera->preuAsseguradora }}€</label>
                                </div>
                            @endforeach
                            <input type="hidden" name="cif" value="{{ $cif }}">
                            <button type="submit" class="btn btn-primary">
                                Asegurar carreras
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
