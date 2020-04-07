<?php

namespace Modules\HRM\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'department_id' => 'required',
            'section_code' => 'unique:sections| max:10'
        ];
    }

    public function messages() {
        return [
            'section_code.max' => "Section code must be in 10 characters",
            'section_code.unique' => 'Section code already exist. Try another'
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
