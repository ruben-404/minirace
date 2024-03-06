@include('layouts.adminHeader')

<div class="container mt-4 d-flex flex-row">
    <div class="row">
        <div class="col">
            <h2>Sponsors</h2>
            <form method="GET" action="{{ route('addSponsor') }}">
                <button id="btn-add" class="btn btn-primary rounded-circle"><i class="fas fa-plus"></i></button>
            </form>
            <div style="max-height: 800px; overflow-y: auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center">Logo</th>
                            <th class="text-center">Nombre</th>
                            <th class="text-center">CIF</th>
                            <th class="text-center">Dirección</th>
                            <th class="text-center">Destacado</th>
                            <th colspan="2" class="text-center">Acciones</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        @foreach($sponsors as $sponsor)
                        <tr>
                            <td class="text-center align-middle"><img width="80" height="80" src="{{asset('storage/sponsorsImages/'.$sponsor->logo)}}" alt="Logo Sponsor"></td>
                            <td class="text-center align-middle">{{ $sponsor->CIF }}</td>
                            <td class="text-center align-middle">{{ $sponsor->nom }}</td>
                            <td class="text-center align-middle">{{ $sponsor->adreça }}</td>
                            <td class="text-center align-middle">{{ $sponsor->destacado ? 'Sí' : 'No' }}</td>
                            <td class="text-center align-middle">
                                <form method="GET" action="{{ route('editarSponsor', $sponsor->CIF) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-editar">Editar</button>
                                </form>
                                <form method="GET" action="{{ route('editarSponsor', $sponsor->CIF) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-info btn-editar">Patrocinar</button>
                                </form>
                            </td>
                        </tr>
                        
                        @endforeach
                    </tbody>
                    
                
                </table>
            </div>
        </div> 
    </div>
</div>