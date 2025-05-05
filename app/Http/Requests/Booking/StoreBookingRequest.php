<?php

namespace App\Http\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
            'total_price'=>'required|integer|max:50000|min:20',
            'is_paid'=>'required|boolean',
            'num_nights'=>'required|integer|max:1000|min:1',
            'num_guests'=>'required|integer|max:1000|min:1',
            'has_breakfast'=>'required|boolean|between:0,1',
            'guest_id'=>'required|integer|exists:guests,id',
            'cabin_id'=>'required|integer|unique:bookings,cabin_id|exists:cabins,id',
        ];
    }
}
