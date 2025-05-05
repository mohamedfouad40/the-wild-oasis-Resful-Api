<?php

namespace App\Http\Requests\Cabins;

use Illuminate\Foundation\Http\FormRequest;

class StoreCabinRequest extends FormRequest
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
            'max_capacity'=>'required|integer|max:5|min:1',
            'regular_price'=>'required|integer|max:999999|min:10',
            'discount'=>'required|integer',
            'description'=>'required|string|max:1000',
            'image'=>'required|mimes:png,jpg,jpeg',
        ];
    }
}
