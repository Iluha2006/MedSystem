<?php

namespace App\Http\Requests\Visit;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreVisitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'doctor_id' => ['required', 'exists:doctors,id'],
            'complaint' => ['required', 'string', 'min:5'],
            'visit_date' => ['required', 'date', 'after:now'],
        ];
    }

    public function messages(): array
    {
        return [
            'doctor_id.required' => 'Необходимо выбрать врача',
            'doctor_id.exists' => 'Выбранный врач не найден',
            'complaint.required' => 'Опишите вашу жалобу',
            'complaint.min' => 'Описание жалобы должно содержать минимум 5 символов',
            'visit_date.required' => 'Необходимо выбрать дату приёма',
            'visit_date.after' => 'Дата приёма должна быть в будущем',
        ];
    }
}
