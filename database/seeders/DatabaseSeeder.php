<?php

namespace Database\Seeders;

use App\Models\Community;
use App\Models\Reply;
use App\Models\Post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@email.com',
            'password' => '123'
        ]);

        $users = User::factory()->count(5)->create();

        $techCommunities = collect([
            'Laravel Brasil',
            'VueJS Developers',
            'Python Data Science',
            'DevOps & Cloud',
            'Front-end Lovers',
        ])->map(function ($name) {
            return Community::factory()->create(['name' => $name, 'slug' => str($name)->slug()]);
        });

        Post::factory()->count(5)->make()->each(function ($post) use ($users, $techCommunities) {
            $post->user_id = $users->random()->id;
            $post->title = fake()->sentence();
            $post->community_id = $techCommunities->random()->id;
            $post->content = fake()->paragraph(3);
            $post->save();

            Reply::factory()->count(5)->make()->each(function ($reply) use ($post, $users) {
                $reply->post_id = $post->id;
                $reply->user_id = $users->random()->id;
                $reply->content = fake()->sentence();
                $reply->save();

                Reply::factory()->count(2)->make()->each(function ($childReply) use ($post, $reply, $users) {
                    $childReply->post_id = $post->id;
                    $childReply->user_id = $users->random()->id;
                    $childReply->parent_id = $reply->id;
                    $childReply->content = fake()->sentence();
                    $childReply->save();
                });
            });
        });
    }
}
