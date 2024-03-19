<?php

namespace Database\Factories;

use App\Models\Entity;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'api' => $this->faker->word,
            'description' => $this->faker->sentence,
            'link' => $this->faker->url,
            'category_id' => 1, // Por ejemplo, suponiendo que el ID de la categoría siempre es 1
        ];
    }
}

