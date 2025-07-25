<?php

namespace App\Services;

use App\Models\User;
use App\Models\Budget;
use App\Models\Transaction;
use Carbon\Carbon;

class BudgetGuardrailService
{
    /**
     * Check if an incoming expense transaction will breach the user's monthly category budget.
     */
    public function checkTransactionBreach(User $user, int $categoryId, float $incomingAmount): array
    {
        $currentPeriod = Carbon::now()->format('Y-m');

        // Ambil batasan budget untuk kategori dan periode bulan ini
        $budget = Budget::where('user_id', $user->id)
            ->where('category_id', $categoryId)
            ->where('period', $currentPeriod)
            ->first();

        if (!$budget) {
            return ['breached' => false, 'message' => 'No active budget cap defined for this category'];
        }

        return ['breached' => false, 'message' => 'Initialization check pass'];
    }
}