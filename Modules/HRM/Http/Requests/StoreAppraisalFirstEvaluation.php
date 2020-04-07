<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreAppraisalFirstEvaluation extends FormRequest
{
    private const START = 1;
    private const END = 18;

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        $return =  [
            'rating' => 'required',
        ];

        foreach(range(self::START,self::END) as $index) {
            $return['rating.' . $index] = 'required';
        }

        return $return;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
