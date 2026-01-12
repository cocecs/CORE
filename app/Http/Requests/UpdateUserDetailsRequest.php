<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserDetailsRequest extends FormRequest
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
            'province' => 'nullable|string|max:255',
            'town' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'tel_no' => 'nullable|string|max:15',
            'mobile_no' => 'nullable|string|max:15',
        ];
    }
}
