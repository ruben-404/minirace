@include('principal.componentes.header')
<script src="{{ asset('js/carreras.js') }}"></script>

<div class="container pt-5">
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="busquedaPrincipal" placeholder="Buscar carrera...">
    </div>
    <div id="buscar-carreras-url-principal" data-url="{{ route('buscar-carreras-principal') }}"></div>
    @include('principal.componentes.carreras')

    
</div>
