<?php

namespace Tests\Feature;

use App\Livewire\DashboardOverview;
use App\Models\Budget;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\User;
use App\Services\BudgetGuardrailService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class BudgetGuardrailAndDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_budget_guardrail_detects_overspending_breach(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create([
            'type' => 'expense',
            'name' => 'Cloud Infrastructure',
        ]);

        Budget::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'amount' => 1000.00,
            'period' => now()->format('Y-m'),
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'reference_number' => 'TXN-TEST-001',
            'type' => 'expense',
            'amount' => 850.00,
            'transaction_date' => now()->toDateString(),
        ]);

        $service = new BudgetGuardrailService();
        $result = $service->checkTransactionBreach($user, $category->id, 250.00);

        $this->assertTrue($result['breached']);
        $this->assertEquals(1100.00, $result['current_total']);
        $this->assertStringContainsString('$100.00', $result['message']);
    }

    public function test_livewire_dashboard_renders_usd_metrics_and_guardrail_alert(): void
    {
        $user = User::factory()->create();
        $category = Category::factory()->create([
            'type' => 'expense',
            'name' => 'Subscription',
        ]);

        Budget::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'amount' => 500.00,
            'period' => now()->format('Y-m'),
        ]);

        Transaction::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'reference_number' => 'TXN-TEST-002',
            'type' => 'expense',
            'amount' => 600.00,
            'transaction_date' => now()->toDateString(),
        ]);

        Livewire::test(DashboardOverview::class)
            ->assertStatus(200)
            ->assertSee('Guardrail Triggered')
            ->assertSee('Subscription')
            ->assertSee('$600.00');
    }
}