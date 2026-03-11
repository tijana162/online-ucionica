<?php

namespace App\Http\Requests\Api\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'ime' => 'required|string|max:255',
            'prezime' => 'required|string|max:255',
            'broj_indeksa' => 'required|string|unique:users,broj_indeksa,' . $this->student->id,
            'email' => 'required|email|unique:users,email,' . $this->student->id,
        ];
    }
}
