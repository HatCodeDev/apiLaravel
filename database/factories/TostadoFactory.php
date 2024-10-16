<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tostado>
 */
class TostadoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Lista de los tipos de tostado
        $tiposDeTostado = [
            'Light Roast',
            'Medium Roast',
            'Medium-Dark Roast',
            'Dark Roast',
            'French Roast',
            'Espresso Roast',
            'Italian Roast',
            'Spanish Roast',
            'Vienna Roast',
            'Full City+ Roast',
            'American Roast',
            'City Roast',
            'Full City Roast',
            'Cinnamon Roast (Tostado Canela)',
            'New England Roast'
        ];

        return [
            // Faker selecciona aleatoriamente un tipo de tostado de la lista
            'name' => $this->faker->randomElement($tiposDeTostado),
        ];
    }
}
