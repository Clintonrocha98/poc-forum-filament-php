<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    public function definition(): array
    {
        $title = $this->faker->sentence();

        return [
            'title' => $title,
            'content' => $this->faker->paragraph(4),
            'user_id' => null,
            'community_id' => null,
            'slug' => str($title)->slug(),
        ];
    }
}
