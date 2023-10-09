<?php

namespace App\Http\Requests\Doctor;

use Illuminate\Foundation\Http\FormRequest;

class DiagnosticRequest extends FormRequest
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
            'Medicine_id' => 'required',
            'Dosage' => 'required',
            'Use' => 'required',
            'Period' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'Medicine_id' => [
                'required' => 'أسم الدواء مطلوب الرجى إختيار أسم الدواء '
                // 'integer' => 'أسم الدواء مطلوب الرجى إختيار أسم الدواء '
            ],
            'Dosage' => [
                'required' => 'الجرعة مطلوبة الرجى كتابة الجرعة بشكل صحيح  '
            ],
            'Use' => [
                'required' => 'وقت الجرعة مطلوب الرجى كتابة وقت الجرعة  '
            ],
            'Period' => [
                'required' => 'الفترة مطلوبة الرجى كتابة فترة استخدام الدواء  '
            ],
        ];
    }
}
