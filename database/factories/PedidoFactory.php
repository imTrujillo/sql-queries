<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PedidoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'id_usuario' => User::inRandomOrder()->first()->id,
            'producto' => fake()->text(20),
            'cantidad' => fake()->numberBetween($min = 0, $max = 2000),
            'total' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10000)
        ];
    }
}
