<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreAppraisalReport extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'job_name' => 'required',
            'reporting_date_start' => 'required',
            'reporting_date_end' => 'required',
            'educational_qualifications' => 'required',
            'total_job_period' => 'required',
            'birth_date' => 'required',
            'reporting_job_period' => 'required',
            'job_history_designation' => 'required',
            'job_history_duration' => 'required',
            'job_history_salary_scale' => 'required',
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
