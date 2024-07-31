<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $brand = $this->route('brand');
        $propertyId = $brand->property->id;
        return [
            "name" => "required|max:60|unique:properties,name,".$propertyId,
            "description" => "nullable|max:255"
        ];
    }
}
