<?php

namespace App\Http\Requests\Visit;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVisitRequest extends FormRequest
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
            'visit_date' => ['sometimes', 'date', 'after:now'],
        ];
    }

    public function messages(): array
    {
        return [
            'visit_date.after' => 'Дата приёма должна быть в будущем',
        ];
    }
}
