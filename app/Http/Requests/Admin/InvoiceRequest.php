<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Patient_id' => [
                'required' => 'أسـم المريض مطلوب الرجى إختيار أسم المريض ',
                'integer' => 'أسـم المريض مطلوب الرجى إختيار أسم المريض '
            ],
            'Doctor_id' => [
                'required' => 'أسـم الطبيب مطلوب الرجى إختيار أسم الطبيب ',
                'integer' => 'أسـم الطبيب مطلوب الرجى إختيار أسم الطبيب '
            ],
            'Service_id' => [
                'required' => 'الإجراء مطلوب الرجى إختيار الإجراء الذي يريده المريض ',
                'integer' => 'الإجراء مطلوب الرجى إختيار الإجراء الذي يريده المريض '
            ],
            'price' => [
                'required' => 'السعر مطلوب الرجى إختيار السعر  '
                // 'integer' => 'السعر مطلوب الرجى إختيار السعر  '
            ],

        ];
    }
}
