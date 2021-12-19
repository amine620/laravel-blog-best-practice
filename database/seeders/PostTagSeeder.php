<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class PostTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount=Tag::count();

        Post::all()->each(function($post)use($tagCount){

            $take=random_int(1,$tagCount);

            $ids= Tag::inRandomOrder()->take($take)->pluck('id');

            $post->tags()->sync($ids);

        });
        Comment::all()->each(function ($comment) use ($tagCount) {

            $take = random_int(1, $tagCount);

            $ids = Tag::inRandomOrder()->take($take)->pluck('id');

            $comment->tags()->sync($ids);
        });
    }
}
