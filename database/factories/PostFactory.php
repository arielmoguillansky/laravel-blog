<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'slug' => fake()->unique()->slug(),
            'excerpt' => '<p>'.implode('</p><p>', fake()->paragraphs(2)).'</p>',
            'body' => '<p>'.implode('</p><p>', fake()->paragraphs(6)).'</p>',
            'category_id' => Category::factory(),// creates a category when factory is created
            'user_id' => User::factory(),// creates an user when factory is created.
        ];
    }
}
