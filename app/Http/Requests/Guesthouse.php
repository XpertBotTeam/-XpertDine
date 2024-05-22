<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Guesthouse extends FormRequest
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
            'name'=>'required',
            'Facilities'=>'required|array',
            'images' => 'required|array',
            'prices'=>'required',
            'location'=>'required',
            'Phonenumber'=>'required',
            'city'=>'required',
            'status'=>'required'

        ];
    }
}


