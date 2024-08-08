<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $client = $this->route('client');
        return [
            'business_name' => 'required|max:80',
            'address' => 'required|max:80',
            'document_id' => 'required|integer|exists:documents,id',
            'document_number' => 'required|max:20|unique:people,document_number,'.$client->person->id
        ];
    }
}
