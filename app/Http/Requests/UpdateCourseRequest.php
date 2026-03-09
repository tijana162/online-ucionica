<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCourseRequest extends FormRequest
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
       $courseId = $this->route('course')->id; 
        return [
            'semestar' => 'required|in:letnji,zimski',
            'sifra' => 'required|unique:courses,sifra,' . $courseId,
            'profesor' => 'required|string',
            'opis' => 'required|string',
        ];
    }
}
