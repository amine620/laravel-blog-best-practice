<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories=Category::count();
        return [
            "title" => $this->faker->word,
            "description" => $this->faker->text(225),
            "photo" => $this->faker->imageUrl(640, 480),
            "category_id"=>rand(1,3),
           
        ];
    }
}
