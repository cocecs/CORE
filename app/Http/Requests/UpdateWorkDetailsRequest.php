<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateWorkDetailsRequest extends FormRequest
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
            'professional_level' => 'nullable|string|max:255',
            'job_history' => 'nullable|string|max:255',
            'exploring_job' => 'nullable|array',
            'distance_job' => 'nullable|string|max:1',
            'job_roles' => 'nullable|string|max:1',
            'job_shift' => 'nullable|array',
            'expertise' => 'nullable|string|max:2',
        ];
    }
}
