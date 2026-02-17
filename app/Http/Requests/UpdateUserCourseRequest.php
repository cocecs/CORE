<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserCourseRequest extends FormRequest
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
            'educational_level' => 'required|string|max:60',
            // 'custom_course' => 'required|string|max:60',
            // 'custom_acourse' => 'nullable|string|max:60',
            // 'custom_bcourse' => 'nullable|string|max:60',
            // 'custom_mcourse' => 'nullable|string|max:60',
            // 'custom_dcourse' => 'nullable|string|max:60',
        ];
    }
}
