<?php

namespace App\Livewire;

use App\Models\Budget;
use App\Models\Transaction;
use App\Models\User;
use App\Services\BudgetGuardrailService;
use Livewire\Component;
use Livewire\WithPagination;

class DashboardOverview extends Component
{
    use WithPagination;

    public $totalIncome = 0;
    public $totalExpense = 0;
    public $netBalance = 0;
    public $guardrailAlerts = [];

    public function mount(BudgetGuardrailService $guardrailService)
    {
        $user = auth()->user() ?? User::first();

        if (!$user) {
            return;
        }

        $this->totalIncome = Transaction::where('user_id', $user->id)
            ->where('type', 'income')
            ->sum('amount');

        $this->totalExpense = Transaction::where('user_id', $user->id)
            ->where('type', 'expense')
            ->sum('amount');

        $this->netBalance = $this->totalIncome - $this->totalExpense;

        $budgets = Budget::with('category')
            ->where('user_id', $user->id)
            ->where('period', now()->format('Y-m'))
            ->get();

        foreach ($budgets as $budget) {
            $analysis = $guardrailService->checkTransactionBreach($user, $budget->category_id, 0);

            if (!empty($analysis['breached'])) {
                $limit = (float) ($analysis['budget_limit'] ?? 1);
                $current = (float) ($analysis['current_total'] ?? 0);
                $percentage = $limit > 0 ? ($current / $limit) * 100 : 100;

                $this->guardrailAlerts[] = [
                    'category' => $budget->category->name ?? 'Category',
                    'percentage' => $percentage,
                    'message' => $analysis['message'],
                    'severity' => $percentage >= 100 ? 'red' : 'amber',
                ];
            }
        }
    }

    public function render()
    {
        $userId = auth()->id() ?? User::first()?->id ?? 1;

        $recentTransactions = Transaction::with('category')
            ->where('user_id', $userId)
            ->latest('transaction_date')
            ->paginate(10);

        return view('livewire.dashboard-overview', [
            'recentTransactions' => $recentTransactions,
        ])->layout('layouts.app');
    }
}