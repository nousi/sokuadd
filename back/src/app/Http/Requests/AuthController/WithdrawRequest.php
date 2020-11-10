<?php

namespace App\Http\Requests\AuthController;

use App\Http\Requests\ApiRequest;

class WithdrawRequest extends ApiRequest
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
            'password' => [
                'bail',
                'required',
                'string',
                'min:8',
                'max:255'
            ]
        ];
    }
}
