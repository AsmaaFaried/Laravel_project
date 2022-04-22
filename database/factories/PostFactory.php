<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
use App\Models\User;

use Illuminate\Support\Str;
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

    protected $model=Post::class;
    public function definition()
    {
        $title=$this->faker->text(20);
        return [
            'title'=>$title,
            'slug'=>Str::slug($title),
            'user_id'=>User::factory(),
            'description'=>$this->faker->text(500),
            'post_creator'=>$this->faker->text(50)
        ];
    }
}
