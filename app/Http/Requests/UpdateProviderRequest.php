<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProviderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
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
        $provider = $this->route('provider');
        return [
            'business_name' => 'required|max:80',
            'address' => 'required|max:80',
            'document_id' => 'required|integer|exists:documents,id',
            'document_number' => 'required|max:20|unique:people,document_number,'.$provider->person->id
        ];
    }
}
