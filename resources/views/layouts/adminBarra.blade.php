<div class="flex-column bg-dark align-self-start justify-content-end vertical-buttons">
    <div class="mb-30">
        <div class="container d-flex justify-content-between align-items-center d-lg-none">
            <button id="toggleSidebar1" class="btn btn-link mb-2 text-white">
                <i class="fas fa-bars"></i> <!-- Icono de barras -->
            </button>
        </div>
        <div class="btn-group-vertical">
            <a href="{{ route('carreras') }}" class="btn btn-link mb-2 text-white text-decoration-none">Carreras</a>
            <a href="{{ route('asseguradoras') }}" class="btn btn-link mb-2 text-white text-decoration-none">Asseguradoras</a>
            <a href="{{ route('sponsors') }}" class="btn btn-link mb-2 text-white text-decoration-none">Sponsors</a>
        </div>
    </div>
</div>