<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts=Post::all();
        $users = User::all();

        if($posts->count()==0)
        {
            $this->command->info('you should create at least one post');
            return;
        }

       $numberComment=(int)$this->command->ask('how many comment you want to create',5);

         \App\Models\Comment::factory($numberComment)->create()->each(function($comment) use($posts,$users){

           $comment->post_id=$posts->random()->id;
           $comment->user_id = $users->random()->id;
           $comment->save();
       });

    }
}
