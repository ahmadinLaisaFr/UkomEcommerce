<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        $name = $this->faker->unique()->words($nb = 2, $asText = true);
        $slug = Str::slug($name);
        $num = $this->faker->unique()->numberBetween(01,22);

        // untuk memberikan angka dibawah 10 awalan angka 0;
        $number = $num;
        if ($num < 10) {
            $number = '0'.$num;
        }

        // untuk mengacak status stok antara instock atau outofstock
        $status = '';
        $rand = random_int(0, 1);
        if ($rand == 0) {
            $status = 'Instock';
        }else if($rand == 1){
            $status = 'Out Of Stock';
        }

        return [
            'category_id' => $this->faker->numberBetween(1, 5),
            'name' => $name,
            'slug' => $slug,
            'short_desc' => $this->faker->text(200),
            'desc' => $this->faker->text(500),
            'regular_price' => $this->faker->numberBetween(10, 500),
            'SKU' => 'DIGI'.$this->faker->unique()->numberBetween(100,500),
            'stock_status' =>$status,
            'quantity' => $this->faker->numberBetween(100, 200),
            'image' => 'digital_'.$number.'.jpg',
        ];
    }
}
