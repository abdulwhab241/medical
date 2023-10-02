<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'Address' => 'required',
            'Age' => 'required|integer',
            'Name' => 'required',
            'Gender' => 'required|integer',
            'Phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:9|max:9',
        ];
    }

    public function messages()
    {
        return [
            'Name' => [
                'required' => 'أسـم المريض مطلوب الرجى كتابة اسم المريض '
            ],
            'Address' => [
                'required' => 'العنوان مطلوب الرجى كتابة عنوان المريض الصحيح'
            ],
            'Age' => [
                'required' => 'عمر المريض مطلوب الرجى كتابة عمر المريض '
            ],
            'Phone' => [
                'required' => 'رقم هاتف المريض مطلوب الرجى كتابة  رقم هاتف المريض '
            ],
            'Gender' => [
                'required' => 'الجنس مطلوب الرجى اختيار  جنس المريض '
            ],

        ];
    }
}
