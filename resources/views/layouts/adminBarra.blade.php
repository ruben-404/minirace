<div class="flex-column bg-dark align-self-start justify-content-end vertical-buttons">
    <div class="mb-30">

        <div class="container d-flex justify-content-between align-items-center d-lg-none">
            <button id="toggleSidebar1" class="btn btn-link mb-2 text-white">
                <i class="fas fa-bars"></i> <!-- Icono de barras -->
            </button>
        </div>
        <div class="btn-group-vertical">
            <img src="{{ asset('resources/icons/Logo.png') }}" class="logo" alt="Logo Sponsor">

            <a href="{{ route('carreras') }}" class="btn btn-link mb-2 text-white text-decoration-none px-4">Carreras</a>
            <a href="{{ route('asseguradoras') }}" class="btn btn-link mb-2 text-white text-decoration-none px-4">Asseguradoras</a>
            <a href="{{ route('sponsors') }}" class="btn btn-link mb-2 text-white text-decoration-none px-4">Sponsors</a>
        </div>
    </div>
</div>