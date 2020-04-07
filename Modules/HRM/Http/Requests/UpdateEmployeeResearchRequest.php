<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateEmployeeResearchRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	protected $errorBag = "researchError";

	public function rules( Request $request ) {

		$this->redirect = '/hrm/employee/' . $request->research[0]['employee_id'] . '/edit#research';

		return [
			'research.*.organization_name' => 'required',
			'research.*.research_topic'    => 'required',

		];

	}

	public function messages() {
		$messages = [
			'research.*.organization_name.required' => 'Please enter organization name',
			'research.*.research_topic.required'    => 'Please enter research topic',
		];

		return $messages;
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
