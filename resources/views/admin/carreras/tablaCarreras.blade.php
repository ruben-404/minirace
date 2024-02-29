@include('layouts.adminHeader')

<!-- datos carrera : imagen mapa, punto salida , km , desnivel, catel proocion -->

<div class="container mt-4">
    <div class="column">
        <!-- Columna adicional con los botones -->
        <div class="d-flex flex-column bg-dark">
            <div class="mb-3">
                <!-- Botones -->
                <button type="button" class="btn btn-primary mb-1">Carreras</button>
                <button type="button" class="btn btn-primary mb-1">Aseguradores</button>
                <button type="button" class="btn btn-primary mb-1">Sponsors</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h2>Carreras</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th class="p-7">ID</th>
                        <th class="p-7">Nombre</th>
                        <th class="p-7">Descripción</th>
                        <!-- <th class="p-7">Desnivel</th> -->
                        <!-- <th class="p-7">Imagen Mapa</th> -->
                        <th class="p-7">Máximo Participantes</th>
                        <th class="p-7">Habilitado</th>
                        <!-- <th class="p-7">Kilómetros</th> -->
                        <th class="p-7">Fecha</th>
                        <th class="p-7">Hora</th>
                        <!-- <th class="p-7">Punto de Salida</th> -->
                        <!-- <th class="p-7">Cartel de Promoción</th> -->
                        <th class="p-7">Precio Asseguradora</th>
                        <th class="p-7">Precio Patrocinio</th>
                        <th class="p-7">Precio Inscripción</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($carreras as $carrera)
                    <tr>
                        <td class="p-7">{{ $carrera['id'] }}</td>
                        <td class="p-7">{{ $carrera['nom'] }}</td>
                        <td class="p-7">{{ $carrera['descripció'] }}</td>
                        <!-- <td class="p-7">{{ $carrera['desnivell'] }}</td> -->
                        <!-- <td class="p-7">{{ $carrera['imatgeMapa'] }}</td> -->
                        <td class="p-7">{{ $carrera['maximParticipants'] }}</td>
                        <td class="p-7">{{ $carrera['habilitado'] ? 'Sí' : 'No' }}</td>
                        <!-- <td class="p-7">{{ $carrera['km'] }}</td> -->
                        <td class="p-7">{{ $carrera['data'] }}</td>
                        <td class="p-7">{{ $carrera['hora'] }}</td>
                        <!-- <td class="p-7">{{ $carrera['puntSortida'] }}</td> -->
                        <!-- <td class="p-7">{{ $carrera['cartellPromoció'] }}</td> -->
                        <td class="p-7">{{ $carrera['preuAsseguradora'] }}€</td>
                        <td class="p-7">{{ $carrera['preuPatrocini'] }}€</td>
                        <td class="p-7">{{ $carrera['preuInscripció'] }}€</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>