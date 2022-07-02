<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Category::class;

    public function definition()
    {
        return [
            'title'=>$this->faker->word,
            'slug'=>$this->faker->unique()->slug,
            'summary'=>$this->faker->sentences(3, true),
            'photo'=>$this->faker->imageUrl('100','100'),
            'character_bg'=>$this->faker->imageUrl('50','50'),
            'is_parent'=>$this->faker->randomElement([true, false]),
            'status'=>$this->faker->randomElement(['active', 'inactive']),
            'parent_id'=>$this->faker->randomElement(Category::pluck('id')->toArray())
        ];
    }
}
