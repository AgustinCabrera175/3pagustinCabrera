<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'dni' => 'required|integer|unique:students,dni',
            'nombre' => 'required|string|max:250',
            'apellido' => 'required|string|min:1|max:10000',
            'fechaNacimiento' => 'required|date',
            'curso' => [
                'required',
                'string',
                Rule::in(['1ero','2do','3ero']) 
            ]
        ];
    }
}