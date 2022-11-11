<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplyRequest extends FormRequest
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
            'name' => 'required',
            'date' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|numeric',
            'discount' => 'required|numeric',
            'notes' => 'nullable|string',
        ];

        if ($this->isMethod('put')) {
            $rules['client_id'] = '';
        }

        return $rules;
    }
}
