<?php

namespace Database\Factories;

use App;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = Category::pluck('id')->all();
        return [
            'category_id' => $categories[array_rand($categories)],
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->safeEmail(),
            'tel' => str_replace('-', '', $this->faker->phoneNumber()),
            'address' => $this->faker->streetAddress(),
            'building' => $this->faker->optional()->secondaryAddress,
            'detail' => $this->faker->realText(rand(10, 120))
        ];
    }
}
