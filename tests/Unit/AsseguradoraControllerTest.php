<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Carrera;
use App\Models\CarreraAssegurada;
use Tests\TestCase;
use App\Models\Asseguradora;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AsseguradoraControllerTest extends TestCase
{
    use RefreshDatabase;

    /*public function testGetAsseguradoras()
    {
        // Creamos datos de prueba directamente en la base de datos de pruebas
        $asseguradora1 = Asseguradora::create([
            'CIF' => 'CIF1',
            'nom' => 'Nombre Asseguradora 1',
            'logo' => 'logo1.png',
            'habilitado' => true,
            'adreça' => 'Dirección Asseguradora 1',
            'preuCursa' => 100.00,
        ]);

        $asseguradora2 = Asseguradora::create([
            'CIF' => 'CIF2',
            'nom' => 'Nombre Asseguradora 2',
            'logo' => 'logo2.png',
            'habilitado' => true,
            'adreça' => 'Dirección Asseguradora 2',
            'preuCursa' => 150.00,
        ]);

        // Llamamos a la función del controlador AsseguradoraController
        $response = $this->get('/admin/asseguradoras');

        // Verificamos que se cargue la vista adecuada
        $response->assertViewIs('admin.asseguradores.tablaAsseguradores');

        // Verificamos que la vista recibió las asseguradoras correctamente
        $response->assertViewHas('asseguradoras', function ($asseguradoras) use ($asseguradora1, $asseguradora2) {
            return $asseguradoras->contains($asseguradora1) && $asseguradoras->contains($asseguradora2);
        });
    }*/
    public function testGetCarrerasAseguradas()
{
    Asseguradora::create([
        'CIF' => 'CIF1',
        'nom' => 'Nombre Asseguradora 1',
        'logo' => 'logo1.png',
        'habilitado' => true,
        'adreça' => 'Dirección Asseguradora 1',
        'preuCursa' => 100.00,
    ]);
    Asseguradora::create([
        'CIF' => 'CIF2',
        'nom' => 'Nombre Asseguradora 2',
        'logo' => 'logo2.png',
        'habilitado' => true,
        'adreça' => 'Dirección Asseguradora 2',
        'preuCursa' => 100.00,
    ]);
    Asseguradora::create([
        'CIF' => 'CIF3',
        'nom' => 'Nombre Asseguradora 3',
        'logo' => 'logo3.png',
        'habilitado' => true,
        'adreça' => 'Dirección Asseguradora 3',
        'preuCursa' => 100.00,
    ]);
    // Creamos algunos datos de prueba usando los factories
    $carrera = Carrera::factory()->create();
    $carreraAssegurada = CarreraAssegurada::factory()->create(['idCarrera' => $carrera->idCarrera]);

    // Llamamos a la función del controlador
    $response = $this->get("/admin/asseguradoras/{$carreraAssegurada->CIFasseguradora}/carreras/aseguradas");

    // Verificamos que se cargue la vista adecuada
    $response->assertViewIs('admin.asseguradores.tablaCarreresAssegurades');

    // Verificamos que la vista recibió las carreras aseguradas correctamente
    $response->assertViewHas('Caseguradas', function ($Caseguradas) use ($carreraAssegurada) {
        return $Caseguradas->contains($carreraAssegurada);
    });

    // Verificamos que el CIF se pasó correctamente a la vista
    $response->assertViewHas('cif', $carreraAssegurada->CIFasseguradora);
}
}
