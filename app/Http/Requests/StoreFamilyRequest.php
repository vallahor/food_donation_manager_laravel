<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFamilyRequest extends FormRequest
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
            'first_name' => ['required', 'string', 'min:1'],
            'last_name' => ['required', 'string', 'min:1'],
            'visited' => ['nullable', 'date'],
            'street_name' => ['nullable', 'string'],
            'zipcode' => ['nullable', 'string', 'digits:9'],
            'phone_number' => ['nullable', 'string', 'digits:11'],
        ];
    }

    public function prepareForValidation()
    {
        $this->merge([
            'visited' => $this->has('visited') ? now()->format('d-m-Y') : null,
        ]);
    }
}
