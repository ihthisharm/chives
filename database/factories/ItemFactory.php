<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Item::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->words(3, true);
        $slug = Str::slug($name, '-');

        return [
            'name' => $name,
            'slug' => $slug,
            'description' => $this->faker->paragraph,
            'image' => 'https://robohash.org/' . $slug . '.png?bgset=bg1',
            'price' => $this->faker->randomNumber(5),
            'category_id' => $this->faker->numberBetween(1, 5),
        ];
    }
}
