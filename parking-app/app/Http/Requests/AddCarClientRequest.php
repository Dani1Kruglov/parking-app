<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCarClientRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'brand' => 'required | string',
            'model' => 'required | string',
            'body_color' => 'required | string',
            'state_number' => 'required | regex: "/[A-Za-z]{1}\d{3}[A-Za-z]{2}\d{2,3}/" | unique:cars',
            'is_a_parking' => 'required'
        ];
    }
}
