<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;


class ReplyFactory extends Factory
{
    protected $model = Reply::class;

    public function definition(): array
    {
        return [
            'content' => $this->faker->paragraph(),
            'user_id' => null,
            'post_id' => null,
        ];
    }
}
