<?php

namespace Database\Factories;

use App\Models\Community;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Community>
 */
class CommunityFactory extends Factory
{
    protected $model = Community::class;

    public function definition(): array
    {
        $name = $this->faker->word();

        return [
            'name' => $name,
            'slug' => str($name)->slug(),
        ];
    }
}
