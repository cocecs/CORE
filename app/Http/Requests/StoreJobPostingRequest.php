<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreJobPostingRequest extends FormRequest
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
            'job_id' => 'nullable|string|max:255',
            'job_type' => 'required|string|max:1',
            'job_category' => 'required|string|max:3',
            'skills_required' => 'required|array',
            'province' => 'required|string|max:50',
            'town' => 'required|string|max:50',
            'barangay' => 'required|string|max:50',
            'latitude' => 'nullable|decimal:10,7',
            'longitude' => 'nullable|decimal:10,7',
            'sex_preference' => 'required|string|max:1',
            'num_positions' => 'required|integer',
        ];
    }
}
