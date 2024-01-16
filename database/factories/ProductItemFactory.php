<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ProductItem;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductItem>
 */
class ProductItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        //Ik gebruik deze faker nu alleen omdat dit snel en makelijk is om de data base met fake data te kunnen vullen echter zou ik zelf een form maken om de batterij data in te kunnen laten vullen door een persoon voor echt gebruik
        return [
            //Dit is een naame faker voor onze batterij
            "name" => $this->faker->name(),
            //dit is een price faker voor onze batterij
            "price" => $this->faker->randomNumber(2) . ',' . $this->faker->randomNumber(2),
            //Dit is een wattage faker voor onze batterij
            "wattage" => $this->faker->randomNumber(4),
        ];
    }
}
