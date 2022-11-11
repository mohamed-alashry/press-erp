<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'client_id' => 'required',
            'desc' => 'required',
            'quantity' => 'required|numeric',
            'notes' => 'nullable|string',
            'colors' => 'required|array',
            'colors.*.quantity' => 'required|numeric',
            'colors.*.price' => 'required|numeric',
        ];

        if ($this->isMethod('put')) {
            $rules['client_id'] = '';
        }

        return $rules;
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'colors.*.price' => 'السعر',
        ];
    }
}
