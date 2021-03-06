<?php

namespace App\Http\Requests\IncomeAndExpenditureController;

use App\Http\Requests\ApiRequest;
use App\Rules\IncomeAndExpenditureRules\ExistsIdRule;
use App\Rules\IncomeAndExpenditureRules\ExistsClassIdRule;
use App\Rules\IncomeAndExpenditureRules\MatchTypeRule;

class EditIncomeAndExpenditureRequest extends ApiRequest
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
            'id' => [
                'bail',
                'required',
                'integer',
                new ExistsIdRule
            ],
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
            'year' => [
                'bail',
                'required',
                'regex:/^(19[0-9]{2}|2[0-9]{3})$/'
            ],
            'month' => [
                'bail',
                'required',
                'regex:/^([1-9]|1[0-2])$/'
            ]
        ];
    }
}
