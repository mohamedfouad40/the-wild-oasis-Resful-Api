<?php

namespace App\Http\Requests\Settings;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSettingsRequest extends FormRequest
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
            'breakfast_price'=>'nullable|decimal',
            "max_guests_per_booking"=>'nullable|integer',
            "max_booking_length"=>'nullable|integer',
            "min_booking_length"=>'nullable|integer',
        ];
    }
}
