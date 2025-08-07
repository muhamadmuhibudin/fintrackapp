<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class FinancialCoreSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        $categories = Category::factory()->count(6)->create();

        $categories->each(function ($category) use ($user) {
            $isIncome = $category->type === 'income';

            Transaction::factory()->count(5)->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'type' => $category->type,
                'amount' => $isIncome ? fake()->randomFloat(2, 850, 2400) : fake()->randomFloat(2, 45, 380),
                'transaction_date' => now()->startOfMonth()->addDays(rand(0, 12))->toDateString(),
            ]);
        });

        $expenseCategory = $categories->firstWhere('type', 'expense') ?? $categories->first();

        $currentSpend = Transaction::where('user_id', $user->id)
            ->where('category_id', $expenseCategory->id)
            ->where('type', 'expense')
            ->sum('amount');

        Budget::create([
            'user_id' => $user->id,
            'category_id' => $expenseCategory->id,
            'amount' => $currentSpend > 0 ? round($currentSpend * 0.85, 2) : 800.00,
            'period' => now()->format('Y-m'),
        ]);
    }
}