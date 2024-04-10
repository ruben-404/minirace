<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Carrera;
use App\Http\Controllers\CarreraController;
use App\Http\Controllers\InscritoController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;

class CarreraControllerTest extends TestCase
{
    use RefreshDatabase; 

    /**
     * Test for getCarreras method.
     *
     * @return void
     */
    public function testGetCarreras()
    {
        Carrera::factory()->count(3)->create();

        $inscritoController = new InscritoController(); 
        $controller = new CarreraController($inscritoController);

        $response = $this->get('/admin/carreras');

        $response->assertOk();

        $this->assertNotEmpty($response->viewData('carreras'));
    }

    public function testBuscarCarrerasPrincipal()
    {
        $carrera1 = Carrera::factory()->create(['nom' => 'Carrera RC 1']);
        $carrera2 = Carrera::factory()->create(['nom' => 'Carrera RC 2']);

        $request = new Request(['query' => 'Carrera RC 1']);

        $controller = new CarreraController(new InscritoController());

        $response = $controller->buscarCarrerasPrincipal($request);

        $this->assertStringContainsString('Carrera RC 1', $response);
        $this->assertStringNotContainsString('Carrera RC 2', $response);
    }
    
}
