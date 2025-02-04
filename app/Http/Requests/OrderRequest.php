<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'client_name' => 'required|string|max:255',
            'client_phone' => 'required|string|unique:orders,client_phone|regex:/^7\d{10}$/',
            'tariff_id' => 'required|integer|exists:tariffs,id',
            'schedule_type' => 'required|in:EVERY_DAY,EVERY_OTHER_DAY,EVERY_OTHER_DAY_TWICE',
            'comment' => 'nullable|string',
            'date_ranges' => 'required|array',
            'date_ranges.*.from' => 'required|date',
            'date_ranges.*.to' => 'required|date|after_or_equal:date_ranges.*.from',
        ];
    }
    public function messages(): array
    {
        return [
            'client_phone.regex' => 'Номер телефона должен начинаться с 7 и содержать 11 цифр.',
            'client_phone.required' => '📞 Поле "Client Phone" обязательно для заполнения.',
            'client_phone.unique' => '❌ Этот номер телефона уже используется!',
            'date_ranges.*.to.after_or_equal' => 'Дата окончания должна быть после или равна дате начала.',
        ];
    }
}
