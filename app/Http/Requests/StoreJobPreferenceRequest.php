<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobPreferenceRequest extends FormRequest
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
            'pref_occ' => 'nullable|string|max:255',
            'work_location' => 'nullable|string|max:1',
            'specific_location' => 'nullable|string|max:50',
            'specify_country' => 'nullable|string|max:50',
        ];
    }
}
