<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->name;
        return [
            "title" => $title,
            "slug"=> Str::slug($title),
            "description" => fake()->paragraph(2),
            "status" => fake()->boolean,
            "seo_keywords" => Str::slug(fake()->address,", "),
            "seo_description" => fake()->text,
            "user_id" => random_int(1,10),
        ];
    }
}
