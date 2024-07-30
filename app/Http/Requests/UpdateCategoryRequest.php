<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $category = $this->route('category');
        $propertyId = $category->property->id;
        return [
            "name" => "required|max:60|unique:properties,name,".$propertyId,
            "description" => "nullable|max:255"
        ];
    }
}
