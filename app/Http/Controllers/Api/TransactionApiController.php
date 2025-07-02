<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
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
    public function store(StoreTransactionRequest $request): JsonResponse
    {
        $transaction = $request->user()->transactions()->create($request->validated());

        return (new TransactionResource($transaction->load('category')))
            ->additional(['message' => 'Transaction successfully logged into ledger'])
            ->response()
            ->setStatusCode(201);
    }
}