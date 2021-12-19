<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags=collect(['movies',"music","web development","work","teaching"]);
        $tags->each(function($tag){
            $_tag=new Tag();
            $_tag->name=$tag;
            $_tag->save();
        });
    }
}
