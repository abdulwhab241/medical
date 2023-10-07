<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MedicineRequest extends FormRequest
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
            'Name' => 'required',
            'Bar_Code' => 'required',
            'Unit' => 'required|string',
            'Quantity' => 'required',
            'Supplier' => 'required',
            'Buy_Price' => 'required',
            'Sale_Price' => 'required',
            'End_Date' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'Name' => [
                'required' => 'أسـم العلاج مطلوب الرجى كتابة اسم العلاج '
            ],
            'Bar_Code' => [
                'required' => 'البار كود مطلوب الرجى كتابة البار كود بشكل صحيح'
            ],
            'Unit' => [
                'required' => 'الوحدة مطلوب الرجى إختيار الوحدة ',
                'string' => 'الوحدة مطلوب الرجى إختيار الوحدة '
            ],
            'Quantity' => [
                'required' => 'كمية العلاج مطلوبة الرجى كتابة  كمية العلاج '
            ],
            'Buy_Price' => [
                'required' => 'سعر شراء العلاج مطلوب الرجى كتابة  سعر شراء العلاج '
            ],
            'Sale_Price' => [
                'required' => 'سعر بيع العلاج مطلوب الرجى كتابة  سعر بيع العلاج '
            ],
            'Supplier' => [
                'required' => 'المورد مطلوب الرجى كتابة أسم المورد بشكل صحيح '
            ],
            'End_Date' => [
                'required' => 'تاريخ إنتهاء العلاج مطلوب الرجى اختيار  تاريخ إنتهاء العلاج ',
                'date' => 'تاريخ إنتهاء العلاج مطلوب الرجى اختيار  تاريخ إنتهاء العلاج '
            ],
        ];
    }
}
