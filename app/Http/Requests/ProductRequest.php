<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:1',
            'status' => 'required|in:Active,Inactive',
        ];
    }
    // Custom error messages
    public function messages(): array
    {
        return [
            // Name field messages
            'name.required' => 'The product name is required.',
            'name.string' => 'The product name must be a string.',
            'name.max' => 'The product name may not be greater than 255 characters.',

            // Images field messages
            'images.array' => 'The images must be an array.',
            'images.*.image' => 'Each file must be an image.',
            'images.*.mimes' => 'Allowed image formats are: jpeg, png, jpg, gif, svg.',
            'images.*.max' => 'Each image may not be greater than 2MB.',

            // Description field messages
            'description.required' => 'The product description is required.',
            'description.string' => 'The product description must be a string.',

            // Price field messages
            'price.required' => 'The product price is required.',
            'price.numeric' => 'The product price must be a number.',
            'price.min' => 'The product price must be at least 0.',

            // Quantity field messages
            'quantity.required' => 'The product quantity is required.',
            'quantity.integer' => 'The product quantity must be an integer.',
            'quantity.min' => 'The product quantity must be at least 1.',

            // Status field messages
            'status.required' => 'The product status is required.',
            'status.in' => 'The selected status is invalid. Valid options are: Active, Inactive.',
        ];
    }

    // Custom response for failed validation
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation errors',
            'errors' => $validator->errors()
        ], 422));
    }
}
