<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PaymentRequest extends FormRequest
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
            'Disc' => 'required',
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
            'Disc' => [
                'required' => 'غرض الصرف مطلوب الرجى كتابة غرض الصرف '
            ],

            'price' => [
                'required' => 'السعر مطلوب الرجى كتابة السعر  '
            ],

        ];
    }
}
