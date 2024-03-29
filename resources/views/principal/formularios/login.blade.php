@include('principal.componentes.header')
<div class="container-fluid bodyLogin d-flex justify-content-center align-items-center">
    <div class="row loginForm">
        <form method="POST" action="{{ route('HomeLogin') }} ">

            @csrf
            <div class="col-md-12 text-center mb-3"> <!-- Centramos el texto -->
                <img src="{{ asset('resources/userLogo.png') }}" alt="Logo"> <!-- Agregamos un texto alternativo para la accesibilidad -->
            </div>
            <div class="col-md-12 mb-3"> 
                <label for="DNI">Dni:</label>
            </div>
            <div class="col-md-12 text-center mb-3"> 
                <input type="text" id="DNI" name="DNI" placeholder="DNI" class="form-control input-line" required>
            </div>
            <div class="col-md-12 mb-3"> 
                <label for="password">Contraseña:</label>
            </div>
            <div class="col-md-12 text-center mb-3"> 
                <input type="password" id="password" name="password" placeholder="Contraseña" class="form-control input-line" required>
            </div>

            <div class="col-md-12 text-center mt-3">
                <button type="submit" class="btn btn-primary loginButtonAdmin">Iniciar sesión</button>
            </div>
        </form>
    </div>
</div>
