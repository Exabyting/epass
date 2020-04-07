<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreDepartmentRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules( Request $request ) {
//		dd( $request->all() );

		return [
			'name' => 'required|unique:departments,name,' . $request->id,
			'department_code' => 'nullable|unique:departments,department_code,' . $request->id,

		];
	}

	public function messages() {
		return [
			'name.required' => "Enter department name",
			'name.unique' => 'You already added this name. enter new name'
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
