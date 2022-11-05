<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|alpha_dash|unique:roles,name',
            'permissions' => 'required|array',
        ];

        if ($this->isMethod('PUT')) {
            $rules['name'] = 'required|unique:roles,name,' . $this->segment(4);
        }

        return $rules;
    }
}
