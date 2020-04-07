<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreEvaluationAction extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $requests
     * @return array
     */
    public function rules(Request $requests)
    {
        return [
            'rating' => 'required',
            'comment' => 'required',
        ];
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
