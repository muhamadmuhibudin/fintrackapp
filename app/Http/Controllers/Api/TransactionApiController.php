<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use App\Services\BudgetGuardrailService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class TransactionApiController extends Controller
{
    /**
     * Display a secure listing of the authenticated user's transactions.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $transactions = $request->user()->transactions()
            ->with('category')
            ->orderByDesc('transaction_date')
            ->paginate(15);

        return TransactionResource::collection($transactions);
    }

    /**
     * Store a newly created transaction stream in database ledger.
     */
    public function store(StoreTransactionRequest $request, BudgetGuardrailService $guardrail): JsonResponse
    {
        $user = $request->user();
        $validatedData = $request->validated();

        $alertMessage = null;
        if ($validatedData['type'] === 'expense' && isset($validatedData['category_id'])) {
            $check = $guardrail->checkTransactionBreach($user, $validatedData['category_id'], $validatedData['amount']);
            if ($check['breached']) {
                $alertMessage = $check['message'];
            }
        }

        $transaction = $user->transactions()->create($validatedData);

        $response = new TransactionResource($transaction->load('category'));

        $metaData = ['message' => 'Transaction successfully logged into ledger'];
        if ($alertMessage) {
            $metaData['guardrail_alert'] = $alertMessage;
        }

        return $response->additional($metaData)->response()->setStatusCode(201);
    }
}