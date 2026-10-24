<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category; // ✅ مهم
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class; // ✅ الفاكتوري يشتغل على مودل Product

    public function definition(): array
    {
        return [
            'category_id'    => Category::inRandomOrder()->first()?->id ?? Category::factory(),
            'name'           => $this->faker->words(3, true),
            'description'    => $this->faker->paragraph(),
            'price'          => $this->faker->numberBetween(50, 300),
            'discount_price' => null,
            'image'          => null,
            'is_best_seller' => $this->faker->boolean(20),
            'in_stock'       => $this->faker->numberBetween(0, 50),
            'is_active'      => true,
  ];
}
}
