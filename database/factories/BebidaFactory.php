<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bebida>
 */
class BebidaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Lista de tipos de bebidas
        $tiposDeBebidas = [
            'Espresso',
            'Café Americano',
            'Café Latte',
            'Cappuccino',
            'Mocha',
            'Macchiato',
            'Flat White',
            'Affogato'
        ];

        // Lista de filtraciones de café
        $tiposDeFiltracion = [
            'Prensa Francesa',
            'Aeropress',
            'V60',
            'Chemex',
            'Cold Brew',
            'Sifón',
            'Café de Goteo'
        ];

        // Lista de complementos
        $complementos = [
            'Leche',
            'Crema',
            'Canela',
            'Miel',
            'Chocolate',
            'Jarabe de Vainilla',
            'Azúcar'
        ];
        $altura = [
            'Chico',
            'Mediano',
            'Grande',
            'Jumbo'
        ];
        

        return [
            'tipo' => $this->faker->randomElement($tiposDeBebidas),           
            'tostados_id' => $this->faker->numberBetween(1,15),               
            'precio' => $this->faker->randomFloat(2, 20, 200),                
            'filtracion' => $this->faker->randomElement($tiposDeFiltracion),  
            'altura' =>  $this->faker->randomElement($altura),              
            'complementos' => $this->faker->randomElement($complementos),     
            'imagen' => 'imagenes_bebidas/fake_image_' . $this->faker->numberBetween(1, 100) . '.jpg',           
        ];
    }
}
