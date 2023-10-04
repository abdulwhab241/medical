<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InsuranceInvoiceRequest extends FormRequest
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
            'Patient_id' => 'required|integer',
            'Doctor_id' => 'required|integer',
            'Service_id' => 'required|integer',
            'Company_id' => 'required|integer',
            'price' => 'required',
            'Employee' => 'required',
            'Number' => 'required',
            // 'Patient_discount' => 'required|integer',
        ];
    }

    
    public function messages()
    {
        return [
            'Company_id' => [
                'required' => 'شركة التأمين مطلوب الرجى إختيار شركة التأمين ',
                'integer' => 'شركة التأمين مطلوب الرجى إختيار شركة التأمين '
            ],
            'Patient_id' => [
                'required' => 'أسـم المريض مطلوب الرجى إختيار أسم المريض ',
                'integer' => 'أسـم المريض مطلوب الرجى إختيار أسم المريض '
            ],
            'price' => [
                'required' => 'السعر مطلوب الرجى إختيار السعر  ',
                'integer' => 'السعر مطلوب الرجى إختيار السعر  '
            ],
            // 'Patient_discount' => [
            //     'required' => 'نسبة تحمل المريض مطلوب الرجى إختيار نسبة تحمل المريض  ',
            //     'integer' => 'نسبة تحمل المريض مطلوب الرجى إختيار نسبة تحمل المريض  '
            // ],
            'Doctor_id' => [
                'required' => 'أسـم الطبيب مطلوب الرجى إختيار أسم الطبيب ',
                'integer' => 'أسـم الطبيب مطلوب الرجى إختيار أسم الطبيب '
            ],
            'Service_id' => [
                'required' => 'نسبة تحمل الشركة مطلوب الرجى إختيار الإجراء الذي يريده المريض ',
                'integer' => 'الإجراء مطلوب الرجى إختيار الإجراء الذي يريده المريض '
            ],
            'Number' => [
                'required' => 'رقم المشترك مطلوب الرجى كتابة رقم المشترك الصحيح '
            ],
            'Employee' => [
                'required' => 'نوع المشترك مطلوب الرجى كتابة نوع المشترك الصحيح '
            ],
            // 'Patient_discount' => [
            //     'required' => 'نسبة تحمل الشركة مطلوب الرجى إختيار نسبة تحمل الشركة  '
            // ],

        ];
    }
}
