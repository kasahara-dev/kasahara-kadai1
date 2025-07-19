<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Storage;

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
        $items = Item::pluck('id')->all();
        array_push($items, null);
        // 画像ファイル生成
        if (mt_rand(1, 100) <= 50) {
            $fileName = Str::uuid() . '.jpg';
            $file = UploadedFile::fake()->image('img.jpg', 200, 100)->size(1000);
            $path = Storage::disk('public')->putFileAs('contact', $file, $fileName);
            $filePath = 'contact/' . $fileName;
        } else {
            $filePath = null;
        }
        return [
            'category_id' => $categories[array_rand($categories)],
            'item_id' => $items[array_rand($items)],
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->safeEmail(),
            'tel' => str_replace('-', '', $this->faker->phoneNumber()),
            'address' => $this->faker->streetAddress(),
            'building' => $this->faker->optional()->secondaryAddress,
            'detail' => $this->faker->realText(rand(10, 120)),
            'img_path' => $filePath ?? null,
        ];
    }
}