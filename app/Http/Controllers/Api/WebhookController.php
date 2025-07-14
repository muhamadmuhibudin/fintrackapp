<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Handle incoming digital wallet and QRIS payment gateway webhooks.
     */
    public function handleGatewayWebhook(Request $request): JsonResponse
    {
        // 1. Ambil payload JSON mentah dari gateway
        $payload = $request->all();

        // Simulasikan pembacaan data structure dari payment gateway internasional/lokal
        $referenceNumber = $payload['reference_id'] ?? null;
        $amount = $payload['amount'] ?? 0;
        $status = $payload['status'] ?? 'pending';
        $userEmail = $payload['user_email'] ?? null;

        if ($status !== 'settlement' && $status !== 'success') {
            return response()->json(['message' => 'Webhook received but transaction status is not completed'], 200);
        }

        // 2. Cari entitas user yang bersangkutan
        $user = User::where('email', $userEmail)->first();
        if (!$user) {
            Log::error("Webhook integration failed: User with email {$userEmail} not found.");
            return response()->json(['message' => 'User jurisdiction mismatch'], 404);
        }

        // 3. Simpan ke ledger secara aman (Idempotent: cek agar tidak ada double transaksi)
        $transaction = Transaction::firstOrCreate(
            ['reference_number' => $referenceNumber],
            [
                'user_id' => $user->id,
                'amount' => $amount,
                'type' => 'expense', // Mayoritas webhook e-wallet adalah pengeluaran/pembayaran retail
                'description' => 'Automated payment via digital wallet webhook integration',
                'raw_api_payload' => $payload,
                'transaction_date' => now(),
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => 'Webhook ledger statement successfully processed',
            'transaction_id' => $transaction->id
        ], 200);
    }
}