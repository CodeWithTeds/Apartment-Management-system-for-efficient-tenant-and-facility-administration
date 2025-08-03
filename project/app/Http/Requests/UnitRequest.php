<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UnitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Only allow authenticated users
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'unit_number' => 'required|string|max:255',
            'unit_type' => 'nullable|string|max:255',
            'availability' => 'required|string|in:Available,Occupied,Maintenance',
            'rent_price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'admin_id' => 'sometimes|exists:users,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'unit_number.required' => 'The unit number is required.',
            'availability.required' => 'The availability status is required.',
            'availability.in' => 'The availability must be either Available, Occupied, or Maintenance.',
            'rent_price.required' => 'The rent price is required.',
            'rent_price.numeric' => 'The rent price must be a number.',
            'rent_price.min' => 'The rent price cannot be negative.',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // If admin_id is not provided, use the authenticated user's ID
        if (!$this->has('admin_id')) {
            $this->merge([
                'admin_id' => auth()->id(),
            ]);
        }
    }
}