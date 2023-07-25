<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        $numberCars = (int)$_POST['number_cars'];
        $request = [
            'name' => 'required | string | min:3',
            'surname' => 'required | string | min:3',
            'patronymic' => 'required | string | min:3',
            'gender' => 'required',
            'phone_number' => 'required | regex:/^\+7\d{10}$/ | unique:clients',
            'address' => 'string',
            'number_cars' => 'required | int'
        ];
        for ($i = 1; $i <= $numberCars; $i++) {
            $request += [
                "brand$i" => 'required | string',
                "model$i" => 'required | string',
                "body_color$i" => 'required | string',
                "state_number$i" => 'required | regex: "/[A-Za-z]{1}\d{3}[A-Za-z]{2}\d{2,3}/"',
                "is_a_parking$i" => 'required',
            ];
        }
        return $request;
    }
}
