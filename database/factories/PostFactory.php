<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Post;
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
        return [
            'title'=>$this->faker->text(50),
            'user_id'=>rand(1,3),
            'description'=>$this->faker->text(500),
            'post_creator'=>$this->faker->text(50)
        ];
    }
}
