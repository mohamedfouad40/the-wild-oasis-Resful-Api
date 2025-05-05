<?php

namespace App\Http\Requests\Guests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterGuestRequest extends FormRequest
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
            'name'=>'required|string|max:100|min:2',
            'email'=>'required|email|unique:guests',
            'national_id'=>'required|Integer|unique:guests',
            'password'=>'required|confirmed|min:8'
        ];
    }
}
