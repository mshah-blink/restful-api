<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:products|max:255',
            'category' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'price' => 'required|decimal:0,2|max:255',
            'size' => 'required|string|max:255',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success'   => false,
            'message'   => 'Validation errors',
            'data'      => $validator->errors()
        ]));
    }

    public function messages()
    {
        return [
            'name.unique' => 'Name must be unique',
            'name.required' => 'Name is required',
            'category.required' => 'Category is required',
            'color.required' => 'Colour is required',
            'price.required' => 'Price is required',
            'price.decimal' => 'Price must be decimal',
            'size.required' => 'Size is required'
        ];
    }
}
