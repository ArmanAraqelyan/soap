<?php

namespace App\Http\Requests\Train;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class GetRoutesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'train' => ['required' , 'string' , 'regex:/[0-9]{1,}[^\d\!\@\#\$\%\^\&\*\(\)\_\+\|\]\[]{1,}/', 'max:30'],
            'station_source' => 'required|string|max:100',
            'station_destination' =>'required|string|max:100',
            'day'                 => 'required|date'
        ];
    }


    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => $validator->errors()
        ], 200);
        throw new ValidationException($validator, $response);
    }
}
