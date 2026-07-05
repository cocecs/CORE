<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobPreferenceRequest extends FormRequest
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
            'work_location' => 'nullable|string|max:1',
            'province' => 'nullable|string|max:60',
            'town' => 'nullable|string|max:30',
            'latitude' => 'nullable|decimal:10,7',
            'longitude' => 'nullable|decimal:10,7',
            'specify_country' => 'nullable|string|max:60'
        ];
    }
}
