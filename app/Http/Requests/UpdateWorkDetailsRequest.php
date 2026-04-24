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
            'professional_level' => 'nullable|string|max:1',
            'employment_status' => 'nullable|string|max:1',
            'employment_type' => 'nullable|string|max:1',
            'self_employed_spec' => 'nullable|array',
            'others_specify' => 'nullable|string|max:50',
            'job_history' => 'nullable|string|max:255',
            'specify_country' => 'nullable|string|max:60',
            'other_specify' => 'nullable|string|max:60',
            'ofw' => 'nullable|string|max:1',
            'ofw_specify_country' => 'nullable|string|max:50',
            'latest_specify_country' => 'nullable|string|max:50',
            'month_year_return' => 'nullable|string|max:15',
            'fourps' => 'nullable|string|max:1',
            'fourps_houshold_id' => 'nullable|string|max:20',
            'exploring_job' => 'nullable|array',
            'distance_job' => 'nullable|string|max:1',
            'job_roles' => 'nullable|string|max:1',
            'job_shift' => 'nullable|array',
        ];
    }
}
