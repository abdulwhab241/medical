<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SalaryRequest extends FormRequest
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
            'User_id' => 'required|integer',
            'Disc' => 'required',
            'Salary' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'User_id' => [
                'required' => 'أسم الموظف مطلوب الرجى إختيار أسم الموظف ',
                'integer' => 'أسم الموظف مطلوب الرجى إختيار أسم الموظف '
            ],
            'Disc' => [
                'required' => 'البيان مطلوب الرجى كتابة البيان بشكل صحيح '
            ],
            'Salary' => [
                'required' => 'الراتب مطلوب الرجى كتابة الراتب  '
            ],

        ];
    }
}
