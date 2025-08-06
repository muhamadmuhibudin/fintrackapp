<div>
    <!-- Header Section -->
    <div class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold tracking-tight text-white">Financial Ledger & Guardrail Overview</h1>
            <p class="text-sm text-slate-400">Real-time telemetry, transaction ingestion, and overspending prevention.</p>
        </div>
        <div class="flex items-center space-x-2 font-mono text-xs text-slate-400 bg-slate-800/60 p-2 rounded border border-slate-700">
            <span class="inline-block w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
            <span>Livewire Engine Active</span>
        </div>
    </div>

    <!-- Alert Banners (Budget Guardrail) -->
    @if(count($guardrailAlerts) > 0)
        <div class="mb-8 space-y-2">
            @foreach($guardrailAlerts as $alert)
                <div class="p-4 rounded-lg border flex items-center justify-between {{ $alert['severity'] === 'red' ? 'bg-rose-950/40 border-rose-800 text-rose-200' : 'bg-amber-950/40 border-amber-800 text-amber-200' }}">
                    <div class="flex items-center space-x-3">
                        <span class="font-bold text-xs uppercase px-2 py-1 rounded {{ $alert['severity'] === 'red' ? 'bg-rose-500/20 text-rose-300' : 'bg-amber-500/20 text-amber-300' }}">
                            Guardrail Triggered
                        </span>
                        <span class="text-sm font-medium">{{ $alert['category'] }}: {{ $alert['message'] }}</span>
                    </div>
                    <span class="font-mono text-sm font-bold">{{ number_format($alert['percentage'], 1) }}% Used</span>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Metric Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-slate-800/40 border border-slate-800 p-6 rounded-xl">
            <span class="text-xs font-mono uppercase tracking-wider text-slate-400">Total Inflow</span>
            <div class="text-2xl font-bold text-emerald-400 mt-2 font-mono">
                ${{ number_format($totalIncome, 2, '.', ',') }}
            </div>
        </div>
        <div class="bg-slate-800/40 border border-slate-800 p-6 rounded-xl">
            <span class="text-xs font-mono uppercase tracking-wider text-slate-400">Total Outflow</span>
            <div class="text-2xl font-bold text-rose-400 mt-2 font-mono">
                ${{ number_format($totalExpense, 2, '.', ',') }}
            </div>
        </div>
        <div class="bg-slate-800/40 border border-slate-800 p-6 rounded-xl">
            <span class="text-xs font-mono uppercase tracking-wider text-slate-400">Net Ledger Balance</span>
            <div class="text-2xl font-bold {{ $netBalance >= 0 ? 'text-emerald-400' : 'text-rose-400' }} mt-2 font-mono">
                {{ $netBalance < 0 ? '-' : '' }}${{ number_format(abs($netBalance), 2, '.', ',') }}
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-slate-800/30 border border-slate-800 rounded-xl overflow-hidden">
        <div class="p-5 border-b border-slate-800 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-slate-200">Ledger Ingestion Records</h2>
            <span class="text-xs text-slate-500 font-mono">Strict Decimal(15,2) Precision · USD</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-800/60 text-xs uppercase font-mono text-slate-400 border-b border-slate-800">
                    <tr>
                        <th class="px-6 py-3">Date</th>
                        <th class="px-6 py-3">Category</th>
                        <th class="px-6 py-3">Description</th>
                        <th class="px-6 py-3">Type</th>
                        <th class="px-6 py-3 text-right">Amount</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800 font-mono text-xs">
                    @forelse($recentTransactions as $tx)
                        <tr class="hover:bg-slate-800/20">
                            <td class="px-6 py-4 text-slate-400">{{ \Carbon\Carbon::parse($tx->transaction_date)->format('Y-m-d') }}</td>
                            <td class="px-6 py-4 font-sans font-medium text-slate-200">{{ $tx->category->name ?? 'Uncategorized' }}</td>
                            <td class="px-6 py-4 font-sans text-slate-400">{{ $tx->description ?? $tx->notes ?? '-' }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 rounded text-[11px] font-semibold {{ $tx->type === 'income' ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/20' : 'bg-rose-500/10 text-rose-400 border border-rose-500/20' }}">
                                    {{ strtoupper($tx->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right font-bold {{ $tx->type === 'income' ? 'text-emerald-400' : 'text-rose-400' }}">
                                {{ $tx->type === 'income' ? '+' : '-' }}${{ number_format($tx->amount, 2, '.', ',') }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-slate-500 font-sans">
                                No transactions recorded yet. Run database seeders to populate demo telemetry.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($recentTransactions->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $recentTransactions->links() }}
            </div>
        @endif
    </div>
</div>