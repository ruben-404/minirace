<?php

// database/factories/CarreraFactory.php

namespace Database\Factories;

use App\Models\Carrera;
use Illuminate\Database\Eloquent\Factories\Factory;

class CarreraFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Carrera::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->sentence,
            'descripció' => $this->faker->text(),
            'desnivell' => $this->faker->randomFloat(2, 0, 1000),
            'imatgeMapa' => $this->faker->imageUrl(),
            'maximParticipants' => $this->faker->numberBetween(1, 1000),
            'habilitado' => $this->faker->boolean,
            'km' => $this->faker->randomFloat(2, 0, 100),
            'data' => $this->faker->date(),
            'hora' => $this->faker->time(),
            'puntSortida' => $this->faker->address,
            'cartellPromoció' => $this->faker->imageUrl(),
            'preuAsseguradora' => $this->faker->randomFloat(2, 0, 1000),
            'preuPatrocini' => $this->faker->randomFloat(2, 0, 1000),
            'preuInscripció' => $this->faker->randomFloat(2, 0, 1000),
        ];
    }
}
