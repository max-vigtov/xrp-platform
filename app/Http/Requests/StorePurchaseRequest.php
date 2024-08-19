<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'provider_id' => 'required|exists:providers,id',
            'receipt_id' => 'required|exists:receipts,id',
            'receipt_number' => 'required|unique:purchases,receipt_number|max:255',
            'tax' => 'required',
            'date_time' => 'required',
            'total' => 'required',
        ];
    }
}
