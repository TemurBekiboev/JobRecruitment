<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
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
            'vacancy_id' => ['required', 'exists:vacancies,id'],
            'user_id'    => ['required', 'exists:users,id'],
            'cover_letter' => ['nullable', 'string', 'max:5000'],
            'cv_file'      => ['required', 'file', 'mimes:pdf,doc,docx', 'max:2048'], 
        ];
    }
}
