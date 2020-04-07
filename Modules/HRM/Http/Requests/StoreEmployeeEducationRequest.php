<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreEmployeeEducationRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	protected $errorBag = "educationError";

	public function rules( Request $request ){

		$this->redirect          = '/hrm/employee/create?employee=' . $request->education[0]['employee_id'] . '#education';

		return [
			'education.*.academic_institute_id'       => 'required',
			'education.*.academic_department_id'       => 'required',
			'education.*.academic_degree_id'       => 'required',
			'education.*.passing_year'       => 'required',
			'education.*.duration'       => 'required',
			'education.*.result'       => 'required',
//			'email'            => 'required|unique:employees,email,' . $request->id,

		];

	}
	public function messages() {
		$messages = [
			'education.*.academic_institute_id.required' => 'Please enter institute name',
			'education.*.academic_department_id.required' => 'Please enter department name ',
			'education.*.academic_degree_id.required' => 'Please enter degree name ',
			'education.*.passing_year.required' => 'Please enter passing year ',
			'education.*.duration.required' => 'Please enter duration ',
			'education.*.result.required' => 'Please enter result ',
		];

		return $messages;
	}


	public function authorize() {
		return true;
	}
}
