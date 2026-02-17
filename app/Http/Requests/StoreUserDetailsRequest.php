<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserDetailsRequest extends FormRequest
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
            'idno' => 'nullable|string|max:255',
            'firstname' => 'required|string|max:50',
            'middlename' => 'nullable|string|max:50',
            'lastname' => 'required|string|max:50',
            'ext' => 'nullable|string|max:10',
            'date_of_birth' => 'required|date',
        ];
    }
}
