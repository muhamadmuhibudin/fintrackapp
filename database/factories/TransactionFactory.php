<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'category_id' => Category::factory(),
            'reference_number' => 'TRX-' . strtoupper(Str::random(12)),
            'amount' => $this->faker->randomFloat(2, 10000, 5000000),
            'type' => $this->faker->randomElement(['income', 'expense']),
            'description' => $this->faker->sentence(),
            'raw_api_payload' => ['gateway' => 'midtrans', 'status' => 'settlement'],
            'transaction_date' => $this->faker->dateTimeBetween('-1 month', 'now'),
        ];
    }
}