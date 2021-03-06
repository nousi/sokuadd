<?php

namespace App\Http\Requests\IncomeAndExpenditureController;

use App\Http\Requests\ApiRequest;
use App\Rules\IncomeAndExpenditureRules\ExistsClassIdRule;
use App\Rules\IncomeAndExpenditureRules\MatchTypeRule;

class CreateIncomeAndExpenditureRequest extends ApiRequest
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
            'classId' => [
                'bail',
                'nullable',
                'integer',
                new ExistsClassIdRule,
                new MatchTypeRule($this->type)
            ],
            'targetDate' => 'bail|required|date_format:Y-m-d',
            'amount' => 'bail|required|integer|min:1|digits_between:1,9',
            'comment' => 'bail|nullable|max:64',
            'type' => 'required|regex:/^[01]$/'
        ];
    }
}
