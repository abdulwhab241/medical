<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorRequest extends FormRequest
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
            'address' => 'required',
            'name' => 'required',
            'section_id' => 'required|integer',
            'phone' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'أسـم الطبيب مطلوب الرجى كتابة اسم الطبيب '
            ],
            'address' => [
                'required' => 'العنوان مطلوب الرجى كتابة عنوان الطبيب الصحيح'
            ],
            'section_id' => [
                'required' => 'القسم مطلوب الرجى اختيار اسم القسم ',
                'integer' => 'القسم مطلوب الرجى اختيار اسم القسم '
            ],
            'phone' => [
                'required' => 'رقم هاتف الطبيب مطلوب الرجى كتابة  رقم هاتف الطبيب '
            ],

        ];
    }
}
