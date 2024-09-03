<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'date_time' => 'required',
            'tax' => 'required',
            'receipt_number' => 'required|unique:sales,receipt_number|max:255',
            'total' => 'required|numeric',
            'client_id' => 'required|exists:clients,id',
            'user_id' => 'required|exists:users,id',
            'receipt_id' => 'required|exists:receipts,id'
        ];
    }
}
