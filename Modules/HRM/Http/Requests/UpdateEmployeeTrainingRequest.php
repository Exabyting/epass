<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateEmployeeTrainingRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
	protected $errorBag = "trainingError";
	public function rules( Request $request ) {

//		$this->redirect          = '/hrm/employee/create?employee=' . $request->training[0]['employee_id'] . '#training';
		$this->redirect = '/hrm/employee/'. $request->training[0]['employee_id']. '/edit#training';

		return [
			'training.*.course_name'       => 'required',
			'training.*.organization_name'       => 'required',
			'training.*.duration'       => 'required',
			'training.*.result'       => 'required',
		];
	}
	public function messages() {
		$messages = [
			'training.*.course_name.required' => 'Please enter course name',
			'training.*.organization_name.required' => 'Please enter organization name',
			'training.*.duration.required' => 'Please enter duration',
			'training.*.result.required' => 'Please enter result',
		];

		return $messages;
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
