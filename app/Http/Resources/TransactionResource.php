<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reference_number' => $this->reference_number,
            'amount' => $this->amount,
            'type' => $this->type,
            'description' => $this->description,
            'transaction_date' => $this->transaction_date->toIso8601String(),
            'category' => new CategoryResource($this->whenLoaded('category')),
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}