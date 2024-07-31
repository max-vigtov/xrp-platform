<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            "name" => "required|max:60|unique:properties,name",
            "description" => "nullable|max:255"
        ];
    }
}
