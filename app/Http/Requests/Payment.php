<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Payment extends FormRequest
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
        'nameofcard'=>'required|string',
        'Cardnumber'=>'required|numeric',
        'expirydate'=>'required|date_format:Y/m/d',
        'cvv'=>'required|digits:3'
        ];
    }
}
