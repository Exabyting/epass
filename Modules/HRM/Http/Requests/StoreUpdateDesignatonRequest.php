<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class StoreUpdateDesignatonRequest extends FormRequest {
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules( Request $request ) {
		return [
			'name' => 'required|unique:designations,name,' . $request->id,

		];
	}

	public function messages() {
		return [
			'name.required' => "Enter designation name",
			'name.unique'   => 'You already added this designation. enter new designation'
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
