<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployerRequest extends FormRequest
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
            'idno' => 'nullable|string',
            'email' => 'nullable|string|max:50',
            'company_name' => 'nullable|string|max:50',
            'province' => 'nullable|string|max:20',
            'town' => 'nullable|string|max:20',
            'brgy' => 'nullable|string|max:20',
            'address_details' => 'nullable|string|max:50',
            'tel' => 'nullable|string|max:15',
            'phone' => 'nullable|string|max:15',
            'representative_name' => 'nullable|string|max:50',
            'mobile' => 'nullable|string|max:50',
            'designation' => 'nullable|string|max:50',
            'tin' => 'nullable|string|max:15',
        ];
    }
}
