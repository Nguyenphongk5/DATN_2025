<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition(): array
    {
        $name = $this->faker->unique()->words(3, true);

        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1000, 9999),
            'img_thumb' => $this->faker->imageUrl(400, 400, 'products', true, 'Product'),
            'description' => $this->faker->optional()->paragraph,
            'category_id' => Category::factory(), // sinh kèm category nếu cần
            'brand_id' => 1,       // sinh kèm brand nếu cần
            'view' => $this->faker->numberBetween(0, 5000),
            'is_active' => $this->faker->boolean(90), // 90% là active
        ];
    }
}
