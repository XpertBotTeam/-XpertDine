<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class reservation extends FormRequest
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
            'user_id'=>'required',
            'restaurant_id'=>'required',
            'reservation_time'=>'required|date_format H:i',
            'number_of_people'=>'nullable|Integer',
            'phone_number'=>'nullable|Integer'
        ];
    }
}
