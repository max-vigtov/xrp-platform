<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
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
            'business_name' => 'required|max:80',
            'address' => 'required|max:80',
            'person_type' => 'required|string',
            'document_id' => 'required|integer|exists:documents,id',
            'document_number' => 'required|max:20|unique:people,document_number',
        ];
    }
}
