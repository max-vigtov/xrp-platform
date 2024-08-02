<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "code" => "required|unique:products,code|max:50",
            "name" => "required|unique:products,name|max:80",
            "description" => "nullable|max:255",
            "expiration_date" => "nullable|date",
            "img_path" => "nullable|image|mimes:png,jpg,jpeg|max:2048",
            "brand_id" => "required|integer|exists:brands,id",
            "category" => "required"
        ];
    }

    public function attributes()
    {
        return [
            "code" => "código",
            "name" => "nombre",
            "description" => "descripción",
            "brand_id" => "marca",
            "category" => "categoría"
        ];
    }

    public function messages()
    {
        return [
            "code" => "Asigne un código al producto",
            "name" => "Es necesario otorgarle un nombre al producto",
            "brand_id" => "Seleccione la marca a la que pertenece el producto",
            "category" => "Seleccione la categoría a la que pertenece el producto"
        ];
    }
}
