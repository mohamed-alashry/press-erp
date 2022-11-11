<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierPaymentRequest extends FormRequest
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
            'supplier_id' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required',
        ];

        if ($this->isMethod('put')) {
            $rules['supplier_id'] = '';
        }

        return $rules;
    }
}
