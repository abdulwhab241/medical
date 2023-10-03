<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsuranceRequest extends FormRequest
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
            'insurance_code' => 'required',
            'name' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name' => [
                'required' => 'أسـم شركة التأمين مطلوب الرجى كتابة اسم شركة التأمين '
            ],
            'insurance_code' => [
                'required' => 'كود الشركة مطلوب الرجى كتابة كود الشركة بطريقة صحيحة '
            ],
        ];
    }
}
