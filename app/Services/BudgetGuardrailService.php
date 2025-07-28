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

        $budget = Budget::where('user_id', $user->id)
            ->where('category_id', $categoryId)
            ->where('period', $currentPeriod)
            ->first();

        if (!$budget) {
            return ['breached' => false, 'message' => 'No active budget cap defined for this category'];
        }

        $totalSpent = Transaction::where('user_id', $user->id)
            ->where('category_id', $categoryId)
            ->where('type', 'expense')
            ->where('transaction_date', '>=', Carbon::now()->startOfMonth())
            ->where('transaction_date', '<=', Carbon::now()->endOfMonth())
            ->sum('amount');

        $projectedSpent = $totalSpent + $incomingAmount;

        if ($projectedSpent > $budget->amount) {
            $overage = $projectedSpent - $budget->amount;
            return [
                'breached' => true,
                'message' => "🚨 ALERT: This transaction will breach your monthly budget by $" . number_format($overage, 2),
                'budget_limit' => $budget->amount,
                'current_total' => $projectedSpent
            ];
        }

        return ['breached' => false, 'message' => 'Initialization check pass'];
    }
}