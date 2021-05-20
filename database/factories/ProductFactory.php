<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->text(20);
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'product_category_id' => ProductCategory::inRandomOrder()->first()->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'description' => $this->faker->text(400),
            'stock' => $this->faker->numberBetween(1, 200)
        ];
    }
}
