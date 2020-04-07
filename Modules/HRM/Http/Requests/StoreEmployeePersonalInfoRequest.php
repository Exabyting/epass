<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreEmployeePersonalInfoRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	protected $errorBag = 'PersonalInfo';
	protected $redirect ;

	public function rules( Request $request ) {
		$this->redirect = '/hrm/employee/create?employee=' . $request->employee_id . '#personal';

		return [
			'father_name'      => 'required',
			'mother_name'      => 'required',
			'job_joining_date' => 'required',
			'date_of_birth'    => 'required',
			'marital_status'   => 'required',
		];
	}

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}


}
