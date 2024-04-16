<?php

// database/factories/CarreraFactory.php

namespace Database\Factories;
use App\Models\Carrera;
use App\Models\CarreraAssegurada;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarreraAsseguradaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CarreraAssegurada::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idCarrera' => Carrera::factory()->create()->idCarrera,
            'CIFasseguradora' => $this->faker->randomElement(['CIF1', 'CIF2', 'CIF3']),
        ];
    }
}
