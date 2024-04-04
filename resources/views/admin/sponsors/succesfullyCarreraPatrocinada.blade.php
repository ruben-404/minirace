@include('layouts.adminHeader')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Carreras patrocinada con éxito por el sponsor {{$datos['cif']}}</div>
                <div class="card-body">
                    @csrf
                        <div class="form-group mb-0">
                            <form method="POST" action="{{ route('carreras.aseguradasPDF') }}">
                                @csrf
                                @foreach ($datos['carreras'] as $idCarrera)
                                    <input type="hidden" name="carreras[]" value="{{ $idCarrera }}">
                                @endforeach
                                <input type="hidden" name="cif" value="{{ $datos['cif'] }}">
                                <button type="submit" class="btn btn-info btn-aseguradas-factura">Descargar factura</button>
                            </form>
                            <a href="{{ route('sponsors') }}" class="btn btn-custom">Volver</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
