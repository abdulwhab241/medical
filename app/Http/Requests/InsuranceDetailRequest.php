<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsuranceDetailRequest extends FormRequest
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
            'Insurance_id' => 'required|integer',
            'Name' => 'required',
            'Insurance_code' => 'required',
            // 'Discount_percentage' => 'required|integer',
            'Company_rate' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'Insurance_id' => [
                'required' => 'أسـم شركة التأمين مطلوب الرجى إختيار اسم شركة التأمين '
            ],
            'Name' => [
                'required' => 'أسم المشترك مطلوب الرجى كتابة أسم المشترك بطريقة صحيحة '
            ],
            'Insurance_code' => [
                'required' => 'رقم المشترك  مطلوب الرجى كتابة رقم المشترك بطريقة صحيحة '
            ],
            // 'Discount_percentage' => [
            //     'required' => 'كود الشركة مطلوب الرجى كتابة كود الشركة بطريقة صحيحة '
            // ],
            'Company_rate' => [
                'required' => 'نسبة تحمل الشركة مطلوبة الرجى كتابة نسبة تحمل الشركة بطريقة صحيحة '
            ],
        ];
    }
}
