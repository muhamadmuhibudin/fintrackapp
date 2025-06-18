<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    public function definition(): array
    {
        $name = $this->faker->unique()->randomElement([
            'Food & Beverage',
            'Salary',
            'Freelance Income',
            'Rent',
            'Utilities',
            'Subscription'
        ]);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'type' => in_array($name, ['Salary', 'Freelance Income']) ? 'income' : 'expense',
        ];
    }
}