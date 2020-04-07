<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

class StoreAppraisalRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'job_name' => 'required',
//            'reporting_date_start' => 'required',
//            'reporting_date_end' => 'required',
            'educational_qualifications' => 'required',
            'total_job_period' => 'required',
            'birth_date' => 'required',
            'reporting_job_period' => 'required',
            'job-history' => 'required',
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
