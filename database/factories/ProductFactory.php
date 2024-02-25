<?php

namespace Database\Factories;

use App\Models\Backend\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Backend\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(0, 10000, 500000),
            'image' => $this->faker->imageUrl(),
            'stock' => $this->faker->numberBetween(1, 100),
            'status' => $this->faker->boolean(),
            'is_favorite' => $this->faker->boolean(),
            'category_id' => $this->faker->numberBetween(1,10)
        ];
    }
}
