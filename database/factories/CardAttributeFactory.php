<?php

namespace Database\Factories;

use App\Models\CardAttribute;
use App\Models\Card;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardAttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CardAttribute::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'attribute_type' => 'image',
            'attribute_value' => $this->faker->imageUrl(340,256),
        ];
    }
}
