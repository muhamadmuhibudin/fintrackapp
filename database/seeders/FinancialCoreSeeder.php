<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class FinancialCoreSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user contoh
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
        ]);

        // Buat kategori default dan pasangkan transaksi acak di dalamnya
        Category::factory()->count(6)->create()->each(function ($category) use ($user) {
            Transaction::factory()->count(5)->create([
                'user_id' => $user->id,
                'category_id' => $category->id,
                'type' => $category->type,
            ]);
        });
    }
}