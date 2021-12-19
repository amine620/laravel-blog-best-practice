<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=User::all();
        if($users->count()==0)
        {
            $this->command->info('you should generate at least one user');
            return;
        }
        $numberPost = (int)$this->command->ask('how many post you want to create', 5);

        \App\Models\Post::factory($numberPost)->create()->each(function ($post) use ($users) {

            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}
