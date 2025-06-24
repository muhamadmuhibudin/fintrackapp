<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category_id' => ['nullable', 'exists:categories,id'],
            'reference_number' => ['required', 'string', 'unique:transactions,reference_number'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'type' => ['required', Rule::in(['income', 'expense'])],
            'description' => ['nullable', 'string', 'max:1000'],
            'raw_api_payload' => ['nullable', 'array'],
            'transaction_date' => ['required', 'date'],
        ];
    }
}